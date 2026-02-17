@extends('layouts.admin')

@section('title', 'Modify Signal - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Modify Signal</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Adjusting parameters for transmission: <span
                    style="color: var(--h-primary); font-family: 'JetBrains Mono';">{{ $signal->symbol }}</span></p>
        </div>
        <a href="{{ route('admin.signals.index') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> Signal Matrix
        </a>
    </div>

    <div class="h-card h-reveal" style="max-width: 850px; margin: 0 auto;">
        <h3
            style="color: white; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem; border-bottom: 1px solid var(--h-border); padding-bottom: 1rem;">
            <i class="fas fa-sliders-h" style="color: var(--h-primary);"></i> Configuration Protocol
        </h3>

        <form action="{{ route('admin.signals.update', $signal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group mb-4">
                    <label class="h-label">Asset Pair / Symbol</label>
                    <input type="text" name="symbol" value="{{ old('symbol', $signal->symbol) }}" class="h-input" required>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Operation Type</label>
                    <select name="type" class="h-input">
                        <option value="BUY" {{ $signal->type == 'BUY' ? 'selected' : '' }}>BUY 🟢</option>
                        <option value="SELL" {{ $signal->type == 'SELL' ? 'selected' : '' }}>SELL 🔴</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group mb-4">
                    <label class="h-label">Entry Price Node</label>
                    <input type="text" name="entry_price" value="{{ old('entry_price', $signal->entry_price) }}"
                        class="h-input" required>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Defense Protocol (Stop Loss)</label>
                    <input type="text" name="stop_loss" value="{{ old('stop_loss', $signal->stop_loss) }}" class="h-input"
                        style="border-color: rgba(239, 68, 68, 0.3);" required>
                </div>
            </div>

            <div
                style="background: rgba(0,0,0,0.2); border-radius: 20px; padding: 1.5rem; border: 1px solid var(--h-border); margin: 1rem 0 2rem 0;">
                <h4
                    style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: var(--h-secondary); margin-bottom: 1.25rem;">
                    Extraction Targets & Result Matrix</h4>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label class="h-label">Primary Target 🎯</label>
                        <input type="text" name="take_profit_1" value="{{ old('take_profit_1', $signal->take_profit_1) }}"
                            class="h-input" style="border-color: rgba(16, 185, 129, 0.3);" required>
                    </div>
                    <div class="form-group">
                        <label class="h-label">Secondary Target</label>
                        <input type="text" name="take_profit_2" value="{{ old('take_profit_2', $signal->take_profit_2) }}"
                            class="h-input">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="h-label">Signal Lifecycle</label>
                        <select name="status" class="h-input">
                            <option value="active" {{ $signal->status == 'active' ? 'selected' : '' }}>Active 🟢</option>
                            <option value="closed" {{ $signal->status == 'closed' ? 'selected' : '' }}>Closed 🏁</option>
                            <option value="cancelled" {{ $signal->status == 'cancelled' ? 'selected' : '' }}>Cancelled 🚫
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="h-label">Final Outcome</label>
                        <select name="result" class="h-input">
                            <option value="" {{ $signal->result == '' ? 'selected' : '' }}>Running / Initializing</option>
                            <option value="profit" {{ $signal->result == 'profit' ? 'selected' : '' }}>Profit 💰</option>
                            <option value="loss" {{ $signal->result == 'loss' ? 'selected' : '' }}>Loss 🔻</option>
                            <option value="breakeven" {{ $signal->result == 'breakeven' ? 'selected' : '' }}>Break Even ⚖️
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Tactical Briefing (Notes)</label>
                <textarea name="notes" class="h-input" rows="4"
                    style="min-height: 100px;">{{ old('notes', $signal->notes) }}</textarea>
            </div>

            <div
                style="display: flex; gap: 1rem; margin-top: 3rem; pt-4; border-top: 1px solid var(--h-border); padding-top: 2rem;">
                <button type="submit" class="btn-primary-h"
                    style="flex: 2; justify-content: center; font-size: 1.1rem; padding: 1rem;">
                    <i class="fas fa-sync-alt"></i> Execute Configuration Update
                </button>
                <button type="button"
                    onclick="if(confirm('Execute Purge Sequence for this signal?')) document.getElementById('delete-form').submit();"
                    class="btn-primary-h"
                    style="flex: 1; justify-content: center; background: rgba(239, 68, 68, 0.1); color: #EF4444; border-color: rgba(239, 68, 68, 0.2);">
                    <i class="fas fa-trash-alt"></i> Purge
                </button>
            </div>
        </form>

        <form id="delete-form" action="{{ route('admin.signals.destroy', $signal->id) }}" method="POST"
            style="display: none;">
            @csrf
            @method('DELETE')
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