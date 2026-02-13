<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GSM Trading Lab</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        body {
            background: var(--dark);
            color: var(--white);
        }

        .admin-header {
            background: var(--dark-light);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .card {
            background: var(--dark-light);
            border-radius: var(--radius-md);
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        th {
            background: rgba(0, 0, 0, 0.2);
            font-weight: 600;
            color: var(--gray-light);
        }

        .status-select {
            background: var(--dark);
            color: var(--white);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.5rem;
            border-radius: var(--radius-sm);
        }

        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }

        .badge-completed {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .badge-rejected {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.85rem;
        }
    </style>
</head>

<body>
    <header class="admin-header">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <img src="https://i.ibb.co/3ykG88h/gsm-logo.png" alt="Logo" style="height: 40px;">
            <h3>Admin Panel</h3>
        </div>
        <div>
            <a href="{{ route('admin.signals.index') }}" class="btn btn-secondary btn-sm"
                style="margin-right: 0.5rem;">Manage Signals</a>
            <a href="/" class="btn btn-secondary btn-sm">View Site</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">Logout</button>
            </form>
        </div>
    </header>

    <div class="container">
        <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <h2>Order Management</h2>
                <p style="color: var(--gray);">Review and approve student payments</p>
            </div>
            <div
                style="background: var(--dark-light); padding: 1rem; border-radius: var(--radius-md); border: 1px solid rgba(255,255,255,0.1);">
                <span style="color: var(--gray);">Total Revenue:</span>
                <strong style="color: #10b981; font-size: 1.2rem; margin-left: 0.5rem;">
                    ${{ number_format($orders->where('status', 'completed')->sum('amount'), 2) }}
                </strong>
            </div>
        </div>

        @if(session('success'))
            <div
                style="padding: 1rem; background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #10b981; border-radius: var(--radius-sm); margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
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
                                <td style="font-family: monospace;">{{ Str::limit($order->transaction_id, 10) ?? 'N/A' }}
                                </td>
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
                                        <select name="status" class="status-select" onchange="this.form.submit()">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                Approve</option>
                                            <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>
                                                Reject</option>
                                        </select>
                                        <span class="badge badge-{{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
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
    </div>
</body>

</html>