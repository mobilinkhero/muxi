<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - GSM Trading Lab</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --h-bg: #020617;
            --h-sidebar: rgba(15, 23, 42, 0.8);
            --h-card: rgba(15, 23, 42, 0.4);
            --h-border: rgba(255, 255, 255, 0.08);
            --h-primary: #6366F1;
            --h-secondary: #10B981;
            --h-accent: #EC4899;
            --font-h: 'Outfit', sans-serif;
        }

        body {
            background: var(--h-bg);
            color: #F8FAFC;
            font-family: var(--font-h);
            display: flex;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        /* Animated Ambient Orbs */
        .h-orb {
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.1;
            pointer-events: none;
        }

        .h-orb-1 { background: var(--h-primary); top: -10%; right: -10%; }
        .h-orb-2 { background: var(--h-accent); bottom: -10%; left: -10%; }

        .sidebar {
            width: 280px;
            background: var(--h-sidebar);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid var(--h-border);
            padding: 2.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 100;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .main-content {
            padding: 3rem;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.25rem;
            color: #94A3B8;
            text-decoration: none;
            border-radius: 16px;
            margin-bottom: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 600;
            font-size: 0.95rem;
            gap: 12px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.03);
            color: white;
            transform: translateX(5px);
        }

        .nav-link.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--h-primary);
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 3rem;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--h-border);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .card {
            background: var(--h-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--h-border);
            border-radius: 28px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 992px) {
            .sidebar {
                position: fixed;
                left: -280px;
                transition: 0.3s;
            }
            .sidebar.show { left: 0; }
            .main-content { padding: 1.5rem; }
            .top-bar { padding: 1rem 1.5rem; }
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--h-border);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--h-bg); }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
    </style>
    @yield('styles')
</head>

<body>
    <div class="h-orb h-orb-1"></div>
    <div class="h-orb h-orb-2"></div>

    <aside class="sidebar" id="sidebar">
        <div style="margin-bottom: 3rem; padding-left: 0.5rem;">
            <a href="{{ route('admin.dashboard') }}" style="text-decoration: none; display: flex; align-items: center; gap: 12px;">
                <div style="width: 40px; height: 40px; background: var(--h-primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 900;">G</div>
                <span style="font-weight: 900; font-size: 1.25rem; color: white; letter-spacing: -0.5px;">ADMIN_CORE</span>
            </a>
        </div>

        <nav style="flex: 1;">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> User Matrix
            </a>
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fas fa-shopping-cart"></i> Order Stream
            </a>
            <a href="{{ route('admin.signals.index') }}" class="nav-link {{ request()->routeIs('admin.signals.*') ? 'active' : '' }}">
                <i class="fas fa-bolt"></i> Live Signals
            </a>
            <a href="/youcanthackme/p2p-transactions" class="nav-link {{ request()->is('youcanthackme/p2p-transactions*') ? 'active' : '' }}">
                <i class="fas fa-exchange-alt"></i> P2P Portal
            </a>
            <a href="/youcanthackme/p2p-pools" class="nav-link {{ request()->is('youcanthackme/p2p-pools*') ? 'active' : '' }}">
                <i class="fas fa-vault"></i> Liquidity Pools
            </a>
            <a href="/youcanthackme/live-classes" class="nav-link {{ request()->is('youcanthackme/live-classes*') ? 'active' : '' }}">
                <i class="fas fa-broadcast-tower"></i> Live Classes
            </a>
            <a href="/youcanthackme/class-recordings" class="nav-link {{ request()->is('youcanthackme/class-recordings*') ? 'active' : '' }}">
                <i class="fas fa-play-circle"></i> Academy Logs
            </a>
            <a href="{{ route('admin.security.logs') }}" class="nav-link {{ request()->routeIs('admin.security.logs') ? 'active' : '' }}">
                <i class="fas fa-shield-halved"></i> Security Logs
            </a>
        </nav>

        <div style="margin-top: auto; padding-top: 2rem; border-top: 1px solid var(--h-border);">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="fas fa-external-link-alt"></i> Student Panel
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link" style="width: 100%; border: none; background: transparent; cursor: pointer; text-align: left;">
                    <i class="fas fa-power-off"></i> Terminate Session
                </button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="top-bar">
            <button class="mobile-toggle" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="fas fa-bars"></i>
            </button>
            <div style="display: flex; align-items: center; gap: 2rem;">
                <div style="color: #94A3B8; font-size: 0.85rem; font-family: 'JetBrains Mono';">SYSTEM_STATUS: <span style="color: var(--h-secondary);">OPTIMAL</span></div>
            </div>
            <div style="display: flex; align-items: center; gap: 1.5rem;">
                <div style="text-align: right;">
                    <div style="font-weight: 700; color: white;">{{ auth()->user()->name }}</div>
                    <div style="font-size: 0.75rem; color: #94A3B8;">OPERATOR_ID: #{{ auth()->id() }}</div>
                </div>
                <div style="width: 40px; height: 40px; border-radius: 12px; background: rgba(99, 102, 241, 0.1); border: 1px solid var(--h-primary); display: flex; align-items: center; justify-content: center; color: var(--h-primary); font-weight: 900;">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <main class="main-content">
            @if(session('success'))
                <div class="card" style="border-color: var(--h-secondary); background: rgba(16, 185, 129, 0.05); color: var(--h-secondary); padding: 1rem 2rem; margin-bottom: 2rem;">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="card" style="border-color: #ef4444; background: rgba(239, 68, 68, 0.05); color: #ef4444; padding: 1rem 2rem; margin-bottom: 2rem;">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>

</html>