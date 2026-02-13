// Market Data Worker for Background Monitoring
let activeAlerts = [];
const WATCHLIST = ['BTC', 'ETH', 'SOL', 'XRP', 'BNB', 'DOGE', 'XAU'];

self.onmessage = function (e) {
    if (e.data.type === 'UPDATE_ALERTS') {
        activeAlerts = e.data.payload || [];
    }
};

// Poll Loop (Independent of Main Thread Throttling)
setInterval(async () => {
    // Combine watchlist and alert assets to fetch all needed prices
    const assetsToFetch = [...new Set([...activeAlerts.map(a => a.asset), ...WATCHLIST])];

    if (assetsToFetch.length === 0) return;

    const symbols = assetsToFetch.join(',');

    try {
        // Fetch prices
        const res = await fetch(`https://min-api.cryptocompare.com/data/pricemulti?fsyms=${symbols}&tsyms=USD`);
        const data = await res.json();

        // 1. Check Alerts
        activeAlerts.forEach(alert => {
            if (!alert.active) return;
            const currentPrice = data[alert.asset]?.USD;

            if (currentPrice) {
                let triggered = false;
                if (alert.condition === 'above' && currentPrice >= alert.price) triggered = true;
                if (alert.condition === 'below' && currentPrice <= alert.price) triggered = true;

                if (triggered) {
                    self.postMessage({
                        type: 'ALERT_TRIGGERED',
                        alert: alert,
                        price: currentPrice
                    });
                }
            }
        });

        // 2. Broadcast Prices for UI
        self.postMessage({
            type: 'PRICE_UPDATE',
            prices: data
        });

    } catch (e) {
        // console.error("Worker poll failed", e);
    }
}, 5000); // Poll every 5 seconds
