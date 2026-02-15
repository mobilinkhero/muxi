<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn Crypto, Forex & Gold Trading - GSM Trading Lab Academy</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Master trading with a focus on Crypto, Forex, and Gold. Comprehensive courses for all markets including Stocks, Indices & Derivatives.">
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        /* Academy Page Mobile Fixes */
        @media (max-width: 768px) {
            .hero {
                padding-top: 100px;
                min-height: auto;
                padding-bottom: 3rem;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .services-grid {
                gap: 2rem;
            }

            .service-card {
                padding: 1.5rem;
            }

            .service-header {
                flex-direction: column;
                text-align: center;
            }

            .service-icon {
                margin: 0 auto 1rem;
            }

            #premiumModal,
            #verificationModal {
                padding: 1rem;
            }

            #premiumModal>div,
            #verificationModal>div {
                max-width: 100% !important;
                margin: 0;
            }

            .modal-content-box {
                padding: 1.5rem !important;
            }

            .price-display {
                font-size: 2rem !important;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar scrolled" id="navbar">
        <div class="container">
            <div class="nav-container">
                <a href="/" class="logo">
                    <img src="{{ $settings['site_logo'] ?? '/images/logo.svg' }}"
                        alt="{{ $settings['site_name'] ?? 'GSM Trading Lab' }}" style="height: 40px;">
                    <span
                        style="font-weight: bold; font-size: 1.2rem; color: var(--white); margin-left: 0.5rem;">{{ $settings['site_name'] ?? 'GSM Trading Lab' }}</span>
                </a>
                <ul class="nav-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="/#markets">Markets</a></li>
                    <li><a href="/#services">Services</a></li>
                    <li><a href="/#about">About</a></li>
                    @auth
                        @if(auth()->user()->is_admin)
                            <li><a href="{{ route('admin.dashboard') }}" class="btn btn-secondary"
                                    style="border-color: #f59e0b; color: #f59e0b;">Admin Panel</a></li>
                        @else
                            <li><a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}" class="btn btn-secondary" style="border: none;">Login</a></li>
                    @endauth
                    <li><a href="/#contact" class="btn btn-primary">Get Started</a></li>
                </ul>
            </div>
        </div>
    </nav>

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
                    <span>🎓</span>
                    <span>{{ $settings['site_name'] ?? 'GSM Trading Lab' }} Academy</span>
                </div>
                <h1>{{ $settings['learn_hero_title'] ?? 'Learn to Trade Like a Pro' }}</h1>
                <p class="hero-description">
                    {!! $settings['learn_hero_desc'] ?? 'Master trading with a focus on <strong>Risk Management & Live Execution</strong>. Get <strong>Lifetime Premium Access</strong> to daily live sessions, 1-on-1 mentorship, and 24/7 support. One-time fee, forever value.' !!}
                </p>
            </div>
        </div>
    </section>

    <!-- Learning Options Section -->
    <section class="section" style="background: var(--dark-light);">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Choose Your Learning Path</span>
                <h2>Start Your Trading Journey Today</h2>
                <p>Select the learning option that best fits your goals and budget</p>
            </div>

            <!-- Two Main Options -->
            <div class="services-grid" style="max-width: 1100px; margin: 0 auto;">

                <!-- Option 1: Learn Now, Pay Later -->
                <div class="service-card" style="border: 2px solid var(--primary); position: relative;">
                    <div
                        style="position: absolute; top: -15px; right: 20px; background: var(--primary); padding: 0.5rem 1.5rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; color: white; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);">
                        {{ $settings['learn_opt1_badge'] ?? '🤝 TRUST BASED' }}
                    </div>
                    <div class="service-header">
                        <div class="service-icon">🎓</div>
                        <div>
                            <h3>{{ $settings['learn_opt1_title'] ?? 'Learn Now, Pay Later' }}</h3>
                        </div>
                    </div>
                    <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
                        {!! $settings['learn_opt1_desc'] ?? '<strong>Have Trust Issues? We Understand.</strong><br> We trust YOU first. Get full premium access upfront.' !!}
                    </p>
                    build a relationship of trust. Pay us only after you learn and earn.
                    </p>

                    <div
                        style="background: rgba(99, 102, 241, 0.1); border-radius: var(--radius-md); padding: 1.5rem; margin-bottom: 1.5rem;">
                        <h4 style="color: var(--primary-light); margin-bottom: 1rem; font-size: 1.1rem;">✨ Everything in
                            Premium:</h4>
                        <ul class="service-features" style="margin-bottom: 0;">
                            <li>🔴 <strong>Live Trading Sessions</strong></li>
                            <li>🛡️ <strong>Risk Management Priority</strong></li>
                            <li>🤝 <strong>24/7 Lifetime Support</strong></li>
                            <li>👨‍🏫 <strong>1-on-1 Training (Optional)</strong></li>
                            <li>💎 <strong>Premium Signals & Analysis</strong></li>
                            <li>♾️ <strong>One-Time Fee, Lifetime Access</strong></li>
                            <li>Advanced Tools & Strategies</li>
                        </ul>
                    </div>

                    <div
                        style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: var(--radius-md); padding: 1rem; margin-bottom: 1.5rem; text-align: center;">
                        <div style="font-size: 0.9rem; color: var(--gray-light); margin-bottom: 0.25rem;">Start Today
                        </div>
                        <div
                            style="font-size: 2.5rem; font-weight: 800; background: var(--gradient-success); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1;">
                            $0 <span style="font-size: 1rem; color: var(--gray);">/ Upfront</span>
                        </div>
                        <div style="font-size: 0.85rem; color: var(--white); margin-top: 0.5rem;">Pay <span
                                style="text-decoration: line-through; color: #ef4444; margin-right: 4px;">$350</span>
                            $100 Only After You Learn & Earn</div>
                    </div>

                    <a href="#" class="btn btn-primary" style="width: 100%;"
                        onclick="event.preventDefault(); openVerificationModal();">
                        <span>Get Trusted Access</span>
                        <span>→</span>
                    </a>

                    <div style="margin-top: 1rem; text-align: center; font-size: 0.9rem; color: var(--gray);">
                        ✓ We Trust You • ✓ Verify & Start
                    </div>
                </div>

                <!-- Option 2: Premium Live Trading Course (Upfront) -->
                <div class="service-card" style="border: 2px solid var(--accent); position: relative;">
                    <div
                        style="position: absolute; top: -15px; right: 20px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 0.5rem 1.5rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; color: white; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);">
                        🛡️ MONEY BACK GUARANTEE
                    </div>
                    <div class="service-header">
                        <div class="service-icon"
                            style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">🔥</div>
                        <div>
                            <h3>Premium Access (Upfront)</h3>
                        </div>
                    </div>
                    <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
                        <strong>Risk-Free Investment</strong>. Skip the verification hassle. Pay confidently knowing
                        that if you aren't satisfied, we promote a <strong>Full Refund Policy</strong>.
                    </p>

                    <div
                        style="background: rgba(245, 158, 11, 0.1); border-radius: var(--radius-md); padding: 1.5rem; margin-bottom: 1.5rem;">
                        <h4 style="color: var(--accent-light); margin-bottom: 1rem; font-size: 1.1rem;">🚀 Premium
                            Features + Guarantee:</h4>
                        <ul class="service-features" style="margin-bottom: 0;">
                            <li><strong>✅ 100% Money-Back Guarantee</strong></li>
                            <li>🔴 <strong>Live Trading Sessions</strong></li>
                            <li>🛡️ <strong>Risk Management Priority</strong></li>
                            <li>🤝 <strong>24/7 Lifetime Support</strong></li>
                            <li>👨‍🏫 <strong>1-on-1 Training (Optional)</strong></li>
                            <li>💎 <strong>Premium Signals & Analysis</strong></li>
                            <li>♾️ <strong>One-Time Fee, Lifetime Access</strong></li>
                        </ul>
                    </div>

                    <div
                        style="background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: var(--radius-md); padding: 1rem; margin-bottom: 1.5rem; text-align: center;">
                        <div style="font-size: 0.9rem; color: var(--gray-light); margin-bottom: 0.25rem;">Professional
                            Training</div>
                        <div style="font-size: 2.5rem; font-weight: 800; color: var(--accent-light); line-height: 1;">
                            <span
                                style="font-size: 1.5rem; text-decoration: line-through; color: var(--gray); margin-right: 8px;">$350</span>$100
                        </div>
                        <div style="font-size: 0.85rem; color: #ef4444; font-weight: bold; margin-top: 5px;">🔥 Limited
                            Time Offer (Save 70%)</div>
                        <div style="font-size: 0.85rem; color: var(--gray);">Refundable if not satisfied</div>
                    </div>

                    <a href="#" class="btn"
                        style="width: 100%; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;"
                        onclick="event.preventDefault(); openPremiumModal();">
                        <span>Get Instant Access</span>
                        <span>→</span>
                    </a>

                    <div style="margin-top: 1rem; text-align: center; font-size: 0.9rem; color: var(--gray);">
                        ✓ Secure Payment • ✓ Satisfaction Guaranteed
                    </div>
                </div>

            </div>

            <!-- Transparency Note -->
            <div
                style="max-width: 800px; margin: 3rem auto 0; text-align: center; padding: 2rem; background: rgba(99, 102, 241, 0.05); border-radius: var(--radius-lg); border: 1px solid rgba(99, 102, 241, 0.2);">
                <h3 style="color: var(--primary-light); margin-bottom: 1rem;">🔍 Complete Transparency</h3>
                <p style="color: var(--gray-light); margin-bottom: 1.5rem; line-height: 1.6;">
                    <strong>Two Paths to Premium:</strong><br>
                    1. <strong>Trust Based:</strong> We trust you first (verification required), you pay later.<br>
                    2. <strong>Money Back Guarantee:</strong> You pay upfront (no strict verification), we guarantee
                    your satisfaction or full refund.<br>
                    <span style="color: var(--white); font-weight: 600; display: block; margin-top: 0.5rem;">Both
                        options are 100% Risk Free. Choose what suits you.</span>
                </p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <div
                        style="flex: 1; min-width: 200px; padding: 1rem; background: var(--dark); border-radius: var(--radius-md); border: 1px solid rgba(255,255,255,0.05);">
                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">🤝</div>
                        <div style="font-weight: 600; color: var(--white); margin-bottom: 0.25rem;">Student First</div>
                        <div style="font-size: 0.9rem; color: var(--gray);">Learn First, Pay Later</div>
                    </div>
                    <div
                        style="flex: 1; min-width: 200px; padding: 1rem; background: var(--dark); border-radius: var(--radius-md); border: 1px solid rgba(255,255,255,0.05);">
                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">🛡️</div>
                        <div style="font-weight: 600; color: var(--white); margin-bottom: 0.25rem;">Refund Guarantee
                        </div>
                        <div style="font-size: 0.9rem; color: var(--gray);">Satisfaction or Money Back</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Live Trading Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Why Live Trading?</span>
                <h2>Learn in Real-Time, Not From Old Videos</h2>
                <p>Our premium course focuses on LIVE sessions because markets change every day</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Real-Time Learning</h3>
                    <p>Learn as markets move. Understand how to react to live market conditions, not outdated scenarios
                        from recorded videos.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💬</div>
                    <h3>Direct Interaction</h3>
                    <p>Ask questions instantly during live sessions. Get immediate answers from expert traders while
                        opportunities are happening.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3>Current Market Focus</h3>
                    <p>Every session covers today's market conditions, latest trends, and current opportunities - always
                        relevant, never outdated.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3>Private Sessions</h3>
                    <p>Small group sizes ensure personalized attention. Your questions matter, and you get the guidance
                        you need.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🛡️</div>
                    <h3>Risk Management First</h3>
                    <p>Our top priority. Learn strict discipline, position sizing, and capital preservation to survive
                        and thrive long-term.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Live Market Analysis</h3>
                    <p>Watch experts analyze charts in real-time. Learn their thought process as they make trading
                        decisions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Registration Modal -->
    <div id="premiumModal"
        style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.9); z-index: 9999; overflow-y: auto; padding: 2rem;">
        <div style="max-width: 600px; margin: 0 auto; position: relative;">
            <!-- Close Button -->
            <button onclick="closePremiumModal()"
                style="position: absolute; top: -10px; right: -10px; width: 40px; height: 40px; border-radius: 50%; background: var(--accent); color: white; border: none; font-size: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10000;">×</button>

            <!-- Modal Content -->
            <div class="modal-content-box"
                style="background: var(--dark); border: 2px solid var(--accent); border-radius: var(--radius-lg); padding: 2.5rem; margin-top: 1rem;">

                <!-- Step Indicator -->
                <div style="display: flex; justify-content: center; gap: 1rem; margin-bottom: 2rem;">
                    <div id="step-indicator-1"
                        style="flex: 1; text-align: center; padding: 0.75rem; background: var(--accent); border-radius: var(--radius-md); transition: var(--transition-base);">
                        <div style="font-size: 0.85rem; font-weight: 600; color: white;">Step 1</div>
                        <div style="font-size: 0.75rem; color: rgba(255,255,255,0.9);">Payment</div>
                    </div>
                    <div id="step-indicator-2"
                        style="flex: 1; text-align: center; padding: 0.75rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); transition: var(--transition-base);">
                        <div style="font-size: 0.85rem; font-weight: 600; color: var(--gray);">Step 2</div>
                        <div style="font-size: 0.75rem; color: var(--gray);">Your Details</div>
                    </div>
                </div>

                <!-- STEP 1: Payment -->
                <div id="payment-step" style="display: block;">
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <h2 style="color: var(--white); margin-bottom: 0.5rem;">💳 Complete Payment</h2>
                        <p style="color: var(--gray-light); font-size: 1rem;">Pay $100 in cryptocurrency to unlock
                            premium access</p>
                    </div>

                    <!-- Price Display -->
                    <div
                        style="background: rgba(245, 158, 11, 0.1); border-radius: var(--radius-md); padding: 1.5rem; margin-bottom: 2rem; text-align: center;">
                        <div style="font-size: 0.9rem; color: var(--gray-light); margin-bottom: 0.5rem;">Total Amount
                        </div>
                        <div class="price-display"
                            style="font-size: 3rem; font-weight: 800; color: var(--accent-light); line-height: 1;">
                            <span
                                style="font-size: 1.5rem; text-decoration: line-through; color: var(--gray); margin-right: 10px;">$350</span>$100
                        </div>
                        <div style="font-size: 0.85rem; color: var(--gray); margin-top: 0.5rem;">≈ 0.0024 BTC or 0.038
                            ETH</div>
                    </div>

                    <!-- Crypto Payment Options -->
                    <div style="margin-bottom: 2rem;">
                        <label
                            style="display: block; color: var(--white); font-weight: 600; margin-bottom: 1rem; font-size: 1rem;">Choose
                            Payment Method:</label>

                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            @foreach($paymentMethods as $method)
                                <label
                                    style="display: flex; align-items: center; gap: 1rem; padding: 1rem; background: var(--dark-light); border: 2px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); cursor: pointer; transition: var(--transition-base);"
                                    onclick="selectPaymentMethod('{{ strtolower(str_replace(' ', '_', $method->name)) }}', this)">
                                    <input type="radio" name="crypto"
                                        value="{{ strtolower(str_replace(' ', '_', $method->name)) }}"
                                        style="width: 20px; height: 20px; cursor: pointer;">
                                    @if($method->icon)
                                        <img src="{{ $method->icon }}" alt="{{ $method->name }}" width="32" height="32"
                                            style="object-fit: contain;">
                                    @endif
                                    <div style="flex: 1;">
                                        <div style="font-weight: 600; color: var(--white); margin-bottom: 0.25rem;">
                                            {{ $method->name }}
                                        </div>
                                        <div style="font-size: 0.85rem; color: var(--gray);">Network: {{ $method->network }}
                                        </div>
                                        @if($method->instruction)
                                            <div style="font-size: 0.75rem; color: var(--primary-light); margin-top: 2px;">
                                                {{ $method->instruction }}
                                            </div>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Payment Address (Hidden by default) -->
                    <div id="payment-address" style="display: none; margin-bottom: 2rem;">
                        <div
                            style="background: rgba(99, 102, 241, 0.1); border: 1px solid var(--primary); border-radius: var(--radius-md); padding: 1.5rem;">
                            <div
                                style="font-weight: 600; color: var(--white); margin-bottom: 1rem; text-align: center;">
                                Send payment to this address:</div>
                            <div style="background: var(--dark); padding: 1rem; border-radius: var(--radius-sm); font-family: monospace; word-break: break-all; text-align: center; color: var(--primary-light); font-size: 0.9rem; margin-bottom: 1rem;"
                                id="crypto-address">
                                <!-- Address will be inserted here -->
                            </div>
                            <div style="text-align: center;">
                                <button onclick="copyAddress()"
                                    style="padding: 0.5rem 1.5rem; background: var(--primary); color: white; border: none; border-radius: var(--radius-sm); cursor: pointer; font-weight: 600;">
                                    📋 Copy Address
                                </button>
                            </div>
                            <div
                                style="margin-top: 1rem; padding: 1rem; background: rgba(245, 158, 11, 0.1); border-radius: var(--radius-sm); font-size: 0.85rem; color: var(--gray-light); text-align: center;">
                                ⚠️ Important: Send exact amount to the address above. After payment, click "I've Paid"
                                below.
                            </div>
                        </div>
                    </div>

                    <!-- Payment Confirmation -->
                    <div id="payment-confirmation" style="display: none; margin-bottom: 1.5rem;">
                        <label
                            style="display: flex; align-items: center; gap: 0.75rem; padding: 1rem; background: rgba(16, 185, 129, 0.1); border: 1px solid var(--secondary); border-radius: var(--radius-md); cursor: pointer;">
                            <input type="checkbox" id="payment-confirmed"
                                style="width: 20px; height: 20px; cursor: pointer;">
                            <span style="color: var(--gray-light); font-size: 0.95rem;">
                                I have sent the payment to the address above
                            </span>
                        </label>
                    </div>

                    <!-- Next Button -->
                    <button id="next-to-step2" onclick="goToStep2()" disabled
                        style="width: 100%; padding: 1rem 2rem; background: var(--gray); color: white; border: none; border-radius: var(--radius-md); font-size: 1.1rem; font-weight: 600; cursor: not-allowed; transition: var(--transition-base);">
                        Next: Enter Your Details →
                    </button>
                </div>

                <!-- STEP 2: Client Data -->
                <div id="details-step" style="display: none;">
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <h2 style="color: var(--white); margin-bottom: 0.5rem;">📝 Your Information</h2>
                        <p style="color: var(--gray-light); font-size: 1rem;">Complete your registration to access
                            premium features</p>
                    </div>

                    <form id="clientDetailsForm" action="{{ route('order.submit') }}" method="POST"
                        enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @csrf
                        <input type="hidden" name="service_name" value="GSM Premium Trading Course (Upfront)">
                        <input type="hidden" name="amount" value="100">
                        <input type="hidden" name="currency" value="USD">
                        <input type="hidden" name="modal_id" value="premiumModal">
                        <!-- Full Name -->
                        <div>
                            <label
                                style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                Full Name <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="text" name="fullName" required
                                style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                                placeholder="Enter your full name">
                        </div>

                        <!-- Email -->
                        <div>
                            <label
                                style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                Email Address <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="email" name="email" required
                                style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                                placeholder="your.email@example.com">
                        </div>

                        @if(!auth()->check())
                            <!-- Password for new account -->
                            <div>
                                <label
                                    style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                    Create Account Password <span style="color: #ef4444;">*</span>
                                </label>
                                <input type="password" name="password" required
                                    style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                                    placeholder="Minimum 8 characters">
                                <div style="margin-top: 0.5rem; font-size: 0.8rem; color: var(--gray);">
                                    🔑 You will use this password to login later
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="password" value="ALREADY_LOGGED_IN">
                        @endif
                        <div>
                            <label
                                style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                Phone Number <span style="color: #ef4444;">*</span>
                            </label>
                            <div style="display: flex; gap: 0.75rem;">
                                <select id="countryCode" name="countryCode" required
                                    style="width: 140px; padding: 0.875rem 0.75rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem;">
                                    <option value="+1">🇺🇸 +1</option>
                                    <option value="+44">🇬🇧 +44</option>
                                    <option value="+91">🇮🇳 +91</option>
                                    <option value="+92">🇵🇰 +92</option>
                                    <option value="+971">🇦🇪 +971</option>
                                    <option value="+966">🇸🇦 +966</option>
                                    <option value="+20">🇪🇬 +20</option>
                                    <option value="+234">🇳🇬 +234</option>
                                    <option value="+27">🇿🇦 +27</option>
                                    <option value="+61">🇦🇺 +61</option>
                                    <option value="+86">🇨🇳 +86</option>
                                    <option value="+81">🇯🇵 +81</option>
                                    <option value="+82">🇰🇷 +82</option>
                                    <option value="+49">🇩🇪 +49</option>
                                    <option value="+33">🇫🇷 +33</option>
                                    <option value="+39">🇮🇹 +39</option>
                                    <option value="+34">🇪🇸 +34</option>
                                    <option value="+7">🇷🇺 +7</option>
                                    <option value="+55">🇧🇷 +55</option>
                                    <option value="+52">🇲🇽 +52</option>
                                    <option value="+62">🇮🇩 +62</option>
                                    <option value="+60">🇲🇾 +60</option>
                                    <option value="+65">🇸🇬 +65</option>
                                    <option value="+63">🇵🇭 +63</option>
                                    <option value="+66">🇹🇭 +66</option>
                                    <option value="+84">🇻🇳 +84</option>
                                    <option value="+880">🇧🇩 +880</option>
                                    <option value="+90">🇹🇷 +90</option>
                                    <option value="+98">🇮🇷 +98</option>
                                    <option value="+212">🇲🇦 +212</option>
                                </select>
                                <input type="tel" id="phoneNumber" name="phone" required
                                    style="flex: 1; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                                    placeholder="Enter phone number">
                            </div>
                        </div>

                        <!-- WhatsApp Number -->
                        <div>
                            <label
                                style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                WhatsApp Number <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="tel" name="whatsapp" required
                                style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                                placeholder="Enter WhatsApp with country code">
                            <div style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray);">
                                📱 For emergency contact and class updates
                            </div>
                        </div>
                        <div>
                            <label
                                style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                Transaction ID (TRX ID) <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="text" name="txId" required
                                style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem; font-family: monospace;"
                                placeholder="Enter your transaction hash/ID">
                            <div style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray);">
                                💡 Copy the transaction ID from your crypto wallet after sending payment
                            </div>
                        </div>

                        <!-- Payment Screenshot -->
                        <div>
                            <label
                                style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                Payment Screenshot <span style="color: #ef4444;">*</span>
                            </label>
                            <div style="position: relative;">
                                <input type="file" id="paymentScreenshot" name="screenshot" accept="image/*" required
                                    style="display: none;" onchange="handleScreenshotUpload(this)">
                                <label for="paymentScreenshot"
                                    style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; background: var(--dark-light); border: 2px dashed rgba(255,255,255,0.2); border-radius: var(--radius-md); cursor: pointer; transition: var(--transition-base);"
                                    onmouseover="this.style.borderColor='var(--accent)'"
                                    onmouseout="this.style.borderColor='rgba(255,255,255,0.2)'">
                                    <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📸</div>
                                    <div style="color: var(--white); font-weight: 600; margin-bottom: 0.25rem;">Click to
                                        upload screenshot</div>
                                    <div style="color: var(--gray); font-size: 0.85rem;">PNG, JPG up to 10MB</div>
                                </label>
                            </div>
                            <div id="screenshot-preview"
                                style="display: none; margin-top: 1rem; padding: 1rem; background: rgba(16, 185, 129, 0.1); border: 1px solid var(--secondary); border-radius: var(--radius-md);">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="font-size: 1.5rem;">✅</div>
                                    <div style="flex: 1;">
                                        <div style="color: var(--white); font-weight: 600; font-size: 0.9rem;"
                                            id="screenshot-name"></div>
                                        <div style="color: var(--gray); font-size: 0.8rem;" id="screenshot-size"></div>
                                    </div>
                                    <button type="button" onclick="removeScreenshot()"
                                        style="padding: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: var(--radius-sm); color: var(--gray-light); cursor: pointer;">
                                        🗑️
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            style="width: 100%; padding: 1rem 2rem; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; border-radius: var(--radius-md); font-size: 1.1rem; font-weight: 600; cursor: pointer; margin-top: 1rem;">
                            Complete Registration ✓
                        </button>
                    </form>

                    <!-- Back Button -->
                    <button onclick="goToStep1()"
                        style="width: 100%; padding: 0.75rem; background: transparent; color: var(--gray-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); font-size: 0.95rem; cursor: pointer; margin-top: 1rem;">
                        ← Back to Payment
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- Verification Modal for Free Demo -->
    <div id="verificationModal"
        style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.9); z-index: 9999; overflow-y: auto; padding: 2rem;">
        <div style="max-width: 700px; margin: 0 auto; position: relative;">
            <!-- Close Button -->
            <button onclick="closeVerificationModal()"
                style="position: absolute; top: -10px; right: -10px; width: 40px; height: 40px; border-radius: 50%; background: var(--primary); color: white; border: none; font-size: 1.5rem; cursor: pointer; display: flex; align-items: center; justify-content: center; z-index: 10000;">×</button>

            <!-- Modal Content -->
            <div class="modal-content-box"
                style="background: var(--dark); border: 2px solid var(--primary); border-radius: var(--radius-lg); padding: 2.5rem; margin-top: 1rem;">

                <!-- Header -->
                <div style="text-align: center; margin-bottom: 2rem;">
                    <h2 style="color: var(--white); margin-bottom: 0.5rem;">🤝 Let's Build Trust</h2>
                    <p style="color: var(--gray-light); font-size: 1rem;">
                        We are trusting you with our premium course upfront. <br>
                        Please verify your identity so we can start this journey with mutual trust.
                    </p>
                </div>

                <!-- Info Box -->
                <div
                    style="background: rgba(99, 102, 241, 0.1); border: 1px solid var(--primary); border-radius: var(--radius-md); padding: 1.5rem; margin-bottom: 2rem;">
                    <h4 style="color: var(--primary-light); margin-bottom: 1rem; font-size: 1rem;">📋 Required
                        Documents:</h4>
                    <ul
                        style="color: var(--gray-light); font-size: 0.9rem; line-height: 1.8; margin: 0; padding-left: 1.5rem;">
                        <li>Valid CNIC Number (13 digits)</li>
                        <li>CNIC Front Photo (clear & readable)</li>
                        <li>CNIC Back Photo (clear & readable)</li>
                        <li>Profile Photo (passport style)</li>
                        <li>Mobile Number (registered on your name)</li>
                    </ul>
                </div>

                <!-- Verification Form -->
                <form id="verificationForm" action="{{ route('order.submit') }}" method="POST"
                    enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @csrf
                    <input type="hidden" name="service_name" value="Premium Access (Pay Later) Verification">
                    <input type="hidden" name="amount" value="0">
                    <input type="hidden" name="currency" value="PKR">
                    <input type="hidden" name="payment_method" value="Verification">
                    <input type="hidden" name="modal_id" value="verificationModal">

                    <!-- Email -->
                    <div>
                        <label
                            style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                            Email Address <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="email" name="email" required value="{{ old('email') }}"
                            style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid {{ $errors->has('email') ? '#ef4444' : 'rgba(255,255,255,0.1)' }}; border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                            placeholder="your.email@example.com">
                        @error('email')
                            <div style="color: #ef4444; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    @if(!auth()->check())
                        <!-- Password for new account -->
                        <div>
                            <label
                                style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                Create Account Password <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="password" name="password" required
                                style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid {{ $errors->has('password') ? '#ef4444' : 'rgba(255,255,255,0.1)' }}; border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                                placeholder="Minimum 8 characters">
                            @error('password')
                                <div style="color: #ef4444; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</div>
                            @enderror
                            <div style="margin-top: 0.5rem; font-size: 0.8rem; color: var(--gray);">
                                🔑 You will use this password to login later
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="password" value="ALREADY_LOGGED_IN">
                    @endif

                    <!-- Full Name -->
                    <div>
                        <label
                            style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                            Full Name (as per CNIC) <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="fullName" required
                            style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                            placeholder="Enter your full name">
                    </div>

                    <!-- CNIC Number -->
                    <div>
                        <label
                            style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                            CNIC Number <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="text" name="cnicNumber" required maxlength="15"
                            style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem; font-family: monospace;"
                            placeholder="XXXXX-XXXXXXX-X" oninput="formatCNIC(this)">
                        <div style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray);">
                            💡 Enter 13-digit CNIC without dashes
                        </div>
                    </div>

                    <!-- Mobile Number -->
                    <div>
                        <label
                            style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                            Mobile Number (Registered on Your Name) <span style="color: #ef4444;">*</span>
                        </label>
                        <div style="display: flex; gap: 0.75rem;">
                            <div
                                style="width: 100px; padding: 0.875rem 0.75rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem; text-align: center;">
                                🇵🇰 +92
                            </div>
                            <input type="tel" name="mobile" required maxlength="10" value="{{ old('mobile') }}"
                                style="flex: 1; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid {{ $errors->has('mobile') ? '#ef4444' : 'rgba(255,255,255,0.1)' }}; border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                                placeholder="3XXXXXXXXX" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                        </div>
                        @error('mobile')
                            <div style="color: #ef4444; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                        <div style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray);">
                            ⚠️ Number must be registered on your CNIC name
                        </div>
                    </div>

                    <!-- WhatsApp Number -->
                    <div>
                        <label
                            style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                            WhatsApp Number <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="tel" name="whatsapp" required value="{{ old('whatsapp') }}"
                            style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid {{ $errors->has('whatsapp') ? '#ef4444' : 'rgba(255,255,255,0.1)' }}; border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                            placeholder="Enter WhatsApp with country code">
                        @error('whatsapp')
                            <div style="color: #ef4444; font-size: 0.85rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                        <div style="margin-top: 0.5rem; font-size: 0.85rem; color: var(--gray);">
                            📱 For emergency contact and class updates
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            @if ($errors->any())
                                const oldModalId = "{{ old('modal_id') }}";
                                if (oldModalId === 'verificationModal') {
                                    openVerificationModal();
                                } else if (oldModalId === 'premiumModal') {
                                    openPremiumModal();
                                    // If step 2 was active, we might need to switch to it, but default is step 1.
                                    // However, if validation failed, it means they were on step 2 (details).
                                    // So let's force go to step 2.
                                    goToStep2();
                                }
                            @endif
        });
                    </script>
                    <div>
                        <label
                            style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                            CNIC Front Photo <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="file" id="cnicFront" name="cnicFront" accept="image/*" capture="environment"
                            required style="display: none;"
                            onchange="handlePhotoUpload(this, 'cnicFrontPreview', 'CNIC Front')">
                        <label for="cnicFront"
                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; background: var(--dark-light); border: 2px dashed rgba(255,255,255,0.2); border-radius: var(--radius-md); cursor: pointer; transition: var(--transition-base);"
                            onmouseover="this.style.borderColor='var(--primary)'"
                            onmouseout="this.style.borderColor='rgba(255,255,255,0.2)'">
                            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📷</div>
                            <div style="color: var(--white); font-weight: 600; margin-bottom: 0.25rem;">Click to
                                capture/upload CNIC Front</div>
                            <div style="color: var(--gray); font-size: 0.85rem;">Make sure all details are clearly
                                visible</div>
                        </label>
                        <div id="cnicFrontPreview" style="display: none; margin-top: 1rem;"></div>
                    </div>

                    <!-- CNIC Back Photo -->
                    <div>
                        <label
                            style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                            CNIC Back Photo <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="file" id="cnicBack" name="cnicBack" accept="image/*" capture="environment" required
                            style="display: none;" onchange="handlePhotoUpload(this, 'cnicBackPreview', 'CNIC Back')">
                        <label for="cnicBack"
                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; background: var(--dark-light); border: 2px dashed rgba(255,255,255,0.2); border-radius: var(--radius-md); cursor: pointer; transition: var(--transition-base);"
                            onmouseover="this.style.borderColor='var(--primary)'"
                            onmouseout="this.style.borderColor='rgba(255,255,255,0.2)'">
                            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">📷</div>
                            <div style="color: var(--white); font-weight: 600; margin-bottom: 0.25rem;">Click to
                                capture/upload CNIC Back</div>
                            <div style="color: var(--gray); font-size: 0.85rem;">Make sure all details are clearly
                                visible</div>
                        </label>
                        <div id="cnicBackPreview" style="display: none; margin-top: 1rem;"></div>
                    </div>

                    <!-- Profile Photo -->
                    <div>
                        <label
                            style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                            Profile Photo <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" capture="user"
                            required style="display: none;"
                            onchange="handlePhotoUpload(this, 'profilePhotoPreview', 'Profile Photo')">
                        <label for="profilePhoto"
                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; background: var(--dark-light); border: 2px dashed rgba(255,255,255,0.2); border-radius: var(--radius-md); cursor: pointer; transition: var(--transition-base);"
                            onmouseover="this.style.borderColor='var(--primary)'"
                            onmouseout="this.style.borderColor='rgba(255,255,255,0.2)'">
                            <div style="font-size: 2.5rem; margin-bottom: 0.5rem;">🤳</div>
                            <div style="color: var(--white); font-weight: 600; margin-bottom: 0.25rem;">Click to
                                capture/upload Profile Photo</div>
                            <div style="color: var(--gray); font-size: 0.85rem;">Clear face photo (passport style)</div>
                        </label>
                        <div id="profilePhotoPreview" style="display: none; margin-top: 1rem;"></div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label
                            style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                            Email Address <span style="color: #ef4444;">*</span>
                        </label>
                        <input type="email" name="email" required
                            style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                            placeholder="your.email@example.com">
                    </div>

                    @if(!auth()->check())
                        <!-- Password for new account -->
                        <div>
                            <label
                                style="display: block; color: var(--white); font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                Create Account Password <span style="color: #ef4444;">*</span>
                            </label>
                            <input type="password" name="password" required
                                style="width: 100%; padding: 0.875rem 1rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: var(--white); font-size: 1rem;"
                                placeholder="Minimum 8 characters">
                            <div style="margin-top: 0.5rem; font-size: 0.8rem; color: var(--gray);">
                                🔑 You will use this password to login later
                            </div>
                        </div>
                    @else
                        <input type="hidden" name="password" value="ALREADY_LOGGED_IN">
                    @endif

                    <!-- Submit Button -->
                    <button type="submit"
                        style="width: 100%; padding: 1rem 2rem; background: var(--gradient-crypto); color: white; border: none; border-radius: var(--radius-md); font-size: 1.1rem; font-weight: 600; cursor: pointer; margin-top: 1rem;">
                        Submit for Verification ✓
                    </button>
                </form>

                <!-- Note -->
                <div
                    style="margin-top: 1.5rem; padding: 1rem; background: rgba(245, 158, 11, 0.1); border-radius: var(--radius-md); text-align: center;">
                    <div style="color: var(--gray-light); font-size: 0.9rem;">
                        🔒 Your information is secure and will only be used for verification purposes
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Crypto addresses from server
        const cryptoAddresses = {
            @foreach($paymentMethods as $method)
                '{{ strtolower(str_replace(' ', '_', $method->name)) }}': '{{ $method->account_number }}',
            @endforeach
        };

        let selectedCrypto = '';
        let uploadedScreenshot = null;

        // Country code mapping
        const countryCodeMap = {
            'US': '+1', 'GB': '+44', 'IN': '+91', 'PK': '+92', 'AE': '+971',
            'SA': '+966', 'EG': '+20', 'NG': '+234', 'ZA': '+27', 'AU': '+61',
            'CN': '+86', 'JP': '+81', 'KR': '+82', 'DE': '+49', 'FR': '+33',
            'IT': '+39', 'ES': '+34', 'RU': '+7', 'BR': '+55', 'MX': '+52',
            'ID': '+62', 'MY': '+60', 'SG': '+65', 'PH': '+63', 'TH': '+66',
            'VN': '+84', 'BD': '+880', 'TR': '+90', 'IR': '+98', 'MA': '+212'
        };

        // Detect user's country silently in background
        function detectCountry() {
            const dropdown = document.getElementById('countryCode');

            // Try multiple APIs in order
            tryAPI1()
                .catch(() => tryAPI2())
                .catch(() => tryAPI3())
                .catch(() => {
                    console.log('Country detection failed, using default +1');
                });

            // API 1: ip-api.com (free, no key required)
            function tryAPI1() {
                return fetch('http://ip-api.com/json/')
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            setCountry(data.countryCode, data.country);
                            return Promise.resolve();
                        }
                        return Promise.reject();
                    });
            }

            // API 2: ipapi.co
            function tryAPI2() {
                return fetch('https://ipapi.co/json/')
                    .then(response => response.json())
                    .then(data => {
                        if (data.country_code) {
                            setCountry(data.country_code, data.country_name);
                            return Promise.resolve();
                        }
                        return Promise.reject();
                    });
            }

            // API 3: ipinfo.io (free tier)
            function tryAPI3() {
                return fetch('https://ipinfo.io/json?token=')
                    .then(response => response.json())
                    .then(data => {
                        if (data.country) {
                            setCountry(data.country, data.country);
                            return Promise.resolve();
                        }
                        return Promise.reject();
                    });
            }

            function setCountry(countryCode, countryName) {
                const phoneCode = countryCodeMap[countryCode] || '+1';

                console.log('✓ Auto-detected country:', countryName, '→', phoneCode);

                if (dropdown) {
                    dropdown.value = phoneCode;
                }
            }
        }

        // Handle screenshot upload
        function handleScreenshotUpload(input) {
            const file = input.files[0];
            if (file) {
                // Check file size (10MB max)
                if (file.size > 10 * 1024 * 1024) {
                    alert('File size must be less than 10MB');
                    input.value = '';
                    return;
                }

                // Check file type
                if (!file.type.startsWith('image/')) {
                    alert('Please upload an image file (PNG, JPG, etc.)');
                    input.value = '';
                    return;
                }

                uploadedScreenshot = file;

                // Show preview
                document.getElementById('screenshot-name').textContent = file.name;
                document.getElementById('screenshot-size').textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                document.getElementById('screenshot-preview').style.display = 'block';
            }
        }

        // Remove screenshot
        function removeScreenshot() {
            document.getElementById('paymentScreenshot').value = '';
            uploadedScreenshot = null;
            document.getElementById('screenshot-preview').style.display = 'none';
        }

        function openPremiumModal() {
            document.getElementById('premiumModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closePremiumModal() {
            document.getElementById('premiumModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            // Reset to step 1
            goToStep1();
            // Reset form
            document.getElementById('clientDetailsForm').reset();
            removeScreenshot();
        }

        function selectPaymentMethod(crypto, element) {
            selectedCrypto = crypto;

            // Update all labels to default style
            document.querySelectorAll('label[onclick^="selectPaymentMethod"]').forEach(label => {
                label.style.borderColor = 'rgba(255,255,255,0.1)';
            });

            // Highlight selected
            element.style.borderColor = 'var(--accent)';

            // Show payment address
            document.getElementById('crypto-address').textContent = cryptoAddresses[crypto];
            document.getElementById('payment-address').style.display = 'block';
            document.getElementById('payment-confirmation').style.display = 'block';
        }

        function copyAddress() {
            const address = document.getElementById('crypto-address').textContent;
            navigator.clipboard.writeText(address);
            alert('Address copied to clipboard!');
        }

        // Enable next button when payment is confirmed
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('payment-confirmed');
            const nextBtn = document.getElementById('next-to-step2');

            if (checkbox) {
                checkbox.addEventListener('change', function () {
                    if (this.checked && selectedCrypto) {
                        nextBtn.disabled = false;
                        nextBtn.style.background = 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)';
                        nextBtn.style.cursor = 'pointer';
                    } else {
                        nextBtn.disabled = true;
                        nextBtn.style.background = 'var(--gray)';
                        nextBtn.style.cursor = 'not-allowed';
                    }
                });
            }
        });

        function goToStep2() {
            if (!selectedCrypto || !document.getElementById('payment-confirmed').checked) {
                alert('Please select a payment method and confirm payment first.');
                return;
            }

            document.getElementById('payment-step').style.display = 'none';
            document.getElementById('details-step').style.display = 'block';

            // Detect country when showing Step 2
            detectCountry();

            // Update step indicators
            document.getElementById('step-indicator-1').style.background = 'var(--dark-light)';
            document.getElementById('step-indicator-1').style.border = '1px solid rgba(255,255,255,0.1)';
            document.getElementById('step-indicator-1').querySelector('div').style.color = 'var(--gray)';
            document.getElementById('step-indicator-1').querySelectorAll('div')[1].style.color = 'var(--gray)';

            document.getElementById('step-indicator-2').style.background = 'var(--accent)';
            document.getElementById('step-indicator-2').style.border = 'none';
            document.getElementById('step-indicator-2').querySelector('div').style.color = 'white';
            document.getElementById('step-indicator-2').querySelectorAll('div')[1].style.color = 'rgba(255,255,255,0.9)';
        }

        function goToStep1() {
            document.getElementById('details-step').style.display = 'none';
            document.getElementById('payment-step').style.display = 'block';

            // Update step indicators
            document.getElementById('step-indicator-1').style.background = 'var(--accent)';
            document.getElementById('step-indicator-1').style.border = 'none';
            document.getElementById('step-indicator-1').querySelector('div').style.color = 'white';
            document.getElementById('step-indicator-1').querySelectorAll('div')[1].style.color = 'rgba(255,255,255,0.9)';

            document.getElementById('step-indicator-2').style.background = 'var(--dark-light)';
            document.getElementById('step-indicator-2').style.border = '1px solid rgba(255,255,255,0.1)';
            document.getElementById('step-indicator-2').querySelector('div').style.color = 'var(--gray)';
            document.getElementById('step-indicator-2').querySelectorAll('div')[1].style.color = 'var(--gray)';
        }

        // Handle form submission
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('clientDetailsForm');
            if (form) {

                form.addEventListener('submit', function (e) {
                    // Do NOT prevent default here to allow form submission to server
                    // e.preventDefault(); 

                    // Check if screenshot is uploaded
                    if (!uploadedScreenshot) {
                        e.preventDefault();
                        alert('Please upload a payment screenshot');
                        return;
                    }

                    // Ensure payment method is set
                    if (!selectedCrypto) {
                        e.preventDefault();
                        alert('Please select a payment method');
                        return;
                    }

                    // Add hidden inputs for dynamic data if they don't exist
                    if (!this.querySelector('input[name="payment_method"]')) {
                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = 'payment_method';
                        methodInput.value = selectedCrypto.toUpperCase();
                        this.appendChild(methodInput);
                    } else {
                        this.querySelector('input[name="payment_method"]').value = selectedCrypto.toUpperCase();
                    }

                    if (!this.querySelector('input[name="service_name"]')) {
                        const serviceInput = document.createElement('input');
                        serviceInput.type = 'hidden';
                        serviceInput.name = 'service_name';
                        serviceInput.value = 'Premium Course Subscription'; // Start with a default or make dynamic
                        this.appendChild(serviceInput);
                    }

                    if (!this.querySelector('input[name="amount"]')) {
                        const amountInput = document.createElement('input');
                        amountInput.type = 'hidden';
                        amountInput.name = 'amount';
                        amountInput.value = '100'; // Match the UI $100 price
                        this.appendChild(amountInput);
                    }

                    if (!this.querySelector('input[name="currency"]')) {
                        const currencyInput = document.createElement('input');
                        currencyInput.type = 'hidden';
                        currencyInput.name = 'currency';
                        currencyInput.value = 'USD';
                        this.appendChild(currencyInput);
                    }

                    // Let the form submit naturally to the Laravel route
                });
            }
        });

        // ===== VERIFICATION MODAL FUNCTIONS =====

        let uploadedCnicFront = null;
        let uploadedCnicBack = null;
        let uploadedProfilePhoto = null;

        function openVerificationModal() {
            document.getElementById('verificationModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeVerificationModal() {
            document.getElementById('verificationModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            // Reset form
            document.getElementById('verificationForm').reset();
            uploadedCnicFront = null;
            uploadedCnicBack = null;
            uploadedProfilePhoto = null;
            document.getElementById('cnicFrontPreview').style.display = 'none';
            document.getElementById('cnicBackPreview').style.display = 'none';
            document.getElementById('profilePhotoPreview').style.display = 'none';
        }

        // Format CNIC number as XXXXX-XXXXXXX-X
        function formatCNIC(input) {
            let value = input.value.replace(/[^0-9]/g, '');

            if (value.length > 13) {
                value = value.substring(0, 13);
            }

            let formatted = '';
            if (value.length > 0) {
                formatted = value.substring(0, 5);
            }
            if (value.length > 5) {
                formatted += '-' + value.substring(5, 12);
            }
            if (value.length > 12) {
                formatted += '-' + value.substring(12, 13);
            }

            input.value = formatted;
        }

        // Handle photo upload with preview
        function handlePhotoUpload(input, previewId, photoType) {
            const file = input.files[0];
            if (file) {
                // Check file size (5MB max)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size must be less than 5MB');
                    input.value = '';
                    return;
                }

                // Check file type
                if (!file.type.startsWith('image/')) {
                    alert('Please upload an image file');
                    input.value = '';
                    return;
                }

                // Store the file
                if (previewId === 'cnicFrontPreview') {
                    uploadedCnicFront = file;
                } else if (previewId === 'cnicBackPreview') {
                    uploadedCnicBack = file;
                } else if (previewId === 'profilePhotoPreview') {
                    uploadedProfilePhoto = file;
                }

                // Show preview
                const previewDiv = document.getElementById(previewId);
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewDiv.innerHTML = `
                        <div style="padding: 1rem; background: rgba(16, 185, 129, 0.1); border: 1px solid var(--secondary); border-radius: var(--radius-md);">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                                <div style="font-size: 1.5rem;">✅</div>
                                <div style="flex: 1;">
                                    <div style="color: var(--white); font-weight: 600; font-size: 0.9rem;">${photoType} uploaded</div>
                                    <div style="color: var(--gray); font-size: 0.8rem;">${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)</div>
                                </div>
                                <button type="button" onclick="removePhoto('${input.id}', '${previewId}')" 
                                    style="padding: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: var(--radius-sm); color: var(--gray-light); cursor: pointer;">
                                    🗑️
                                </button>
                            </div>
                            <img src="${e.target.result}" 
                                style="width: 100%; border-radius: var(--radius-md); border: 1px solid rgba(255,255,255,0.1);">
                        </div>
                    `;
                    previewDiv.style.display = 'block';
                };

                reader.readAsDataURL(file);
            }
        }

        // Remove uploaded photo
        function removePhoto(inputId, previewId) {
            document.getElementById(inputId).value = '';
            document.getElementById(previewId).style.display = 'none';

            if (previewId === 'cnicFrontPreview') {
                uploadedCnicFront = null;
            } else if (previewId === 'cnicBackPreview') {
                uploadedCnicBack = null;
            } else if (previewId === 'profilePhotoPreview') {
                uploadedProfilePhoto = null;
            }
        }

        // Handle verification form submission
        document.addEventListener('DOMContentLoaded', function () {
            const verificationForm = document.getElementById('verificationForm');
            if (verificationForm) {
                verificationForm.addEventListener('submit', function (e) {

                    // Check if all photos are uploaded
                    if (!uploadedCnicFront || !uploadedCnicBack || !uploadedProfilePhoto) {
                        e.preventDefault();
                        alert('Please upload all required photos:\n• CNIC Front\n• CNIC Back\n• Profile Photo');
                        return;
                    }

                    // Form will now submit to server
                });
            }
        });
    </script>

    <!-- Learning Features -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">What's Included</span>
                <h2>Everything You Need to Succeed</h2>
                <p>Our comprehensive learning platform gives you all the tools and support you need</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎥</div>
                    <h3>HD Video Lessons</h3>
                    <p>High-quality video content with screen recordings, live trading examples, and detailed
                        explanations.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📝</div>
                    <h3>Interactive Quizzes</h3>
                    <p>Test your knowledge with quizzes after each module to reinforce your learning.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h3>Downloadable Resources</h3>
                    <p>PDFs, cheat sheets, trading templates, and reference materials you can keep forever.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💬</div>
                    <h3>Community Access</h3>
                    <p>Join our private community of traders to share insights, ask questions, and network.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3>Practice Exercises</h3>
                    <p>Hands-on exercises and simulated trading scenarios to practice what you learn.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏆</div>
                    <h3>Certification</h3>
                    <p>Earn a professional certificate upon completion to showcase your trading knowledge.</p>
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
                    <p style="font-style: italic; margin-bottom: 1.5rem;">"The 'Learn Now, Pay Later' option was a
                        lifesaver. I learned the basics for free and only paid when I was confident. Best decision
                        ever!"</p>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div
                            style="width: 40px; height: 40px; background: var(--gradient-crypto); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">
                            K</div>
                        <div>
                            <div style="font-weight: 600; color: var(--white);">Kamran</div>
                            <div style="font-size: 0.8rem; color: var(--gray);">Crypto Student</div>
                        </div>
                    </div>
                </div>
                <!-- Review 2 -->
                <div class="feature-card" style="text-align: left;">
                    <div style="color: #F59E0B; margin-bottom: 0.5rem;">★★★★★</div>
                    <p style="font-style: italic; margin-bottom: 1.5rem;">"Premium Live Trading is intense but amazing.
                        You learn so much more watching them trade live than you ever could from a book."</p>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div
                            style="width: 40px; height: 40px; background: var(--gradient-success); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">
                            J</div>
                        <div>
                            <div style="font-weight: 600; color: var(--white);">Jason P.</div>
                            <div style="font-size: 0.8rem; color: var(--gray);">UK Trader</div>
                        </div>
                    </div>
                </div>
                <!-- Review 3 -->
                <div class="feature-card" style="text-align: left;">
                    <div style="color: #F59E0B; margin-bottom: 0.5rem;">★★★★★</div>
                    <p style="font-style: italic; margin-bottom: 1.5rem;">"Completed the Forex Mastery course last
                        month. The content is structured perfectly. I finally understand risk management properly."</p>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div
                            style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white;">
                            A</div>
                        <div>
                            <div style="font-weight: 600; color: var(--white);">Ahmed</div>
                            <div style="font-size: 0.8rem; color: var(--gray);">Forex Student</div>
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
    <section class="section cta">
        <div class="container">
            <div class="cta-content">
                <h2>Ready to Start Your Learning Journey?</h2>
                <p>Join thousands of students who have transformed their trading skills with GSM Trading Lab Academy.
                </p>
                <a href="#" class="btn"
                    onclick="alert('Enrollment coming soon! For now, email us at: academy@gsmtradinglab.com')">
                    <span>Enroll Now</span>
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

    <script>
        // Modal recovery after validation errors
        document.addEventListener('DOMContentLoaded', function () {
            @if($errors->any())
                const modalId = "{{ old('modal_id') }}";
                if (modalId === 'premiumModal') {
                    openPremiumModal();
                    // Go to step 2 directly since Step 1 is payment and Step 2 is where form is
                    document.getElementById('payment-step').style.display = 'none';
                    document.getElementById('details-step').style.display = 'block';
                } else if (modalId === 'verificationModal') {
                    openVerificationModal();
                }

                // Show errors in an alert for better visibility in modal
                let errorMsg = "Please fix the following errors:\n";
                @foreach($errors->all() as $error)
                    errorMsg += "- {{ $error }}\n";
                @endforeach
                alert(errorMsg);
            @endif
        });
    </script>
    @include('partials.security-script')
</body>

</html>