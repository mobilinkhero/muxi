<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'role',
        'bio',
        'image_url',
        'linkedin_url',
        'twitter_url',
        'facebook_url',
        'instagram_url',
        'threads_url',
        'youtube_url',
        'tiktok_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
