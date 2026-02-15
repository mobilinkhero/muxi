<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - GSM Trading Lab</title>
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
        <h1>Terms of Service</h1>
        <p style="color: var(--gray);">Last Updated: February 2026</p>
    </div>

    <div class="legal-content">
        <h3>1. Acceptance of Terms</h3>
        <p>By accessing and using <strong>GSM Trading Lab</strong> ("we," "us," or "our"), you accept and agree to be
            bound by the terms and provision of this agreement. In addition, when using these particular services, you
            shall be subject to any posted guidelines or rules applicable to such services.</p>

        <h3>2. Educational Nature & Disclaimer</h3>
        <p><strong>This Platform is Strictly Educational.</strong> All content provided herein, including but not
            limited to trading signals, market analysis, courses, and mentoring, is for informational and educational
            purposes only.</p>
        <p
            style="background: rgba(239, 68, 68, 0.1); padding: 1rem; border-left: 4px solid #ef4444; border-radius: 4px;">
            <strong>Risk Warning:</strong> Trading foreign exchange, cryptocurrencies, stocks, and commodities carries a
            high level of risk and may not be suitable for all investors. The high degree of leverage can work against
            you as well as for you. Before deciding to trade, you should carefully consider your investment objectives,
            level of experience, and risk appetite. The possibility exists that you could sustain a loss of some or all
            of your initial investment. You should be aware of all the risks associated with foreign exchange trading
            and seek advice from an independent financial advisor if you have any doubts.
        </p>

        <h3>3. Trading Signals & Accuracy</h3>
        <p>Our trading signals and analysis are based on our own market research. We do not guarantee the accuracy,
            completeness, or timeliness of any signal. We are not responsible for any trading losses you may incur by
            following our signals. <strong>Past performance is not indicative of future results.</strong></p>

        <h3>4. Payments, Refunds & Satisfaction Guarantee</h3>
        <p>We operate on a model of trust and value. Our payment policies are designed to ensure you only pay for what
            brings you value.</p>
        <ul>
            <li><strong>100% Satisfaction Refund:</strong> If you pay for a course in advance and, after completing the
                learning, you feel the content was not worthy or we did not teach correctly, we will issue a
                <strong>100% refund</strong>. No questions asked.
            </li>
            <li><strong>Learn Now, Pay Later:</strong> For eligible students, we offer a "Learn Now, Pay Later" model.
                You can access the learning materials first. Payment is only required if you find the knowledge valuable
                and beneficial to your trading journey. If you do not find value, you are not obligated to pay.</li>
            <li><strong>Signal Subscriptions:</strong> Premium signal subscriptions are billed in advance. While we
                strive for accuracy, refunds for signal services are evaluated on a case-by-case basis, adhering to our
                core principle of fairness and value.</li>
        </ul>



        <h3>5. User Conduct</h3>
        <p>You agree not to:</p>
        <ul>
            <li>Share your account credentials with others.</li>
            <li>Resell or redistribute our premium signals or course materials.</li>
            <li>Engage in harassment or abusive behavior in our community channels.</li>
        </ul>
        <p>Violation of these rules may result in immediate termination of your account without refund.</p>

        <h3>6. Intellectual Property</h3>
        <p>All content included on this site, such as text, graphics, logos, images, and software, is the property of
            GSM Trading Lab and protected by international copyright laws.</p>

        <h3>7. Limitation of Liability</h3>
        <p>In no event shall GSM Trading Lab, nor its directors, employees, partners, agents, suppliers, or affiliates,
            be liable for any indirect, incidental, special, consequential or punitive damages, including without
            limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from your access to
            or use of or inability to access or use the Service.</p>

        <h3>8. Changes to Terms</h3>
        <p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. What constitutes
            a material change will be determined at our sole discretion.</p>

        <h3>9. Contact Us</h3>
        <p>If you have any questions about these Terms, please contact us at <a href="mailto:support@gsmtradinglab.com"
                style="color: var(--primary);">support@gsmtradinglab.com</a>.</p>
    </div>

    @include('partials.footer')
</body>

</html>