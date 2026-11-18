<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\WelcomePopup;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a comprehensive medical ERP dashboard summary.
     */
    public function index(): View
    {
        $totalInquiries = Inquiry::count();
        $newInquiries = Inquiry::where('status', 'new')->count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();

        $recentInquiries = Inquiry::with('product')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        // Sample / Live Sales Orders for Medical Systems
        $recentSales = [
            [
                'id' => 'INV-2026-1042',
                'hospital' => 'Seoul National University Hospital',
                'country' => 'South Korea',
                'equipment' => '2x DIARAX Operamed 3000 (Surgery)',
                'amount' => 58400,
                'status' => 'Paid',
                'delivery' => 'Delivered',
                'date' => '2026-11-12',
            ],
            [
                'id' => 'INV-2026-1041',
                'hospital' => 'Asan Medical Center',
                'country' => 'South Korea',
                'equipment' => '1x DIARAX Aeros 4600 Anesthesia',
                'amount' => 32800,
                'status' => 'Paid',
                'delivery' => 'In Transit',
                'date' => '2026-11-10',
            ],
            [
                'id' => 'INV-2026-1040',
                'hospital' => 'Bangkok Central Hospital',
                'country' => 'Thailand',
                'equipment' => '4x DIARAX Storm 5900 Monitors',
                'amount' => 24600,
                'status' => 'Partial',
                'delivery' => 'Processing',
                'date' => '2026-11-08',
            ],
            [
                'id' => 'INV-2026-1039',
                'hospital' => 'Dhaka Specialized Hospital',
                'country' => 'Bangladesh',
                'equipment' => '1x DIARAX MobileClinic X1 Turnkey',
                'amount' => 125000,
                'status' => 'Paid',
                'delivery' => 'Shipped',
                'date' => '2026-11-05',
            ],
        ];

        // Sample / Live Procurement Purchases
        $recentPurchases = [
            [
                'id' => 'PO-2026-0891',
                'supplier' => 'Seoul Precision Hydraulics Co.',
                'items' => '12x Electro-hydraulic cylinders for Operamed tables',
                'amount' => 24500,
                'status' => 'Received',
                'date' => '2026-11-11',
            ],
            [
                'id' => 'PO-2026-0890',
                'supplier' => 'Korea Biomedical Sensors Ltd',
                'items' => '50x Multi-parameter ECG & SpO2 modules',
                'amount' => 18200,
                'status' => 'In Transit',
                'date' => '2026-11-09',
            ],
            [
                'id' => 'PO-2026-0889',
                'supplier' => 'Daegu Medical Steels & Alloys',
                'items' => 'Medical grade 304/316L stainless steel chassis',
                'amount' => 14300,
                'status' => 'Received',
                'date' => '2026-11-06',
            ],
        ];

        return view('admin.dashboard', compact(
            'totalInquiries',
            'newInquiries',
            'totalProducts',
            'totalCategories',
            'recentInquiries',
            'recentSales',
            'recentPurchases'
        ));
    }

    /**
     * Handle image upload from file or external URL.
     */
    protected function handleImageUpload(Request $request, string $folder, ?string $currentImage = null): ?string
    {
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $destination = public_path('uploads/' . $folder);
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            return asset('uploads/' . $folder . '/' . $filename);
        }

        if ($request->filled('image_url')) {
            return $request->input('image_url');
        }

        return $currentImage;
    }

    /**
     * Display Banners module.
     */
    public function banners(): View
    {
        $banners = Banner::orderBy('sort_order', 'asc')->get();

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Store new banner slide.
     */
    public function storeBanner(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:500',
            'badge' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:active,draft',
            'image_file' => 'nullable|image|max:8192',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $image = $this->handleImageUpload($request, 'banners');
        if (empty($image)) {
            $image = 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1920&q=80';
        }

        Banner::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'badge' => $validated['badge'] ?? null,
            'image' => $image,
            'sort_order' => $validated['sort_order'] ?? 0,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Hero banner slide successfully added!');
    }

    /**
     * Update banner slide.
     */
    public function updateBanner(Request $request, int $id): RedirectResponse
    {
        $banner = Banner::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:500',
            'badge' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:active,draft',
            'image_file' => 'nullable|image|max:8192',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $image = $this->handleImageUpload($request, 'banners', $banner->image);

        $banner->update([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'],
            'badge' => $validated['badge'] ?? null,
            'image' => $image,
            'sort_order' => $validated['sort_order'] ?? $banner->sort_order,
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Hero banner slide updated successfully!');
    }

    /**
     * Delete banner slide.
     */
    public function destroyBanner(int $id): RedirectResponse
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Hero banner slide removed.');
    }

    /**
     * Display medical products catalog list for management.
     */
    public function products(Request $request): View
    {
        $query = Product::with('category')->orderBy('id', 'desc');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->input('category'));
            });
        }

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('model_code', 'like', "%{$s}%");
            });
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
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
            'status' => 'required|in:active,draft,discontinued',
            'image_file' => 'nullable|image|max:8192',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $validated['slug'] = Str::slug($validated['name'] . '-' . $validated['model_code']);

        $image = $this->handleImageUpload($request, 'products');
        if (empty($image)) {
            $image = 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80';
        }
        $validated['image'] = $image;

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_new'] = $request->has('is_new');

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', "Medical equipment {$validated['name']} created successfully.");
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
            'status' => 'required|in:active,draft,discontinued',
            'image_file' => 'nullable|image|max:8192',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $image = $this->handleImageUpload($request, 'products', $product->image);
        $validated['image'] = $image;

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

    /**
     * Display Purchases module.
     */
    public function purchases(): View
    {
        $purchases = [
            [
                'po_number' => 'PO-2026-0891',
                'supplier' => 'Seoul Precision Hydraulics Co.',
                'contact' => 'Mr. Min-jun Park (+82 2 890 1200)',
                'category' => 'Hydraulic & Mechanical',
                'items' => '12x Electro-hydraulic cylinders for Operamed 3000',
                'total_amount' => 24500,
                'payment_status' => 'Paid',
                'delivery_status' => 'Received',
                'order_date' => '2026-11-11',
                'delivery_date' => '2026-11-12',
            ],
            [
                'po_number' => 'PO-2026-0890',
                'supplier' => 'Korea Biomedical Sensors Ltd',
                'contact' => 'Dr. Ji-won Kim (+82 31 450 7800)',
                'category' => 'Sensors & Electronics',
                'items' => '50x Multi-parameter ECG & SpO2 optical sensor modules',
                'total_amount' => 18200,
                'payment_status' => 'Paid',
                'delivery_status' => 'In Transit',
                'order_date' => '2026-11-09',
                'delivery_date' => '2026-11-15',
            ],
            [
                'po_number' => 'PO-2026-0889',
                'supplier' => 'Daegu Medical Steels & Alloys',
                'contact' => 'Sales Division (+82 53 710 3300)',
                'category' => 'Raw Materials',
                'items' => 'Medical grade 304/316L stainless steel surgical armatures',
                'total_amount' => 14300,
                'payment_status' => 'Paid',
                'delivery_status' => 'Received',
                'order_date' => '2026-11-06',
                'delivery_date' => '2026-11-08',
            ],
            [
                'po_number' => 'PO-2026-0888',
                'supplier' => 'Busan Optical Instruments',
                'contact' => 'Tech Support (+82 51 600 4500)',
                'category' => 'Optics & Lighting',
                'items' => '24x German-LED light engines for Convelar Surgical Lights',
                'total_amount' => 28900,
                'payment_status' => 'Partial',
                'delivery_status' => 'Processing',
                'order_date' => '2026-11-04',
                'delivery_date' => '2026-11-18',
            ],
            [
                'po_number' => 'PO-2026-0887',
                'supplier' => 'Incheon Silicone & Polymers',
                'contact' => 'Logistics (+82 32 880 9100)',
                'category' => 'Disposables & Gaskets',
                'items' => '200x Medical silicone breathing tubes & valve kits for Aeros 4600',
                'total_amount' => 8400,
                'payment_status' => 'Paid',
                'delivery_status' => 'Received',
                'order_date' => '2026-11-01',
                'delivery_date' => '2026-11-03',
            ],
            [
                'po_number' => 'PO-2026-0886',
                'supplier' => 'Gyeonggi Micro-Controllers Corp',
                'contact' => 'Semiconductor Sales (+82 31 990 6200)',
                'category' => 'Microcontrollers',
                'items' => '100x Dual-core real-time processors for patient monitors',
                'total_amount' => 21600,
                'payment_status' => 'Unpaid',
                'delivery_status' => 'Ordered',
                'order_date' => '2026-10-29',
                'delivery_date' => '2026-11-20',
            ],
        ];

        $totalPurchasesAmount = array_sum(array_column($purchases, 'total_amount'));
        $receivedCount = count(array_filter($purchases, fn($p) => $p['delivery_status'] === 'Received'));
        $transitCount = count(array_filter($purchases, fn($p) => $p['delivery_status'] === 'In Transit'));

        return view('admin.purchases.index', compact('purchases', 'totalPurchasesAmount', 'receivedCount', 'transitCount'));
    }

    /**
     * Store new purchase order.
     */
    public function storePurchase(Request $request): RedirectResponse
    {
        $request->validate([
            'supplier' => 'required|string|max:200',
            'items' => 'required|string|max:500',
            'total_amount' => 'required|numeric',
        ]);

        return redirect()->route('admin.purchases.index')->with('success', 'Purchase Order successfully registered!');
    }

    /**
     * Display Sales module.
     */
    public function sales(): View
    {
        $sales = [
            [
                'invoice_no' => 'INV-2026-1042',
                'client_hospital' => 'Seoul National University Hospital',
                'destination' => 'Seoul, South Korea',
                'department' => 'Surgery & Operating Suites',
                'equipment_details' => '2x DIARAX Operamed 3000 Electro-hydraulic Operating Tables',
                'total_amount' => 58400,
                'payment_status' => 'Paid',
                'fulfillment_status' => 'Delivered',
                'invoice_date' => '2026-11-12',
            ],
            [
                'invoice_no' => 'INV-2026-1041',
                'client_hospital' => 'Asan Medical Center',
                'destination' => 'Seoul, South Korea',
                'department' => 'Anesthesia & Critical Care',
                'equipment_details' => '1x DIARAX Aeros 4600 Anesthesia Workstation + Vaporizers',
                'total_amount' => 32800,
                'payment_status' => 'Paid',
                'fulfillment_status' => 'In Transit',
                'invoice_date' => '2026-11-10',
            ],
            [
                'invoice_no' => 'INV-2026-1040',
                'client_hospital' => 'Bangkok Central Hospital',
                'destination' => 'Bangkok, Thailand',
                'department' => 'Intensive Care Unit (ICU)',
                'equipment_details' => '4x DIARAX Storm 5900 Modular Patient Monitors',
                'total_amount' => 24600,
                'payment_status' => 'Partial',
                'fulfillment_status' => 'Processing',
                'invoice_date' => '2026-11-08',
            ],
            [
                'invoice_no' => 'INV-2026-1039',
                'client_hospital' => 'Dhaka Specialized Medical College',
                'destination' => 'Dhaka, Bangladesh',
                'department' => 'Emergency & Mobile Clinics',
                'equipment_details' => '1x DIARAX MobileClinic X1 All-Terrain Unit + ICU Setup',
                'total_amount' => 125000,
                'payment_status' => 'Paid',
                'fulfillment_status' => 'Delivered',
                'invoice_date' => '2026-11-05',
            ],
            [
                'invoice_no' => 'INV-2026-1038',
                'client_hospital' => 'Philippine General Hospital',
                'destination' => 'Manila, Philippines',
                'department' => 'Neonatal & Pediatric Care',
                'equipment_details' => '3x DIARAX BabyGuard Infant Incubators & Phototherapy',
                'total_amount' => 38700,
                'payment_status' => 'Due',
                'fulfillment_status' => 'Preparing',
                'invoice_date' => '2026-11-02',
            ],
            [
                'invoice_no' => 'INV-2026-1037',
                'client_hospital' => 'King Faisal Specialist Hospital',
                'destination' => 'Riyadh, Saudi Arabia',
                'department' => 'Cardiology & Diagnostics',
                'equipment_details' => '2x DIARAX Cardioscan 12-Channel ECG & Diagnostic Systems',
                'total_amount' => 18900,
                'payment_status' => 'Paid',
                'fulfillment_status' => 'Delivered',
                'invoice_date' => '2026-10-28',
            ],
        ];

        $totalSalesAmount = array_sum(array_column($sales, 'total_amount'));
        $paidCount = count(array_filter($sales, fn($s) => $s['payment_status'] === 'Paid'));
        $deliveredCount = count(array_filter($sales, fn($s) => $s['fulfillment_status'] === 'Delivered'));

        return view('admin.sales.index', compact('sales', 'totalSalesAmount', 'paidCount', 'deliveredCount'));
    }

    /**
     * Store new sale invoice.
     */
    public function storeSale(Request $request): RedirectResponse
    {
        $request->validate([
            'client_hospital' => 'required|string|max:200',
            'equipment_details' => 'required|string|max:500',
            'total_amount' => 'required|numeric',
        ]);

        return redirect()->route('admin.sales.index')->with('success', 'Sale order & invoice successfully created!');
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
     * Display categories management.
     */
    public function categories(Request $request): View
    {
        $query = Category::withCount('products')->orderBy('sort_order', 'asc');

        if ($request->filled('search')) {
            $s = $request->input('search');
            $query->where('name', 'like', "%{$s}%")->orWhere('slug', 'like', "%{$s}%");
        }

        $categories = $query->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Store new medical category.
     */
    public function storeCategory(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200|unique:categories,slug',
            'short_description' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'image_file' => 'nullable|image|max:8192',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);

        $origSlug = $validated['slug'];
        $count = 1;
        while (Category::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $origSlug . '-' . $count++;
        }

        $image = $this->handleImageUpload($request, 'categories');
        $validated['image'] = $image;
        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['icon'] = !empty($validated['icon']) ? $validated['icon'] : 'heroicon-o-cube';

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', "Category '{$validated['name']}' created successfully.");
    }

    /**
     * Update existing category.
     */
    public function updateCategory(Request $request, int $id): RedirectResponse
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:categories,slug,' . $id,
            'short_description' => 'nullable|string|max:500',
            'icon' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'image_file' => 'nullable|image|max:8192',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $image = $this->handleImageUpload($request, 'categories', $category->image);
        $validated['image'] = $image;
        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? $category->sort_order;
        $validated['icon'] = !empty($validated['icon']) ? $validated['icon'] : ($category->icon ?: 'heroicon-o-cube');

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', "Category '{$category->name}' updated successfully.");
    }

    /**
     * Delete category.
     */
    public function destroyCategory(int $id): RedirectResponse
    {
        $category = Category::withCount('products')->findOrFail($id);

        if ($category->products_count > 0) {
            return redirect()->route('admin.categories.index')->with('error', "Cannot delete category '{$category->name}' because it contains {$category->products_count} active product(s). Please reassign or delete the products first.");
        }

        $name = $category->name;
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', "Category '{$name}' deleted successfully.");
    }

    /**
     * Display Welcome Popup settings.
     */
    public function popup(): View
    {
        $popup = WelcomePopup::first() ?? new WelcomePopup([
            'title' => 'Welcome to DIARAX Medical Systems',
            'badge' => 'South Korea Precision Engineering',
            'message' => 'DIARAX manufactures world-class medical equipment and surgical systems engineered in Seoul. Explore our latest ISO 13485 and CE certified devices for operating theatres, intensive care, and diagnostic medicine.',
            'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=800&q=80',
            'button_text' => 'Explore Equipment Catalog',
            'button_link' => '/products',
            'is_active' => true,
        ]);

        return view('admin.popup.index', compact('popup'));
    }

    /**
     * Update Welcome Popup settings.
     */
    public function updatePopup(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'badge' => 'nullable|string|max:255',
            'message' => 'required|string|max:1500',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:8192',
            'image_url' => 'nullable|string|max:1000',
        ]);

        $popup = WelcomePopup::first();
        $currentImage = $popup ? $popup->image : null;
        $image = $this->handleImageUpload($request, 'popups', $currentImage);

        if (!$popup) {
            $popup = new WelcomePopup();
        }

        $popup->title = $validated['title'];
        $popup->badge = $validated['badge'] ?? null;
        $popup->message = $validated['message'];
        $popup->button_text = $validated['button_text'] ?? null;
        $popup->button_link = $validated['button_link'] ?? null;
        $popup->image = $image;
        $popup->is_active = $request->has('is_active');
        $popup->save();

        return redirect()->route('admin.popup.index')->with('success', 'Welcome popup announcement settings updated successfully.');
    }
}
