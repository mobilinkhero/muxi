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
                <label class="form-label">EmailAddress</label>
                <input type="email" name="email" class="form-input" required value="{{ old('email', $user->email) }}">
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