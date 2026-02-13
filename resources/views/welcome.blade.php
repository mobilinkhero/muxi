<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSM Trading Lab - Crypto | Forex | Stocks | Indices | Commodities | Derivatives</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Master trading in Crypto, Forex, Stocks, Indices, Commodities & Derivatives. Expert education, professional trading signals, and comprehensive market analysis.">
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-container">
                <a href="/" class="logo">
                     <img src="/images/logo.svg" alt="GSM Trading Lab" style="height: 40px; filter: drop-shadow(0 0 12px rgba(99, 102, 241, 0.6));">
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
    <section class="hero" id="home">
        <div class="hero-background">
            <div class="hero-gradient hero-gradient-1"></div>
            <div class="hero-gradient hero-gradient-2"></div>
            <div class="hero-gradient hero-gradient-3"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <span>🚀</span>
                    <span>Join Our Growing Community of Traders</span>
                </div>
                <h1>Master Trading Across All Markets</h1>
                <p class="hero-description" style="font-size: 1.1rem; line-height: 1.8;">
                    Crypto | 💱 Forex | 📊 Stocks | 📈 Indices | 🪙 Commodities | 🧾 Derivatives<br>
                    📊 Market Analysis | 🛡️ Risk Management | 🧠 All about Financial Markets Learning
                </p>
                <div class="hero-cta">
                    <a href="#markets" class="btn btn-primary">
                        <span>Explore Markets</span>
                        <span>→</span>
                    </a>
                    <a href="#services" class="btn btn-secondary">
                        <span>Explore Services</span>
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
                <div class="stat-card">
                    <div class="stat-number">{{ isset($registeredUsers) ? ($registeredUsers + 152) : '150+' }}</div>
                    <div class="stat-label">Registered Students</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ isset($successfulMembers) ? ($successfulMembers + 89) : '90+' }}</div>
                    <div class="stat-label">Successful Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">Real</div>
                    <div class="stat-label">Proven Strategies</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Support Available</div>
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
                        <div class="signal-card" style="border-left: 4px solid {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }};">
                            @if($signal->status == 'active')
                                <div class="live-badge">
                                    <span class="live-dot {{ $signal->type == 'BUY' ? 'green' : 'red' }}"></span>
                                    LIVE
                                </div>
                            @else
                                <div class="live-badge" style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.2);">
                                    {{ strtoupper($signal->status) }}
                                </div>
                            @endif

                            <div class="signal-header">
                                <div>
                                    <div class="signal-symbol">{{ $signal->symbol }}</div>
                                    <div style="font-size: 0.8rem; color: var(--gray);">{{ $signal->created_at->diffForHumans() }}</div>
                                </div>
                                <div class="signal-type {{ strtolower($signal->type) }}">
                                    {{ $signal->type }} {{ $signal->type == 'BUY' ? '↗' : '↘' }}
                                </div>
                            </div>

                            <div class="signal-body">
                                <div>
                                    <div class="signal-data-label">Entry</div>
                                    <div class="signal-data-value">
                                        @auth {{ $signal->entry_price }} @else <span style="filter: blur(4px);">HIDDEN</span> @endauth
                                    </div>
                                </div>
                                <div>
                                    <div class="signal-data-label">Target</div>
                                    <div class="signal-data-value" style="color: #10B981;">
                                        @auth {{ $signal->take_profit_1 }} @else <span style="filter: blur(4px);">HIDDEN</span> @endauth
                                    </div>
                                </div>
                                <div>
                                    <div class="signal-data-label">Result</div>
                                    <div class="signal-data-value" style="{{ $signal->result == 'profit' ? 'color: #10B981;' : ($signal->result == 'loss' ? 'color: #ef4444;' : 'color: var(--accent);') }}">
                                        {{ $signal->result ? ucfirst($signal->result) : 'Running' }}
                                    </div>
                                </div>
                            </div>
                            
                            <div style="text-align: center; margin-top: 1rem;">
                                @auth
                                    <a href="/trade" style="font-size: 0.85rem; color: var(--primary-light); text-decoration: none; font-weight: 600;">View Analysis →</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm" style="width: 100%; justify-content: center;">Login to Unlock</a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div style="text-align: center; margin-top: 3rem;">
                    <a href="/trade" class="btn btn-secondary">View All Signals →</a>
                </div>
            @else
                <div style="text-align: center; padding: 3rem; background: var(--dark-light); border-radius: var(--radius-lg); margin-top: 2rem;">
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
                <span class="section-badge">Markets We Cover</span>
                <h2>Trade Across All Major Markets</h2>
                <p>We provide comprehensive education and tools across all major markets - designed for beginners and
                    professional traders alike.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">₿</div>
                    <h3>Cryptocurrency Trading</h3>
                    <p>Master Bitcoin, Ethereum, and altcoin trading. Learn blockchain technology, DeFi, NFTs, and
                        crypto market dynamics.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💱</div>
                    <h3>Forex Trading</h3>
                    <p>Trade major, minor, and exotic currency pairs. Learn forex fundamentals, technical analysis, and
                        currency correlation strategies.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🪙</div>
                    <h3>Commodities (Gold/Oil)</h3>
                    <p>Trade gold, silver, oil, and agricultural commodities. Learn supply-demand dynamics and commodity
                        market cycles.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Stock Market Trading</h3>
                    <p>Invest in global stocks and equities. Learn fundamental analysis, earnings reports, and long-term
                        investment strategies.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h3>Indices Trading</h3>
                    <p>Trade major indices like S&P 500, NASDAQ, and FTSE. Understand market trends and index-based
                        investment strategies.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🧾</div>
                    <h3>Derivatives & Options</h3>
                    <p>Master futures, options, and CFDs. Learn advanced hedging strategies and leverage management
                        techniques.</p>
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
            <div class="services-grid">
                <!-- Learn Service -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">🎓</div>
                        <div>
                            <h3>Learn With Us</h3>
                        </div>
                    </div>
                    <p>Comprehensive trading education across all markets - from beginner basics to professional
                        strategies.</p>
                    <ul class="service-features">
                        <li>Multi-Market Trading Courses</li>
                        <li>Technical & Fundamental Analysis</li>
                        <li>Risk Management Strategies</li>
                        <li>Live Trading Sessions</li>
                        <li>Certificate of Completion</li>
                        <li>24/7 Learning Platform Access</li>
                    </ul>
                    <a href="/learn" class="btn btn-primary" style="width: 100%;">
                        <span>Start Learning</span>
                        <span>→</span>
                    </a>
                </div>

                <!-- Trade Service -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">📈</div>
                        <div>
                            <h3>Trade With Us</h3>
                        </div>
                    </div>
                    <p>Professional trading signals and market analysis across Crypto, Forex, Stocks, Indices,
                        Commodities & Derivatives.</p>
                    <ul class="service-features">
                        <li>Multi-Market Trading Signals</li>
                        <li>Daily Market Analysis Reports</li>
                        <li>Real-Time Trade Alerts</li>
                        <li>Expert Trading Mentorship</li>
                        <li>VIP Trading Community</li>
                        <li>Advanced Charting Tools</li>
                    </ul>
                    <a href="/trade" class="btn btn-success" style="width: 100%;">
                        <span>Start Trading</span>
                        <span>→</span>
                    </a>
                </div>

                <!-- Invest Service -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon">💰</div>
                        <div>
                            <h3>Invest With Us</h3>
                        </div>
                    </div>
                    <p>Build diversified wealth across all asset classes with professional portfolio management and
                        investment strategies.</p>
                    <ul class="service-features">
                        <li>Multi-Asset Portfolio Management</li>
                        <li>Strategic Asset Allocation</li>
                        <li>Comprehensive Market Analysis</li>
                        <li>Risk-Adjusted Returns Focus</li>
                        <li>Dedicated Portfolio Manager</li>
                        <li>Monthly Performance Reviews</li>
                    </ul>
                    <a href="/invest" class="btn btn-primary" style="width: 100%;">
                        <span>Start Investing</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="section" id="about">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Simple Process</span>
                <h2>How It Works</h2>
                <p>Start your trading journey in three simple steps</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">1️⃣</div>
                    <h3>Choose Your Path</h3>
                    <p>Select whether you want to learn, trade, or invest. You can always combine services as you grow.
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">2️⃣</div>
                    <h3>Get Personalized Guidance</h3>
                    <p>Our experts will assess your goals and create a customized trading plan across your preferred
                        markets, tailored to your experience level.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">3️⃣</div>
                    <h3>Start Your Journey</h3>
                    <p>Begin learning, trading, or investing with full support from our team and community every step of
                        the way.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Student Reviews Section -->
    <section class="section" id="reviews" style="background: var(--dark-light);">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Success Stories</span>
                <h2>What Our Students Say</h2>
                <p>Real results from real people learning with GSM Trading Lab</p>
            </div>
            <div class="features-grid">
                <!-- Review 1 -->
                <div class="feature-card" style="text-align: left;">
                    <div style="color: #F59E0B; margin-bottom: 0.5rem;">★★★★★</div>
                    <p style="font-style: italic; margin-bottom: 1.5rem;">"I started with zero knowledge about crypto.
                        The 'Learn Now, Pay Later' program gave me the confidence to start without risking my own money
                        first. Now I'm profitable!"</p>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div
                            style="width: 40px; height: 40px; background: var(--gradient-crypto); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">
                            AH</div>
                        <div>
                            <div style="font-weight: 600; color: var(--white);">Ali Hassan</div>
                            <div style="font-size: 0.8rem; color: var(--gray);">Crypto Student</div>
                        </div>
                    </div>
                </div>
                <!-- Review 2 -->
                <div class="feature-card" style="text-align: left;">
                    <div style="color: #F59E0B; margin-bottom: 0.5rem;">★★★★★</div>
                    <p style="font-style: italic; margin-bottom: 1.5rem;">"The live trading sessions are a game changer.
                        Seeing expert traders analyze the market in real-time helped me understand price action better
                        than any video course."</p>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div
                            style="width: 40px; height: 40px; background: var(--gradient-success); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">
                            SK</div>
                        <div>
                            <div style="font-weight: 600; color: var(--white);">Sarah Khan</div>
                            <div style="font-size: 0.8rem; color: var(--gray);">Premium Member</div>
                        </div>
                    </div>
                </div>
                <!-- Review 3 -->
                <div class="feature-card" style="text-align: left;">
                    <div style="color: #F59E0B; margin-bottom: 0.5rem;">★★★★★</div>
                    <p style="font-style: italic; margin-bottom: 1.5rem;">"GSM Trading Lab's signals are spot on. I
                        recovered my enrollment fee in just the first week of trading. Highly recommended for anyone
                        serious about trading."</p>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div
                            style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">
                            MR</div>
                        <div>
                            <div style="font-weight: 600; color: var(--white);">Muhammad Rizwan</div>
                            <div style="font-size: 0.8rem; color: var(--gray);">Forex Trader</div>
                        </div>
                    </div>
                </div>
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
                <h3 style="text-align: center; margin-bottom: 1.5rem; color: var(--white);">Share Your Experience</h3>
                <form
                    onsubmit="event.preventDefault(); alert('Thank you! Your review has been submitted for moderation.'); closeReviewModal();">
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; color: var(--white);">Your Name</label>
                        <input type="text" required
                            style="width: 100%; padding: 0.8rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: white;">
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; color: var(--white);">Rating</label>
                        <select
                            style="width: 100%; padding: 0.8rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: white;">
                            <option>★★★★★ (Excellent)</option>
                            <option>★★★★☆ (Good)</option>
                            <option>★★★☆☆ (Average)</option>
                            <option>★★☆☆☆ (Poor)</option>
                            <option>★☆☆☆☆ (Terrible)</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; color: var(--white);">Your Review</label>
                        <textarea rows="4" required
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
                <h2>Ready to Start Your Trading Journey?</h2>
                <p>Join thousands of successful traders and investors who trust us across all markets - Crypto, Forex,
                    Stocks, Indices, Commodities & Derivatives.</p>

                <!-- Social Media Links -->
                <div style="display: flex; gap: 1rem; justify-content: center; margin: 2rem 0; flex-wrap: wrap;">
                    <a href="https://facebook.com/gsmtradinglab" target="_blank"
                        style="text-decoration: none; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" width="40"
                            height="40">
                    </a>
                    <a href="https://instagram.com/gsmtradinglab" target="_blank"
                        style="text-decoration: none; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" width="40"
                            height="40">
                    </a>
                    <a href="https://threads.net/@gsmtradinglab" target="_blank"
                        style="text-decoration: none; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <img src="https://cdn-icons-png.flaticon.com/512/10856/10856184.png" alt="Threads" width="40"
                            height="40" style="filter: invert(1);">
                    </a>
                    <a href="https://twitter.com/gsmtradinglab" target="_blank"
                        style="text-decoration: none; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <img src="https://cdn-icons-png.flaticon.com/512/5968/5968830.png" alt="Twitter/X" width="40"
                            height="40" style="filter: invert(1);">
                    </a>
                    <a href="https://tiktok.com/@gsmtradinglab" target="_blank"
                        style="text-decoration: none; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <img src="https://cdn-icons-png.flaticon.com/512/3046/3046121.png" alt="TikTok" width="40"
                            height="40" style="filter: invert(1);">
                    </a>
                    <a href="https://snapchat.com/add/gsmtradinglab" target="_blank"
                        style="text-decoration: none; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <img src="https://cdn-icons-png.flaticon.com/512/3670/3670166.png" alt="Snapchat" width="40"
                            height="40">
                    </a>
                    <a href="https://discord.gg/gsmtradinglab" target="_blank"
                        style="text-decoration: none; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <img src="https://cdn-icons-png.flaticon.com/512/3670/3670157.png" alt="Discord" width="40"
                            height="40" style="filter: invert(1);">
                    </a>
                    <a href="https://linkedin.com/in/gsmtradinglab" target="_blank"
                        style="text-decoration: none; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                        <img src="https://cdn-icons-png.flaticon.com/512/3536/3536505.png" alt="LinkedIn" width="40"
                            height="40">
                    </a>
                    <a href="https://wa.me/447478035502" target="_blank"
                        style="text-decoration: none; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
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
</body>

</html>