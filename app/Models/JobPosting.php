<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $fillable = [
        'title',
        'department',
        'location',
        'type',
        'description',
        'salary',
        'experience_level',
        'deadline',
        'requirements',
        'benefits',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'deadline' => 'date',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
