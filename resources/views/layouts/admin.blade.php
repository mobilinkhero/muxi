<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - GSM Trading Lab</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>
        /* Chart JS */
        .chart-container {
            position: relative;
            margin: auto;
            height: 300px;
            width: 100%;
        }

        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                top: 0;
                height: 100vh;
                z-index: 1000;
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .mobile-toggle {
                display: block !important;
            }

            .top-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        .mobile-toggle {
            display: none;
            padding: 0.5rem;
            background: var(--dark-light);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-sm);
            color: var(--white);
            cursor: pointer;
            width: fit-content;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
            backdrop-filter: blur(4px);
        }

        .sidebar-overlay.show {
            display: block;
        }


        body {
            background: var(--dark);
            color: var(--white);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: var(--dark-light);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: calc(100vh - 40px);
            /* Adjust for ticker if needed, or just 100vh */
            overflow-y: auto;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            width: 100%;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--gray-light);
            text-decoration: none;
            border-radius: var(--radius-sm);
            margin-bottom: 0.5rem;
            transition: var(--transition-base);
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--primary);
        }

        .nav-link svg {
            margin-right: 0.75rem;
            width: 20px;
            height: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card {
            background: var(--dark-light);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th {
            color: var(--gray);
            font-weight: 600;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--gray-light);
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            background: var(--dark);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-sm);
            color: var(--white);
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Announcement Ticker -->
    @if((isset($settings['announcement_ticker']) && $settings['announcement_ticker']) || (isset($settings['announcement_ticker_2']) && $settings['announcement_ticker_2']))
        <div
            style="background: #10B981; color: #000; padding: 0.6rem 0; font-weight: 800; font-size: 0.85rem; position: sticky; top: 0; z-index: 999; overflow: hidden; white-space: nowrap;">
            <div style="display: inline-block; padding-left: 100%; animation: ticker 40s linear infinite;">
                @if(isset($settings['announcement_ticker']) && $settings['announcement_ticker'])
                    <span style="margin-right: 50px;">🚀 UPDATE: {{ $settings['announcement_ticker'] }}</span>
                @endif

                @if(isset($settings['announcement_ticker_2']) && $settings['announcement_ticker_2'])
                    <span style="margin-right: 50px; color: #991b1b;">🚨 ALERT: {{ $settings['announcement_ticker_2'] }}</span>
                @endif

                @if(isset($settings['announcement_ticker']) && $settings['announcement_ticker'])
                    <span style="margin-right: 50px;">🚀 UPDATE: {{ $settings['announcement_ticker'] }}</span>
                @endif

                @if(isset($settings['announcement_ticker_2']) && $settings['announcement_ticker_2'])
                    <span style="margin-right: 50px; color: #991b1b;">🚨 ALERT: {{ $settings['announcement_ticker_2'] }}</span>
                @endif
            </div>
        </div>
    @endif

    <style>
        @keyframes ticker {
            0% {
                transform: translate3d(0, 0, 0);
            }

            100% {
                transform: translate3d(-100%, 0, 0);
            }
        }
    </style>

    <div style="display: flex; flex: 1; position: relative;">
        <aside class="sidebar">
            <div style="text-align: center; margin-bottom: 2rem;">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" style="height: 40px;">
                <div
                    style="color: #F59E0B; font-weight: 900; font-size: 0.7rem; letter-spacing: 2px; text-transform: uppercase; margin-top: 0.75rem; border: 1px solid #F59E0B; padding: 4px 10px; border-radius: 4px; display: inline-block; background: rgba(245, 158, 11, 0.1);">
                    ADMIN PANEL
                </div>
            </div>

            <nav>
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('admin.orders.index') }}"
                    class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
                    style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Orders
                    </div>
                    @php
                        $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
                    @endphp
                    @if($pendingOrders > 0)
                        <span
                            style="background: #ef4444; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.7rem; font-weight: bold;">{{ $pendingOrders }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Users
                </a>
                <a href="{{ route('admin.signals.index') }}"
                    class="nav-link {{ request()->routeIs('admin.signals.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Signals
                </a>
                <a href="{{ route('admin.payment-methods.index') }}"
                    class="nav-link {{ request()->routeIs('admin.payment-methods.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Payment Methods
                </a>
                <a href="{{ route('admin.brokers.index') }}"
                    class="nav-link {{ request()->routeIs('admin.brokers.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    Brokers / Links
                </a>

                <div
                    style="margin: 1.5rem 0.75rem 0.5rem; font-size: 0.7rem; font-weight: 800; color: var(--gray); text-transform: uppercase; letter-spacing: 1px;">
                    Exchange & Finance</div>

                <a href="{{ route('admin.p2p.index') }}"
                    class="nav-link {{ request()->routeIs('admin.p2p.*') ? 'active' : '' }}"
                    style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                        P2P & Rates
                    </div>
                    @php
                        $pendingP2P = \App\Models\P2PTransaction::where('status', 'pending')->count();
                    @endphp
                    @if($pendingP2P > 0)
                        <span
                            style="background: #ef4444; color: white; border-radius: 50%; padding: 2px 6px; font-size: 0.7rem; font-weight: bold;">{{ $pendingP2P }}</span>
                    @endif
                </a>

                <div
                    style="margin: 1.5rem 0.75rem 0.5rem; font-size: 0.7rem; font-weight: 800; color: var(--gray); text-transform: uppercase; letter-spacing: 1px;">
                    LMS & Learning</div>

                <a href="{{ route('admin.lms.tasks') }}"
                    class="nav-link {{ request()->is('admin/lms/tasks*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Daily Tasks
                </a>

                <a href="{{ route('admin.lms.recordings') }}"
                    class="nav-link {{ request()->is('admin/lms/recordings*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    Recordings
                </a>

                <a href="{{ route('admin.lms.classes') }}"
                    class="nav-link {{ request()->is('admin/lms/classes*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    Live Classes
                </a>

                <a href="{{ route('admin.lms.student_stats') }}"
                    class="nav-link {{ request()->is('admin/lms/student-stats*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Student Stats
                </a>

                <div
                    style="margin-top: 1.5rem; margin-bottom: 0.5rem; font-size: 0.75rem; color: var(--gray); text-transform: uppercase; letter-spacing: 0.05em; padding-left: 1rem;">
                    Inquiries
                </div>

                <a href="{{ route('admin.messages.index') }}"
                    class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Contact Messages
                </a>

                <a href="{{ route('admin.consultations.index') }}"
                    class="nav-link {{ request()->routeIs('admin.consultations.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Consultations
                </a>
                <a href="{{ route('admin.profile') }}"
                    class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    My Profile
                </a>
                <div
                    style="margin: 1.5rem 0.75rem 0.5rem; font-size: 0.7rem; font-weight: 800; color: var(--gray); text-transform: uppercase; letter-spacing: 1px;">
                    Content Management</div>

                <a href="{{ route('admin.content.team.index') }}"
                    class="nav-link {{ request()->routeIs('admin.content.team.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Team Members
                </a>
                <a href="{{ route('admin.content.careers.index') }}"
                    class="nav-link {{ request()->routeIs('admin.content.careers.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Careers / Jobs
                </a>
                <a href="{{ route('admin.content.blog.index') }}"
                    class="nav-link {{ request()->routeIs('admin.content.blog.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Blog Posts
                </a>

                <a href="{{ route('admin.settings.index') }}"
                    class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Site Settings
                </a>
                <div style="border-top: 1px solid rgba(255,255,255,0.05); margin: 1rem 0;"></div>
                <a href="{{ route('dashboard') }}" class="nav-link" style="color: var(--primary-light);">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Student View
                </a>
            </nav>

            <div style="margin-top: auto;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link"
                        style="width: 100%; border: none; background: transparent; cursor: pointer; color: #ef4444;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <button class="mobile-toggle" onclick="toggleSidebar()">
                <svg style="width: 24px; height: 24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="top-bar">
                <h2>@yield('header')</h2>
                <div style="display: flex; gap: 1rem;">
                    <a href="/" target="_blank" class="btn btn-secondary btn-sm">View Website</a>
                    @yield('actions')
                </div>
            </div>

            @if(session('success'))
                <div
                    style="padding: 1rem; background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #10b981; border-radius: var(--radius-sm); margin-bottom: 1.5rem;">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }
    </script>
    @yield('scripts')
</body>

</html>