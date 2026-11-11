<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'event_date',
        'location',
        'summary',
        'content',
        'image',
        'is_published',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_published' => 'boolean',
    ];
}
