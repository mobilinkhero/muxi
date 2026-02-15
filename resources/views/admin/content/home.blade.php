@extends('layouts.admin')

@section('title', 'Manage Homepage')
@section('header', 'Homepage Content')

@section('content')
    <div class="card">
        <form action="{{ route('admin.content.pages.update') }}" method="POST">
            @csrf

            <!-- Hero Section -->
            <h3
                style="color: var(--primary); border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem; margin-bottom: 1.5rem;">
                Hero Section
            </h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div class="form-group">
                    <label class="form-label">Hero Badge Text</label>
                    <input type="text" name="home_hero_badge" class="form-input"
                        value="{{ $settings['home_hero_badge'] ?? 'Join Our Growing Community of Traders' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Hero Title (HTML enabled)</label>
                    <textarea name="home_hero_title" class="form-input"
                        rows="3">{{ $settings['home_hero_title'] ?? 'Master Trading Across <br> <span style=\"background: linear-gradient(135deg, #8B5CF6, #EC4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent;\">All Major Markets</span>' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Hero Description</label>
                    <textarea name="home_hero_desc" class="form-input"
                        rows="3">{{ $settings['home_hero_desc'] ?? 'Professional Analysis • Risk Management • Psychology' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Hero Background Image URL</label>
                    <input type="text" name="home_hero_bg" class="form-input"
                        value="{{ $settings['home_hero_bg'] ?? 'https://images.unsplash.com/photo-1611974765270-ca12586343bb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80' }}">
                </div>
            </div>

            <!-- Stats Section -->
            <h3
                style="color: var(--primary); border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem; margin-bottom: 1.5rem;">
                Stats Section
            </h3>
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem;">
                <div class="form-group">
                    <label class="form-label">Stat 1 Count</label>
                    <input type="text" name="home_stat_1_val" class="form-input"
                        value="{{ $settings['home_stat_1_val'] ?? '150+' }}">
                    <label class="form-label" style="margin-top:0.5rem">Stat 1 Label</label>
                    <input type="text" name="home_stat_1_label" class="form-input"
                        value="{{ $settings['home_stat_1_label'] ?? 'Registered Students' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Stat 2 Count</label>
                    <input type="text" name="home_stat_2_val" class="form-input"
                        value="{{ $settings['home_stat_2_val'] ?? '90+' }}">
                    <label class="form-label" style="margin-top:0.5rem">Stat 2 Label</label>
                    <input type="text" name="home_stat_2_label" class="form-input"
                        value="{{ $settings['home_stat_2_label'] ?? 'Successful Members' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Stat 3 Count</label>
                    <input type="text" name="home_stat_3_val" class="form-input"
                        value="{{ $settings['home_stat_3_val'] ?? 'Real' }}">
                    <label class="form-label" style="margin-top:0.5rem">Stat 3 Label</label>
                    <input type="text" name="home_stat_3_label" class="form-input"
                        value="{{ $settings['home_stat_3_label'] ?? 'Proven Strategies' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Stat 4 Count</label>
                    <input type="text" name="home_stat_4_val" class="form-input"
                        value="{{ $settings['home_stat_4_val'] ?? '24/7' }}">
                    <label class="form-label" style="margin-top:0.5rem">Stat 4 Label</label>
                    <input type="text" name="home_stat_4_label" class="form-input"
                        value="{{ $settings['home_stat_4_label'] ?? 'Support Available' }}">
                </div>
            </div>

            <!-- Markets Section -->
            <h3
                style="color: var(--primary); border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem; margin-bottom: 1.5rem;">
                Markets Section
            </h3>
            <div class="form-group">
                <label class="form-label">Markets Description</label>
                <textarea name="home_markets_desc" class="form-input"
                    rows="2">{{ $settings['home_markets_desc'] ?? 'We provide comprehensive education and tools across all major markets - designed for beginners and professional traders alike.' }}</textarea>
            </div>
            <!-- (In real implementation, we would loop through a Markets table, but for now we can add settings for each of the 6 blocks) -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2rem;">
                @for($i = 1; $i <= 6; $i++)
                    <div style="background: rgba(255,255,255,0.02); padding: 1rem; border-radius: 8px;">
                        <label class="form-label">Market {{ $i }} Title</label>
                        <input type="text" name="home_market_{{ $i }}_title" class="form-input"
                            value="{{ $settings['home_market_' . $i . '_title'] ?? '' }}">
                        <label class="form-label" style="margin-top:0.5rem">Market {{ $i }} Desc</label>
                        <textarea name="home_market_{{ $i }}_desc" class="form-input"
                            rows="2">{{ $settings['home_market_' . $i . '_desc'] ?? '' }}</textarea>
                    </div>
                @endfor
            </div>

            <!-- How It Works -->
            <h3
                style="color: var(--primary); border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem; margin-bottom: 1.5rem;">
                How It Works Section
            </h3>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2rem;">
                @for($i = 1; $i <= 3; $i++)
                    <div style="background: rgba(255,255,255,0.02); padding: 1rem; border-radius: 8px;">
                        <label class="form-label">Step {{ $i }} Title</label>
                        <input type="text" name="home_step_{{ $i }}_title" class="form-input"
                            value="{{ $settings['home_step_' . $i . '_title'] ?? '' }}">
                        <label class="form-label" style="margin-top:0.5rem">Step {{ $i }} Desc</label>
                        <textarea name="home_step_{{ $i }}_desc" class="form-input"
                            rows="2">{{ $settings['home_step_' . $i . '_desc'] ?? '' }}</textarea>
                    </div>
                @endfor
            </div>

            <!-- CTA Section -->
            <h3
                style="color: var(--primary); border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem; margin-bottom: 1.5rem;">
                Closing CTA Section
            </h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                <div class="form-group">
                    <label class="form-label">CTA Title</label>
                    <input type="text" name="home_cta_title" class="form-input"
                        value="{{ $settings['home_cta_title'] ?? 'Ready to Start Your Trading Journey?' }}">
                </div>
                <div class="form-group">
                    <label class="form-label">CTA Description</label>
                    <textarea name="home_cta_desc" class="form-input"
                        rows="3">{{ $settings['home_cta_desc'] ?? 'Join thousands of successful traders and investors who trust us across all markets.' }}</textarea>
                </div>
            </div>

            <div style="text-align: right; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="padding: 1rem 3rem;">Update Homepage Content</button>
            </div>
        </form>
    </div>
@endsection