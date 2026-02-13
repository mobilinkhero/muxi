<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveClassAttendee extends Model
{
    protected $fillable = ['user_id', 'live_class_id', 'joined_at', 'left_at', 'stay_duration_minutes', 'status'];

    protected $casts = [
        'joined_at' => 'datetime',
        'left_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function liveClass()
    {
        return $this->belongsTo(LiveClass::class);
    }
}
