@extends('layouts.app')

@section('title', $product->name . ' (' . $product->model_code . ') | DIXION Medical')
@section('meta_description', $product->short_description)

@section('content')
<!-- Breadcrumbs -->
<div class="bg-slate-100 border-b border-slate-200 text-xs py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center space-x-2 text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-slate-800">Home</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-slate-800">Products</a>
            <span>/</span>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-slate-800">{{ $product->category->name }}</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold truncate">{{ $product->model_code }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Top Product Overview Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start mb-16">
        <!-- Left: Image & Gallery -->
        <div class="lg:col-span-6 space-y-4">
            <div class="bg-white rounded-3xl p-4 border border-slate-200/80 shadow-sm overflow-hidden">
                <div class="relative h-96 rounded-2xl overflow-hidden bg-slate-100 flex items-center justify-center">
                    <img id="main-image" src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                        <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-slate-900/80 text-white backdrop-blur-sm">
                            {{ $product->category->name }}
                        </span>
                        @if($product->is_new)
                            <span class="px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-emerald-600 text-white">
                                New Model
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Trust Badges Under Image -->
            <div class="grid grid-cols-3 gap-3 text-center text-xs">
                <div class="p-3 bg-white rounded-xl border border-slate-200 text-slate-600">
                    <span class="font-bold text-sky-600 block">ISO 13485</span>
                    Certified Quality
                </div>
                <div class="p-3 bg-white rounded-xl border border-slate-200 text-slate-600">
                    <span class="font-bold text-slate-900 block">CE Mark</span>
                    EU MDR Approved
                </div>
                <div class="p-3 bg-white rounded-xl border border-slate-200 text-slate-600">
                    <span class="font-bold text-emerald-600 block">Warranty</span>
                    24 Months Global
                </div>
            </div>
        </div>

        <!-- Right: Details & Call to Action -->
        <div class="lg:col-span-6 space-y-6">
            <div>
                <span class="text-xs font-extrabold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                    Model: {{ $product->model_code }}
                </span>
                <h1 class="font-heading text-3xl sm:text-4xl font-extrabold text-slate-900 mt-3 leading-tight">
                    {{ $product->name }}
                </h1>
                @if($product->tagline)
                    <p class="text-sm font-medium text-slate-500 mt-2 italic">
                        "{{ $product->tagline }}"
                    </p>
                @endif
            </div>

            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                {{ $product->short_description }}
            </p>

            <!-- Key Quick Feature Highlights -->
            @if($product->features)
                <div class="bg-white rounded-2xl p-5 border border-slate-200 space-y-2.5">
                    <h4 class="font-heading text-xs font-bold uppercase tracking-wider text-slate-700">Clinical Highlights:</h4>
                    <ul class="space-y-2 text-xs sm:text-sm text-slate-600">
                        @foreach(array_slice($product->features, 0, 4) as $feat)
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ $feat }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                <a href="{{ route('quote', ['product_id' => $product->id]) }}" class="w-full sm:w-auto flex-1 inline-flex items-center justify-center px-6 py-3.5 rounded-xl font-bold text-sm bg-sky-600 hover:bg-sky-700 text-white shadow-lg shadow-sky-600/25 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Request Price & Tender Quotation
                </a>
                <a href="#quick-inquiry" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 rounded-xl font-bold text-sm bg-slate-900 hover:bg-slate-800 text-white transition">
                    Ask Specialist
                </a>
            </div>

            <!-- Brochure Link Simulation -->
            <div class="pt-2 flex items-center justify-between text-xs text-slate-500">
                <span class="flex items-center">
                    <svg class="w-4 h-4 text-rose-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    Official Technical Datasheet (PDF)
                </span>
                <a href="{{ route('quote', ['product_id' => $product->id, 'type' => 'brochure']) }}" class="text-sky-600 hover:underline font-semibold">
                    Download Datasheet &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- Technical Details Tabs -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-10 mb-16">
        <h3 class="font-heading text-2xl font-bold text-slate-900 mb-6">Technical Specifications & Overview</h3>

        <div class="prose max-w-none text-slate-600 text-sm leading-relaxed mb-8">
            <p>{{ $product->description }}</p>
        </div>

        @if($product->specifications)
            <div class="mt-8">
                <h4 class="font-heading text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">
                    Technical Parameters
                </h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm">
                        <tbody class="divide-y divide-slate-100">
                            @foreach($product->specifications as $param => $val)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="py-3 px-4 font-semibold text-slate-700 bg-slate-50/50 w-1/3 sm:w-1/4">
                                        {{ $param }}
                                    </td>
                                    <td class="py-3 px-4 text-slate-800">
                                        {{ $val }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if($product->applications)
            <div class="mt-8 pt-6 border-t border-slate-100">
                <h4 class="font-heading text-sm font-bold uppercase tracking-wider text-slate-700 mb-3">Clinical Applications:</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($product->applications as $app)
                        <span class="px-3 py-1.5 rounded-xl bg-sky-50 text-sky-800 text-xs font-semibold border border-sky-100">
                            {{ $app }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Direct Quick Inquiry Form on Page -->
    <div id="quick-inquiry" class="bg-gradient-to-br from-slate-900 to-slate-950 text-white rounded-3xl p-8 sm:p-12 mb-16 shadow-xl border border-slate-800">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-8">
                <span class="text-xs font-bold uppercase tracking-widest text-sky-400 bg-sky-500/10 px-3 py-1 rounded-full">Direct Inquiry</span>
                <h3 class="font-heading text-2xl font-bold mt-2">Inquire About {{ $product->model_code }}</h3>
                <p class="text-xs sm:text-sm text-slate-300 mt-1">
                    Receive official commercial terms, shipping lead-time, and technical configuration support.
                </p>
            </div>

            <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="inquiry_type" value="quote">
                <input type="hidden" name="subject" value="Quote for {{ $product->name }} ({{ $product->model_code }})">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Your Name *</label>
                        <input type="text" name="full_name" required placeholder="Dr. / Engineer Name" class="w-full px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Email Address *</label>
                        <input type="email" name="email" required placeholder="contact@hospital.com" class="w-full px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Hospital / Organization</label>
                        <input type="text" name="organization" placeholder="Clinic / Health Ministry" class="w-full px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Country / Destination</label>
                        <input type="text" name="country" placeholder="e.g. Bangladesh, Germany, Saudi Arabia" class="w-full px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-sky-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">Message / Desired Units *</label>
                    <textarea name="message" rows="3" required placeholder="Specify quantity, destination port/airport, or accessories needed..." class="w-full px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:ring-2 focus:ring-sky-500 outline-none"></textarea>
                </div>

                <div class="text-center pt-2">
                    <button type="submit" class="px-8 py-3 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-bold text-sm tracking-wide shadow-md transition">
                        Submit Request for {{ $product->model_code }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Related Medical Equipment -->
    @if($relatedProducts->isNotEmpty())
        <div>
            <h3 class="font-heading text-xl font-bold text-slate-900 mb-6">
                Related Equipment in {{ $product->category->name }}
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedProducts as $rel)
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 hover:shadow-lg transition">
                        <div class="h-40 bg-slate-100 rounded-xl overflow-hidden mb-4">
                            <img src="{{ $rel->image }}" alt="{{ $rel->name }}" class="w-full h-full object-cover">
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-sky-600 block mb-1">
                            {{ $rel->model_code }}
                        </span>
                        <h4 class="font-heading font-bold text-sm text-slate-900 mb-2">
                            <a href="{{ route('products.show', $rel->slug) }}" class="hover:text-sky-600">
                                {{ $rel->name }}
                            </a>
                        </h4>
                        <a href="{{ route('products.show', $rel->slug) }}" class="text-xs font-semibold text-sky-600 hover:underline">
                            View Model &rarr;
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
