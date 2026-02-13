<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Invest in Crypto, Forex & Gold - GSM Trading Lab</title>
    <meta name="description"
        content="Professional wealth management and investment strategies tailored for Crypto, Forex, and Gold markets. Secure your financial future with GSM Trading Lab.">
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar scrolled" id="navbar">
        <div class="container">
            <div class="nav-container">
                <a href="/" class="logo">
                    <img src="https://i.ibb.co/3ykG88h/gsm-logo.png" alt="GSM Trading Lab Logo" class="logo-animation"
                        style="height: 50px;">
                    GSM Trading Lab
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
                    <span>💰</span>
                    <span>Wealth Management</span>
                </div>
                <h1>Secure Your Financial Future</h1>
                <p class="hero-description">
                    Let our experts manage your portfolio. We create investment strategies focused on <strong>Crypto,
                        Forex, and Gold</strong>,
                    tailored to your risk tolerance and financial goals.
                </p>
                <div class="hero-cta">
                    <a href="#consultation" class="btn btn-primary">
                        <span>Schedule Consultation</span>
                        <span>→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Investment Process -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">How It Works</span>
                <h2>Our Investment Process</h2>
                <p>A systematic approach to growing your wealth.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">1️⃣</div>
                    <h3>Assessment</h3>
                    <p>We analyze your financial situation, goals, and risk appetite.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">2️⃣</div>
                    <h3>Allocation</h3>
                    <h4 class="logo" style="font-size: 1.5rem;">
                        <img src="https://i.ibb.co/3ykG88h/gsm-logo.png" alt="GSM Trading Lab Logo"
                            style="height: 40px;">
                        GSM Trading Lab
                    </h4>
                    <p>We build a diversified portfolio across multiple asset classes.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">3️⃣</div>
                    <h3>Management</h3>
                    <p>Continuous monitoring and rebalancing to maximize returns.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Consultation Form -->
    <section class="section" id="consultation" style="background: var(--dark-light);">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Get In Touch</span>
                <h2>Request a Consultation</h2>
                <p>Speak with one of our wealth managers today.</p>
            </div>
            <div
                style="max-width: 600px; margin: 0 auto; background: var(--dark); padding: 2rem; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.1);">
                <form
                    onsubmit="event.preventDefault(); alert('Consultation request received! We will contact you shortly.');">
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; color: var(--white); margin-bottom: 0.5rem;">Full Name</label>
                        <input type="text" required
                            style="width: 100%; padding: 0.8rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: white;">
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; color: var(--white); margin-bottom: 0.5rem;">Email Address</label>
                        <input type="email" required
                            style="width: 100%; padding: 0.8rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: white;">
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; color: var(--white); margin-bottom: 0.5rem;">Investment
                            Capital</label>
                        <select
                            style="width: 100%; padding: 0.8rem; background: var(--dark-light); border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-md); color: white;">
                            <option>$1,000 - $10,000</option>
                            <option>$10,000 - $50,000</option>
                            <option>$50,000+</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Request</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <!-- Social Media Links -->
            <div style="display: flex; gap: 1rem; justify-content: center; margin-bottom: 2rem; flex-wrap: wrap;">
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
            <div class="footer-bottom">
                <p>&copy; 2026 GSM Trading Lab. All rights reserved.</p>
            </div>
        </div>
    </footer>

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