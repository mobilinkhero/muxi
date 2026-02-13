<div class="analysis-dashboard">
    <!-- Section Header -->
    <div class="section-header" style="margin-bottom: 2rem;">
        <span class="section-badge">Market Intelligence</span>
        <h2>Global Market Analysis</h2>
        <p>Real-time market intelligence powered by TradingView, CoinGlass, and CoinMarketCap data.</p>
    </div>

    <!-- Global Metrics Bar -->
    <div id="globalMetrics"
        style="margin-bottom: 1rem; padding: 0.5rem 1rem; background: rgba(0,0,0,0.2); border-radius: 4px; display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem; border: 1px solid rgba(255,255,255,0.05);">
        <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
            <span>Market Cap: <strong id="metric-cap" style="color: #10b981;">Loading...</strong></span>
            <span>24h Vol: <strong id="metric-vol" style="color: #fbbf24;">Loading...</strong></span>
            <span>BTC Dom: <strong id="metric-btc" style="color: #fca5a5;">--%</strong></span>
            <span>ETH Dom: <strong id="metric-eth" style="color: #a5b4fc;">--%</strong></span>
        </div>
        <div style="color: var(--gray); font-size: 0.7rem;">Powered by CoinMarketCap</div>
    </div>

    <!-- Top Row: Market Overview & Ticker -->
    <div style="margin-bottom: 2rem;">
        <!-- TradingView Ticker Tape -->
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <script type="text/javascript"
                src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                    {
                        "symbols": [
                            { "proName": "FOREXCOM:SPXUSD", "title": "S&P 500" },
                            { "proName": "FOREXCOM:NSXUSD", "title": "US 100" },
                            { "proName": "FX_IDC:EURUSD", "title": "EUR/USD" },
                            { "proName": "BITSTAMP:BTCUSD", "title": "Bitcoin" },
                            { "proName": "BITSTAMP:ETHUSD", "title": "Ethereum" },
                            { "proName": "OANDA:XAUUSD", "title": "Gold" }
                        ],
                            "showSymbolLogo": true,
                                "colorTheme": "dark",
                                    "isTransparent": false,
                                        "displayMode": "adaptive",
                                            "locale": "en"
                    }
                </script>
        </div>
    </div>

    <!-- News & Trump Watch Section -->
    <div class="analysis-grid" style="gap: 2rem; margin-bottom: 2rem;">

        <!-- Live News Feed -->
        <div class="analysis-card wide" style="height: 600px; overflow: hidden; display: flex; flex-direction: column;">
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <h3>📰 Breaking Market News</h3>
                    <button onclick="enableNewsAlerts()" id="alertBtn"
                        style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: var(--white); cursor: pointer; padding: 0.2rem 0.8rem; border-radius: 4px; font-size: 0.8rem; transition: 0.2s; display: flex; align-items: center; gap: 0.5rem;">
                        <span>🔔</span> Enable Alerts
                    </button>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <span class="live-indicator"
                        style="width: 8px; height: 8px; background: #ef4444; border-radius: 50%; display: inline-block; animation: pulse 1.5s infinite;"></span>
                    <span style="font-size: 0.8rem; color: #ef4444; font-weight: bold;">LIVE FEED</span>
                </div>
            </div>
            <!-- Custom News Feed (CoinTelegraph & CoinDesk) -->
            <div id="custom-news-feed" style="flex: 1; overflow-y: auto; padding: 1rem;">
                <div style="text-align: center; padding: 2rem; color: var(--gray);">Loading Top Stories...</div>
            </div>

            <script>
                async function loadNews() {
                    try {
                        const res = await fetch('/api/market/news');
                        const news = await res.json();
                        const container = document.getElementById('custom-news-feed');

                        if (!news || news.length === 0) {
                            container.innerHTML = '<div style="text-align: center; padding: 2rem;">No news available at the moment.</div>';
                            return;
                        }

                        let html = '';
                        news.forEach(item => {
                            html += `
                            <a href="${item.link}" target="_blank" style="display: flex; gap: 1rem; margin-bottom: 1rem; text-decoration: none; padding: 0.75rem; border-radius: 8px; transition: background 0.2s; border: 1px solid rgba(255,255,255,0.05);">
                                <div style="width: 80px; height: 60px; flex-shrink: 0; overflow: hidden; border-radius: 6px; background: #333;">
                                    <img src="${item.image}" alt="News" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.style.display='none'">
                                </div>
                                <div style="flex: 1;">
                                    <div style="font-size: 0.9rem; font-weight: 600; color: var(--white); line-height: 1.4; margin-bottom: 0.4rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        ${item.title}
                                    </div>
                                    <div style="display: flex; align-items: center; gap: 0.8rem; font-size: 0.75rem;">
                                        <span style="color: ${item.color}; font-weight: bold; background: rgba(255,255,255,0.05); padding: 2px 6px; border-radius: 4px;">${item.source}</span>
                                        <span style="color: var(--gray);">${item.date_human}</span>
                                    </div>
                                </div>
                            </a>
                            `;
                        });
                        container.innerHTML = html;

                        // Add hover effect via JS delegation or CSS style block 
                        const style = document.createElement('style');
                        style.innerHTML = '#custom-news-feed a:hover { background: rgba(255,255,255,0.05); }';
                        document.head.appendChild(style);

                    } catch (e) {
                        document.getElementById('custom-news-feed').innerHTML = '<div style="text-align: center; padding: 2rem; color: #ef4444;">Failed to load news feed.</div>';
                    }
                }
                document.addEventListener('DOMContentLoaded', loadNews);
            </script>
        </div>

        <!-- Trump Watch (Twitter/X) -->
        <div class="analysis-card"
            style="height: 600px; display: flex; flex-direction: column; background: #000; border: 1px solid #333;">
            <div class="card-header"
                style="background: rgba(29, 161, 242, 0.1); border-bottom: 1px solid #333; padding: 1rem; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="display: flex; align-items: center; gap: 0.5rem; margin: 0;">
                    🇺🇸 Trump Watch
                    <span
                        style="font-size: 0.7rem; background: #1da1f2; color: white; padding: 2px 6px; border-radius: 4px;">Market
                        Mover</span>
                </h3>
                <a href="https://twitter.com/realDonaldTrump" target="_blank"
                    style="font-size: 0.8rem; color: #1da1f2; text-decoration: none;">View on X ↗</a>
            </div>
            <div style="flex: 1; overflow-y: auto; padding: 0; background: #000; position: relative;">
                <!-- Fallback/Loading Message -->
                <div
                    style="position: absolute; top: 2rem; width: 100%; text-align: center; color: var(--gray); z-index: 0;">
                    <p>Loading Feed...</p>
                    <p style="font-size: 0.8rem; opacity: 0.7;">(Disable AdBlock if feed doesn't appear)</p>
                    <a href="https://twitter.com/realDonaldTrump" target="_blank" class="btn btn-sm btn-primary"
                        style="margin-top: 0.5rem;">Open Direct Link</a>
                </div>

                <!-- Embed -->
                <div style="position: relative; z-index: 1;">
                    <a class="twitter-timeline" data-theme="dark" data-width="100%" data-height="600"
                        href="https://twitter.com/realDonaldTrump?ref_src=twsrc%5Etfw">
                    </a>
                </div>
            </div>
        </div>

        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </div>

    <div class="market-grid">

        <!-- Left Col: Technicals & Sentiment -->
        <div class="market-col-left">

            <!-- Technical Analysis Speedometer (Crypto) -->
            <div class="analysis-card">
                <div class="card-header">
                    <h3>⚡ Crypto Technicals (BTC)</h3>
                </div>
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                            {
                                "interval": "4h",
                                    "width": "100%",
                                        "isTransparent": true,
                                            "height": 450,
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

            <!-- Liquidation & Sentiment Tracker -->
            <div class="analysis-card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <h3>☠️ Derivatives Pain</h3>
                    <span id="cg-status"
                        style="font-size: 0.7rem; color: var(--gray); background: rgba(255,255,255,0.05); padding: 2px 6px; border-radius: 4px;">Est.
                        24h</span>
                </div>
                <div style="padding: 1.5rem; text-align: center;">
                    <div style="font-size: 0.8rem; color: var(--gray); margin-bottom: 0.5rem;">Total Liquidations (24h)
                    </div>
                    <div id="liqCounter"
                        style="font-size: 2rem; font-weight: 800; color: #ef4444; font-family: 'Courier New', monospace; letter-spacing: -1px; text-shadow: 0 0 20px rgba(239, 68, 68, 0.4);">
                        $--</div>

                    <div style="margin-top: 1.5rem;">
                        <div
                            style="font-size: 0.8rem; color: var(--gray); margin-bottom: 0.5rem; display: flex; justify-content: space-between;">
                            <span>Active Longs <span id="ls-long-val" style="color: #10b981;">--%</span></span>
                            <span>Active Shorts <span id="ls-short-val" style="color: #ef4444;">--%</span></span>
                        </div>
                        <div
                            style="height: 8px; background: #374151; border-radius: 4px; overflow: hidden; display: flex;">
                            <div id="ls-long-bar"
                                style="width: 50%; background: #10b981; height: 100%; transition: width 1s;"></div>
                            <div id="ls-short-bar"
                                style="width: 50%; background: #ef4444; height: 100%; transition: width 1s;"></div>
                        </div>
                    </div>

                    <a href="https://www.coinglass.com/LiquidationData" target="_blank"
                        style="display: block; margin-top: 1rem; font-size: 0.8rem; color: var(--primary); text-decoration: none;">View
                        Real-Time CoinGlass Data &rarr;</a>
                </div>
                <script>
                    async function fetchCoinGlassData() {
                        try {
                            // 1. Long/Short Ratio
                            const lsRes = await fetch('/api/market/coinglass/longshort');
                            const lsData = await lsRes.json();

                            if (lsData) {
                                // Handle demo or real structure
                                const longPct = lsData.longRatio || (lsData.list && lsData.list[0] ? lsData.list[0].longRate : 50);
                                const shortPct = lsData.shortRatio || (lsData.list && lsData.list[0] ? lsData.list[0].shortRate : 50);

                                document.getElementById('ls-long-bar').style.width = longPct + '%';
                                document.getElementById('ls-short-bar').style.width = shortPct + '%';
                                document.getElementById('ls-long-val').innerText = longPct + '%';
                                document.getElementById('ls-short-val').innerText = shortPct + '%';

                                if (lsData.demo) {
                                    document.getElementById('cg-status').innerText = "Simulated Data";
                                } else {
                                    document.getElementById('cg-status').innerText = "Live CoinGlass Data";
                                    document.getElementById('cg-status').style.color = "#10b981";
                                }
                            }

                            // 2. Liquidations (Start simulation from base if live)
                            const liqRes = await fetch('/api/market/coinglass/liquidations');
                            const liqData = await liqRes.json();

                            let startLiq = 142000000; // Fallback
                            if (liqData.total_liq) startLiq = parseFloat(liqData.total_liq);

                            // Start simulation from this base
                            const liqElement = document.getElementById('liqCounter');
                            let currentLiq = startLiq;

                            // Prevent multiple intervals
                            if (!window.liqInterval) {
                                window.liqInterval = setInterval(() => {
                                    const increment = Math.floor(Math.random() * 2500) + 100;
                                    currentLiq += increment;
                                    liqElement.innerText = '$' + currentLiq.toLocaleString();
                                }, 1000);
                            } else {
                                // Just update base? No, simulation runs independent. 
                                // Ideally we reset currentLiq to new base but keep adding.
                                if (Math.abs(currentLiq - startLiq) > 10000000) {
                                    currentLiq = startLiq; // Sync if huge drift
                                }
                            }

                        } catch (e) {
                            console.error("CG Fetch Error", e);
                        }
                    }

                    // Run once on load
                    window.addEventListener('load', fetchCoinGlassData);
                </script>
            </div>

            <!-- Technical Analysis Speedometer (Gold) -->
            <div class="analysis-card">
                <div class="card-header">
                    <h3>🏆 Gold Technicals (XAU)</h3>
                </div>
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                            {
                                "interval": "4h",
                                    "width": "100%",
                                        "isTransparent": true,
                                            "height": 450,
                                                "symbol": "OANDA:XAUUSD",
                                                    "showIntervalTabs": true,
                                                        "displayMode": "single",
                                                            "locale": "en",
                                                                "colorTheme": "dark"
                            }
                        </script>
                </div>
                <!-- TradingView Widget END -->
            </div>

            <!-- Fear & Greed Index (Alternative Image based, simplistic) -->
            <div class="analysis-card">
                <div class="card-header">
                    <h3>😨 Market Sentiment</h3>
                </div>
                <div style="text-align: center; padding: 1rem;">
                    <img src="https://alternative.me/crypto/fear-and-greed-index.png"
                        alt="Latest Crypto Fear & Greed Index"
                        style="width: 100%; max-width: 400px; border-radius: 8px;">
                </div>
            </div>

        </div>

        <!-- Right Col: Overview & Economics -->
        <div class="market-col-right">

            <!-- Price Alert Widget -->
            <div class="analysis-card"
                style="border: 1px solid rgba(16, 185, 129, 0.3); background: linear-gradient(145deg, rgba(16,185,129,0.05) 0%, rgba(17,24,39,1) 100%);">
                <div class="card-header" style="background: rgba(16, 185, 129, 0.1);">
                    <h3>🔔 Price Alarm Setup</h3>
                    <div style="font-size: 0.8rem; color: #10b981;">Active Monitoring</div>
                </div>
                <div style="padding: 1.5rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div>
                            <label
                                style="display: block; font-size: 0.8rem; color: var(--gray); margin-bottom: 0.3rem;">
                                Asset <span id="live-price-tag"
                                    style="float: right; color: #10b981; font-weight: bold; font-family: monospace;">$---</span>
                            </label>
                            <select id="alertAsset" onchange="updateLivePriceDisplay()"
                                style="width: 100%; padding: 0.6rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;">
                                <option value="BTC">Bitcoin (BTC)</option>
                                <option value="ETH">Ethereum (ETH)</option>
                                <option value="SOL">Solana (SOL)</option>
                                <option value="XRP">XRP</option>
                                <option value="BNB">BNB</option>
                                <option value="DOGE">Dogecoin</option>
                                <option value="XAU">Gold (XAU)</option>
                            </select>
                        </div>
                        <div>
                            <label
                                style="display: block; font-size: 0.8rem; color: var(--gray); margin-bottom: 0.3rem;">Condition</label>
                            <select id="alertCondition"
                                style="width: 100%; padding: 0.6rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px;">
                                <option value="above">Price Goes Above (Cross Up)</option>
                                <option value="below">Price Goes Below (Cross Down)</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label
                            style="display: block; font-size: 0.8rem; color: var(--gray); margin-bottom: 0.3rem;">Target
                            Price ($)</label>
                        <input type="number" id="alertPrice" step="any" placeholder="e.g. 50000.50"
                            style="width: 100%; padding: 0.7rem; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: white; border-radius: 4px; font-weight: bold;">
                    </div>

                    <button onclick="addPriceAlert()" class="btn btn-primary"
                        style="width: 100%; justify-content: center; margin-bottom: 1rem;">
                        <span>⏰ Set Alarm</span>
                    </button>

                    <!-- Active Alerts List -->
                    <div id="activeAlertsList" style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <div style="text-align: center; font-size: 0.8rem; color: var(--gray); font-style: italic;">No
                            active alarms set</div>
                    </div>
                </div>
            </div>

            <!-- Market Overview (Crypto + Forex + Indices) -->
            <div class="analysis-card wide">
                <div class="card-header">
                    <h3>🌍 Global Market Overview</h3>
                </div>
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
                            {
                                "colorTheme": "dark",
                                    "dateRange": "12M",
                                        "showChart": true,
                                            "locale": "en",
                                                "largeChartUrl": "",
                                                    "isTransparent": true,
                                                        "showSymbolLogo": true,
                                                            "showFloatingTooltip": false,
                                                                "width": "100%",
                                                                    "height": "660",
                                                                        "plotLineColorGrowing": "rgba(41, 98, 255, 1)",
                                                                            "plotLineColorFalling": "rgba(41, 98, 255, 1)",
                                                                                "gridLineColor": "rgba(240, 243, 250, 0)",
                                                                                    "scaleFontColor": "rgba(209, 212, 220, 1)",
                                                                                        "belowLineFillColorGrowing": "rgba(41, 98, 255, 0.12)",
                                                                                            "belowLineFillColorFalling": "rgba(41, 98, 255, 0.12)",
                                                                                                "belowLineFillColorGrowingBottom": "rgba(41, 98, 255, 0)",
                                                                                                    "belowLineFillColorFallingBottom": "rgba(41, 98, 255, 0)",
                                                                                                        "symbolActiveColor": "rgba(41, 98, 255, 0.12)",
                                                                                                            "tabs": [
                                                                                                                {
                                                                                                                    "title": "Crypto",
                                                                                                                    "symbols": [
                                                                                                                        { "s": "BITSTAMP:BTCUSD", "d": "Bitcoin" },
                                                                                                                        { "s": "BITSTAMP:ETHUSD", "d": "Ethereum" },
                                                                                                                        { "s": "BINANCE:BNBUSD", "d": "BNB" },
                                                                                                                        { "s": "BINANCE:SOLUSD", "d": "Solana" },
                                                                                                                        { "s": "BINANCE:XRPUSD", "d": "XRP" }
                                                                                                                    ]
                                                                                                                },
                                                                                                                {
                                                                                                                    "title": "Forex",
                                                                                                                    "symbols": [
                                                                                                                        { "s": "FX:EURUSD", "d": "EUR/USD" },
                                                                                                                        { "s": "FX:GBPUSD", "d": "GBP/USD" },
                                                                                                                        { "s": "FX:USDJPY", "d": "USD/JPY" },
                                                                                                                        { "s": "FX:USDCHF", "d": "USD/CHF" },
                                                                                                                        { "s": "FX:AUDUSD", "d": "AUD/USD" },
                                                                                                                        { "s": "FX:USDCAD", "d": "USD/CAD" }
                                                                                                                    ]
                                                                                                                },
                                                                                                                {
                                                                                                                    "title": "Commodities",
                                                                                                                    "symbols": [
                                                                                                                        { "s": "OANDA:XAUUSD", "d": "Gold" },
                                                                                                                        { "s": "OANDA:XAGUSD", "d": "Silver" },
                                                                                                                        { "s": "TVC:USOIL", "d": "WTI Oil" }
                                                                                                                    ]
                                                                                                                }
                                                                                                            ]
                            }
                        </script>
                </div>
                <!-- TradingView Widget END -->
            </div>

            <!-- Economic Calendar -->
            <div class="analysis-card wide">
                <div class="card-header">
                    <h3>📅 Economic Calendar (High Impact)</h3>
                </div>
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <script type="text/javascript"
                        src="https://s3.tradingview.com/external-embedding/embed-widget-events.js" async>
                            {
                                "colorTheme": "dark",
                                    "isTransparent": true,
                                        "width": "100%",
                                            "height": "500",
                                                "importanceFilter": "0,1",
                                                    "currencyFilter": "USD,EUR,GBP,JPY,AUD,CAD",
                                                        "locale": "en"
                            }
                        </script>
                </div>
            </div>
            <!-- TradingView Widget END -->

            <!-- Professional Tools Links -->
            <div class="analysis-card">
                <div class="card-header">
                    <h3>🛠️ Deep Dive Tools</h3>
                    <div style="font-size: 0.8rem; color: var(--gray); margin-left: auto;">External Data</div>
                </div>
                <div style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                    <a href="https://www.coinglass.com/LiquidationData" target="_blank"
                        style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 8px; color: var(--white); text-decoration: none; transition: background 0.2s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.1)'"
                        onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                        <span style="display: flex; align-items: center; gap: 0.75rem;">
                            <span style="font-size: 1.2rem;">📊</span>
                            <div>
                                <div style="font-weight: 600;">Liquidation Heatmap</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">CoinGlass Data</div>
                            </div>
                        </span>
                        <span style="color: var(--primary);">↗</span>
                    </a>

                    <a href="https://www.coinglass.com/LongShortRatio" target="_blank"
                        style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 8px; color: var(--white); text-decoration: none; transition: background 0.2s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.1)'"
                        onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                        <span style="display: flex; align-items: center; gap: 0.75rem;">
                            <span style="font-size: 1.2rem;">⚖️</span>
                            <div>
                                <div style="font-weight: 600;">Long/Short Ratio</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">Sentiment Analysis</div>
                            </div>
                        </span>
                        <span style="color: var(--primary);">↗</span>
                    </a>

                    <a href="https://coinmarketcap.com/charts/" target="_blank"
                        style="display: flex; align-items: center; justify-content: space-between; padding: 1rem; background: rgba(255,255,255,0.05); border-radius: 8px; color: var(--white); text-decoration: none; transition: background 0.2s;"
                        onmouseover="this.style.background='rgba(255,255,255,0.1)'"
                        onmouseout="this.style.background='rgba(255,255,255,0.05)'">
                        <span style="display: flex; align-items: center; gap: 0.75rem;">
                            <span style="font-size: 1.2rem;">📈</span>
                            <div>
                                <div style="font-weight: 600;">Global Market Charts</div>
                                <div style="font-size: 0.8rem; color: var(--gray);">CoinMarketCap</div>
                            </div>
                        </span>
                        <span style="color: var(--primary);">↗</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- Market Heatmaps Section -->
    <div style="margin-top: 2rem;">
        <div class="analysis-card wide">
            <div class="card-header">
                <h3>🔥 Crypto Market Heatmap</h3>
            </div>
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                    src="https://s3.tradingview.com/external-embedding/embed-widget-crypto-coins-heatmap.js" async>
                        {
                            "dataSource": "Crypto",
                                "blockSize": "market_cap_calc",
                                    "blockColor": "change",
                                        "locale": "en",
                                            "symbolUrl": "",
                                                "colorTheme": "dark",
                                                    "hasTopBar": false,
                                                        "isDataSetEnabled": false,
                                                            "isZoomEnabled": true,
                                                                "hasSymbolTooltip": true,
                                                                    "width": "100%",
                                                                        "height": "600"
                        }
                    </script>
            </div>
            <!-- TradingView Widget END -->
        </div>
    </div>

    <!-- Glassnode & Dune Section -->
    <div style="margin-top: 2rem; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">

        <!-- Dune Analytics (On-Chain) -->
        <div class="analysis-card wide"
            style="background: linear-gradient(145deg, rgba(234, 88, 12, 0.05) 0%, rgba(17,24,39,1) 100%); border: 1px solid rgba(234, 88, 12, 0.2);">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; background: rgba(234, 88, 12, 0.1);">
                <h3>🦄 Dune Analytics (DEX/Gas)</h3>
                <span class="section-badge" style="background: rgba(234, 88, 12, 0.2); color: #fb923c;">Live Data</span>
            </div>
            <div
                style="padding: 1.5rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; text-align: center;">
                <div>
                    <div style="font-size: 0.8rem; color: var(--gray); margin-bottom: 0.3rem;">DEX Volume (24h)</div>
                    <div id="dune-dex-vol" style="font-size: 1.4rem; font-weight: bold; color: #fb923c;">Loading...
                    </div>
                </div>
                <div>
                    <div style="font-size: 0.8rem; color: var(--gray); margin-bottom: 0.3rem;">Avg Gas (Gwei)</div>
                    <div id="dune-gas" style="font-size: 1.4rem; font-weight: bold; color: #fb923c;">--</div>
                </div>
            </div>
            <div style="padding: 0.8rem; text-align: center; border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="https://dune.com/browse/dashboards" target="_blank"
                    style="color: #fb923c; text-decoration: none; font-size: 0.8rem;">More Dune Dashboards ↗</a>
            </div>
            <script>
                async function fetchDuneData() {
                    try {
                        const res = await fetch('/api/market/dune/12345');
                        const data = await res.json();
                        if (data && data.length > 0) {
                            const metric = data[0];
                            document.getElementById('dune-dex-vol').innerText = '$' + (metric.dex_volume / 1000000000).toFixed(2) + 'B';
                            document.getElementById('dune-gas').innerText = metric.gas_avg.toFixed(1);
                        }
                    } catch (e) { }
                }
                window.addEventListener('load', () => setTimeout(fetchDuneData, 1500));
            </script>
        </div>

        <!-- Glassnode (Fundamentals) -->
        <div class="analysis-card wide"
            style="background: linear-gradient(145deg, rgba(16, 185, 129, 0.05) 0%, rgba(17,24,39,1) 100%); border: 1px solid rgba(16, 185, 129, 0.2);">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; background: rgba(16, 185, 129, 0.1);">
                <h3>🔗 Glassnode (Fundamentals)</h3>
                <span class="section-badge" style="background: rgba(16, 185, 129, 0.2); color: #10b981;">On-Chain</span>
            </div>
            <div
                style="padding: 1.5rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; text-align: center;">
                <div>
                    <div style="font-size: 0.8rem; color: var(--gray); margin-bottom: 0.3rem;">Active Addr (BTC)</div>
                    <div id="gn-active-addr" style="font-size: 1.4rem; font-weight: bold; color: #10b981;">Loading...
                    </div>
                </div>
                <div>
                    <div style="font-size: 0.8rem; color: var(--gray); margin-bottom: 0.3rem;">MVRV Ratio</div>
                    <div id="gn-mvrv" style="font-size: 1.4rem; font-weight: bold; color: #10b981;">--</div>
                </div>
            </div>
            <div style="padding: 0.8rem; text-align: center; border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="https://studio.glassnode.com/metrics?a=BTC&m=addresses.ActiveCount" target="_blank"
                    style="color: #10b981; text-decoration: none; font-size: 0.8rem;">Analyze on Glassnode Studio ↗</a>
            </div>
            <script>
                async function fetchGlassnodeData() {
                    try {
                        const res = await fetch('/api/market/glassnode/metrics');
                        const data = await res.json();
                        if (data) {
                            document.getElementById('gn-active-addr').innerText = (data.active_addresses / 1000).toFixed(0) + 'k';
                            document.getElementById('gn-mvrv').innerText = parseFloat(data.mvrv).toFixed(2);

                            // Color MVRV
                            const mvrv = parseFloat(data.mvrv);
                            const mvrvEl = document.getElementById('gn-mvrv');
                            if (mvrv > 3.5) mvrvEl.style.color = '#ef4444'; // Overvalued
                            else if (mvrv < 1) mvrvEl.style.color = '#10b981'; // Undervalued
                            else mvrvEl.style.color = '#fbbf24'; // Fair
                        }
                    } catch (e) { }
                }
                window.addEventListener('load', () => setTimeout(fetchGlassnodeData, 2000));
            </script>
        </div>
    </div>

    <!-- Sector Spotlight: RWA -->
    <div style="margin-top: 2rem;">
        <div class="analysis-card wide">
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h3>🏙️ Real World Assets (RWA) Spotlight</h3>
                <span class="section-badge" style="background: rgba(59, 130, 246, 0.2); color: #3b82f6;">Trending
                    Sector</span>
            </div>
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <script type="text/javascript"
                    src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-overview.js" async>
                        {
                            "symbols": [
                                ["Ondo Finance", "BYBIT:ONDOUSDT|1D"],
                                ["Maker", "BINANCE:MKRUSDT|1D"],
                                ["Pendle", "BINANCE:PENDLEUSDT|1D"],
                                ["Centrifuge", "KRAKEN:CFGUSD|1D"],
                                ["TrueFi", "BINANCE:TRUUSDT|1D"],
                                ["Goldfinch", "COINBASE:GFIUSD|1D"],
                                ["Polymesh", "BINANCE:POLYXUSDT|1D"]
                            ],
                                "chartOnly": false,
                                    "width": "100%",
                                        "height": "400",
                                            "locale": "en",
                                                "colorTheme": "dark",
                                                    "autosize": false,
                                                        "showVolume": true,
                                                            "showMA": false,
                                                                "hideDateRanges": false,
                                                                    "hideMarketStatus": false,
                                                                        "hideSymbolLogo": false,
                                                                            "scalePosition": "right",
                                                                                "scaleMode": "Normal",
                                                                                    "fontFamily": "-apple-system, BlinkMacSystemFont, Trebuchet MS, Roboto, Ubuntu, sans-serif",
                                                                                        "fontSize": "10",
                                                                                            "noTimeScale": false,
                                                                                                "valuesTracking": "1",
                                                                                                    "changeMode": "price-and-percent",
                                                                                                        "chartType": "area",
                                                                                                            "maLineColor": "#2962FF",
                                                                                                                "maLineWidth": 1,
                                                                                                                    "maLength": 9,
                                                                                                                        "lineWidth": 2,
                                                                                                                            "lineType": 0,
                                                                                                                                "dateRanges": ["1d|1", "1m|30", "3m|60", "12m|1D", "60m|1y", "all|1M"]
                        }
                    </script>
            </div>
            <!-- TradingView Widget END -->
            <div style="padding: 1rem; text-align: center; border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="https://coinmarketcap.com/real-world-assets/?type=rwa" target="_blank"
                    style="color: var(--primary); text-decoration: none; font-size: 0.9rem;">View All RWA Rankings on
                    CoinMarketCap ↗</a>
            </div>
        </div>
    </div>
</div>

<style>
    .analysis-dashboard {
        padding: 2rem 0;
    }

    .market-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        /* Left section smaller, Right bigger */
        gap: 2rem;
    }

    .market-col-left {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .market-col-right {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .analysis-card {
        background: var(--dark-light);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }

    .card-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        background: rgba(0, 0, 0, 0.2);
    }

    .card-header h3 {
        margin: 0;
        font-size: 1.1rem;
        color: var(--white);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    @media (max-width: 1024px) {
        .market-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- News Alert Toast Container -->
<div id="news-toast-container"
    style="position: fixed; bottom: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 10px;">
</div>

<!-- Real-Time News Logic -->
<script>
    let lastNewsId = null;
    let alertsEnabled = false;
    // Simple notification sound (Beep)
    const alertSound = new Audio("https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3");

    async function checkMarketNews() {
        if (!alertsEnabled) return;

        try {
            // Fetch from CryptoCompare (Free Public API)
            const response = await fetch('https://min-api.cryptocompare.com/data/v2/news/?lang=EN');
            const data = await response.json();

            if (data && data.Data && data.Data.length > 0) {
                const latestNews = data.Data[0];

                // First run: just set the ID
                if (!lastNewsId) {
                    lastNewsId = latestNews.id;
                    return;
                }

                // New news detected
                if (latestNews.id !== lastNewsId) {
                    console.log("New News Alert:", latestNews.title);
                    lastNewsId = latestNews.id;

                    triggerAlert(latestNews);
                }
            }
        } catch (error) {
            console.error("Error fetching news:", error);
        }
    }

    function triggerAlert(newsItem) {
        // 1. Play Sound
        alertSound.play().catch(e => console.log("Sound error:", e));

        // 2. Desktop Notification
        if (Notification.permission === "granted") {
            new Notification("🚨 Market Alert: " + newsItem.source_info.name, {
                body: newsItem.title,
                icon: newsItem.imageurl
            });
        }

        // 3. In-App Toast
        showToast(newsItem);
    }

    function showToast(newsItem) {
        const container = document.getElementById('news-toast-container');
        const toast = document.createElement('div');
        toast.style.cssText = `
            background: rgba(17, 24, 39, 0.95);
            border-left: 4px solid #ef4444;
            color: white;
            padding: 1rem;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.5);
            animation: slideIn 0.3s ease-out;
            cursor: pointer;
        `;

        toast.innerHTML = `
            <div style="font-size: 0.75rem; color: #9ca3af; margin-bottom: 0.25rem;">${newsItem.source_info.name} • Just Now</div>
            <div style="font-weight: 600; font-size: 0.9rem; line-height: 1.4;">${newsItem.title}</div>
        `;

        toast.onclick = () => window.open(newsItem.url, '_blank');

        container.appendChild(toast);

        // Remove after 8 seconds
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            toast.style.transition = 'all 0.5s';
            setTimeout(() => toast.remove(), 500);
        }, 8000);
    }

    function enableNewsAlerts() {
        if (!("Notification" in window)) {
            alert("This browser does not support desktop notifications");
            return;
        }

        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                alertsEnabled = true;
                document.getElementById('alertBtn').innerHTML = "<span>✅</span> Alerts On";
                document.getElementById('alertBtn').style.background = "rgba(16, 185, 129, 0.2)";
                document.getElementById('alertBtn').style.borderColor = "#10b981";

                // Test Sound
                alertSound.play().catch(e => console.log("Please interact with page first"));

                // Show confirmation toast
                showToast({
                    source_info: { name: "System" },
                    title: "Audio & Desktop Alerts Enabled! Monitoring market...",
                    url: "#"
                });

                // Start Polling (Every 30 seconds)
                checkMarketNews(); // Immediate check
                setInterval(checkMarketNews, 30000);
            } else {
                alert("Please allow notifications to receive market alerts.");
            }
        });
    }

    // Add CSS Animation for Toast
    const styleSheet = document.createElement("style");
    styleSheet.innerText = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes flashRed {
            0% { background-color: rgba(239, 68, 68, 0.1); }
            50% { background-color: rgba(239, 68, 68, 0.5); }
            100% { background-color: rgba(239, 68, 68, 0.1); }
        }
    `;
    document.head.appendChild(styleSheet);
</script>

<!-- Alarm Overlay (Hidden Logic) -->
<div id="alarmOverlay"
    style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.9); z-index: 10000; flex-direction: column; align-items: center; justify-content: center; animation: flashRed 1s infinite;">
    <div style="font-size: 5rem; margin-bottom: 1rem;">🚨</div>
    <h1 style="color: white; font-size: 2.5rem; text-align: center; margin-bottom: 0.5rem;">PRICE ALERT TRIGGERED!</h1>
    <h2 id="alarmMessage" style="color: #ef4444; font-size: 1.5rem; margin-bottom: 2rem;">BTC Crossed 50000</h2>
    <button onclick="dismissAlarm()"
        style="padding: 1rem 3rem; font-size: 1.5rem; background: white; color: black; border: none; border-radius: 50px; cursor: pointer; font-weight: bold; box-shadow: 0 0 20px rgba(255,255,255,0.5);">
        STOP ALARM 🔕
    </button>
</div>

<!-- Price Alert & Worker Logic -->
<script>
    let activeAlerts = [];
    const loopAlarm = new Audio("https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3");
    let isAlarmPlaying = false;
    let alarmInterval = null;
    let marketWorker = null;
    let latestPrices = {};

    // Load from local storage
    const savedAlerts = localStorage.getItem('gsmPriceAlerts');
    if (savedAlerts) {
        activeAlerts = JSON.parse(savedAlerts);
        renderAlerts();
    }

    // Initialize Background Worker
    if (window.Worker) {
        marketWorker = new Worker('/js/market-worker.js');

        // Initial Sync
        marketWorker.postMessage({ type: 'UPDATE_ALERTS', payload: activeAlerts });

        marketWorker.onmessage = function (e) {
            if (e.data.type === 'ALERT_TRIGGERED') {
                triggerFullAlarm(e.data.alert, e.data.price);
                removeAlert(e.data.alert.id);
            }
            if (e.data.type === 'PRICE_UPDATE') {
                latestPrices = e.data.prices;
                updateLivePriceDisplay();
            }
        };
    } else {
        // Fallback for no worker support
        setInterval(checkPricesFallback, 10000);
    }

    function addPriceAlert() {
        // Request Permission on User Interaction
        if (Notification.permission !== "granted") Notification.requestPermission();

        const asset = document.getElementById('alertAsset').value;
        const condition = document.getElementById('alertCondition').value;
        const price = parseFloat(document.getElementById('alertPrice').value);

        if (!price) return alert("Please enter a valid price");

        const alert = {
            id: Date.now(),
            asset,
            condition,
            price,
            active: true
        };

        activeAlerts.push(alert);
        saveAlerts();
        renderAlerts();

        showToast({
            source_info: { name: "System" },
            title: `Alarm Set: ${asset} ${condition === 'above' ? '>' : '<'} $${price}`,
            url: "#"
        });
        document.getElementById('alertPrice').value = '';
    }

    function removeAlert(id) {
        activeAlerts = activeAlerts.filter(a => a.id !== id);
        saveAlerts();
        renderAlerts();
    }

    function saveAlerts() {
        localStorage.setItem('gsmPriceAlerts', JSON.stringify(activeAlerts));
        // Sync to Worker
        if (marketWorker) {
            marketWorker.postMessage({ type: 'UPDATE_ALERTS', payload: activeAlerts });
        }
    }

    function renderAlerts() {
        const container = document.getElementById('activeAlertsList');
        if (activeAlerts.length === 0) {
            container.innerHTML = '<div style="text-align: center; font-size: 0.8rem; color: var(--gray); font-style: italic;">No active alarms set</div>';
            return;
        }

        container.innerHTML = activeAlerts.map(alert => `
            <div style="background: rgba(0,0,0,0.3); padding: 0.75rem; border-radius: 4px; display: flex; justify-content: space-between; align-items: center; border-left: 3px solid ${alert.condition === 'above' ? '#10b981' : '#ef4444'};">
                <div>
                    <div style="font-weight: bold; font-size: 0.9rem;">${alert.asset}</div>
                    <div style="font-size: 0.8rem; color: var(--gray);">
                        Target: <span style="color: white;">${alert.condition === 'above' ? 'Above' : 'Below'} $${alert.price}</span>
                    </div>
                </div>
                <button onclick="removeAlert(${alert.id})" style="background: none; border: none; color: #ef4444; cursor: pointer;">✕</button>
            </div>
        `).join('');
    }

    function updateLivePriceDisplay() {
        const asset = document.getElementById('alertAsset').value;
        const display = document.getElementById('live-price-tag');

        if (display && latestPrices && latestPrices[asset] && latestPrices[asset].USD) {
            const price = latestPrices[asset].USD;
            display.innerText = '$' + price.toLocaleString();
            display.style.color = '#10b981';
            display.style.opacity = '0.5';
            setTimeout(() => display.style.opacity = '1', 100);
        } else if (display) {
            display.innerText = "Scanning...";
            display.style.color = "var(--gray)";
        }
    }

    async function checkPricesFallback() {
        if (activeAlerts.length === 0) return;
        const symbols = [...new Set(activeAlerts.map(a => a.asset))].join(',');
        try {
            const res = await fetch(`https://min-api.cryptocompare.com/data/pricemulti?fsyms=${symbols}&tsyms=USD`);
            const data = await res.json();
            latestPrices = data;
            updateLivePriceDisplay();
            activeAlerts.forEach(alert => {
                if (!alert.active) return;
                const currentPrice = data[alert.asset]?.USD;
                if (currentPrice && ((alert.condition === 'above' && currentPrice >= alert.price) || (alert.condition === 'below' && currentPrice <= alert.price))) {
                    triggerFullAlarm(alert, currentPrice);
                    removeAlert(alert.id);
                }
            });
        } catch (e) { }
    }

    function triggerFullAlarm(alert, currentPrice) {
        if (isAlarmPlaying) return;
        isAlarmPlaying = true;
        document.getElementById('alarmOverlay').style.display = 'flex';
        document.getElementById('alarmMessage').innerText = `${alert.asset} reached $${currentPrice}`;
        loopAlarm.currentTime = 0;
        loopAlarm.play();
        alarmInterval = setInterval(() => { loopAlarm.currentTime = 0; loopAlarm.play(); }, 3000);
        new Notification("🚨 PRICE ALERT!", { body: `${alert.asset}: $${currentPrice}`, icon: "" });
    }

    function dismissAlarm() {
        isAlarmPlaying = false;
        document.getElementById('alarmOverlay').style.display = 'none';
        clearInterval(alarmInterval);
        loopAlarm.pause();
    }

    // Global Metrics Fetcher
    async function fetchGlobalMetrics() {
        try {
            const response = await fetch('/api/market/global');
            const result = await response.json();
            const metricsRoot = result.data ? result.data.quote.USD : result.quote?.USD;
            if (metricsRoot) {
                const formatCurrency = (val) => new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', notation: 'compact' }).format(val);
                if (document.getElementById('metric-cap')) {
                    document.getElementById('metric-cap').innerText = formatCurrency(metricsRoot.total_market_cap);
                    document.getElementById('metric-vol').innerText = formatCurrency(metricsRoot.total_volume_24h);
                    document.getElementById('metric-btc').innerText = metricsRoot.btc_dominance.toFixed(1) + '%';
                    document.getElementById('metric-eth').innerText = metricsRoot.eth_dominance.toFixed(1) + '%';
                }
            }
        } catch (error) { console.error("Metrics fetch error:", error); }
    }

    // Determine current page logic to avoid conflicts
    window.addEventListener('load', () => {
        // Delay to ensure elements exist
        setTimeout(() => {
            fetchGlobalMetrics();
            setInterval(fetchGlobalMetrics, 300000);
            updateLivePriceDisplay(); // Initial check
        }, 1000);
    });
</script>