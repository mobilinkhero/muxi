<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - GSM Trading Lab</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        .help-header {
            padding: 4rem 2rem 2rem;
            text-align: center;
        }

        .help-container {
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: var(--dark-light);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-md);
            margin-bottom: 1rem;
            padding: 1.5rem;
        }

        .faq-item h3 {
            color: var(--white);
            margin-bottom: 0.5rem;
            cursor: pointer;
        }

        .faq-item p {
            color: var(--gray-light);
            line-height: 1.6;
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-container">
                <a href="/" class="logo">
                    <img src="https://i.ibb.co/3ykG88h/gsm-logo.png" alt="GSM Trading Lab Logo" style="height: 40px;">
                    GSM Trading Lab
                </a>
                <ul class="nav-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="/learn">Learn</a></li>
                    <li><a href="/trade">Trade</a></li>
                    <li><a href="/contact" class="btn btn-primary">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="help-header">
        <h1>Help Center</h1>
        <p style="color: var(--gray);">Frequently asked questions to help you get started.</p>
    </div>

    <div class="help-container">
        <div class="faq-item">
            <h3>How do I start trading?</h3>
            <p>To start trading, simply sign up for an account, choose your preferred market (Crypto, Forex, etc.), and
                follow our beginner guides in the "Learn" section. You can also subscribe to our signals for real-time
                trading opportunities.</p>
        </div>

        <div class="faq-item">
            <h3>Is the education free?</h3>
            <p>Yes! We offer a wide range of free educational resources. We also have premium mentorship programs and
                deeper analysis for advanced traders.</p>
        </div>

        <div class="faq-item">
            <h3>How do I access the signals?</h3>
            <p>You can access our trading signals by creating an account and visiting the "Trade" section. Some signals
                are free, while others may require a premium membership.</p>
        </div>

        <div class="faq-item">
            <h3>What payment methods do you accept?</h3>
            <p>We accept major credit cards, bank transfers, and cryptocurrencies for our premium services.</p>
        </div>

        <div class="faq-item">
            <h3>Can I cancel my subscription?</h3>
            <p>Yes, you can cancel your premium subscription at any time from your account dashboard. You will retain
                access until the end of your billing period.</p>
        </div>

        <div style="text-align: center; margin-top: 3rem; margin-bottom: 4rem;">
            <p style="color: var(--gray-light);">Still have questions?</p>
            <a href="/contact" class="btn btn-primary">Contact Support</a>
        </div>
    </div>

    @include('partials.footer')
</body>

</html>