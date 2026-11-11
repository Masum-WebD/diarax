@extends('layouts.app')

@section('title', 'Request a Medical Equipment Quote & Tender Proposal | DIARAX South Korea')

@section('content')
<!-- Header (White Theme) -->
<div class="bg-gradient-to-b from-slate-50 to-white text-slate-900 py-12 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Procurement & Export</span>
            <h1 class="font-heading text-2xl sm:text-4xl font-extrabold mt-2 text-slate-900">
                Request Medical Equipment Quotation
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-1.5 leading-relaxed">
                Receive official manufacturer quotations, CIF/FOB export pricing, technical compliance sheets, and delivery schedules from DIARAX Medical Systems, Seoul, South Korea.
            </p>
        </div>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm">
        <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="inquiry_type" value="{{ request('type') === 'turnkey' ? 'tender' : 'quote' }}">

            <!-- Section 1: Contact Details -->
            <div>
                <h3 class="font-heading text-sm font-bold text-slate-900 mb-3 pb-2 border-b border-slate-100 flex items-center uppercase tracking-wider">
                    <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-[10px] mr-2">1</span>
                    Institutional / Contact Details
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Full Name & Title *</label>
                        <input type="text" name="full_name" required placeholder="Prof. Dr. / Procurement Officer" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Official Email Address *</label>
                        <input type="email" name="email" required placeholder="contact@hospital.org" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mt-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Phone / Mobile</label>
                        <input type="text" name="phone" placeholder="+82 / +880..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Clinic / Organization *</label>
                        <input type="text" name="organization" required placeholder="Hospital Name" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Country / Destination *</label>
                        <input type="text" name="country" required placeholder="e.g. Bangladesh" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                    </div>
                </div>
            </div>

            <!-- Section 2: Equipment Requirements -->
            <div class="pt-2">
                <h3 class="font-heading text-sm font-bold text-slate-900 mb-3 pb-2 border-b border-slate-100 flex items-center uppercase tracking-wider">
                    <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-[10px] mr-2">2</span>
                    Equipment Selection
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Select Specific Product</label>
                        <select name="product_id" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-white">
                            <option value="">-- Multiple Models / General Turnkey --</option>
                            @foreach($products as $prod)
                                <option value="{{ $prod->id }}" {{ $preselectedProductId == $prod->id ? 'selected' : '' }}>
                                    {{ $prod->name }} ({{ $prod->model_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Subject / Project Title</label>
                        <input type="text" name="subject" value="{{ request('subject') ?? 'Medical Equipment Quote Request' }}" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Detailed Technical Requirements & Quantities *</label>
                    <textarea name="message" rows="4" required placeholder="Please list desired quantities, required accessories (e.g. orthopedic extension, vaporizers, neonatal probes), target delivery date, or tender specifications..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none"></textarea>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-2 text-center">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs tracking-wide shadow-xs transition">
                    Submit Formal Quote Request
                </button>
                <p class="text-[11px] text-slate-400 mt-2">
                    Official quote generated and verified by DIARAX Medical Systems &bull; Seoul, South Korea.
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
