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
                        <label class="form-label">Twitter/X Link</label>
                        <input type="url" name="twitter_link" class="form-input"
                            value="{{ $settings['twitter_link'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">YouTube Link</label>
                        <input type="url" name="youtube_link" class="form-input"
                            value="{{ $settings['youtube_link'] ?? '' }}">
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