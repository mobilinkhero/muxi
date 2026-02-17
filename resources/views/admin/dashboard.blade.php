@extends('layouts.admin')

@section('title', 'Quantum Overview')@section('content')<!-- Dashboard Header -->
    <div class="h-reveal" style="margin-bottom: 4rem;">
        <h1 style="font-weight: 900; font-size: 3.5rem; letter-spacing: -2px; margin: 0; background: linear-gradient(to right, #fff, #94a3b8); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Quantum Control</h1>
        <p style="color: #64748B; font-size: 1.1rem; margin-top: 0.5rem; font-weight: 500;">Real-time administrative nexus and neural network analytics.</p>
    </div>

    <!-- Stats Cards: High Contrast Vibrant -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem; margin-bottom: 4rem;">
        <div class="h-card h-reveal" style="border-left: 6px solid var(--primary);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
                <div style="width: 60px; height: 60px; border-radius: 20px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.6rem; box-shadow: 0 10px 20px rgba(99,102,241,0.1);">
                    <i class="fas fa-users-rays"></i>
                </div>
                <div style="font-family: 'JetBrains Mono'; font-size: 0.7rem; font-weight: 800; color: #10b981; background: rgba(16, 185, 129, 0.1); padding: 5px 12px; border-radius: 50px;">+24% SYNC</div>
            </div>
            <div style="color: #94A3B8; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">Global Operatives</div>
            <div style="font-size: 3.5rem; font-weight: 900; margin-top: 0.5rem; color: #fff; letter-spacing: -1px;" class="luxe-counter" data-target="{{ $totalUsers ?? 0 }}">0</div>
        </div>

        <div class="h-card h-reveal" style="border-left: 6px solid #f43f5e;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
                <div style="width: 60px; height: 60px; border-radius: 20px; background: rgba(244, 63, 94, 0.1); display: flex; align-items: center; justify-content: center; color: #f43f5e; font-size: 1.6rem; box-shadow: 0 10px 20px rgba(244,63,94,0.1);">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <span class="status-pill" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: none;">LIVE_FLUX</span>
            </div>
            <div style="color: #94A3B8; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">Network Revenue</div>
            <div style="font-size: 3.5rem; font-weight: 900; margin-top: 0.5rem; color: #fff; letter-spacing: -1px;">${{ number_format($totalRevenue ?? 0, 0) }}</div>
        </div>

        <div class="h-card h-reveal" style="border-left: 6px solid #0ea5e9;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
                <div style="width: 60px; height: 60px; border-radius: 20px; background: rgba(14, 165, 233, 0.1); display: flex; align-items: center; justify-content: center; color: #0ea5e9; font-size: 1.6rem; box-shadow: 0 10px 20px rgba(14,165,233,0.1);">
                    <i class="fas fa-wave-square"></i>
                </div>
            </div>
            <div style="color: #94A3B8; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; font-weight: 700;">Pending Protocols</div>
            <div style="font-size: 3.5rem; font-weight: 900; margin-top: 0.5rem; color: #fff; letter-spacing: -1px;" class="luxe-counter" data-target="{{ $pendingOrders ?? 0 }}">0</div>
        </div>
    </div>

    <!-- Analytics Section: High Contrast -->
    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 2.5rem; margin-bottom: 4rem;">
        <div class="h-card h-reveal">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
                <h3 style="margin: 0; font-weight: 800; font-size: 1.5rem; display: flex; align-items: center; gap: 15px;">
                    <i class="fas fa-fire" style="color: #f43f5e;"></i> Transmission Velocity
                </h3>
            </div>
            <div style="height: 450px;">
                <canvas id="luxChart"></canvas>
            </div>
        </div>

        <div class="h-card h-reveal">
            <h3 style="margin-bottom: 3rem; font-weight: 800; font-size: 1.5rem;">Protocol Efficiency</h3>
            <div style="height: 320px;">
                <canvas id="donutLuxe"></canvas>
            </div>
            <div style="margin-top: 3rem; background: rgba(255, 255, 255, 0.03); border-radius: 24px; padding: 1.5rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: #94A3B8; font-weight: 600;">Optimal Links</span>
                    <span style="color: #10b981; font-family: 'JetBrains Mono'; font-weight: 800;">{{ $orderStatusChart['Completed'] ?? 0 }}</span>
                </div>
                <div style="display: flex; justify-content: space-between;">
                    <span style="color: #94A3B8; font-weight: 600;">Unstable Streams</span>
                    <span style="color: #f59e0b; font-family: 'JetBrains Mono'; font-weight: 800;">{{ $orderStatusChart['Pending'] ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="h-card h-reveal">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
            <h3 style="margin: 0; font-weight: 800; font-size: 1.5rem; display: flex; align-items: center; gap: 15px;">
                <i class="fas fa-fingerprint" style="color: var(--vibrant-1);"></i> Live Neural Feed
            </h3>
            <a href="{{ route('admin.orders.index') }}" class="btn-luxe" style="padding: 0.6rem 1.4rem; font-size: 0.8rem; box-shadow: none;">DEEP_SCAN →</a>
        </div>
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr style="background: transparent;">
                        <th style="color: #64748B; font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; padding: 1.5rem;">OPERATIVE</th>
                        <th style="color: #64748B; font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; padding: 1.5rem;">PROTOCOL</th>
                        <th style="color: #64748B; font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; padding: 1.5rem;">VOLUME</th>
                        <th style="color: #64748B; font-weight: 800; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px; padding: 1.5rem;">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders->take(8) as $order)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 14px;">
                                    <div style="width: 38px; height: 38px; border-radius: 12px; background: rgba(99, 102, 241, 0.1); display: flex; align-items: center; justify-content: center; font-weight: 900; color: var(--primary);">{{ substr($order->user->name, 0, 1) }}</div>
                                    <div>
                                        <div style="font-weight: 800; color: #fff;">{{ $order->user->name }}</div>
                                        <div style="font-size: 0.75rem; color: #64748B;">{{ $order->user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-weight: 700; color: #fff;">{{ $order->service_name }}</td>
                            <td style="font-family: 'JetBrains Mono'; font-weight: 800; color: var(--primary);">${{ number_format($order->amount, 2) }}</td>
                            <td>
                                <span class="status-pill" style="background: {{ $order->status == 'completed' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(245, 158, 11, 0.1)' }}; color: {{ $order->status == 'completed' ? '#10b981' : '#f59e0b' }}; border: none;">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="text-align: center; padding: 4rem; color: #64748B;">NO_SIGNAL_STREAMS</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Counter Animation
            const luxeCounters = document.querySelectorAll('.luxe-counter');
            luxeCounters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const update = () => {
                    const current = +counter.innerText;
                    const increment = target / 50;
                    if (current < target) {
                        counter.innerText = Math.ceil(current + increment);
                        setTimeout(update, 30);
                    } else {
                        counter.innerText = target;
                    }
                };
                update();
            });

            // Chart Configuration
            const luxCtx = document.getElementById('luxChart').getContext('2d');
            const luxGrad = luxCtx.createLinearGradient(0, 0, 0, 400);
            luxGrad.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
            luxGrad.addColorStop(1, 'rgba(99, 102, 241, 0)');

            new Chart(luxCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($revenueDates) !!},
                    datasets: [{
                        data: {!! json_encode($revenueData) !!},
                        borderColor: '#6366f1',
                        borderWidth: 5,
                        fill: true,
                        backgroundColor: luxGrad,
                        tension: 0.4,
                        pointRadius: 0,
                        pointHoverRadius: 10,
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#6366f1'
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

            const donutCtx = document.getElementById('donutLuxe').getContext('2d');
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
                        hoverOffset: 20
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '85%',
                    plugins: { legend: { display: false } }
                }
            });
        });
    </script>
@endsection