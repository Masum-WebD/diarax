@extends('layouts.app')

@section('title', 'Downloads & Technical Literature | DIARAX South Korea')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-b from-slate-50 to-white text-slate-900 py-12 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Documentation & Catalogs</span>
            <h1 class="font-heading text-2xl sm:text-4xl font-extrabold mt-2 text-slate-900">
                Downloads & Technical Literature
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-1.5 leading-relaxed">
                Download official product datasheets, user operating manuals, technical specifications, and international ISO quality certificates from DIARAX Medical Systems.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Corporate Catalogs Strip -->
    <div class="mb-12">
        <h3 class="font-heading font-bold text-lg text-slate-900 mb-4 pb-2 border-b border-slate-100">
            Corporate Literature & Quality Accreditations
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="p-5 bg-white rounded-2xl border border-slate-200 shadow-xs flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700 block mb-1">Corporate Master Catalog</span>
                    <h4 class="font-heading font-bold text-sm text-slate-900">DIARAX Medical Systems 2026</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Full 250+ equipment portfolio (PDF, 28 MB)</p>
                    <a href="{{ route('quote', ['type' => 'catalog']) }}" class="mt-3 inline-flex items-center text-xs font-bold text-blue-700 hover:text-blue-800">
                        <svg class="w-3.5 h-3.5 mr-1 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Download Master Catalog &rarr;
                    </a>
                </div>
            </div>

            <div class="p-5 bg-white rounded-2xl border border-slate-200 shadow-xs flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 block mb-1">Quality Management</span>
                    <h4 class="font-heading font-bold text-sm text-slate-900">EN ISO 13485:2016 Certificate</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Official TÜV / MFDS certification dossier (PDF)</p>
                    <a href="{{ route('quote', ['type' => 'iso']) }}" class="mt-3 inline-flex items-center text-xs font-bold text-emerald-700 hover:text-emerald-800">
                        <svg class="w-3.5 h-3.5 mr-1 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        View Certificate &rarr;
                    </a>
                </div>
            </div>

            <div class="p-5 bg-white rounded-2xl border border-slate-200 shadow-xs flex items-start justify-between">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-purple-700 block mb-1">Turnkey Healthcare</span>
                    <h4 class="font-heading font-bold text-sm text-slate-900">Modular Cleanroom OR Brochure</h4>
                    <p class="text-[11px] text-slate-500 mt-1">Surgical suites & BIM room designs (PDF, 14 MB)</p>
                    <a href="{{ route('quote', ['type' => 'turnkey']) }}" class="mt-3 inline-flex items-center text-xs font-bold text-purple-700 hover:text-purple-800">
                        <svg class="w-3.5 h-3.5 mr-1 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Download Brochure &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Datasheets Table -->
    <div>
        <h3 class="font-heading font-bold text-lg text-slate-900 mb-4 pb-2 border-b border-slate-100">
            Official Equipment Technical Datasheets
        </h3>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider text-[10px]">
                        <tr>
                            <th class="py-3 px-4">Model Code</th>
                            <th class="py-3 px-4">Equipment Name</th>
                            <th class="py-3 px-4">Category</th>
                            <th class="py-3 px-4">Compliance</th>
                            <th class="py-3 px-4 text-right">Download</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($products as $product)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="py-3 px-4 font-bold text-blue-700 font-mono">
                                    {{ $product->model_code }}
                                </td>
                                <td class="py-3 px-4 font-semibold text-slate-900">
                                    {{ $product->name }}
                                </td>
                                <td class="py-3 px-4 text-slate-500">
                                    {{ $product->category->name ?? 'General Medical' }}
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700">
                                        ISO 13485 &bull; CE
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <a href="{{ route('products.datasheet', $product->slug) }}" target="_blank" class="inline-flex items-center px-3 py-1 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-700 hover:text-white font-bold transition">
                                        <svg class="w-3.5 h-3.5 mr-1 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        PDF Datasheet
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

