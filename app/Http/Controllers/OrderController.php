<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Require user to be logged in or provided registration details
        if (!Auth::check()) {
            $request->validate([
                'fullName' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = \App\Models\User::create([
                'name' => $request->fullName,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'phone' => ($request->countryCode ?? '') . $request->phone,
                'whatsapp' => $request->whatsapp ?? $request->mobile, // verification form uses 'mobile'
            ]);

            Auth::login($user);
        }

        $isVerification = $request->amount == 0 && $request->payment_method === 'Verification';

        $rules = [
            'service_name' => 'required|string',
            'amount' => 'required|numeric',
            'currency' => 'required|string',
            'payment_method' => 'required|string',
        ];

        if (!$isVerification) {
            $rules['screenshot'] = 'required_without:paymentScreenshot|image|max:10240';
            $rules['paymentScreenshot'] = 'required_without:screenshot|image|max:10240';
        }

        $request->validate($rules);

        $path = null;
        if ($request->hasFile('screenshot')) {
            $path = $request->file('screenshot')->store('payment_proofs', 'public');
        } elseif ($request->hasFile('paymentScreenshot')) {
            $path = $request->file('paymentScreenshot')->store('payment_proofs', 'public');
        }

        // Handle verification photos if present
        $verificationData = [];
        if ($isVerification) {
            foreach (['cnicFront', 'cnicBack', 'profilePhoto'] as $fileKey) {
                if ($request->hasFile($fileKey)) {
                    $verificationData[$fileKey] = $request->file($fileKey)->store('verifications', 'public');
                }
            }
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'service_name' => $request->service_name,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->txId,
            'screenshot_path' => $path,
            'status' => 'pending',
            'notes' => $isVerification ? 'Verification request: ' . json_encode($verificationData) : 'Payment submitted via website form',
        ]);

        return redirect()->route('order.success')->with([
            'success' => 'Payment submitted successfully!',
            'order_id' => $order->id
        ]);
    }

    public function success()
    {
        $orderId = session('order_id');
        $order = $orderId ? Order::with('user')->find($orderId) : null;

        return view('support.order-success', compact('order'));
    }
}
