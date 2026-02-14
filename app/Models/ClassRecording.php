<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRecording extends Model
{
    protected $fillable = [
        'title',
        'description',
        'video_url',
        'thumbnail_url',
        'published_at',
        'is_active',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
