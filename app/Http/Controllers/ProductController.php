<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products with filtering, search, and pagination.
     */
    public function index(Request $request): View
    {
        $categories = Category::whereNull('parent_id')
            ->with(['subcategories' => function ($q) {
                $q->withCount('products');
            }])
            ->withCount('products')
            ->orderBy('sort_order')
            ->get();

        $query = Product::with(['category', 'subcategory'])->where('status', 'active');

        // Filter by search keyword
        if ($request->filled('q')) {
            $keyword = trim($request->input('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('model_code', 'like', "%{$keyword}%")
                  ->orWhere('tagline', 'like', "%{$keyword}%")
                  ->orWhere('short_description', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        // Filter by category slug
        if ($request->filled('category')) {
            $categorySlug = $request->input('category');
            $query->where(function ($q) use ($categorySlug) {
                $q->whereHas('category', function ($cq) use ($categorySlug) {
                    $cq->where('slug', $categorySlug);
                })->orWhereHas('subcategory', function ($sq) use ($categorySlug) {
                    $sq->where('slug', $categorySlug);
                });
            });
        }

        // Filter specifically by subcategory slug
        if ($request->filled('subcategory')) {
            $subSlug = $request->input('subcategory');
            $query->whereHas('subcategory', function ($q) use ($subSlug) {
                $q->where('slug', $subSlug);
            });
        }

        // Filter by featured
        if ($request->boolean('featured')) {
            $query->where('is_featured', true);
        }

        // Filter by new
        if ($request->boolean('new')) {
            $query->where('is_new', true);
        }

        // Sorting
        $sort = $request->input('sort', 'featured');
        switch ($sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'featured':
            default:
                $query->orderBy('is_featured', 'desc')->orderBy('id', 'asc');
                break;
        }

        $products = $query->paginate(9)->withQueryString();

        $currentCategory = null;
        if ($request->filled('category')) {
            $currentCategory = Category::where('slug', $request->input('category'))->first();
        }

        $currentSubcategory = null;
        if ($request->filled('subcategory')) {
            $currentSubcategory = Category::where('slug', $request->input('subcategory'))->first();
        }

        return view('pages.products.index', compact('products', 'categories', 'currentCategory', 'currentSubcategory'));
    }

    /**
     * Display the specified product.
     */
    public function show(string $slug): View
    {
        $product = Product::with(['category', 'subcategory'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->take(3)
            ->get();

        return view('pages.products.show', compact('product', 'relatedProducts'));
    }

    /**
     * Display a printable official technical datasheet.
     */
    public function datasheet(string $slug): View
    {
        $product = Product::with(['category', 'subcategory'])->where('slug', $slug)->firstOrFail();
        return view('pages.products.datasheet', compact('product'));
    }

    /**
     * Compare two or more medical equipment models side by side.
     */
    public function compare(Request $request): View
    {
        $allProducts = Product::select('id', 'name', 'model_code', 'category_id', 'slug')
            ->where('status', 'active')
            ->orderBy('name')
            ->get();

        $selectedIds = array_filter(explode(',', (string) $request->input('models', '')));

        if (empty($selectedIds)) {
            // Default to first 2 products for an immediate comparison preview
            $selectedProducts = Product::with(['category', 'subcategory'])->where('status', 'active')->take(2)->get();
        } else {
            $selectedProducts = Product::with(['category', 'subcategory'])
                ->whereIn('id', $selectedIds)
                ->where('status', 'active')
                ->get();
        }

        return view('pages.products.compare', compact('allProducts', 'selectedProducts'));
    }
}
