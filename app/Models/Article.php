<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'name',
        'author',
        'title',
        'description',
        'url',
        'image',
        'published_at',
        'content',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
