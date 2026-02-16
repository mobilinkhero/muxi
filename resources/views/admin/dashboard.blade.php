@extends('layouts.admin')

@section('content')
    <!-- Hyper Admin Terminal -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&family=JetBrains+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <style>
        :root {
            --h-bg: #020617;
            --h-card: rgba(15, 23, 42, 0.4);
            --h-border: rgba(255, 255, 255, 0.08);
            --h-primary: #6366F1;
            --h-secondary: #10B981;
            --h-accent: #EC4899;
            --font-h: 'Outfit', sans-serif;
        }

        body {
            font-family: var(--font-h);
            background: var(--h-bg);
            color: #F8FAFC;
        }

        .admin-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .h-card {
            background: var(--h-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--h-border);
            border-radius: 28px;
            padding: 2rem;
            transition: 0.4s cubic-bezier(0.2, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .h-card:hover {
            transform: translateY(-5px);
            border-color: var(--h-primary);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .h-icon {
            width: 50px;
            height: 50px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .h-reveal {
            opacity: 0;
            transform: translateY(20px);
        }

        .h-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .h-table tr {
            background: rgba(255, 255, 255, 0.02);
            transition: 0.3s;
        }

        .h-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .h-table td,
        .h-table th {
            padding: 1.25rem;
            text-align: left;
        }

        .h-table th {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #94A3B8;
        }

        .h-table td:first-child {
            border-radius: 16px 0 0 16px;
        }

        .h-table td:last-child {
            border-radius: 0 16px 16px 0;
        }

        .status-pill {
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
        }
    </style>

    <div class="admin-grid">
        <div class="h-card h-reveal">
            <div class="h-icon" style="background: rgba(99, 102, 241, 0.1); color: var(--h-primary);"><i
                    class="fas fa-users"></i></div>
            <div style="color: #94A3B8; font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase;">Total Users
            </div>
            <div style="font-size: 2.5rem; font-weight: 900; margin-top: 0.5rem;">{{ $totalUsers ?? 0 }}</div>
        </div>

        <div class="h-card h-reveal">
            <div class="h-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--h-secondary);"><i
                    class="fas fa-dollar-sign"></i></div>
            <div style="color: #94A3B8; font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase;">Revenue</div>
            <div style="font-size: 2.5rem; font-weight: 900; margin-top: 0.5rem;">
                ${{ number_format($totalRevenue ?? 0, 0) }}</div>
        </div>

        <div class="h-card h-reveal">
            <div class="h-icon" style="background: rgba(245, 158, 11, 0.1); color: #F59E0B;"><i class="fas fa-clock"></i>
            </div>
            <div style="color: #94A3B8; font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase;">Pending</div>
            <div style="font-size: 2.5rem; font-weight: 900; margin-top: 0.5rem;">{{ $pendingOrders ?? 0 }}</div>
        </div>

        <div class="h-card h-reveal">
            <div class="h-icon" style="background: rgba(236, 72, 153, 0.1); color: var(--h-accent);"><i
                    class="fas fa-envelope"></i></div>
            <div style="color: #94A3B8; font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase;">Messages</div>
            <div style="font-size: 2.5rem; font-weight: 900; margin-top: 0.5rem;">{{ $totalMessages ?? 0 }}</div>
        </div>
    </div>

    <!-- Charts Row -->
    <!-- Charts Row -->
    <div
        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div class="h-card h-reveal" style="grid-column: span 2;">
            <h3 style="margin-bottom: 2rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-chart-line" style="color: var(--h-primary);"></i> Revenue Index Trend
            </h3>
            <div style="height: 350px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
        <div class="h-card h-reveal">
            <h3 style="margin-bottom: 2rem;">Order Matrix</h3>
            <div style="height: 250px;">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
        <div class="h-card h-reveal">
            <h3 style="margin-bottom: 2rem;">Payment Volume</h3>
            <div style="height: 250px;">
                <canvas id="paymentChart"></canvas>
            </div>
        </div>
    </div>

    <div class="h-card h-reveal">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 style="margin: 0; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-microchip" style="color: var(--h-accent);"></i> Transaction Matrix
            </h3>
            <a href="/youcanthackme/orders" class="status-pill"
                style="background: rgba(99, 102, 241, 0.1); color: var(--h-primary); text-decoration: none;">Deep Access
                →</a>
        </div>
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Operator</th>
                        <th>Signal Service</th>
                        <th>Volume</th>
                        <th>Protocol</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders->take(10) as $order)
                        <tr>
                            <td>
                                <div style="font-weight: 700; color: white;">{{ $order->user->name }}</div>
                                <div style="font-size: 0.75rem; color: #94A3B8;">{{ $order->user->email }}</div>
                            </td>
                            <td style="color: var(--h-primary); font-weight: 700;">{{ $order->service_name }}</td>
                            <td style="font-weight: 900; color: white;">${{ number_format($order->amount, 2) }}</td>
                            <td><span class="mono"
                                    style="font-size: 0.8rem; opacity: 0.6; font-family: 'JetBrains Mono';">{{ $order->payment_method }}</span>
                            </td>
                            <td>
                                <span class="status-pill"
                                    style="background: {{ $order->status == 'completed' ? 'rgba(16, 185, 129, 0.1)' : ($order->status == 'pending' ? 'rgba(245, 158, 11, 0.1)' : 'rgba(239, 68, 68, 0.1)') }}; 
                                                   color: {{ $order->status == 'completed' ? '#10B981' : ($order->status == 'pending' ? '#F59E0B' : '#EF4444') }};">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 4rem; color: #94A3B8;">
                                <i class="fas fa-ghost" style="font-size: 2.5rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                                <p>No transmissions detected.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', {
                opacity: 1,
                y: 0,
                duration: 1.2,
                stagger: 0.1,
                ease: "power4.out"
            });
        });

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($revenueDates) !!},
                datasets: [{
                    label: 'Revenue Index',
                    data: {!! json_encode($revenueData) !!},
                    borderColor: '#6366F1',
                    backgroundColor: 'rgba(99, 102, 241, 0.05)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: '#6366F1',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94A3B8', font: { family: 'JetBrains Mono' } } },
                    x: { grid: { display: false }, ticks: { color: '#94A3B8', font: { family: 'JetBrains Mono' } } }
                },
                plugins: { legend: { display: false } }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending', 'Rejected'],
                datasets: [{
                    data: [
                            {{ $orderStatusChart['Completed'] }},
                            {{ $orderStatusChart['Pending'] }},
                        {{ $orderStatusChart['Rejected'] }}
                    ],
                    backgroundColor: ['#10B981', '#F59E0B', '#EF4444'],
                    borderWidth: 0,
                    hoverOffset: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#94A3B8',
                            padding: 20,
                            font: { family: 'Outfit', weight: '600' }
                        }
                    }
                },
                cutout: '75%'
            }
        });

        // Payment Method Chart
        const paymentCtx = document.getElementById('paymentChart').getContext('2d');
        new Chart(paymentCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($paymentMethodsChart->keys()) !!},
                datasets: [{
                    data: {!! json_encode($paymentMethodsChart->values()) !!},
                    backgroundColor: 'rgba(236, 72, 153, 0.2)',
                    borderColor: '#EC4899',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { grid: { color: 'rgba(255,255,255,0.05)' }, ticks: { color: '#94A3B8' } },
                    x: { grid: { display: false }, ticks: { color: '#94A3B8' } }
                },
                plugins: { legend: { display: false } }
            }
        });
    </script>
@endsection