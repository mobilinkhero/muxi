@extends('layouts.admin')

@section('title', 'System Protocols')

@section('content')
    <div class="h-reveal">
        <header style="margin-bottom: 2.5rem;">
            <h2 style="margin: 0; font-weight: 900; font-size: 2rem; letter-spacing: -1px; color: white;">System Protocols
            </h2>
            <p style="color: #94A3B8; margin-top: 5px;">Configure core application parameters and global variables.</p>
        </header>

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem;">
                <!-- General Parameters -->
                <div class="h-card">
                    <h3
                        style="margin-bottom: 2rem; font-size: 1.1rem; display: flex; align-items: center; gap: 10px; color: var(--h-primary);">
                        <i class="fas fa-server"></i> Core Parameters
                    </h3>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="h-label">Environment Name (Site Name)</label>
                        <input type="text" name="site_name" class="h-input" value="{{ $settings['site_name'] ?? '' }}"
                            placeholder="GSM Trading Lab">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="h-label">Node Asset URL (Site Logo)</label>
                        <input type="text" name="site_logo" class="h-input" value="{{ $settings['site_logo'] ?? '' }}"
                            placeholder="https://example.com/logo.png">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div style="margin-bottom: 1.5rem;">
                            <label class="h-label">Support Email</label>
                            <input type="email" name="contact_email" class="h-input"
                                value="{{ $settings['contact_email'] ?? '' }}">
                        </div>
                        <div style="margin-bottom: 1.5rem;">
                            <label class="h-label">Comm Line (Phone)</label>
                            <input type="text" name="contact_phone" class="h-input"
                                value="{{ $settings['contact_phone'] ?? '' }}">
                        </div>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="h-label">WhatsApp Gateway (Numeric Only)</label>
                        <input type="text" name="whatsapp_number" class="h-input"
                            value="{{ $settings['whatsapp_number'] ?? '' }}" placeholder="447478035502">
                    </div>
                </div>

                <!-- Academy & Broadcast -->
                <div class="h-card">
                    <h3
                        style="margin-bottom: 2rem; font-size: 1.1rem; display: flex; align-items: center; gap: 10px; color: var(--h-secondary);">
                        <i class="fas fa-broadcast-tower"></i> Academy Broadcast
                    </h3>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="h-label">Stream Uplink (Zoom Link)</label>
                        <input type="url" name="zoom_meeting_link" class="h-input"
                            value="{{ $settings['zoom_meeting_link'] ?? '' }}" placeholder="https://zoom.us/j/...">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="h-label">Chronos Schedule (Class Timing)</label>
                        <input type="text" name="class_schedule" class="h-input"
                            value="{{ $settings['class_schedule'] ?? '' }}" placeholder="Mon - Fri, 9 PM PKT">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="h-label">Global Notification Pulse (Ticker 1)</label>
                        <textarea name="announcement_ticker" class="h-input" style="height: 100px; resize: none;"
                            placeholder="Standard scrolling message for all dashboards...">{{ $settings['announcement_ticker'] ?? '' }}</textarea>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="h-label">Secondary Pulse (Ticker 2)</label>
                        <textarea name="announcement_ticker_2" class="h-input" style="height: 100px; resize: none;"
                            placeholder="Secondary scrolling message...">{{ $settings['announcement_ticker_2'] ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Social Matrix -->
                <div class="h-card" style="grid-column: 1 / -1;">
                    <h3
                        style="margin-bottom: 2rem; font-size: 1.1rem; display: flex; align-items: center; gap: 10px; color: var(--h-accent);">
                        <i class="fas fa-share-nodes"></i> Social Matrix Integration
                    </h3>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                        <div>
                            <label class="h-label"><i class="fab fa-facebook"></i> Facebook Endpoint</label>
                            <input type="url" name="facebook_link" class="h-input"
                                value="{{ $settings['facebook_link'] ?? '' }}">
                        </div>
                        <div>
                            <label class="h-label"><i class="fab fa-instagram"></i> Instagram Endpoint</label>
                            <input type="url" name="instagram_link" class="h-input"
                                value="{{ $settings['instagram_link'] ?? '' }}">
                        </div>
                        <div>
                            <label class="h-label"><i class="fab fa-twitter"></i> X / Twitter Endpoint</label>
                            <input type="url" name="twitter_link" class="h-input"
                                value="{{ $settings['twitter_link'] ?? '' }}">
                        </div>
                        <div>
                            <label class="h-label"><i class="fab fa-telegram"></i> Telegram Endpoint</label>
                            <input type="url" name="telegram_link" class="h-input"
                                value="{{ $settings['telegram_link'] ?? '' }}">
                        </div>
                        <div>
                            <label class="h-label"><i class="fab fa-tiktok"></i> TikTok Endpoint</label>
                            <input type="url" name="tiktok_link" class="h-input"
                                value="{{ $settings['tiktok_link'] ?? '' }}">
                        </div>
                        <div>
                            <label class="h-label"><i class="fab fa-snapchat"></i> Snapchat Endpoint</label>
                            <input type="url" name="snapchat_link" class="h-input"
                                value="{{ $settings['snapchat_link'] ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 3rem; margin-bottom: 5rem; display: flex; justify-content: flex-end;">
                <button type="submit" class="btn-primary-h" style="padding: 1.25rem 4rem; font-size: 1.1rem;">
                    <i class="fas fa-save"></i> Commit All Protocol Changes
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            gsap.to('.h-reveal', {
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.2,
                ease: "power4.out"
            });
        });
    </script>
@endsection