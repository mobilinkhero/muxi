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
        $totalMessages = \App\Models\ContactMessage::count();
        $totalConsultations = \App\Models\ConsultationRequest::count();

        // LMS Stats
        $totalClasses = \App\Models\LiveClass::count();
        $totalAttendance = \App\Models\LiveClassAttendee::count();
        $upcomingClasses = \App\Models\LiveClass::where('scheduled_at', '>', now())->count();

        // Chart 1: Revenue (Last 7 Days)
        $revenueChart = Order::where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(6))
            ->selectRaw('DATE(created_at) as date, SUM(amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $revenueDates = [];
        $revenueData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $revenueDates[] = now()->subDays($i)->format('M d');
            $dayData = $revenueChart->firstWhere('date', $date);
            $revenueData[] = $dayData ? $dayData->total : 0;
        }

        // Chart 2: Payment Method Usage
        $paymentMethodsChart = Order::selectRaw('payment_method, COUNT(*) as count')
            ->groupBy('payment_method')
            ->pluck('count', 'payment_method');

        // Chart 3: Order Status
        $orderStatusChart = [
            'Pending' => $pendingOrders,
            'Completed' => $orders->where('status', 'completed')->count(),
            'Rejected' => $orders->where('status', 'rejected')->count(),
        ];

        return view('admin.dashboard', compact(
            'orders',
            'totalUsers',
            'totalOrders',
            'pendingOrders',
            'totalRevenue',
            'activePaymentMethods',
            'totalBrokers',
            'totalMessages',
            'totalConsultations',
            'revenueDates',
            'revenueData',
            'paymentMethodsChart',
            'orderStatusChart',
            'totalClasses',
            'totalAttendance',
            'upcomingClasses'
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
