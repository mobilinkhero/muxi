<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P2PTransaction extends Model
{
    use HasFactory;

    protected $table = 'p2p_transactions';

    protected $fillable = [
        'user_id',
        'type',
        'asset',
        'fiat_currency',
        'amount_asset',
        'amount_fiat',
        'rate',
        'status',
        'proof_image',
        'user_payment_details',
        'admin_notes',
    ];


    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
