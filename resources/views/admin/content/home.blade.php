@extends('layouts.admin')

@section('title', 'Homepage Matrix - Admin')

@section('content')
<div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
    <div>
        <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Homepage Matrix</h1>
        <p style="color: #94A3B8; margin-top: 0.5rem;">Configuring the primary landing interface.</p>
    </div>
    <button type="submit" form="homeContentForm" class="btn-primary-h">
        <i class="fas fa-save"></i> Commit Changes
    </button>
</div>

<form id="homeContentForm" action="{{ route('admin.content.pages.update') }}" method="POST">
    @csrf

    <!-- Hero Section -->
    <div class="h-card h-reveal">
        <h3
            style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-star" style="color: var(--h-primary);"></i> Hero Configuration
        </h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
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
                <label class="h-label">Hero Title (HTML enabled)</label>
                <textarea name="home_hero_title" class="h-input"
                    rows="3">{{ $settings['home_hero_title'] ?? 'Master Trading Across <br> <span style="background: linear-gradient(135deg, #8B5CF6, #EC4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">All Major Markets</span>' }}</textarea>
            </div>
            <div class="form-group" style="grid-column: span 2;">
                <label class="h-label">Hero Description</label>
                <textarea name="home_hero_desc" class="h-input"
                    rows="3">{{ $settings['home_hero_desc'] ?? 'Professional Analysis • Risk Management • Psychology' }}</textarea>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="h-card h-reveal">
        <h3
            style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-chart-bar" style="color: var(--h-secondary);"></i> Statistics Array
        </h3>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem;">
            <div class="form-group">
                <label class="h-label">Stat 1 Count</label>
                <input type="text" name="home_stat_1_val" class="h-input"
                    value="{{ $settings['home_stat_1_val'] ?? '150+' }}">
                <label class="h-label" style="margin-top:0.5rem">Stat 1 Label</label>
                <input type="text" name="home_stat_1_label" class="h-input"
                    value="{{ $settings['home_stat_1_label'] ?? 'Registered Students' }}">
            </div>
            <div class="form-group">
                <label class="h-label">Stat 2 Count</label>
                <input type="text" name="home_stat_2_val" class="h-input"
                    value="{{ $settings['home_stat_2_val'] ?? '90+' }}">
                <label class="h-label" style="margin-top:0.5rem">Stat 2 Label</label>
                <input type="text" name="home_stat_2_label" class="h-input"
                    value="{{ $settings['home_stat_2_label'] ?? 'Successful Members' }}">
            </div>
            <div class="form-group">
                <label class="h-label">Stat 3 Count</label>
                <input type="text" name="home_stat_3_val" class="h-input"
                    value="{{ $settings['home_stat_3_val'] ?? 'Real' }}">
                <label class="h-label" style="margin-top:0.5rem">Stat 3 Label</label>
                <input type="text" name="home_stat_3_label" class="h-input"
                    value="{{ $settings['home_stat_3_label'] ?? 'Proven Strategies' }}">
            </div>
            <div class="form-group">
                <label class="h-label">Stat 4 Count</label>
                <input type="text" name="home_stat_4_val" class="h-input"
                    value="{{ $settings['home_stat_4_val'] ?? '24/7' }}">
                <label class="h-label" style="margin-top:0.5rem">Stat 4 Label</label>
                <input type="text" name="home_stat_4_label" class="h-input"
                    value="{{ $settings['home_stat_4_label'] ?? 'Support Available' }}">
            </div>
        </div>
    </div>

    <!-- Markets Section -->
    <div class="h-card h-reveal">
        <h3
            style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-globe-americas" style="color: #F59E0B;"></i> Market Coverage
        </h3>
        <div class="form-group mb-4">
            <label class="h-label">Markets Description</label>
            <textarea name="home_markets_desc" class="h-input"
                rows="2">{{ $settings['home_markets_desc'] ?? 'We provide comprehensive education and tools across all major markets - designed for beginners and professional traders alike.' }}</textarea>
        </div>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
            @for($i = 1; $i <= 6; $i++)
                <div
                    style="background: rgba(255,255,255,0.02); padding: 1rem; border-radius: 12px; border: 1px solid var(--h-border);">
                    <label class="h-label">Market {{ $i }} Title</label>
                    <input type="text" name="home_market_{{ $i }}_title" class="h-input"
                        value="{{ $settings['home_market_' . $i . '_title'] ?? '' }}">
                    <label class="h-label" style="margin-top:0.5rem">Market {{ $i }} Desc</label>
                    <textarea name="home_market_{{ $i }}_desc" class="h-input"
                        rows="2">{{ $settings['home_market_' . $i . '_desc'] ?? '' }}</textarea>
                </div>
            @endfor
        </div>
    </div>

    <!-- How It Works -->
    <div class="h-card h-reveal">
        <h3
            style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-cogs" style="color: #64748B;"></i> Operational Workflow
        </h3>
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
            @for($i = 1; $i <= 3; $i++)
                <div
                    style="background: rgba(255,255,255,0.02); padding: 1rem; border-radius: 12px; border: 1px solid var(--h-border);">
                    <label class="h-label">Step {{ $i }} Title</label>
                    <input type="text" name="home_step_{{ $i }}_title" class="h-input"
                        value="{{ $settings['home_step_' . $i . '_title'] ?? '' }}">
                    <label class="h-label" style="margin-top:0.5rem">Step {{ $i }} Desc</label>
                    <textarea name="home_step_{{ $i }}_desc" class="h-input"
                        rows="2">{{ $settings['home_step_' . $i . '_desc'] ?? '' }}</textarea>
                </div>
            @endfor
        </div>
    </div>

    <!-- CTA Section -->
    <div class="h-card h-reveal">
        <h3
            style="color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem;">
            <i class="fas fa-bullhorn" style="color: #10B981;"></i> Action Call (CTA)
        </h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label class="h-label">CTA Title</label>
                <input type="text" name="home_cta_title" class="h-input"
                    value="{{ $settings['home_cta_title'] ?? 'Ready to Start Your Trading Journey?' }}">
            </div>
            <div class="form-group">
                <label class="h-label">CTA Description</label>
                <textarea name="home_cta_desc" class="h-input"
                    rows="3">{{ $settings['home_cta_desc'] ?? 'Join thousands of successful traders and investors who trust us across all markets.' }}</textarea>
            </div>
        </div>
    </div>
</form>

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
</script>