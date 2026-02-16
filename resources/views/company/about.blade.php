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

                <div class="card founder-section" style="border-left: 4px solid var(--secondary);">
                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2.5rem; align-items: center;">
                        <div class="founder-image"
                            style="background: var(--dark-light); border-radius: 12px; height: 350px; display: flex; align-items: center; justify-content: center; font-size: 5rem;">
                            👤
                        </div>
                        <div>
                            <span class="section-badge" style="margin-bottom: 1rem;">The Visionary</span>
                            <h2 style="margin-bottom: 1.5rem; color: var(--secondary);">Meet Our Founder</h2>
                            <div style="font-size: 1rem; line-height: 1.7; color: var(--gray-light);">
                                <p>GSM Trading Lab was founded by a self-made trader passionate about financial markets and
                                    global trading education. His journey started with curiosity, mistakes, and continuous
                                    learning through real market experience.</p>
                                <p style="margin-top: 1rem;">Instead of hiding challenges, he built this platform to turn
                                    real trading lessons into knowledge that helps other traders grow faster. Today, his
                                    goal is to build one of the world's largest trading communities where traders learn,
                                    practice, and succeed through experience and discipline.</p>
                                <p
                                    style="margin-top: 1rem; font-style: italic; border-left: 2px solid var(--secondary); padding-left: 1rem; color: var(--white);">
                                    "Trading is not about quick profits. Trading is about understanding markets and building
                                    long-term skill."</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection