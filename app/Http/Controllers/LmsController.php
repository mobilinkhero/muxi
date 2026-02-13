<?php

namespace App\Http\Controllers;

use App\Models\LiveClass;
use App\Models\LiveClassAttendee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
