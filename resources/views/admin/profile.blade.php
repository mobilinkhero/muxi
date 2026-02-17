@extends('layouts.admin')

@section('title', 'Operator Profile - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Operator Profile</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Managing administrative credentials and security parameters.</p>
        </div>
    </div>

    <div class="h-reveal" style="max-width: 700px; margin: 0 auto;">
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf

            <div class="h-card">
                <h3
                    style="color: white; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem; border-bottom: 1px solid var(--h-border); padding-bottom: 1rem;">
                    <i class="fas fa-user-shield" style="color: var(--h-primary);"></i> Identity Configuration
                </h3>

                <div class="form-group mb-4">
                    <label class="h-label">Full Name / Callsign</label>
                    <input type="text" name="name" class="h-input" value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name')
                        <div style="color: #ef4444; font-size: 0.75rem; margin-top: 5px; font-family: 'JetBrains Mono';">
                            {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Primary Communication Address (Email)</label>
                    <input type="email" name="email" class="h-input" value="{{ old('email', auth()->user()->email) }}"
                        required>
                    @error('email')
                        <div style="color: #ef4444; font-size: 0.75rem; margin-top: 5px; font-family: 'JetBrains Mono';">
                            {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="h-card">
                <h3
                    style="color: white; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem; border-bottom: 1px solid var(--h-border); padding-bottom: 1rem;">
                    <i class="fas fa-key" style="color: var(--h-secondary);"></i> Security Protocol (Password)
                </h3>

                <p style="color: #64748B; font-size: 0.85rem; margin-bottom: 2rem;">
                    Modify access keys. Leave empty to maintain current encryption parameters.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="h-label">New Access Key</label>
                        <input type="password" name="password" class="h-input" placeholder="••••••••">
                        @error('password')
                            <div style="color: #ef4444; font-size: 0.75rem; margin-top: 5px; font-family: 'JetBrains Mono';">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="h-label">Confirm Key</label>
                        <input type="password" name="password_confirmation" class="h-input" placeholder="••••••••">
                    </div>
                </div>
            </div>

            <div style="text-align: right; margin-top: 2rem;">
                <button type="submit" class="btn-primary-h" style="padding: 1rem 3rem;">
                    <i class="fas fa-save"></i> Commit Profile Updates
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