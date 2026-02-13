@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Order Management')

@section('actions')
    <a href="{{ route('admin.signals.create') }}" class="btn btn-primary btn-sm">New Signal</a>
@endsection

@section('content')
    <div class="card">
        <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <p style="color: var(--gray);">Review and approve student payments</p>
            </div>
            <div
                style="background: var(--dark); padding: 1rem; border-radius: var(--radius-md); border: 1px solid rgba(255,255,255,0.1);">
                <span style="color: var(--gray);">Total Revenue:</span>
                <strong style="color: #10b981; font-size: 1.2rem; margin-left: 0.5rem;">
                    ${{ number_format($orders->where('status', 'completed')->sum('amount'), 2) }}
                </strong>
            </div>
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