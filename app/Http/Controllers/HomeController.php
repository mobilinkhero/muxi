<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        // Real-time user stats
        $registeredUsers = \App\Models\User::count();

        // Count of users who have at least one 'completed' order
        $successfulMembers = \App\Models\Order::where('status', 'completed')
            ->distinct('user_id')
            ->count('user_id');

        // Fetch recent signals to display on landing page
        $recentSignals = \App\Models\Signal::orderBy('created_at', 'desc')->take(3)->get();

        // Fetch published reviews to display on landing page
        $reviews = \App\Models\Review::where('is_published', true)->latest()->get();

        return view('welcome', compact('registeredUsers', 'successfulMembers', 'recentSignals', 'reviews'));
    }
}
