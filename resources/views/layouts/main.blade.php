<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - GSM Trading Lab</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="@yield('description', 'Master trading in Crypto, Forex, Stocks, Indices, Commodities & Derivatives.')">
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        /* Additional Page Styles */
        .page-header {
            padding-top: 120px;
            padding-bottom: 60px;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            text-align: center;
        }

        .page-title {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        .page-breadcrumb {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .content-section {
            padding: 4rem 0;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar" style="background: rgba(15, 23, 42, 0.95); backdrop-filter: blur(10px);">
        <div class="container">
            <div class="nav-container">
                <a href="/" class="logo">
                    <img src="{{ asset('images/logo.svg') }}" alt="{{ $settings['site_name'] ?? 'GSM Trading Lab' }}"
                        style="height: 40px;">
                </a>
                <ul class="nav-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="{{ route('markets.crypto') }}">Markets</a></li>
                    <li><a href="{{ route('company.about') }}">About</a></li>
                    <li><a href="{{ route('company.blog') }}">Blog</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="btn btn-secondary">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="btn btn-secondary" style="border: none;">Login</a></li>
                    @endauth
                    <li><a href="/#contact" class="btn btn-primary">Get Started</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    @include('partials.footer')

    <!-- Simple Navbar Scroll Effect -->
    <script>
        window.addEventListener('scroll', function () {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    @include('partials.security-script')
</body>

</html>