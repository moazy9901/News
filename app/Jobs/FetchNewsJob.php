<?php

namespace App\Jobs;

use App\Services\NewsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class FetchNewsJob implements ShouldQueue
{
    use Queueable;

    public function handle(NewsService $newsService): void
    {
        try {
            $newsService->fetchAndStore();
        } catch (\Exception $e) {
            Log::error('Failed to fetch news: ' . $e->getMessage());
            throw $e;
        }
    }
}
