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
        'salary_range',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
