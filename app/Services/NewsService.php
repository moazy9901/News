<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsService
{
    protected string $url = 'https://newsapi.org/v2/everything';
    public function fetchAndStore()
    {
        try {
            $response = Http::get($this->url, [
                'q' => 'bitcoin',
                'apiKey' => config('services.newsapi.key'),
            ]);

            if (!$response->successful()) {
                throw new \Exception('API request failed');
            }

            $articles = $response->json()['articles'] ?? [];

            foreach ($articles as $item) {

                Article::updateOrCreate(
                    ['url' => $item['url']?? null],
                    [
                        'source_name'=>$item['source']['name']?? null,
                        'author'=>$item['author']?? null,
                        'title'=>$item['title']?? null,
                        'description'=>$item['description']?? null,
                        'url'=>$item['url']?? null,
                        'image'=>$item['urlToImage']?? null,
                        'published_at'=>$item['publishedAt']?? null,
                        'content'=>$item['content']?? null,
                    ]
                );
            }

        } catch (\Exception $e) {
            Log::error('News Fetch Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch news: ' . $e->getMessage()], 500);
        }
    }
}
