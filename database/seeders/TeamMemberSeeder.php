<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\TeamMember::truncate();

        \App\Models\TeamMember::create([
            'name' => 'Mr. GSM',
            'role' => 'Founder & Owner',
            'bio' => 'Visionary leader behind GSM Trading Lab.',
            'linkedin_url' => 'https://linkedin.com/in/gsmtradinglab',
            'twitter_url' => 'https://twitter.com/gsmtradinglab',
            'facebook_url' => 'https://facebook.com/gsmtradinglab',
            'instagram_url' => 'https://instagram.com/gsmtradinglab',
            'threads_url' => 'https://threads.net/@gsmtradinglab',
            'youtube_url' => 'https://youtube.com/@gsmtradinglab',
            'tiktok_url' => 'https://tiktok.com/@gsmtradinglab',
            'is_active' => true,
        ]);
    }
}
