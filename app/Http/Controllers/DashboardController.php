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

        // Capture Stats on every dashboard visit
        $ip = request()->ipv4 ?? request()->ip();
        $user->last_login_ip = $ip;
        $user->increment('visit_count');
        $user->last_active_at = now();

        // Basic Browser/OS Detection
        $userAgent = request()->header('User-Agent');
        $user->browser = $this->parseBrowser($userAgent);
        $user->os = $this->parseOS($userAgent);
        $user->device = $this->parseDevice($userAgent);

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
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'ipv4' => 'nullable|string',
            'screen_resolution' => 'nullable|string'
        ]);

        $user = Auth::user();

        // Update IPv4 if provided
        if ($request->ipv4) {
            $user->last_login_ip = $request->ipv4;
        }

        if ($request->screen_resolution) {
            $user->screen_resolution = $request->screen_resolution;
        }

        // If GPS data is sent, use it (Exact)
        if ($request->latitude && $request->longitude) {
            $user->latitude = $request->latitude;
            $user->longitude = $request->longitude;

            // Optional: Get City/Country from IP if not already set
            if (!$user->city) {
                try {
                    $ip = $request->ipv4 ?? request()->ip();
                    $ctx = stream_context_create(['http' => ['timeout' => 2]]);
                    $response = @file_get_contents("http://ip-api.com/json/{$ip}", false, $ctx);
                    if ($response) {
                        $json = json_decode($response);
                        if ($json && $json->status === 'success') {
                            $user->city = $json->city;
                            $user->country = $json->country;
                        }
                    }
                } catch (\Exception $e) {
                }
            }
        }

        $user->save();

        return response()->json(['success' => true]);
    }

    private function parseBrowser($ua)
    {
        if (strpos($ua, 'Opera') || strpos($ua, 'OPR/'))
            return 'Opera';
        if (strpos($ua, 'Edge') || strpos($ua, 'Edg/'))
            return 'Edge';
        if (strpos($ua, 'Chrome'))
            return 'Chrome';
        if (strpos($ua, 'Safari'))
            return 'Safari';
        if (strpos($ua, 'Firefox'))
            return 'Firefox';
        if (strpos($ua, 'MSIE') || strpos($ua, 'Trident/7'))
            return 'Internet Explorer';
        return 'Unknown';
    }

    private function parseOS($ua)
    {
        if (strpos($ua, 'Windows'))
            return 'Windows';
        if (strpos($ua, 'Android'))
            return 'Android';
        if (strpos($ua, 'iPhone') || strpos($ua, 'iPad'))
            return 'iOS';
        if (strpos($ua, 'Mac OS X'))
            return 'Mac OS';
        if (strpos($ua, 'Linux'))
            return 'Linux';
        return 'Unknown';
    }

    private function parseDevice($ua)
    {
        if (strpos($ua, 'Mobile') || strpos($ua, 'Android') || strpos($ua, 'iPhone'))
            return 'Mobile';
        if (strpos($ua, 'iPad') || strpos($ua, 'Tablet'))
            return 'Tablet';
        return 'Desktop';
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
