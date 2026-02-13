<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - GSM Trading Lab</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        .contact-container {
            padding: 4rem 2rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--white);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 1rem;
            background: var(--dark-light);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-md);
            color: var(--white);
            transition: var(--transition-fast);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(99, 102, 241, 0.1);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-container">
                <a href="/" class="logo">
                    <img src="https://i.ibb.co/3ykG88h/gsm-logo.png" alt="GSM Trading Lab Logo" style="height: 40px;">
                    GSM Trading Lab
                </a>
                <ul class="nav-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="/learn">Learn</a></li>
                    <li><a href="/trade">Trade</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="btn btn-secondary">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="contact-container">
        <div class="section-header">
            <span class="section-badge">Get In Touch</span>
            <h2>Contact Us</h2>
            <p>Have questions about our signals, courses, or services? We're here to help.</p>
        </div>

        @if(session('success'))
            <div
                style="background: rgba(16, 185, 129, 0.2); color: #10B981; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 2rem; border: 1px solid #10B981;">
                {{ session('success') }}
            </div>
        @endif

        <div
            style="background: var(--dark-light); padding: 2rem; border-radius: var(--radius-lg); border: 1px solid rgba(255,255,255,0.05);">
            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" required
                        placeholder="Enter your full name">
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" required
                        placeholder="name@example.com">
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" class="form-control" required
                        placeholder="How can we help?">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="5" required
                        placeholder="Write your message here..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
            </form>
        </div>

        <div style="margin-top: 4rem; text-align: center;">
            <h3>Other Ways to Reach Us</h3>
            <div style="display: flex; justify-content: center; gap: 2rem; margin-top: 1.5rem; flex-wrap: wrap;">
                <div
                    style="background: var(--dark-light); padding: 1.5rem; border-radius: var(--radius-md); width: 250px;">
                    <div style="font-size: 2rem; margin-bottom: 1rem;">📧</div>
                    <h4>Email</h4>
                    <p style="color: var(--gray);">info@gsmtradinglab.com</p>
                </div>
                <div
                    style="background: var(--dark-light); padding: 1.5rem; border-radius: var(--radius-md); width: 250px;">
                    <div style="font-size: 2rem; margin-bottom: 1rem;">📱</div>
                    <h4>WhatsApp</h4>
                    <p style="color: var(--gray);">+44 7478 035502</p>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
</body>

</html>