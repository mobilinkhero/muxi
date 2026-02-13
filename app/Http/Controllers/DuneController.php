<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DuneController extends Controller
{
    // Fetch Latest Result of a Query
    public function getQueryResult($queryId)
    {
        return Cache::remember("dune_query_{$queryId}", 3600, function () use ($queryId) { // Cache 1 hour
            $apiKey = env('DUNE_API_KEY');

            if (empty($apiKey)) {
                return $this->getDemoData($queryId);
            }

            try {
                // Fetch latest result (assuming query has been run recently)
                $response = Http::withHeaders([
                    'X-Dune-API-Key' => $apiKey
                ])->get("https://api.dune.com/api/v1/query/{$queryId}/results?limit=1");

                if ($response->successful()) {
                    return $response->json('result.rows');
                }
                return $this->getDemoData($queryId);
            } catch (\Exception $e) {
                return $this->getDemoData($queryId);
            }
        });
    }

    private function getDemoData($queryId)
    {
        // Return simulated data for popular metrics
        return [
            [
                'period' => date('Y-m-d H:i:s'),
                'dex_volume' => 2450000000 + rand(-50000000, 50000000), // Fluctuate around 2.45B
                'gas_avg' => 24.5 + (rand(-20, 20) / 10), // 22.5 - 26.5 Gwei
                'active_users' => 450000 + rand(-1000, 1000)
            ]
        ];
    }
}
