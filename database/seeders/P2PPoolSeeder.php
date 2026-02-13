<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\P2PPool;

class P2PPoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        P2PPool::updateOrCreate(
            ['asset' => 'USDT'],
            [
                'balance' => 1000.00, // Initial Pool Balance
                'buy_rate' => 280.50, // Buying from users at this rate
                'sell_rate' => 285.00, // Selling to users at this rate
                'wallet_details' => 'TRC20: TBvTrC20AddressExample123456',
                'is_active' => true,
            ]
        );

        P2PPool::updateOrCreate(
            ['asset' => 'PKR'],
            [
                'balance' => 500000.00, // Initial Fiat Reserve
                'buy_rate' => 1.0,
                'sell_rate' => 1.0,
                'wallet_details' => 'Bank Transfer: Meezan Bank, AC: 123456789',
                'is_active' => true,
            ]
        );
    }
}
