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

        // Capture IP on every dashboard visit
        $ip = request()->ip();
        $user->last_login_ip = $ip;

        // BACKUP: If no GPS data yet, try to get rough location from IP
        if (!$user->latitude || !$user->longitude) {
            try {
                // Use ip-api.com to get location from IP (Free service)
                $ctx = stream_context_create(['http' => ['timeout' => 2]]);
                $response = @file_get_contents("http://ip-api.com/json/{$ip}", false, $ctx);
                if ($response) {
                    $json = json_decode($response);
                    if ($json && $json->status === 'success') {
                        $user->latitude = $json->lat;
                        $user->longitude = $json->lon;
                        $user->city = $json->city;
                        $user->country = $json->country;
                    }
                }
            } catch (\Exception $e) {
                // Fail silently if API is down
            }
        }

        $user->save();

        return view('dashboard', compact('user', 'orders', 'activeSignals', 'totalSignals', 'liveClasses'));
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = Auth::user();
        $user->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return response()->json(['success' => true]);
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

        // Fetch Class Recordings in ASC order for progression (Timeline order)
        $recordingsList = \App\Models\ClassRecording::where('is_active', true)
            ->orderBy('published_at', 'asc')
            ->orderBy('id', 'asc') // Fallback for same timestamps
            ->with([
                'progress' => function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                }
            ])
            ->get();

        $recordings = collect();
        $previousCompleted = true; // First video is always unlocked

        foreach ($recordingsList as $rec) {
            // STRICT PROGRESSION: Next video only unlocks if previous is 99% complete
            $isUnlocked = $previousCompleted;
            $progressData = $rec->progress;

            $rec->is_unlocked = $isUnlocked;
            $rec->user_progress = $progressData ? $progressData->progress_percentage : 0;
            $rec->is_completed = $progressData ? $progressData->is_completed : false;

            $recordings->push($rec);

            // Set for next iteration (This controls the lock for the next video)
            $previousCompleted = $rec->is_completed;
        }

        // Return DESC for UI but keep computed properties
        $recordings = $recordings->reverse();

        return view('dashboard.courses', compact('user', 'orders', 'stats', 'recordings'));
    }
}
