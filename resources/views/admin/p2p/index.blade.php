@extends('layouts.admin')

@section('title', 'Exchange Nexus - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem; gap: 2rem;">
        <div>
            <div style="font-family: var(--font-accent); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 4px; color: var(--primary); margin-bottom: 0.5rem; font-weight: 700;">
                LIQUIDITY ENGINE v2.0
            </div>
            <h1 style="font-weight: 900; font-size: 3rem; letter-spacing: -2px; margin: 0; line-height: 1; font-family: var(--font-accent);">
                P2P <span style="color: var(--text-dim);">Exchange Control</span>
            </h1>
            <p style="color: var(--text-dim); margin-top: 1rem; font-size: 1rem; font-family: var(--font-secondary);">Cross-chain liquidity terminal and order validation nexus.</p>
        </div>
        
        <div style="display: flex; gap: 1.5rem;">
            <div class="h-card" style="margin: 0; padding: 20px 30px; border-radius: 12px; background: rgba(0, 192, 118, 0.05); border: 1px solid rgba(0, 192, 118, 0.2);">
                <div style="font-size: 0.7rem; color: var(--primary); font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 8px;">USDT POOL RESERVE</div>
                <div style="font-weight: 900; font-size: 1.8rem; font-family: var(--font-accent);">
                    {{ number_format($usdtPool->balance, 2) }} <span style="font-size: 0.9rem; color: var(--text-dim);">USDT</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Desk -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 3rem;" class="h-reveal">
        <div class="h-card" style="padding: 1.5rem; margin:0; border-radius: 12px; border-left: 4px solid var(--primary);">
            <div style="color: var(--text-dim); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Buy Volume</div>
            <div style="font-size: 1.8rem; font-weight: 900; color: white; margin-top: 0.5rem; font-family: var(--font-accent);">
                {{ number_format($stats['total_volume_buy'], 2) }} <span style="font-size: 0.8rem; opacity: 0.5;">USDT</span>
            </div>
        </div>
        <div class="h-card" style="padding: 1.5rem; margin:0; border-radius: 12px; border-left: 4px solid var(--accent);">
            <div style="color: var(--text-dim); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Sell Volume</div>
            <div style="font-size: 1.8rem; font-weight: 900; color: white; margin-top: 0.5rem; font-family: var(--font-accent);">
                {{ number_format($stats['total_volume_sell'], 2) }} <span style="font-size: 0.8rem; opacity: 0.5;">USDT</span>
            </div>
        </div>
        <div class="h-card" style="padding: 1.5rem; margin:0; border-radius: 12px; border-left: 4px solid #f59e0b;">
            <div style="color: var(--text-dim); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Live Queue</div>
            <div style="font-size: 1.8rem; font-weight: 900; color: white; margin-top: 0.5rem; font-family: var(--font-accent);">
                {{ $stats['total_pending'] }} <span style="font-size: 0.8rem; opacity: 0.5;">REQ</span>
            </div>
        </div>
        <div class="h-card" style="padding: 1.5rem; margin:0; border-radius: 12px; border-left: 4px solid var(--secondary);">
            <div style="color: var(--text-dim); font-size: 0.7rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Portal Uptime</div>
            <div style="font-size: 1.8rem; font-weight: 900; color: white; margin-top: 0.5rem; font-family: var(--font-accent);">99.9%</div>
        </div>
    </div>

    <div class="p2p-layout h-reveal" style="display: grid; grid-template-columns: 380px 1fr; gap: 2rem; margin-top: 1rem;">
        <!-- Left: Engine Configuration -->
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            <!-- Primary Config -->
            <div class="h-card" style="margin: 0; padding: 2.5rem;">
                <h3 style="font-weight: 900; margin-bottom: 2rem; font-family: var(--font-accent); color: white;">
                    <i class="fas fa-gear" style="color: var(--primary);"></i> Engine Params
                </h3>
                <form action="{{ route('admin.p2p.rates') }}" method="POST">
                    @csrf
                    
                    <div class="form-group mb-4">
                        <label class="h-label" style="display: flex; justify-content: space-between;">
                            <span>Portal Status</span>
                            <span style="color: {{ $usdtPool->is_active ? 'var(--primary)' : 'var(--accent)' }};">{{ $usdtPool->is_active ? 'ONLINE' : 'OFFLINE' }}</span>
                        </label>
                        <select name="is_active" class="h-input" style="appearance: auto;">
                            <option value="1" {{ $usdtPool->is_active ? 'selected' : '' }}>Active (Users can trade)</option>
                            <option value="0" {{ !$usdtPool->is_active ? 'selected' : '' }}>Maintenance (Portal Hidden)</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label class="h-label">Liquidity Injection</label>
                        <div class="h-input-wrapper">
                            <input type="number" step="0.01" name="balance" value="{{ $usdtPool->balance }}" class="h-input" required>
                            <span class="h-addon">USDT</span>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
                        <div class="form-group">
                            <label class="h-label" style="color: var(--primary);">Ask (Sell)</label>
                            <div class="h-input-wrapper">
                                <input type="number" step="0.01" name="sell_rate" value="{{ $usdtPool->sell_rate }}" class="h-input">
                                <span class="h-addon">PKR</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="h-label" style="color: var(--accent);">Bid (Buy)</label>
                            <div class="h-input-wrapper">
                                <input type="number" step="0.01" name="buy_rate" value="{{ $usdtPool->buy_rate }}" class="h-input">
                                <span class="h-addon">PKR</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="h-label">Trading Fee (%)</label>
                        <div class="h-input-wrapper">
                            <input type="number" step="0.01" name="fee" value="0.00" class="h-input" disabled>
                            <span class="h-addon">%</span>
                        </div>
                        <span style="font-size: 0.7rem; color: var(--text-dim);">Fee logic activation pending next patch.</span>
                    </div>

                    <button type="submit" class="btn-primary-h" style="width: 100%; justify-content: center; height: 55px; border-radius: 12px; font-weight: 800;">
                        <i class="fas fa-bolt"></i> SYNCHRONIZE ENGINE
                    </button>
                </form>
            </div>

            <!-- Deposit Endpoints -->
            <div class="h-card" style="margin: 0; padding: 2.5rem;">
                <h3 style="font-weight: 900; margin-bottom: 2rem; font-family: var(--font-accent); color: white;">
                    <i class="fas fa-university" style="color: var(--secondary);"></i> Receiving Endpoints
                </h3>
                <form action="{{ route('admin.p2p.rates') }}" method="POST">
                    @csrf
                    
                    <div style="border-left: 3px solid var(--secondary); padding-left: 1.5rem; margin-bottom: 2.5rem;">
                        <span style="font-size: 0.75rem; color: var(--secondary); font-weight: 800; text-transform: uppercase; letter-spacing: 2px;">Fiat Gateway (PKR)</span>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                            <div class="form-group">
                                <label class="h-label">Bank Name</label>
                                <input type="text" name="bank_name" class="h-input" placeholder="e.g. Meezan Bank" required>
                            </div>
                            <div class="form-group">
                                <label class="h-label">Account Title</label>
                                <input type="text" name="account_title" class="h-input" placeholder="e.g. John Doe" required>
                            </div>
                            <div class="form-group">
                                <label class="h-label">Account Number</label>
                                <input type="text" name="account_no" class="h-input" placeholder="0000 0000 0000" required>
                            </div>
                            <div class="form-group">
                                <label class="h-label">IBAN (Optional)</label>
                                <input type="text" name="iban" class="h-input" placeholder="PK00 MEZN ...">
                            </div>
                        </div>
                    </div>

                    <div style="border-left: 3px solid var(--primary); padding-left: 1.5rem; margin-bottom: 2rem;">
                        <span style="font-size: 0.75rem; color: var(--primary); font-weight: 800; text-transform: uppercase; letter-spacing: 2px;">Crypto Gateway (USDT)</span>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                            <div class="form-group">
                                <label class="h-label">Network</label>
                                <select name="usdt_network" class="h-input" style="appearance: auto;">
                                    <option value="TRC20">Tron (TRC20)</option>
                                    <option value="ERC20">Ethereum (ERC20)</option>
                                    <option value="BEP20">Binance Smart Chain (BEP20)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="h-label">Wallet Address</label>
                                <input type="text" name="usdt_wallet" class="h-input" placeholder="T..." required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary-h" style="width: 100%; justify-content: center; height: 50px; background: rgba(99, 102, 241, 0.1); color: var(--secondary); border: 1px solid rgba(99, 102, 241, 0.2);">
                         <i class="fas fa-save" style="margin-right: 8px;"></i> UPDATE ENDPOINTS
                    </button>
                    <p style="font-size: 0.65rem; color: var(--text-dim); margin-top: 0.8rem; text-align: center;">Note: Individual fields will be concatenated for the user's view.</p>
                </form>
            </div>
        </div>

        <!-- Right: Order Flow -->
        <div style="display: flex; flex-direction: column; gap: 2rem; min-width: 0;">
            <!-- Pending Requests -->
            <div class="h-card">
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
                                            <a href="{{ Storage::url($tx->proof_image) }}" target="_blank" class="btn-primary-h"
                                               style="padding: 0.5rem 1rem; font-size: 0.75rem; background: rgba(99, 102, 241, 0.1); color: var(--secondary);">
                                                <i class="fas fa-file-invoice"></i> VIEW PROOF
                                            </a>
                                        @elseif($tx->type == 'sell')
                                            <div style="display: flex; gap: 5px; align-items: center;">
                                                <button onclick="showDetails(document.getElementById('data-{{ $tx->id }}').innerText.trim())" 
                                                        class="btn-primary-h"
                                                        style="padding: 0.5rem 1rem; font-size: 0.75rem; background: rgba(236, 72, 153, 0.1); color: #ec4899; border: 1px solid rgba(236, 72, 153, 0.2);">
                                                    <i class="fas fa-eye"></i> DATA HUB
                                                </button>
                                                <div style="display: none;" id="data-{{ $tx->id }}">
                                                    {{ $tx->user_payment_details }}
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="display: flex; gap: 8px;">
                                            <form action="{{ route('admin.p2p.process', $tx->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="approve">
                                                <button type="submit" class="btn-primary-h"
                                                    style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(16, 185, 129, 0.2); color: #10B981;"
                                                    onclick="return confirm('APPROVE_SEQUENCE_START?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.p2p.process', $tx->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit" class="btn-primary-h"
                                                    style="padding: 0.5rem; width: 32px; height: 32px; justify-content: center; background: rgba(239, 68, 68, 0.2); color: #EF4444;"
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
            <div class="h-card">
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

        .p2p-layout {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .h-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .h-addon {
            position: absolute;
            right: 12px;
            font-size: 0.7rem;
            font-weight: 900;
            color: #64748B;
            pointer-events: none;
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

        async function adminCopy(text, btn) {
            try {
                await navigator.clipboard.writeText(text);
                const icon = btn.querySelector('i');
                const originalClass = icon.className;
                icon.className = 'fas fa-check';
                btn.style.background = '#10B981';
                setTimeout(() => {
                    icon.className = originalClass;
                    btn.style.background = '';
                }, 2000);
            } catch (err) {
                console.error('Admin Copy Failed:', err);
            }
        }

        function showDetails(details) {
            if(!details) {
                alert("No details provided by user.");
                return;
            }
            const lines = details.split('\n');
            let matchedLines = 0;

            let html = '<div id="p2p-details-overlay" style="background:rgba(15,23,42,0.98); padding:2rem; border-radius:15px; border:1px solid rgba(255,255,255,0.1); width:450px; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); z-index:9999; box-shadow:0 25px 50px rgba(0,0,0,0.8); backdrop-filter:blur(10px);">';
            html += '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">';
            html += '<h4 style="margin:0; color:white; font-weight:900; font-family:var(--font-accent);">WITHDRAWAL RECEIVER</h4>';
            html += '<button onclick="this.closest(\'#p2p-details-overlay\').remove()" style="background:transparent; border:none; color:#EF4444; cursor:pointer; font-size:1.2rem;"><i class="fas fa-times"></i></button>';
            html += '</div>';
            
            let itemsHtml = '';
            lines.forEach(line => {
                if(line.includes(':')) {
                    const parts = line.split(':');
                    const label = parts[0].trim();
                    const value = parts.slice(1).join(':').trim();
                    if(value) {
                        matchedLines++;
                        itemsHtml += `<div style="margin-bottom:0.8rem; background:rgba(255,255,255,0.03); padding:12px 15px; border-radius:10px; display:flex; justify-content:space-between; align-items:center; border:1px solid rgba(255,255,255,0.05);">
                                    <div style="flex:1; overflow:hidden;">
                                        <div style="font-size:0.6rem; color:#94A3B8; text-transform:uppercase; font-weight:800; letter-spacing:1px;">${label}</div>
                                        <div style="color:white; font-weight:700; font-family:JetBrains Mono; font-size:0.95rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="${value}">${value}</div>
                                    </div>
                                    <button onclick="adminCopy('${value.replace(/'/g, "\\'")}', this)" style="background:rgba(255,255,255,0.05); border:none; color:white; width:35px; height:35px; border-radius:8px; cursor:pointer; flex-shrink:0; margin-left:10px; transition:0.3s;">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                 </div>`;
                    }
                }
            });

            if(matchedLines === 0) {
                // Fallback for raw text
                html += `<div style="background:rgba(255,255,255,0.03); padding:1.5rem; border-radius:12px; border:1px dashed rgba(255,255,255,0.1); margin-bottom:1.5rem;">
                            <div style="color:#94A3B8; font-size:0.65rem; margin-bottom:10px; text-transform:uppercase; font-weight:800;">Raw Payment Data</div>
                            <div style="color:white; font-family:JetBrains Mono; white-space:pre-wrap; font-size:0.95rem; line-height:1.6;">${details}</div>
                            <button onclick="adminCopy('${details.replace(/'/g, "\\'").replace(/\n/g, "\\n")}', this)" 
                                    style="margin-top:15px; width:100%; padding:10px; background:rgba(99, 102, 241, 0.1); border:1px solid var(--secondary); color:var(--secondary); border-radius:8px; cursor:pointer; font-weight:800; font-size:0.75rem;">
                                COPY ALL DATA
                            </button>
                         </div>`;
            } else {
                html += itemsHtml;
            }

            html += '<button onclick="this.closest(\'#p2p-details-overlay\').remove()" style="width:100%; margin-top:0.5rem; padding:12px; background:rgba(239,68,68,0.1); color:#EF4444; border:1px solid rgba(239,68,68,0.2); border-radius:8px; font-weight:800; cursor:pointer; transition:0.3s;" onmouseover="this.style.background=\'rgba(239,68,68,0.2)\'" onmouseout="this.style.background=\'rgba(239,68,68,0.1)\'">DISMISS HUB</button>';
            html += '</div>';
            
            const overlayContainer = document.createElement('div');
            overlayContainer.id = 'details-modal-root';
            overlayContainer.innerHTML = html;
            document.body.appendChild(overlayContainer);
        }
    </script>
@endsection