<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'referral_link',
        'logo_path',
        'description',
        'is_recommended',
    ];

    protected $casts = [
        'is_recommended' => 'boolean',
    ];
}
