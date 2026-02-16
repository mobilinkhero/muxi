<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,completed,rejected',
        ]);

        if ($request->status === 'completed') {
            $order->update(['status' => 'completed']);

            // Grant Premium Status if relevant service
            $premiumServices = [
                'GSM Premium Trading Course (Upfront)',
                'Premium Access (Pay Later) Verification',
                'Premium Access',
                'Signals Premium'
            ];

            if (in_array($order->service_name, $premiumServices)) {
                $order->user->update(['is_premium' => true]);
            }
        } elseif ($request->status === 'rejected') {
            $request->validate([
                'rejection_reason' => 'nullable|string|max:1000',
            ]);
            $order->update([
                'status' => 'rejected',
                'rejection_reason' => $request->rejection_reason,
            ]);
        } else {
            $order->update([
                'status' => $request->status
            ]);
        }

        return back()->with('success', 'Order status updated successfully.');
    }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Order deleted successfully.');
    }
}
