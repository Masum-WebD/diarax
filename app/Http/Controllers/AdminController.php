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
}
