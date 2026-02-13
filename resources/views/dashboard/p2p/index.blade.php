@extends('layouts.dashboard')

@section('title', 'P2P Trading')

@section('content')
    <div class="container">
        <div style="margin-bottom: 2rem;">
            <h1 style="color: var(--white); font-size: 1.8rem; margin-bottom: 0.5rem;">P2P Exchange</h1>
            <p style="color: var(--gray);">Instant Buy/Sell USDT securely with trusted rates.</p>
        </div>

        <!-- Live Rates Ticker -->
        <div class="dashboard-card"
            style="margin-bottom: 2rem; background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.05)); border: 1px solid rgba(16, 185, 129, 0.2);">
            <div style="display: flex; justify-content: space-around; flex-wrap: wrap; gap: 1rem; text-align: center;">
                <div>
                    <div style="color: var(--gray); font-size: 0.9rem; margin-bottom: 0.25rem;">WE BUY AT</div>
                    <div style="font-size: 1.5rem; font-weight: bold; color: #ef4444;">
                        {{ number_format($pools['USDT']->buy_rate, 2) }} PKR</div>
                </div>
                <div style="width: 1px; background: rgba(255,255,255,0.1);"></div>
                <div>
                    <div style="color: var(--gray); font-size: 0.9rem; margin-bottom: 0.25rem;">WE SELL AT</div>
                    <div style="font-size: 1.5rem; font-weight: bold; color: #10B981;">
                        {{ number_format($pools['USDT']->sell_rate, 2) }} PKR</div>
                </div>
                <div style="width: 1px; background: rgba(255,255,255,0.1);"></div>
                <div>
                    <div style="color: var(--gray); font-size: 0.9rem; margin-bottom: 0.25rem;">AVAILABLE POOL</div>
                    <div style="font-size: 1.5rem; font-weight: bold; color: var(--white);">
                        {{ number_format($pools['USDT']->balance, 2) }} USDT</div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div
                style="padding: 1rem; background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #10b981; border-radius: var(--radius-sm); margin-bottom: 1.5rem;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div
                style="padding: 1rem; background: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #ef4444; border-radius: var(--radius-sm); margin-bottom: 1.5rem;">
                {{ session('error') }}
            </div>
        @endif

        <div class="stats-grid">
            <!-- BUY USDT FORM -->
            <div class="dashboard-card">
                <h3 style="color: #10B981; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span>🛒</span> Buy USDT (Deposit)
                </h3>

                <form action="{{ route('p2p.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="buy">

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label style="display: block; color: var(--gray); margin-bottom: 0.5rem;">Amount to Buy
                            (USDT)</label>
                        <input type="number" step="0.01" name="amount_asset" id="buy_amount" class="form-input"
                            style="width: 100%; padding: 0.75rem; background: var(--dark); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;"
                            required oninput="calculateBuyCost()">
                    </div>

                    <div
                        style="background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="color: var(--gray);">Rate:</span>
                            <span style="color: var(--white);">{{ number_format($pools['USDT']->sell_rate, 2) }}
                                PKR/USDT</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; font-weight: bold; font-size: 1.1rem; border-top: 1px solid rgba(255,255,255,0.1); paddingTop: 0.5rem; margin-top: 0.5rem;">
                            <span style="color: var(--white);">You Pay:</span>
                            <span style="color: #10B981;" id="buy_cost">0.00 PKR</span>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label style="display: block; color: var(--gray); margin-bottom: 0.5rem;">Upload Payment Proof
                            (Screenshot)</label>
                        <input type="file" name="proof_image" class="form-input"
                            style="width: 100%; padding: 0.5rem; background: var(--dark); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;"
                            required accept="image/*">
                        <p style="font-size: 0.8rem; color: var(--gray); margin-top: 0.5rem;">Please transfer the amount to
                            the account shown below first.</p>
                    </div>

                    <div
                        style="margin-bottom: 1.5rem; padding: 1rem; border: 1px dashed rgba(255,255,255,0.2); border-radius: 4px;">
                        <div
                            style="font-size: 0.8rem; color: var(--gray); text-transform: uppercase; margin-bottom: 0.5rem;">
                            Bank Details for Transfer</div>
                        <div style="font-family: monospace; color: var(--accent);">
                            {{ $pools['PKR']->wallet_details ?? 'Ask Support' }}</div>
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; padding: 0.75rem; background: #10B981; border: none; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Submit
                        Buy Request</button>
                </form>
            </div>

            <!-- SELL USDT FORM -->
            <div class="dashboard-card">
                <h3 style="color: #ef4444; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span>💸</span> Sell USDT (Withdraw)
                </h3>

                <form action="{{ route('p2p.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="sell">

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label style="display: block; color: var(--gray); margin-bottom: 0.5rem;">Amount to Sell
                            (USDT)</label>
                        <input type="number" step="0.01" name="amount_asset" id="sell_amount" class="form-input"
                            style="width: 100%; padding: 0.75rem; background: var(--dark); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;"
                            required oninput="calculateSellReturn()">
                    </div>

                    <div
                        style="background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 4px; margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                            <span style="color: var(--gray);">Rate:</span>
                            <span style="color: var(--white);">{{ number_format($pools['USDT']->buy_rate, 2) }}
                                PKR/USDT</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; font-weight: bold; font-size: 1.1rem; border-top: 1px solid rgba(255,255,255,0.1); paddingTop: 0.5rem; margin-top: 0.5rem;">
                            <span style="color: var(--white);">You Receive:</span>
                            <span style="color: #ef4444;" id="sell_return">0.00 PKR</span>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label style="display: block; color: var(--gray); margin-bottom: 0.5rem;">Your Bank/Easypaisa
                            Details</label>
                        <textarea name="user_payment_details" rows="3" class="form-input"
                            style="width: 100%; padding: 0.75rem; background: var(--dark); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;"
                            required placeholder="Bank Name, Account Number, Your Name"></textarea>
                    </div>

                    <div
                        style="margin-bottom: 1.5rem; padding: 1rem; border: 1px dashed rgba(255,255,255,0.2); border-radius: 4px;">
                        <div
                            style="font-size: 0.8rem; color: var(--gray); text-transform: uppercase; margin-bottom: 0.5rem;">
                            Send USDT to this Address</div>
                        <div style="font-family: monospace; color: var(--accent); white-space: break-spaces;">
                            {{ $pools['USDT']->wallet_details }}</div>
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; padding: 0.75rem; background: #ef4444; border: none; color: white; border-radius: 4px; cursor: pointer; font-weight: bold;">Submit
                        Sell Request</button>
                </form>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="dashboard-card" style="margin-top: 2rem;">
            <h3 style="color: var(--white); margin-bottom: 1.5rem;">Recent Transactions</h3>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; color: var(--gray-light);">
                    <thead>
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); text-align: left;">
                            <th style="padding: 1rem;">Type</th>
                            <th style="padding: 1rem;">USDT</th>
                            <th style="padding: 1rem;">Fiat (PKR)</th>
                            <th style="padding: 1rem;">Rate</th>
                            <th style="padding: 1rem;">Status</th>
                            <th style="padding: 1rem;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $tx)
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                <td style="padding: 1rem;">
                                    <span class="badge {{ $tx->type == 'buy' ? 'badge-success' : 'badge-danger' }}"
                                        style="padding: 2px 8px; border-radius: 4px; background: {{ $tx->type == 'buy' ? 'rgba(16, 185, 129, 0.2)' : 'rgba(239, 68, 68, 0.2)' }}; color: {{ $tx->type == 'buy' ? '#10B981' : '#ef4444' }};">
                                        {{ strtoupper($tx->type) }}
                                    </span>
                                </td>
                                <td style="padding: 1rem; color: var(--white);">{{ number_format($tx->amount_asset, 2) }}</td>
                                <td style="padding: 1rem;">{{ number_format($tx->amount_fiat, 2) }}</td>
                                <td style="padding: 1rem;">{{ number_format($tx->rate, 2) }}</td>
                                <td style="padding: 1rem;">
                                    @if($tx->status == 'pending')
                                        <span style="color: #F59E0B;">⏳ Pending</span>
                                    @elseif($tx->status == 'completed')
                                        <span style="color: #10B981;">✅ Completed</span>
                                    @else
                                        <span style="color: #ef4444;">❌ Rejected</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">{{ $tx->created_at->format('M d, H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 2rem; text-align: center;">No transactions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const sellRate = {{ $pools['USDT']->sell_rate }}; // Rate user BUYS at
        const buyRate = {{ $pools['USDT']->buy_rate }};   // Rate user SELLS at

        function calculateBuyCost() {
            const amount = parseFloat(document.getElementById('buy_amount').value) || 0;
            const total = amount * sellRate;
            document.getElementById('buy_cost').innerText = new Intl.NumberFormat('en-PK', { style: 'currency', currency: 'PKR' }).format(total);
        }

        function calculateSellReturn() {
            const amount = parseFloat(document.getElementById('sell_amount').value) || 0;
            const total = amount * buyRate;
            document.getElementById('sell_return').innerText = new Intl.NumberFormat('en-PK', { style: 'currency', currency: 'PKR' }).format(total);
        }
    </script>
@endsection