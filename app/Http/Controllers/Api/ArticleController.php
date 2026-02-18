<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\FetchNewsJob;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function fetch()
    {
        try{
        FetchNewsJob::dispatch();
        return response()->json(['message' => 'Fetching started']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to start fetching: ' . $e->getMessage()], 500);
        }
    }

    public function index()
    {
        try {
            $articles = Article::latest()->paginate(10);
            return response()->json($articles);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load articles: ' . $e->getMessage()], 500);
        }
    }
}

