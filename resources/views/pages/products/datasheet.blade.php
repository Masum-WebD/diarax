<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Technical Datasheet - {{ $product->model_code }} | DIXION Medical Systems</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; font-size: 11pt; }
            .page-break { page-break-before: always; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased p-4 sm:p-8">

    <!-- Top Action Bar for Screen -->
    <div class="max-w-4xl mx-auto mb-6 flex items-center justify-between no-print">
        <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center text-xs font-semibold text-slate-600 hover:text-sky-600">
            &larr; Back to Product Details
        </a>
        <div class="flex items-center space-x-3">
            <button onclick="window.print()" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-bold shadow flex items-center">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Print / Save as PDF
            </button>
        </div>
    </div>

    <!-- Official Document Container (A4 styling) -->
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md border border-slate-200 p-8 sm:p-12">
        <!-- Letterhead Header -->
        <div class="flex items-start justify-between pb-8 border-b-2 border-slate-900 mb-8">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 rounded-xl bg-slate-950 text-white flex items-center justify-center font-bold text-2xl">
                    +
                </div>
                <div>
                    <h1 class="font-heading text-2xl font-black text-slate-950 tracking-tight">DIXION</h1>
                    <p class="text-[10px] uppercase font-bold tracking-widest text-slate-500">Vertrieb medizinischer Geräte GmbH</p>
                    <p class="text-[11px] text-slate-400">Schiessstrasse 55 &bull; 40549 Düsseldorf, Germany</p>
                </div>
            </div>

            <div class="text-right text-[11px] text-slate-500 space-y-0.5">
                <span class="inline-block px-2.5 py-1 bg-slate-900 text-white font-bold rounded text-[10px] uppercase tracking-wider mb-1">
                    Official Technical Datasheet
                </span>
                <div>Document Ref: <strong>DX-DS-{{ strtoupper($product->model_code) }}</strong></div>
                <div>Compliance: <strong>EN ISO 13485:2016 &bull; CE 0123</strong></div>
                <div>Issued: <strong>{{ date('F Y') }}</strong></div>
            </div>
        </div>

        <!-- Product Hero Summary -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start mb-8 pb-8 border-b border-slate-100">
            <div class="md:col-span-7 space-y-3">
                <span class="text-xs font-bold text-sky-700 uppercase tracking-widest">
                    {{ $product->category->name }}
                </span>
                <h2 class="font-heading text-2xl sm:text-3xl font-bold text-slate-900">
                    {{ $product->name }}
                </h2>
                <div class="text-xs font-semibold text-slate-500">
                    Model Identifier: <span class="text-slate-900 font-mono">{{ $product->model_code }}</span>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed pt-1">
                    {{ $product->description }}
                </p>
            </div>

            <div class="md:col-span-5">
                <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-50 p-2">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-52 object-cover rounded-lg">
                </div>
            </div>
        </div>

        <!-- Features & Benefits -->
        @if($product->features)
            <div class="mb-8 pb-8 border-b border-slate-100">
                <h3 class="font-heading text-sm font-bold uppercase tracking-wider text-slate-900 mb-3">
                    Design & Functional Features
                </h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs text-slate-700">
                    @foreach($product->features as $feature)
                        <li class="flex items-start">
                            <span class="text-sky-600 mr-2 font-bold">&bull;</span>
                            <span>{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Technical Parameters Table -->
        @if($product->specifications)
            <div class="mb-8 pb-8 border-b border-slate-100">
                <h3 class="font-heading text-sm font-bold uppercase tracking-wider text-slate-900 mb-4">
                    Technical Specifications
                </h3>
                <table class="w-full text-xs text-left border border-slate-200">
                    <tbody class="divide-y divide-slate-200">
                        @foreach($product->specifications as $param => $val)
                            <tr class="even:bg-slate-50">
                                <td class="py-2.5 px-3 font-semibold text-slate-700 w-1/3 border-r border-slate-200">
                                    {{ $param }}
                                </td>
                                <td class="py-2.5 px-3 text-slate-900 font-mono">
                                    {{ $val }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Clinical Applications -->
        @if($product->applications)
            <div class="mb-8">
                <h3 class="font-heading text-sm font-bold uppercase tracking-wider text-slate-900 mb-3">
                    Intended Clinical Use & Departments
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($product->applications as $app)
                        <span class="px-2.5 py-1 bg-slate-100 rounded text-xs font-medium text-slate-700">
                            {{ $app }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Official Stamp & Footer -->
        <div class="pt-8 border-t-2 border-slate-900 flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-500 gap-4">
            <div>
                <strong>DIXION Vertrieb medizinischer Geräte GmbH</strong><br>
                Tel: +49 (0) 211 445566 &bull; Email: export@dixion.de &bull; Web: www.dixion.de
            </div>
            <div class="text-center sm:text-right border border-dashed border-slate-300 p-2 rounded">
                <div class="font-bold text-slate-800 text-[10px] uppercase">European Conformity Approved</div>
                <div class="text-[9px] text-slate-400">Quality Verified by QA Department &bull; Düsseldorf</div>
            </div>
        </div>
    </div>

</body>
</html>
