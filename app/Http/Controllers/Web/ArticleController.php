<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Jobs\FetchNewsJob;
use App\Models\Article;

class ArticleController extends Controller
{
    public function fetch()
    {
        try{
        FetchNewsJob::dispatch();
        return back()->with('success', 'Fetching started...');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to start fetching: ' . $e->getMessage()); 
            }
    }
    public function index()
    {
        try {
        $articles = Article::latest()->paginate(10);
        return view('articles.index', compact('articles'));
        } catch (\Exception $e) {
        return back()->with('error', 'Failed to load articles: ' . $e->getMessage()); 
        }
    }
}

