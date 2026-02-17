<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quantum Admin') - GSM Trading Lab</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-deep: #050a1f;
            --primary: #6366f1;
            --secondary: #0ea5e9;
            --accent: #f43f5e;
            --vibrant-1: #c084fc;
            --vibrant-2: #38bdf8;
            --card-glass: rgba(15, 23, 42, 0.4);
            --sidebar-glass: rgba(8, 14, 33, 0.85);
            --border-glass: rgba(255, 255, 255, 0.1);
            --font-main: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-deep);
            color: #f8fafc;
            font-family: var(--font-main);
            margin: 0;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            background-image:
                radial-gradient(circle at 10% 20%, rgba(99, 102, 241, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(244, 63, 94, 0.1) 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, rgba(14, 165, 233, 0.05) 0%, transparent 100%);
            background-attachment: fixed;
        }

        /* Glassmorphism Global */
        .glass {
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border: 1px solid var(--border-glass);
        }

        /* Sidebar: Luxe Floating Design */
        .sidebar {
            width: 300px;
            background: var(--sidebar-glass);
            backdrop-filter: blur(30px);
            border-right: 1px solid var(--border-glass);
            padding: 2.5rem 1.5rem;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 100;
        }

        .side-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 3.5rem;
            padding-left: 0.5rem;
        }

        .logo-orb {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--vibrant-1));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 30px rgba(99, 102, 241, 0.5);
            animation: orb-glow 3s infinite alternate;
        }

        @keyframes orb-glow {
            from {
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
            }

            to {
                box-shadow: 0 0 40px rgba(160, 132, 252, 0.6);
            }
        }

        .logo-title {
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -1px;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Nav Links */
        .nav-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2.5px;
            color: rgba(148, 163, 184, 0.5);
            margin: 2rem 0 1rem 1rem;
            font-weight: 700;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 1rem 1.25rem;
            color: #94A3B8;
            text-decoration: none;
            border-radius: 18px;
            margin-bottom: 0.5rem;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
        }

        .nav-link i {
            font-size: 1.2rem;
            transition: transform 0.3s;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(8px);
        }

        .nav-link:hover i {
            transform: scale(1.2) rotate(-5deg);
        }

        .nav-link.active {
            color: #fff;
            background: linear-gradient(90deg, rgba(99, 102, 241, 0.2), transparent);
            box-shadow: inset 4px 0 0 var(--primary);
        }

        /* Main Wrapper */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            position: relative;
        }

        .main-content {
            padding: 3rem 4rem;
            max-width: 1700px;
            width: 100%;
            margin: 0 auto;
        }

        /* Top Bar */
        .top-glass {
            padding: 1.25rem 4rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-glass);
            background: rgba(8, 14, 33, 0.3);
            backdrop-filter: blur(15px);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .status-pill {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #10b981;
            padding: 8px 16px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 700;
            font-family: 'JetBrains Mono';
        }

        .pulse {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: soft-pulse 2s infinite;
        }

        @keyframes soft-pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(2.5);
                opacity: 0;
            }
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 16px 6px 6px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50px;
            border: 1px solid var(--border-glass);
            cursor: pointer;
            transition: 0.3s;
        }

        .admin-profile:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .avatar {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, var(--vibrant-1), var(--primary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.9rem;
        }

        /* UI Components */
        .h-card {
            background: var(--card-glass);
            border-radius: 32px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .h-card:hover {
            transform: translateY(-10px) scale(1.02);
            background: rgba(255, 255, 255, 0.03);
            box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.4);
        }

        .h-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at top right, rgba(255, 255, 255, 0.05), transparent);
            pointer-events: none;
        }

        .h-reveal {
            opacity: 0;
            transform: translateY(40px);
        }

        .h-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px;
        }

        .h-table tr {
            background: rgba(255, 255, 255, 0.02);
            transition: 0.4s;
        }

        .h-table tr:hover {
            background: rgba(255, 255, 255, 0.06);
            transform: scale(1.01);
        }

        .h-table td {
            padding: 1.5rem;
            text-align: left;
        }

        .h-table td:first-child {
            border-radius: 20px 0 0 20px;
        }

        .h-table td:last-child {
            border-radius: 0 20px 20px 0;
        }

        .btn-luxe {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            padding: 1rem 2rem;
            border-radius: 18px;
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: 0.4s;
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.3);
            border: none;
            cursor: pointer;
        }

        .btn-luxe:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.5);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }
    </style>
    @yield('styles')
</head>

<body>
    <aside class="sidebar">
        <div class="side-logo">
            <div class="logo-orb">
                <i class="fas fa-layer-group" style="color: white; font-size: 1.2rem;"></i>
            </div>
            <div class="logo-title">GSM QUANTUM</div>
        </div>

        <div style="overflow-y: auto; flex: 1; padding-right: 5px;">
            <div class="nav-label">Nexus Points</div>
            <nav>
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-compass"></i> Overview
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-user-astronaut"></i> Operatives
                </a>
                <a href="{{ route('admin.orders.index') }}"
                    class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fas fa-bolt"></i> Transaction Flux
                </a>
            </nav>

            <div class="nav-label">Finance Module</div>
            <nav>
                <a href="{{ route('admin.p2p.index') }}" class="nav-link">
                    <i class="fas fa-wallet"></i> P2P Nexus
                </a>
                <a href="{{ route('admin.payment-methods.index') }}" class="nav-link">
                    <i class="fas fa-shield-halved"></i> Payment Vault
                </a>
                <a href="{{ route('admin.brokers.index') }}" class="nav-link">
                    <i class="fas fa-landmark"></i> Broker Nodes
                </a>
            </nav>

            <div class="nav-label">Academy Hub</div>
            <nav>
                <a href="{{ route('admin.lms.classes') }}" class="nav-link">
                    <i class="fas fa-video"></i> Live Streams
                </a>
                <a href="{{ route('admin.lms.recordings') }}" class="nav-link">
                    <i class="fas fa-film"></i> Neural Archive
                </a>
                <a href="{{ route('admin.lms.tasks') }}" class="nav-link">
                    <i class="fas fa-brain"></i> Synapse Tasks
                </a>
            </nav>

            <div class="nav-label">Communications</div>
            <nav>
                <a href="{{ route('admin.messages.index') }}" class="nav-link">
                    <i class="fas fa-comment-nodes"></i> Signal Center
                </a>
            </nav>

            <div class="nav-label">Control Matrix</div>
            <nav>
                <a href="{{ route('admin.content.pages.index') }}" class="nav-link">
                    <i class="fas fa-sliders"></i> CMS Portals
                </a>
                <a href="{{ route('admin.settings.index') }}" class="nav-link">
                    <i class="fas fa-microchip"></i> System Kernels
                </a>
            </nav>
        </div>

        <div style="padding-top: 2rem; border-top: 1px solid var(--border-glass);">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link"
                    style="width: 100%; border: none; background: transparent; cursor: pointer; text-align: left;">
                    <i class="fas fa-power-off" style="color: var(--accent);"></i> Terminate Link
                </button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="top-glass">
            <div class="status-pill">
                <div class="pulse"></div>
                CORE_SYSTEM_HEALTH: OPTIMAL
            </div>

            <div class="admin-profile">
                <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                <div style="font-size: 0.95rem; font-weight: 700;">{{ auth()->user()->name }}</div>
                <i class="fas fa-chevron-down" style="font-size: 0.8rem; color: #64748B;"></i>
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
                duration: 1,
                stagger: 0.15,
                ease: "expo.out"
            });
        });
    </script>
    @yield('scripts')
</body>

</html>