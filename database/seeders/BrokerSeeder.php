<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Broker;

class BrokerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brokers = [
            [
                'name' => 'Binance',
                'referral_link' => 'https://accounts.binance.com/register?ref=GSMBINANCE',
                'logo_path' => 'https://upload.wikimedia.org/wikipedia/commons/1/12/Binance_logo.svg',
                'description' => "World's Leading Exchange\nLowest Fees",
                'is_recommended' => true,
            ],
            [
                'name' => 'MEXC',
                'referral_link' => 'https://www.mexc.com/acquisition/custom-sign-up?shareCode=mexc-gsmtrading',
                'logo_path' => 'https://public.mexc.com/static/mexc-logo.png',
                'description' => "No KYC Required\nHigh Leverage",
                'is_recommended' => false,
            ],
            [
                'name' => 'Fasset',
                'referral_link' => 'https://play.google.com/store/apps/details?id=com.fasset.cashapp',
                'logo_path' => 'https://fasset.com/assets/images/logo/fasset-logo.svg',
                'description' => "Smart Investments\nExciting Rewards\nCode: XYJXV7G",
                'is_recommended' => false,
            ],
            [
                'name' => 'BingX',
                'referral_link' => '#',
                'logo_path' => 'https://assets.coingecko.com/markets/images/812/large/bingx_logo.png?1654854592',
                'description' => "Social Trading Network\nForex & Crypto",
                'is_recommended' => false,
            ],
            [
                'name' => 'XM',
                'referral_link' => '#',
                'logo_path' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/XM_Logo.svg/1200px-XM_Logo.svg.png',
                'description' => "Global Forex Broker\n$30 No Deposit Bonus",
                'is_recommended' => false,
            ],
            [
                'name' => 'Exness',
                'referral_link' => '#',
                'logo_path' => 'https://upload.wikimedia.org/wikipedia/commons/f/f3/Exness_logo.svg',
                'description' => "Instant Withdrawals\nTight Spreads",
                'is_recommended' => false,
            ],
        ];

        foreach ($brokers as $broker) {
            Broker::create($broker);
        }
    }
}
