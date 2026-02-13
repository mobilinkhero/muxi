<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    use HasFactory;

    protected $fillable = [
        'symbol',
        'type',
        'entry_price',
        'stop_loss',
        'take_profit_1',
        'take_profit_2',
        'take_profit_3',
        'status',
        'result',
        'notes',
    ];
}
