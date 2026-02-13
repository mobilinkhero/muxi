<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'service_name',
        'amount',
        'currency',
        'status',
        'payment_method',
        'transaction_id',
        'screenshot_path',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
