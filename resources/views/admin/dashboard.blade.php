@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Order Management')

@section('actions')
    <a href="{{ route('admin.signals.create') }}" class="btn btn-primary btn-sm">New Signal</a>
@endsection

@section('content')
    <div class="stats-grid"
        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <!-- Total Users -->
        <div class="card"
            style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem; border: 1px solid rgba(255,255,255,0.05);">
            <div
                style="font-size: 2rem; background: rgba(99, 102, 241, 0.1); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: var(--primary);">
                👥</div>
            <div>
                <div style="font-size: 0.9rem; color: var(--gray);">Total Users</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: var(--white);">{{ $totalUsers ?? 0 }}</div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="card"
            style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem; border: 1px solid rgba(255,255,255,0.05);">
            <div
                style="font-size: 2rem; background: rgba(16, 185, 129, 0.1); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: var(--secondary);">
                💰</div>
            <div>
                <div style="font-size: 0.9rem; color: var(--gray);">Total Revenue</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: var(--white);">
                    ${{ number_format($totalRevenue ?? 0, 2) }}</div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="card"
            style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem; border: 1px solid rgba(255,255,255,0.05);">
            <div
                style="font-size: 2rem; background: rgba(245, 158, 11, 0.1); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: var(--accent);">
                ⏳</div>
            <div>
                <div style="font-size: 0.9rem; color: var(--gray);">Pending Orders</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: var(--white);">{{ $pendingOrders ?? 0 }}</div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="card"
            style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem; border: 1px solid rgba(255,255,255,0.05);">
            <div
                style="font-size: 2rem; background: rgba(59, 130, 246, 0.1); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #3b82f6;">
                💳</div>
            <div>
                <div style="font-size: 0.9rem; color: var(--gray);">Active Methods</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: var(--white);">{{ $activePaymentMethods ?? 0 }}
                </div>
            </div>
        </div>

        <!-- Brokers -->
        <div class="card"
            style="padding: 1.5rem; display: flex; align-items: center; gap: 1rem; border: 1px solid rgba(255,255,255,0.05);">
            <div
                style="font-size: 2rem; background: rgba(236, 72, 153, 0.1); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #ec4899;">
                🏦</div>
            <div>
                <div style="font-size: 0.9rem; color: var(--gray);">Partner Brokers</div>
                <div style="font-size: 1.5rem; font-weight: bold; color: var(--white);">{{ $totalBrokers ?? 0 }}</div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="card">
        <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; color: var(--white);">Recent Orders</h3>
            <a href="#" style="font-size: 0.9rem; color: var(--primary-light);">View All Orders →</a>
        </div>

        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student</th>
                        <th>Service</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Transaction ID</th>
                        <th>Proof</th>
                        <th>Date</th>
                        <th>Status & Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                                <div>{{ $order->user->name }}</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">{{ $order->user->email }}</div>
                            </td>
                            <td>{{ $order->service_name }}</td>
                            <td>{{ $order->amount }} {{ $order->currency }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td style="font-family: monospace;">{{ Str::limit($order->transaction_id, 10) ?? 'N/A' }}</td>
                            <td>
                                @if($order->screenshot_path)
                                    <a href="{{ Storage::url($order->screenshot_path) }}" target="_blank"
                                        style="color: var(--primary-light); text-decoration: underline;">View</a>
                                @else
                                    <span style="color: var(--gray);">None</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.order.update', $order->id) }}" method="POST"
                                    style="display: flex; gap: 0.5rem;">
                                    @csrf
                                    <select name="status" class="form-input" style="padding: 0.25rem 0.5rem; width: auto;"
                                        onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Approve
                                        </option>
                                        <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>Reject
                                        </option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center; padding: 3rem;">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection