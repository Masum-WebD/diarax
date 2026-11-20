<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Technical Datasheet - {{ $product->model_code }} | DIARAX Ltd</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; font-size: 11pt; padding: 0 !important; }
            .page-break { page-break-before: always; }
        }
        .hologram-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 8rem;
            font-weight: 900;
            color: rgba(30, 58, 138, 0.03);
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
            letter-spacing: 0.1em;
            z-index: 0;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased p-4 sm:p-8">

    <!-- Top Action Bar for Screen -->
    <div class="max-w-4xl mx-auto mb-6 flex items-center justify-between no-print">
        <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center text-xs font-semibold text-slate-600 hover:text-blue-700">
            &larr; Back to Product Details
        </a>
        <div class="flex items-center space-x-3">
            <button onclick="window.print()" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white rounded-xl text-xs font-bold shadow-xs flex items-center transition">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                Print / Save as PDF
            </button>
        </div>
    </div>

    <!-- Official Document Container (A4 styling with subtle hologram background) -->
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-md border border-slate-200 p-8 sm:p-12 relative overflow-hidden">
        
        <!-- Backend DIARAX Hologram Design -->
        <div class="hologram-watermark">
            DIARAX
        </div>

        <div class="relative z-10">
            <!-- Letterhead Header -->
            <div class="flex flex-col sm:flex-row items-start justify-between pb-8 border-b-2 border-slate-900 mb-8 gap-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.png') }}" alt="DIARAX Logo" class="h-9 w-auto object-contain">
                    <div class="border-l border-slate-300 pl-3">
                        <h1 class="font-heading text-xl font-black text-slate-950 tracking-tight">DIARAX LTD.</h1>
                        <p class="text-[10px] uppercase font-bold tracking-widest text-blue-700">South Korean Medical Precision Systems</p>
                        <p class="text-[11px] text-slate-500">288, Dapsimni-ro, Dongdaemun-gu, Seoul, Korea.</p>
                        <p class="text-[10px] text-slate-400">Tel: +82-2-5382561 &bull; E-mail: info.diarax@gmail.com</p>
                    </div>
                </div>

                <div class="text-left sm:text-right text-[11px] text-slate-500 space-y-0.5">
                    <span class="inline-block px-2.5 py-1 bg-blue-700 text-white font-bold rounded text-[10px] uppercase tracking-wider mb-1">
                        Official Technical Datasheet
                    </span>
                    <div>Document Ref: <strong class="font-mono">DX-DS-{{ strtoupper($product->model_code) }}</strong></div>
                    <div>Compliance: <strong>ISO &bull; CE</strong></div>
                    <div>Issued: <strong>{{ date('F Y') }}</strong></div>
                </div>
            </div>

            <!-- Product Hero Summary -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start mb-8 pb-8 border-b border-slate-100">
                <div class="md:col-span-7 space-y-3">
                    <span class="text-xs font-bold text-blue-700 uppercase tracking-widest">
                        {{ $product->category->name }}
                    </span>
                    <h2 class="font-heading text-2xl sm:text-3xl font-bold text-slate-900 leading-snug">
                        {{ $product->name }}
                    </h2>
                    <div class="text-xs font-semibold text-slate-500">
                        Model Identifier: <span class="text-slate-900 font-mono font-bold">{{ $product->model_code }}</span>
                    </div>
                    <div class="text-xs sm:text-sm text-slate-600 leading-relaxed pt-1 prose max-w-none">
                        @if(strip_tags($product->description) !== $product->description)
                            {!! $product->description !!}
                        @else
                            <p class="whitespace-pre-line">{{ $product->description }}</p>
                        @endif
                    </div>
                </div>

                <div class="md:col-span-5">
                    <div class="rounded-xl overflow-hidden border border-slate-200 bg-slate-50 p-2">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-52 object-contain rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Features & Benefits (Clinical Highlights) -->
            @if(!empty($product->features) && count($product->features) > 0)
                <div class="mb-8 pb-8 border-b border-slate-100">
                    <h3 class="font-heading text-sm font-bold uppercase tracking-wider text-slate-900 mb-3">
                        Clinical & Functional Highlights
                    </h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs text-slate-700">
                        @foreach($product->features as $feature)
                            <li class="flex items-start">
                                <span class="text-blue-700 mr-2 font-bold">&bull;</span>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Technical Parameters Table -->
            @if(!empty($product->specifications) && count($product->specifications) > 0)
                <div class="mb-8 pb-8 border-b border-slate-100">
                    <h3 class="font-heading text-sm font-bold uppercase tracking-wider text-slate-900 mb-4">
                        Technical Specifications & Parameters
                    </h3>
                    <table class="w-full text-xs text-left border border-slate-200 rounded-lg overflow-hidden">
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

            <!-- Official Bottom Company Address -->
            <div class="pt-6 border-t-2 border-slate-900 flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-500 gap-4">
                <div>
                    <strong class="text-slate-900 text-xs">DIARAX LTD.</strong> &bull; South Korea Precision Medical Systems<br>
                    <span>288, Dapsimni-ro, Dongdaemun-gu, Seoul, Korea.</span><br>
                    <span>Telephone: +82-2-5382561 &bull; E-mail: info.diarax@gmail.com</span>
                </div>
                <div class="text-right text-[10px] text-slate-400">
                    <div>Official Technical Documentation</div>
                    <div>Issued: {{ date('F Y') }}</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
