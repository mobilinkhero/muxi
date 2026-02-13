<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function getLatestNews()
    {
        // Cache for 15 minutes. Key updated to force refresh.
        return Cache::remember('crypto_news_feed_v2', 900, function () {
            $news = [];

            // Helper to fetch RSS with User-Agent
            $fetchRss = function ($url) {
                try {
                    $response = Http::withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                    ])->timeout(10)->get($url);

                    if ($response->successful()) {
                        return simplexml_load_string($response->body(), 'SimpleXMLElement', LIBXML_NOCDATA);
                    }
                } catch (\Exception $e) {
                    // Log error if needed: \Log::error("RSS Fetch Error for $url: " . $e->getMessage());
                }
                return null;
            };

            // 1. CoinTelegraph
            $xml = $fetchRss('https://cointelegraph.com/rss');
            if ($xml && isset($xml->channel->item)) {
                foreach ($xml->channel->item as $item) {
                    $namespaces = $item->getNamespaces(true);
                    $media = $item->children($namespaces['media'] ?? null);
                    $img = '';

                    if ($media && isset($media->content)) {
                        $img = (string) $media->content->attributes()->url;
                    }

                    if (!$img) {
                        preg_match('/<img[^>]+src="([^">]+)"/', (string) $item->description, $match);
                        $img = $match[1] ?? 'https://cointelegraph.com/assets/img/share.png';
                    }

                    $news[] = [
                        'title' => (string) $item->title,
                        'link' => (string) $item->link,
                        'source' => 'CoinTelegraph',
                        'time' => strtotime((string) $item->pubDate),
                        'date_human' => \Carbon\Carbon::parse((string) $item->pubDate)->diffForHumans(),
                        'image' => $img,
                        'color' => '#fabf2c'
                    ];
                }
            }

            // 2. CoinDesk
            $xml = $fetchRss('https://www.coindesk.com/arc/outboundfeeds/rss/');
            if ($xml && isset($xml->channel->item)) {
                foreach ($xml->channel->item as $item) {
                    $namespaces = $item->getNamespaces(true);
                    $media = $item->children($namespaces['media'] ?? null); // CoinDesk sometimes uses media:content
                    $img = '';

                    if ($media && isset($media->content)) {
                        $img = (string) $media->content->attributes()->url;
                    }

                    if (!$img) {
                        // Try to find image in description or use placeholder
                        preg_match('/<img[^>]+src="([^">]+)"/', (string) $item->description, $match);
                        $img = $match[1] ?? 'https://www.coindesk.com/resizer/Placeholder.jpg';
                    }

                    $news[] = [
                        'title' => (string) $item->title,
                        'link' => (string) $item->link,
                        'source' => 'CoinDesk',
                        'time' => strtotime((string) $item->pubDate),
                        'date_human' => \Carbon\Carbon::parse((string) $item->pubDate)->diffForHumans(),
                        'image' => $img,
                        'color' => '#00d46a'
                    ];
                }
            }

            // 3. Decrypt (Fallback)
            $xml = $fetchRss('https://decrypt.co/feed');
            if ($xml && isset($xml->channel->item)) {
                foreach ($xml->channel->item as $item) {
                    $namespaces = $item->getNamespaces(true);
                    $media = $item->children($namespaces['media'] ?? null);
                    $img = '';
                    if ($media && isset($media->content)) {
                        $img = (string) $media->content->attributes()->url;
                    }

                    $news[] = [
                        'title' => (string) $item->title,
                        'link' => (string) $item->link,
                        'source' => 'Decrypt',
                        'time' => strtotime((string) $item->pubDate),
                        'date_human' => \Carbon\Carbon::parse((string) $item->pubDate)->diffForHumans(),
                        'image' => $img ?: 'https://decrypt.co/wp-content/themes/decrypt-media/assets/images/decrypt-logo-promo.png',
                        'color' => '#a5b4fc'
                    ];
                }
            }


            // Sort by time DESC
            usort($news, function ($a, $b) {
                return $b['time'] - $a['time'];
            });

            return array_slice($news, 0, 15);
        });
    }
}
