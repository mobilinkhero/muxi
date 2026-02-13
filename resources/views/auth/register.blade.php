<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration - GSM Trading Lab</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .auth-card {
            background: var(--dark-light);
            padding: 2.5rem;
            border-radius: var(--radius-lg);
            width: 100%;
            max-width: 450px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-xl);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--gray-light);
            font-size: 0.9rem;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem;
            background: var(--dark);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-md);
            color: var(--white);
            font-family: inherit;
            transition: var(--transition-base);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        }

        .auth-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--gray);
        }

        .auth-footer a {
            color: var(--primary-light);
            text-decoration: none;
        }

        .error-msg {
            color: #ef4444;
            display: block;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>

    <div class="auth-card">
        <div class="auth-header">
            <a href="/" class="logo" style="justify-content: center; margin-bottom: 1rem;">
                <img src="https://i.ibb.co/3ykG88h/gsm-logo.png" alt="Logo" class="logo-animation"
                    style="height: 60px;">
            </a>
            <h2>Student Registration</h2>
            <p>Join the community and start learning</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-input" required value="{{ old('name') }}">
                @error('name')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" required value="{{ old('email') }}">
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number (Will be your Username)</label>
                <input type="text" name="phone" class="form-input" required value="{{ old('phone') }}"
                    placeholder="+923XXXXXXXXX">
                @error('phone')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">WhatsApp Number</label>
                <input type="text" name="whatsapp" class="form-input" required value="{{ old('whatsapp') }}"
                    placeholder="+923XXXXXXXXX">
                @error('whatsapp')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required>
                @error('password')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-input" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                Create Account
            </button>
        </form>

        <div class="auth-footer">
            Already have an account? <a href="{{ route('login') }}">Log in here</a>
        </div>
    </div>

</body>

</html>