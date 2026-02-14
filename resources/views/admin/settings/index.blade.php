@extends('layouts.admin')

@section('title', 'Site Settings')
@section('header', 'Site Settings')

@section('content')
    <div class="card" style="max-width: 900px;">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                <!-- General Info -->
                <div>
                    <h3
                        style="margin-bottom: 1.5rem; color: var(--primary); border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem;">
                        General Information</h3>

                    <div class="form-group">
                        <label class="form-label">Site Name</label>
                        <input type="text" name="site_name" class="form-input" value="{{ $settings['site_name'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Site Logo URL</label>
                        <input type="text" name="site_logo" class="form-input" value="{{ $settings['site_logo'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact Email</label>
                        <input type="email" name="contact_email" class="form-input"
                            value="{{ $settings['contact_email'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact Phone</label>
                        <input type="text" name="contact_phone" class="form-input"
                            value="{{ $settings['contact_phone'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">WhatsApp Number (eg: 447478035502)</label>
                        <input type="text" name="whatsapp_number" class="form-input"
                            value="{{ $settings['whatsapp_number'] ?? '' }}">
                    </div>

                    <h3
                        style="margin-top: 2rem; margin-bottom: 1.5rem; color: var(--primary); border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem;">
                        Academy Information</h3>

                    <div class="form-group">
                        <label class="form-label">Zoom Meeting Link</label>
                        <input type="url" name="zoom_meeting_link" class="form-input"
                            value="{{ $settings['zoom_meeting_link'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Class Schedule</label>
                        <input type="text" name="class_schedule" class="form-input"
                            value="{{ $settings['class_schedule'] ?? '' }}">
                    </div>

                    <div class="form-group"
                        style="background: rgba(16, 185, 129, 0.05); padding: 1.5rem; border-radius: 8px; border: 1px solid rgba(16, 185, 129, 0.2); margin-top: 1rem;">
                        <label class="form-label" style="color: #10B981; font-weight: bold;">📢 Scrolling Announcement
                            (Patti)</label>
                        <textarea name="announcement_ticker" class="form-input" style="height: 80px;"
                            placeholder="Yahan wo message likhain jo dono dashboards par patti ki tarah chalay ga...">{{ $settings['announcement_ticker'] ?? '' }}</textarea>
                        <small style="color: var(--gray); display: block; margin-top: 5px;">Ye message Admin aur Student
                            portal par scroll kare ga.</small>
                    </div>

                    <div class="form-group"
                        style="background: rgba(239, 68, 68, 0.05); padding: 1.5rem; border-radius: 8px; border: 1px solid rgba(239, 68, 68, 0.2); margin-top: 1rem;">
                        <label class="form-label" style="color: #ef4444; font-weight: bold;">📢 Second Announcement
                            (Optional)</label>
                        <textarea name="announcement_ticker_2" class="form-input" style="height: 80px;"
                            placeholder="Dosri patti ka message yahan likhain (Optional)...">{{ $settings['announcement_ticker_2'] ?? '' }}</textarea>
                        <small style="color: var(--gray); display: block; margin-top: 5px;">Ye message doosri line ma
                            chalay ga.</small>
                    </div>
                </div>

                <!-- Social Links -->
                <div>
                    <h3
                        style="margin-bottom: 1.5rem; color: var(--primary); border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 0.5rem;">
                        Social Media Links</h3>

                    <div class="form-group">
                        <label class="form-label">Facebook Link</label>
                        <input type="url" name="facebook_link" class="form-input"
                            value="{{ $settings['facebook_link'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Instagram Link</label>
                        <input type="url" name="instagram_link" class="form-input"
                            value="{{ $settings['instagram_link'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Twitter / X Link</label>
                        <input type="url" name="twitter_link" class="form-input"
                            value="{{ $settings['twitter_link'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Threads Link</label>
                        <input type="url" name="threads_link" class="form-input"
                            value="{{ $settings['threads_link'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">TikTok Link</label>
                        <input type="url" name="tiktok_link" class="form-input"
                            value="{{ $settings['tiktok_link'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Snapchat Link</label>
                        <input type="url" name="snapchat_link" class="form-input"
                            value="{{ $settings['snapchat_link'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Telegram Link</label>
                        <input type="url" name="telegram_link" class="form-input"
                            value="{{ $settings['telegram_link'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">Save All Settings</button>
            </div>
        </form>
    </div>
@endsection