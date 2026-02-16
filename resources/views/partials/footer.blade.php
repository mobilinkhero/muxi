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
        <!-- Disclaimer Section -->
        <div class="animate-slide-up"
            style="margin-top: 3rem; padding: 2rem; background: rgba(0, 0, 0, 0.4); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 12px; text-align: center; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
            <h4
                style="color: #F59E0B; margin-bottom: 0.5rem; font-size: 1.3rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem; text-shadow: 0 0 10px rgba(245, 158, 11, 0.3);">
                <span style="font-size: 1.5rem;">⚠️</span> Trading Disclaimer
            </h4>
            <h5 style="color: var(--secondary); margin-bottom: 1.5rem; font-size: 1rem; letter-spacing: 1px;">
                🚨 EDUCATIONAL PURPOSE ONLY
            </h5>

            <div style="font-size: 0.95rem; color: var(--gray); line-height: 1.8; max-width: 900px; margin: 0 auto;">
                <p style="margin-bottom: 1rem; color: var(--white);">
                    GSM Trading Lab par share ki gayi tamam information, analysis, strategies, aur learning content sirf
                    <strong>education aur awareness</strong> ke liye hai.
                </p>

                <p
                    style="margin-bottom: 1rem; color: #ef4444; font-weight: 500; background: rgba(239, 68, 68, 0.1); padding: 0.5rem; border-radius: 6px; display: inline-block;">
                    📊 Financial markets extremely volatile aur risky hoti hain. Trading me profit bhi ho sakta hai aur
                    loss bhi ho sakta hai.
                </p>

                <div
                    style="text-align: left; max-width: 700px; margin: 1.5rem auto; background: rgba(255,255,255,0.03); padding: 1.5rem; border-radius: 8px;">
                    <p style="margin-bottom: 1rem;">🧠 <strong>Yahan jo bhi concepts, analysis, ya trading ideas share
                            ki jati hain:</strong></p>
                    <ul style="list-style: none; padding-left: 0;">
                        <li style="margin-bottom: 0.5rem;">👉 Ye kisi bhi tarah ki <strong>financial advice nahi
                                hain</strong></li>
                        <li>👉 Ye sirf mera personal trading experience aur market learning journey hai</li>
                    </ul>
                </div>

                <p style="margin-bottom: 1rem; color: var(--primary-light);">
                    📚 GSM Trading Lab ka mission sirf traders ko markets samjhana, educate karna, aur learning
                    environment provide karna hai.
                </p>

                <div
                    style="margin: 1.5rem 0; padding: 1rem; border-left: 3px solid var(--accent); background: rgba(245, 158, 11, 0.05); text-align: left;">
                    <p style="font-weight: 600; margin-bottom: 0.5rem; color: var(--white);">💼 Har trader ki financial
                        situation, risk tolerance, aur decision making alag hoti hai. Is liye:</p>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.3rem;">✔ Apni research khud karein</li>
                        <li style="margin-bottom: 0.3rem;">✔ Apni risk management follow karein</li>
                        <li>✔ Trading decisions apni responsibility par lein</li>
                    </ul>
                </div>

                <p style="margin-bottom: 1rem; font-style: italic; color: var(--gray-light);">
                    ⚖️ GSM Trading Lab kisi bhi individual ke trading profit ya loss ka zimmedar nahi hoga.
                </p>

                <p
                    style="margin-top: 2rem; color: var(--white); font-weight: 600; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem;">
                    🌍 Join GSM Trading Lab to learn, grow, and understand markets — <span
                        style="color: var(--secondary);">responsibly and professionally.</span>
                </p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2026 GSM Trading Lab. A global multi-market trading learning community built on real market
                experience. <br> Learning. Trading. Growing Together.</p>
            <p style="margin-top: 0.5rem; font-size: 0.8rem; color: var(--gray-dark); opacity: 0.7;">Built on real
                market experience and trader education.</p>
        </div>
    </div>
</footer>