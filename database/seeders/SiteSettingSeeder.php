<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'site_name' => 'GSM Trading Lab',
            'site_logo' => 'https://i.ibb.co/3ykG88h/gsm-logo.png',
            'contact_email' => 'info@gsmtradinglab.com',
            'contact_phone' => '+44 7478 035502',
            'whatsapp_number' => '447478035502',
            'facebook_link' => 'https://facebook.com/gsmtradinglab',
            'instagram_link' => 'https://instagram.com/gsmtradinglab',
            'twitter_link' => 'https://twitter.com/gsmtradinglab',
            'tiktok_link' => 'https://tiktok.com/@gsmtradinglab',
            'threads_link' => 'https://threads.net/@gsmtradinglab',
            'snapchat_link' => 'https://snapchat.com/add/gsmtradinglab',
            'discord_link' => 'https://discord.gg/gsmtradinglab',
            'linkedin_link' => 'https://linkedin.com/in/gsmtradinglab',
        ];

        foreach ($settings as $key => $value) {
            \App\Models\SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
