<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MarketController extends Controller
{
    /**
     * Fetch Global Market Metrics from CoinMarketCap and cache it.
     */
    public function getGlobalMetrics()
    {
        // Cache the response for 10 minutes (600 seconds) to avoid rate limits
        $data = Cache::remember('cmc_global_metrics', 600, function () {

            $apiKey = env('COINMARKETCAP_API_KEY');

            // Fallback for demo if no key provided
            if (empty($apiKey)) {
                return [
                    'status' => ['error_code' => 0],
                    'data' => [
                        'quote' => [
                            'USD' => [
                                'total_market_cap' => 2450000000000,
                                'total_volume_24h' => 85000000000,
                                'btc_dominance' => 52.4,
                                'eth_dominance' => 18.1
                            ]
                        ]
                    ]
                ];
            }

            try {
                $response = Http::withHeaders([
                    'X-CMC_PRO_API_KEY' => $apiKey,
                    'Accept' => 'application/json',
                ])->get('https://pro-api.coinmarketcap.com/v1/global-metrics/quotes/latest');

                if ($response->successful()) {
                    return $response->json();
                }

                return null;
            } catch (\Exception $e) {
                return null;
            }
        });

        if (!$data) {
            return response()->json(['error' => 'Failed to fetch market data'], 503);
        }

        return response()->json($data);
    }
}
