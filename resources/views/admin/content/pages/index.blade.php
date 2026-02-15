@extends('layouts.admin')

@section('title', 'Website Content Manager')
@section('header', 'Website Content Manager')

@section('styles')
    <style>
        .tab-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 0.5rem;
        }

        .tab-btn {
            padding: 0.8rem 1.5rem;
            cursor: pointer;
            border-radius: 8px 8px 0 0;
            border: none;
            background: none;
            color: var(--gray);
            font-weight: 600;
            transition: all 0.3s;
        }

        .tab-btn.active {
            background: rgba(139, 92, 246, 0.1);
            color: var(--primary);
            border-bottom: 2px solid var(--primary);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            color: var(--primary);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            margin-top: 2rem;
            font-size: 1.2rem;
        }

        .grid-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="tab-container">
            <button class="tab-btn active" onclick="showTab('home')">🏠 Home Page</button>
            <button class="tab-btn" onclick="showTab('learn')">🎓 Learn Page</button>
            <button class="tab-btn" onclick="showTab('trade')">📉 Trade Page</button>
            <button class="tab-btn" onclick="showTab('invest')">💰 Invest Page</button>
            <button class="tab-btn" onclick="showTab('footer')">🛡️ Footer & SEO</button>
        </div>

        <form action="{{ route('admin.content.pages.update') }}" method="POST">
            @csrf

            <!-- HOME TAB -->
            <div id="tab-home" class="tab-content active">
                <h3 class="section-title">Home Hero Section</h3>
                <div class="grid-form">
                    <div class="form-group">
                        <label class="form-label">Hero Badge Text</label>
                        <input type="text" name="home_hero_badge" class="form-input"
                            value="{{ $settings['home_hero_badge'] ?? 'Join Our Growing Community of Traders' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Hero Background Image URL</label>
                        <input type="text" name="home_hero_bg" class="form-input"
                            value="{{ $settings['home_hero_bg'] ?? 'https://images.unsplash.com/photo-1611974765270-ca12586343bb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80' }}">
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">Hero Title (HTML Allowed)</label>
                        <textarea name="home_hero_title" class="form-input"
                            rows="3">{{ $settings['home_hero_title'] ?? 'Master Trading Across <br> <span style=\"background: linear-gradient(135deg, #8B5CF6, #EC4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent;\">All Major Markets</span>' }}</textarea>
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">Hero Description (HTML Allowed)</label>
                        <textarea name="home_hero_desc" class="form-input"
                            rows="3">{{ $settings['home_hero_desc'] ?? '<i class=\"fab fa-bitcoin\" style=\"color: #F7931A;\"></i> Crypto &nbsp;|&nbsp; <i class=\"fas fa-chart-line\" style=\"color: #10B981;\"></i> Forex &nbsp;|&nbsp; <i class=\"fas fa-building\" style=\"color: #3B82F6;\"></i> Stocks &nbsp;|&nbsp; <i class=\"fas fa-layer-group\" style=\"color: #EC4899;\"></i> Indices' }}</textarea>
                    </div>
                </div>

                <h3 class="section-title">Stats Bar</h3>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                    @for($i = 1; $i <= 4; $i++)
                        <div class="form-group">
                            <label class="form-label">Stat {{ $i }} Value</label>
                            <input type="text" name="home_stat_{{ $i }}_val" class="form-input"
                                value="{{ $settings['home_stat_' . $i . '_val'] ?? '' }}">
                            <label class="form-label" style="margin-top:0.5rem">Stat {{ $i }} Label</label>
                            <input type="text" name="home_stat_{{ $i }}_label" class="form-input"
                                value="{{ $settings['home_stat_' . $i . '_label'] ?? '' }}">
                        </div>
                    @endfor
                </div>

                <h3 class="section-title">Markets Section Header</h3>
                <div class="grid-form">
                    <div class="form-group"><label class="form-label">Badge</label><input type="text"
                            name="home_markets_badge" class="form-input"
                            value="{{ $settings['home_markets_badge'] ?? 'Markets We Cover' }}"></div>
                    <div class="form-group"><label class="form-label">Title</label><input type="text"
                            name="home_markets_title" class="form-input"
                            value="{{ $settings['home_markets_title'] ?? 'Trade Across All Major Markets' }}"></div>
                    <div class="form-group" style="grid-column: span 2;"><label
                            class="form-label">Description</label><textarea name="home_markets_desc" class="form-input"
                            rows="2">{{ $settings['home_markets_desc'] ?? '' }}</textarea></div>
                </div>
            </div>

            <!-- LEARN TAB -->
            <div id="tab-learn" class="tab-content">
                <h3 class="section-title">Learn Page Hero</h3>
                <div class="grid-form">
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">Main Heading</label>
                        <input type="text" name="learn_hero_title" class="form-input"
                            value="{{ $settings['learn_hero_title'] ?? 'Learn to Trade Like a Pro' }}">
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">Description (HTML Allowed)</label>
                        <textarea name="learn_hero_desc" class="form-input"
                            rows="4">{{ $settings['learn_hero_desc'] ?? 'Master trading with a focus on <strong>Risk Management & Live Execution</strong>. Get <strong>Lifetime Premium Access</strong> to daily live sessions, 1-on-1 mentorship, and 24/7 support. One-time fee, forever value.' }}</textarea>
                    </div>
                </div>

                <h3 class="section-title">"Learn Now Pay Later" Section</h3>
                <div class="grid-form">
                    <div class="form-group">
                        <label class="form-label">Option 1 Title</label>
                        <input type="text" name="learn_opt1_title" class="form-input"
                            value="{{ $settings['learn_opt1_title'] ?? 'Learn Now, Pay Later' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Option 1 Badge</label>
                        <input type="text" name="learn_opt1_badge" class="form-input"
                            value="{{ $settings['learn_opt1_badge'] ?? '🤝 TRUST BASED' }}">
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">Option 1 Description (HTML Allowed)</label>
                        <textarea name="learn_opt1_desc" class="form-input"
                            rows="4">{{ $settings['learn_opt1_desc'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- TRADE TAB -->
            <div id="tab-trade" class="tab-content">
                <h3 class="section-title">Trade Page Hero</h3>
                <div class="grid-form">
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">Hero Title</label>
                        <input type="text" name="trade_hero_title" class="form-input" value="{{ $settings['trade_hero_title'] ?? 'Trade with Confidence' }}">
                    </div>
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">Hero Description (HTML Allowed)</label>
                        <textarea name="trade_hero_desc" class="form-input" rows="4">{{ $settings['trade_hero_desc'] ?? '' }}</textarea>
                    </div>
                </div>

                <h3 class="section-title">Trade Page Activity Section</h3>
                <div class="grid-form">
                    <div class="form-group">
                        <label class="form-label">Header Title</label>
                        <input type="text" name="trade_page_title" class="form-input"
                            value="{{ $settings['trade_page_title'] ?? 'Professional Trading Signals' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Header Subtitle</label>
                        <input type="text" name="trade_page_subtitle" class="form-input"
                            value="{{ $settings['trade_page_subtitle'] ?? 'Daily set-ups across all major markets.' }}">
                    </div>
                </div>
            </div>

            <!-- SEARCH ENGINE / FOOTER TAB -->
            <div id="tab-footer" class="tab-content">
                <h3 class="section-title">Global SEO Settings</h3>
                <div class="grid-form">
                    <div class="form-group">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-input"
                            rows="3">{{ $settings['meta_description'] ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Meta Keywords</label>
                        <textarea name="meta_keywords" class="form-input"
                            rows="3">{{ $settings['meta_keywords'] ?? '' }}</textarea>
                    </div>
                </div>

                <h3 class="section-title">Footer Text</h3>
                <div class="grid-form">
                    <div class="form-group" style="grid-column: span 2;">
                        <label class="form-label">Footer About Text</label>
                        <textarea name="footer_about" class="form-input"
                            rows="4">{{ $settings['footer_about'] ?? 'GSM Trading Lab is a premier trading academy dedicated to empowering traders across all major markets.' }}</textarea>
                    </div>
                </div>
            </div>

            <div
                style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1); text-align: right;">
                <button type="submit" class="btn btn-primary"
                    style="padding: 1rem 3rem; font-size: 1.1rem; font-weight: bold;">
                    💾 Save Website Changes
                </button>
            </div>
        </form>
    </div>

    <script>
        function showTab(tabId) {
            // Hide all
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

            // Show selected
            document.getElementById('tab-' + tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>
@endsection