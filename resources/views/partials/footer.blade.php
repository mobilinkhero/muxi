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
                        {{ $settings['footer_about'] ?? 'Your trusted partner in multi-market trading education, professional signals, and comprehensive market analysis.' }}
                    </p>
            </div>
            <div class="footer-section">
                <h4>Markets</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('markets.crypto') }}">Cryptocurrency</a></li>
                    <li><a href="{{ route('markets.forex') }}">Forex Trading</a></li>
                    <li><a href="{{ route('markets.stocks') }}">Stocks & Indices</a></li>
                    <li><a href="{{ route('markets.commodities') }}">Commodities & Derivatives</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Company</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('company.about') }}">About Us</a></li>
                    <li><a href="{{ route('company.team') }}">Our Team</a></li>
                    <li><a href="{{ route('company.careers') }}">Careers</a></li>
                    <li><a href="{{ route('company.blog') }}">Blog</a></li>
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

        <!-- Social Media Links -->
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
                <!-- Snapchat -->
                <a href="{{ $settings['snapchat_link'] ?? 'https://snapchat.com/add/gsmtradinglab' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://cdn-icons-png.flaticon.com/512/3670/3670166.png" alt="Snapchat" width="40"
                        height="40">
                    <span style="font-size: 0.8rem; color: var(--gray);">Snapchat</span>
                </a>
                <!-- Discord -->
                <a href="{{ $settings['discord_link'] ?? 'https://discord.gg/gsmtradinglab' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://cdn-icons-png.flaticon.com/512/3670/3670157.png" alt="Discord" width="40"
                        height="40" style="filter: invert(1);">
                    <span style="font-size: 0.8rem; color: var(--gray);">Discord</span>
                </a>
                <!-- LinkedIn -->
                <a href="{{ $settings['linkedin_link'] ?? 'https://linkedin.com/in/gsmtradinglab' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://cdn-icons-png.flaticon.com/512/3536/3536505.png" alt="LinkedIn" width="40"
                        height="40">
                    <span style="font-size: 0.8rem; color: var(--gray);">LinkedIn</span>
                </a>
                <!-- WhatsApp -->
                <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '447478035502' }}" target="_blank"
                    style="text-decoration: none; transition: transform 0.2s; display: flex; flex-direction: column; align-items: center; gap: 0.5rem;"
                    onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                    <img src="https://cdn-icons-png.flaticon.com/512/3670/3670051.png" alt="WhatsApp" width="40"
                        height="40">
                    <span style="font-size: 0.8rem; color: var(--gray);">WhatsApp</span>
                </a>
            </div>
        </div>

        <!-- Disclaimer Section -->
        <div
            style="margin-top: 3rem; padding: 2rem; background: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 12px; text-align: center;">
            <h4
                style="color: #F59E0B; margin-bottom: 1rem; font-size: 1.2rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                ⚠️ Disclaimer & Financial Disclosure
            </h4>
            <div style="font-size: 0.9rem; color: var(--gray); line-height: 1.8; max-width: 1000px; margin: 0 auto;">
                <p style="margin-bottom: 1rem; color: var(--gray-light);">
                    <strong>Roman Urdu:</strong> Is website per jo bhi information ya signals share kiye jaty hain, woh
                    sirf mera <strong>Personal Experience</strong> aur educational purposes ke liye hain. Yeh koi
                    professional financial advice nahi hai. Trading aur investment mein hamesha risk hota hai, isliye
                    apne risk ko khud manage karein. Kisi bhi qism ke profit ya loss ki zimmedari website ki nahi hogi.
                </p>
                <div style="width: 50px; height: 1px; background: rgba(255,255,255,0.1); margin: 1rem auto;"></div>
                <p>
                    <strong>English:</strong> All content, including signals and educational materials, is based on
                    personal experience and intended for educational purposes only. It does <strong>NOT</strong>
                    constitute financial advice. Trading in financial markets involves significant risk. GSM Trading Lab
                    is not responsible for any financial gains or losses. Please manage your risk appropriately.
                </p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 GSM Trading Lab. All rights reserved. | Empowering traders across all markets worldwide.</p>
        </div>
    </div>
</footer>