<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BlogPost::truncate();

        $posts = [
            [
                'title' => 'Mastering Bitcoin: The Future of Digital Finance',
                'slug' => 'mastering-bitcoin-future-finance',
                'content' => "Bitcoin continues to redefine the global financial landscape. As the pioneer of cryptocurrency, it offers a decentralized alternative to traditional banking. 

In this comprehensive guide, we explore the fundamental mechanics of blockchain technology, the halving cycles that drive scarcity, and the institutional adoption that is propelling Bitcoin to new heights. Whether you are a HODLer or a day trader, understanding these core concepts is essential for navigating the volatile yet rewarding world of crypto assets.

**Key Takeaways:**
- **Decentralization:** No central authority controls your enhanced financial sovereignty.
- **Scarcity:** With a cap of 21 million coins, Bitcoin is often referred to as 'Digital Gold'.
- **Security:** The Proof-of-Work consensus mechanism makes the network incredibly secure.",
                'image_url' => 'https://images.unsplash.com/photo-1518546305927-5a555bb7020d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Forex Trading Strategies for Beginners',
                'slug' => 'forex-trading-strategies-beginners',
                'content' => "The Foreign Exchange (Forex) market is the largest and most liquid financial market in the world, with trillions of dollars traded daily. 

Success in Forex doesn't come from luck; it comes from discipline and strategy. This article breaks down three essential trading strategies for beginners: Scalping, Day Trading, and Swing Trading. We also delve into the importance of risk management—never risking more than 1-2% of your capital on a single trade.

**Strategies Covered:**
1. **Price Action:** Reading raw price movements without lagging indicators.
2. **Trend Following:** Identifying and riding the market's momentum.
3. **Fundamental Analysis:** How economic news impacts currency pairs.",
                'image_url' => 'https://images.unsplash.com/photo-1611974765270-ca12586343bb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Gold: The Ultimate Hedge Against Inflation',
                'slug' => 'gold-hedge-against-inflation',
                'content' => "For centuries, Gold (XAU/USD) has been the go-to asset for wealth preservation. In times of economic uncertainty and rising inflation, investors flock to the yellow metal.

But what drives the price of Gold today? It's a complex interplay of the US Dollar strength, geopolitical tensions, and central bank buying. We analyze the current market trends and provide technical levels to watch for potential entry points. Understanding these correlations is key to profitable commodities trading.

**Why Trade Gold?**
- **Safe Haven:** Protects capital during market crashes.
- **Diversification:** Low correlation with stocks and bonds.
- **Liquidity:** Easy to buy and sell globally.",
                'image_url' => 'https://images.unsplash.com/photo-1610375461246-83df859cd871?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Navigating the Stock Market: Tech Sector Boom',
                'slug' => 'stock-market-tech-sector-boom',
                'content' => "The technology sector remains the powerhouse of the stock market. From AI advancements to cloud computing, tech giants are driving major indices like the NASDAQ and S&P 500.

However, high valuations raise concerns about a potential bubble. In this post, we analyze the earnings reports of top tech companies and evaluate whether the current growth trajectory is sustainable. We also discuss how interest rates affect growth stocks and finding value in a crowded market.

**Sector Highlights:**
- **AI Revolution:** How companies like NVIDIA and Microsoft are leading the charge.
- **Earnings Season:** What the numbers really tell us about market health.
- **Long-term Outlook:** Positioning your portfolio for the next decade.",
                'image_url' => 'https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_published' => true,
                'published_at' => now()->subDays(8),
            ],
            [
                'title' => 'Demystifying Derivatives: Options & Futures',
                'slug' => 'demystifying-derivatives-options-futures',
                'content' => "Derivatives are powerful financial instruments that derive their value from an underlying asset. While often viewed as risky, they are essential tools for hedging and speculation.

We simplify the concepts of Options (Calls and Puts) and Futures contracts. Learn how professional traders use these instruments to manage risk exposure and capitalize on market volatility without owning the underlying asset directly. A must-read for anyone looking to level up their trading game.

**What You'll Learn:**
- **Leverage:** Controlling large positions with small capital.
- **Hedging:** Insuring your portfolio against downside risk.
- **Speculation:** Profiting from market direction prediction.",
                'image_url' => 'https://images.unsplash.com/photo-1642543492481-44e81e3914a7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($posts as $post) {
            \App\Models\BlogPost::create($post);
        }
    }
}
