@extends('layouts.admin')

@section('title', 'Admin Profile')
@section('header', 'My Profile Settings')

@section('content')
    <div class="card" style="max-width: 600px;">
        <h3 style="color: var(--white); margin-bottom: 0.5rem;">Edit Profile</h3>
        <p style="color: var(--gray); margin-bottom: 2rem; font-size: 0.9rem;">
            Update your personal details and password.
        </p>

        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" value="{{ old('name', auth()->user()->name) }}" required>
                @error('name')
                    <div style="color: #ef4444; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" value="{{ old('email', auth()->user()->email) }}"
                    required>
                @error('email')
                    <div style="color: #ef4444; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="border-top: 1px solid rgba(255,255,255,0.1); margin: 2rem 0; padding-top: 2rem;">
                <h4 style="color: var(--white); margin-bottom: 1rem;">Change Password</h4>

                <!-- New Password -->
                <div class="form-group">
                    <label class="form-label">New Password (Optional)</label>
                    <input type="password" name="password" class="form-input" placeholder="Leave empty to keep current">
                    @error('password')
                        <div style="color: #ef4444; font-size: 0.85rem; margin-top: 5px;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-input"
                        placeholder="Repeat new password">
                </div>
            </div>

            <div style="text-align: right;">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
@endsection