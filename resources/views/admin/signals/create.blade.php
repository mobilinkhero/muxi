@extends('layouts.admin')

@section('title', 'Deploy Signal - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Initialise Signal</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Broadcasting new trading opportunities to the network.</p>
        </div>
        <a href="{{ route('admin.signals.index') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> Signal Matrix
        </a>
    </div>

    <div class="h-card h-reveal" style="max-width: 800px; margin: 0 auto;">
        <h3
            style="color: white; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem; border-bottom: 1px solid var(--h-border); padding-bottom: 1rem;">
            <i class="fas fa-broadcast-tower" style="color: var(--h-primary);"></i> Transmission Protocol
        </h3>

        <form action="{{ route('admin.signals.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group mb-4">
                    <label class="h-label">Asset Pair / Symbol</label>
                    <input type="text" name="symbol" class="h-input" placeholder="e.g. BTCUSD or GOLD" required>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Operation Type</label>
                    <select name="type" class="h-input">
                        <option value="BUY">BUY 🟢</option>
                        <option value="SELL">SELL 🔴</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group mb-4">
                    <label class="h-label">Entry Price Node</label>
                    <input type="text" name="entry_price" class="h-input" placeholder="e.g. 96,500" required>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Defense Protocol (Stop Loss)</label>
                    <input type="text" name="stop_loss" class="h-input" placeholder="e.g. 95,000"
                        style="border-color: rgba(239, 68, 68, 0.3);" required>
                </div>
            </div>

            <div
                style="background: rgba(0,0,0,0.2); border-radius: 20px; padding: 1.5rem; border: 1px solid var(--h-border); margin: 1rem 0 2rem 0;">
                <h4
                    style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: var(--h-secondary); margin-bottom: 1.25rem;">
                    Extraction Targets (Take Profit)</h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="h-label">Target 1 🎯</label>
                        <input type="text" name="take_profit_1" class="h-input" placeholder="e.g. 97,000"
                            style="border-color: rgba(16, 185, 129, 0.3);" required>
                    </div>
                    <div class="form-group">
                        <label class="h-label">Target 2 (Opt)</label>
                        <input type="text" name="take_profit_2" class="h-input" placeholder="e.g. 98,500">
                    </div>
                    <div class="form-group">
                        <label class="h-label">Target 3 (Opt)</label>
                        <input type="text" name="take_profit_3" class="h-input" placeholder="e.g. 100,000">
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Tactical Briefing (Notes)</label>
                <textarea name="notes" class="h-input" rows="4" placeholder="Main trend is bullish, entering on pullback..."
                    style="min-height: 100px;"></textarea>
            </div>

            <div
                style="display: flex; gap: 1rem; margin-top: 3rem; pt-4; border-top: 1px solid var(--h-border); padding-top: 2rem;">
                <button type="submit" class="btn-primary-h"
                    style="flex: 1; justify-content: center; font-size: 1.1rem; padding: 1rem;">
                    <i class="fas fa-rocket"></i> Deploy Target Signal
                </button>
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
    </script>
@endsection