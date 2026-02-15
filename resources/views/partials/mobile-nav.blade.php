<!-- Mobile Bottom Tab Bar -->
<nav class="mobile-tab-bar">
    <a href="/" class="tab-item {{ Request::is('/') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="{{ route('markets.crypto') }}" class="tab-item {{ Request::is('markets*') ? 'active' : '' }}">
        <i class="fas fa-chart-line"></i>
        <span>Markets</span>
    </a>

    @auth
        <a href="{{ route('dashboard') }}" class="tab-item fab-mobile {{ Request::is('dashboard*') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
        </a>
    @else
        <a href="{{ route('login') }}" class="tab-item fab-mobile {{ Request::is('login') ? 'active' : '' }}">
            <i class="fas fa-user"></i>
        </a>
    @endauth

    <a href="/trade" class="tab-item {{ Request::is('trade*') ? 'active' : '' }}">
        <i class="fas fa-signal"></i>
        <span>Trade</span>
    </a>
    <a href="/learn" class="tab-item {{ Request::is('learn*') ? 'active' : '' }}">
        <i class="fas fa-graduation-cap"></i>
        <span>Learn</span>
    </a>
</nav>