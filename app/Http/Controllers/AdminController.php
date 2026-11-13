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
     * Display Banners module.
     */
    public function banners(): View
    {
        $banners = [
            [
                'id' => 1,
                'badge' => 'South Korean Technology • ISO 13485 • CE • MFDS Korea',
                'title' => 'South Korean Precision Engineering for Global Healthcare',
                'subtitle' => 'DIARAX manufactures over 250 advanced medical equipment models across 40 clinical categories.',
                'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 1,
                'status' => 'active',
                'created_at' => '2026-11-01',
            ],
            [
                'id' => 2,
                'badge' => 'Surgical Suites & Smart Operating Theatres',
                'title' => 'Next-Generation Robotic & Electro-Hydraulic Surgery',
                'subtitle' => 'Engineered for sub-millimeter surgical precision, ergonomic clinical control, and fail-safe patient support.',
                'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 2,
                'status' => 'active',
                'created_at' => '2026-11-04',
            ],
            [
                'id' => 3,
                'badge' => 'Critical Care & Intelligent Life Support',
                'title' => 'Real-Time Multi-Parameter Monitoring & Anesthesia',
                'subtitle' => 'Continuous algorithmic patient monitoring and digital anesthesia delivery protecting vulnerable patients.',
                'image' => 'https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1200&q=80',
                'sort_order' => 3,
                'status' => 'active',
                'created_at' => '2026-11-07',
            ],
        ];

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Store new banner slide.
     */
    public function storeBanner(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:500',
            'badge' => 'nullable|string|max:255',
            'image' => 'nullable|string',
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Hero banner slide successfully added!');
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
            'image' => 'nullable|string',
            'status' => 'required|in:active,draft,discontinued',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name'] . '-' . $validated['model_code']);
        if (empty($validated['image'])) {
            $validated['image'] = 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80';
        }

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

    /**
     * Display Purchases module (পারসেজ মডিউল).
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
     * Display Sales module (সেল মডিউল).
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
}
