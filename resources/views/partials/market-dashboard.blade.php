<section class="section" style="background: var(--dark); padding-top: 0; padding-bottom: 2rem;">
    <!-- Ticker Tape -->
    <div class="tradingview-widget-container" style="margin-bottom: 3rem;">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js"
            async>
                {
                    "symbols": [
                        {
                            "proName": "BITSTAMP:BTCUSD",
                            "title": "Bitcoin"
                        },
                        {
                            "proName": "BITSTAMP:ETHUSD",
                            "title": "Ethereum"
                        },
                        {
                            "proName": "BINANCE:SOLUSDT",
                            "title": "Solana"
                        },
                        {
                            "proName": "BINANCE:BNBUSDT",
                            "title": "BNB"
                        },
                        {
                            "proName": "BINANCE:XRPUSDT",
                            "title": "XRP"
                        },
                        {
                            "proName": "BINANCE:DOGEUSDT",
                            "title": "Dogecoin"
                        },
                        {
                            "proName": "OANDA:XAUUSD",
                            "title": "Gold"
                        },
                        {
                            "proName": "OANDA:XAGUSD",
                            "title": "Silver"
                        },
                        {
                            "proName": "FX:EURUSD",
                            "title": "EUR/USD"
                        },
                        {
                            "proName": "FX:GBPUSD",
                            "title": "GBP/USD"
                        },
                        {
                            "proName": "FX:USDJPY",
                            "title": "USD/JPY"
                        },
                        {
                            "proName": "FOREXCOM:SPXUSD",
                            "title": "S&P 500"
                        },
                        {
                            "proName": "FOREXCOM:NSXUSD",
                            "title": "Nasdaq 100"
                        },
                        {
                            "proName": "INDEX:DXY",
                            "title": "U.S. Dollar Index"
                        }
                    ],
                        "showSymbolLogo": true,
                            "colorTheme": "dark",
                                "isTransparent": false,
                                    "displayMode": "adaptive",
                                        "locale": "en"
                }
            </script>
    </div>

    <div class="container">
        <div class="section-header">
            <span class="section-badge">Live Market Data</span>
            <h2>Market Intelligence Dashboard</h2>
            <p>Real-time analysis, market sentiment, and technical indicators to power your trading decisions.</p>
        </div>

        <div class="services-grid" style="grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">

            <!-- Fear & Greed Index -->
            <div class="service-card">
                <div class="service-header">
                    <div class="service-icon">🧠</div>
                    <div>
                        <h3>Crypto Sentiment</h3>
                        <p style="margin: 0; font-size: 0.9rem;">Fear & Greed Index</p>
                    </div>
                </div>
                <div style="text-align: center;">
                    <img src="https://alternative.me/crypto/fear-and-greed-index.png"
                        alt="Latest Crypto Fear & Greed Index"
                        style="width: 100%; max-width: 400px; border-radius: var(--radius-md);">
                </div>
                <p style="margin-top: 1rem; font-size: 0.9rem; text-align: center;">
                    <span style="color: var(--secondary);">Extreme Fear</span> = Buying Opportunity<br>
                    <span style="color: var(--accent);">Extreme Greed</span> = Selling Opportunity
                </p>
            </div>

            <!-- Technical Analysis -->
            <div class="service-card">
                <div class="service-header">
                    <div class="service-icon">⚡</div>
                    <div>
                        <h3>Market Technicals</h3>
                        <p style="margin: 0; font-size: 0.9rem;">Real-time Buy/Sell Signals</p>
                    </div>
                </div>
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                            {
                                "interval": "1m",
                                    "width": "100%",
                                        "isTransparent": true,
                                            "height": 400,
                                                "symbol": "BITSTAMP:BTCUSD",
                                                    "showIntervalTabs": true,
                                                        "displayMode": "single",
                                                            "locale": "en",
                                                                "colorTheme": "dark"
                            }
                        </script>
                </div>
                <!-- TradingView Widget END -->
            </div>

            <!-- Top Assets List -->
            <div class="service-card">
                <div class="service-header">
                    <div class="service-icon">📈</div>
                    <div>
                        <h3>Top Assets Overview</h3>
                        <p style="margin: 0; font-size: 0.9rem;">Multi-Market Performance</p>
                    </div>
                </div>
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
                            {
                                "colorTheme": "dark",
                                    "dateRange": "12M",
                                        "showChart": false,
                                            "locale": "en",
                                                "largeChartUrl": "",
                                                    "isTransparent": true,
                                                        "showSymbolLogo": true,
                                                            "showFloatingTooltip": false,
                                                                "width": "100%",
                                                                    "height": "400",
                                                                        "tabs": [
                                                                            {
                                                                                "title": "Crypto",
                                                                                "symbols": [
                                                                                    {
                                                                                        "s": "BITSTAMP:BTCUSD",
                                                                                        "d": "Bitcoin"
                                                                                    },
                                                                                    {
                                                                                        "s": "BITSTAMP:ETHUSD",
                                                                                        "d": "Ethereum"
                                                                                    },
                                                                                    {
                                                                                        "s": "BINANCE:SOLUSDT",
                                                                                        "d": "Solana"
                                                                                    },
                                                                                    {
                                                                                        "s": "BINANCE:BNBUSDT",
                                                                                        "d": "BNB"
                                                                                    },
                                                                                    {
                                                                                        "s": "BINANCE:XRPUSDT",
                                                                                        "d": "XRP"
                                                                                    },
                                                                                    {
                                                                                        "s": "BINANCE:ADAUSDT",
                                                                                        "d": "Cardano"
                                                                                    },
                                                                                    {
                                                                                        "s": "BINANCE:DOGEUSDT",
                                                                                        "d": "Dogecoin"
                                                                                    },
                                                                                    {
                                                                                        "s": "BINANCE:DOTUSDT",
                                                                                        "d": "Polkadot"
                                                                                    }
                                                                                ]
                                                                            },
                                                                            {
                                                                                "title": "Forex",
                                                                                "symbols": [
                                                                                    {
                                                                                        "s": "FX:EURUSD",
                                                                                        "d": "EUR/USD"
                                                                                    },
                                                                                    {
                                                                                        "s": "FX:GBPUSD",
                                                                                        "d": "GBP/USD"
                                                                                    },
                                                                                    {
                                                                                        "s": "FX:USDJPY",
                                                                                        "d": "USD/JPY"
                                                                                    },
                                                                                    {
                                                                                        "s": "FX:AUDUSD",
                                                                                        "d": "AUD/USD"
                                                                                    },
                                                                                    {
                                                                                        "s": "FX:USDCAD",
                                                                                        "d": "USD/CAD"
                                                                                    },
                                                                                    {
                                                                                        "s": "FX:USDCHF",
                                                                                        "d": "USD/CHF"
                                                                                    }
                                                                                ]
                                                                            },
                                                                            {
                                                                                "title": "Ind/Com",
                                                                                "symbols": [
                                                                                    {
                                                                                        "s": "OANDA:XAUUSD",
                                                                                        "d": "Gold"
                                                                                    },
                                                                                    {
                                                                                        "s": "OANDA:XAGUSD",
                                                                                        "d": "Silver"
                                                                                    },
                                                                                    {
                                                                                        "s": "TVC:UKOIL",
                                                                                        "d": "Brent Oil"
                                                                                    },
                                                                                    {
                                                                                        "s": "FOREXCOM:SPXUSD",
                                                                                        "d": "S&P 500"
                                                                                    },
                                                                                    {
                                                                                        "s": "FOREXCOM:NSXUSD",
                                                                                        "d": "Nasdaq 100"
                                                                                    },
                                                                                    {
                                                                                        "s": "INDEX:DXY",
                                                                                        "d": "DXY Index"
                                                                                    }
                                                                                ]
                                                                            }
                                                                        ]
                            }
                        </script>
                </div>
                <!-- TradingView Widget END -->
            </div>

        </div>
    </div>
</section>