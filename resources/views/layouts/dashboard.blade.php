<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Student Dashboard') - GSM Trading Lab</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

            .sidebar .logo {
                margin: 0 !important;
            }

            .sidebar-close-btn {
                display: block !important;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <!-- Announcement Ticker -->
    @if((isset($settings['announcement_ticker']) && $settings['announcement_ticker']) || (isset($settings['announcement_ticker_2']) && $settings['announcement_ticker_2']))
        <div
            style="background: #10B981; color: #000; padding: 0.6rem 0; font-weight: 800; font-size: 0.85rem; position: sticky; top: 0; z-index: 999; overflow: hidden; white-space: nowrap;">
            <div style="display: inline-block; padding-left: 100%; animation: student-ticker 40s linear infinite;">
                @if(isset($settings['announcement_ticker']) && $settings['announcement_ticker'])
                    <span style="margin-right: 50px;">📢 IMPORTANT: {{ $settings['announcement_ticker'] }}</span>
                @endif

                @if(isset($settings['announcement_ticker_2']) && $settings['announcement_ticker_2'])
                    <span style="margin-right: 50px; color: #991b1b;">🚨 ALERT: {{ $settings['announcement_ticker_2'] }}</span>
                @endif

                @if(isset($settings['announcement_ticker']) && $settings['announcement_ticker'])
                    <span style="margin-right: 50px;">📢 IMPORTANT: {{ $settings['announcement_ticker'] }}</span>
                @endif

                @if(isset($settings['announcement_ticker_2']) && $settings['announcement_ticker_2'])
                    <span style="margin-right: 50px; color: #991b1b;">🚨 ALERT: {{ $settings['announcement_ticker_2'] }}</span>
                @endif
            </div>
        </div>
    @endif

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

    @if(session()->has('impersonated_by'))
        <div
            style="background: linear-gradient(90deg, #6366f1, #a855f7); padding: 10px; text-align: center; color: white; font-weight: bold; position: sticky; top: 0; z-index: 9999; display: flex; align-items: center; justify-content: center; gap: 1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
            <i class="fas fa-user-secret"></i>
            <span>Currently viewing as <strong>{{ auth()->user()->name }}</strong></span>
            <form action="{{ route('admin.users.stop-impersonate') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit"
                    style="background: white; color: #6366f1; border: none; padding: 5px 15px; border-radius: 8px; font-size: 0.8rem; font-weight: 800; cursor: pointer; transition: 0.3s;"
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <i class="fas fa-sign-out-alt"></i> Return to Admin Terminal
                </button>
            </form>
        </div>
    @endif

    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div style="margin-bottom: 2.5rem; text-align: center;">
                <a href="/" class="logo">
                    <img src="{{ asset('images/logo.svg') }}" alt="Logo" style="height: 42px;">
                </a>
            </div>

            <div
                style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2.5rem; padding: 1rem; background: rgba(255,255,255,0.03); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05); position: relative; overflow: hidden;">
                <div
                    style="position: absolute; top: 0; right: 0; width: 40px; height: 40px; background: var(--gradient-crypto); opacity: 0.1; border-radius: 0 0 0 100%;">
                </div>
                <img src="{{ auth()->user()->avatar_url }}"
                    style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary); box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);">
                <div style="overflow: hidden; flex: 1;">
                    <div
                        style="color: white; font-weight: 700; font-size: 0.95rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ auth()->user()->name }}
                    </div>
                    <div
                        style="color: var(--secondary); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">
                        Student Portal</div>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a></li>
                <li><a href="{{ route('profile.edit') }}"
                        class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                        <i class="fas fa-user-edit"></i> Profile
                    </a></li>
                <li><a href="{{ route('dashboard.courses') }}"
                        class="{{ request()->is('dashboard/courses') ? 'active' : '' }}">
                        <i class="fas fa-graduation-cap"></i> My Training
                    </a></li>
                <li><a href="{{ route('dashboard.stats') }}"
                        class="{{ request()->is('dashboard/learning-stats') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i> My Stats
                    </a></li>
                <li><a href="/trade">
                        <i class="fas fa-wave-square"></i> Live Signals
                    </a></li>
                <li><a href="{{ route('p2p.index') }}" class="{{ request()->routeIs('p2p.index') ? 'active' : '' }}">
                        <i class="fas fa-handshake" style="color: #10B981;"></i> P2P Exchange
                    </a></li>
                <li><a href="/invest">
                        <i class="fas fa-wallet"></i> Investments
                    </a></li>

                @if(auth()->user()->is_admin)
                    <li style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05);">
                        <a href="{{ route('admin.dashboard') }}"
                            style="color: #F59E0B; background: rgba(245, 158, 11, 0.05);">
                            <i class="fas fa-terminal"></i> Admin Panel
                        </a>
                    </li>
                @endif
            </ul>

            <div style="margin-top: auto; padding-top: 1rem;">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                        style="color: #ef4444; display: flex; align-items: center; gap: 1rem; padding: 1rem; text-decoration: none; border-radius: 12px; transition: 0.3s;"
                        onmouseover="this.style.background='rgba(239, 68, 68, 0.1)'"
                        onmouseout="this.style.background='transparent'">
                        <i class="fas fa-power-off"></i> Logout
                    </a>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Mobile Top Bar -->
            <div class="mobile-header"
                style="display: none; justify-content: space-between; align-items: center; margin-bottom: 2rem; padding: 1rem; background: var(--dark-light); border-radius: 16px; border: 1px solid rgba(255,255,255,0.05);">
                <a href="/"><img src="/images/logo.svg" style="height: 30px;"></a>
                <div style="display: flex; gap: 0.75rem; align-items: center;">
                    <img src="{{ auth()->user()->avatar_url }}"
                        style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid var(--primary);">
                    <button onclick="toggleSidebar()"
                        style="background:rgba(255,255,255,0.05); border:none; color:white; width:40px; height:40px; display:flex; align-items:center; justify-content:center; border-radius: 10px; cursor: pointer;">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
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
    @include('partials.mobile-nav')
    @include('partials.security-script')
    @include('partials.animations')
    @stack('scripts')
</body>

</html>