<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Solution;
use App\Models\NewsArticle;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the Dixion portal homepage.
     */
    public function index(Request $request): View
    {
        $categories = Category::withCount('products')
            ->orderBy('sort_order')
            ->get();

        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->where('status', 'active')
            ->take(8)
            ->get();

        $allProductsForTabs = Product::with('category')
            ->where('status', 'active')
            ->orderBy('id', 'asc')
            ->take(12)
            ->get();

        $solutions = Solution::orderBy('sort_order')
            ->take(3)
            ->get();

        $latestNews = NewsArticle::where('is_published', true)
            ->orderBy('event_date', 'desc')
            ->take(3)
            ->get();

        $banners = Banner::where('status', 'active')
            ->orderBy('sort_order', 'asc')
            ->get();

        $showEntrance = $request->query('entrance') === 'splash';

        return view('pages.home', compact(
            'categories',
            'featuredProducts',
            'allProductsForTabs',
            'solutions',
            'latestNews',
            'banners',
            'showEntrance'
        ));
    }

    /**
     * Display the About Us page.
     */
    public function about(): View
    {
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $solutionsCount = Solution::count();

        return view('pages.about', compact('categoriesCount', 'productsCount', 'solutionsCount'));
    }

    /**
     * Display Service & Support page.
     */
    public function serviceSupport(): View
    {
        return view('pages.service-support');
    }

    /**
     * Display Downloads page.
     */
    public function downloads(): View
    {
        $products = Product::where('status', 'active')->orderBy('name')->get();
        return view('pages.downloads', compact('products'));
    }

    /**
     * Display Turnkey Solutions overview.
     */
    public function solutions(): View
    {
        $solutions = Solution::orderBy('sort_order')->get();
        return view('pages.solutions', compact('solutions'));
    }

    /**
     * Display a specific Turnkey Solution detail.
     */
    public function solutionDetail(string $slug): View
    {
        $solution = Solution::where('slug', $slug)->firstOrFail();
        $otherSolutions = Solution::where('id', '!=', $solution->id)->get();
        return view('pages.solution-detail', compact('solution', 'otherSolutions'));
    }

    /**
     * Display News and Events page.
     */
    public function news(): View
    {
        $news = NewsArticle::where('is_published', true)
            ->orderBy('event_date', 'desc')
            ->paginate(6);

        return view('pages.news', compact('news'));
    }

    /**
     * Display Contact Us page.
     */
    public function contact(): View
    {
        $categories = Category::all();
        $products = Product::select('id', 'name', 'model_code')->get();
        return view('pages.contact', compact('categories', 'products'));
    }

    /**
     * Display Request a Quote page.
     */
    public function quote(Request $request): View
    {
        $categories = Category::all();
        $products = Product::select('id', 'name', 'model_code')->get();
        $preselectedProductId = $request->query('product_id');

        return view('pages.quote', compact('categories', 'products', 'preselectedProductId'));
    }
}
