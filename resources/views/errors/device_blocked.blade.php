<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Limit Reached - GSM Trading Lab</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: var(--dark);
            color: white;
            font-family: 'Inter', sans-serif;
            text-align: center;
            padding: 2rem;
        }

        .block-card {
            max-width: 500px;
            background: var(--dark-light);
            padding: 3rem;
            border-radius: 1rem;
            border: 1px solid rgba(239, 68, 68, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
        }

        h1 {
            color: #ef4444;
            margin-bottom: 1rem;
        }

        p {
            color: var(--gray-light);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-logout {
            display: inline-block;
            padding: 0.8rem 2rem;
            background: #ef4444;
            color: white;
            text-decoration: none;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-logout:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="block-card">
        <div class="icon">🚫</div>
        <h1>Device Limit Reached</h1>
        <p>
            Bhai/Jani, aapka account already ek dusre mobile ya device par login hai.
            <br><br>
            <strong>GSM Trading Lab</strong> ke security rules ke mutabiq, premium subscription sirf 1 device par chal
            sakti hai.
        </p>
        <p style="font-size: 0.9rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1rem;">
            Agar aap ne mobile change kiya hai to admin se raabta karain device reset karwane ke liye.
            <br><br>
            <a href="{{ route('contact') }}" style="color: #3b82f6; text-decoration: underline;">Contact Support
                Team</a>
        </p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">Logout & Exit</button>
        </form>
    </div>
</body>

</html>