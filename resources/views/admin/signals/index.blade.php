@extends('layouts.admin')

@section('title', 'Signal Matrix - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Live Signals</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Total signals deployed: {{ $signals->count() }}</p>
        </div>
        <a href="{{ route('admin.signals.create') }}" class="action-btn"
            style="background: var(--h-primary); color: white; padding: 12px 24px; border-radius: 16px; font-weight: 800; text-decoration: none;">
            <i class="fas fa-plus"></i> Deploy New Signal
        </a>
    </div>

    <div class="h-card h-reveal" style="padding: 1rem;">
        <div style="overflow-x: auto;">
            <table class="h-table">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Asset Pair</th>
                        <th>Operation</th>
                        <th>Entry Node</th>
                        <th>Target / Defense</th>
                        <th>Status</th>
                        <th>Protocol</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($signals as $signal)
                        <tr>
                            <td style="font-family: 'JetBrains Mono'; font-size: 0.85rem; color: #94A3B8;">
                                {{ $signal->created_at->format('M d, H:i') }}
                            </td>
                            <td style="font-weight: 900; color: white; font-size: 1.1rem;">
                                {{ $signal->symbol }}
                            </td>
                            <td>
                                <span class="status-pill"
                                    style="background: {{ $signal->type == 'BUY' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)' }}; color: {{ $signal->type == 'BUY' ? '#10B981' : '#EF4444' }};">
                                    {{ $signal->type }}
                                </span>
                            </td>
                            <td style="font-family: 'JetBrains Mono'; font-weight: 700; color: white;">
                                {{ $signal->entry_price }}
                            </td>
                            <td>
                                <div style="color: #10B981; font-family: 'JetBrains Mono'; font-weight: 700;">TP1:
                                    {{ $signal->take_profit_1 }}</div>
                                <div style="color: #EF4444; font-family: 'JetBrains Mono'; font-weight: 700;">SL:
                                    {{ $signal->stop_loss }}</div>
                            </td>
                            <td>
                                <span class="status-pill"
                                    style="background: {{ $signal->status == 'active' ? 'rgba(245, 158, 11, 0.1)' : ($signal->status == 'closed' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(255,255,255,0.05)') }}; 
                                               color: {{ $signal->status == 'active' ? '#F59E0B' : ($signal->status == 'closed' ? '#10B981' : '#94A3B8') }};">
                                    {{ strtoupper($signal->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.signals.edit', $signal->id) }}" class="action-btn"
                                    style="background: rgba(99, 102, 241, 0.1); color: var(--h-primary); border: 1px solid rgba(99, 102, 241, 0.2); padding: 8px 16px;">
                                    <i class="fas fa-edit"></i> Modify
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 4rem; color: #94A3B8;">
                                <i class="fas fa-satellite-dish"
                                    style="font-size: 3rem; opacity: 0.2; margin-bottom: 1rem;"></i>
                                <p>No signal transmissions active.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', {
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.1,
                ease: "power4.out"
            });
        });
    </script>
@endsection

<style>
    .h-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .h-table tr {
        background: rgba(255, 255, 255, 0.02);
        transition: 0.4s cubic-bezier(0.2, 1, 0.3, 1);
    }

    .h-table tr:hover {
        background: rgba(255, 255, 255, 0.05);
        transform: scale(1.005);
    }

    .h-table td,
    .h-table th {
        padding: 1.5rem;
        text-align: left;
        vertical-align: middle;
    }

    .h-table th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #94A3B8;
        font-weight: 800;
    }

    .h-table td:first-child {
        border-radius: 20px 0 0 20px;
    }

    .h-table td:last-child {
        border-radius: 0 20px 20px 0;
    }

    .status-pill {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .action-btn {
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 700;
        transition: 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .h-reveal {
        opacity: 0;
        transform: translateY(20px);
    }
</style>