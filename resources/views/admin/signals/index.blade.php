<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Signals - Admin</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        body {
            background: var(--dark);
            color: var(--white);
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .table-card {
            background: var(--dark-light);
            border-radius: var(--radius-md);
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
        }

        .badge {
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .badge-buy {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .badge-sell {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2>Manage Live Signals</h2>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="margin-right: 1rem;">Back to
                    Dashboard</a>
                <a href="{{ route('admin.signals.create') }}" class="btn btn-primary">Post New Signal +</a>
            </div>
        </div>

        @if(session('success'))
            <div
                style="padding: 1rem; background: rgba(16, 185, 129, 0.2); color: #10b981; border-radius: var(--radius-sm); margin-bottom: 1rem;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Symbol</th>
                        <th>Type</th>
                        <th>Entry</th>
                        <th>TP / SL</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($signals as $signal)
                        <tr>
                            <td>{{ $signal->created_at->format('M d, H:i') }}</td>
                            <td style="font-weight: bold;">{{ $signal->symbol }}</td>
                            <td>
                                <span class="badge badge-{{ strtolower($signal->type) }}">
                                    {{ $signal->type }}
                                </span>
                            </td>
                            <td>{{ $signal->entry_price }}</td>
                            <td>
                                <div style="color: #10b981;">TP1: {{ $signal->take_profit_1 }}</div>
                                <div style="color: #ef4444;">SL: {{ $signal->stop_loss }}</div>
                            </td>
                            <td>
                                <span
                                    style="color: {{ $signal->status == 'active' ? '#f59e0b' : ($signal->status == 'closed' ? '#10b981' : '#ef4444') }}">
                                    {{ ucfirst($signal->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.signals.edit', $signal->id) }}"
                                    class="btn btn-secondary btn-sm">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 3rem;">No signals posted yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>