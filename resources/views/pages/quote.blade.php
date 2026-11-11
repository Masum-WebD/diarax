@extends('layouts.app')

@section('title', 'Request a Medical Equipment Quote & Tender Proposal | DIXION')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 via-slate-900 to-sky-950 text-white py-16 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-sky-400 bg-sky-500/10 px-3 py-1 rounded-full">Procurement & Export</span>
            <h1 class="font-heading text-3xl sm:text-5xl font-extrabold mt-3">
                Request Medical Equipment Quotation
            </h1>
            <p class="text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                Receive official European manufacturer quotations, CIF/FOB export pricing, technical compliance sheets, and delivery schedules from DIXION Düsseldorf.
            </p>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-xl">
        <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="inquiry_type" value="{{ request('type') === 'turnkey' ? 'tender' : 'quote' }}">

            <!-- Section 1: Contact Details -->
            <div>
                <h3 class="font-heading text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center">
                    <span class="w-6 h-6 rounded-full bg-sky-100 text-sky-700 flex items-center justify-center text-xs mr-2">1</span>
                    Institutional / Contact Details
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Full Name & Title *</label>
                        <input type="text" name="full_name" required placeholder="Prof. Dr. / Procurement Officer" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Official Email Address *</label>
                        <input type="email" name="email" required placeholder="contact@hospital.org" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Phone / Mobile</label>
                        <input type="text" name="phone" placeholder="+49..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Clinic / Organization *</label>
                        <input type="text" name="organization" required placeholder="e.g. Dhaka Medical Center" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Country / Destination *</label>
                        <input type="text" name="country" required placeholder="e.g. Bangladesh" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                    </div>
                </div>
            </div>

            <!-- Section 2: Equipment Requirements -->
            <div class="pt-4">
                <h3 class="font-heading text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center">
                    <span class="w-6 h-6 rounded-full bg-sky-100 text-sky-700 flex items-center justify-center text-xs mr-2">2</span>
                    Equipment Selection
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Select Specific Product</label>
                        <select name="product_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none bg-white">
                            <option value="">-- Multiple Models / General Turnkey --</option>
                            @foreach($products as $prod)
                                <option value="{{ $prod->id }}" {{ $preselectedProductId == $prod->id ? 'selected' : '' }}>
                                    {{ $prod->name }} ({{ $prod->model_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Subject / Project Title</label>
                        <input type="text" name="subject" value="{{ request('subject') ?? 'Medical Equipment Quote Request' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Detailed Technical Requirements & Quantities *</label>
                    <textarea name="message" rows="5" required placeholder="Please list desired quantities, required optional accessories (e.g. orthopedic extensions, vaporizers, neonatal probes), target delivery date, or tender reference numbers..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none"></textarea>
                </div>
            </div>

            <!-- Submit -->
            <div class="pt-4 text-center">
                <button type="submit" class="w-full sm:w-auto px-10 py-4 rounded-xl bg-gradient-to-r from-sky-600 to-blue-700 hover:from-sky-500 hover:to-blue-600 text-white font-bold text-sm tracking-wide shadow-xl shadow-sky-600/25 transition">
                    Submit Formal Quote Request
                </button>
                <p class="text-xs text-slate-400 mt-2">
                    Official quote generated and verified by DIXION Vertrieb medizinischer Geräte GmbH.
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
