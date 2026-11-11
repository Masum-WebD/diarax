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
        $categories = Category::withCount('products')->orderBy('sort_order')->get();

        $query = Product::with('category')->where('status', 'active');

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
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
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

        return view('pages.products.index', compact('products', 'categories', 'currentCategory'));
    }

    /**
     * Display the specified product.
     */
    public function show(string $slug): View
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->take(3)
            ->get();

        return view('pages.products.show', compact('product', 'relatedProducts'));
    }
}
