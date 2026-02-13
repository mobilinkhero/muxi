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

        @media (max-width: 768px) {
            .chart-container {
                height: 200px;
            }
        }


        body {
            background: var(--dark);
            color: var(--white);
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: var(--dark-light);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 2rem;
            width: calc(100% - 250px);
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

    <aside class="sidebar">
        <div style="text-align: center; margin-bottom: 2rem;">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" style="height: 40px;">
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
                class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                Orders
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

</body>

</html>