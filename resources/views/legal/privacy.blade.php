<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - GSM Trading Lab</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        .legal-header {
            padding: 4rem 2rem 2rem;
            text-align: center;
        }

        .legal-content {
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto 4rem;
            background: var(--dark-light);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius-lg);
            line-height: 1.8;
            color: var(--gray-light);
        }

        .legal-content h3 {
            color: var(--white);
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .legal-content p {
            margin-bottom: 1.5rem;
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="legal-header">
        <h1>Privacy Policy</h1>
        <p style="color: var(--gray);">Last Updated: February 2026</p>
    </div>

    <div class="legal-content">
        <h3>1. Introduction</h3>
        <p>At <strong>GSM Trading Lab</strong> ("we", "us", or "our"), we respect your privacy and are committed to
            protecting your personal data. This Privacy Policy explains how we collect, use, disclose, and safeguard
            your information when you visit our website or use our trading education and signal services.</p>

        <h3>2. Information We Collect</h3>
        <p>We collect information that you voluntarily provide to us when you register on the website, subscribe to
            services, or contact us.</p>
        <ul>
            <li><strong>Personal Data:</strong> Name, email address, phone number, and billing information.</li>
            <li><strong>Usage Data & Security:</strong> Valid IP address, browser type, and time spent on pages.</li>
            <li><strong>Location Data:</strong> For security and fraud prevention purposes, we may collect and store
                your precise GPS coordinates (Latitude/Longitude) upon your explicit browser-level consent.</li>
        </ul>

        <h3>3. How We Use Your Information</h3>
        <p>We use the information we collect to:</p>
        <ul>
            <li>Provide, operate, and maintain our website and services.</li>
            <li>Process your payments, manage subscriptions, and handle refund requests.</li>
            <li>Evaluate eligibility for the "Learn Now, Pay Later" program.</li>
            <li>Send you trading signals, market updates, and educational content.</li>
            <li>Detect and prevent fraudulent or unauthorized activity.</li>
        </ul>

        <h3>4. Sharing of Information</h3>
        <p>We do not sell your personal data. We may share information with:</p>
        <ul>
            <li><strong>Service Providers:</strong> Third-party vendors who perform services for us (e.g., payment
                processing, email delivery, hosting).</li>
            <li><strong>Legal Obligations:</strong> If required to do so by law or in response to valid requests by
                public authorities.</li>
        </ul>

        <h3>5. Cookies and Tracking Technologies</h3>
        <p>We use cookies and similar tracking technologies to track activity on our service and hold certain
            information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.
        </p>

        <h3>6. Data Security</h3>
        <p>We use administrative, technical, and physical security measures to help protect your personal information.
            While we have taken reasonable steps to secure the personal information you provide to us, please be aware
            that despite our efforts, no security measures are perfect or impenetrable.</p>

        <h3>7. Your Data Rights</h3>
        <p>Depending on your location, you may have the right to access, correct, or delete your personal data. To
            exercise these rights, please contact us.</p>

        <h3>8. Updates to This Policy</h3>
        <p>We may update this privacy policy from time to time. The updated version will be indicated by an updated
            "Revised" date and the updated version will be effective as soon as it is accessible.</p>

        <h3>9. Contact Us</h3>
        <p>If you have questions or comments about this policy, you may email us at <a
                href="mailto:support@gsmtradinglab.com" style="color: var(--primary);">support@gsmtradinglab.com</a>.
        </p>
    </div>

    @include('partials.footer')
</body>

</html>