<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - GSM PLATINUM</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <style>
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.4);
            --secondary: #06b6d4;
            --bg-dark: #020617;
            --font-main: 'Outfit', sans-serif;
            --font-accent: 'Space Grotesk', sans-serif;
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

        /* 4D Background Orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            opacity: 0.3;
            pointer-events: none;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: var(--primary);
            top: -200px;
            left: -100px;
        }

        .orb-2 {
            width: 450px;
            height: 450px;
            background: var(--secondary);
            bottom: -100px;
            right: -100px;
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 48px;
            padding: 4.5rem;
            box-shadow:
                0 40px 100px rgba(0, 0, 0, 0.6),
                inset 0 0 0 1px rgba(255, 255, 255, 0.05);
            transform: translateY(30px);
            opacity: 0;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .login-card:hover {
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow:
                0 50px 120px rgba(0, 0, 0, 0.7),
                0 0 40px rgba(99, 102, 241, 0.2);
        }

        /* Scanline Animation */
        .scanline {
            width: 100%;
            height: 100px;
            background: linear-gradient(to bottom, transparent, rgba(99, 102, 241, 0.08), transparent);
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
            margin-bottom: 3.5rem;
        }

        .header h1 {
            font-family: var(--font-accent);
            font-size: 2.5rem;
            font-weight: 900;
            margin: 0;
            letter-spacing: -2px;
            background: linear-gradient(to bottom, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header p {
            color: #64748B;
            font-size: 1rem;
            margin-top: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .form-group {
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(20px);
        }

        .label {
            display: block;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #64748B;
            margin-bottom: 1rem;
            font-family: var(--font-accent);
        }

        .input-box {
            position: relative;
        }

        .input-box i {
            position: absolute;
            left: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            transition: 0.3s;
            font-size: 1.1rem;
        }

        .h-input {
            width: 100%;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            padding: 1.25rem 1.5rem 1.25rem 4rem;
            color: white;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .h-input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 0 25px rgba(99, 102, 241, 0.2);
            transform: scale(1.02);
        }

        .h-input:focus+i {
            color: var(--primary);
            transform: translateY(-50%) scale(1.2);
        }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 1.25rem;
            border-radius: 20px;
            font-weight: 900;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            cursor: pointer;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            margin-top: 1rem;
            box-shadow: 0 15px 35px var(--primary-glow);
            font-family: var(--font-accent);
        }

        .btn-login:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 30px 60px var(--primary-glow);
            filter: brightness(1.2);
        }

        .error-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            padding: 1.25rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 700;
        }

        .footer-link {
            text-align: center;
            margin-top: 2.5rem;
        }

        .footer-link a {
            color: #64748B;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: 0.3s;
        }

        .footer-link a:hover {
            color: white;
            letter-spacing: 4px;
        }
    </style>
</head>

<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="login-card">
        <div class="scanline"></div>

        <div class="header">
            <h1>SYSTEM ACCESS</h1>
            <p>Admin Authorization Required</p>
        </div>

        @if($errors->any())
            <div class="error-box animate__animated animate__shakeX">
                <i class="fas fa-shield-virus"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="label">Identification Pin</label>
                <div class="input-box">
                    <input type="text" name="email" class="h-input" required placeholder="EMAIL / ALIAS"
                        value="{{ old('email') }}">
                    <i class="fas fa-id-badge"></i>
                </div>
            </div>

            <div class="form-group">
                <label class="label">Neural key</label>
                <div class="input-box">
                    <input type="password" name="password" class="h-input" required placeholder="••••••••••••">
                    <i class="fas fa-project-diagram"></i>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-login">
                    Initialize Uplink
                </button>
            </div>
        </form>

        <div class="footer-link">
            <a href="/"><i class="fas fa-satellite"></i> Disconnect & Return</a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tl = gsap.timeline();

            tl.to('.login-card', {
                opacity: 1,
                y: 0,
                duration: 1.6,
                ease: "power4.out"
            });

            tl.to('.form-group', {
                opacity: 1,
                y: 0,
                stagger: 0.2,
                duration: 1,
                ease: "power2.out"
            }, "-=1");

            // 4D Tilt Logic
            const card = document.querySelector('.login-card');
            document.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const centerX = rect.width / 2;
                const centerY = rect.height / 2;

                const rotateX = (y - centerY) / 20;
                const rotateY = (centerX - x) / 20;

                gsap.to(card, {
                    rotateX: rotateX,
                    rotateY: rotateY,
                    duration: 0.5,
                    ease: "power2.out"
                });
            });

            document.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    rotateX: 0,
                    rotateY: 0,
                    duration: 1,
                    ease: "elastic.out(1, 0.3)"
                });
            });
        });
    </script>
</body>

</html>