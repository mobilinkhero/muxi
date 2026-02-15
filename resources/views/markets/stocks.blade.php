@extends('layouts.main')

@section('title', 'Stocks & Indices Trading')
@section('description', 'Invest and trade global stocks and indices with expert guidance.')

@section('content')
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">Stocks & Indices</h1>
            <p class="page-breadcrumb">Home / Markets / Stocks</p>
        </div>
    </header>
    <section class="content-section">
        <div class="container">
            <div class="card" style="margin-bottom: 3rem;">
                <div style="font-size: 1.2rem; line-height: 1.8; color: var(--gray-light);">
                    <p>Equities represent ownership in a company, and indices track overall market performance. Learn how to
                        identify undervalued companies and market trends.</p>
                    <ul>
                        <li>Learn Fundamental & Technical Stock Analysis</li>
                        <li>Master US & Global Stock Markets (NYSE, NASDAQ, LSE)</li>
                        <li>Understanding Indices (S&P 500, NASDAQ, FTSE)</li>
                        <li>Dividends & Long-Term Investment Strategies</li>
                    </ul>
                </div>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🏢</div>
                    <h3>Company Valuation</h3>
                    <p>Analyze balance sheets, income statements, and growth prospects.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h3>Indices Trading</h3>
                    <p>Trade market baskets to diversify risk and capture broad trends.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💼</div>
                    <h3>IPO & Growth</h3>
                    <p>Identify promising IPOs and high-growth sectors early.</p>
                </div>
            </div>

            <div style="text-align: center; margin-top: 4rem;">
                <a href="{{ route('login') }}" class="btn btn-primary">Start Trading Stocks Now</a>
            </div>
        </div>
    </section>
@endsection