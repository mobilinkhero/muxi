<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSM Trading Lab - Crypto | Forex | Stocks | Indices | Commodities | Derivatives</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Master trading in Crypto, Forex, Stocks, Indices, Commodities & Derivatives. Expert education, professional trading signals, and comprehensive market analysis.">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        /* Custom Animations & UI Enhancements */
        :root {
            --primary-glow: rgba(139, 92, 246, 0.5);
            --secondary-glow: rgba(236, 72, 153, 0.5);
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Hero Animations */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes pulse-soft {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-slide-up {
            opacity: 0;
            animation: slideUp 0.8s ease-out forwards;
        }

        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }

        .delay-500 {
            animation-delay: 500ms;
        }

        /* Modern Card Effects */
        .feature-card,
        .service-card,
        .stat-card,
        .signal-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .feature-card:hover,
        .service-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px -15px rgba(139, 92, 246, 0.3);
            border-color: rgba(139, 92, 246, 0.5);
            background: rgba(30, 41, 59, 0.8);
        }

        .feature-card::before,
        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            transition: 0.5s;
        }

        .feature-card:hover::before,
        .service-card:hover::before {
            left: 100%;
        }

        .feature-icon,
        .service-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #8B5CF6, #EC4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon,
        .service-card:hover .service-icon {
            transform: scale(1.2) rotate(5deg);
        }

        /* Hero Background Enhancement */
        .hero {
            position: relative;
            overflow: hidden;
        }

        .hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            z-index: 0;
            animation: pulse-soft 8s infinite alternate;
        }

        .orb-1 {
            width: 300px;
            height: 300px;
            background: #8B5CF6;
            top: -50px;
            left: -100px;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: #EC4899;
            bottom: -100px;
            right: -50px;
            animation-delay: 2s;
        }

        .orb-3 {
            width: 200px;
            height: 200px;
            background: #10B981;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.2;
        }

        /* Button Glow */
        .btn-glow {
            position: relative;
            overflow: hidden;
        }

        .btn-glow::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-150%) rotate(45deg);
            }

            100% {
                transform: translateX(150%) rotate(45deg);
            }
        }

        /* Scroll Animation Classes */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .stagger-delay-1 {
            transition-delay: 100ms;
        }

        .stagger-delay-2 {
            transition-delay: 200ms;
        }

        .stagger-delay-3 {
            transition-delay: 300ms;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-container">
                <a href="/" class="logo">
                    <img src="{{ asset('images/logo.svg') }}" alt="{{ $settings['site_name'] ?? 'GSM Trading Lab' }}"
                        style="height: 40px;">
                </a>
                <ul class="nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#markets">Markets</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="btn btn-secondary" style="border: none;">Login</a></li>
                    @endauth
                    <li><a href="#contact" class="btn btn-primary">Get Started</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home" style="padding-top: 140px; padding-bottom: 100px;">
        <div class="hero-background"
            style="background-image: url('{{ $settings['home_hero_bg'] ?? 'https://images.unsplash.com/photo-1611974765270-ca12586343bb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80' }}'); background-size: cover; background-position: center; background-attachment: fixed;">
            <div
                style="position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.8), #0f172a);">
            </div>
        </div>

        <!-- Animated Background Orbs -->
        <div class="hero-orb orb-1"></div>
        <div class="hero-orb orb-2"></div>
        <div class="hero-orb orb-3"></div>

        <div class="container" style="position: relative; z-index: 1;">
            <div class="hero-content" style="max-width: 900px; margin: 0 auto; text-align: center;">
                <div class="hero-badge animate-slide-up">
                    <span class="animate-float" style="display: inline-block;">🚀</span>
                    <span>{{ $settings['home_hero_badge'] ?? 'Join Our Growing Community of Traders' }}</span>
                </div>

                <h1 class="animate-slide-up delay-100"
                    style="font-size: 3.5rem; margin-bottom: 1.5rem; background: linear-gradient(to right, #fff, #94a3b8); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    {!! $settings['home_hero_title'] ?? 'Master Financial Markets <br> Through <span style="background: linear-gradient(135deg, #8B5CF6, #EC4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Real Experience</span>' !!}
                </h1>

                <p class="hero-description animate-slide-up delay-200"
                    style="font-size: 1.2rem; line-height: 1.8; margin-bottom: 2.5rem; color: var(--gray-light);">
                    {!! $settings['home_hero_desc'] ?? 'A global trading learning community covering Crypto, Forex, Stocks, Commodities, Indices, Options & Futures. <br> <span style="color: var(--primary-light); font-weight: 500;">Learning first. Experience always. Growth together.</span>' !!}
                </p>

                <div class="hero-cta animate-slide-up delay-300"
                    style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="#contact" class="btn btn-primary btn-glow" style="padding: 1rem 2rem; font-size: 1.1rem;">
                        <span>Join Community</span>
                        <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                    </a>
                    <a href="/learn" class="btn btn-secondary" style="padding: 1rem 2rem; font-size: 1.1rem;">
                        <span>Start Learning</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Market Dashboard Section -->
    @include('partials.market-dashboard')

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card animate-on-scroll stagger-delay-1">
                    <div class="stat-number">{{ $settings['home_stat_1_val'] ?? '150+' }}</div>
                    <div class="stat-label">{{ $settings['home_stat_1_label'] ?? 'Registered Students' }}</div>
                </div>
                <div class="stat-card animate-on-scroll stagger-delay-2">
                    <div class="stat-number">{{ $settings['home_stat_2_val'] ?? '90+' }}</div>
                    <div class="stat-label">{{ $settings['home_stat_2_label'] ?? 'Successful Members' }}</div>
                </div>
                <div class="stat-card animate-on-scroll stagger-delay-3">
                    <div class="stat-number">{{ $settings['home_stat_3_val'] ?? 'Real' }}</div>
                    <div class="stat-label">{{ $settings['home_stat_3_label'] ?? 'Proven Strategies' }}</div>
                </div>
                <div class="stat-card animate-on-scroll stagger-delay-1">
                    <div class="stat-number">{{ $settings['home_stat_4_val'] ?? '24/7' }}</div>
                    <div class="stat-label">{{ $settings['home_stat_4_label'] ?? 'Support Available' }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Live Market Activity -->
    <section class="section" style="padding: var(--spacing-xl) 0;">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 3rem;">
                <span class="section-badge">Live Market Activity</span>
                <h2>Recent Trade Setups</h2>
                <p>See our latest analysis and trade performance in real-time.</p>
            </div>

            @if(isset($recentSignals) && $recentSignals->count() > 0)
                <div class="features-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                    @foreach($recentSignals as $signal)
                        <div class="signal-card"
                            style="border-left: 4px solid {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }};">
                            @if($signal->status == 'active')
                                <div class="live-badge">
                                    <span class="live-dot {{ $signal->type == 'BUY' ? 'green' : 'red' }}"></span>
                                    LIVE
                                </div>
                            @else
                                <div class="live-badge"
                                    style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2);">
                                    {{ strtoupper($signal->status) }}
                                </div>
                            @endif

                            <div class="signal-header">
                                <div>
                                    <div class="signal-symbol">{{ $signal->symbol }}</div>
                                    <div style="font-size: 0.8rem; color: var(--gray);">
                                        {{ $signal->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="signal-type {{ strtolower($signal->type) }}">
                                    {{ $signal->type }} {{ $signal->type == 'BUY' ? '↗' : '↘' }}
                                </div>
                            </div>

                            <div class="signal-body">
                                <div>
                                    <div class="signal-data-label">Entry</div>
                                    <div class="signal-data-value">
                                        @auth {{ $signal->entry_price }} @else <span style="filter: blur(4px);">HIDDEN</span>
                                        @endauth
                                    </div>
                                </div>
                                <div>
                                    <div class="signal-data-label">Target</div>
                                    <div class="signal-data-value" style="color: #10B981;">
                                        @auth {{ $signal->take_profit_1 }} @else <span style="filter: blur(4px);">HIDDEN</span>
                                        @endauth
                                    </div>
                                </div>
                                <div>
                                    <div class="signal-data-label">Result</div>
                                    <div class="signal-data-value"
                                        style="{{ $signal->result == 'profit' ? 'color: #10B981;' : ($signal->result == 'loss' ? 'color: #ef4444;' : 'color: var(--accent);') }}">
                                        {{ $signal->result ? ucfirst($signal->result) : 'Running' }}
                                    </div>
                                </div>
                            </div>

                            <div style="text-align: center; margin-top: 1rem;">
                                @auth
                                    <a href="/trade"
                                        style="font-size: 0.85rem; color: var(--primary-light); text-decoration: none; font-weight: 600;">View
                                        Analysis →</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm"
                                        style="width: 100%; justify-content: center;">Login to Unlock</a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="text-align: center; margin-top: 3rem;">
                    <a href="/trade" class="btn btn-secondary">View All Signals →</a>
                </div>
            @else
                <div
                    style="text-align: center; padding: 3rem; background: var(--dark-light); border-radius: var(--radius-lg); margin-top: 2rem;">
                    <p style="color: var(--gray);">No active public signals at the moment.</p>
                    <a href="/register" class="btn btn-primary" style="margin-top: 1rem;">Join to get notified</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Markets Section -->
    <section class="section" id="markets">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">{{ $settings['home_markets_badge'] ?? 'Markets We Cover' }}</span>
                <h2>{{ $settings['home_markets_title'] ?? 'Markets We Trade & Teach' }}</h2>
                <p>{{ $settings['home_markets_desc'] ?? 'We focus on understanding how each market works, how liquidity moves, and how traders can build long-term skill across multiple financial environments.' }}
                </p>
            </div>
            <div class="features-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <!-- Crypto -->
                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="fab fa-bitcoin"></i></div>
                    <h3>{{ $settings['home_market_1_title'] ?? 'Cryptocurrency' }}</h3>
                    <p>{{ $settings['home_market_1_desc'] ?? 'Master Bitcoin, Ethereum, and altcoins. Understand blockchain tech, DeFi, and market cycles.' }}
                    </p>
                </div>

                <!-- Forex -->
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-money-bill-transfer"></i></div>
                    <h3>{{ $settings['home_market_2_title'] ?? 'Forex Trading' }}</h3>
                    <p>{{ $settings['home_market_2_desc'] ?? 'Trade major & minor currency pairs. Learn technical analysis and central bank policies.' }}
                    </p>
                </div>

                <!-- Commodities -->
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-gem"></i></div>
                    <h3>{{ $settings['home_market_3_title'] ?? 'Commodities' }}</h3>
                    <p>{{ $settings['home_market_3_desc'] ?? 'Trade Gold, Silver, Metals, and Energy. Master supply/demand dynamics and safe-haven assets.' }}
                    </p>
                </div>

                <!-- Stocks -->
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>{{ $settings['home_market_4_title'] ?? 'Global Stocks' }}</h3>
                    <p>{{ $settings['home_market_4_desc'] ?? 'Invest in top companies like Apple & Tesla. Learn fundamental analysis and earnings reports.' }}
                    </p>
                </div>

                <!-- Indices -->
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-layer-group"></i></div>
                    <h3>{{ $settings['home_market_5_title'] ?? 'Indices' }}</h3>
                    <p>{{ $settings['home_market_5_desc'] ?? 'Trade the S&P 500, NASDAQ, and US30. capitalization on broader market trends.' }}
                    </p>
                </div>

                <!-- Derivatives -->
                <div class="feature-card animate-on-scroll">
                    <div class="feature-icon"><i class="fas fa-file-contract"></i></div>
                    <h3>{{ $settings['home_market_6_title'] ?? 'Options & Futures' }}</h3>
                    <p>{{ $settings['home_market_6_desc'] ?? 'Leverage your positions with sophisticated instruments. Advanced hedging and risk strategies.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="section services" id="services">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Our Services</span>
                <h2>Choose Your Path to Success</h2>
                <p>Professional services across all markets - tailored to your goals and experience level.</p>
            </div>
            <div class="services-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <!-- Learn Service -->
                <div class="service-card reveal">
                    <div class="service-header">
                        <div class="service-icon"><i class="fas fa-graduation-cap"></i></div>
                        <div>
                            <h3>Learn Trading</h3>
                        </div>
                    </div>
                    <p>Market structure, psychology, risk management, and multi-market training.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Market Structure</li>
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Trading Psychology</li>
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Risk Management</li>
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Strategy Building</li>
                    </ul>
                    <a href="/learn" class="btn btn-primary btn-glow" style="width: 100%; margin-top: 1.5rem;">
                        <span>Start Learning</span>
                        <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                    </a>
                </div>

                <!-- Trade Service -->
                <div class="service-card animate-on-scroll" style="border-color: rgba(16, 185, 129, 0.3);">
                    <div class="service-header">
                        <div class="service-icon"><i class="fas fa-chart-line"></i></div>
                        <div>
                            <h3>Trade With Analysis</h3>
                        </div>
                    </div>
                    <p>Market breakdowns, trade ideas, strategy discussions, and real examples.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Market Breakdowns</li>
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Trade Ideas</li>
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Strategy Discussions</li>
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Real Examples</li>
                    </ul>
                    <a href="/trade" class="btn btn-success btn-glow" style="width: 100%; margin-top: 1.5rem;">
                        <span>Start Analysis</span>
                        <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                    </a>
                </div>

                <!-- Invest Service -->
                <div class="service-card animate-on-scroll">
                    <div class="service-header">
                        <div class="service-icon"><i class="fas fa-users"></i></div>
                        <div>
                            <h3>Community Learning</h3>
                        </div>
                    </div>
                    <p>Global trader network, live discussions, knowledge sharing, and growth culture.</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Global Network</li>
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Live Discussions</li>
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Knowledge Sharing</li>
                        <li><i class="fas fa-check-circle" style="color: var(--accent); margin-right: 0.5rem;"></i>
                            Growth Mindset</li>
                    </ul>
                    <a href="#contact" class="btn btn-primary btn-glow" style="width: 100%; margin-top: 1.5rem;">
                        <span>Join Community</span>
                        <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Founder Story & Mission Section -->
    <section class="section" id="about">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">{{ $settings['home_about_badge'] ?? 'Who We Are' }}</span>
                <h2>{{ $settings['home_about_title'] ?? 'The Journey Behind GSM Trading Lab' }}</h2>
                <div
                    style="max-width: 800px; margin: 0 auto; text-align: left; background: var(--dark-light); padding: 2rem; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.05);">
                    <p style="margin-bottom: 1rem;">GSM Trading Lab is a global trading learning community built on real
                        market experience, practical analysis, and honest education.</p>
                    <p style="margin-bottom: 1rem;">This platform was created with one simple vision — to help traders
                        understand financial markets through real trading knowledge instead of hype or unrealistic
                        promises.</p>
                    <p style="margin-bottom: 1rem;">The founder of GSM Trading Lab started trading with passion, faced
                        real market challenges, and experienced major losses while learning. Those experiences shaped a
                        deeper understanding of risk, psychology, and market behavior.</p>
                    <p style="margin-bottom: 1rem;">GSM Trading Lab was created so new traders can learn faster, avoid
                        common beginner mistakes, and understand how real markets actually work.</p>
                    <p style="margin-bottom: 1rem;">We focus on education across all financial markets including
                        Cryptocurrency, Forex, Stocks, Indices, Commodities, Options, and Futures.</p>
                    <p style="font-weight: 500; color: var(--white); margin-bottom: 2rem;">Our mission is to build one
                        of the world’s most trusted and largest trading communities where traders learn together, grow
                        together, and succeed through knowledge, discipline, and real experience.</p>

                    <div
                        style="padding: 1.5rem; background: rgba(0,0,0,0.2); border-left: 3px solid var(--accent); border-radius: 4px;">
                        <h4 style="color: var(--accent); margin-bottom: 0.5rem; font-size: 1.1rem;">👤 Founder’s Journey
                        </h4>
                        <p style="color: var(--gray-light); font-size: 0.95rem; margin-bottom: 0.8rem;">GSM Trading Lab
                            was built by a trader who believes real growth comes from real market experience.</p>
                        <p style="color: var(--gray-light); font-size: 0.95rem; margin-bottom: 0.8rem;">The journey
                            started with strong interest in technology, telecom, and financial markets. Through years of
                            learning, practice, and facing losses, valuable lessons were gained about discipline,
                            patience, and risk control.</p>
                        <p style="color: var(--gray-light); font-size: 0.95rem; margin-bottom: 0.8rem;">Instead of
                            hiding mistakes, GSM Trading Lab was created to turn those experiences into learning
                            opportunities for others.</p>
                        <p style="color: var(--gray-light); font-size: 0.95rem;">The goal is simple — help traders
                            understand markets the right way and build a strong global community based on honesty and
                            practical knowledge.</p>
                    </div>
                </div>
            </div>

            <div style="margin-top: 5rem; text-align: center;">
                <span class="section-badge">Why Choose Us</span>
                <h2 style="margin-bottom: 3rem;">What Makes GSM Trading Lab Different</h2>

                <div class="features-grid"
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                    <!-- 1. Built on real market experience -->
                    <div class="feature-card reveal">
                        <div class="feature-icon"><i class="fas fa-chart-line"></i></div>
                        <h3>Real Market Experience</h3>
                        <p>Built on years of actual trading, not just theoretical textbook knowledge.</p>
                    </div>

                    <!-- 2. Self-made trader journey -->
                    <div class="feature-card reveal delay-100">
                        <div class="feature-icon"><i class="fas fa-user-tie"></i></div>
                        <h3>Self-Made Journey</h3>
                        <p>A founder who started from scratch, faced losses, and learned the hard way.</p>
                    </div>

                    <!-- 3. Practical analysis and strategy learning -->
                    <div class="feature-card reveal delay-200">
                        <div class="feature-icon"><i class="fas fa-laptop-code"></i></div>
                        <h3>Practical Analysis</h3>
                        <p>Learn strategies that work in live markets, with real-time application.</p>
                    </div>

                    <!-- 4. Focus on risk management and psychology -->
                    <div class="feature-card reveal">
                        <div class="feature-icon"><i class="fas fa-brain"></i></div>
                        <h3>Psychology & Risk</h3>
                        <p>Mastering the mental game and capital protection is our top priority.</p>
                    </div>

                    <!-- 5. Global community learning model -->
                    <div class="feature-card reveal delay-100">
                        <div class="feature-icon"><i class="fas fa-users"></i></div>
                        <h3>Global Community</h3>
                        <p>Join a diverse network of traders learning and growing together worldwide.</p>
                    </div>

                    <!-- 6. Multi-market trading education -->
                    <div class="feature-card reveal delay-200">
                        <div class="feature-icon"><i class="fas fa-globe"></i></div>
                        <h3>Multi-Market Focus</h3>
                        <p>Education covering Crypto, Forex, Stocks, Indices, and Commodities.</p>
                    </div>
                </div>
            </div>

            <!-- Who This Course Is For -->
            <div style="margin-top: 5rem; text-align: center;">
                <span class="section-badge">Target Audience</span>
                <h2 style="margin-bottom: 3rem;">Who This Course Is For</h2>

                <div class="features-grid"
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                    <div class="feature-card reveal" style="border-top: 4px solid var(--primary);">
                        <div class="feature-icon"><i class="fas fa-seedling"></i></div>
                        <h3>Beginners</h3>
                        <p>Entering the world of trading with zero prior knowledge.</p>
                    </div>

                    <div class="feature-card reveal delay-100" style="border-top: 4px solid var(--secondary);">
                        <div class="feature-icon"><i class="fas fa-chart-down"></i></div>
                        <h3>Struggling Traders</h3>
                        <p>Traders facing consistent losses and seeking discipline.</p>
                    </div>

                    <div class="feature-card reveal delay-200" style="border-top: 4px solid var(--accent);">
                        <div class="feature-icon"><i class="fas fa-layer-group"></i></div>
                        <h3>Multi-Market Learners</h3>
                        <p>Traders wanting to expand knowledge across all asset classes.</p>
                    </div>

                    <div class="feature-card reveal delay-300" style="border-top: 4px solid var(--primary-light);">
                        <div class="feature-icon"><i class="fas fa-glasses"></i></div>
                        <h3>Real Experience Seekers</h3>
                        <p>Traders who want deep market understanding over quick hype.</p>
                    </div>
                </div>
            </div>

            <!-- Trading Philosophy -->
            <div
                style="margin-top: 4rem; text-align: center; padding: 3rem; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(16, 185, 129, 0.05)); border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.05);">
                <h3 style="margin-bottom: 1rem; color: var(--white);">Trading Philosophy</h3>
                <p style="font-size: 1.2rem; max-width: 800px; margin: 0 auto; font-style: italic;">"Trading is a skill.
                    Trading is discipline. Trading is emotional control. Trading is long-term learning."</p>
            </div>

            <!-- Future Roadmap -->
            <div style="margin-top: 5rem;">
                <div class="section-header">
                    <span class="section-badge">Vision</span>
                    <h2>Future Roadmap</h2>
                    <p>Our commitment to building a world-class trading ecosystem.</p>
                </div>

                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; position: relative;">
                    <!-- Line connecting phases (desktop only) -->
                    <div style="display: none; position: absolute; top: 2rem; left: 0; right: 0; height: 2px; background: rgba(255,255,255,0.1); z-index: 0;"
                        class="roadmap-line"></div>

                    <!-- Phase 1 -->
                    <div class="feature-card animate-on-scroll" style="z-index: 1; padding: 2rem 1.5rem;">
                        <div
                            style="background: var(--dark); width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--primary); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--primary); font-weight: bold;">
                            1</div>
                        <h3 style="font-size: 1.2rem; margin-bottom: 1rem;">Community & Education</h3>
                        <ul style="list-style: none; padding: 0; font-size: 0.9rem; color: var(--gray);">
                            <li style="margin-bottom: 0.5rem;">✔ Free market education</li>
                            <li style="margin-bottom: 0.5rem;">✔ Social media content</li>
                            <li>✔ Global trading community</li>
                        </ul>
                    </div>

                    <!-- Phase 2 -->
                    <div class="feature-card animate-on-scroll delay-100"
                        style="z-index: 1; padding: 2rem 1.5rem; border-color: rgba(16, 185, 129, 0.3);">
                        <div
                            style="background: var(--dark); width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--secondary); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--secondary); font-weight: bold;">
                            2</div>
                        <h3 style="font-size: 1.2rem; margin-bottom: 1rem;">Premium Learning</h3>
                        <ul style="list-style: none; padding: 0; font-size: 0.9rem; color: var(--gray);">
                            <li style="margin-bottom: 0.5rem;">✔ Structured trading courses</li>
                            <li style="margin-bottom: 0.5rem;">✔ Strategy programs</li>
                            <li>✔ Mentorship</li>
                        </ul>
                    </div>

                    <!-- Phase 3 -->
                    <div class="feature-card animate-on-scroll delay-200" style="z-index: 1; padding: 2rem 1.5rem;">
                        <div
                            style="background: var(--dark); width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--accent); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--accent); font-weight: bold;">
                            3</div>
                        <h3 style="font-size: 1.2rem; margin-bottom: 1rem;">FinTech Expansion</h3>
                        <ul style="list-style: none; padding: 0; font-size: 0.9rem; color: var(--gray);">
                            <li style="margin-bottom: 0.5rem;">✔ Trading tools</li>
                            <li style="margin-bottom: 0.5rem;">✔ Analysis dashboards</li>
                            <li>✔ Risk calculators</li>
                        </ul>
                    </div>

                    <!-- Phase 4 -->
                    <div class="feature-card animate-on-scroll delay-300" style="z-index: 1; padding: 2rem 1.5rem;">
                        <div
                            style="background: var(--dark); width: 40px; height: 40px; border-radius: 50%; border: 1px solid var(--primary-light); display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; color: var(--primary-light); font-weight: bold;">
                            4</div>
                        <h3 style="font-size: 1.2rem; margin-bottom: 1rem;">Global Ecosystem</h3>
                        <ul style="list-style: none; padding: 0; font-size: 0.9rem; color: var(--gray);">
                            <li style="margin-bottom: 0.5rem;">✔ Mobile app</li>
                            <li style="margin-bottom: 0.5rem;">✔ Multi-market platform</li>
                            <li>✔ AI market learning tools</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Rules & Culture Section -->
    <section class="section" id="community-rules">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Our Guidelines</span>
                <h2>Community Rules & Culture</h2>

                <div
                    style="max-width: 800px; margin: 0 auto; margin-top: 2rem; padding: 2.5rem; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(59, 130, 246, 0.05)); border-radius: var(--radius-lg); border: 1px solid rgba(16, 185, 129, 0.2); text-align: center;">
                    <h3 style="color: var(--secondary); margin-bottom: 1rem; font-size: 1.5rem;">Community Culture</h3>
                    <p style="font-size: 1.2rem; line-height: 1.8; color: var(--gray-light);">GSM Trading Lab is a
                        learning family. <br> Here traders grow together, support each other, and build professional
                        discipline.</p>
                </div>
            </div>

            <div class="features-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-top: 4rem;">

                <div class="feature-card reveal"
                    style="padding: 1.5rem; text-align: left; border-left: 4px solid var(--primary);">
                    <h4 style="margin-bottom: 0; display: flex; align-items: center; gap: 0.8rem; font-size: 1.1rem;">
                        <i class="fas fa-handshake" style="color: var(--primary);"></i> Respect Every Trader
                    </h4>
                </div>

                <div class="feature-card reveal delay-100"
                    style="padding: 1.5rem; text-align: left; border-left: 4px solid var(--accent);">
                    <h4 style="margin-bottom: 0; display: flex; align-items: center; gap: 0.8rem; font-size: 1.1rem;">
                        <i class="fas fa-ban" style="color: var(--accent);"></i> No Fake Results
                    </h4>
                </div>

                <div class="feature-card reveal delay-200"
                    style="padding: 1.5rem; text-align: left; border-left: 4px solid var(--warning);">
                    <h4 style="margin-bottom: 0; display: flex; align-items: center; gap: 0.8rem; font-size: 1.1rem;">
                        <i class="fas fa-brain" style="color: var(--warning);"></i> No Signal Dependency
                    </h4>
                </div>

                <div class="feature-card reveal"
                    style="padding: 1.5rem; text-align: left; border-left: 4px solid var(--secondary);">
                    <h4 style="margin-bottom: 0; display: flex; align-items: center; gap: 0.8rem; font-size: 1.1rem;">
                        <i class="fas fa-book-reader" style="color: var(--secondary);"></i> Learning Comes First
                    </h4>
                </div>

                <div class="feature-card reveal delay-100"
                    style="padding: 1.5rem; text-align: left; border-left: 4px solid var(--primary-light);">
                    <h4 style="margin-bottom: 0; display: flex; align-items: center; gap: 0.8rem; font-size: 1.1rem;">
                        <i class="fas fa-balance-scale" style="color: var(--primary-light);"></i> Honest Knowledge
                    </h4>
                </div>

                <div class="feature-card reveal delay-200"
                    style="padding: 1.5rem; text-align: left; border-left: 4px solid var(--success);">
                    <h4 style="margin-bottom: 0; display: flex; align-items: center; gap: 0.8rem; font-size: 1.1rem;">
                        <i class="fas fa-shield-alt" style="color: var(--success);"></i> Risk Management
                    </h4>
                </div>

                <div class="feature-card reveal delay-300"
                    style="padding: 1.5rem; text-align: left; border-left: 4px solid var(--white); grid-column: 1 / -1; max-width: 600px; margin: 0 auto; width: 100%;">
                    <h4
                        style="margin-bottom: 0; display: flex; align-items: center; justify-content: center; gap: 0.8rem; font-size: 1.1rem;">
                        <i class="fas fa-rocket" style="color: var(--white);"></i> Growth Mindset Only
                    </h4>
                </div>

            </div>
        </div>

        <!-- Student Reviews Section -->
        <section class="section" id="reviews" style="background: var(--dark-light);">
            <div class="container">
                <div class="section-header">
                    <span class="section-badge">{{ $settings['home_reviews_badge'] ?? 'Community Trust' }}</span>
                    <h2>{{ $settings['home_reviews_title'] ?? 'From Market Lessons To Global Knowledge' }}</h2>
                    <p>{{ $settings['home_reviews_desc'] ?? 'See how traders are growing with GSM Trading Lab - Where Learning Comes First.' }}
                    </p>
                </div>

                <div class="features-grid">
                    @forelse($reviews as $review)
                        <div class="feature-card" style="text-align: left;">
                            <div style="color: #F59E0B; margin-bottom: 0.5rem;">
                                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                            </div>
                            <p style="font-style: italic; margin-bottom: 1.5rem;">"{{ $review->review }}"</p>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div
                                    style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">
                                    {{ strtoupper(substr($review->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--white);">{{ $review->name }}</div>
                                    <div style="font-size: 0.8rem; color: var(--gray);">{{ $review->role ?? 'Student' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Placeholder reviews if none in database -->
                        <div class="feature-card" style="text-align: left;">
                            <div style="color: #F59E0B; margin-bottom: 0.5rem;">★★★★★</div>
                            <p style="font-style: italic; margin-bottom: 1.5rem;">"I started with zero knowledge about
                                crypto.
                                Now I'm profitable!"</p>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div
                                    style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">
                                    AH</div>
                                <div>
                                    <div style="font-weight: 600; color: var(--white);">Ali Hassan</div>
                                    <div style="font-size: 0.8rem; color: var(--gray);">Crypto Student</div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Submit Review Button -->
                <div style="text-align: center; margin-top: 3rem;">
                    <button class="btn btn-secondary" onclick="openReviewModal()">
                        <span>Write a Review</span>
                    </button>
                </div>
            </div>
        </section>

        <!-- Review Modal -->
        <div id="reviewModal"
            style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.9); z-index: 9999; overflow-y: auto; padding: 2rem;">
            <div style="max-width: 500px; margin: 0 auto; position: relative; top: 10%;">
                <button onclick="closeReviewModal()"
                    style="position: absolute; top: -10px; right: -10px; width: 40px; height: 40px; border-radius: 50%; background: var(--primary); color: white; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
                <div
                    style="background: var(--dark); border: 1px solid var(--primary); border-radius: var(--radius-lg); padding: 2rem;">
                    <h3 style="text-align: center; margin-bottom: 1.5rem; color: var(--white);">Share Your Experience
                    </h3>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem; color: var(--white);">Your Name</label>
                            <input type="text" name="name" required
                                style="width: 100%; padding: 0.8rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: white;">
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem; color: var(--white);">Rating</label>
                            <select name="rating"
                                style="width: 100%; padding: 0.8rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: white;">
                                <option value="5">★★★★★ (Excellent)</option>
                                <option value="4">★★★★☆ (Good)</option>
                                <option value="3">★★★☆☆ (Average)</option>
                                <option value="2">★★☆☆☆ (Poor)</option>
                                <option value="1">★☆☆☆☆ (Terrible)</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <label style="display: block; margin-bottom: 0.5rem; color: var(--white);">Your
                                Review</label>
                            <textarea name="review" rows="4" required
                                style="width: 100%; padding: 0.8rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: white;"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function openReviewModal() {
                document.getElementById('reviewModal').style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
            function closeReviewModal() {
                document.getElementById('reviewModal').style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        </script>

        <!-- CTA Section -->
        <section class="section cta" id="contact">
            <div class="container">
                <div class="cta-content">
                    <h2>{{ $settings['home_cta_title'] ?? 'Ready to Start Your Trading Journey?' }}</h2>
                    <p>{{ $settings['home_cta_desc'] ?? 'Join thousands of successful traders and investors who trust us across all markets - Crypto, Forex, Stocks, Indices, Commodities & Derivatives.' }}
                    </p>

                    <!-- Social Media Links -->
                    <div style="display: flex; gap: 1rem; justify-content: center; margin: 2rem 0; flex-wrap: wrap;">
                        <!-- YouTube -->
                        <a href="{{ $settings['youtube_link'] ?? 'https://youtube.com/@gsmtradinglab' }}"
                            target="_blank" style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube" width="40"
                                height="40">
                        </a>
                        <!-- Telegram -->
                        <a href="{{ $settings['telegram_link'] ?? 'https://t.me/gsmtradinglab' }}" target="_blank"
                            style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg"
                                alt="Telegram" width="40" height="40">
                        </a>
                        <a href="{{ $settings['facebook_link'] ?? 'https://facebook.com/gsmtradinglab' }}"
                            target="_blank" style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" width="40"
                                height="40">
                        </a>
                        <a href="{{ $settings['instagram_link'] ?? 'https://instagram.com/gsmtradinglab' }}"
                            target="_blank" style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram"
                                width="40" height="40">
                        </a>
                        <a href="{{ $settings['threads_link'] ?? 'https://threads.net/@gsmtradinglab' }}"
                            target="_blank" style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://cdn-icons-png.flaticon.com/512/10856/10856184.png" alt="Threads"
                                width="40" height="40" style="filter: invert(1);">
                        </a>
                        <a href="{{ $settings['twitter_link'] ?? 'https://twitter.com/gsmtradinglab' }}" target="_blank"
                            style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://cdn-icons-png.flaticon.com/512/5968/5968830.png" alt="Twitter/X"
                                width="40" height="40" style="filter: invert(1);">
                        </a>
                        <a href="{{ $settings['tiktok_link'] ?? 'https://tiktok.com/@gsmtradinglab' }}" target="_blank"
                            style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://cdn-icons-png.flaticon.com/512/3046/3046121.png" alt="TikTok" width="40"
                                height="40" style="filter: invert(1);">
                        </a>
                        <a href="{{ $settings['snapchat_link'] ?? 'https://snapchat.com/add/gsmtradinglab' }}"
                            target="_blank" style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://cdn-icons-png.flaticon.com/512/3670/3670166.png" alt="Snapchat" width="40"
                                height="40">
                        </a>
                        <a href="{{ $settings['discord_link'] ?? 'https://discord.gg/gsmtradinglab' }}" target="_blank"
                            style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://cdn-icons-png.flaticon.com/512/3670/3670157.png" alt="Discord" width="40"
                                height="40" style="filter: invert(1);">
                        </a>
                        <a href="{{ $settings['linkedin_link'] ?? 'https://linkedin.com/in/gsmtradinglab' }}"
                            target="_blank" style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://cdn-icons-png.flaticon.com/512/3536/3536505.png" alt="LinkedIn" width="40"
                                height="40">
                        </a>
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '447478035502' }}" target="_blank"
                            style="text-decoration: none; transition: transform 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                            <img src="https://cdn-icons-png.flaticon.com/512/3670/3670051.png" alt="WhatsApp" width="40"
                                height="40">
                        </a>
                    </div>

                    <a href="/contact" class="btn">
                        <span>Get Started Today</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <!-- Footer -->
        @include('partials.footer')

        <!-- Simple Navbar Scroll Effect -->
        <script>
            window.addEventListener('scroll', function () {
                const navbar = document.getElementById('navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        </script>
        @include('partials.security-script')
        @include('partials.animations')
</body>

</html>