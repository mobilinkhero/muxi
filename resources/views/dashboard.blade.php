<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - GSM Trading Lab</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        /* Custom Dashboard Styles */
        :root {
            --sidebar-width: 260px;
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            min-height: 100vh;
        }

        .sidebar {
            background: rgba(15, 23, 42, 0.95);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            padding: 2rem;
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            padding: 2.5rem;
            background: var(--dark);
        }

        .sidebar-menu {
            list-style: none;
            margin-top: 3rem;
            flex: 1;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            color: var(--gray);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.85rem 1rem;
            border-radius: var(--radius-sm);
            transition: var(--transition-fast);
            font-weight: 500;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.1), transparent);
            color: var(--white);
            border-left: 3px solid var(--primary);
        }

        .dashboard-card {
            background: var(--dark-light);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            height: 100%;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Signal Card Enhancements */
        .signal-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-md);
            padding: 1.25rem;
            margin-bottom: 1rem;
            position: relative;
            transition: var(--transition-fast);
        }

        .signal-card:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .signal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .signal-body {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            font-size: 0.9rem;
        }

        .signal-label {
            color: var(--gray);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .signal-value {
            font-family: 'Space Mono', monospace;
            font-weight: 600;
            color: var(--white);
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            .sidebar {
                display: none; /* Hide sidebar on mobile for now, add toggler later if needed */
            }
            .mobile-header {
                display: flex;
                padding: 1rem;
                background: var(--dark-light);
                align-items: center;
                justify-content: space-between;
            }
            .dashboard-grid-layout {
                grid-template-columns: 1fr !important;
            }
            .main-content {
                padding: 1.5rem;
            }
        }
        
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge-success { background: rgba(16, 185, 129, 0.2); color: #10b981; }
        .badge-warning { background: rgba(245, 158, 11, 0.2); color: #f59e0b; }
        .badge-danger { background: rgba(239, 68, 68, 0.2); color: #ef4444; }
        
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

    </style>
</head>

<body>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="/" class="logo" style="margin-bottom: 2rem;">
                <embed src="/images/logo.svg" type="image/svg+xml" style="height: 35px;">
            </a>

            <ul class="sidebar-menu">
                <li><a href="#" class="active"><span>📊</span> Dashboard</a></li>
                <li><a href="/learn"><span>📚</span> My Courses</a></li>
                <li><a href="/trade"><span>📈</span> Live Signals</a></li>
                <li><a href="/invest"><span>💼</span> Investments</a></li>
            </ul>

            <div style="margin-top: auto; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.5rem;">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()" style="color: #ef4444;">
                        <span>🚪</span> Logout
                    </a>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Mobile Header (Visible only on mobile) -->
            <div class="mobile-header" style="display: none; margin-bottom: 2rem;">
                 <a href="/" class="logo"><embed src="/images/logo.svg" type="image/svg+xml" style="height: 30px;"></a>
                 <button onclick="document.querySelector('.sidebar').style.display = 'flex'; document.querySelector('.sidebar').style.position = 'fixed'; document.querySelector('.sidebar').style.zIndex = '1000'; document.querySelector('.sidebar').style.width = '100%'; document.querySelector('.sidebar').style.height = '100%';" style="background:#333; border:none; color:white; padding:0.5rem; font-size: 1.5rem;">☰</button>
            </div>

            <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="margin-bottom: 0.5rem; font-size: 1.8rem;">Welcome back, <span style="background: linear-gradient(to right, #fff, #9CA3AF); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $user->name }}</span>!</h1>
                    <p style="color: var(--gray);">Here's your trading overview for today.</p>
                </div>
                <div>
                    @php
                        $hasPremium = $orders->where('status', 'completed')->isNotEmpty();
                    @endphp
                    <div style="display: inline-flex; align-items: center; background: {{ $hasPremium ? 'rgba(16, 185, 129, 0.1)' : 'rgba(255, 255, 255, 0.05)' }}; padding: 0.5rem 1rem; border-radius: 50px; border: 1px solid {{ $hasPremium ? 'rgba(16, 185, 129, 0.2)' : 'rgba(255,255,255,0.1)' }};">
                        <span style="width: 8px; height: 8px; background: {{ $hasPremium ? '#10B981' : '#cbd5e1' }}; border-radius: 50%; margin-right: 8px; animation: {{ $hasPremium ? 'pulse 2s infinite' : 'none' }}"></span>
                        <span style="font-size: 0.85rem; font-weight: 600; color: {{ $hasPremium ? '#10B981' : 'var(--gray-light)' }}">{{ $hasPremium ? 'Premium Active' : 'Standard Plan' }}</span>
                    </div>
                </div>
            </header>

            <!-- Stats Overview -->
            <div class="stats-grid">
                <div class="dashboard-card" style="text-align: center;">
                    <div class="stat-number" style="font-size: 2.5rem; font-weight: 800; color: var(--white); margin-bottom: 0.25rem;">{{ $orders->count() }}</div>
                    <div class="stat-label" style="color: var(--gray); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Enrolled Courses</div>
                </div>
                <div class="dashboard-card" style="text-align: center;">
                    <div class="stat-number" style="font-size: 2.5rem; font-weight: 800; color: #10B981; margin-bottom: 0.25rem;">{{ $totalSignals ?? '0' }}</div>
                    <div class="stat-label" style="color: var(--gray); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Signals Available</div>
                </div>
                <div class="dashboard-card" style="text-align: center;">
                    <div class="stat-number" style="font-size: 2.5rem; font-weight: 800; color: var(--primary-light); margin-bottom: 0.25rem;">{{ $hasPremium ? 'VIP' : 'Free' }}</div>
                    <div class="stat-label" style="color: var(--gray); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Membership Status</div>
                </div>
            </div>

            <!-- Active Signals Section -->
            <div style="margin-bottom: 3rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2 style="font-size: 1.4rem; display: flex; align-items: center; gap: 10px;">
                        <span style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%; animation: pulse 1.5s infinite;"></span>
                        Live Signals
                    </h2>
                    <a href="/trade" style="color: var(--primary-light); text-decoration: none; font-size: 0.9rem; font-weight: 600; display: flex; align-items: center; gap: 5px;">View All <span>→</span></a>
                </div>

                @if($activeSignals->count() > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                        @foreach($activeSignals->take(3) as $signal)
                            <div class="signal-card" style="border-left: 4px solid {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }};">
                                <div class="signal-header">
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <div style="font-size: 2rem; line-height: 1;">{{ $signal->type == 'BUY' ? '🟢' : '🔴' }}</div>
                                        <div>
                                            <h3 style="margin: 0; font-size: 1.2rem; color: var(--white); font-weight: 700;">{{ $signal->symbol }}</h3>
                                            <span style="color: {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }}; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">
                                                {{ $signal->type }} MARKET
                                            </span>
                                        </div>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 0.75rem; color: var(--gray); background: rgba(255,255,255,0.05); padding: 2px 8px; border-radius: 4px;">{{ $signal->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                                <div class="signal-body">
                                    <div>
                                        <div class="signal-label">Entry Price</div>
                                        <div class="signal-value">{{ $signal->entry_price }}</div>
                                    </div>
                                    <div>
                                        <div class="signal-label">TP1</div>
                                        <div class="signal-value" style="color: #10B981;">{{ $signal->take_profit_1 }}</div>
                                    </div>
                                    <div>
                                        <div class="signal-label">Stop Loss</div>
                                        <div class="signal-value" style="color: #ef4444;">{{ $signal->stop_loss }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 4rem; background: rgba(255, 255, 255, 0.02); border-radius: var(--radius-md); border: 1px dashed rgba(255, 255, 255, 0.1);">
                        <div style="font-size: 2rem; margin-bottom: 1rem;">😴</div>
                        <p style="color: var(--gray); font-size: 1.1rem;">No active signals right now.</p>
                        <p style="color: var(--gray-light); font-size: 0.9rem;">Market is quiet. Check back later or review your courses.</p>
                    </div>
                @endif
            </div>

            <!-- Dashboard Grid -->
            <div class="dashboard-grid-layout" style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                
                <!-- Recent Orders -->
                <div>
                    <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">📜 Recent Activity</h3>
                    <div class="dashboard-card" style="padding: 0; overflow: hidden;">
                        @if($orders->count() > 0)
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                                    <thead style="background: rgba(255, 255, 255, 0.03);">
                                        <tr>
                                            <th style="padding: 1rem; text-align: left; font-size: 0.85rem; color: var(--gray); font-weight: 600;">Service Plan</th>
                                            <th style="padding: 1rem; text-align: left; font-size: 0.85rem; color: var(--gray); font-weight: 600;">Enrollment Date</th>
                                            <th style="padding: 1rem; text-align: left; font-size: 0.85rem; color: var(--gray); font-weight: 600;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders->take(5) as $order)
                                            <tr style="border-top: 1px solid rgba(255,255,255,0.05);">
                                                <td style="padding: 1rem; font-weight: 500;">{{ $order->service_name }}</td>
                                                <td style="padding: 1rem; color: var(--gray);">{{ $order->created_at->format('M d, Y') }}</td>
                                                <td style="padding: 1rem;">
                                                    @if($order->status == 'completed')
                                                        <span class="badge badge-success">Active</span>
                                                    @elseif($order->status == 'pending')
                                                        <span class="badge badge-warning">Pending Review</span>
                                                    @else
                                                        <span class="badge badge-danger">{{ ucfirst($order->status) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div style="text-align: center; padding: 3rem;">
                                <p style="color: var(--gray); margin-bottom: 1rem;">Start your journey today.</p>
                                <a href="/learn" class="btn btn-primary btn-sm">Browse Courses</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Suggested Actions Sidebar -->
                <div>
                    <div class="dashboard-card" style="margin-bottom: 1.5rem;">
                        <h4 style="margin-bottom: 1.25rem; font-size: 1.1rem;">⚡ Quick Actions</h4>
                        <div style="display: grid; gap: 0.75rem;">
                            <a href="/trade" style="display: flex; align-items: center; justify-content: center; padding: 0.85rem; background: rgba(99, 102, 241, 0.1); color: var(--primary-light); text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(99, 102, 241, 0.2); font-weight: 600; transition: 0.2s;">
                                📱 Join Telegram
                            </a>
                            <a href="/learn" style="display: flex; align-items: center; justify-content: center; padding: 0.85rem; background: rgba(255, 255, 255, 0.03); color: var(--white); text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(255, 255, 255, 0.1); font-weight: 600; transition: 0.2s;">
                                📚 Continue Learning
                            </a>
                            <a href="/contact" style="display: flex; align-items: center; justify-content: center; padding: 0.85rem; background: rgba(255, 255, 255, 0.03); color: var(--white); text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(255, 255, 255, 0.1); font-weight: 600; transition: 0.2s;">
                                📞 Contact Support
                            </a>
                        </div>
                    </div>

                    <div class="dashboard-card" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0)); border: 1px solid rgba(16, 185, 129, 0.2);">
                        <h4 style="margin-bottom: 0.5rem; font-size: 1.1rem; color: #10B981;">💡 Pro Tip</h4>
                        <p style="font-size: 0.9rem; color: var(--gray-light); line-height: 1.6;">
                            Never risk more than 1-2% of your portfolio on a single trade. Consistency is better than luck.
                        </p>
                    </div>
                </div>

            </div>
        </main>
    </div>
    
    <script>
        // Simple Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', () => {
             const style = document.createElement('style');
             style.innerHTML = `
                @media (max-width: 900px) {
                    .mobile-header { display: flex !important; }
                    .sidebar { display: none; }
                }
             `;
             document.head.appendChild(style);
        });
    </script>

    @include('partials.security-script')

</body>
</html>