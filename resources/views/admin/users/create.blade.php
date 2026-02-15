@extends('layouts.admin')

@section('title', 'Add New User')
@section('header', 'Add User Manually')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" placeholder="Enter full name" required
                    value="{{ old('name') }}">
                @error('name')<span style="color: #ef4444; font-size: 0.8rem;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" placeholder="user@gmail.com" required
                    value="{{ old('email') }}">
                @error('email')<span style="color: #ef4444; font-size: 0.8rem;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="Minimum 8 characters" required>
                @error('password')<span style="color: #ef4444; font-size: 0.8rem;">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-input" placeholder="+923XXXXXXXXX" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label class="form-label">WhatsApp Number</label>
                <input type="text" name="whatsapp" class="form-input" placeholder="+923XXXXXXXXX"
                    value="{{ old('whatsapp') }}">
            </div>

            <div class="form-group" style="margin: 1.5rem 0;">
                <label class="form-check" style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="is_premium" value="1" style="width: 1.2rem; height: 1.2rem;">
                    <span style="color: #10B981; font-weight: 600;">Enable Premium Access</span>
                </label>
                <p style="font-size: 0.8rem; color: var(--gray); margin-top: 0.25rem;">Premium users will be locked to the
                    first device they log in with.</p>
            </div>

            <div class="form-group" style="margin: 1.5rem 0;">
                <label class="form-check" style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="checkbox" name="is_admin" value="1" style="width: 1.2rem; height: 1.2rem;">
                    <span style="color: var(--white); font-weight: 600;">Grant Admin Privileges</span>
                </label>
                <p style="font-size: 0.8rem; color: var(--gray); margin-top: 0.25rem;">Admins have full access to the
                    control panel.</p>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">Create User Account</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection