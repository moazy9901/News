<?php

namespace App\Services;

use App\Models\Article;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class NewsService
{
    protected string $url = 'https://newsapi.org/v2/everything';
    protected Client $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://newsapi.org/',
            'timeout'  => 10.0,
        ]);
    }

    public function fetchAndStore()
    {
        try {
            $response = $this->client->get('v2/everything', [
                'query' => [
                    'q' => 'bitcoin',
                    'apiKey' => config('services.newsapi.key'),
                ]
            ]);
            if ($response->getStatusCode() !== 200) {
                throw new \Exception('API request failed');
            }
            $body = json_decode($response->getBody()->getContents(), true);
            $articles = $body['articles'] ?? [];
            foreach ($articles as $item) {
                if (empty($item['url'])) {
                    continue;
                }
                Article::updateOrCreate(
                    ['url' => $item['url']],
                    [
                        'source_name'  => $item['source']['name'] ?? null,
                        'author'       => $item['author'] ?? null,
                        'title'        => $item['title'] ?? null,
                        'description'  => $item['description'] ?? null,
                        'image'        => $item['urlToImage'] ?? null,
                        'published_at' => $item['publishedAt'] ?? null,
                        'content'      => $item['content'] ?? null,
                    ]
                );
            }
            return true;

        } catch (\Exception $e) {
            Log::error('News Fetch Error: ' . $e->getMessage());
            throw $e;
        }
    }
}