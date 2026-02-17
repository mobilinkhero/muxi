<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Command Center Access - GSM Trading Lab</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&family=JetBrains+Mono:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --h-bg: #020617;
            --h-primary: #6366F1;
            --h-secondary: #06b6d4;
            --h-border: rgba(255, 255, 255, 0.1);
            --font-h: 'Outfit', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }

        body {
            background: var(--h-bg);
            color: #F8FAFC;
            font-family: var(--font-h);
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Ambient Background Noise/Grain */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("https://www.transparenttextures.com/patterns/carbon-fibre.png");
            opacity: 0.1;
            z-index: -1;
            pointer-events: none;
        }

        /* Dynamic Orbs */
        .orb {
            position: absolute;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.15;
            z-index: -1;
            animation: orbFloat 20s infinite alternate cubic-bezier(0.4, 0, 0.2, 1);
        }

        .orb-1 {
            background: var(--h-primary);
            top: -20%;
            right: -10%;
        }

        .orb-2 {
            background: var(--h-secondary);
            bottom: -20%;
            left: -10%;
            animation-delay: -5s;
        }

        @keyframes orbFloat {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(50px, 50px) scale(1.1);
            }
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            perspective: 1000px;
            padding: 20px;
        }

        .login-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(30px);
            border: 1px solid var(--h-border);
            border-radius: 32px;
            padding: 3.5rem;
            position: relative;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
            transform: translateY(20px);
            opacity: 0;
        }

        .scan-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--h-secondary);
            box-shadow: 0 0 15px var(--h-secondary);
            z-index: 10;
            opacity: 0.3;
            animation: scan 4s linear infinite;
            pointer-events: none;
        }

        @keyframes scan {
            0% {
                top: 0;
                opacity: 0;
            }

            5% {
                opacity: 0.5;
            }

            95% {
                opacity: 0.5;
            }

            100% {
                top: 100%;
                opacity: 0;
            }
        }

        .header-box {
            text-align: center;
            margin-bottom: 3rem;
        }

        .terminal-tag {
            font-family: var(--font-mono);
            font-size: 0.7rem;
            color: var(--h-secondary);
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 800;
            margin-bottom: 1rem;
            display: inline-block;
            background: rgba(6, 182, 212, 0.1);
            padding: 4px 12px;
            border-radius: 50px;
            border: 1px solid rgba(6, 182, 212, 0.2);
        }

        .header-box h1 {
            font-size: 2.25rem;
            font-weight: 900;
            margin: 0;
            letter-spacing: -1px;
            background: linear-gradient(to bottom, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-group {
            margin-bottom: 1.5rem;
            opacity: 0;
            transform: translateY(10px);
        }

        .label-text {
            display: block;
            font-family: var(--font-mono);
            font-size: 0.7rem;
            color: #64748B;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 0.75rem;
            font-weight: 700;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
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
            border: 1px solid var(--h-border);
            border-radius: 16px;
            padding: 1rem 1.25rem 1rem 3.5rem;
            color: white;
            font-family: var(--font-mono);
            font-size: 0.95rem;
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .h-input:focus {
            outline: none;
            border-color: var(--h-primary);
            background: rgba(0, 0, 0, 0.5);
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.1);
        }

        .h-input:focus+i {
            color: var(--h-primary);
        }

        .btn-access {
            width: 100%;
            background: var(--h-primary);
            color: white;
            border: none;
            padding: 1.1rem;
            border-radius: 16px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: 0.4s cubic-bezier(0.2, 1, 0.3, 1);
            margin-top: 2rem;
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-access:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, 0.4);
            filter: brightness(1.1);
        }

        .btn-access:active {
            transform: translateY(-2px);
        }

        .back-link {
            text-align: center;
            margin-top: 2rem;
        }

        .back-link a {
            color: #64748B;
            text-decoration: none;
            font-size: 0.8rem;
            font-family: var(--font-mono);
            transition: 0.3s;
        }

        .back-link a:hover {
            color: white;
        }

        .error-badge {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #EF4444;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: var(--font-mono);
        }
    </style>
</head>

<body>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="scan-line"></div>

            <div class="header-box">
                <span class="terminal-tag">GSM_LAB // CMD_CENTER</span>
                <h1>Access Portal</h1>
            </div>

            @if($errors->any())
                <div class="error-badge">
                    <i class="fas fa-shield-virus"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="label-text">Operator Identity</label>
                    <div class="input-wrapper">
                        <input type="text" name="email" class="h-input" required placeholder="EMAIL / UID"
                            value="{{ old('email') }}">
                        <i class="fas fa-fingerprint"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label class="label-text">Encryption Key</label>
                    <div class="input-wrapper">
                        <input type="password" name="password" class="h-input" required placeholder="••••••••••••">
                        <i class="fas fa-key"></i>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-access">
                        <span>Initialize Link</span>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </form>

            <div class="back-link">
                <a href="/"><i class="fas fa-arrow-left"></i> RETURN_TO_NEXUS</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tl = gsap.timeline();

            tl.to('.login-card', {
                opacity: 1,
                y: 0,
                duration: 1.2,
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