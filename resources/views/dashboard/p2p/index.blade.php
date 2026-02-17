@extends('layouts.dashboard')

@section('title', 'P2P Exchange Terminal')

@section('content')
    <div class="h-reveal"
        style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h1
                style="font-family: 'Space Grotesk', sans-serif; font-weight: 800; font-size: 2.5rem; color: white; margin: 0;">
                EXCHANGE <span style="color: var(--primary);">NEXUS</span>
            </h1>
            <p style="color: var(--text-dim); margin-top: 0.5rem; font-family: 'Outfit', sans-serif;">Enterprise-grade
                liquidity bridging terminal.</p>
        </div>

        <!-- Mode Switcher -->
        <div
            style="background: rgba(255,255,255,0.03); padding: 6px; border-radius: 14px; display: flex; gap: 4px; border: 1px solid rgba(255,255,255,0.05);">
            <button onclick="switchMode('buy')" id="buy-btn" class="mode-btn active"
                style="padding: 12px 30px; border-radius: 10px; border: none; font-weight: 800; cursor: pointer; transition: 0.3s; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-shopping-cart"></i> BUY USDT
            </button>
            <button onclick="switchMode('sell')" id="sell-btn" class="mode-btn"
                style="padding: 12px 30px; border-radius: 10px; border: none; font-weight: 800; cursor: pointer; transition: 0.3s; color: var(--text-dim); background: transparent; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-hand-holding-usd"></i> SELL USDT
            </button>
        </div>
    </div>

    <div id="buy-terminal" class="mode-terminal h-reveal">
        <div style="display: grid; grid-template-columns: 1fr 400px; gap: 2.5rem; align-items: start;">
            <!-- Buy Steps & Details -->
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                <!-- Step 1: Rates -->
                <div class="dashboard-card"
                    style="margin:0; border-left: 5px solid var(--primary); background: rgba(0, 192, 118, 0.02);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <span
                                style="font-size: 0.7rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 2px;">Market
                                Rate (Selling)</span>
                            <div
                                style="font-size: 2.2rem; font-weight: 900; color: white; margin-top: 5px; font-family: 'Space Grotesk';">
                                {{ number_format($pools['USDT']->sell_rate, 2) }} <span
                                    style="font-size: 0.9rem; color: var(--text-dim);">PKR/USDT</span>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <span
                                style="font-size: 0.7rem; font-weight: 800; color: var(--text-dim); text-transform: uppercase;">Available
                                Liquidity</span>
                            <div style="font-size: 1.5rem; font-weight: 800; color: white; margin-top: 5px;">
                                {{ number_format($pools['USDT']->balance, 2) }} USDT</div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Bank Details -->
                <div class="dashboard-card" style="margin:0; padding: 2.5rem;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 2rem;">
                        <div
                            style="width: 35px; height: 35px; border-radius: 50%; background: var(--primary); color: black; display: flex; align-items: center; justify-content: center; font-weight: 900;">
                            1</div>
                        <h3 style="margin: 0; font-family: 'Space Grotesk'; font-weight: 800; color: white;">TRANSFER FUNDS
                            TO BANK</h3>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        @php
                            $rawDetails = $pools['PKR']->wallet_details ?? '';
                            // Robust parsing: split by newlines, then by first colon
                            $lines = preg_split('/\r\n|\r|\n/', $rawDetails);
                            $detailsArr = [];
                            foreach ($lines as $line) {
                                if (str_contains($line, ':')) {
                                    $parts = explode(':', $line, 2);
                                    $detailsArr[trim($parts[0])] = trim($parts[1]);
                                }
                            }
                        @endphp

                        @forelse($detailsArr as $label => $value)
                            <div style="background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); position: relative;">
                                <label style="font-size: 0.65rem; color: var(--text-dim); font-weight: 800; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 8px;">{{ $label }}</label>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-family: 'JetBrains Mono'; font-weight: 700; color: white; font-size: 1.1rem; word-break: break-all;">{{ $value }}</span>
                                    <button onclick="copyText('{{ $value }}', this)" 
                                            style="background: rgba(0, 192, 118, 0.1); border: none; padding: 8px; border-radius: 6px; cursor: pointer; color: var(--primary); transition: 0.3s;" title="Copy">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <!-- Fallback if parsing fails but there's raw text -->
                            @if($rawDetails)
                                <div style="grid-column: span 2; background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: 12px; border: 1px dashed rgba(255,255,255,0.1);">
                                    <div style="color: var(--text-dim); font-size: 0.7rem; margin-bottom: 10px; text-transform: uppercase;">Payment Destination Data</div>
                                    <div style="color: white; font-family: 'JetBrains Mono'; white-space: pre-wrap; font-size: 1rem; line-height: 1.6;">{{ $rawDetails }}</div>
                                    <button onclick="copyText('{{ addslashes($rawDetails) }}', this)" 
                                            style="margin-top: 15px; width: 100%; padding: 10px; background: rgba(0, 192, 118, 0.1); border: 1px solid var(--primary); color: var(--primary); border-radius: 8px; cursor: pointer; font-weight: 800;">
                                        COPY ALL DATA
                                    </button>
                                </div>
                            @else
                                <div style="grid-column: span 2; padding: 2rem; text-align: center; color: var(--text-dim); font-style: italic;">
                                    No transaction endpoints configured by admin.
                                </div>
                            @endif
                        @endforelse
                    </div>
                </div>

                <!-- Step 3: History -->
                <div class="dashboard-card" style="margin:0; padding: 2rem;">
                    <h3 style="font-family: 'Space Grotesk'; font-weight: 800; margin-bottom: 1.5rem; font-size: 1.1rem;">
                        RECENT DEPOSITS</h3>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: separate; border-spacing: 0 8px;">
                            @foreach($transactions->where('type', 'buy')->take(5) as $tx)
                                <tr style="background: rgba(255,255,255,0.02);">
                                    <td style="padding: 12px 20px; border-radius: 8px 0 0 8px; font-weight: 800;">
                                        {{ number_format($tx->amount_asset, 2) }} USDT</td>
                                    <td style="padding: 12px 20px; color: var(--text-dim);">
                                        {{ $tx->created_at->diffForHumans() }}</td>
                                    <td style="padding: 12px 20px; border-radius: 0 8px 8px 0; text-align: right;">
                                        <span
                                            style="color: {{ $tx->status == 'completed' ? 'var(--primary)' : ($tx->status == 'pending' ? '#F59E0B' : 'var(--accent)') }}; font-weight: 800; font-size: 0.75rem;">
                                            {{ strtoupper($tx->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <!-- Buy Form -->
            <div class="dashboard-card"
                style="margin: 0; position: sticky; top: 20px; padding: 2.5rem; border: 1px solid rgba(0, 192, 118, 0.2); background: rgba(0, 192, 118, 0.02);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 2rem;">
                    <div
                        style="width: 35px; height: 35px; border-radius: 50%; background: var(--primary); color: black; display: flex; align-items: center; justify-content: center; font-weight: 900;">
                        2</div>
                    <h3 style="margin: 0; font-family: 'Space Grotesk'; font-weight: 800; color: white;">CONFIRM DEPOSIT
                    </h3>
                </div>

                <form action="{{ route('p2p.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="buy">

                    <div class="form-group mb-4">
                        <label class="h-label">Amount (USDT)</label>
                        <input type="number" step="0.01" name="amount_asset" id="buy_amount" class="form-input"
                            style="width: 100%; height: 55px; font-size: 1.3rem; font-weight: 800; padding: 0 1.2rem; background: rgba(0,0,0,0.4);"
                            required oninput="calculateBuyCost()">
                    </div>

                    <div
                        style="background: rgba(255,255,255,0.05); padding: 1.2rem; border-radius: 10px; margin-bottom: 2rem;">
                        <div style="display: flex; justify-content: space-between; font-weight: 800; font-size: 1.1rem;">
                            <span style="color: white;">PAYMENT DUE</span>
                            <span style="color: var(--primary);" id="buy_cost">0.00 PKR</span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="h-label">Proof of Payment</label>
                        <input type="file" name="proof_image" class="form-input"
                            style="width: 100%; background: rgba(0,0,0,0.2);" required>
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; height: 55px; background: var(--primary); border: none; font-weight: 900; font-size: 1rem; border-radius: 12px; box-shadow: 0 10px 20px var(--primary-glow);">
                        INITIATE VALIDATION
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="sell-terminal" class="mode-terminal h-reveal" style="display: none;">
        <div style="display: grid; grid-template-columns: 400px 1fr; gap: 2.5rem; align-items: start;">
            <!-- Sell Form -->
            <div class="dashboard-card"
                style="margin: 0; position: sticky; top: 20px; padding: 2.5rem; border: 1px solid rgba(255, 59, 48, 0.2); background: rgba(255, 59, 48, 0.02);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 2rem;">
                    <div
                        style="width: 35px; height: 35px; border-radius: 50%; background: var(--accent); color: white; display: flex; align-items: center; justify-content: center; font-weight: 900;">
                        1</div>
                    <h3 style="margin: 0; font-family: 'Space Grotesk'; font-weight: 800; color: white;">SELL ORDER</h3>
                </div>

                <form action="{{ route('p2p.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="sell">

                    <div class="form-group mb-4">
                        <label class="h-label">Amount to Sell (USDT)</label>
                        <input type="number" step="0.01" name="amount_asset" id="sell_amount" class="form-input"
                            style="width: 100%; height: 55px; font-size: 1.3rem; font-weight: 800; padding: 0 1.2rem; background: rgba(0,0,0,0.4);"
                            required oninput="calculateSellReturn()">
                    </div>

                    <div
                        style="background: rgba(255,255,255,0.05); padding: 1.2rem; border-radius: 10px; margin-bottom: 2rem;">
                        <div style="display: flex; justify-content: space-between; font-weight: 800; font-size: 1.1rem;">
                            <span style="color: white;">YOU RECEIVE</span>
                            <span style="color: var(--accent);" id="sell_return">0.00 PKR</span>
                        </div>
                    </div>

                <div class="form-group mb-4">
                    <label class="h-label">Your Withdrawal Destination</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; background: rgba(0,0,0,0.2); padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                        <div class="form-sub-group">
                            <label style="font-size: 0.6rem; color: var(--text-dim); text-transform: uppercase; margin-bottom: 5px; display: block;">Bank Name</label>
                            <input type="text" name="bank_name" class="form-input" style="width: 100%; height: 40px; font-size: 0.9rem; padding: 0 10px; background: rgba(255,255,255,0.03);" required placeholder="e.g. UBL">
                        </div>
                        <div class="form-sub-group">
                            <label style="font-size: 0.6rem; color: var(--text-dim); text-transform: uppercase; margin-bottom: 5px; display: block;">Account Title</label>
                            <input type="text" name="account_title" class="form-input" style="width: 100%; height: 40px; font-size: 0.9rem; padding: 0 10px; background: rgba(255,255,255,0.03);" required placeholder="e.g. GSM Trading Lab">
                        </div>
                        <div class="form-sub-group">
                            <label style="font-size: 0.6rem; color: var(--text-dim); text-transform: uppercase; margin-bottom: 5px; display: block;">Account Number</label>
                            <input type="text" name="account_no" class="form-input" style="width: 100%; height: 40px; font-size: 0.9rem; padding: 0 10px; background: rgba(255,255,255,0.03);" required placeholder="0000...">
                        </div>
                        <div class="form-sub-group">
                            <label style="font-size: 0.6rem; color: var(--text-dim); text-transform: uppercase; margin-bottom: 5px; display: block;">IBAN (Optional)</label>
                            <input type="text" name="iban" class="form-input" style="width: 100%; height: 40px; font-size: 0.9rem; padding: 0 10px; background: rgba(255,255,255,0.03);" placeholder="PK...">
                        </div>
                    </div>
                </div>

                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; height: 55px; background: var(--accent); border: none; font-weight: 900; font-size: 1rem; border-radius: 12px; box-shadow: 0 10px 20px rgba(255, 59, 48, 0.2);">
                        EXECUTE WITHDRAWAL
                    </button>
                </form>
            </div>

            <!-- Sell Steps & Details -->
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                <!-- Step 1: Rates -->
                <div class="dashboard-card"
                    style="margin:0; border-left: 5px solid var(--accent); background: rgba(255, 59, 48, 0.02);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <span
                                style="font-size: 0.7rem; font-weight: 800; color: var(--accent); text-transform: uppercase; letter-spacing: 2px;">Market
                                Rate (Buying)</span>
                            <div
                                style="font-size: 2.2rem; font-weight: 900; color: white; margin-top: 5px; font-family: 'Space Grotesk';">
                                {{ number_format($pools['USDT']->buy_rate, 2) }} <span
                                    style="font-size: 0.9rem; color: var(--text-dim);">PKR/USDT</span>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <i class="fas fa-bolt" style="font-size: 2rem; color: var(--accent); opacity: 0.5;"></i>
                        </div>
                    </div>
                </div>

                <!-- Step 2: USDT Address -->
                <div class="dashboard-card" style="margin:0; padding: 2.5rem;">
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 2rem;">
                        <div
                            style="width: 35px; height: 35px; border-radius: 50%; background: var(--accent); color: white; display: flex; align-items: center; justify-content: center; font-weight: 900;">
                            2</div>
                        <h3 style="margin: 0; font-family: 'Space Grotesk'; font-weight: 800; color: white;">SEND USDT TO
                            OUR RESERVE</h3>
                    </div>

                    <div
                        style="background: rgba(255, 59, 48, 0.03); border: 2px dashed rgba(255, 59, 48, 0.2); border-radius: 15px; padding: 2.5rem; text-align: center;">
                        <div
                            style="color: var(--accent); font-weight: 900; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1rem;">
                            Official Deposit Node</div>
                        <div
                            style="background: rgba(0,0,0,0.5); padding: 1.5rem; border-radius: 10px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 15px; justify-content: center;">
                            <span
                                style="font-family: 'JetBrains Mono'; color: white; font-weight: 800; font-size: 1.2rem; word-break: break-all;">{{ $pools['USDT']->wallet_details }}</span>
                            <button onclick="copyText('{{ $pools['USDT']->wallet_details }}', this)"
                                style="background: var(--accent); border: none; padding: 12px; border-radius: 8px; cursor: pointer; color: white; font-size: 1.1rem;">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                        <p style="color: var(--text-dim); font-size: 0.85rem;">Send <b>ONLY USDT</b> (TRC20 Recommended) to
                            the address above. Your funds will be tracked via blockchain validation.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Card remains at the bottom but more compact -->
    <div class="h-reveal dashboard-card"
        style="margin-top: 2rem; border: 1px solid rgba(255,255,255,0.05); background: rgba(0,0,0,0.2);">
        <h3 style="font-family: 'Space Grotesk'; font-weight: 800; margin-bottom: 1.5rem; color: white; font-size: 1.2rem;">
            TERMINAL LOGS</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 5px;">
                <thead>
                    <tr
                        style="text-align: left; color: var(--text-dim); font-size: 0.7rem; text-transform: uppercase; letter-spacing: 2px;">
                        <th style="padding: 10px 15px;">TX_ID</th>
                        <th style="padding: 10px 15px;">Asset</th>
                        <th style="padding: 10px 15px;">Fiat</th>
                        <th style="padding: 10px 15px;">Status</th>
                        <th style="padding: 10px 15px;">Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions->take(10) as $tx)
                        <tr style="background: rgba(255,255,255,0.01);">
                            <td
                                style="padding: 15px; font-family: 'JetBrains Mono'; font-size: 0.8rem; color: var(--text-dim);">
                                #{{ str_pad($tx->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td
                                style="padding: 15px; font-weight: 800; color: {{ $tx->type == 'buy' ? 'var(--primary)' : 'var(--accent)' }}">
                                {{ number_format($tx->amount_asset, 2) }} USDT</td>
                            <td style="padding: 15px; color: white;">{{ number_format($tx->amount_fiat, 2) }} PKR</td>
                            <td style="padding: 15px;">
                                <span
                                    style="font-weight: 900; font-size: 0.7rem; letter-spacing: 1px; color: {{ $tx->status == 'completed' ? 'var(--primary)' : ($tx->status == 'pending' ? '#F59E0B' : 'var(--accent)') }};">
                                    {{ strtoupper($tx->status) }}
                                </span>
                            </td>
                            <td style="padding: 15px; font-size: 0.8rem; color: var(--text-dim);">
                                {{ $tx->created_at->format('M d, H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .h-label {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--text-dim);
            margin-bottom: 12px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .mode-btn.active {
            background: var(--primary);
            color: black;
            box-shadow: 0 4px 15px var(--primary-glow);
        }

        .mode-btn:not(.active):hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .dashboard-card {
            transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .form-input {
            color: white !important;
        }
    </style>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        const sellRate = {{ $pools['USDT']->sell_rate ?? 0 }};
        const buyRate = {{ $pools['USDT']->buy_rate ?? 0 }};

        function switchMode(mode) {
            const buyTerm = document.getElementById('buy-terminal');
            const sellTerm = document.getElementById('sell-terminal');
            const buyBtn = document.getElementById('buy-btn');
            const sellBtn = document.getElementById('sell-btn');

            if (mode === 'buy') {
                buyTerm.style.display = 'grid';
                sellTerm.style.display = 'none';
                buyBtn.classList.add('active');
                sellBtn.classList.remove('active');
                buyBtn.style.background = 'var(--primary)';
                buyBtn.style.color = 'black';
                sellBtn.style.background = 'transparent';
                sellBtn.style.color = 'var(--text-dim)';
            } else {
                buyTerm.style.display = 'none';
                sellTerm.style.display = 'grid';
                sellBtn.classList.add('active');
                buyBtn.classList.remove('active');
                sellBtn.style.background = 'var(--accent)';
                sellBtn.style.color = 'white';
                buyBtn.style.background = 'transparent';
                buyBtn.style.color = 'var(--text-dim)';
            }

            gsap.from('.mode-terminal', { opacity: 0, y: 30, duration: 0.8, ease: "expo.out" });
        }

        function calculateBuyCost() {
            const val = document.getElementById('buy_amount').value;
            const total = val * sellRate;
            document.getElementById('buy_cost').innerText = new Intl.NumberFormat('en-PK', { style: 'currency', currency: 'PKR' }).format(total);
        }

        function calculateSellReturn() {
            const val = document.getElementById('sell_amount').value;
            const total = val * buyRate;
            document.getElementById('sell_return').innerText = new Intl.NumberFormat('en-PK', { style: 'currency', currency: 'PKR' }).format(total);
        }

        async function copyText(text, btn) {
            try {
                await navigator.clipboard.writeText(text);
                const icon = btn.querySelector('i');
                icon.className = 'fas fa-check';
                const originalBg = btn.style.background;
                btn.style.background = '#10B981';
                setTimeout(() => {
                    icon.className = 'fas fa-copy';
                    btn.style.background = originalBg;
                }, 2000);
            } catch (err) {
                console.error('Failed to copy: ', err);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', { opacity: 1, y: 0, duration: 1.2, stagger: 0.15, ease: "expo.out" });
        });
    </script>
@endpush