<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LiveClass;
use App\Models\LiveClassAttendee;
use Illuminate\Http\Request;

class LmsController extends Controller
{
    public function classes()
    {
        $classes = LiveClass::orderBy('scheduled_at', 'desc')->get();
        return view('admin.lms.classes', compact('classes'));
    }

    public function createClass(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'meeting_link' => 'required|url',
            'scheduled_at' => 'required|date',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        LiveClass::create($request->all());

        return back()->with('success', 'Live Class scheduled successfully!');
    }

    public function deleteClass($id)
    {
        LiveClass::findOrFail($id)->delete();
        return back()->with('success', 'Class deleted.');
    }

    public function attendance($id)
    {
        $class = LiveClass::findOrFail($id);
        $attendees = LiveClassAttendee::with('user')->where('live_class_id', $id)->get();
        return view('admin.lms.attendance', compact('class', 'attendees'));
    }

    public function studentStats()
    {
        $students = \App\Models\User::where('is_admin', false)->with(['liveClassAttendance', 'quizAttempts'])->get();
        return view('admin.lms.student_stats', compact('students'));
    }

    public function tasks()
    {
        $tasks = \App\Models\DailyTask::orderBy('created_at', 'desc')->get();
        return view('admin.lms.tasks', compact('tasks'));
    }

    public function createTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        \App\Models\DailyTask::create($request->all());

        return back()->with('success', 'Task added successfully.');
    }

    public function deleteTask($id)
    {
        \App\Models\DailyTask::findOrFail($id)->delete();
        return back()->with('success', 'Task deleted.');
    }

    // Class Recordings
    public function recordings()
    {
        $recordings = \App\Models\ClassRecording::orderBy('published_at', 'desc')->get();
        return view('admin.lms.recordings', compact('recordings'));
    }

    public function uploadRecording(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video_file' => 'required|mimes:mp4,mov,avi,wmv|max:500000', // 500MB max
            'thumbnail_file' => 'nullable|image|max:2048',
        ]);

        $videoPath = $request->file('video_file')->store('recordings/videos', 'public');
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail_file')) {
            $thumbnailPath = $request->file('thumbnail_file')->store('recordings/thumbnails', 'public');
        }

        \App\Models\ClassRecording::create([
            'title' => $request->title,
            'description' => $request->description,
            'video_url' => '/storage/' . $videoPath,
            'thumbnail_url' => $thumbnailPath ? '/storage/' . $thumbnailPath : null,
            'published_at' => now(),
        ]);

        return back()->with('success', 'Recording uploaded successfully!');
    }

    public function deleteRecording($id)
    {
        $recording = \App\Models\ClassRecording::findOrFail($id);

        // Delete files from storage
        $videoPath = str_replace('/storage/', '', $recording->video_url);
        \Illuminate\Support\Facades\Storage::disk('public')->delete($videoPath);

        if ($recording->thumbnail_url) {
            $thumbPath = str_replace('/storage/', '', $recording->thumbnail_url);
            \Illuminate\Support\Facades\Storage::disk('public')->delete($thumbPath);
        }

        $recording->delete();
        return back()->with('success', 'Recording deleted.');
    }
}
