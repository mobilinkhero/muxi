@extends('layouts.admin')

@section('title', 'Exchange Nexus - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Liquidity Nexus</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Cross-chain P2P Exchange Control Terminal</p>
        </div>
        <div style="display: flex; gap: 1rem;">
            <div class="card"
                style="margin: 0; padding: 12px 24px; border-radius: 16px; background: rgba(16, 185, 129, 0.1); border-color: rgba(16, 185, 129, 0.2);">
                <div style="font-size: 0.7rem; color: #10B981; font-weight: 800; text-transform: uppercase;">System Reserve
                </div>
                <div style="font-weight: 900; font-size: 1.25rem;">{{ number_format($usdtPool->balance, 2) }} <span
                        style="font-size: 0.8rem; opacity: 0.6;">USDT</span></div>
            </div>
        </div>
    </div>

    <!-- Stats Matrix -->
    <div class="grid-stats h-reveal">
        <div class="card stat-card" style="border-left: 4px solid var(--h-secondary);">
            <div style="font-size: 0.8rem; color: #94A3B8; font-weight: 700;">TOTAL_USER_BUY</div>
            <div style="font-size: 1.75rem; font-weight: 900; color: white; margin-top: 0.5rem;">
                {{ number_format($stats['total_volume_buy'], 2) }} <span
                    style="font-size: 0.9rem; opacity: 0.5;">USDT</span></div>
        </div>
        <div class="card stat-card" style="border-left: 4px solid var(--h-accent);">
            <div style="font-size: 0.8rem; color: #94A3B8; font-weight: 700;">TOTAL_USER_SELL</div>
            <div style="font-size: 1.75rem; font-weight: 900; color: white; margin-top: 0.5rem;">
                {{ number_format($stats['total_volume_sell'], 2) }} <span
                    style="font-size: 0.9rem; opacity: 0.5;">USDT</span></div>
        </div>
        <div class="card stat-card" style="border-left: 4px solid #F59E0B;">
            <div style="font-size: 0.8rem; color: #94A3B8; font-weight: 700;">PENDING_QUEUE</div>
            <div style="font-size: 1.75rem; font-weight: 900; color: white; margin-top: 0.5rem;">
                {{ $stats['total_pending'] }} <span style="font-size: 0.9rem; opacity: 0.5;">REQUESTS</span></div>
        </div>
    </div>

    <div class="p2p-layout h-reveal">
        <!-- Configuration Terminal -->
        <div class="card" style="flex: 1; min-width: 350px;">
            <h3 style="font-weight: 900; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-sliders-h" style="color: var(--h-primary);"></i> Node Config
            </h3>
            <form action="{{ route('admin.p2p.rates') }}" method="POST">
                @csrf
                <div class="form-group mb-4">
                    <label class="h-label">USDT RESERVE BALANCE</label>
                    <div class="h-input-wrapper">
                        <input type="number" step="0.01" name="balance" value="{{ $usdtPool->balance }}" class="h-input"
                            required>
                        <span class="h-addon">USDT</span>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="form-group">
                        <label class="h-label" style="color: var(--h-secondary);">SELL RATE (WE SELL)</label>
                        <div class="h-input-wrapper">
                            <input type="number" step="0.01" name="sell_rate" value="{{ $usdtPool->sell_rate }}"
                                class="h-input">
                            <span class="h-addon">PKR</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="h-label" style="color: var(--h-accent);">BUY RATE (WE BUY)</label>
                        <div class="h-input-wrapper">
                            <input type="number" step="0.01" name="buy_rate" value="{{ $usdtPool->buy_rate }}"
                                class="h-input">
                            <span class="h-addon">PKR</span>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">ADMIN BANK LOG (PKR DEPOSITS)</label>
                    <textarea name="pkr_bank" rows="3" class="h-input"
                        placeholder="Bank Title, Account #, IBAN">{{ $pkrPool->wallet_details }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">ADMIN WALLET LOG (USDT NETWORK)</label>
                    <textarea name="usdt_wallet" rows="2" class="h-input"
                        placeholder="TRC20 / ERC20 Address">{{ $usdtPool->wallet_details }}</textarea>
                </div>

                <button type="submit" class="btn-primary-h">
                    <i class="fas fa-sync-alt"></i> COMMIT CHANGES
                </button>
            </form>
        </div>

        <!-- Order Flow -->
        <div style="flex: 2; display: flex; flex-direction: column; gap: 2rem;">
            <!-- Pending Requests -->
            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <h3 style="font-weight: 900; margin: 0;">Validation Queue</h3>
                    <span class="status-pill"
                        style="background: rgba(245, 158, 11, 0.1); color: #F59E0B;">{{ $pendingTransactions->count() }}
                        PENDING</span>
                </div>

                <div style="overflow-x: auto;">
                    <table class="h-table">
                        <thead>
                            <tr>
                                <th>Entity</th>
                                <th>Type</th>
                                <th>Volume</th>
                                <th>Proof</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingTransactions as $tx)
                                <tr>
                                    <td>
                                        <div style="font-weight: 800;">{{ $tx->user->name }}</div>
                                        <div style="font-size: 0.75rem; color: #94A3B8; font-family: 'JetBrains Mono';">
                                            {{ $tx->user->email }}</div>
                                    </td>
                                    <td>
                                        <span class="status-pill"
                                            style="background: {{ $tx->type == 'buy' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)' }}; color: {{ $tx->type == 'buy' ? '#10B981' : '#EF4444' }};">
                                            {{ strtoupper($tx->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div style="font-weight: 900;">{{ number_format($tx->amount_asset, 2) }} USDT</div>
                                        <div style="font-size: 0.75rem; color: #94A3B8;">
                                            {{ number_format($tx->amount_fiat, 2) }} PKR</div>
                                    </td>
                                    <td>
                                        @if($tx->type == 'buy' && $tx->proof_image)
                                            <a href="{{ Storage::url($tx->proof_image) }}" target="_blank" class="action-btn"
                                                style="background: rgba(99, 102, 241, 0.1); color: var(--h-primary);">
                                                <i class="fas fa-file-invoice"></i> PROOF
                                            </a>
                                        @elseif($tx->type == 'sell')
                                            <button
                                                onclick="alert('PAYMENT DETAILS:\n{{ str_replace(array("\r", "\n"), " ", $tx->user_payment_details) }}')"
                                                class="action-btn"
                                                style="background: rgba(236, 72, 153, 0.1); color: var(--h-accent);">
                                                <i class="fas fa-university"></i> DETAILS
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 8px;">
                                            <form action="{{ route('admin.p2p.process', $tx->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="approve">
                                                <button type="submit" class="action-btn"
                                                    style="background: #10B981; color: white;"
                                                    onclick="return confirm('APPROVE_SEQUENCE_START?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.p2p.process', $tx->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit" class="action-btn"
                                                    style="background: #EF4444; color: white;"
                                                    onclick="return confirm('REJECT_PURGE_START?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 2rem; color: #94A3B8;">QUEUE_EMPTY</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- History -->
            <div class="card">
                <h3 style="font-weight: 900; margin-bottom: 2rem;">Archive Logs</h3>
                <div style="overflow-x: auto;">
                    <table class="h-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Entity</th>
                                <th>Operation</th>
                                <th>Status</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $tx)
                                <tr style="opacity: 0.7;">
                                    <td style="font-family: 'JetBrains Mono';">#{{ $tx->id }}</td>
                                    <td>{{ $tx->user->name }}</td>
                                    <td><span
                                            style="color: {{ $tx->type == 'buy' ? '#10B981' : '#EF4444' }}; font-weight: 800;">{{ strtoupper($tx->type) }}</span>
                                    </td>
                                    <td>
                                        <span class="status-pill"
                                            style="background: {{ $tx->status == 'completed' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(239, 68, 68, 0.1)' }}; color: {{ $tx->status == 'completed' ? '#10B981' : '#EF4444' }};">
                                            {{ strtoupper($tx->status) }}
                                        </span>
                                    </td>
                                    <td style="font-family: 'JetBrains Mono'; font-size: 0.8rem;">
                                        {{ $tx->created_at->format('M d, H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="margin-top: 2rem;">
                        {{ $history->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .grid-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .stat-card {
            padding: 1.5rem 2rem;
            margin: 0;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.05);
        }

        .p2p-layout {
            display: flex;
            gap: 2.5rem;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .h-label {
            display: block;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 1px;
            color: #94A3B8;
            margin-bottom: 0.75rem;
        }

        .h-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .h-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--h-border);
            border-radius: 12px;
            padding: 12px 16px;
            color: white;
            font-family: 'JetBrains Mono';
            transition: 0.3s;
        }

        .h-input:focus {
            outline: none;
            border-color: var(--h-primary);
            background: rgba(0, 0, 0, 0.4);
        }

        .h-addon {
            position: absolute;
            right: 12px;
            font-size: 0.7rem;
            font-weight: 900;
            color: #64748B;
            pointer-events: none;
        }

        .btn-primary-h {
            width: 100%;
            padding: 1rem;
            background: var(--h-primary);
            border: none;
            border-radius: 16px;
            color: white;
            font-weight: 800;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary-h:hover {
            filter: brightness(1.1);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.65rem;
            font-weight: 900;
            letter-spacing: 0.5px;
        }

        .h-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .h-table tr {
            background: rgba(255, 255, 255, 0.02);
            transition: 0.3s;
        }

        .h-table tr:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        .h-table td,
        .h-table th {
            padding: 1.25rem 1rem;
        }

        .h-table th {
            font-size: 0.7rem;
            color: #94A3B8;
            font-weight: 800;
            text-transform: uppercase;
        }

        .h-table td:first-child {
            border-radius: 12px 0 0 12px;
        }

        .h-table td:last-child {
            border-radius: 0 12px 12px 0;
        }

        .action-btn {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .action-btn:hover {
            transform: scale(1.1);
            filter: brightness(1.1);
        }

        .h-reveal {
            opacity: 0;
            transform: translateY(20px);
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
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