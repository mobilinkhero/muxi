@extends('layouts.admin')

@section('title', 'Configure Node - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Configure Node</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Modifying endpoint parameters for partner: <span
                    style="color: var(--h-primary); font-family: 'JetBrains Mono';">{{ $broker->name }}</span></p>
        </div>
        <a href="{{ route('admin.brokers.index') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> Broker Nexus
        </a>
    </div>

    <div class="h-card h-reveal" style="max-width: 650px; margin: 0 auto;">
        <h3
            style="color: white; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem; border-bottom: 1px solid var(--h-border); padding-bottom: 1rem;">
            <i class="fas fa-sliders-h" style="color: var(--h-primary);"></i> Mutation Protocol
        </h3>

        <form action="{{ route('admin.brokers.update', $broker->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-4">
                <label class="h-label">Partner Entity Name</label>
                <input type="text" name="name" class="h-input" required value="{{ old('name', $broker->name) }}">
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Referral Endpoint URL</label>
                <input type="url" name="referral_link" class="h-input" required
                    value="{{ old('referral_link', $broker->referral_link) }}">
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Partner Brand Asset (Logo URL)</label>
                <input type="text" name="logo_path" class="h-input" value="{{ old('logo_path', $broker->logo_path) }}">
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Tactical Briefing / Bonus Data</label>
                <textarea name="description" class="h-input"
                    rows="3">{{ old('description', $broker->description) }}</textarea>
            </div>

            <div
                style="background: rgba(245, 158, 11, 0.05); border: 1px solid rgba(245, 158, 11, 0.1); padding: 1.25rem; border-radius: 16px; margin: 2rem 0;">
                <label style="display: flex; align-items: center; gap: 12px; cursor: pointer;">
                    <input type="checkbox" name="is_recommended" value="1" {{ $broker->is_recommended ? 'checked' : '' }}
                        style="width: 20px; height: 20px; accent-color: #F59E0B;">
                    <div>
                        <div style="font-weight: 800; color: #F59E0B;">SIGNAL PRIORITY NODE</div>
                        <div style="font-size: 0.75rem; color: #94A3B8;">Highlight this partner as a top selection in the
                            user grid.</div>
                    </div>
                </label>
            </div>

            <button type="submit" class="btn-primary-h"
                style="width: 100%; justify-content: center; font-size: 1.1rem; padding: 1rem;">
                <i class="fas fa-save"></i> Synchronise Node
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