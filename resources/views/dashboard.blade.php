@extends('layouts.dashboard')

@section('title', 'Student Dashboard')

@push('styles')
<style>
    :root {
        --card-bg: #1e293b;
        --card-border: rgba(255, 255, 255, 0.05);
        --text-muted: #94a3b8;
        --accent-primary: #8B5CF6;
        --accent-success: #10B981;
        --accent-danger: #EF4444;
        --accent-warning: #F59E0B;
    }

    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Glass Effect */
    .glass-panel {
        background: rgba(30, 41, 59, 0.7);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* Stats Cards */
    .stat-card {
        padding: 1.5rem;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 100px; height: 100px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    /* Signal Cards */
    .signal-ticket {
        background: linear-gradient(145deg, #1e293b, #0f172a);
        border-radius: 12px;
        border: 1px solid var(--card-border);
        padding: 1.25rem;
        position: relative;
        overflow: hidden;
    }
    .signal-ticket.buy { border-left: 4px solid var(--accent-success); }
    .signal-ticket.sell { border-left: 4px solid var(--accent-danger); }

    /* Table Styling */
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .custom-table th {
        text-align: left;
        padding: 1rem;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.85rem;
        border-bottom: 1px solid var(--card-border);
    }
    .custom-table td {
        padding: 1rem;
        border-bottom: 1px solid var(--card-border);
        color: white;
    }
    .custom-table tr:last-child td { border-bottom: none; }

    /* Animations */
    @keyframes pulse-glow {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }
    .live-indicator {
        display: inline-block;
        width: 8px; height: 8px;
        background: var(--accent-success);
        border-radius: 50%;
        margin-right: 6px;
        animation: pulse-glow 2s infinite;
    }
</style>
@endpush

@section('content')
<div class="dashboard-container">
    
    <!-- Welcome Header -->
    <header style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1.5rem;">
        <div>
            <div style="font-size: 0.9rem; color: var(--accent-primary); font-weight: 600; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <span>👋</span> HELLO TRADER
            </div>
            <h1 style="font-size: 2rem; font-weight: 700; color: white; margin: 0;">
                Welcome back, <span style="background: linear-gradient(to right, #8B5CF6, #3B82F6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">{{ $user->name }}</span>
            </h1>
            <p style="color: var(--text-muted); margin-top: 0.5rem;">Let's check your market status today.</p>
        </div>

        @php $hasPremium = $orders->where('status', 'completed')->isNotEmpty(); @endphp
        <div class="glass-panel" style="padding: 0.75rem 1.5rem; display: flex; align-items: center; gap: 1rem; border-radius: 50px;">
            <div style="text-align: right;">
                <div style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;">Current Plan</div>
                <div style="font-weight: 700; color: white;">{{ $hasPremium ? 'Premium Member' : 'Standard Account' }}</div>
            </div>
            <div style="width: 40px; height: 40px; background: {{ $hasPremium ? 'linear-gradient(135deg, #10B981, #059669)' : 'rgba(255,255,255,0.1)' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                {{ $hasPremium ? '👑' : '👤' }}
            </div>
        </div>
    </header>

    <!-- Stats Overview Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <!-- Mentorships -->
        <div class="stat-card" style="background: linear-gradient(135deg, #3B82F6, #2563EB);">
            <div style="position: relative; z-index: 1;">
                <div style="font-size: 3rem; font-weight: 800; color: white; line-height: 1;">{{ $orders->count() }}</div>
                <div style="font-size: 0.9rem; color: rgba(255,255,255,0.8); margin-top: 0.5rem; font-weight: 500;">Active Mentorships</div>
            </div>
            <div style="position: absolute; bottom: 1rem; right: 1rem; font-size: 4rem; opacity: 0.2; transform: rotate(-15deg);">📚</div>
        </div>

        <!-- Signals -->
        <div class="stat-card" style="background: linear-gradient(135deg, #10B981, #059669);">
            <div style="position: relative; z-index: 1;">
                <div style="font-size: 3rem; font-weight: 800; color: white; line-height: 1;">{{ $totalSignals ?? '0' }}</div>
                <div style="font-size: 0.9rem; color: rgba(255,255,255,0.8); margin-top: 0.5rem; font-weight: 500;">Signals Available</div>
            </div>
            <div style="position: absolute; bottom: 1rem; right: 1rem; font-size: 4rem; opacity: 0.2; transform: rotate(-15deg);">🚀</div>
        </div>

        <!-- Status -->
        <div class="stat-card" style="background: linear-gradient(135deg, #F59E0B, #D97706);">
            <div style="position: relative; z-index: 1;">
                <div style="font-size: 2rem; font-weight: 800; color: white; line-height: 1; margin-bottom: 0.5rem;">
                    {{ $hasPremium ? 'VIP' : 'Free' }}
                </div>
                <div style="font-size: 0.9rem; color: rgba(255,255,255,0.8); font-weight: 500;">Membership Tier</div>
            </div>
            <div style="position: absolute; bottom: 1rem; right: 1rem; font-size: 4rem; opacity: 0.2; transform: rotate(-15deg);">⭐</div>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start;">
        
        <!-- Left Column: Signals & Activity -->
        <div>
            <!-- Live Signals Section -->
            <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2 style="font-size: 1.25rem; font-weight: 700; color: white; display: flex; align-items: center;">
                        <span class="live-indicator"></span> Live Market Signals
                    </h2>
                    <a href="/trade" style="font-size: 0.85rem; color: var(--accent-primary); text-decoration: none; font-weight: 600;">View All &rarr;</a>
                </div>

                @if($activeSignals->count() > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1rem;">
                        @foreach($activeSignals->take(2) as $signal)
                            <div class="signal-ticket {{ strtolower($signal->type) }}">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                    <h3 style="margin: 0; font-size: 1.1rem; color: white;">{{ $signal->symbol }}</h3>
                                    <span style="background: rgba(255,255,255,0.1); padding: 2px 8px; border-radius: 4px; font-size: 0.75rem; color: var(--text-muted);">
                                        {{ $signal->created_at->diffForHumans(null, true, true) }} ago
                                    </span>
                                </div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-bottom: 1rem;">
                                    <div>
                                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Entry</div>
                                        <div style="font-weight: 700; color: white;">{{ $signal->entry_price }}</div>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">{{ $signal->type }}</div>
                                        <div style="font-weight: 700; color: {{ $signal->type == 'BUY' ? var('--accent-success') : var('--accent-danger') }}">
                                            {{ $signal->type }}
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; gap: 0.5rem;">
                                    <span style="background: rgba(16, 185, 129, 0.2); color: #10B981; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">TP: {{ $signal->take_profit_1 }}</span>
                                    <span style="background: rgba(239, 68, 68, 0.2); color: #EF4444; padding: 4px 8px; border-radius: 4px; font-size: 0.75rem; font-weight: 600;">SL: {{ $signal->stop_loss }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align: center; padding: 3rem 1rem; border: 1px dashed var(--card-border); border-radius: 12px; background: rgba(255,255,255,0.01);">
                        <div style="font-size: 2rem; margin-bottom: 0.5rem; opacity: 0.5;">😴</div>
                        <p style="color: var(--text-muted); font-size: 0.9rem;">No active signals at the moment.</p>
                    </div>
                @endif
            </div>

            <!-- Recent Activity -->
            <div class="glass-panel" style="padding: 1.5rem;">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: white; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span>📜</span> Recent Orders
                </h3>
                
                @if($orders->count() > 0)
                    <div style="overflow-x: auto;">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders->take(5) as $order)
                                    <tr>
                                        <td>
                                            <div style="font-weight: 500;">{{ $order->service_name }}</div>
                                        </td>
                                        <td style="color: var(--text-muted);">{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if($order->status == 'completed')
                                                <span style="background: rgba(16, 185, 129, 0.15); color: #10B981; padding: 4px 10px; border-radius: 50px; font-size: 0.75rem; font-weight: 600;">Active</span>
                                            @elseif($order->status == 'pending')
                                                <span style="background: rgba(245, 158, 11, 0.15); color: #F59E0B; padding: 4px 10px; border-radius: 50px; font-size: 0.75rem; font-weight: 600;">Pending</span>
                                            @else
                                                <span style="background: rgba(239, 68, 68, 0.15); color: #EF4444; padding: 4px 10px; border-radius: 50px; font-size: 0.75rem; font-weight: 600;">{{ ucfirst($order->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="text-align: center; padding: 3rem;">
                        <p style="color: var(--text-muted); margin-bottom: 1rem;">Your journey begins here.</p>
                        <a href="/learn" class="btn btn-primary" style="padding: 0.6rem 1.5rem; border-radius: 8px;">Browse Courses</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Column: Sidebar -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            
            <!-- Quick Connect -->
            <div class="glass-panel" style="padding: 1.5rem;">
                <h4 style="margin-bottom: 1rem; font-size: 1rem; font-weight: 700; color: white; border-bottom: 1px solid var(--card-border); padding-bottom: 0.5rem;">
                    🚀 Quick Connect
                </h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                    <a href="{{ $settings['youtube_link'] ?? '#' }}" target="_blank" style="padding: 0.75rem; background: rgba(255,0,0,0.1); border: 1px solid rgba(255,0,0,0.2); border-radius: 8px; color: #ff4444; font-weight: 600; text-decoration: none; font-size: 0.85rem; text-align: center; transition: 0.2s;">
                        <i class="fab fa-youtube"></i> YouTube
                    </a>
                    <a href="{{ $settings['telegram_link'] ?? '#' }}" target="_blank" style="padding: 0.75rem; background: rgba(0,136,204,0.1); border: 1px solid rgba(0,136,204,0.2); border-radius: 8px; color: #33aaff; font-weight: 600; text-decoration: none; font-size: 0.85rem; text-align: center; transition: 0.2s;">
                        <i class="fab fa-telegram-plane"></i> Telegram
                    </a>
                    <a href="{{ $settings['instagram_link'] ?? '#' }}" target="_blank" style="padding: 0.75rem; background: rgba(225,48,108,0.1); border: 1px solid rgba(225,48,108,0.2); border-radius: 8px; color: #e1306c; font-weight: 600; text-decoration: none; font-size: 0.85rem; text-align: center; transition: 0.2s;">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                    <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '447478035502' }}" target="_blank" style="padding: 0.75rem; background: rgba(37,211,102,0.1); border: 1px solid rgba(37,211,102,0.2); border-radius: 8px; color: #25d366; font-weight: 600; text-decoration: none; font-size: 0.85rem; text-align: center; transition: 0.2s;">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
                <a href="{{ route('contact') }}" style="display: block; width: 100%; margin-top: 1rem; padding: 0.75rem; background: var(--card-bg); border: 1px solid var(--card-border); border-radius: 8px; color: var(--text-muted); text-align: center; text-decoration: none; font-size: 0.85rem; transition: 0.2s;">
                    Need Help? Contact Support
                </a>
            </div>

            <!-- Risk Management Widget -->
            <div class="glass-panel" style="padding: 1.5rem; background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), rgba(0, 0, 0, 0));">
                <h4 style="margin-bottom: 1rem; font-size: 1rem; font-weight: 700; color: #10B981; display: flex; align-items: center; gap: 0.5rem;">
                    🛡️ Risk Management
                </h4>
                <div style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.6;">
                    <div style="margin-bottom: 1rem;">
                        <strong style="color: #EF4444; display: block; margin-bottom: 0.25rem;">STOP LOSS IS MANDATORY</strong>
                        Never trade without insurance. Protect your capital first.
                    </div>
                    <div style="margin-bottom: 1rem;">
                        <strong style="color: #10B981; display: block; margin-bottom: 0.25rem;">1-2% Rule</strong>
                        Only risk 1-2% of your account per trade to survive long term.
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Add any specific dashboard scripts here
</script>
@endsection
@endsection