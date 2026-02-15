@extends('layouts.admin')

@section('title', 'Edit User')
@section('header', 'Edit User')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-input" required value="{{ old('name', $user->name) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" required value="{{ old('email', $user->email) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}">
            </div>

            <div class="form-group">
                <label class="form-label">WhatsApp Number</label>
                <input type="text" name="whatsapp" class="form-input" value="{{ old('whatsapp', $user->whatsapp) }}">
            </div>

            <div
                style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); padding: 1.5rem; border-radius: 8px; margin: 1.5rem 0;">
                <h3 style="color: #10B981; margin-bottom: 1rem; font-size: 1.1rem;">💎 Premium Membership</h3>
                <div class="form-group" style="margin-bottom: 1rem;">
                    <label class="form-check" style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="is_premium" value="1" {{ $user->is_premium ? 'checked' : '' }}
                            style="width: 1.2rem; height: 1.2rem;">
                        <span style="color: var(--white); font-weight: 600;">Enable Premium Access</span>
                    </label>
                </div>

                @if($user->device_token)
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
                        <p style="color: var(--gray-light); font-size: 0.9rem; margin-bottom: 0.5rem;">
                            This user is currently locked to a specific device.
                        </p>
                        <label class="form-check" style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="reset_device_token" value="1" style="width: 1.2rem; height: 1.2rem;">
                            <span style="color: #F59E0B; font-weight: 600;">Reset Device Lock (Allow new device)</span>
                        </label>
                    </div>
                @else
                    <p style="color: var(--gray); font-size: 0.9rem; margin-top: 0.5rem;">No device locked yet.</p>
                @endif
            </div>

            @if($user->id !== auth()->id())
                <div class="form-group" style="margin: 1.5rem 0;">
                    <label class="form-check" style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="is_admin" value="1" {{ $user->is_admin ? 'checked' : '' }}
                            style="width: 1.2rem; height: 1.2rem;">
                        <span style="color: var(--white); font-weight: 600;">Grant Admin Privileges</span>
                    </label>
                </div>
            @endif

            <div
                style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); padding: 1.5rem; border-radius: 8px; margin: 2rem 0;">
                <h3
                    style="color: #3b82f6; margin-bottom: 1rem; font-size: 1.1rem; display: flex; align-items: center; gap: 0.5rem;">
                    🛡️ Security & Activity Tracking
                </h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div>
                        <label class="form-label" style="font-size: 0.8rem; color: var(--gray);">Last Known IP
                            Address</label>
                        <div
                            style="padding: 0.75rem; background: rgba(0,0,0,0.2); border-radius: 4px; color: #10B981; font-family: monospace; font-weight: bold; border: 1px solid rgba(255,255,255,0.05);">
                            {{ $user->last_login_ip ?? 'No IP Recorded' }}
                        </div>
                    </div>
                    <div>
                        <label class="form-label" style="font-size: 0.8rem; color: var(--gray);">GPS Location Data</label>
                        @if($user->latitude && $user->longitude)
                            <a href="https://www.google.com/maps?q={{ $user->latitude }},{{ $user->longitude }}" target="_blank"
                                style="display: flex; align-items: center; justify-content: center; gap: 8px; padding: 0.75rem; background: #3b82f6; color: white; text-decoration: none; border-radius: 4px; font-weight: 600; font-size: 0.85rem; transition: 0.2s;"
                                onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                📍 View on Google Maps
                            </a>
                        @else
                            <div
                                style="padding: 0.75rem; background: rgba(255,255,255,0.05); border-radius: 4px; color: var(--gray); text-align: center; border: 1px dashed rgba(255,255,255,0.1); font-size: 0.85rem;">
                                No Location Data
                            </div>
                        @endif
                    </div>
                </div>
                @if($user->latitude && $user->longitude)
                    <div style="margin-top: 1rem; font-size: 0.75rem; color: var(--gray); text-align: center;">
                        Coordinates: {{ $user->latitude }}, {{ $user->longitude }}
                    </div>
                @endif
            </div>

            <div
                style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); padding: 1.5rem; border-radius: var(--radius-sm); margin: 2rem 0;">
                <h3
                    style="color: #ef4444; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; font-size: 1.1rem;">
                    🔒 Security & Password Control
                </h3>
                <p style="color: var(--gray-light); font-size: 0.9rem; margin-bottom: 1.5rem; line-height: 1.5;">
                    Client passwords are encrypted for maximum security (industry standard). While you cannot "see" the old
                    password,
                    <strong>you have ful control to overwrite it</strong>. Entering a new password here will instantly
                    update their account.
                </p>
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label" style="color: var(--white);">Set New Password</label>
                    <input type="text" name="password" class="form-input" placeholder="Type new password here to change it"
                        style="border-color: rgba(239, 68, 68, 0.5); background: rgba(0,0,0,0.2);">
                    <small style="color: var(--gray); display: block; margin-top: 0.5rem;">Leave this blank if you don't
                        want to change their password.</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Update User Details</button>
        </form>
    </div>
@endsection