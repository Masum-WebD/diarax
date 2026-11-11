<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Store a newly created inquiry / quote request in storage.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:50',
            'organization' => 'nullable|string|max:150',
            'country' => 'nullable|string|max:100',
            'inquiry_type' => 'required|string|in:quote,tender,partnership,support,general',
            'product_id' => 'nullable|exists:products,id',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:3000',
        ]);

        $inquiry = Inquiry::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your inquiry has been submitted successfully to DIXION. Our team will contact you shortly.',
                'inquiry_id' => $inquiry->id,
            ]);
        }

        return back()->with('success', 'Thank you! Your medical inquiry has been received. Our sales & engineering team in Düsseldorf will contact you promptly.');
    }
}
