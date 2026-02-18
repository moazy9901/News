<?php

namespace App\Jobs;

use App\Services\NewsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchNewsJob implements ShouldQueue
{
    use Queueable;

    public function handle(NewsService $newsService): void
    {
        $newsService->fetchAndStore();
    }
}
