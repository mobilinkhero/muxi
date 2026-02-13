<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Signal;
use Illuminate\Support\Facades\Auth;

class TradeController extends Controller
{
    public function index()
    {
        // Public signals (e.g., closed ones for proof)
        $closedSignals = Signal::whereIn('status', ['closed', 'cancelled'])
            ->orderBy('updated_at', 'desc')
            ->take(6)
            ->get();

        // Active signals - Only for logged-in users? Or show blurred/locked for guests?
        // Let's pass them all and handle blurring in Blade.
        $activeSignals = Signal::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        $brokers = \App\Models\Broker::all();

        return view('trade', compact('closedSignals', 'activeSignals', 'brokers'));
    }
}
