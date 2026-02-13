<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - {{ $settings['site_name'] ?? 'GSM Trading Lab' }}</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        .success-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: var(--dark);
            position: relative;
            overflow: hidden;
        }

        .success-content {
            max-width: 600px;
            width: 100%;
            text-align: center;
            background: var(--dark-light);
            padding: 3rem;
            border-radius: var(--radius-lg);
            border: 1px solid rgba(16, 185, 129, 0.2);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            position: relative;
            z-index: 10;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: rgba(16, 185, 129, 0.1);
            color: var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 1.5rem;
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-title {
            font-size: 2rem;
            color: var(--white);
            margin-bottom: 1rem;
        }

        .success-desc {
            color: var(--gray);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .academy-box {
            background: rgba(99, 102, 241, 0.05);
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: left;
        }

        .academy-label {
            color: var(--primary-light);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            display: block;
        }

        .academy-value {
            color: var(--white);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .btn-zoom {
            background: #2D8CFF;
            color: white;
            padding: 1rem 2rem;
            border-radius: var(--radius-md);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: bold;
            transition: all 0.3s;
            margin-bottom: 1rem;
            width: 100%;
            justify-content: center;
        }

        .btn-zoom:hover {
            background: #1e73e0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 140, 255, 0.3);
        }

        .action-links {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .bg-shape {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--primary) 0%, transparent 70%);
            opacity: 0.1;
            filter: blur(80px);
            z-index: 1;
        }
    </style>
</head>

<body>
    <div class="success-page">
        <div class="bg-shape" style="top: -250px; left: -250px;"></div>
        <div class="bg-shape" style="bottom: -250px; right: -250px; background: var(--secondary);"></div>

        <div class="success-content">
            <div class="success-icon">✓</div>
            <h1 class="success-title">Payment Submitted!</h1>
            <p class="success-desc">
                Congratulations! You have successfully joined
                <strong>{{ $settings['site_name'] ?? 'GSM Trading Lab' }}</strong>.
                Our team is reviewing your payment and your account will be fully activated shortly.
            </p>

            @if(isset($order))
                @php
                    $waNumber = $settings['whatsapp_number'] ?? '447478035502';
                    $message = "I have completed the payment and placed my order. Please confirm and guide me further.\n\n";
                    $message .= "*Order Details:*\n";
                    $message .= "• *Student Name:* " . ($order->user->name ?? 'N/A') . "\n";
                    $message .= "• *Order ID:* #" . $order->id . "\n";
                    $message .= "• *Course/Service:* " . $order->service_name . "\n";
                    $message .= "• *Payment Method:* " . $order->payment_method . "\n";
                    $message .= "• *Amount:* " . $order->currency . " " . number_format($order->amount, 2) . "\n";
                    $message .= "• *Date & Time:* " . $order->created_at->format('M d, Y - h:i A') . " (Server Time)";

                    $waUrl = "https://wa.me/" . preg_replace('/[^0-9]/', '', $waNumber) . "?text=" . urlencode($message);
                @endphp

                <div
                    style="background: rgba(37, 211, 102, 0.1); border: 1px solid rgba(37, 211, 102, 0.2); border-radius: var(--radius-md); padding: 1.5rem; margin-bottom: 2rem;">
                    <div
                        style="color: #25D366; font-size: 1.2rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <span
                            style="display: inline-block; width: 10px; height: 10px; background: #25D366; border-radius: 50%; animation: pulse 1s infinite;"></span>
                        Redirecting to WhatsApp...
                    </div>
                    <p style="color: var(--gray); font-size: 0.85rem;">Sending your order details to our team for instant
                        confirmation.</p>
                    <a href="{{ $waUrl }}" class="btn btn-primary"
                        style="margin-top: 1rem; width: 100%; background: #25D366; border-color: #25D366; color: #fff;">
                        Open WhatsApp Now
                    </a>
                </div>

                <script>
                    setTimeout(function () {
                        window.location.href = "{!! $waUrl !!}";
                    }, 3000);
                </script>
            @endif

            <div class="academy-box">
                <span class="academy-label">Next Steps</span>
                <div class="academy-value" style="font-size: 0.95rem;">
                    1. Direct message sent to WhatsApp<br>
                    2. Admin verifies your transaction<br>
                    3. Access granted to VIP Signals & Courses
                </div>
            </div>

            @if(isset($settings['zoom_meeting_link']))
                <a href="{{ $settings['zoom_meeting_link'] }}" target="_blank" class="btn-zoom">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/94/Zoom_app_icon.png" width="24" alt="Zoom">
                    Join Live Class Room
                </a>
            @endif

            <div class="action-links">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary" style="justify-content: center;">Go to
                    Dashboard</a>
                <a href="{{ route('home') }}" class="btn btn-primary" style="justify-content: center;">Back to Home</a>
            </div>

            <p style="color: var(--gray); font-size: 0.85rem; margin-top: 2rem;">
                Need help? <a href="{{ route('contact') }}" style="color: var(--primary-light);">Contact Support</a>
            </p>
        </div>
    </div>
</body>

</html>