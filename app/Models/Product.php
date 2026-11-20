<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'name',
        'model_code',
        'slug',
        'tagline',
        'short_description',
        'description',
        'image',
        'gallery',
        'features',
        'specifications',
        'applications',
        'brochure_pdf',
        'is_featured',
        'is_new',
        'status',
        'certified_quality',
        'regulatory_standard',
        'warranty',
    ];

    protected $casts = [
        'gallery' => 'array',
        'features' => 'array',
        'specifications' => 'array',
        'applications' => 'array',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'category_id' => 'integer',
        'subcategory_id' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
