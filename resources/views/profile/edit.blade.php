@extends('layouts.dashboard')

@section('title', 'Profile Settings')

@section('content')
    <div style="max-width: 800px; margin: 0 auto;">
        <header style="margin-bottom: 2rem;">
            <h1 style="font-size: 1.8rem; margin-bottom: 0.5rem;">Profile Settings</h1>
            <p style="color: var(--gray);">Apni personal information aur security settings yahan se manage karain.</p>
        </header>

        @if(session('success'))
            <div
                style="background: rgba(16, 185, 129, 0.1); border: 1px solid #10B981; color: #10B981; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div
                style="background: rgba(239, 68, 68, 0.1); border: 1px solid #ef4444; color: #ef4444; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                <ul style="margin: 0; padding-left: 1.2rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="dashboard-card">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Profile Photo -->
                <div
                    style="display: flex; align-items: center; gap: 2rem; margin-bottom: 2.5rem; padding-bottom: 2rem; border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <div style="position: relative; width: 100px; height: 100px;">
                        <img id="avatar-preview"
                            src="{{ $user->avatar_url }}"
                            alt="Avatar"
                            style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 3px solid var(--primary);">
                        <label for="avatar-input"
                            style="position: absolute; bottom: 0; right: 0; background: var(--primary); color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 10px rgba(0,0,0,0.3); transition: 0.2s;"
                            onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            📸
                        </label>
                        <input type="file" id="avatar-input" name="avatar" style="display: none;" accept="image/*"
                            onchange="previewImage(this)">
                    </div>
                    <div>
                        <h3 style="margin-bottom: 0.25rem;">Profile Picture</h3>
                        <p style="color: var(--gray); font-size: 0.85rem;">Square image recommend hai. Max size: 2MB.</p>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="form-group">
                        <label
                            style="display: block; color: var(--gray-light); margin-bottom: 0.5rem; font-size: 0.9rem;">Full
                            Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            style="width: 100%; padding: 0.8rem; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;"
                            required>
                    </div>
                    <div class="form-group">
                        <label
                            style="display: block; color: var(--gray-light); margin-bottom: 0.5rem; font-size: 0.9rem;">Email
                            Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            style="width: 100%; padding: 0.8rem; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;"
                            required>
                    </div>
                    <div class="form-group">
                        <label style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">Phone
                            Number (Locked 🔒)</label>
                        <input type="text" value="{{ $user->phone }}"
                            style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 8px; color: var(--gray); cursor: not-allowed;"
                            readonly>
                        <small style="color: rgba(239, 68, 68, 0.6); font-size: 0.75rem;">Phone number change karne ke liye
                            support se raabta karain.</small>
                    </div>
                    <div class="form-group">
                        <label
                            style="display: block; color: var(--gray); margin-bottom: 0.5rem; font-size: 0.9rem;">WhatsApp
                            Number (Locked 🔒)</label>
                        <input type="text" value="{{ $user->whatsapp }}"
                            style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 8px; color: var(--gray); cursor: not-allowed;"
                            readonly>
                    </div>
                </div>

                <!-- Password Change Section -->
                <div
                    style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05); margin-bottom: 2rem;">
                    <h3
                        style="font-size: 1.1rem; color: #F59E0B; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px;">
                        🔑 Change Password
                    </h3>
                    <p style="color: var(--gray); font-size: 0.85rem; margin-bottom: 1.5rem;">Agar aap password change nahi
                        karna chahte to in fields ko khali chhor dain.</p>

                    <div style="display: grid; grid-template-columns: 1fr; gap: 1.25rem;">
                        <div class="form-group">
                            <label
                                style="display: block; color: var(--gray-light); margin-bottom: 0.5rem; font-size: 0.9rem;">Current
                                Password</label>
                            <input type="password" name="current_password" placeholder="Old password confirm karain"
                                style="width: 100%; padding: 0.8rem; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;">
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                            <div class="form-group">
                                <label
                                    style="display: block; color: var(--gray-light); margin-bottom: 0.5rem; font-size: 0.9rem;">New
                                    Password</label>
                                <input type="password" name="new_password" placeholder="Min 8 characters"
                                    style="width: 100%; padding: 0.8rem; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;">
                            </div>
                            <div class="form-group">
                                <label
                                    style="display: block; color: var(--gray-light); margin-bottom: 0.5rem; font-size: 0.9rem;">Confirm
                                    New Password</label>
                                <input type="password" name="new_password_confirmation" placeholder="Repeat new password"
                                    style="width: 100%; padding: 0.8rem; background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white;">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary"
                    style="width: 100%; padding: 1rem; font-size: 1rem; font-weight: 700;">
                    Update Profile Settings
                </button>
            </form>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('avatar-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection