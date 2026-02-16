@extends('layouts.dashboard')

@section('title', 'Terminal Dashboard')

@push('styles')
    <style>
        :root {
            --card-bg: rgba(15, 23, 42, 0.4);
            --card-border: rgba(255, 255, 255, 0.08);
            --glow-primary: rgba(139, 92, 246, 0.5);
            --glow-secondary: rgba(16, 185, 129, 0.4);
        }

        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            perspective: 1000px;
            padding-bottom: 100px;
        }

        /* 3D Glass Morphism */
        .glass-card-3d {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 1.75rem;
            position: relative;
            transition: all 0.5s cubic-bezier(0.2, 1, 0.3, 1);
            transform-style: preserve-3d;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .glass-card-3d:hover {
            transform: translateY(-8px) rotateX(2deg) rotateY(-1deg);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.4), 0 0 20px var(--glow-primary);
        }

        .glass-card-3d::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 24px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.05) 0%, transparent 100%);
            pointer-events: none;
        }

        /* Floating Animation */
        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating-icon {
            animation: floating 4s ease-in-out infinite;
        }

        /* Stats Depth */
        .stat-3d-box {
            position: relative;
            height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .stat-3d-box .icon-3d {
            position: absolute;
            right: -10px;
            bottom: -10px;
            font-size: 6rem;
            opacity: 0.15;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.5));
            transition: 0.5s ease;
        }

        .stat-3d-box:hover .icon-3d {
            transform: scale(1.2) rotate(10deg);
            opacity: 0.3;
        }

        /* Quick Action 4D Buttons */
        .action-btn-4d {
            background: linear-gradient(145deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.9));
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .action-btn-4d:hover {
            transform: scale(1.05) translateY(-5px);
            background: rgba(99, 102, 241, 0.1);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), inset 0 0 15px rgba(99, 102, 241, 0.2);
        }

        .action-btn-4d i {
            font-size: 2rem;
            filter: drop-shadow(0 5px 10px rgba(99, 102, 241, 0.4));
            transition: 0.3s ease;
        }

        .action-btn-4d:hover i {
            transform: rotate(10deg) scale(1.2);
        }

        /* Market Pulse Animation */
        @keyframes pulse-ring {
            0% {
                transform: scale(0.33);
                opacity: 1;
            }

            80%,
            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        .pulse-dot {
            position: relative;
            width: 12px;
            height: 12px;
            background-color: var(--secondary);
            border-radius: 50%;
        }

        .pulse-dot::before {
            content: '';
            position: absolute;
            display: block;
            width: 300%;
            height: 300%;
            box-sizing: border-box;
            margin-left: -100%;
            margin-top: -100%;
            border-radius: 45px;
            background-color: var(--secondary);
            animation: pulse-ring 1.25s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
        }

        /* Grid Layouts */
        .dashboard-4d-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2.5rem;
        }

        @media (max-width: 1100px) {
            .dashboard-4d-grid {
                grid-template-columns: 1fr;
            }
        }

        .stats-4d-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .actions-4d-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-container">

        <!-- Hero Terminal Section -->
        <section class="reveal" style="margin-bottom: 4rem; position: relative;">
            <!-- Glowing Orb Background (Subtle) -->
            <div
                style="position: absolute; top: -100px; left: 100px; width: 300px; height: 300px; background: var(--primary); filter: blur(150px); opacity: 0.15; z-index: -1;">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 2rem;">
                <div>
                    <div
                        style="display: inline-flex; align-items: center; gap: 0.75rem; padding: 6px 16px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1); border-radius: 50px; margin-bottom: 1.5rem;">
                        <div class="pulse-dot"></div>
                        <span
                            style="font-size: 0.75rem; font-weight: 800; color: white; text-transform: uppercase; letter-spacing: 2px;">Alpha
                            Terminal Connected</span>
                    </div>
                    <h1 style="font-size: 3.5rem; font-weight: 900; line-height: 1.1; margin: 0; letter-spacing: -2px;">
                        Hello, <span class="text-gradient">{{ explode(' ', $user->name)[0] }}</span>
                    </h1>
                    <p style="color: var(--text-muted); font-size: 1.25rem; margin-top: 1rem; max-width: 500px;">Control
                        your trading empire from a single, high-performance interface.</p>
                </div>

                <div class="glass-card-3d floating-icon" style="padding: 2rem; text-align: center; border-radius: 30px;">
                    <div
                        style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.5rem;">
                        Account Performance</div>
                    <div style="font-size: 2.5rem; font-weight: 900; color: var(--secondary);">+12.5%</div>
                    <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.25rem;">MTD Growth</div>
                </div>
            </div>
        </section>

        <!-- 4D Action Buttons -->
        <div class="actions-4d-row reveal delay-100">
            <a href="{{ route('dashboard.courses') }}" class="action-btn-4d">
                <i class="fas fa-play-circle" style="color: #8B5CF6;"></i>
                <span style="font-weight: 700; font-size: 0.95rem;">Learning</span>
            </a>
            <a href="{{ route('dashboard.stats') }}" class="action-btn-4d">
                <i class="fas fa-tasks" style="color: #3B82F6;"></i>
                <span style="font-weight: 700; font-size: 0.95rem;">Mission</span>
            </a>
            <a href="/trade" class="action-btn-4d">
                <i class="fas fa-radar" style="color: #10B981;"></i>
                <span style="font-weight: 700; font-size: 0.95rem;">Signals</span>
            </a>
            <a href="{{ route('p2p.index') }}" class="action-btn-4d">
                <i class="fas fa-sync-alt" style="color: #F59E0B;"></i>
                <span style="font-weight: 700; font-size: 0.95rem;">Exchange</span>
            </a>
            <a href="/invest" class="action-btn-4d">
                <i class="fas fa-gem" style="color: #EC4899;"></i>
                <span style="font-weight: 700; font-size: 0.95rem;">Wealth</span>
            </a>
        </div>

        <!-- 3D Stats Row -->
        <div class="stats-4d-row reveal-zoom delay-200">
            <div class="glass-card-3d stat-3d-box" style="border-left: 5px solid #8B5CF6;">
                <div>
                    <span class="label">Course Mastery</span>
                    <div class="value">88<span style="font-size: 1.5rem; font-weight: 400; opacity: 0.5;">%</span></div>
                </div>
                <div
                    style="width: 100%; height: 6px; background: rgba(255,255,255,0.05); border-radius: 3px; overflow: hidden;">
                    <div
                        style="width: 88%; height: 100%; background: linear-gradient(to right, #8B5CF6, #D946EF); border-radius: 3px;">
                    </div>
                </div>
                <div class="icon-3d">🎓</div>
            </div>

            <div class="glass-card-3d stat-3d-box" style="border-left: 5px solid #10B981;">
                <div>
                    <span class="label">Active Signals</span>
                    <div class="value">{{ $activeSignals->count() }}</div>
                </div>
                <div
                    style="font-size: 0.85rem; color: #10B981; font-weight: 700; display: flex; align-items: center; gap: 0.4rem;">
                    <i class="fas fa-arrow-up"></i> New Signals Available
                </div>
                <div class="icon-3d">⚡</div>
            </div>

            <div class="glass-card-3d stat-3d-box" style="border-left: 5px solid #F59E0B;">
                <div>
                    <span class="label">Trader Level</span>
                    <div class="value" style="font-size: 2rem;">{{ $user->is_premium ? 'WOLF' : 'CUB' }}</div>
                </div>
                <div style="font-size: 0.85rem; color: var(--text-muted);">
                    Member for {{ $user->created_at->diffInDays(now()) }} days
                </div>
                <div class="icon-3d">🏆</div>
            </div>
        </div>

        <!-- Multi-Dimensional Analysis -->
        <div class="dashboard-4d-grid reveal delay-300">

            <!-- Left: Intelligence Hub -->
            <div class="glass-card-3d" style="padding: 2.5rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
                    <h3
                        style="margin: 0; font-size: 1.5rem; font-weight: 900; letter-spacing: -0.5px; display: flex; align-items: center; gap: 1rem;">
                        <i class="fas fa-brain" style="color: #8B5CF6;"></i> Intelligence Hub
                    </h3>
                    <a href="/trade" class="btn btn-primary btn-sm"
                        style="border-radius: 12px; padding: 0.6rem 1.2rem; font-size: 0.75rem;">Deep Matrix &rarr;</a>
                </div>

                @if($activeSignals->count() > 0)
                    <div style="display: grid; gap: 1.25rem;">
                        @foreach($activeSignals->take(4) as $signal)
                            <div style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255,255,255,0.03); border-radius: 20px; padding: 1.25rem; display: flex; justify-content: space-between; align-items: center; transition: 0.3s;"
                                onmouseover="this.style.background='rgba(30, 41, 59, 0.8)'; this.style.borderColor='rgba(99, 102, 241, 0.3)'"
                                onmouseout="this.style.background='rgba(15, 23, 42, 0.6)'; this.style.borderColor='rgba(255, 255, 255, 0.03)'">
                                <div style="display: flex; align-items: center; gap: 1.25rem;">
                                    <div
                                        style="width: 55px; height: 55px; background: {{ strtolower($signal->type) == 'buy' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)' }}; border-radius: 18px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: {{ strtolower($signal->type) == 'buy' ? '#10B981' : '#EF4444' }};">
                                        <i
                                            class="fas fa-{{ strtolower($signal->type) == 'buy' ? 'chart-line' : 'chart-area' }}"></i>
                                    </div>
                                    <div>
                                        <div style="font-weight: 800; font-size: 1.15rem; color: white;">{{ $signal->symbol }}</div>
                                        <div style="font-size: 0.8rem; color: var(--text-muted); font-weight: 600;">
                                            <span
                                                style="color: {{ strtolower($signal->type) == 'buy' ? '#10B981' : '#EF4444' }};">{{ strtoupper($signal->type) }}</span>
                                            • {{ $signal->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-size: 1.15rem; font-weight: 900; color: white;">{{ $signal->entry_price }}
                                    </div>
                                    <div style="font-size: 0.75rem; color: var(--text-muted);">Entry Point</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 5rem 2rem;">
                        <div class="floating-icon" style="font-size: 4rem; margin-bottom: 1.5rem;">🌌</div>
                        <h4 style="color: white; margin-bottom: 0.5rem;">Scanning Deep Web...</h4>
                        <p style="color: var(--text-muted); font-size: 0.9rem;">The matrix is currently empty. Wait for new
                            trade calls.</p>
                    </div>
                @endif
            </div>

            <!-- Right: Neural Sidebar -->
            <div style="display: grid; gap: 2rem;">
                <!-- Neural Support -->
                <div class="glass-card-3d"
                    style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.2) 0%, rgba(16, 185, 129, 0.1) 100%); border: 1px solid rgba(255,255,255,0.1);">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                        <div
                            style="width: 50px; height: 50px; background: var(--gradient-crypto); border-radius: 15px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem;">
                            <i class="fas fa-microchip"></i>
                        </div>
                        <div>
                            <h4 style="margin: 0; color: white; font-weight: 800;">Neural Support</h4>
                            <div style="font-size: 0.75rem; color: var(--primary-light); font-weight: 700;">24/7 ACTIVE
                            </div>
                        </div>
                    </div>
                    <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem; margin-bottom: 2rem; line-height: 1.6;">Our
                        AI-powered trader support and community mods are ready to assist you.</p>
                    <div style="display: grid; gap: 0.75rem;">
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '447478035502' }}" class="action-btn-4d"
                            style="flex-direction: row; padding: 0.85rem; border-radius: 14px; background: rgba(37, 211, 102, 0.15);">
                            <i class="fab fa-whatsapp" style="font-size: 1.2rem; color: #25D366;"></i>
                            <span style="font-weight: 700;">Join WhatsApp</span>
                        </a>
                        <a href="{{ $settings['telegram_link'] ?? '#' }}" class="action-btn-4d"
                            style="flex-direction: row; padding: 0.85rem; border-radius: 14px; background: rgba(0, 136, 204, 0.15);">
                            <i class="fab fa-telegram-plane" style="font-size: 1.2rem; color: #33AAFF;"></i>
                            <span style="font-weight: 700;">Secure Telegram</span>
                        </a>
                    </div>
                </div>

                <!-- Discipline Matrix -->
                <div class="glass-card-3d" style="border-right: 5px solid #EF4444;">
                    <h4
                        style="margin: 0 0 1rem; font-size: 1.1rem; font-weight: 900; color: #EF4444; display: flex; align-items: center; gap: 0.75rem;">
                        <i class="fas fa-shield-virus"></i> Safety Matrix
                    </h4>
                    <div style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.7;">
                        <div
                            style="padding: 0.75rem; background: rgba(239, 68, 68, 0.05); border-radius: 12px; border-left: 3px solid #EF4444; margin-bottom: 1rem;">
                            <strong>STOP LOSS:</strong> Non-negotiable exit strategy.
                        </div>
                        <div
                            style="padding: 0.75rem; background: rgba(16, 185, 129, 0.05); border-radius: 12px; border-left: 3px solid #10B981;">
                            <strong>1% RISK:</strong> Stay in the game, trade another day.
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('scripts')
    <script>
        // Smooth 3D Hover Logic for individual cards
        document.querySelectorAll('.glass-card-3d').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;

                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0)`;
            });
        });
    </script>
@endsection