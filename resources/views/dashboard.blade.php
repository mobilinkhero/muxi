@extends('layouts.dashboard')

@section('title', 'Student Dashboard')

@push('styles')
<style>
    @keyframes glow-red {
        0% { text-shadow: 0 0 5px rgba(239, 68, 68, 0.2); }
        50% { text-shadow: 0 0 15px rgba(239, 68, 68, 0.6), 0 0 20px rgba(239, 68, 68, 0.4); }
        100% { text-shadow: 0 0 5px rgba(239, 68, 68, 0.2); }
    }
    @keyframes glow-green {
        0% { text-shadow: 0 0 5px rgba(16, 185, 129, 0.2); }
        50% { text-shadow: 0 0 15px rgba(16, 185, 129, 0.6), 0 0 20px rgba(16, 185, 129, 0.4); }
        100% { text-shadow: 0 0 5px rgba(16, 185, 129, 0.2); }
    }
    .tip-highlight-red {
        color: #ef4444;
        font-weight: 800;
        animation: glow-red 2s infinite;
    }
    .tip-highlight-green {
        color: #10B981;
        font-weight: 800;
        animation: glow-green 2s infinite;
    }
    .tip-item {
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        font-size: 0.9rem;
        line-height: 1.5;
    }
    .tip-item:last-child { border-bottom: none; }
</style>
@endpush

@section('content')
    <header
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h1 style="margin-bottom: 0.5rem; font-size: 1.8rem;">Welcome back, <span
                style="background: linear-gradient(to right, #fff, #9CA3AF); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $user->name }}</span>!
        </h1>
        <p style="color: var(--gray);">Here's your trading overview for today.</p>
    </div>
    <div>
        @php
            $hasPremium = $orders->where('status', 'completed')->isNotEmpty();
        @endphp
        <div
            style="display: inline-flex; align-items: center; background: {{ $hasPremium ? 'rgba(16, 185, 129, 0.1)' : 'rgba(255, 255, 255, 0.05)' }}; padding: 0.5rem 1rem; border-radius: 50px; border: 1px solid {{ $hasPremium ? 'rgba(16, 185, 129, 0.2)' : 'rgba(255,255,255,0.1)' }};">
            <span
                style="width: 8px; height: 8px; background: {{ $hasPremium ? '#10B981' : '#cbd5e1' }}; border-radius: 50%; margin-right: 8px; animation: {{ $hasPremium ? 'pulse 2s infinite' : 'none' }}"></span>
            <span
                style="font-size: 0.85rem; font-weight: 600; color: {{ $hasPremium ? '#10B981' : 'var(--gray-light)' }}">{{ $hasPremium ? 'Premium Active' : 'Standard Plan' }}</span>
        </div>
    </div>
</header>

@if($orders->where('status', 'rejected')->isNotEmpty())
    <div style="margin-bottom: 2rem; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); border-radius: 8px; padding: 1.5rem;">
        <h3 style="color: #EF4444; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; font-size: 1.1rem; font-weight: 700;">
            ⚠️ Action Required: Order Rejected
        </h3>
        
        @foreach($orders->where('status', 'rejected') as $rejectedOrder)
            <div style="margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(239, 68, 68, 0.2);">
                <p style="color: var(--white); margin-bottom: 0.5rem; font-size: 0.95rem;">
                    Your request for <strong>{{ $rejectedOrder->service_name }}</strong> was rejected.
                </p>
                
                @if($rejectedOrder->rejection_reason)
                    <div style="background: rgba(239, 68, 68, 0.1); padding: 0.75rem; border-radius: 4px; border-left: 3px solid #EF4444; margin-bottom: 1rem;">
                        <span style="color: #EF4444; font-weight: bold; font-size: 0.85rem; display: block; margin-bottom: 0.25rem;">Admin Note:</span>
                        <div style="color: var(--white); font-size: 0.9rem;">"{{ $rejectedOrder->rejection_reason }}"</div>
                    </div>
                @endif
                
                <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                    @if($rejectedOrder->payment_method === 'Verification')
                        <a href="/learn" class="btn btn-sm" 
                           style="background: #EF4444; color: white; border: none; padding: 0.5rem 1rem; border-radius: 4px; font-weight: 600; text-decoration: none; font-size: 0.85rem;">
                           ↻ Re-Submit Verification
                        </a>
                    @else
                        <a href="{{ route('contact') }}" class="btn btn-sm" 
                           style="background: transparent; color: #EF4444; border: 1px solid #EF4444; padding: 0.5rem 1rem; border-radius: 4px; font-weight: 600; text-decoration: none; font-size: 0.85rem;">
                           📞 Contact Support
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif

<!-- Stats Overview -->
<div class="stats-grid">
    <div class="dashboard-card" style="text-align: center;">
        <div class="stat-number"
            style="font-size: 2.5rem; font-weight: 800; color: var(--white); margin-bottom: 0.25rem;">
            {{ $orders->count() }}</div>
        <div class="stat-label"
            style="color: var(--gray); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">
            Active Mentorships</div>
    </div>
    <div class="dashboard-card" style="text-align: center;">
        <div class="stat-number"
            style="font-size: 2.5rem; font-weight: 800; color: #10B981; margin-bottom: 0.25rem;">
            {{ $totalSignals ?? '0' }}</div>
        <div class="stat-label"
            style="color: var(--gray); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">
            Signals Available</div>
    </div>
    <div class="dashboard-card" style="text-align: center;">
        <div class="stat-number"
            style="font-size: 2.5rem; font-weight: 800; color: var(--primary-light); margin-bottom: 0.25rem;">
            {{ $hasPremium ? 'VIP' : 'Free' }}</div>
        <div class="stat-label"
            style="color: var(--gray); font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">
            Membership Status</div>
    </div>
</div>

<!-- Upcoming Live Classes Section -->
@if($liveClasses->isNotEmpty())
<div style="margin-bottom: 2.5rem;">
    <h2 style="font-size: 1.4rem; display: flex; align-items: center; gap: 10px; margin-bottom: 1.5rem;">
        <span style="font-size: 1.6rem;">🎥</span> Upcoming Live Classes
    </h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
        @foreach($liveClasses as $class)
            @php
                $isLive = now()->between($class->scheduled_at, $class->scheduled_at->addMinutes($class->duration_minutes));
            @endphp
            <div class="dashboard-card" style="border-left: 4px solid {{ $isLive ? '#ef4444' : 'var(--primary)' }}; position: relative; overflow: hidden;">
                @if($isLive)
                    <div style="position: absolute; top: 1rem; right: 1rem; background: #ef4444; color: white; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.7rem; font-weight: bold; animation: pulse 1.5s infinite;">LIVE NOW</div>
                @endif
                <div style="font-size: 0.8rem; color: var(--gray); margin-bottom: 0.5rem;">Scheduled: {{ $class->scheduled_at->format('M d, h:i A') }}</div>
                <h3 style="margin-bottom: 1rem; font-size: 1.2rem; color: var(--white);">{{ $class->title }}</h3>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 0.85rem; color: var(--gray-light);">Duration: {{ $class->duration_minutes }} Mins</div>
                    <a href="{{ route('lms.join', $class->id) }}" target="_blank" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                        {{ $isLive ? 'Join Meeting' : 'Join Early' }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

<!-- Active Signals Section -->
<div style="margin-bottom: 3rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="font-size: 1.4rem; display: flex; align-items: center; gap: 10px;">
            <span
                style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%; animation: pulse 1.5s infinite;"></span>
            Live Signals
        </h2>
        <a href="/trade"
            style="color: var(--primary-light); text-decoration: none; font-size: 0.9rem; font-weight: 600; display: flex; align-items: center; gap: 5px;">View
            All <span>→</span></a>
    </div>

    @if($activeSignals->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
            @foreach($activeSignals->take(3) as $signal)
                <div class="signal-card"
                    style="border-left: 4px solid {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }};">
                    <div class="signal-header" style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div style="font-size: 2rem; line-height: 1;">{{ $signal->type == 'BUY' ? '🟢' : '🔴' }}
                            </div>
                            <div>
                                <h3 style="margin: 0; font-size: 1.2rem; color: var(--white); font-weight: 700;">
                                    {{ $signal->symbol }}</h3>
                                <span
                                    style="color: {{ $signal->type == 'BUY' ? '#10B981' : '#ef4444' }}; font-weight: 700; font-size: 0.8rem; text-transform: uppercase;">
                                    {{ $signal->type }} MARKET
                                </span>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <div
                                style="font-size: 0.75rem; color: var(--gray); background: rgba(255,255,255,0.05); padding: 2px 8px; border-radius: 4px;">
                                {{ $signal->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="signal-body" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                        <div>
                            <div style="font-size: 0.75rem; color: var(--gray); text-transform: uppercase; margin-bottom: 0.25rem;">Entry Price</div>
                            <div style="font-size: 1.1rem; color: var(--white); font-weight: bold;">{{ $signal->entry_price }}</div>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; color: var(--gray); text-transform: uppercase; margin-bottom: 0.25rem;">TP1</div>
                            <div style="font-size: 1.1rem; color: #10B981; font-weight: bold;">{{ $signal->take_profit_1 }}</div>
                        </div>
                        <div>
                            <div style="font-size: 0.75rem; color: var(--gray); text-transform: uppercase; margin-bottom: 0.25rem;">Stop Loss</div>
                            <div style="font-size: 1.1rem; color: #ef4444; font-weight: bold;">{{ $signal->stop_loss }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div
            style="text-align: center; padding: 4rem; background: rgba(255, 255, 255, 0.02); border-radius: var(--radius-md); border: 1px dashed rgba(255, 255, 255, 0.1);">
            <div style="font-size: 2rem; margin-bottom: 1rem;">😴</div>
            <p style="color: var(--gray); font-size: 1.1rem;">No active signals right now.</p>
            <p style="color: var(--gray-light); font-size: 0.9rem;">Market is quiet. Check back later or review
                your training.</p>
        </div>
    @endif
</div>

<!-- Dashboard Grid -->
<div class="dashboard-grid-layout" style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
    <!-- Recent Orders -->
    <div>
        <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">📜 Recent Activity</h3>
        <div class="dashboard-card" style="padding: 0; overflow: hidden;">
            @if($orders->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                        <thead style="background: rgba(255, 255, 255, 0.03);">
                            <tr>
                                <th
                                    style="padding: 1rem; text-align: left; font-size: 0.85rem; color: var(--gray); font-weight: 600;">
                                    Service Plan</th>
                                <th
                                    style="padding: 1rem; text-align: left; font-size: 0.85rem; color: var(--gray); font-weight: 600;">
                                    Enrollment Date</th>
                                <th
                                    style="padding: 1rem; text-align: left; font-size: 0.85rem; color: var(--gray); font-weight: 600;">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders->take(5) as $order)
                                <tr style="border-top: 1px solid rgba(255,255,255,0.05);">
                                    <td style="padding: 1rem; font-weight: 500;">{{ $order->service_name }}</td>
                                    <td style="padding: 1rem; color: var(--gray);">
                                        {{ $order->created_at->format('M d, Y') }}</td>
                                    <td style="padding: 1rem;">
                                        @if($order->status == 'completed')
                                            <span class="badge badge-success">Active</span>
                                        @elseif($order->status == 'pending')
                                            <span class="badge badge-warning">Pending Review</span>
                                        @else
                                            <span class="badge badge-danger">{{ ucfirst($order->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 3rem;">
                    <p style="color: var(--gray); margin-bottom: 1rem;">Start your journey today.</p>
                    <a href="/learn" class="btn btn-primary btn-sm">Browse Training</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Suggested Actions Sidebar -->
    <div>
        <div class="dashboard-card" style="margin-bottom: 1.5rem;">
            <h4 style="margin-bottom: 1rem; font-size: 1.1rem;">⚡ Quick Actions</h4>
            <p style="font-size: 0.8rem; color: var(--gray); margin-bottom: 1.25rem;">Latest updates aur support ke liye humein follow karain. Username: <b>gsmtradinglab</b></p>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                <a href="{{ $settings['youtube_link'] ?? 'https://youtube.com/@gsmtradinglab' }}" target="_blank"
                    style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(255, 0, 0, 0.1); color: #FF0000; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(255, 0, 0, 0.2); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    🎥 YouTube
                </a>
                <a href="{{ $settings['telegram_link'] ?? 'https://t.me/gsmtradinglab' }}" target="_blank"
                    style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(0, 136, 204, 0.1); color: #0088cc; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(0, 136, 204, 0.2); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    📱 Telegram
                </a>
                <a href="{{ $settings['instagram_link'] ?? 'https://instagram.com/gsmtradinglab' }}" target="_blank"
                    style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(225, 48, 108, 0.1); color: #E1306C; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(225, 48, 108, 0.2); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    📸 Insta
                </a>
                <a href="{{ $settings['facebook_link'] ?? 'https://facebook.com/gsmtradinglab' }}" target="_blank"
                    style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(24, 119, 242, 0.1); color: #1877F2; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(24, 119, 242, 0.2); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    🔵 Facebook
                </a>
                <a href="{{ $settings['snapchat_link'] ?? 'https://snapchat.com/add/gsmtradinglab' }}" target="_blank"
                    style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(255, 252, 0, 0.1); color: #e9e500; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(255, 252, 0, 0.2); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    👻 Snapchat
                </a>
                <a href="{{ $settings['threads_link'] ?? 'https://threads.net/@gsmtradinglab' }}" target="_blank"
                    style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(255, 255, 255, 0.05); color: #ffffff; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    🧵 Threads
                </a>
                <a href="{{ $settings['twitter_link'] ?? 'https://twitter.com/gsmtradinglab' }}" target="_blank"
                    style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(255, 255, 255, 0.05); color: #ffffff; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    𝕏 Twitter
                </a>
                <a href="{{ $settings['tiktok_link'] ?? 'https://tiktok.com/@gsmtradinglab' }}" target="_blank"
                    style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(255, 255, 255, 0.05); color: #ffffff; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    🎶 TikTok
                </a>
                <a href="{{ $settings['discord_link'] ?? 'https://discord.gg/gsmtradinglab' }}" target="_blank"
                    style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(88, 101, 242, 0.1); color: #5865F2; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(88, 101, 242, 0.2); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    🎮 Discord
                </a>
                <a href="{{ $settings['linkedin_link'] ?? 'https://linkedin.com/in/gsmtradinglab' }}" target="_blank"
                    style="display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(10, 102, 194, 0.1); color: #0a66c2; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(10, 102, 194, 0.2); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    💼 LinkedIn
                </a>
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '447478035502' }}" target="_blank"
                    style="grid-column: span 2; display: flex; align-items: center; justify-content: center; gap: 6px; padding: 0.6rem; background: rgba(37, 211, 102, 0.1); color: #25D366; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(37, 211, 102, 0.2); font-size: 0.8rem; font-weight: 600; transition: 0.2s;">
                    💬 WhatsApp
                </a>
            </div>
            <a href="{{ route('contact') }}"
                style="display: flex; align-items: center; justify-content: center; gap: 10px; padding: 0.75rem; background: rgba(16, 185, 129, 0.1); color: #10B981; text-decoration: none; border-radius: var(--radius-sm); border: 1px solid rgba(16, 185, 129, 0.2); font-weight: 600; margin-top: 1rem; transition: 0.2s;">
                📞 Contact Support
            </a>
        </div>

        <div class="dashboard-card"
            style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), rgba(0, 0, 0, 0.2)); border: 1px solid rgba(255, 255, 255, 0.05);">
            <h4 style="margin-bottom: 1.5rem; font-size: 1.1rem; color: #10B981; display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 1.2rem;">🛡️</span> Risk Management
            </h4>
            
            <div class="tip-item">
                <span class="tip-highlight-red">NEVER TRADE WITHOUT STOP LOSS!</span>
                <p style="margin: 0.25rem 0 0; color: var(--gray-light);">Ye aapka insurance hai. Is ke baghair market ma utarna account wash karne barabar hai.</p>
            </div>

            <div class="tip-item">
                Account ka sirf <span class="tip-highlight-green">1% se 2%</span> risk karain.
                <p style="margin: 0.25rem 0 0; color: var(--gray-light);">Consistency over luck. Baray risk se bachain taake lambay arsay tak race ma rahain.</p>
            </div>

            <div class="tip-item">
                Jab tak <span class="tip-highlight-green">Trade Break-Even</span> na ho, next entry mat lain.
                <p style="margin: 0.25rem 0 0; color: var(--gray-light);">Over-trading se gurez karain aur apne capital ko safe rakhain.</p>
            </div>
            
            <div style="margin-top: 1rem; font-size: 0.8rem; color: var(--gray); font-style: italic;">
                "Trading is 90% psychology and 10% strategy."
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
    // Specific dashboard scripts if any (already handled globally by security-script)
</script>
@endsection
@endsection