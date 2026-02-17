@extends('layouts.admin')

@section('title', 'Configure Entity - Admin')

@section('content')
    <div class="h-reveal" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
        <div>
            <h1 style="font-weight: 900; font-size: 2.5rem; letter-spacing: -1px; margin: 0;">Configure Entity</h1>
            <p style="color: #94A3B8; margin-top: 0.5rem;">Modifying parameters for operator: <span
                    style="color: var(--h-primary); font-family: 'JetBrains Mono';">{{ $user->email }}</span></p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn-primary-h"
            style="background: rgba(255,255,255,0.05); border: 1px solid var(--h-border); color: #94A3B8;">
            <i class="fas fa-arrow-left"></i> User Matrix
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="h-reveal">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem;">
            <!-- Basic Bio-Data -->
            <div class="h-card">
                <h3
                    style="margin-bottom: 2rem; font-size: 1.1rem; display: flex; align-items: center; gap: 10px; color: var(--h-primary);">
                    <i class="fas fa-id-card"></i> Bio-Matrix
                </h3>

                <div class="form-group mb-4">
                    <label class="h-label">Designation Name</label>
                    <input type="text" name="name" class="h-input" required value="{{ old('name', $user->name) }}">
                </div>

                <div class="form-group mb-4">
                    <label class="h-label">Comm Channel (Email)</label>
                    <input type="email" name="email" class="h-input" required value="{{ old('email', $user->email) }}">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group mb-4">
                        <label class="h-label">Phone Frequency</label>
                        <input type="text" name="phone" class="h-input" value="{{ old('phone', $user->phone) }}">
                    </div>
                    <div class="form-group mb-4">
                        <label class="h-label">WhatsApp Stream</label>
                        <input type="text" name="whatsapp" class="h-input" value="{{ old('whatsapp', $user->whatsapp) }}">
                    </div>
                </div>
            </div>

            <!-- Access & Privilege -->
            <div class="h-card">
                <h3
                    style="margin-bottom: 2rem; font-size: 1.1rem; display: flex; align-items: center; gap: 10px; color: var(--h-secondary);">
                    <i class="fas fa-key"></i> Access Protocols
                </h3>

                <div
                    style="background: rgba(16, 185, 129, 0.05); border: 1px solid rgba(16, 185, 129, 0.1); padding: 1.25rem; border-radius: 20px; margin-bottom: 1.5rem;">
                    <label style="display: flex; align-items: flex-start; gap: 1rem; cursor: pointer;">
                        <input type="checkbox" name="is_premium" value="1" {{ $user->is_premium ? 'checked' : '' }}
                            style="width: 1.25rem; height: 1.25rem; margin-top: 0.2rem; cursor: pointer;">
                        <div>
                            <span style="color: var(--h-secondary); font-weight: 800; font-size: 0.95rem;">PREMIUM
                                ACCESS</span>
                            <p style="font-size: 0.75rem; color: #64748B; margin-top: 4px;">Grants unrestricted trajectory
                                to Academy logs and Live signals.</p>
                        </div>
                    </label>
                </div>

                @if($user->id !== auth()->id())
                    <div
                        style="background: rgba(236, 72, 153, 0.05); border: 1px solid rgba(236, 72, 153, 0.1); padding: 1.25rem; border-radius: 20px; margin-bottom: 1.5rem;">
                        <label style="display: flex; align-items: flex-start; gap: 1rem; cursor: pointer;">
                            <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}
                                style="width: 1.25rem; height: 1.25rem; margin-top: 0.2rem; cursor: pointer;">
                            <div>
                                <span style="color: var(--h-accent); font-weight: 800; font-size: 0.95rem;">ADMIN CONTROL</span>
                                <p style="font-size: 0.75rem; color: #64748B; margin-top: 4px;">WARNING: Authorizes full command
                                    over system modules.</p>
                            </div>
                        </label>
                    </div>
                @endif

                <div class="form-group" style="padding-top: 1.5rem; border-top: 1px solid var(--h-border);">
                    <label class="h-label">Passcode Override</label>
                    <input type="password" name="password" class="h-input" placeholder="Initialise new key..."
                        style="border-style: dashed;">
                    <p
                        style="font-size: 0.7rem; color: #64748B; margin-top: 8px; font-family: 'JetBrains Mono'; text-transform: uppercase;">
                        Leave null to maintain current encryption.</p>
                </div>
            </div>

            <!-- Global Parameters (Full Width) -->
            <div class="h-card" style="grid-column: 1 / -1;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem;">
                    <!-- Hardware Security -->
                    <div>
                        <h3
                            style="margin-bottom: 1.5rem; font-size: 1rem; color: #F59E0B; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-microchip"></i> Hardware Nexus
                        </h3>
                        @if($user->browser_fingerprint)
                            <div
                                style="background: rgba(0,0,0,0.2); border: 1px solid var(--h-border); padding: 1.5rem; border-radius: 20px;">
                                <div
                                    style="font-size: 0.7rem; color: #64748B; margin-bottom: 8px; font-family: 'JetBrains Mono'; text-transform: uppercase;">
                                    ACTIVE FINGERPRINT</div>
                                <code
                                    style="color: #F8FAFC; font-family: 'JetBrains Mono'; display: block; word-break: break-all; font-size: 0.75rem; background: rgba(255,255,255,0.05); padding: 5px 10px; border-radius: 4px;">{{ $user->browser_fingerprint }}</code>

                                <label
                                    style="display: flex; align-items: center; gap: 10px; margin-top: 2rem; cursor: pointer;">
                                    <input type="checkbox" name="reset_device_token" value="1"
                                        style="width: 1.25rem; height: 1.25rem; cursor: pointer;">
                                    <span style="font-weight: 800; color: white; font-size: 0.85rem;">DE-AUTHORIZE & RE-LINK
                                        DEVICE</span>
                                </label>
                            </div>
                        @else
                            <div
                                style="padding: 2.5rem; border: 1px dashed var(--h-border); border-radius: 20px; color: #64748B; text-align: center;">
                                <i class="fas fa-fingerprint" style="font-size: 2rem; opacity: 0.2; margin-bottom: 1rem;"></i>
                                <p style="font-size: 0.85rem;">No hardware signature detected in current logs.</p>
                            </div>
                        @endif
                    </div>

                    <!-- Signal Tracking -->
                    <div>
                        <h3
                            style="margin-bottom: 1.5rem; font-size: 1rem; color: var(--h-primary); display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-satellite"></i> Signal Origin
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; background: rgba(0,0,0,0.2); padding: 0.75rem 1.25rem; border-radius: 12px; border: 1px solid var(--h-border);">
                                <span
                                    style="color: #64748B; font-size: 0.75rem; font-family: 'JetBrains Mono'; text-transform: uppercase;">LATEST
                                    IP LOG</span>
                                <span
                                    style="font-family: 'JetBrains Mono'; color: var(--h-secondary); font-weight: 800;">{{ $user->last_login_ip ?? '???.???.???.???' }}</span>
                            </div>

                            @if($user->latitude && $user->longitude)
                                <a href="https://www.google.com/maps?q={{ $user->latitude }},{{ $user->longitude }}"
                                    target="_blank" class="btn-primary-h"
                                    style="justify-content: center; background: rgba(99, 102, 241, 0.1); border-color: var(--h-primary); color: var(--h-primary);">
                                    <i class="fas fa-map-location-dot"></i> Intercept Position on Grid
                                </a>
                            @else
                                <div
                                    style="padding: 2.5rem; border: 1px dashed var(--h-border); border-radius: 20px; color: #64748B; text-align: center;">
                                    <i class="fas fa-location-crosshairs"
                                        style="font-size: 2rem; opacity: 0.2; margin-bottom: 1rem;"></i>
                                    <p style="font-size: 0.85rem;">Origin coordinates missing from flight data.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 3rem; margin-bottom: 5rem; text-align: center;">
            <button type="submit" class="btn-primary-h"
                style="padding: 1rem 4rem; font-size: 1.1rem; box-shadow: 0 0 40px rgba(99, 102, 241, 0.1);">
                <i class="fas fa-save"></i> Execute Protocol Update
            </button>
        </div>
    </form>

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