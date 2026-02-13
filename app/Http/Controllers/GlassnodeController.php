<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GlassnodeController extends Controller
{
    private $baseUrl = 'https://api.glassnode.com/v1';

    // Fetch Key On-Chain Metrics
    public function getMetrics()
    {
        return Cache::remember('glassnode_metrics', 3600, function () { // Cache 1 hour
            $apiKey = env('GLASSNODE_API_KEY');

            if (empty($apiKey)) {
                return $this->getDemoData();
            }

            try {
                // Fetch Active Addresses (Example)
                $activeAddr = $this->fetchMetric('addresses/active_count');
                $mvrv = $this->fetchMetric('market/mvrv');
                $exchangeFlow = $this->fetchMetric('transactions/transfers_volume_to_exchanges_sum');

                return [
                    'active_addresses' => $activeAddr,
                    'mvrv' => $mvrv,
                    'exchange_inflow' => $exchangeFlow,
                    'demo' => false
                ];
            } catch (\Exception $e) {
                return $this->getDemoData();
            }
        });
    }

    private function fetchMetric($endpoint)
    {
        $apiKey = env('GLASSNODE_API_KEY');
        $response = Http::get("{$this->baseUrl}/metrics/{$endpoint}", [
            'api_key' => $apiKey,
            'a' => 'BTC',
            'i' => '24h',
            'limit' => 1 // Latest
        ]);

        if ($response->successful() && !empty($response->json())) {
            $data = $response->json();
            return end($data)['v'] ?? 0;
        }
        return 0;
    }

    private function getDemoData()
    {
        return [
            'active_addresses' => 950000 + rand(-20000, 50000), // ~950k
            'mvrv' => 1.85 + (rand(-10, 10) / 100), // ~1.85
            'exchange_inflow' => 25000 + rand(-5000, 15000), // BTC
            'demo' => true
        ];
    }
}
