@extends('layouts.main')

@section('title', 'Forex Trading')
@section('description', 'Trade major, minor, and exotic currency pairs with GSM Trading Lab strategies.')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">Forex Trading</h1>
            <p class="page-breadcrumb">Home / Markets / Forex</p>
        </div>
    </header>
    <section class="content-section">
        <div class="container">
            <div class="card" style="margin-bottom: 3rem;">
                <div style="font-size: 1.2rem; line-height: 1.8; color: var(--gray-light);">
                    <p>Forex (Foreign Exchange) is the largest financial market in the world, with over $6 trillion traded
                        daily. Join GSM Trading Lab to master currency trading.</p>
                    <ul>
                        <li>Understand Currency Pairs (Major, Minor, Exotic)</li>
                        <li>Learn Fundamental & Technical Analysis</li>
                        <li>Master Risk Management & Position Sizing</li>
                        <li>Automated Trading & EA Strategies</li>
                    </ul>
                </div>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">💱</div>
                    <h3>Major Pairs</h3>
                    <p>Trade EUR/USD, GBP/USD, USD/JPY with tight spreads and high liquidity.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🌍</div>
                    <h3>Global Economics</h3>
                    <p>Learn how interest rates, GDP, and inflation affect currency values.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🤖</div>
                    <h3>Automated Trading</h3>
                    <p>Explore algorithmic trading and build consistent forex strategies.</p>
                </div>
            </div>

            <div style="text-align: center; margin-top: 4rem;">
                <a href="{{ route('login') }}" class="btn btn-primary">Start Trading Forex Now</a>
            </div>
        </div>
    </section>
@endsection