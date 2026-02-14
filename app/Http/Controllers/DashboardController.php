<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch Live Trading Signals for the Dashboard
        $activeSignals = \App\Models\Signal::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate some basic stats for the user
        // Total Signals posted this month? 
        // Let's just pass active signals for now.
        $totalSignals = \App\Models\Signal::count();

        // LMS Stats
        $liveClasses = \App\Models\LiveClass::where('scheduled_at', '>=', now()->subHours(5))
            ->where('status', '!=', 'completed')
            ->orderBy('scheduled_at', 'asc')
            ->get();

        return view('dashboard', compact('user', 'orders', 'activeSignals', 'totalSignals', 'liveClasses'));
    }

    public function courses()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();

        // Focus on Live Session Stats
        $attendanceData = \App\Models\LiveClassAttendee::where('user_id', $user->id)->get();

        $stats = [
            'sessions_attended' => $attendanceData->count(),
            'late_entries' => $attendanceData->where('status', 'late')->count(),
            'upcoming_sessions' => \App\Models\LiveClass::where('scheduled_at', '>', now())->count(),
            'certificates' => 0
        ];

        // Fetch Class Recordings
        $recordings = \App\Models\ClassRecording::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->get();

        return view('dashboard.courses', compact('user', 'orders', 'stats', 'recordings'));
    }
}
