<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - GSM Trading Lab</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.4);
            --secondary: #06b6d4;
            --bg-dark: #020617;
            --font-main: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: #f8fafc;
            font-family: var(--font-main);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
            background-image:
                radial-gradient(circle at 10% 10%, rgba(99, 102, 241, 0.15) 0%, transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(6, 182, 212, 0.1) 0%, transparent 40%);
        }

        /* 3D Floating Orbs */
        .orb {
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.2;
            z-index: -1;
            animation: orbFloat 15s infinite alternate ease-in-out;
        }

        .orb-1 {
            background: var(--primary);
            top: -200px;
            right: -100px;
        }

        .orb-2 {
            background: var(--secondary);
            bottom: -200px;
            left: -100px;
            animation-delay: -5s;
        }

        @keyframes orbFloat {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            100% {
                transform: translate(100px, 50px) rotate(30deg);
            }
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 4rem;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6);
            transform: translateY(30px);
            opacity: 0;
            position: relative;
            overflow: hidden;
        }

        .login-card:hover {
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 50px 120px rgba(99, 102, 241, 0.15);
        }

        /* Scanline Animation */
        .scanline {
            width: 100%;
            height: 100px;
            background: linear-gradient(to bottom, transparent, rgba(99, 102, 241, 0.05), transparent);
            position: absolute;
            top: -100px;
            left: 0;
            animation: pulse-scan 4s linear infinite;
            pointer-events: none;
        }

        @keyframes pulse-scan {
            0% {
                top: -100px;
            }

            100% {
                top: 100%;
            }
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .header h1 {
            font-size: 2.2rem;
            font-weight: 900;
            margin: 0;
            letter-spacing: -1px;
            background: linear-gradient(to bottom, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header p {
            color: #64748B;
            font-size: 0.95rem;
            margin-top: 0.5rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.8rem;
            opacity: 0;
            transform: translateY(20px);
        }

        .label {
            display: block;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #64748B;
            margin-bottom: 0.8rem;
        }

        .input-box {
            position: relative;
        }

        .input-box i {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            transition: 0.3s;
        }

        .h-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 18px;
            padding: 1.1rem 1.25rem 1.1rem 3.5rem;
            color: white;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.4s;
        }

        .h-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 0 25px rgba(99, 102, 241, 0.15);
        }

        .h-input:focus+i {
            color: var(--primary);
            transform: translateY(-50%) scale(1.1);
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 1.2rem;
            border-radius: 18px;
            font-weight: 900;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-top: 1rem;
            box-shadow: 0 15px 35px var(--primary-glow);
        }

        .btn-login:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 25px 50px var(--primary-glow);
            filter: brightness(1.1);
        }

        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            padding: 1rem;
            border-radius: 16px;
            font-size: 0.85rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
        }

        .footer-link {
            text-align: center;
            margin-top: 2rem;
        }

        .footer-link a {
            color: #64748B;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            transition: 0.3s;
        }

        .footer-link a:hover {
            color: white;
        }
    </style>
</head>

<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="login-card">
        <div class="scanline"></div>

        <div class="header">
            <h1>Admin Access</h1>
            <p>Welcome to your control panel</p>
        </div>

        @if($errors->any())
            <div class="error-box">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="label">Identity Pin</label>
                <div class="input-box">
                    <input type="text" name="email" class="h-input" required placeholder="EMAIL / PHONE"
                        value="{{ old('email') }}">
                    <i class="fas fa-fingerprint"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="label">Access Key</label>
                <div class="input-box">
                    <input type="password" name="password" class="h-input" required placeholder="••••••••••••">
                    <i class="fas fa-key"></i>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-login">
                    Initialize Session
                </button>
            </div>
        </form>

        <div class="footer-link">
            <a href="/"><i class="fas fa-arrow-left"></i> Return to Site</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tl = gsap.timeline();

            tl.to('.login-card', {
                opacity: 1,
                y: 0,
                duration: 1.4,
                ease: "power4.out"
            });

            tl.to('.form-group', {
                opacity: 1,
                y: 0,
                stagger: 0.15,
                duration: 0.8,
                ease: "power2.out"
            }, "-=0.8");
        });
    </script>
</body>

</html>