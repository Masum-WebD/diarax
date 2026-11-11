<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a dashboard summary of inquiries and inventory.
     */
    public function index(): View
    {
        $totalInquiries = Inquiry::count();
        $newInquiries = Inquiry::where('status', 'new')->count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();

        $recentInquiries = Inquiry::with('product')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalInquiries',
            'newInquiries',
            'totalProducts',
            'totalCategories',
            'recentInquiries'
        ));
    }

    /**
     * Display inquiries list with status filtering.
     */
    public function inquiries(Request $request): View
    {
        $query = Inquiry::with('product')->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('type')) {
            $query->where('inquiry_type', $request->input('type'));
        }

        $inquiries = $query->paginate(15)->withQueryString();

        return view('admin.inquiries', compact('inquiries'));
    }

    /**
     * Update inquiry status.
     */
    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $inquiry = Inquiry::findOrFail($id);

        $request->validate([
            'status' => 'required|in:new,reviewed,contacted,closed',
        ]);

        $inquiry->update([
            'status' => $request->input('status'),
        ]);

        return back()->with('success', "Inquiry #{$inquiry->id} status updated to {$inquiry->status}.");
    }

    /**
     * Display medical products catalog list for management.
     */
    public function products(): View
    {
        $products = Product::with('category')->orderBy('id', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show form to create a new product.
     */
    public function createProduct(): View
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created medical equipment product.
     */
    public function storeProduct(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'model_code' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'tagline' => 'nullable|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'is_featured' => 'sometimes|boolean',
            'is_new' => 'sometimes|boolean',
            'status' => 'required|in:active,draft,discontinued',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name'] . '-' . $validated['model_code']);
        if (!$validated['image']) {
            $validated['image'] = 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80';
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_new'] = $request->has('is_new');

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', "Medical device {$validated['name']} created successfully.");
    }

    /**
     * Show edit form for product.
     */
    public function editProduct(int $id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update product in storage.
     */
    public function updateProduct(Request $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'model_code' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'tagline' => 'nullable|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'status' => 'required|in:active,draft,discontinued',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_new'] = $request->has('is_new');

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', "Product {$product->model_code} updated successfully.");
    }

    /**
     * Delete product.
     */
    public function destroyProduct(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $name = $product->name;
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', "Product {$name} removed.");
    }
}

