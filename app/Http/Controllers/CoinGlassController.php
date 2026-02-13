<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CoinGlassController extends Controller
{
    private $baseUrl = 'https://open-api.coinglass.com/public/v2';

    /**
     * Fetch Liquidation Data (24h)
     */
    public function getLiquidations()
    {
        return Cache::remember('cg_liquidations', 300, function () { // Cache 5 mins
            $apiKey = env('COINGLASS_API_KEY');

            if (empty($apiKey)) {
                return $this->getDemoLiquidationData();
            }

            try {
                $response = Http::withHeaders(['coinglassSecret' => $apiKey])
                    ->get("{$this->baseUrl}/liquidation_history", [
                        'time_type' => 'all',
                        'symbol' => 'BTC'
                    ]);

                if ($response->successful() && $response->json('success')) {
                    return $response->json('data');
                }
                return $this->getDemoLiquidationData();
            } catch (\Exception $e) {
                return $this->getDemoLiquidationData();
            }
        });
    }

    /**
     * Fetch Long/Short Ratio
     */
    public function getLongShortRatio()
    {
        return Cache::remember('cg_longshort', 300, function () { // Cache 5 mins
            $apiKey = env('COINGLASS_API_KEY');

            if (empty($apiKey)) {
                return $this->getDemoLongShortData();
            }

            try {
                $response = Http::withHeaders(['coinglassSecret' => $apiKey])
                    ->get("{$this->baseUrl}/long_short_global", [ // Example endpoint
                        'symbol' => 'BTC',
                        'time_type' => 'h24'
                    ]);

                if ($response->successful() && $response->json('success')) {
                    return $response->json('data');
                }
                return $this->getDemoLongShortData();
            } catch (\Exception $e) {
                return $this->getDemoLongShortData();
            }
        });
    }

    /**
     * Fetch Open Interest
     */
    public function getOpenInterest()
    {
        return Cache::remember('cg_open_interest', 300, function () {
            $apiKey = env('COINGLASS_API_KEY');

            if (empty($apiKey))
                return $this->getDemoOIData();

            try {
                $response = Http::withHeaders(['coinglassSecret' => $apiKey])
                    ->get("{$this->baseUrl}/open_interest", [
                        'symbol' => 'BTC'
                    ]);

                if ($response->successful() && $response->json('success')) {
                    return $response->json('data');
                }
                return $this->getDemoOIData();
            } catch (\Exception $e) {
                return $this->getDemoOIData();
            }
        });
    }

    // --- Demo Data Generators (Fallback) ---

    private function getDemoLiquidationData()
    {
        return [
            'demo' => true,
            'total_liq' => 145000000 + rand(100000, 5000000), // ~145M
            'long_liq' => 98000000,
            'short_liq' => 47000000
        ];
    }

    private function getDemoLongShortData()
    {
        return [
            'demo' => true,
            'longRatio' => 52.4,
            'shortRatio' => 47.6,
            'list' => [
                ['symbol' => 'BTC', 'longRate' => 51.2, 'shortRate' => 48.8],
                ['symbol' => 'ETH', 'longRate' => 49.5, 'shortRate' => 50.5],
                ['symbol' => 'SOL', 'longRate' => 62.1, 'shortRate' => 37.9]
            ]
        ];
    }

    private function getDemoOIData()
    {
        return [
            'demo' => true,
            'total_oi' => 34500000000, // 34B
            'change_24h' => 2.5
        ];
    }
}
