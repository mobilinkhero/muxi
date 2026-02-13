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
}
