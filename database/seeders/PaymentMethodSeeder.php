<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Bitcoin (BTC)',
                'account_number' => 'bc1q03nmsngcpwck9lah9uqkx3z84rfstgyc599hmf',
                'bank_name' => 'Bitcoin',
                'network' => 'Bitcoin',
                'icon' => 'https://cryptologos.cc/logos/bitcoin-btc-logo.png',
                'instruction' => 'Send only BTC to this address.',
                'is_active' => true,
            ],
            [
                'name' => 'Ethereum (ETH)',
                'account_number' => '0xf5c6f9ad0a30e968dd82d3b18e726d11a9007a85',
                'bank_name' => 'Ethereum',
                'network' => 'ERC20',
                'icon' => 'https://cryptologos.cc/logos/ethereum-eth-logo.png',
                'instruction' => 'Send only ETH to this address.',
                'is_active' => true,
            ],
            [
                'name' => 'Solana (SOL)',
                'account_number' => 'C2w5KgYMCrVcm62XihK6prHDyXay2fEcpTXgHSU4FoqV',
                'bank_name' => 'Solana',
                'network' => 'Solana',
                'icon' => 'https://cryptologos.cc/logos/solana-sol-logo.png',
                'instruction' => 'Send only SOL to this address.',
                'is_active' => true,
            ],
            [
                'name' => 'BNB Smart Chain',
                'account_number' => '0xf5c6f9ad0a30e968dd82d3b18e726d11a9007a85',
                'bank_name' => 'BNB',
                'network' => 'BEP20',
                'icon' => 'https://cryptologos.cc/logos/bnb-bnb-logo.png',
                'instruction' => 'Send only BNB (BEP20) to this address.',
                'is_active' => true,
            ],
            [
                'name' => 'USDT (Tron)',
                'account_number' => 'TFjdAsb8yVgtNNU1ozMLXAyFq9Cvk3MbeB',
                'bank_name' => 'Tether',
                'network' => 'TRC20',
                'icon' => 'https://cryptologos.cc/logos/tether-usdt-logo.png',
                'instruction' => 'Send only USDT (TRC20) to this address. Using other networks may result in loss of funds.',
                'is_active' => true,
            ],
            [
                'name' => 'USDT (Ethereum)',
                'account_number' => '0xf5c6f9ad0a30e968dd82d3b18e726d11a9007a85',
                'bank_name' => 'Tether',
                'network' => 'ERC20',
                'icon' => 'https://cryptologos.cc/logos/tether-usdt-logo.png',
                'instruction' => 'Send only USDT (ERC20) to this address.',
                'is_active' => true,
            ],
            [
                'name' => 'USDT (BSC)',
                'account_number' => '0xf5c6f9ad0a30e968dd82d3b18e726d11a9007a85',
                'bank_name' => 'Tether',
                'network' => 'BEP20',
                'icon' => 'https://cryptologos.cc/logos/tether-usdt-logo.png',
                'instruction' => 'Send only USDT (BEP20) to this address.',
                'is_active' => true,
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}
