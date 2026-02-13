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

        $orders = \Illuminate\Support\Facades\DB::table('orders')
            ->where('user_id', $user->id)
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

        return view('dashboard', compact('user', 'orders', 'activeSignals', 'totalSignals'));
    }
}
