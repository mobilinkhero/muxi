<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassProgress extends Model
{
    protected $fillable = [
        'user_id',
        'class_recording_id',
        'progress_percentage',
        'watch_time_seconds',
        'is_completed',
        'last_watched_at',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'last_watched_at' => 'datetime',
    ];

    public function recording()
    {
        return $this->belongsTo(ClassRecording::class);
    }
}
