<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trade Signals (Crypto, Forex, Gold) - GSM Trading Lab</title>
    <meta name="description"
        content="Get professional trading signals and market analysis for Crypto, Forex, Gold, Stocks, Indices & Derivatives.">
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        .analysis-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 4rem;
        }

        @media (min-width: 768px) {
            .analysis-grid {
                grid-template-columns: 2fr 1fr;
            }
        }

        @keyframes pulse-red {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        @keyframes pulse-green {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar scrolled" id="navbar">
        <div class="container">
            <div class="nav-container">
                <a href="/" class="logo" style="display: flex; align-items: center;">
                    <embed src="/images/logo.svg" type="image/svg+xml" style="height: 40px;">
                </a>
                <ul class="nav-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="/#markets">Markets</a></li>
                    <li><a href="/#services">Services</a></li>
                    <li><a href="/#about">About</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="btn btn-secondary" style="border: none;">Login</a></li>
                    @endauth
                    <li><a href="/#contact" class="btn btn-primary">Get Started</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- TradingView Ticker Tape Widget -->
    <div class="tradingview-widget-container" style="margin-top: 100px; z-index: 1; position: relative;">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
            async>
                {
                    "symbols": [
                        { "proName": "FOREXCOM:SPXUSD", "title": "S&P 500" },
                        { "proName": "FOREXCOM:NSXUSD", "title": "US 100" },
                        { "proName": "FX_IDC:EURUSD", "title": "EUR/USD" },
                        { "proName": "BITSTAMP:BTCUSD", "title": "Bitcoin" },
                        { "proName": "BITSTAMP:ETHUSD", "title": "Ethereum" },
                        { "description": "Gold", "proName": "OANDA:XAUUSD" }
                    ],
                        "showSymbolLogo": true,
                            "colorTheme": "dark",
                                "isTransparent": false,
                                    "displayMode": "adaptive",
                                        "locale": "en"
                }
            </script>
    </div>

    <!-- Page Header -->
    <section class="hero" style="min-height: 60vh; padding-top: 120px;">
        <div class="hero-background">
            <div class="hero-gradient hero-gradient-1"></div>
            <div class="hero-gradient hero-gradient-2"></div>
            <div class="hero-gradient hero-gradient-3"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span>📈</span>
                    <span>Professional Trading Signals</span>
                </div>
                <h1>Trade with Confidence</h1>
                <p class="hero-description">
                    Receive high-accuracy trading signals and expert analysis primarily for <strong>Crypto, Forex, and
                        Gold</strong>.
                    We also cover Stocks, Indices & Derivatives to maximize your opportunities.
                </p>
                <div class="hero-cta">
                    <a href="#plans" class="btn btn-primary">
                        <span>View Plans</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Signal Features -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Live Opportunities</span>
                <h2>Active Trading Signals</h2>
                <p>Real-time market opportunities analyzed by our experts.</p>
            </div>

            <div class="features-grid" style="margin-bottom: 4rem;">
                @forelse($activeSignals as $signal)
                    <div class="feature-card"
                        style="text-align: left; position: relative; border-left: 4px solid {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }}; transition: transform 0.3s ease, box-shadow 0.3s ease;">

                        <!-- Pulse Effect for Live Status -->
                        <div
                            style="position: absolute; top: 1rem; right: 1rem; background: rgba({{ $signal->type == 'BUY' ? '16, 185, 129' : '239, 68, 68' }}, 0.1); color: {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }}; padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; border: 1px solid rgba({{ $signal->type == 'BUY' ? '16, 185, 129' : '239, 68, 68' }}, 0.2); display: flex; align-items: center; gap: 0.5rem;">
                            <span
                                style="display: block; width: 8px; height: 8px; background: {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }}; border-radius: 50%; box-shadow: 0 0 8px {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }}; animation: {{ $signal->type == 'BUY' ? 'pulse-green' : 'pulse-red' }} 2s infinite;"></span>
                            ACTIVE
                        </div>

                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                            <div
                                style="font-size: 2rem; background: rgba(255,255,255,0.05); width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 12px;">
                                {{ $signal->type == 'BUY' ? '📈' : '📉' }}
                            </div>
                            <div>
                                <h3 style="margin: 0; font-size: 1.4rem; color: var(--white);">{{ $signal->symbol }}</h3>
                                <span
                                    style="color: {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }}; font-weight: 700; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">
                                    {{ $signal->type }} {{ $signal->type == 'BUY' ? '↗' : '↘' }}
                                </span>
                            </div>
                        </div>

                        @auth
                            <!-- Logged In View -->
                            <div
                                style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 1.25rem; margin-bottom: 1.25rem; border: 1px solid rgba(255,255,255,0.05);">
                                <div
                                    style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; padding-bottom: 0.75rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <span style="color: var(--gray);">Entry Zone</span>
                                    <span
                                        style="font-family: 'Courier New', monospace; font-weight: 600; color: var(--white);">{{ $signal->entry_price }}</span>
                                </div>
                                <div
                                    style="display: flex; justify-content: space-between; margin-bottom: 0.75rem; padding-bottom: 0.75rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <span style="color: var(--gray);">Take Profit</span>
                                    <span
                                        style="font-family: 'Courier New', monospace; font-weight: 600; color: #10B981;">{{ $signal->take_profit_1 }}</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: var(--gray);">Stop Loss</span>
                                    <span
                                        style="font-family: 'Courier New', monospace; font-weight: 600; color: #ef4444;">{{ $signal->stop_loss }}</span>
                                </div>
                            </div>

                            <div
                                style="background: rgba(99, 102, 241, 0.1); border-radius: 8px; padding: 1rem; border-left: 3px solid var(--primary);">
                                <p style="font-size: 0.9rem; color: var(--gray-light); margin-bottom: 0; line-height: 1.6;">
                                    <strong>Analyst Note:</strong>
                                    {{ $signal->notes ?? 'Setup looks clean. Manage risk accordingly.' }}
                                </p>
                            </div>
                        @else
                            <!-- Guest Locked View -->
                            <div style="position: relative; overflow: hidden; border-radius: 12px;">
                                <div
                                    style="background: rgba(255,255,255,0.02); padding: 1.25rem; filter: blur(6px); user-select: none; opacity: 0.6;">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                                        <span style="color: var(--gray);">Entry Zone</span>
                                        <span style="font-family: monospace;">HIDDEN</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                                        <span style="color: var(--gray);">Take Profit</span>
                                        <span style="font-family: monospace; color: #10B981;">HIDDEN</span>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span style="color: var(--gray);">Stop Loss</span>
                                        <span style="font-family: monospace; color: #ef4444;">HIDDEN</span>
                                    </div>
                                </div>

                                <div
                                    style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; background: rgba(17, 24, 39, 0.4); z-index: 10;">
                                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">🔒</div>
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm"
                                        style="box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4); transform: scale(1.05);">
                                        Login to Reveal
                                    </a>
                                    <p style="font-size: 0.75rem; color: var(--gray-light); margin-top: 0.5rem;">Free for
                                        registered members</p>
                                </div>
                            </div>
                        @endauth
                    </div>
                @empty
                    <div
                        style="grid-column: 1/-1; text-align: center; padding: 4rem 2rem; background: var(--dark-light); border-radius: var(--radius-lg); border: 2px dashed rgba(255,255,255,0.05);">
                        <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;">💤</div>
                        <h3 style="color: var(--white); margin-bottom: 0.5rem;">No Active Signals</h3>
                        <p style="color: var(--gray); max-width: 400px; margin: 0 auto;">Our analysts are scanning the
                            markets. Turn on notifications to get alerted when a new setup is live.</p>
                    </div>
                @endforelse
            </div>

            @include('partials.market-analysis')

            <!-- Live Market Analysis Section (Auto Analysis) -->
            <div class="section-header" style="margin-top: 4rem;">
                <span class="section-badge">Live Analysis</span>
                <h2>Real-Time Market Data</h2>
                <p>Advanced charting and automatic technical analysis powered by TradingView.</p>
            </div>

            <div class="analysis-grid features-grid" style="gap: 2rem; margin-bottom: 4rem;">
                <!-- Advanced Chart Widget -->
                <div class="feature-card" style="padding: 0; overflow: hidden; height: 500px; text-align: left;">
                    <div class="tradingview-widget-container" style="height:100%;width:100%">
                        <div class="tradingview-widget-container__widget" style="height:calc(100% - 32px);width:100%">
                        </div>
                        <script type="text/javascript"
                            src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
                                {
                                    "autosize": true,
                                        "symbol": "BITSTAMP:BTCUSD",
                                            "interval": "D",
                                                "timezone": "Etc/UTC",
                                                    "theme": "dark",
                                                        "style": "1",
                                                            "locale": "en",
                                                                "enable_publishing": false,
                                                                    "allow_symbol_change": true,
                                                                        "calendar": false,
                                                                            "support_host": "https://www.tradingview.com"
                                }
                            </script>
                    </div>
                </div>

                <!-- Technical Analysis Speedometer -->
                <div class="feature-card" style="padding: 0; overflow: hidden; height: 500px; text-align: left;">
                    <div class="tradingview-widget-container" style="height:100%;width:100%">
                        <div class="tradingview-widget-container__widget" style="height:calc(100% - 32px);width:100%">
                        </div>
                        <script type="text/javascript"
                            src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js"
                            async>
                                {
                                    "interval": "1h",
                                        "width": "100%",
                                            "isTransparent": true,
                                                "height": "100%",
                                                    "symbol": "BITSTAMP:BTCUSD",
                                                        "showIntervalTabs": true,
                                                            "displayMode": "single",
                                                                "locale": "en",
                                                                    "colorTheme": "dark"
                                }
                            </script>
                    </div>
                </div>
            </div>

            @if($closedSignals->count() > 0)
                <div class="section-header">
                    <span class="section-badge">Performance</span>
                    <h2>Recent Results</h2>
                    <p>Transparency is key. Here are our latest closed trades.</p>
                </div>

                <div class="features-grid">
                    @foreach($closedSignals as $signal)
                        <div class="feature-card"
                            style="text-align: left; position: relative; border-left: 4px solid {{ $signal->result == 'profit' ? '#10B981' : ($signal->result == 'loss' ? '#ef4444' : '#f59e0b') }}; opacity: 0.8;">
                            <div
                                style="position: absolute; top: 1rem; right: 1rem; background: rgba(255,255,255,0.1); padding: 0.25rem 0.75rem; border-radius: 4px; font-size: 0.8rem;">
                                {{ $signal->created_at->format('M d') }}
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                <div style="font-size: 1.5rem;">{{ $signal->type == 'BUY' ? '📈' : '📉' }}</div>
                                <div>
                                    <h3 style="margin: 0; font-size: 1.25rem;">{{ $signal->symbol }}</h3>
                                    <span
                                        style="font-size: 0.9rem; font-weight: bold; color: {{ $signal->result == 'profit' ? '#10B981' : ($signal->result == 'loss' ? '#ef4444' : '#f59e0b') }}">
                                        {{ strtoupper($signal->result ?? 'CLOSED') }}
                                    </span>
                                </div>
                            </div>
                            <div style="background: rgba(255,255,255,0.05); border-radius: 8px; padding: 1rem;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: var(--gray);">Net Result:</span>
                                    <span
                                        style="font-weight: bold; color: {{ $signal->result == 'profit' ? '#10B981' : ($signal->result == 'loss' ? '#ef4444' : '#f59e0b') }}">
                                        {{ $signal->result == 'profit' ? 'Target Hit 🎯' : ($signal->result == 'loss' ? 'Stop Hit 🛑' : 'Closed Manually') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Latest Signals Section -->
    <section class="section" style="background: var(--dark-light);">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Live Action</span>
                <h2>Recent Analysis & Signals</h2>
                <p>See how we navigate the markets with our high-precision trade setups.</p>
            </div>

            <div class="features-grid">
                @forelse($closedSignals as $signal)
                    <div class="feature-card"
                        style="text-align: left; position: relative; border-left: 4px solid {{ $signal->result == 'profit' ? '#10B981' : ($signal->result == 'loss' ? '#ef4444' : '#f59e0b') }};">

                        <div
                            style="position: absolute; top: 1rem; right: 1rem; background: {{ $signal->result == 'profit' ? 'rgba(16, 185, 129, 0.2)' : ($signal->result == 'loss' ? 'rgba(239, 68, 68, 0.2)' : 'rgba(245, 158, 11, 0.2)') }}; color: {{ $signal->result == 'profit' ? '#10B981' : ($signal->result == 'loss' ? '#ef4444' : '#f59e0b') }}; padding: 0.25rem 0.75rem; border-radius: 4px; font-size: 0.8rem; font-weight: 800;">
                            @if($signal->result == 'profit')
                                TARGET HIT 🎯
                            @elseif($signal->result == 'loss')
                                STOP HIT 🛑
                            @else
                                {{ strtoupper($signal->result ?? 'CLOSED') }}
                            @endif
                        </div>

                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                            <div style="font-size: 1.5rem;">{{ $signal->type == 'BUY' ? '📈' : '📉' }}</div>
                            <div>
                                <h3 style="margin: 0; font-size: 1.25rem;">{{ $signal->symbol }}</h3>
                                <span
                                    style="color: {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }}; font-weight: bold; font-size: 0.9rem;">{{ $signal->type }}
                                    {{ $signal->type == 'BUY' ? '↗' : '↘' }}</span>
                            </div>
                        </div>

                        <div
                            style="background: rgba(255,255,255,0.05); border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span style="color: var(--gray);">Entry:</span>
                                <span style="font-family: monospace;">{{ $signal->entry_price }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span style="color: var(--gray);">Targets:</span>
                                <span style="font-family: monospace; color: #10B981;">{{ $signal->take_profit_1 }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: var(--gray);">Stop Loss:</span>
                                <span style="font-family: monospace; color: #ef4444;">{{ $signal->stop_loss }}</span>
                            </div>
                        </div>
                        <p style="font-size: 0.9rem; color: var(--gray-light); margin-bottom: 0;">
                            <strong>Result:</strong>
                            {{ $signal->notes ?? ($signal->result == 'profit' ? 'Trade reached target profit successfully.' : 'Trade hit stop loss.') }}
                        </p>
                    </div>
                @empty
                    <div
                        style="grid-column: 1/-1; text-align: center; padding: 3rem; background: var(--dark-light); border-radius: var(--radius-md);">
                        <p style="color: var(--gray);">No recent trade history available.</p>
                    </div>
                @endforelse




            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <p style="color: var(--gray); margin-bottom: 1.5rem;">Ready to start trading with our free signals?</p>
                <a href="https://wa.me/447478035502" target="_blank" class="btn btn-primary">
                    <span>Join Free Community</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

    </section>

    <!-- Partner Brokers -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Premium Access</span>
                <h2>Trade with Us</h2>
                <p>Join our premium channel for FREE by signing up with our official partners.</p>
            </div>

            <div class="services-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                <div class="services-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    @foreach($brokers as $broker)
                        <div class="service-card"
                            style="text-align: center; padding: 2rem; position: relative; border: 1px solid rgba(255,255,255,0.05); transition: transform 0.3s ease;">
                            @if($broker->is_recommended)
                                <div
                                    style="position: absolute; top: -10px; right: 50%; transform: translateX(50%); background: #10B981; color: white; padding: 0.25rem 0.75rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.4); white-space: nowrap;">
                                    ★ RECOMMENDED
                                </div>
                            @endif
                            <div
                                style="height: 60px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; margin-top: 1rem;">
                                <img src="{{ $broker->logo_path }}" alt="{{ $broker->name }}"
                                    style="max-height: 50px; max-width: 100%; object-fit: contain; filter: brightness(0) invert(1);">
                            </div>
                            <h3 style="margin-bottom: 1rem; font-size: 1.25rem;">{{ $broker->name }}</h3>
                            <ul class="service-features"
                                style="justify-content: center; text-align: left; margin-bottom: 1.5rem; min-height: 80px;">
                                @foreach(explode("\n", $broker->description) as $feature)
                                    @if(trim($feature))
                                        <li>{{ trim($feature) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                            <a href="{{ $broker->referral_link }}" target="_blank" class="btn btn-primary"
                                style="width: 100%; background: {{ $loop->even ? 'var(--dark)' : 'var(--primary)' }}; border: 1px solid var(--primary); color: {{ $loop->even ? 'var(--primary-light)' : 'white' }};">
                                Join {{ $broker->name }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div style="text-align: center; margin-top: 3rem;">
                <p style="color: var(--gray-light); margin-bottom: 1rem;">Already signed up? Send us a screenshot to get
                    instant access.</p>
                <div style="display: flex; gap: 1rem; justify-content: center;">
                    <a href="https://wa.me/447478035502" target="_blank" class="btn btn-secondary">
                        <span>Send Screenshot</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Dashboard -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Performance</span>
                <h2>Our Track Record</h2>
                <p>Transparent results backed by data.</p>
            </div>

            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
                <!-- Profitable Trades -->
                <div
                    style="background: var(--dark-light); padding: 1.5rem; border-radius: var(--radius-md); text-align: center; border: 1px solid rgba(16, 185, 129, 0.2);">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #10B981; margin-bottom: 0.5rem;">1,452</div>
                    <div style="color: var(--gray-light); font-weight: 600;">Profitable Trades</div>
                </div>

                <!-- Loss Trades -->
                <div
                    style="background: var(--dark-light); padding: 1.5rem; border-radius: var(--radius-md); text-align: center; border: 1px solid rgba(239, 68, 68, 0.2);">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #ef4444; margin-bottom: 0.5rem;">126</div>
                    <div style="color: var(--gray-light); font-weight: 600;">Loss Trades</div>
                </div>

                <!-- Total Profit -->
                <div
                    style="background: var(--dark-light); padding: 1.5rem; border-radius: var(--radius-md); text-align: center; border: 1px solid rgba(16, 185, 129, 0.2);">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #10B981; margin-bottom: 0.5rem;">+2,845%
                    </div>
                    <div style="color: var(--gray-light); font-weight: 600;">Total Profit Gained</div>
                </div>

                <!-- Total Loss -->
                <div
                    style="background: var(--dark-light); padding: 1.5rem; border-radius: var(--radius-md); text-align: center; border: 1px solid rgba(239, 68, 68, 0.2);">
                    <div style="font-size: 2.5rem; font-weight: 800; color: #ef4444; margin-bottom: 0.5rem;">-320%</div>
                    <div style="color: var(--gray-light); font-weight: 600;">Total Loss Incurred</div>
                </div>
            </div>

            <div style="margin-top: 2rem; text-align: center;">
                <div
                    style="display: inline-block; padding: 0.5rem 1.5rem; background: rgba(255, 255, 255, 0.05); border-radius: 50px; font-size: 0.9rem; color: var(--gray-light);">
                    Net Profit: <span style="color: #10B981; font-weight: 800; font-size: 1.1rem;">+2,525%</span> (All
                    Time)
                </div>
            </div>

            <div
                style="margin-top: 3rem; background: var(--dark-light); padding: 2rem; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.05);">
                <div style="text-align: center;">
                    <h3 style="margin-bottom: 1.5rem;">Monthly Performance</h3>
                    <div
                        style="display: flex; align-items: flex-end; justify-content: center; gap: 1rem; height: 200px; padding-bottom: 1rem; border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <!-- Monthly Bars -->
                        <div
                            style="flex: 1; max-width: 60px; background: rgba(16, 185, 129, 0.2); border-radius: 4px 4px 0 0; position: relative; height: 65%;">
                            <div
                                style="position: absolute; bottom: -25px; left: 0; right: 0; font-size: 0.8rem; color: var(--gray);">
                                Aug</div>
                            <div
                                style="position: absolute; top: -25px; left: 0; right: 0; font-size: 0.8rem; color: #10B981; font-weight: bold;">
                                +125%</div>
                        </div>
                        <div
                            style="flex: 1; max-width: 60px; background: rgba(16, 185, 129, 0.3); border-radius: 4px 4px 0 0; position: relative; height: 75%;">
                            <div
                                style="position: absolute; bottom: -25px; left: 0; right: 0; font-size: 0.8rem; color: var(--gray);">
                                Sep</div>
                            <div
                                style="position: absolute; top: -25px; left: 0; right: 0; font-size: 0.8rem; color: #10B981; font-weight: bold;">
                                +142%</div>
                        </div>
                        <div
                            style="flex: 1; max-width: 60px; background: rgba(16, 185, 129, 0.4); border-radius: 4px 4px 0 0; position: relative; height: 55%;">
                            <div
                                style="position: absolute; bottom: -25px; left: 0; right: 0; font-size: 0.8rem; color: var(--gray);">
                                Oct</div>
                            <div
                                style="position: absolute; top: -25px; left: 0; right: 0; font-size: 0.8rem; color: #10B981; font-weight: bold;">
                                +98%</div>
                        </div>
                        <div
                            style="flex: 1; max-width: 60px; background: rgba(16, 185, 129, 0.5); border-radius: 4px 4px 0 0; position: relative; height: 85%;">
                            <div
                                style="position: absolute; bottom: -25px; left: 0; right: 0; font-size: 0.8rem; color: var(--gray);">
                                Nov</div>
                            <div
                                style="position: absolute; top: -25px; left: 0; right: 0; font-size: 0.8rem; color: #10B981; font-weight: bold;">
                                +185%</div>
                        </div>
                        <div
                            style="flex: 1; max-width: 60px; background: rgba(16, 185, 129, 0.6); border-radius: 4px 4px 0 0; position: relative; height: 45%;">
                            <div
                                style="position: absolute; bottom: -25px; left: 0; right: 0; font-size: 0.8rem; color: var(--gray);">
                                Dec</div>
                            <div
                                style="position: absolute; top: -25px; left: 0; right: 0; font-size: 0.8rem; color: #10B981; font-weight: bold;">
                                +82%</div>
                        </div>
                        <div
                            style="flex: 1; max-width: 60px; background: #10B981; border-radius: 4px 4px 0 0; position: relative; height: 95%;">
                            <div
                                style="position: absolute; bottom: -25px; left: 0; right: 0; font-size: 0.8rem; color: var(--white); font-weight: bold;">
                                Jan</div>
                            <div
                                style="position: absolute; top: -25px; left: 0; right: 0; font-size: 0.8rem; color: #10B981; font-weight: bold;">
                                +210%</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trade History Gallery -->
            @php
                $tradeScreenshots = glob(public_path('images/trade-history/*.{jpg,jpeg,png,webp}'), GLOB_BRACE);
            @endphp

            @if(!empty($tradeScreenshots))
                <div style="margin-top: 4rem;">
                    <div class="section-header">
                        <span class="section-badge">Proof of Work</span>
                        <h2>📸 Live Trade Executions</h2>
                        <p>Real screenshots from our trading journal. Past performance is the best indicator of future
                            success.</p>
                    </div>

                    <div class="features-grid"
                        style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                        @foreach($tradeScreenshots as $screenshot)
                            <div class="feature-card"
                                style="padding: 0; overflow: hidden; cursor: pointer; transition: transform 0.3s ease;"
                                onclick="window.open('{{ asset('images/trade-history/' . basename($screenshot)) }}', '_blank')">
                                <img src="{{ asset('images/trade-history/' . basename($screenshot)) }}" alt="Trade Screenshot"
                                    style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--radius-md);">
                                <div style="padding: 1rem;">
                                    <h4 style="margin: 0; color: var(--white); font-size: 1rem;">Trade Setup</h4>
                                    <span style="font-size: 0.85rem; color: var(--gray);">Click to view full analysis</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Risk Disclaimer -->
    <div style="background: #1f2937; border-top: 1px solid rgba(255,255,255,0.1); padding: 2rem 0;">
        <div class="container">
            <div
                style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 8px; padding: 1.5rem;">
                <h4 style="color: #ef4444; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    ⚠️ IMPORTANT RISK DISCLAIMER
                </h4>
                <p style="color: var(--gray-light); font-size: 0.9rem; line-height: 1.6; margin-bottom: 0;">
                    <strong>This is not financial advice.</strong> The analysis, signals, and information provided on
                    this website are for educational and informational purposes only. Trading cryptocurrencies, forex,
                    stocks, and other financial instruments involves a high level of risk and may not be suitable for
                    all investors. The markets are highly volatile; you may sustain a loss of some or all of your
                    initial investment. You should conduct your own due diligence and research before making any
                    investment decisions. <strong>GSM Trading Lab</strong> is not responsible for any financial losses
                    or damages you may incur from relying on this information. trade at your own risk.
                </p>
            </div>
        </div>
    </div>

    <!-- Free Education Philosophy -->
    <section class="section" style="background: var(--dark-light); text-align: center;">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Our Mission</span>
                <h2>Trading should be for everyone</h2>
                <p style="max-width: 700px; margin: 0 auto;">
                    Unlike others, we don't sell signals. We believe in empowering traders with free, high-quality
                    analysis
                    to help you learn and profit. We are here to help you grow, not to take your money.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <!-- Footer -->
    @include('partials.footer')

    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    @include('partials.security-script')
</body>

</html>