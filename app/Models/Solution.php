<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'category',
        'overview',
        'description',
        'image',
        'deliverables',
        'benefits',
        'sort_order',
    ];

    protected $casts = [
        'deliverables' => 'array',
        'benefits' => 'array',
        'sort_order' => 'integer',
    ];
}
