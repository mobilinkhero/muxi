@extends('layouts.dashboard')

@section('title', 'Hyper Terminal')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&family=JetBrains+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        :root {
            --hyper-bg: #020617;
            --hyper-card: rgba(15, 23, 42, 0.4);
            --hyper-border: rgba(255, 255, 255, 0.08);
            --hyper-primary: #6366F1;
            --hyper-secondary: #10B981;
            --hyper-accent: #EC4899;
            --font-main: 'Outfit', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }

        body {
            font-family: var(--font-main);
            background-color: var(--hyper-bg);
            color: #F8FAFC;
            overflow-x: hidden;
        }

        /* Moving Grid Background */
        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 200%;
            height: 200%;
            background-image:
                linear-gradient(rgba(99, 102, 241, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99, 102, 241, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            transform: perspective(500px) rotateX(60deg) translateY(-100px);
            animation: gridMove 20s linear infinite;
            z-index: -2;
            pointer-events: none;
        }

        @keyframes gridMove {
            0% {
                transform: perspective(500px) rotateX(60deg) translateY(-100px) translateX(0);
            }

            100% {
                transform: perspective(500px) rotateX(60deg) translateY(-100px) translateX(-50px);
            }
        }

        .ambient-glow {
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.1), transparent 80%);
            z-index: -1;
            pointer-events: none;
        }

        /* Bento Grid Layout */
        .bento-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto;
            gap: 1.5rem;
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .bento-item {
            background: var(--hyper-card);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--hyper-border);
            border-radius: 28px;
            position: relative;
            overflow: hidden;
            transition: 0.5s cubic-bezier(0.2, 1, 0.3, 1);
        }

        .bento-item:hover {
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 0 40px rgba(99, 102, 241, 0.15);
            transform: scale(1.01);
        }

        /* Neon Border Trace */
        .bento-item::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 28px;
            background: linear-gradient(90deg, transparent, var(--hyper-primary), transparent);
            opacity: 0;
            transition: 0.5s;
            pointer-events: none;
        }

        .bento-item:hover::after {
            opacity: 0.1;
        }

        /* Hero Section (Wide) */
        .hero-bento {
            grid-column: span 3;
            padding: 3.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(15, 23, 42, 0.4));
        }

        .performance-bento {
            grid-column: span 1;
            padding: 2rem;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Stats Section */
        .stat-bento {
            grid-column: span 1;
            padding: 2rem;
        }

        .terminal-bento {
            grid-column: span 2;
            padding: 0;
        }

        .profile-bento {
            grid-column: span 1;
            padding: 2rem;
            background: linear-gradient(180deg, rgba(236, 72, 153, 0.05), transparent);
        }

        /* Typography & Components */
        .glitch-text {
            font-weight: 900;
            font-size: 4rem;
            letter-spacing: -3px;
            line-height: 1;
            margin: 0;
            background: linear-gradient(135deg, #FFF 0%, #94A3B8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .mono-pill {
            font-family: var(--font-mono);
            font-size: 0.7rem;
            background: rgba(16, 185, 129, 0.1);
            color: var(--hyper-secondary);
            padding: 6px 14px;
            border-radius: 50px;
            border: 1px solid rgba(16, 185, 129, 0.2);
            text-transform: uppercase;
        }

        .live-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #EF4444;
            display: inline-block;
            margin-right: 8px;
            animation: blink 1s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.3;
            }
        }

        .terminal-row {
            padding: 1.25rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
        }

        .terminal-row:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .btn-hyper {
            padding: 12px 24px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 0.9rem;
            transition: 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--hyper-primary);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-hyper:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.3);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .bento-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero-bento {
                grid-column: span 2;
            }
        }

        @media (max-width: 768px) {
            .bento-container {
                grid-template-columns: 1fr;
            }

            .hero-bento,
            .terminal-bento {
                grid-column: span 1;
            }

            .glitch-text {
                font-size: 2.5rem;
            }
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
        }
    </style>
@endpush

@section('content')
    <div class="grid-overlay"></div>
    <div class="ambient-glow"></div>

    <div class="bento-container">

        <!-- ROW 1: HERO & PERFORMANCE -->
        <div class="bento-item hero-bento reveal">
            <div>
                <div class="mono-pill" style="margin-bottom: 2rem;">
                    <span class="live-dot"></span> CONNECTION ESTABLISHED // PORT 8080
                </div>
                <h1 class="glitch-text">
                    Welcome,<br>
                    <span style="color: var(--hyper-primary);">{{ explode(' ', $user->name)[0] }}</span>
                </h1>
                <p style="color: #94A3B8; margin-top: 1.5rem; font-size: 1.1rem; max-width: 450px; line-height: 1.6;">
                    Your terminal is synchronized with global markets. Performance metrics are trending positive.
                </p>
            </div>
            <div style="text-align: right;" class="hide-mobile">
                <img src="{{ auth()->user()->avatar_url }}"
                    style="width: 200px; height: 200px; border-radius: 40px; transform: rotate(5deg); border: 4px solid var(--hyper-card); box-shadow: 0 40px 80px rgba(0,0,0,0.5);">
            </div>
        </div>

        <div class="bento-item performance-bento reveal">
            <div style="font-size: 0.7rem; color: #94A3B8; letter-spacing: 2px; text-transform: uppercase;">Growth Index
            </div>
            <div style="font-size: 4rem; font-weight: 900; color: var(--hyper-secondary); line-height: 1; margin: 1rem 0;">
                +24%</div>
            <div
                style="height: 60px; display: flex; align-items: flex-end; gap: 4px; justify-content: center; margin-bottom: 1.5rem;">
                <div style="width: 8px; height: 30%; background: var(--hyper-secondary); border-radius: 4px; opacity: 0.3;">
                </div>
                <div style="width: 8px; height: 50%; background: var(--hyper-secondary); border-radius: 4px; opacity: 0.5;">
                </div>
                <div style="width: 8px; height: 80%; background: var(--hyper-secondary); border-radius: 4px; opacity: 0.7;">
                </div>
                <div
                    style="width: 8px; height: 100%; background: var(--hyper-accent); border-radius: 4px; box-shadow: 0 0 15px var(--hyper-accent);">
                </div>
            </div>
            <a href="{{ route('dashboard.stats') }}" class="btn-hyper btn-outline" style="justify-content: center;">Full
                Report</a>
        </div>

        <!-- ROW 2: STATS -->
        <div class="bento-item stat-bento reveal">
            <div style="color: var(--hyper-secondary); font-size: 1.5rem; margin-bottom: 1rem;"><i class="fas fa-radar"></i>
            </div>
            <div style="font-size: 2.5rem; font-weight: 800;">{{ $activeSignals->count() }}</div>
            <div style="font-size: 0.8rem; color: #94A3B8; text-transform: uppercase; letter-spacing: 1px;">Active Signals
            </div>
            <div style="margin-top: 1.5rem; font-size: 0.8rem; color: var(--hyper-secondary);">
                <i class="fas fa-chart-line"></i> High Win Rate
            </div>
        </div>

        <div class="bento-item stat-bento reveal">
            <div style="color: var(--hyper-primary); font-size: 1.5rem; margin-bottom: 1rem;"><i class="fas fa-brain"></i>
            </div>
            <div style="font-size: 2.5rem; font-weight: 800;">88%</div>
            <div style="font-size: 0.8rem; color: #94A3B8; text-transform: uppercase; letter-spacing: 1px;">Training IQ
            </div>
            <div style="margin-top: 1.5rem; height: 4px; background: rgba(255,255,255,0.05); border-radius: 10px;">
                <div
                    style="width: 88%; height: 100%; background: var(--hyper-primary); border-radius: 10px; box-shadow: 0 0 10px var(--hyper-primary);">
                </div>
            </div>
        </div>

        <div class="bento-item stat-bento reveal">
            <div style="color: var(--hyper-accent); font-size: 1.5rem; margin-bottom: 1rem;"><i
                    class="fas fa-shield-halved"></i></div>
            <div style="font-size: 2.5rem; font-weight: 800;">4.2k</div>
            <div style="font-size: 0.8rem; color: #94A3B8; text-transform: uppercase; letter-spacing: 1px;">Community</div>
            <div style="margin-top: 1.5rem; font-size: 0.8rem; color: #94A3B8;">
                Verified Collective
            </div>
        </div>

        <div class="bento-item stat-bento reveal">
            <div style="color: #F59E0B; font-size: 1.5rem; margin-bottom: 1rem;"><i class="fas fa-bolt"></i></div>
            <div style="font-size: 2.5rem; font-weight: 800;">{{ $totalSignals }}</div>
            <div style="font-size: 0.8rem; color: #94A3B8; text-transform: uppercase; letter-spacing: 1px;">Total Missions
            </div>
            <div style="margin-top: 1.5rem; font-size: 0.8rem; color: #F59E0B;">
                Signals Processed
            </div>
        </div>

        <!-- ROW 3: LIVE TERMINAL & PROFILE -->
        <div class="bento-item terminal-bento reveal">
            <div
                style="padding: 1.5rem 2rem; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-size: 1.1rem; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-code-branch" style="color: var(--hyper-primary);"></i> LIVE FEED
                </h3>
                <span class="mono-pill">v2.0.4-Stable</span>
            </div>

            <div style="max-height: 400px; overflow-y: auto;">
                @forelse($activeSignals->take(5) as $signal)
                    <div class="terminal-row">
                        <div style="display: flex; align-items: center; gap: 1.5rem;">
                            <div
                                style="width: 45px; height: 45px; background: {{ strtolower($signal->type) == 'buy' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)' }}; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: {{ strtolower($signal->type) == 'buy' ? '#10B981' : '#EF4444' }};">
                                <i
                                    class="fas fa-{{ strtolower($signal->type) == 'buy' ? 'trending-up' : 'trending-down' }}"></i>
                            </div>
                            <div>
                                <div style="font-weight: 800; font-family: var(--font-mono);">{{ $signal->symbol }}</div>
                                <div style="font-size: 0.75rem; color: #94A3B8;">Detected
                                    {{ $signal->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-family: var(--font-mono); font-weight: 700;">{{ $signal->entry_price }}</div>
                            <div
                                style="font-size: 0.7rem; color: {{ strtolower($signal->type) == 'buy' ? '#10B981' : '#EF4444' }}; font-weight: 900;">
                                {{ strtoupper($signal->type) }} LIMIT</div>
                        </div>
                    </div>
                @empty
                    <div style="padding: 4rem; text-align: center; color: #94A3B8;">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.2;"></i>
                        <p>Waiting for market opportunities...</p>
                    </div>
                @endforelse
            </div>

            <div style="padding: 1.5rem 2rem; background: rgba(0,0,0,0.2);">
                <a href="/trade" class="btn-hyper" style="width: 100%; justify-content: center;">Access Trading Matrix</a>
            </div>
        </div>

        <div class="bento-item profile-bento reveal">
            <div style="text-align: center;">
                <div
                    style="width: 70px; height: 70px; background: rgba(99, 102, 241, 0.1); border-radius: 20px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.8rem; margin-bottom: 1.5rem; color: var(--hyper-primary);">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3>Profile Security</h3>
                <p style="color: #94A3B8; font-size: 0.9rem; line-height: 1.6; margin-bottom: 2rem;">
                    Your account is protected with 256-bit encryption and multi-sig verification.
                </p>
                <div style="display: grid; gap: 0.75rem;">
                    <a href="{{ route('profile.edit') }}" class="btn-hyper btn-outline"
                        style="justify-content: center; font-size: 0.8rem;">Adjust Settings</a>
                    <a href="{{ route('dashboard.courses') }}" class="btn-hyper btn-outline"
                        style="justify-content: center; border-color: var(--hyper-accent); color: var(--hyper-accent); font-size: 0.8rem;">Skill
                        Hub</a>
                </div>
            </div>
        </div>

        <div class="bento-item reveal"
            style="grid-column: span 1; padding: 2rem; background: linear-gradient(45deg, rgba(16, 185, 129, 0.05), transparent);">
            <h4 style="margin-top: 0; color: var(--hyper-secondary);">Quick Actions</h4>
            <ul style="list-style: none; padding: 0; margin: 1.5rem 0;">
                <li style="margin-bottom: 1rem;"><a href="/invest"
                        style="color: #F8FAFC; text-decoration: none; display: flex; align-items: center; gap: 10px;"><i
                            class="fas fa-gem"></i> Alpha Staking</a></li>
                <li style="margin-bottom: 1rem;"><a href="{{ route('p2p.index') }}"
                        style="color: #F8FAFC; text-decoration: none; display: flex; align-items: center; gap: 10px;"><i
                            class="fas fa-link"></i> P2P Node</a></li>
            </ul>
        </div>

    </div>

    <!-- GSAP Premium Animations -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Bento Item Entrance
            gsap.to('.reveal', {
                opacity: 1,
                y: 0,
                duration: 1.2,
                stagger: 0.1,
                ease: "power4.out",
                force3D: true
            });

            // Mouse Move Grid Parallax
            document.addEventListener('mousemove', (e) => {
                const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
                const moveY = (e.clientY - window.innerHeight / 2) * 0.01;

                gsap.to('.grid-overlay', {
                    x: moveX,
                    y: moveY,
                    duration: 1,
                    ease: "power2.out"
                });
            });

            // Card Tilt
            document.querySelectorAll('.bento-item').forEach(item => {
                item.addEventListener('mousemove', (e) => {
                    const rect = item.getBoundingClientRect();
                    const x = (e.clientX - rect.left) / rect.width - 0.5;
                    const y = (e.clientY - rect.top) / rect.height - 0.5;

                    gsap.to(item, {
                        rotateY: x * 5,
                        rotateX: -y * 5,
                        duration: 0.5,
                        ease: "power2.out"
                    });
                });

                item.addEventListener('mouseleave', () => {
                    gsap.to(item, {
                        rotateY: 0,
                        rotateX: 0,
                        duration: 1,
                        ease: "elastic.out(1, 0.3)"
                    });
                });
            });
        });
    </script>
@endsection