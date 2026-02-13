<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Dashboard') - GSM Trading Lab</title>
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
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }

            70% {
                box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        @media (max-width: 900px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .main-content {
                padding: 1.5rem;
            }

            .mobile-header {
                display: flex !important;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Announcement Ticker -->
    @if(isset($settings['announcement_ticker']) && $settings['announcement_ticker'])
        <div
            style="background: #10B981; color: #000; padding: 0.6rem 0; font-weight: 800; font-size: 0.85rem; position: sticky; top: 0; z-index: 999; overflow: hidden; white-space: nowrap;">
            <div style="display: inline-block; padding-left: 100%; animation: student-ticker 30s linear infinite;">
                <span style="margin-right: 50px;">📢 IMPORTANT: {{ $settings['announcement_ticker'] }}</span>
                <span style="margin-right: 50px;">📢 IMPORTANT: {{ $settings['announcement_ticker'] }}</span>
                <span style="margin-right: 50px;">📢 IMPORTANT: {{ $settings['announcement_ticker'] }}</span>
            </div>
        </div>
        <style>
            @keyframes student-ticker {
                0% {
                    transform: translate3d(0, 0, 0);
                }

                100% {
                    transform: translate3d(-100%, 0, 0);
                }
            }
        </style>
    @endif

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="/" class="logo" style="margin-bottom: 2rem;">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" style="height: 35px;">
            </a>

            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}"
                        class="{{ request()->is('dashboard') ? 'active' : '' }}"><span>📊</span> Dashboard</a></li>
                <li><a href="{{ route('dashboard.courses') }}"
                        class="{{ request()->is('dashboard/courses') ? 'active' : '' }}"><span>📚</span> My Training</a>
                </li>
                <li><a href="{{ route('dashboard.stats') }}"
                        class="{{ request()->is('dashboard/learning-stats') ? 'active' : '' }}"><span>🎓</span> My
                        Stats</a></li>
                <li><a href="/trade"><span>📈</span> Live Signals</a></li>
                <li><a href="{{ route('p2p.index') }}"
                        class="{{ request()->routeIs('p2p.index') ? 'active' : '' }}"><span
                            style="color: #10B981;">💱</span> P2P Exchange</a></li>
                <li><a href="/invest"><span>💼</span> Investments</a></li>

                @if(auth()->check() && auth()->user()->is_admin)
                    <li style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
                        <a href="{{ route('admin.dashboard') }}" style="color: #F59E0B;">
                            <span>🔐</span> Admin Panel
                        </a>
                    </li>
                @endif
            </ul>

            <div style="margin-top: auto; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.5rem;">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                        style="color: #ef4444; display: flex; align-items: center; gap: 1rem; padding: 0.85rem 1rem; text-decoration: none; font-weight: 500;">
                        <span>🚪</span> Logout
                    </a>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Mobile Header -->
            <div class="mobile-header"
                style="display: none; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <a href="/" class="logo"><embed src="/images/logo.svg" type="image/svg+xml" style="height: 30px;"></a>
                <button onclick="toggleSidebar()"
                    style="background:#333; border:none; color:white; padding:0.5rem; font-size: 1.5rem; border-radius: 4px;">☰</button>
            </div>

            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const isVisible = sidebar.style.display === 'flex';
            if (isVisible) {
                sidebar.style.display = 'none';
            } else {
                sidebar.style.display = 'flex';
                sidebar.style.position = 'fixed';
                sidebar.style.zIndex = '1000';
                sidebar.style.width = '100%';
                sidebar.style.height = '100%';
            }
        }
    </script>
    @include('partials.security-script')
    @stack('scripts')
</body>

</html>