<?php

namespace App\Http\Controllers;

use App\Models\LiveClass;
use App\Models\LiveClassAttendee;
use App\Models\ClassRecording;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LmsController extends Controller
{
    public function joinClass($id)
    {
        $class = LiveClass::findOrFail($id);
        $user = Auth::user();

        // Check if student is already in this class
        $attendee = LiveClassAttendee::firstOrCreate(
            ['user_id' => $user->id, 'live_class_id' => $class->id],
            ['joined_at' => now()]
        );

        // Calculate status (Late if joined 5+ minutes after schedule)
        $scheduledTime = $class->scheduled_at;
        $diffMinutes = $scheduledTime->diffInMinutes(now(), false);

        if ($diffMinutes > 5) {
            $attendee->update(['status' => 'late']);
        } else {
            $attendee->update(['status' => 'on-time']);
        }

        // Redirect to the actual meeting
        return redirect($class->meeting_link);
    }

    public function myStats()
    {
        $user = Auth::user();
        $attendance = LiveClassAttendee::with('liveClass')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        // $quizzes = ...

        return view('dashboard.learning_stats', compact('user', 'attendance'));
    }

    public function saveProgress(Request $request)
    {
        $request->validate([
            'recording_id' => 'required|exists:class_recordings,id',
            'progress' => 'required|numeric|min:0|max:100',
            'watch_time' => 'required|numeric',
        ]);

        $progress = \App\Models\ClassProgress::firstOrNew([
            'user_id' => Auth::id(),
            'class_recording_id' => $request->recording_id,
        ]);

        // Only update progress if the new progress is higher
        if ($request->progress > ($progress->progress_percentage ?? 0)) {
            $progress->progress_percentage = $request->progress;
        }

        // Sticky completion: Once marked finished (99%+), it stays finished
        if ($request->progress >= 99) {
            $progress->is_completed = true;
        }

        $progress->watch_time_seconds = $request->watch_time;
        $progress->last_watched_at = now();
        $progress->save();

        return response()->json(['success' => true]);
    }

    public function streamVideo($id)
    {
        $recording = ClassRecording::findOrFail($id);

        if (!Auth::check()) {
            abort(403);
        }

        // Admin Bypass + Sequential Check
        if (!Auth::user()->is_admin) {
            $previousVideo = ClassRecording::where('is_active', true)
                ->where(function ($q) use ($recording) {
                    $q->where('published_at', '<', $recording->published_at)
                        ->orWhere(function ($q2) use ($recording) {
                            $q2->where('published_at', $recording->published_at)
                                ->where('id', '<', $recording->id);
                        });
                })
                ->orderBy('published_at', 'desc')
                ->orderBy('id', 'desc')
                ->first();

            if ($previousVideo) {
                $progress = \App\Models\ClassProgress::where('user_id', Auth::id())
                    ->where('class_recording_id', $previousVideo->id)
                    ->first();

                if (!$progress || !$progress->is_completed) {
                    abort(403, "Terminal Error: Previous data log (video) must be verified (completed) before accessing this stream.");
                }
            }
        }

        $path = str_replace('/storage/', '', $recording->video_url);
        $fullPath = storage_path('app/public/' . $path);

        if (!file_exists($fullPath)) {
            abort(404, "File not found");
        }

        $size = filesize($fullPath);
        $start = 0;
        $end = $size - 1;
        $type = 'video/mp4';

        if (str_ends_with(strtolower($fullPath), '.mov')) {
            $type = 'video/quicktime';
        }

        $headers = [
            'Content-Type' => $type,
            'Accept-Ranges' => 'bytes',
            'X-Content-Type-Options' => 'nosniff',
        ];

        if ($range = request()->header('Range')) {
            preg_match('/bytes=(\d+)-(\d+)?/', $range, $matches);
            $start = intval($matches[1]);
            $end = isset($matches[2]) ? intval($matches[2]) : $size - 1;

            $headers['Content-Length'] = $end - $start + 1;
            $headers['Content-Range'] = "bytes $start-$end/$size";
            $status = 206;
        } else {
            $headers['Content-Length'] = $size;
            $status = 200;
        }

        return response()->stream(function () use ($fullPath, $start, $end) {
            $stream = fopen($fullPath, 'rb');
            fseek($stream, $start);
            $length = $end - $start + 1;
            $chunkSize = 1024 * 64; // 64KB chunks for better throughput

            while ($length > 0 && !feof($stream)) {
                $read = min($length, $chunkSize);
                echo fread($stream, $read);
                $length -= $read;
                flush();
            }
            fclose($stream);
        }, $status, $headers);
    }
}
