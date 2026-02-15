@extends('layouts.main')

@section('title', 'About Us')
@section('description', 'Learn about GSM Trading Lab, our mission, vision, and the values that drive us to educate and empower traders.')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">About GSM Trading Lab</h1>
            <p class="page-breadcrumb">Home / Company / About Us</p>
        </div>
    </header>
    <section class="content-section">
        <div class="container">
            <div style="display: flex; flex-direction: column; gap: 3rem;">

                <div class="card">
                    <h2 style="margin-bottom: 1.5rem; color: var(--primary);">Who We Are</h2>
                    <div style="font-size: 1.1rem; line-height: 1.8; color: var(--gray-light);">
                        <p>GSM Trading Lab is a premier educational institution dedicated to empowering individuals with the
                            knowledge and tools needed to succeed in the financial markets.</p>
                        <p style="margin-top: 1rem;">Founded by seasoned traders and market analysts, our mission is to
                            demystify trading across diverse asset classes including Cryptocurrency, Forex, Stocks, Indices,
                            and Commodities.</p>
                        <p style="margin-top: 1rem;">We believe in a practical, hands-on approach to learning, combining
                            theoretical knowledge with real-time market application. Our community-driven platform fosters
                            growth, sharing, and continuous improvement.</p>
                    </div>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">🎯</div>
                        <h3>Our Mission</h3>
                        <p>To provide accessible, high-quality trading education to everyone, everywhere.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">👁️</div>
                        <h3>Our Vision</h3>
                        <p>To be the world's leading community for multi-market trading education and mentorship.</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🤝</div>
                        <h3>Our Values</h3>
                        <p>Transparency, Integrity, Excellence, and Community.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection