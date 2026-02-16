@extends('layouts.main')

@section('title', 'Trading Community')
@section('description', 'Join the GSM Trading Lab global community of traders. Share knowledge, analyze markets together, and grow in a disciplined environment.')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">Global Trading Community</h1>
            <p class="page-breadcrumb">Home / Community</p>
        </div>
    </header>

    <section class="content-section">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 3rem; align-items: start;">
                <div>
                    <h2
                        style="margin-bottom: 1.5rem; background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Where Traders Are Built</h2>
                    <div style="font-size: 1.1rem; line-height: 1.8; color: var(--gray-light);">
                        <p>GSM Trading Lab is more than just a course; it's a <strong>learning family</strong>. We've built
                            an ecosystem where traders from all over the world connect, share real-time market insights, and
                            support each other's growth journey.</p>
                        <p style="margin-top: 1rem;">Whether you trade Crypto, Forex, or Stocks, our community provides the
                            professional environment needed to stay disciplined and focused on long-term skill building.</p>
                    </div>

                    <div class="community-values"
                        style="margin-top: 3rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="card" style="padding: 1.5rem; text-align: center;">
                            <div style="font-size: 2rem; margin-bottom: 1rem;">🤝</div>
                            <h4>Collaborative Analysis</h4>
                            <p style="font-size: 0.9rem; color: var(--gray);">Learn how other professional traders break
                                down the markets.</p>
                        </div>
                        <div class="card" style="padding: 1.5rem; text-align: center;">
                            <div style="font-size: 2rem; margin-bottom: 1rem;">📈</div>
                            <h4>Real-Time Insights</h4>
                            <p style="font-size: 0.9rem; color: var(--gray);">Stay updated with the latest trends across
                                multiple asset classes.</p>
                        </div>
                        <div class="card" style="padding: 1.5rem; text-align: center;">
                            <div style="font-size: 2rem; margin-bottom: 1rem;">🧠</div>
                            <h4>Psychology Support</h4>
                            <p style="font-size: 0.9rem; color: var(--gray);">Master the mental game with peers who
                                understand the struggle.</p>
                        </div>
                        <div class="card" style="padding: 1.5rem; text-align: center;">
                            <div style="font-size: 2rem; margin-bottom: 1rem;">🎯</div>
                            <h4>Disciplined Culture</h4>
                            <p style="font-size: 0.9rem; color: var(--gray);">A focused environment free from the hype of
                                "get rich quick" schemes.</p>
                        </div>
                    </div>
                </div>

                <div class="card" style="position: sticky; top: 100px; padding: 2.5rem; border-color: var(--primary);">
                    <h3 style="margin-bottom: 1.5rem; text-align: center;">Connect With Us</h3>
                    <p style="color: var(--gray-light); text-align: center; margin-bottom: 2rem;">Join our official channels
                        to participate in live discussions and get instant updates.</p>

                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <a href="{{ $settings['telegram_link'] ?? '#' }}" target="_blank" class="community-btn telegram">
                            <i class="fab fa-telegram-plane"></i> Join Telegram Channel
                        </a>
                        <a href="{{ $settings['discord_link'] ?? '#' }}" target="_blank" class="community-btn discord">
                            <i class="fab fa-discord"></i> Join Discord Server
                        </a>
                        <a href="{{ $settings['whatsapp_link'] ?? '#' }}" target="_blank" class="community-btn whatsapp">
                            <i class="fab fa-whatsapp"></i> Join WhatsApp Group
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-glow"
                            style="width: 100%; margin-top: 1rem; text-align: center; justify-content: center;">
                            Register on Platform
                        </a>
                    </div>

                    <div
                        style="margin-top: 2rem; padding: 1rem; background: rgba(0,0,0,0.2); border-radius: 8px; font-size: 0.85rem; color: var(--gray);">
                        <p style="margin: 0; text-align: center;">By joining, you agree to follow our <a href="#rules"
                                style="color: var(--secondary);">Community Rules</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content-section" id="rules" style="background: var(--dark-light);">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 4rem;">
                <span class="section-badge">Rules & Culture</span>
                <h2>Our Community Guidelines</h2>
                <p>To maintain a professional learning environment, all members must adhere to these rules.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <div class="rule-card">
                    <div class="rule-number">01</div>
                    <h4>Respect Every Trader</h4>
                    <p>We are a global community. Kindness and professional conduct are mandatory regardless of experience
                        level.</p>
                </div>
                <div class="rule-card">
                    <div class="rule-number">02</div>
                    <h4>No Fake Results</h4>
                    <p>Transparency is key. Sharing misleading or manipulated results is strictly prohibited.</p>
                </div>
                <div class="rule-card">
                    <div class="rule-number">03</div>
                    <h4>Learning Comes First</h4>
                    <p>We are here to build skill, not just dependency. Focus on the "why" behind every trade.</p>
                </div>
                <div class="rule-card">
                    <div class="rule-number">04</div>
                    <h4>Risk Management</h4>
                    <p>Capital protection is our first priority. We do not encourage reckless or over-leveraged trading.</p>
                </div>
                <div class="rule-card">
                    <div class="rule-number">05</div>
                    <h4>No Spam/Promotion</h4>
                    <p>This is a learning space. Self-promotion, shilling, or spamming is not allowed.</p>
                </div>
                <div class="rule-card">
                    <div class="rule-number">06</div>
                    <h4>Growth Mindset</h4>
                    <p>Embrace mistakes as lessons. We support those who show commitment to continuous improvement.</p>
                </div>
            </div>
        </div>
    </section>

    <style>
        .community-btn {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            justify-content: center;
        }

        .telegram {
            background: #0088cc;
            color: white;
        }

        .telegram:hover {
            background: #0077b3;
            transform: scale(1.02);
        }

        .discord {
            background: #5865F2;
            color: white;
        }

        .discord:hover {
            background: #4752c4;
            transform: scale(1.02);
        }

        .whatsapp {
            background: #25D366;
            color: white;
        }

        .whatsapp:hover {
            background: #128C7E;
            transform: scale(1.02);
        }

        .rule-card {
            background: var(--dark);
            padding: 2.5rem;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
        }

        .rule-number {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 3rem;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.03);
        }

        .rule-card h4 {
            color: var(--secondary);
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .rule-card p {
            color: var(--gray-light);
            font-size: 0.95rem;
            line-height: 1.6;
        }
    </style>
@endsection