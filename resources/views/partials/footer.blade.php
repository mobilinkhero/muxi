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
        <!-- Risk Disclaimer Button & Modal -->
        <div style="text-align: center; margin-top: 3rem; margin-bottom: 2rem;">
            <button onclick="document.getElementById('disclaimerModal').style.display='flex'" class="btn-glow"
                style="background: transparent; border: 1px solid rgba(255,255,255,0.1); color: var(--gray); padding: 0.8rem 2rem; border-radius: 50px; cursor: pointer; transition: all 0.3s; font-size: 0.9rem; letter-spacing: 1px;">
                ⚠️ RISK DISCLAIMER
            </button>
        </div>

        <!-- Disclaimer Modal -->
        <div id="disclaimerModal"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
            <div class="animate-slide-up"
                style="background: #1e293b; width: 90%; max-width: 600px; padding: 2.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); position: relative; max-height: 90vh; overflow-y: auto;">

                <!-- Close Button -->
                <button onclick="document.getElementById('disclaimerModal').style.display='none'"
                    style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; color: var(--gray); font-size: 1.5rem; cursor: pointer;">&times;</button>

                <h3
                    style="color: #F59E0B; margin-bottom: 1.5rem; font-size: 1.4rem; display: flex; align-items: center; gap: 0.8rem;">
                    <i class="fas fa-exclamation-triangle"></i> Important Risk Warning
                </h3>

                <div style="color: var(--gray-light); font-size: 0.95rem; line-height: 1.7; text-align: left;">
                    <p style="margin-bottom: 1rem;"><strong>General Risk Warning:</strong> Trading in financial markets
                        (Cryptocurrency, Forex, Stocks, Indices, Commodities, Derivatives) involves a high degree of
                        risk and may not be suitable for all investors. The high degree of leverage available can work
                        against you as well as for you. Before deciding to trade, you should carefully consider your
                        investment objectives, level of experience, and risk appetite.</p>

                    <p style="margin-bottom: 1rem;"><strong>No Financial Advice:</strong> The content provided by GSM
                        Trading Lab, including but not limited to market analysis, trading signals, educational videos,
                        and strategies, is for <strong>educational and informational purposes only</strong>. It should
                        not be construed as financial or investment advice. You act on this information at your own
                        risk.</p>

                    <p style="margin-bottom: 1rem;"><strong>Loss of Capital:</strong> There is a possibility that you
                        could sustain a loss of some or all of your initial investment; therefore, you should not invest
                        money that you cannot afford to lose. You should be aware of all the risks associated with
                        financial trading and seek advice from an independent financial advisor if you have any doubts.
                    </p>

                    <div
                        style="background: rgba(239, 68, 68, 0.1); border-left: 3px solid #ef4444; padding: 1rem; margin-top: 1.5rem;">
                        <p style="margin-bottom: 0; color: #ef4444; font-size: 0.9rem;"><strong>Liability
                                Disclaimer:</strong> GSM Trading Lab and its founders accept no liability for any loss
                            or damage, including without limitation to, any loss of profit, which may arise directly or
                            indirectly from use of or reliance on such information.</p>
                    </div>
                </div>

                <div style="margin-top: 2rem; text-align: center;">
                    <button onclick="document.getElementById('disclaimerModal').style.display='none'"
                        class="btn btn-secondary" style="width: 100%;">
                        I Understand & Accept
                    </button>
                </div>
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