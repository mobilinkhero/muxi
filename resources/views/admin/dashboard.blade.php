@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- Dashboard Header -->
    <div class="h-reveal"
        style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h1 style="font-weight: 900; font-size: 3.5rem; letter-spacing: -2px; margin: 0; line-height: 1;">Welcome Back,
                Admin</h1>
            <p style="color: #64748B; font-size: 1.1rem; margin-top: 1rem; font-weight: 500;">Here's what's happening on
                your website today.</p>
        </div>
        <div style="text-align: right;">
            <div
                style="font-size: 0.75rem; color: #64748B; font-weight: 800; text-transform: uppercase; letter-spacing: 2px;">
                Server Time</div>
            <div style="font-size: 1.5rem; font-weight: 900; color: white;">{{ now()->format('h:i A') }}</div>
        </div>
    </div>

    <!-- Stats Cards: High Spec 3D -->
    <div
        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2.5rem; margin-bottom: 4rem;">
        <div class="h-card h-reveal">
            <div
                style="width: 50px; height: 50px; border-radius: 14px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.4rem; margin-bottom: 2rem;">
                <i class="fas fa-users"></i>
            </div>
            <div
                style="color: var(--text-dim); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">
                Total Registered Users</div>
            <div style="font-size: 3.5rem; font-weight: 900; margin-top: 0.5rem; color: #fff; letter-spacing: -1px;"
                class="stylized-counter" data-target="{{ $totalUsers ?? 0 }}">0</div>
        </div>

        <div class="h-card h-reveal">
            <div
                style="width: 50px; height: 50px; border-radius: 14px; background: rgba(16, 185, 129, 0.1); display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 1.4rem; margin-bottom: 2rem;">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div
                style="color: var(--text-dim); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">
                Total Revenue Earned</div>
            <div style="font-size: 3.5rem; font-weight: 900; margin-top: 0.5rem; color: #fff; letter-spacing: -1px;">
                ${{ number_format($totalRevenue ?? 0, 0) }}</div>
        </div>

        <div class="h-card h-reveal">
            <div
                style="width: 50px; height: 50px; border-radius: 14px; background: rgba(245, 158, 11, 0.1); display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 1.4rem; margin-bottom: 2rem;">
                <i class="fas fa-clock"></i>
            </div>
            <div
                style="color: var(--text-dim); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">
                Pending Order Requests</div>
            <div style="font-size: 3.5rem; font-weight: 900; margin-top: 0.5rem; color: #fff; letter-spacing: -1px;"
                class="stylized-counter" data-target="{{ $pendingOrders ?? 0 }}">0</div>
        </div>

        <div class="h-card h-reveal">
            <div
                style="width: 50px; height: 50px; border-radius: 14px; background: rgba(244, 63, 94, 0.1); display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 1.4rem; margin-bottom: 2rem;">
                <i class="fas fa-envelope"></i>
            </div>
            <div
                style="color: var(--text-dim); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">
                Unread Messages</div>
            <div style="font-size: 3.5rem; font-weight: 900; margin-top: 0.5rem; color: #fff; letter-spacing: -1px;"
                class="stylized-counter" data-target="{{ $totalMessages ?? 0 }}">0</div>
        </div>
    </div>

    <!-- Analytics Section: Clean & Stylish -->
    <div style="display: grid; grid-template-columns: 2fr 1.2fr; gap: 2.5rem; margin-bottom: 4rem;">
        <div class="h-card h-reveal">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
                <h3 style="margin: 0; font-weight: 800; font-size: 1.5rem; display: flex; align-items: center; gap: 15px;">
                    <i class="fas fa-chart-line" style="color: var(--primary);"></i> Revenue Performance
                </h3>
                <div class="status-pill" style="color: #10B981;">Updated Live</div>
            </div>
            <div style="height: 400px;">
                <canvas id="mainChart"></canvas>
            </div>
        </div>

        <div class="h-card h-reveal">
            <h3 style="margin-bottom: 3rem; font-weight: 800; font-size: 1.5rem;">Order Statistics</h3>
            <div style="height: 300px;">
                <canvas id="donutChart"></canvas>
            </div>
            <div style="margin-top: 2rem;">
                <div
                    style="display: flex; justify-content: space-between; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 16px; margin-bottom: 1rem;">
                    <span style="font-weight: 600; color: #94A3B8;">Completed</span>
                    <span style="font-weight: 800; color: #10B981;">{{ $orderStatusChart['Completed'] ?? 0 }}</span>
                </div>
                <div
                    style="display: flex; justify-content: space-between; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 16px;">
                    <span style="font-weight: 600; color: #94A3B8;">Pending</span>
                    <span style="font-weight: 800; color: #F59E0B;">{{ $orderStatusChart['Pending'] ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="h-card h-reveal">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
            <h3 style="margin: 0; font-weight: 800; font-size: 1.5rem; display: flex; align-items: center; gap: 15px;">
                <i class="fas fa-list-ul" style="color: var(--secondary);"></i> Recent Activity Feed
            </h3>
            <a href="{{ route('admin.orders.index') }}" class="btn-style"
                style="padding: 0.6rem 1.4rem; font-size: 0.85rem;">View All Orders</a>
        </div>
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr style="text-align: left;">
                        <th
                            style="padding: 1.5rem; color: #64748B; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">
                            User</th>
                        <th
                            style="padding: 1.5rem; color: #64748B; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">
                            Service</th>
                        <th
                            style="padding: 1.5rem; color: #64748B; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">
                            Amount</th>
                        <th
                            style="padding: 1.5rem; color: #64748B; font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">
                            Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders->take(6) as $order)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div
                                        style="width: 35px; height: 35px; border-radius: 10px; background: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 900;">
                                        {{ substr($order->user->name, 0, 1) }}</div>
                                    <div>
                                        <div style="font-weight: 700; color: #fff;">{{ $order->user->name }}</div>
                                        <div style="font-size: 0.75rem; color: #64748B;">{{ $order->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-weight: 600;">{{ $order->service_name }}</td>
                            <td style="font-weight: 800; color: var(--primary);">${{ number_format($order->amount, 2) }}</td>
                            <td>
                                <span class="status-pill"
                                    style="color: {{ $order->status == 'completed' ? '#10B981' : '#F59E0B' }};">
                                    <span style="width: 6px; height: 6px; border-radius: 50%; background: currentColor;"></span>
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 4rem; color: #64748B;">No recent data available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Smooth Counter Animation
            const counters = document.querySelectorAll('.stylized-counter');
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const duration = 2500;
                let start = 0;
                const startTime = performance.now();

                const update = (now) => {
                    const elapsed = now - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const easedProgress = 1 - Math.pow(1 - progress, 4);
                    counter.innerText = Math.floor(easedProgress * target);
                    if (progress < 1) requestAnimationFrame(update);
                };
                requestAnimationFrame(update);
            });

            // Chart Configuration
            const mainCtx = document.getElementById('mainChart').getContext('2d');
            const mainGrad = mainCtx.createLinearGradient(0, 0, 0, 400);
            mainGrad.addColorStop(0, 'rgba(99, 102, 241, 0.3)');
            mainGrad.addColorStop(1, 'rgba(99, 102, 241, 0)');

            new Chart(mainCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($revenueDates) !!},
                    datasets: [{
                        label: 'Revenue',
                        data: {!! json_encode($revenueData) !!},
                        borderColor: '#6366f1',
                        borderWidth: 4,
                        fill: true,
                        backgroundColor: mainGrad,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#6366f1',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { grid: { color: 'rgba(255,255,255,0.03)' }, ticks: { color: '#64748B' } },
                        x: { grid: { display: false }, ticks: { color: '#64748B' } }
                    }
                }
            });

            const donutCtx = document.getElementById('donutChart').getContext('2d');
            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Pending', 'Rejected'],
                    datasets: [{
                        data: [
                                {{ $orderStatusChart['Completed'] ?? 0 }},
                                {{ $orderStatusChart['Pending'] ?? 0 }},
                            {{ $orderStatusChart['Rejected'] ?? 0 }}
                        ],
                        backgroundColor: ['#10b981', '#f59e0b', '#f43f5e'],
                        borderWidth: 0,
                        hoverOffset: 15
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '80%',
                    plugins: { legend: { display: false } }
                }
            });
        });
    </script>
@endsection