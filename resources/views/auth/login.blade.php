<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trader Login Panel - GSM Trading Lab</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #0f172a;
            position: relative;
            overflow: hidden;
            font-family: var(--font-primary);
        }

        /* Background Orbs to match Landing Page */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            z-index: 0;
            animation: pulse-soft 8s infinite alternate;
        }

        .orb-1 {
            width: 300px;
            height: 300px;
            background: #8B5CF6;
            top: -50px;
            left: -100px;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: #EC4899;
            bottom: -100px;
            right: -50px;
            animation-delay: 2s;
        }

        @keyframes pulse-soft {
            from { transform: scale(1); opacity: 0.3; }
            to { transform: scale(1.1); opacity: 0.5; }
        }

        .auth-card {
            background: rgba(30, 41, 59, 0.6);
            padding: 3rem;
            border-radius: 24px;
            width: 100%;
            max-width: 440px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(20px);
            position: relative;
            z-index: 10;
            animation: cardEntrance 0.8s cubic-bezier(0.2, 1, 0.3, 1) forwards;
        }

        @keyframes cardEntrance {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-header h2 {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: -1px;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .auth-header p {
            color: var(--gray);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.6rem;
            color: var(--gray-light);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .input-container {
            position: relative;
        }

        .input-container i {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.25rem 1rem 3.5rem;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            color: var(--white);
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: #0f172a;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.2);
        }

        .form-input:focus + i {
            color: var(--primary-light);
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            border-radius: 16px;
            background: var(--gradient-crypto);
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
            filter: brightness(1.1);
        }

        .auth-footer {
            margin-top: 2rem;
            text-align: center;
            color: var(--gray);
            font-size: 0.95rem;
        }

        .auth-footer a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 700;
            margin-left: 0.25rem;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .error-msg {
            color: #ef4444;
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }
    </style>
</head>

<body>
    <!-- Background Elements -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="auth-card">
        <div class="auth-header">
            <a href="/" style="display: inline-block; margin-bottom: 2rem;">
                <img src="{{ asset('images/logo.svg') }}" alt="GSM Trading" style="height: 48px;">
            </a>
            <h2>Trader Login</h2>
            <p>Access your professional trading terminal</p>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Email or Phone Number</label>
                <div class="input-container">
                    <i class="fas fa-user-circle"></i>
                    <input type="text" name="email" class="form-input" required value="{{ old('email') }}"
                        placeholder="email@example.com or +923...">
                </div>
                @error('email')
                    <div class="error-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.6rem;">
                    <label class="form-label" style="margin-bottom: 0;">Password</label>
                    <a href="{{ route('password.request') }}" style="font-size: 0.8rem; color: var(--primary-light); text-decoration: none; font-weight: 600;">Forgot?</a>
                </div>
                <div class="input-container">
                    <i class="fas fa-key"></i>
                    <input type="password" name="password" class="form-input" required placeholder="••••••••">
                </div>
                @error('password')
                    <div class="error-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                Unlock Terminal
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <div class="auth-footer">
            Don't have an account? <a href="{{ route('register') }}">Join Lab</a>
        </div>
    </div>

    @include('partials.animations')
</body>

</html>