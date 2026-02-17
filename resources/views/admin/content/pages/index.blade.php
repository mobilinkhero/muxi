@extends('layouts.admin')

@section('title', 'Content Matrix - Admin')

@section('styles')
    <style>
        .tab-c {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }

        .tab-btn {
            padding: 0.8rem 1.5rem;
            cursor: pointer;
            border-radius: 12px;
            border: 1px solid transparent;
            background: rgba(255, 255, 255, 0.05);
            color: #94A3B8;
            font-weight: 800;
            transition: all 0.3s;
            font-family: 'JetBrains Mono';
            white-space: nowrap;
        }

        .tab-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .tab-btn.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--h-primary);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.2);
        }

        .tab-content {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            transition: 0.4s ease;
        }

        .tab-content.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .section-title {
            color: white;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            margin-top: 2rem;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
        }

        .section-title i {
            color: var(--h-secondary);
        }
    </style>
@endsection

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Content Matrix</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Frontend content injection terminal.</p>
        </div>
        <button type="submit" form="contentForm" class="btn-primary-h">
            <i class="fas fa-save"></i> Commit Changes
        </button>
    </div>

    <div class="h-reveal">
        <div class="tab-c">
            <button class="tab-btn active" onclick="showTab('home', event)">
                <i class="fas fa-home"></i> HOME_NODE
            </button>
            <button class="tab-btn" onclick="showTab('learn', event)">
                <i class="fas fa-graduation-cap"></i> LEARN_MODULE
            </button>
            <button class="tab-btn" onclick="showTab('trade', event)">
                <i class="fas fa-chart-line"></i> TRADE_NEXUS
            </button>
            <button class="tab-btn" onclick="showTab('footer', event)">
                <i class="fas fa-globe"></i> SEO_CORE
            </button>
        </div>

        <form id="contentForm" action="{{ route('admin.content.pages.update') }}" method="POST">
            @csrf

            <!-- HOME TAB -->
            <div id="tab-home" class="tab-content active">
                <div class="h-card">
                    <h3 class="section-title"><i class="fas fa-layer-group"></i> Hero Section Configuration</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label class="h-label">Hero Badge Text</label>
                            <input type="text" name="home_hero_badge" class="h-input"
                                value="{{ $settings['home_hero_badge'] ?? 'Join Our Growing Community of Traders' }}">
                        </div>
                        <div class="form-group">
                            <label class="h-label">Hero Background Image URL</label>
                            <input type="text" name="home_hero_bg" class="h-input"
                                value="{{ $settings['home_hero_bg'] ?? 'https://images.unsplash.com/photo-1611974765270-ca12586343bb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80' }}">
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="h-label">Hero Title (HTML Allowed)</label>
                            <textarea name="home_hero_title" class="h-input"
                                rows="3">{{ $settings['home_hero_title'] ?? 'Master Trading Across <br> <span style="background: linear-gradient(135deg, #8B5CF6, #EC4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">All Major Markets</span>' }}</textarea>
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="h-label">Hero Description (HTML Allowed)</label>
                            <textarea name="home_hero_desc" class="h-input"
                                rows="3">{{ $settings['home_hero_desc'] ?? '<i class="fab fa-bitcoin" style="color: #F7931A;"></i> Crypto &nbsp;|&nbsp; <i class="fas fa-chart-line" style="color: #10B981;"></i> Forex &nbsp;|&nbsp; <i class="fas fa-building" style="color: #3B82F6;"></i> Stocks &nbsp;|&nbsp; <i class="fas fa-layer-group" style="color: #EC4899;"></i> Indices' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="h-card">
                    <h3 class="section-title"><i class="fas fa-tachometer-alt"></i> Statistics Bar</h3>
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                        @for($i = 1; $i <= 4; $i++)
                            <div
                                style="background: rgba(0,0,0,0.2); padding: 1rem; border-radius: 12px; border: 1px solid var(--h-border);">
                                <label class="h-label">Stat {{ $i }} Data</label>
                                <input type="text" name="home_stat_{{ $i }}_val" class="h-input" placeholder="Value (e.g. 5K+)"
                                    value="{{ $settings['home_stat_' . $i . '_val'] ?? '' }}" style="margin-bottom: 0.5rem;">
                                <input type="text" name="home_stat_{{ $i }}_label" class="h-input"
                                    placeholder="Label (e.g. Traders)"
                                    value="{{ $settings['home_stat_' . $i . '_label'] ?? '' }}">
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="h-card">
                    <h3 class="section-title"><i class="fas fa-warehouse"></i> Markets Overview</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group"><label class="h-label">Badge</label><input type="text"
                                name="home_markets_badge" class="h-input"
                                value="{{ $settings['home_markets_badge'] ?? 'Markets We Cover' }}"></div>
                        <div class="form-group"><label class="h-label">Title</label><input type="text"
                                name="home_markets_title" class="h-input"
                                value="{{ $settings['home_markets_title'] ?? 'Trade Across All Major Markets' }}"></div>
                        <div class="form-group" style="grid-column: span 2;"><label
                                class="h-label">Description</label><textarea name="home_markets_desc" class="h-input"
                                rows="2">{{ $settings['home_markets_desc'] ?? '' }}</textarea></div>
                    </div>
                </div>
            </div>

            <!-- LEARN TAB -->
            <div id="tab-learn" class="tab-content">
                <div class="h-card">
                    <h3 class="section-title"><i class="fas fa-graduation-cap"></i> Academy Hero</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="h-label">Main Heading</label>
                            <input type="text" name="learn_hero_title" class="h-input"
                                value="{{ $settings['learn_hero_title'] ?? 'Learn to Trade Like a Pro' }}">
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="h-label">Description (HTML Allowed)</label>
                            <textarea name="learn_hero_desc" class="h-input"
                                rows="4">{{ $settings['learn_hero_desc'] ?? 'Master trading with a focus on <strong>Risk Management & Live Execution</strong>. Get <strong>Lifetime Premium Access</strong> to daily live sessions, 1-on-1 mentorship, and 24/7 support. One-time fee, forever value.' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="h-card">
                    <h3 class="section-title"><i class="fas fa-hand-holding-usd"></i> Trust & Payment Options</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label class="h-label">Option 1 Title</label>
                            <input type="text" name="learn_opt1_title" class="h-input"
                                value="{{ $settings['learn_opt1_title'] ?? 'Learn Now, Pay Later' }}">
                        </div>
                        <div class="form-group">
                            <label class="h-label">Option 1 Badge</label>
                            <input type="text" name="learn_opt1_badge" class="h-input"
                                value="{{ $settings['learn_opt1_badge'] ?? '🤝 TRUST BASED' }}">
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="h-label">Option 1 Description (HTML Allowed)</label>
                            <textarea name="learn_opt1_desc" class="h-input"
                                rows="4">{{ $settings['learn_opt1_desc'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TRADE TAB -->
            <div id="tab-trade" class="tab-content">
                <div class="h-card">
                    <h3 class="section-title"><i class="fas fa-chart-line"></i> Nexus Hero</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="h-label">Hero Title</label>
                            <input type="text" name="trade_hero_title" class="h-input"
                                value="{{ $settings['trade_hero_title'] ?? 'Trade with Confidence' }}">
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label class="h-label">Hero Description (HTML Allowed)</label>
                            <textarea name="trade_hero_desc" class="h-input"
                                rows="4">{{ $settings['trade_hero_desc'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="h-card">
                    <h3 class="section-title"><i class="fas fa-bolt"></i> Activity Feed</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label class="h-label">Header Title</label>
                            <input type="text" name="trade_page_title" class="h-input"
                                value="{{ $settings['trade_page_title'] ?? 'Professional Trading Signals' }}">
                        </div>
                        <div class="form-group">
                            <label class="h-label">Header Subtitle</label>
                            <input type="text" name="trade_page_subtitle" class="h-input"
                                value="{{ $settings['trade_page_subtitle'] ?? 'Daily set-ups across all major markets.' }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEARCH ENGINE / FOOTER TAB -->
            <div id="tab-footer" class="tab-content">
                <div class="h-card">
                    <h3 class="section-title"><i class="fas fa-search"></i> Global SEO Core</h3>
                    <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label class="h-label">Meta Description</label>
                            <textarea name="meta_description" class="h-input"
                                rows="3">{{ $settings['meta_description'] ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="h-label">Meta Keywords</label>
                            <textarea name="meta_keywords" class="h-input"
                                rows="3">{{ $settings['meta_keywords'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="h-card">
                    <h3 class="section-title"><i class="fas fa-shoe-prints"></i> Footer Logic</h3>
                    <div style="display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label class="h-label">Footer About Text</label>
                            <textarea name="footer_about" class="h-input"
                                rows="4">{{ $settings['footer_about'] ?? 'GSM Trading Lab is a premier trading academy dedicated to empowering traders across all major markets.' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', {
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.2,
                ease: "power4.out"
            });
        });

        function showTab(tabId, event) {
            event.preventDefault();
            // Hide all
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

            // Show selected
            document.getElementById('tab-' + tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>
@endsection