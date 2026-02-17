@extends('layouts.admin')

@section('title', 'Initialise Entity - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Initialise Entity</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Manual registration of new system operators & students.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> User Matrix
        </a>
    </div>

    <div class="h-card h-reveal" style="max-width: 700px; margin: 0 auto;">
        <h3
            style="color: white; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; font-size: 1.1rem; border-bottom: 1px solid var(--h-border); padding-bottom: 1rem;">
            <i class="fas fa-user-plus" style="color: var(--h-primary);"></i> Registration Protocol
        </h3>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group mb-4">
                    <label class="h-label">Entity Name</label>
                    <input type="text" name="name" class="h-input" placeholder="e.g. John Doe" required
                        value="{{ old('name') }}">
                    @error('name')<div
                        style="color: #EF4444; font-size: 0.75rem; margin-top: 5px; font-family: 'JetBrains Mono';">
                    {{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Comm Channel (Email)</label>
                    <input type="email" name="email" class="h-input" placeholder="entity@domain.com" required
                        value="{{ old('email') }}">
                    @error('email')<div
                        style="color: #EF4444; font-size: 0.75rem; margin-top: 5px; font-family: 'JetBrains Mono';">
                    {{ $message }}</div>@enderror
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="h-label">Access Passcode</label>
                <input type="password" name="password" class="h-input" placeholder="Min 8 characters required" required>
                @error('password')<div
                    style="color: #EF4444; font-size: 0.75rem; margin-top: 5px; font-family: 'JetBrains Mono';">
                {{ $message }}</div>@enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group mb-4">
                    <label class="h-label">Phone Frequency</label>
                    <input type="text" name="phone" class="h-input" placeholder="+923XXXXXXXXX" value="{{ old('phone') }}">
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">WhatsApp Stream</label>
                    <input type="text" name="whatsapp" class="h-input" placeholder="+923XXXXXXXXX"
                        value="{{ old('whatsapp') }}">
                </div>
            </div>

            <div
                style="background: rgba(0,0,0,0.2); border-radius: 20px; padding: 1.5rem; border: 1px solid var(--h-border); margin: 2rem 0;">
                <h4
                    style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; color: #64748B; margin-bottom: 1.25rem;">
                    Permission Matrix</h4>

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <label style="display: flex; align-items: flex-start; gap: 1rem; cursor: pointer;">
                        <input type="checkbox" name="is_premium" value="1"
                            style="width: 1.25rem; height: 1.25rem; margin-top: 0.2rem; cursor: pointer;">
                        <div>
                            <span style="color: var(--h-secondary); font-weight: 800; font-size: 0.95rem;">ENABLE PREMIUM
                                ACCESS</span>
                            <p style="font-size: 0.75rem; color: #64748B; margin-top: 4px; line-height: 1.4;">Entities with
                                premium status are locked to their initial login device.</p>
                        </div>
                    </label>

                    <label style="display: flex; align-items: flex-start; gap: 1rem; cursor: pointer;">
                        <input type="checkbox" name="is_admin" value="1"
                            style="width: 1.25rem; height: 1.25rem; margin-top: 0.2rem; cursor: pointer;">
                        <div>
                            <span style="color: var(--h-accent); font-weight: 800; font-size: 0.95rem;">GRANT CORE
                                PRIVILEGES (ADMIN)</span>
                            <p style="font-size: 0.75rem; color: #64748B; margin-top: 4px; line-height: 1.4;">Admins possess
                                unrestricted access to all command center modules.</p>
                        </div>
                    </label>
                </div>
            </div>

            <div
                style="display: flex; gap: 1rem; margin-top: 3rem; pt-4; border-top: 1px solid var(--h-border); padding-top: 2rem;">
                <button type="submit" class="btn-primary-h" style="flex: 1; justify-content: center;">
                    <i class="fas fa-check-circle"></i> Complete Initialisation
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