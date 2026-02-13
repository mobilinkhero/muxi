<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveClass extends Model
{
    protected $fillable = ['title', 'meeting_link', 'scheduled_at', 'duration_minutes', 'status'];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function attendees()
    {
        return $this->hasMany(LiveClassAttendee::class);
    }
}
