@extends('layouts.admin')

@section('title', 'Initialise Protocol - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Initialise Protocol</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Configure new liquidity gateway nodes.</p>
        </div>
        <a href="{{ route('admin.payment-methods.index') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> Protocol Matrix
        </a>
    </div>

    <div class="h-card h-reveal" style="max-width: 700px; margin: 0 auto;">
        <h3
            style="color: white; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem; border-bottom: 1px solid var(--h-border); padding-bottom: 1rem;">
            <i class="fas fa-network-wired" style="color: var(--h-primary);"></i> Gateway Parameters
        </h3>

        <form action="{{ route('admin.payment-methods.store') }}" method="POST">
            @csrf

            <div class="form-group mb-4">
                <label class="h-label">Protocol Designation (e.g., USDT TRC20, Bank Transfer)</label>
                <input type="text" name="name" class="h-input" placeholder="Enter protocol name..." required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group mb-4">
                    <label class="h-label">Account / Wallet Node</label>
                    <input type="text" name="account_number" class="h-input" placeholder="Account # or Address" required>
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Account Holder Identity (Opt)</label>
                    <input type="text" name="account_name" class="h-input" placeholder="Full legal name">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group mb-4">
                    <label class="h-label">Financial Institution (Bank Name)</label>
                    <input type="text" name="bank_name" class="h-input" placeholder="e.g. Chase Bank, Tether">
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Segment / Network Node</label>
                    <input type="text" name="network" class="h-input" placeholder="e.g. TRC20, ERC20, BTC">
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Transmission Instructions (Opt)</label>
                <textarea name="instruction" class="h-input" rows="3"
                    placeholder="Provide clear directives for the user..."></textarea>
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Protocol Icon Matrix (URL)</label>
                <input type="text" name="icon" class="h-input" placeholder="https://example.com/icon.png">
            </div>

            <div
                style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.1); padding: 1.25rem; border-radius: 16px; margin: 2rem 0;">
                <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" checked
                        style="width: 20px; height: 20px; accent-color: var(--h-secondary);">
                    <div>
                        <div style="font-weight: 800; color: var(--h-secondary);">DEPLOY ON LIVE NETWORK</div>
                        <div style="font-size: 0.75rem; color: #94A3B8;">Method will be immediately visible for user
                            transactions.</div>
                    </div>
                </label>
            </div>

            <button type="submit" class="btn-primary-h"
                style="width: 100%; justify-content: center; font-size: 1.1rem; padding: 1rem;">
                <i class="fas fa-check-double"></i> Commit New Protocol
            </button>
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