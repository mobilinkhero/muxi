<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - GSM Trading Lab</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.4);
            --secondary: #06b6d4;
            --accent: #f43f5e;
            --bg-dark: #020617;
            --sidebar-bg: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.5);
            --border: rgba(255, 255, 255, 0.08);
            --text-main: #f8fafc;
            --text-dim: #94a3b8;
            --font-main: 'Outfit', sans-serif;
            --font-secondary: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: var(--font-main);
            margin: 0;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            background-image:
                radial-gradient(circle at 0% 0%, rgba(99, 102, 241, 0.12) 0%, transparent 40%),
                radial-gradient(circle at 100% 100%, rgba(6, 182, 212, 0.1) 0%, transparent 40%);
        }

        /* 3D Glass Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            border-radius: 20px;
            border: 2px solid var(--bg-dark);
        }

        /* Styling Sidebar as a Premium Floating Deck */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            padding: 2.5rem 1.25rem;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 100;
            box-shadow: 20px 0 50px rgba(0, 0, 0, 0.3);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 3.5rem;
            padding-left: 0.5rem;
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1.4rem;
            color: white;
            box-shadow: 0 10px 25px var(--primary-glow);
            transform: perspective(100px) rotateY(10deg);
        }

        .brand-text {
            font-weight: 800;
            font-size: 1.3rem;
            letter-spacing: -0.5px;
            background: linear-gradient(to bottom, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-group {
            margin-bottom: 2rem;
        }

        .nav-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #475569;
            font-weight: 800;
            margin: 0 0 1rem 1rem;
            display: block;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.9rem 1.1rem;
            color: var(--text-dim);
            text-decoration: none;
            border-radius: 14px;
            margin-bottom: 0.4rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            font-weight: 600;
            font-size: 0.95rem;
            gap: 12px;
        }

        .nav-link i {
            font-size: 1.1rem;
            width: 22px;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(10px) scale(1.05);
        }

        .nav-link.active {
            color: white;
            background: linear-gradient(to right, rgba(99, 102, 241, 0.2), transparent);
            box-shadow: inset 4px 0 0 var(--primary);
        }

        .nav-link.active i {
            color: var(--primary);
        }

        /* Main Context Area */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        .top-deck {
            padding: 1.5rem 3.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(2, 6, 23, 0.6);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 15px #10b981;
            animation: pulse-ring 2s infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(3);
                opacity: 0;
            }
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border);
            padding: 6px 16px 6px 6px;
            border-radius: 100px;
            cursor: pointer;
            transition: 0.3s;
        }

        .user-pill:hover {
            background: rgba(255, 255, 255, 0.07);
            transform: translateY(-2px);
        }

        .avatar-circle {
            width: 32px;
            height: 32px;
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 0.8rem;
        }

        /* 3D Global UI Cards */
        .h-card {
            background: var(--card-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            transition: all 0.5s cubic-bezier(0.2, 1, 0.3, 1);
            position: relative;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .h-card:hover {
            transform: translateY(-12px) perspective(1000px) rotateX(2deg);
            background: rgba(40, 54, 78, 0.6);
            border-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4);
        }

        .main-content {
            padding: 3.5rem;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
        }

        .h-reveal {
            opacity: 0;
            transform: translateY(30px);
        }

        .h-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .h-table tr {
            background: rgba(255, 255, 255, 0.02);
            transition: 0.4s;
        }

        .h-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: scale(1.01);
        }

        .h-table td {
            padding: 1.5rem;
            border-top: 1px solid var(--border);
        }

        .h-table td:first-child {
            border-radius: 12px 0 0 12px;
            border-left: 1px solid var(--border);
        }

        .h-table td:last-child {
            border-radius: 0 12px 12px 0;
            border-right: 1px solid var(--border);
        }

        .btn-style {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1rem 2rem;
            border-radius: 16px;
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: 0.4s;
            border: none;
            cursor: pointer;
            box-shadow: 0 10px 20px var(--primary-glow);
        }

        .btn-style:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 40px var(--primary-glow);
        }

        .status-pill {
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.05);
        }
    </style>
    @yield('styles')
</head>

<body>
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">G</div>
            <div class="brand-text">GSM ADMIN</div>
        </div>

        <div style="overflow-y: auto; flex: 1; padding-right: 5px;">
            <div class="nav-group">
                <span class="nav-label">Management</span>
                <nav>
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Users
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                        class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                    <a href="{{ route('admin.signals.index') }}"
                        class="nav-link {{ request()->routeIs('admin.signals.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i> Trade Signals
                    </a>
                </nav>
            </div>

            <div class="nav-group">
                <span class="nav-label">Financials</span>
                <nav>
                    <a href="{{ route('admin.p2p.index') }}" class="nav-link">
                        <i class="fas fa-exchange-alt"></i> P2P Portal
                    </a>
                    <a href="{{ route('admin.payment-methods.index') }}" class="nav-link">
                        <i class="fas fa-credit-card"></i> Payments
                    </a>
                    <a href="{{ route('admin.brokers.index') }}" class="nav-link">
                        <i class="fas fa-university"></i> Brokers
                    </a>
                </nav>
            </div>

            <div class="nav-group">
                <span class="nav-label">Academy</span>
                <nav>
                    <a href="{{ route('admin.lms.classes') }}" class="nav-link">
                        <i class="fas fa-video"></i> Live Classes
                    </a>
                    <a href="{{ route('admin.lms.recordings') }}" class="nav-link">
                        <i class="fas fa-play-circle"></i> Video Logs
                    </a>
                    <a href="{{ route('admin.lms.tasks') }}" class="nav-link">
                        <i class="fas fa-tasks"></i> Student Tasks
                    </a>
                </nav>
            </div>

            <div class="nav-group">
                <span class="nav-label">Settings</span>
                <nav>
                    <a href="{{ route('admin.content.pages.index') }}" class="nav-link">
                        <i class="fas fa-file-alt"></i> Edit Content
                    </a>
                    <a href="{{ route('admin.security.logs') }}" class="nav-link">
                        <i class="fas fa-shield-alt"></i> Security
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="nav-link">
                        <i class="fas fa-cog"></i> Configuration
                    </a>
                </nav>
            </div>
        </div>

        <div style="padding-top: 1.5rem; border-top: 1px solid var(--border);">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link"
                    style="width: 100%; border: none; background: transparent; cursor: pointer;">
                    <i class="fas fa-sign-out-alt" style="color: var(--accent);"></i> Logout Now
                </button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="top-deck">
            <div style="display: flex; align-items: center; gap: 15px;">
                <div class="status-dot"></div>
                <span style="font-weight: 700; font-size: 0.9rem; color: #10B981;">Online Status: Active</span>
            </div>

            <div class="user-pill">
                <div class="avatar-circle">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div style="font-size: 0.95rem; font-weight: 700;">{{ auth()->user()->name }}</div>
                <i class="fas fa-chevron-down" style="font-size: 0.8rem; opacity: 0.5;"></i>
            </div>
        </header>

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
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
    </script>
    @yield('scripts')
</body>

</html>