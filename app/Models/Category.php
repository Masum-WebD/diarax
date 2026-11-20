<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'icon',
        'short_description',
        'image',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'parent_id' => 'integer',
    ];

    /**
     * Parent category relation (if this is a subcategory).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Subcategories relation.
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order', 'asc');
    }

    /**
     * Alias for subcategories.
     */
    public function children(): HasMany
    {
        return $this->subcategories();
    }

    /**
     * Products assigned directly to this main category.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * Products assigned specifically to this subcategory.
     */
    public function subcategoryProducts(): HasMany
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

    /**
     * Check if category is a root / main category.
     */
    public function isRoot(): bool
    {
        return is_null($this->parent_id);
    }

    /**
     * Check if category is a subcategory.
     */
    public function isSubcategory(): bool
    {
        return !is_null($this->parent_id);
    }

    /**
     * Scope to only root categories.
     */
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope to only subcategories.
     */
    public function scopeSubcategories($query)
    {
        return $query->whereNotNull('parent_id');
    }
}
