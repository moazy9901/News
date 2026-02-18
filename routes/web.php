<?php

use App\Http\Controllers\Web\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::post('/articles/fetch', [ArticleController::class, 'fetch'])->name('articles.fetch');

