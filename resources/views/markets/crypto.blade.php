@extends('layouts.main')

@section('title', 'Cryptocurrency Trading')
@section('description', 'Master Bitcoin, Ethereum, and Altcoin trading with expert analysis and strategies.')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">Cryptocurrency Trading</h1>
            <p class="page-breadcrumb">Home / Markets / Cryptocurrency</p>
        </div>
    </header>
    <section class="content-section">
        <div class="container">
            <div class="card" style="margin-bottom: 3rem;">
                <div style="font-size: 1.2rem; line-height: 1.8; color: var(--gray-light);">
                    <p>Welcome to the dynamic world of Cryptocurrency trading. At GSM Trading Lab, we provide comprehensive
                        education and signals to help you navigate the volatile crypto markets.</p>
                    <ul>
                        <li>Learn Blockchain Fundamentals</li>
                        <li>Master Technical Analysis for Crypto</li>
                        <li>Understand DeFi, NFTs, and Web3</li>
                        <li>Risk Management for High Volatility Assets</li>
                    </ul>
                </div>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">₿</div>
                    <h3>Bitcoin & Majors</h3>
                    <p>Strategies for trading BTC, ETH, SOL, and other major cryptocurrencies.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🚀</div>
                    <h3>Altcoins & Gems</h3>
                    <p>Discover high-potential altcoins and participate in early-stage projects.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⛓️</div>
                    <h3>On-Chain Analysis</h3>
                    <p>Leverage blockchain data to predict market movements.</p>
                </div>
            </div>

            <div style="text-align: center; margin-top: 4rem;">
                <a href="{{ route('login') }}" class="btn btn-primary">Start Trading Crypto Now</a>
            </div>
        </div>
    </section>
@endsection