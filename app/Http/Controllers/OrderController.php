<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Require user to be logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to submit your payment.');
        }

        $request->validate([
            'service_name' => 'required|string',
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'payment_method' => 'required|string',
            'paymentScreenshot' => 'required|image|max:10240', // 10MB Max
        ]);

        $path = null;
        if ($request->hasFile('paymentScreenshot')) {
            $path = $request->file('paymentScreenshot')->store('payment_proofs', 'public');
        }

        Order::create([
            'user_id' => Auth::id(),
            'service_name' => $request->service_name,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'payment_method' => $request->payment_method,
            'screenshot_path' => $path,
            'status' => 'pending',
            'notes' => 'Submitted via website form',
        ]);

        return redirect()->route('dashboard')->with('success', 'Payment submitted successfully! We will review it shortly.');
    }
}
