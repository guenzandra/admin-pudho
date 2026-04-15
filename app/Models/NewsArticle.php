<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'author',
        'category',
        'tags',
        'image',
        'date',
    ];

    protected $casts = [
        'tags' => 'array',
        'date' => 'date',
    ];
}