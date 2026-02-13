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

            $phoneNumber = $request->mobile ? '+92' . $request->mobile : ($request->countryCode ?? '') . $request->phone;

            $user = \App\Models\User::create([
                'name' => $request->fullName,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'phone' => $phoneNumber,
                'whatsapp' => $request->whatsapp,
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

        // Handle verification photos and details
        $verificationData = [];
        if ($isVerification) {
            $verificationData['cnic_number'] = $request->cnicNumber;
            // Handle mobile if user logged in, might come from form
            $verificationData['mobile'] = $request->mobile ? '+92' . $request->mobile : Auth::user()->phone;

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
            'transaction_id' => $request->txId ?? ($isVerification ? 'VERIFICATION-' . time() . '-' . rand(1000, 9999) : null),
            'screenshot_path' => $path,
            'status' => 'pending',
            'notes' => $isVerification ? json_encode($verificationData) : 'Payment submitted via website form',
        ]);

        return redirect()->route('order.success')->with([
            'success' => 'Request submitted successfully!',
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
