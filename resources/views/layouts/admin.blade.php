<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - GSM Trading Lab</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary: #00c076;
            /* Trading Green */
            --primary-glow: rgba(0, 192, 118, 0.3);
            --secondary: #6366f1;
            --accent: #ff3b30;
            /* Trading Red */
            --bg-dark: #0b0e11;
            /* Crypto Dark */
            --sidebar-bg: #161a1e;
            --card-bg: rgba(24, 29, 33, 0.7);
            --border: rgba(255, 255, 255, 0.05);
            --text-main: #eaecef;
            --text-dim: #848e9c;
            --font-main: 'Outfit', sans-serif;
            --font-secondary: 'Plus Jakarta Sans', sans-serif;
            --font-accent: 'Space Grotesk', sans-serif;
            --grid-line: rgba(255, 255, 255, 0.02);
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
                linear-gradient(var(--grid-line) 1px, transparent 1px),
                linear-gradient(90deg, var(--grid-line) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        /* 4D Background Orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.4;
            pointer-events: none;
        }

        .orb-1 {
            width: 400px;
            height: 400px;
            background: var(--primary);
            top: -100px;
            left: -100px;
        }

        .orb-2 {
            width: 350px;
            height: 350px;
            background: var(--secondary);
            bottom: -100px;
            right: -100px;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: var(--accent);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.1;
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

        /* Sidebar: Floating Frost Deck */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            backdrop-filter: blur(30px);
            border-right: 1px solid var(--border);
            padding: 2.5rem 1.25rem;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            z-index: 100;
            box-shadow: 10px 0 50px rgba(0, 0, 0, 0.5);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 3.5rem;
            padding-left: 0.5rem;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 1.5rem;
            color: white;
            box-shadow: 0 10px 30px var(--glow-indigo);
            position: relative;
            transform-style: preserve-3d;
            transition: 0.5s;
        }

        .brand:hover .brand-icon {
            transform: rotateY(180deg) scale(1.1);
        }

        .brand-text {
            font-family: var(--font-accent);
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -1px;
            background: linear-gradient(to right, #fff, #94a3b8);
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
            background: linear-gradient(to right, rgba(99, 102, 241, 0.15), transparent);
            border-left: 4px solid var(--primary);
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
            padding: 1.25rem 2.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(2, 6, 23, 0.6);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .top-deck-inner {
            width: 100%;
            max-width: 1550px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        /* 4D Cards: Floating & Depth */
        .h-card {
            background: var(--card-bg);
            backdrop-filter: blur(25px);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            transition: border-color 0.4s, background 0.4s, box-shadow 0.4s;
            position: relative;
            box-shadow:
                0 4px 20px rgba(0, 0, 0, 0.2),
                inset 0 0 0 1px rgba(255, 255, 255, 0.02);
            overflow: hidden;
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        .h-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(0, 192, 118, 0.05),
                    transparent);
            transition: none;
            pointer-events: none;
        }

        .h-card:hover::after {
            left: 100%;
            transition: 0.8s ease-in-out;
        }

        .h-card:hover {
            border-color: rgba(0, 192, 118, 0.3);
            background: rgba(24, 29, 33, 0.9);
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.4),
                0 0 20px var(--primary-glow);
        }

        .main-content {
            padding: 2.5rem;
            max-width: 1550px;
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
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <aside class="sidebar">
        <div class="brand">
            <div class="brand-icon">G</div>
            <div class="brand-text">GSM TRADING</div>
        </div>

        <div style="overflow-y: auto; flex: 1; padding-right: 5px;" class="sidebar-scroll">
            <div class="nav-group">
                <span class="nav-label">Main Menu</span>
                <nav>
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Users List
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                        class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-basket"></i> Orders Details
                    </a>
                    <a href="{{ route('admin.signals.index') }}"
                        class="nav-link {{ request()->routeIs('admin.signals.*') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i> Trading Signals
                    </a>
                </nav>
            </div>

            <div class="nav-group">
                <span class="nav-label">Finance & Assets</span>
                <nav>
                    <a href="{{ route('admin.p2p.index') }}" class="nav-link">
                        <i class="fas fa-exchange-alt"></i> P2P Portal
                    </a>
                    <a href="{{ route('admin.payment-methods.index') }}" class="nav-link">
                        <i class="fas fa-wallet"></i> Payment Methods
                    </a>
                    <a href="{{ route('admin.brokers.index') }}" class="nav-link">
                        <i class="fas fa-building"></i> Broker List
                    </a>
                </nav>
            </div>

            <div class="nav-group">
                <span class="nav-label">Academy / LMS</span>
                <nav>
                    <a href="{{ route('admin.lms.classes') }}" class="nav-link">
                        <i class="fas fa-video"></i> Live Classes
                    </a>
                    <a href="{{ route('admin.lms.recordings') }}" class="nav-link">
                        <i class="fas fa-play-circle"></i> Video Recordings
                    </a>
                    <a href="{{ route('admin.lms.tasks') }}" class="nav-link">
                        <i class="fas fa-clipboard-list"></i> Student Tasks
                    </a>
                </nav>
            </div>

            <div class="nav-group">
                <span class="nav-label">System Control</span>
                <nav>
                    <a href="{{ route('admin.content.pages.index') }}" class="nav-link">
                        <i class="fas fa-file-signature"></i> Edit Pages
                    </a>
                    <a href="{{ route('admin.security.logs') }}" class="nav-link">
                        <i class="fas fa-lock"></i> Security Logs
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="nav-link">
                        <i class="fas fa-tools"></i> Site Settings
                    </a>
                </nav>
            </div>
        </div>

        <div style="padding-top: 1.5rem; border-top: 1px solid var(--border);">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link"
                    style="width: 100%; border: none; background: transparent; cursor: pointer; color: var(--accent);">
                    <i class="fas fa-power-off"></i> Destruct Session
                </button>
            </form>
        </div>
    </aside>

    <div class="main-wrapper">
        <header class="top-deck">
            <div class="top-deck-inner">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div class="status-dot"></div>
                    <span
                        style="font-weight: 800; font-size: 0.8rem; color: #10B981; text-transform: uppercase; letter-spacing: 2px;">
                        System Secure • Node Active
                    </span>
                </div>

                <div class="user-pill">
                    <div class="avatar-circle">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <div style="font-size: 1rem; font-weight: 800; font-family: var(--font-accent);">
                        {{ auth()->user()->name }}
                    </div>
                    <i class="fas fa-angle-down" style="font-size: 0.8rem; opacity: 0.5;"></i>
                </div>
            </div>
        </header>

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Precision Entrance Sequence
            const tl = gsap.timeline({ defaults: { ease: "expo.out" } });

            tl.set('.h-reveal', { opacity: 0, scale: 0.95, filter: 'blur(10px)', y: 20 });

            tl.to('.h-reveal', {
                opacity: 1,
                scale: 1,
                filter: 'blur(0px)',
                y: 0,
                duration: 1.2,
                stagger: {
                    each: 0.1,
                    from: "start"
                }
            });

            // Parallax Background Flow
            document.addEventListener('mousemove', e => {
                const xPos = (e.clientX / window.innerWidth - 0.5) * 40;
                const yPos = (e.clientY / window.innerHeight - 0.5) * 40;

                gsap.to(document.body, {
                    backgroundPosition: `${xPos}px ${yPos}px`,
                    duration: 2,
                    ease: "power2.out"
                });

                // Subtle orb parallax
                gsap.to('.orb-1', { x: xPos * 2, y: yPos * 2, duration: 3 });
                gsap.to('.orb-2', { x: -xPos * 3, y: -yPos * 3, duration: 4 });
            });

            // Physics-Based Card Interactions
            document.querySelectorAll('.h-card').forEach(card => {
                card.addEventListener('mousemove', e => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;

                    const rotateX = (centerY - y) / 15;
                    const rotateY = (x - centerX) / 15;

                    gsap.to(card, {
                        rotateX: rotateX,
                        rotateY: rotateY,
                        scale: 1.02,
                        duration: 0.6,
                        ease: "power3.out",
                        overwrite: "auto"
                    });
                });

                card.addEventListener('mouseleave', () => {
                    gsap.to(card, {
                        rotateX: 0,
                        rotateY: 0,
                        scale: 1,
                        duration: 1.2,
                        ease: "elastic.out(1, 0.4)",
                        overwrite: "auto"
                    });
                });
            });

            // Smooth Sidebar Navigation
            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('mouseenter', () => {
                    gsap.to(link.querySelector('i'), {
                        rotate: 15,
                        scale: 1.2,
                        duration: 0.3
                    });
                });
                link.addEventListener('mouseleave', () => {
                    gsap.to(link.querySelector('i'), {
                        rotate: 0,
                        scale: 1,
                        duration: 0.3
                    });
                });
            });
        });
    </script>
    @yield('scripts')
</body>

</html>