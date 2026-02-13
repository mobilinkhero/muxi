<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-section">
                <h4 class="logo" style="font-size: 1.5rem;">
                    <a href="/" class="logo">
                        <img src="{{ asset('images/logo.svg') }}" alt="GSM Trading Lab"
                            style="height: 40px; margin-bottom: 1rem;">
                    </a>
                    <p style="color: var(--gray-light); margin-top: 1rem;">
                        Your trusted partner in multi-market trading education, professional signals, and comprehensive
                        market analysis.
                    </p>
            </div>
            <div class="footer-section">
                <h4>Markets</h4>
                <ul class="footer-links">
                    <li><a href="/learn">Cryptocurrency</a></li>
                    <li><a href="/learn">Forex Trading</a></li>
                    <li><a href="/learn">Stocks & Indices</a></li>
                    <li><a href="/learn">Commodities & Derivatives</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <ul class="footer-links">
                    <li><a href="/#about">About Us</a></li>
                    <li><a href="#">Our Team</a></li>
                    <li><a href="/contact">Careers</a></li>
                    <li><a href="/learn">Blog</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul class="footer-links">
                    <li><a href="/help">Help Center</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                    <li><a href="/privacy-policy">Privacy Policy</a></li>
                    <li><a href="/terms-of-service">Terms of Service</a></li>
                </ul>
            </div>
        </div>

        <!-- Social Media Links (Integrated from Trade page) -->
        <div style="text-align: center; margin: 3rem 0;">
            <h3 style="color: var(--white); margin-bottom: 1.5rem; font-size: 1.5rem;">🚀 Follow Us On Social Media</h3>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                <!-- YouTube -->
                <a href="{{ $settings['youtube_link'] ?? 'https://youtube.com/@gsmtradinglab' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube" width="40"
                        height="40">
                    <span style="font-size: 0.8rem; color: var(--gray);">YouTube</span>
                </a>
                <!-- Telegram -->
                <a href="{{ $settings['telegram_link'] ?? 'https://t.me/gsmtradinglab' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/82/Telegram_logo.svg" alt="Telegram"
                        width="40" height="40">
                    <span style="font-size: 0.8rem; color: var(--gray);">Telegram</span>
                </a>
                <!-- Facebook -->
                <a href="{{ $settings['facebook_link'] ?? 'https://facebook.com/gsmtradinglab' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" width="40"
                        height="40">
                    <span style="font-size: 0.8rem; color: var(--gray);">Facebook</span>
                </a>
                <!-- Instagram -->
                <a href="{{ $settings['instagram_link'] ?? 'https://instagram.com/gsmtradinglab' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" width="40"
                        height="40">
                    <span style="font-size: 0.8rem; color: var(--gray);">Instagram</span>
                </a>
                <!-- Threads -->
                <a href="{{ $settings['threads_link'] ?? 'https://threads.net/@gsmtradinglab' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://cdn-icons-png.flaticon.com/512/10856/10856184.png" alt="Threads" width="40"
                        height="40" style="filter: invert(1);">
                    <span style="font-size: 0.8rem; color: var(--gray);">Threads</span>
                </a>
                <!-- Twitter/X -->
                <a href="{{ $settings['twitter_link'] ?? 'https://twitter.com/gsmtradinglab' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://cdn-icons-png.flaticon.com/512/5968/5968830.png" alt="X" width="40" height="40"
                        style="filter: invert(1);">
                    <span style="font-size: 0.8rem; color: var(--gray);">X (Twitter)</span>
                </a>
                <!-- TikTok -->
                <a href="{{ $settings['tiktok_link'] ?? 'https://tiktok.com/@gsmtradinglab' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://cdn-icons-png.flaticon.com/512/3046/3046121.png" alt="TikTok" width="40"
                        height="40" style="filter: invert(1);">
                    <span style="font-size: 0.8rem; color: var(--gray);">TikTok</span>
                </a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 GSM Trading Lab. All rights reserved. | Empowering traders across all markets worldwide.</p>
        </div>
    </div>
</footer>