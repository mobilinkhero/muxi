<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - GSM Trading Lab</title>
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

        .alert-success {
            padding: 1rem;
            background: rgba(16, 185, 129, 0.2);
            color: #10b981;
            border: 1px solid #10b981;
            border-radius: var(--radius-md);
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .error-msg {
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>

    <div class="auth-card">
        <div class="auth-header">
            <a href="/" class="logo" style="justify-content: center; margin-bottom: 1rem;">
                <img src="https://i.ibb.co/3ykG88h/gsm-logo.png" alt="Logo" style="height: 60px;">
            </a>
            <h2>Forgot Password</h2>
            <p>Enter your email to receive a reset link</p>
        </div>

        @if (session('status'))
            <div class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-input" required value="{{ old('email') }}"
                    placeholder="registered@email.com">
                @error('email')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                Send Password Reset Link
            </button>
        </form>

        <div style="margin-top: 1.5rem; text-align: center; font-size: 0.9rem;">
            <a href="{{ route('login') }}" style="color: var(--gray-light); text-decoration: none;">← Back to Login</a>
        </div>
    </div>

</body>

</html>