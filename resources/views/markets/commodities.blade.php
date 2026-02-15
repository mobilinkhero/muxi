@extends('layouts.main')

@section('title', 'Commodities & Derivatives')
@section('description', 'Trade Gold, Oil, Silver and other commodities and derivatives with confidence.')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">Commodities & Derivatives</h1>
            <p class="page-breadcrumb">Home / Markets / Commodities</p>
        </div>
    </header>
    <section class="content-section">
        <div class="container">
            <div class="card" style="margin-bottom: 3rem;">
                <div style="font-size: 1.2rem; line-height: 1.8; color: var(--gray-light);">
                    <p>Commodities are raw materials used in commerce, while derivatives derive their value from underlying
                        assets. Learn how to trade these complex instruments.</p>
                    <ul>
                        <li>Understand Commodity Cycles (Gold, Oil, Silver, Copper)</li>
                        <li>Learn Futures, Options, and CFDs</li>
                        <li>Master Supply & Demand Analysis for Commodities</li>
                        <li>Risk Management for Derivative Trading</li>
                    </ul>
                </div>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🪙</div>
                    <h3>Gold & Precious Metals</h3>
                    <p>Strategies for trading Gold (XAUUSD) and Silver (XAGUSD).</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🛢️</div>
                    <h3>Oil & Energy</h3>
                    <p>Navigate the oil markets (WTI, Brent) and natural gas.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🧾</div>
                    <h3>Futures & Options</h3>
                    <p>Advanced strategies for hedging and speculation using derivatives.</p>
                </div>
            </div>

            <div style="text-align: center; margin-top: 4rem;">
                <a href="{{ route('login') }}" class="btn btn-primary">Start Trading Commodities Now</a>
            </div>
        </div>
    </section>
@endsection