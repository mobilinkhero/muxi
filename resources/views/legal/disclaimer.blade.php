@extends('layouts.main')

@section('title', 'Risk Disclaimer')
@section('description', 'Professional risk disclosure and legal disclaimer for GSM Trading Lab financial education and analysis.')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">Risk Disclaimer</h1>
            <p class="page-breadcrumb">Home / Legal / Disclaimer</p>
        </div>
    </header>

    <section class="content-section">
        <div class="container">
            <div class="card legal-card">
                <div class="legal-content">
                    <div class="disclaimer-alert"
                        style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid #ef4444; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                        <h2 style="color: #ef4444; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-exclamation-triangle"></i> HIGH RISK WARNING
                        </h2>
                        <p style="color: var(--white); font-weight: 500;">Trading financial markets carries a high level of
                            risk and may not be suitable for all investors. The high degree of leverage can work against you
                            as well as for you.</p>
                    </div>

                    <h3>1. Educational Purposes Only</h3>
                    <p>All content provided by GSM Trading Lab, including but not limited to analysis, signals, educational
                        materials, and community discussions, is for <strong>educational and informational purposes
                            only</strong>. We are not financial advisors, and our materials do not constitute financial,
                        investment, or trading advice.</p>

                    <h3>2. No Guarantees</h3>
                    <p>Past performance is not indicative of future results. Trading involves the risk of loss, including
                        the loss of principal. GSM Trading Lab does not guarantee any specific outcome or profit. You should
                        be aware of all the risks associated with trading and seek advice from an independent financial
                        advisor if you have any doubts.</p>

                    <h3>3. Accuracy of Information</h3>
                    <p>While we strive to provide accurate and timely information, GSM Trading Lab does not guarantee the
                        completeness or accuracy of any content provided. Market conditions change rapidly, and information
                        may become outdated quickly.</p>

                    <h3>4. Individual Responsibility</h3>
                    <p>You are solely responsible for your own trading decisions. Any reliance you place on information
                        provided by GSM Trading Lab is strictly at your own risk. GSM Trading Lab, its owners, and
                        contributors will not be liable for any loss or damage, including without limitation, any loss of
                        profit, which may arise directly or indirectly from use of or reliance on such information.</p>

                    <h3>5. Third-Party Links</h3>
                    <p>Our website may contain links to external websites or services (such as brokers or analysis tools)
                        that are not owned or controlled by GSM Trading Lab. We have no control over, and assume no
                        responsibility for, the content, privacy policies, or practices of any third-party websites or
                        services.</p>

                    <h3>6. Signal Service Disclosure</h3>
                    <p>Trading signals provided are based on technical and fundamental analysis at a specific point in time.
                        Execution of these signals depends on individual account settings, broker conditions, and timing.
                        Slippage, spreads, and market volatility can significantly impact results.</p>

                    <div
                        style="margin-top: 3rem; padding: 1.5rem; background: var(--dark-light); border-radius: 8px; border: 1px solid var(--border);">
                        <p style="font-size: 0.9rem; color: var(--gray-light); margin: 0;">By using our services, you
                            acknowledge that you have read, understood, and agreed to this Risk Disclaimer.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .legal-card {
            padding: 3rem;
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 12px;
        }

        .legal-content h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .legal-content p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
            color: var(--gray-light);
        }
    </style>
@endsection