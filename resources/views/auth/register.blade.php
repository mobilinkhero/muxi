<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Lab - GSM Trading Lab</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: #020617;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated Background Orbs */
        .orb {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
            opacity: 0.15;
            animation: orb-move 20s infinite alternate;
        }

        .orb-1 {
            background: #8B5CF6;
            top: -10%;
            left: -10%;
        }

        .orb-2 {
            background: #10B981;
            bottom: -10%;
            right: -10%;
            animation-delay: -5s;
        }

        @keyframes orb-move {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(50px, 50px);
            }
        }

        .auth-card {
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            padding: 3rem;
            border-radius: 30px;
            width: 100%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: card-entrance 0.8s cubic-bezier(0.2, 1, 0.3, 1);
        }

        @keyframes card-entrance {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-header h2 {
            font-size: 2rem;
            font-weight: 900;
            color: white;
            letter-spacing: -1px;
            margin-bottom: 0.5rem;
        }

        .auth-header p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--gray-light);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 1rem;
            transition: 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            color: white;
            font-family: inherit;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(0, 0, 0, 0.3);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        }

        .form-input:focus+i {
            color: var(--primary-light);
        }

        .btn-register {
            width: 100%;
            padding: 1.1rem;
            background: var(--gradient-primary);
            border: none;
            border-radius: 14px;
            color: white;
            font-weight: 800;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.4s ease;
            margin-top: 1.5rem;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.4);
            filter: brightness(1.1);
        }

        .error-msg {
            color: #ef4444;
            display: block;
            font-size: 0.75rem;
            margin-top: 0.4rem;
            font-weight: 500;
            padding-left: 0.5rem;
        }

        .auth-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        .auth-footer a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 700;
        }

        .validation-hint {
            font-size: 0.7rem;
            color: var(--primary-light);
            margin-top: 0.25rem;
            display: block;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="auth-card">
        <div class="auth-header">
            <a href="/" class="logo" style="justify-content: center; margin-bottom: 2rem; display: flex;">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" style="height: 45px;">
            </a>
            <h2>Join the Lab</h2>
            <p>Access premium signals and training</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group reveal-slide">
                <label class="form-label">Full Name</label>
                <div class="input-wrapper">
                    <input type="text" name="name" class="form-input" required value="{{ old('name') }}"
                        placeholder="Enter full name">
                    <i class="fas fa-user-tag"></i>
                </div>
                @error('name') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group reveal-slide">
                <label class="form-label">Gmail Address</label>
                <div class="input-wrapper">
                    <input type="email" name="email" class="form-input" required value="{{ old('email') }}"
                        placeholder="yourname@gmail.com" pattern="[a-zA-Z0-9._%+-]+@gmail\.com$"
                        title="Only @gmail.com addresses are allowed">
                    <i class="fas fa-envelope"></i>
                </div>
                <span class="validation-hint">Note: Only @gmail.com is allowed.</span>
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group reveal-slide">
                <label class="form-label">Phone Number</label>
                <div class="input-wrapper">
                    <input type="text" name="phone" class="form-input" required value="{{ old('phone') }}"
                        placeholder="+923XXXXXXXXX" pattern="^\+923\d{9}$"
                        title="Must be in format +923xxxxxxxxx (13 chars)">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <span class="validation-hint">Format: +923 followed by 9 digits.</span>
                @error('phone') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group reveal-slide">
                <label class="form-label">WhatsApp Number</label>
                <div class="input-wrapper">
                    <input type="text" name="whatsapp" class="form-input" required value="{{ old('whatsapp') }}"
                        placeholder="+923XXXXXXXXX" pattern="^\+923\d{9}$">
                    <i class="fab fa-whatsapp"></i>
                </div>
                @error('whatsapp') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group reveal-slide">
                <label class="form-label">Secure Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password" class="form-input" required placeholder="••••••••">
                    <i class="fas fa-lock"></i>
                </div>
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group reveal-slide">
                <label class="form-label">Confirm Password</label>
                <div class="input-wrapper">
                    <input type="password" name="password_confirmation" class="form-input" required
                        placeholder="••••••••">
                    <i class="fas fa-shield-alt"></i>
                </div>
            </div>

            <button type="submit" class="btn-register">
                Initialize Access <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <div class="auth-footer">
            Already a member? <a href="{{ route('login') }}">Access Terminal</a>
        </div>
    </div>

    @include('partials.animations')
</body>

</html>