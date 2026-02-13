<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P2PPool extends Model
{
    use HasFactory;

    protected $table = 'p2p_pools';

    protected $fillable = [
        'asset',
        'balance',
        'buy_rate',
        'sell_rate',
        'wallet_details',
        'is_active',
    ];
}
