<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        // Simple Admin Check
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();

        // Dashboard Stats
        $totalUsers = \App\Models\User::count();
        $totalOrders = $orders->count();
        $pendingOrders = $orders->where('status', 'pending')->count();
        $totalRevenue = $orders->where('status', 'completed')->sum('amount');
        $activePaymentMethods = \App\Models\PaymentMethod::where('is_active', true)->count();
        $totalBrokers = \App\Models\Broker::count();

        return view('admin.dashboard', compact(
            'orders',
            'totalUsers',
            'totalOrders',
            'pendingOrders',
            'totalRevenue',
            'activePaymentMethods',
            'totalBrokers'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        // Simple Admin Check
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }

        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,completed,rejected',
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Order status updated successfully.');
    }
}
