@extends('layouts.app')

@section('title', $product->name . ' (' . $product->model_code . ') | DIARAX South Korea')
@section('meta_description', $product->short_description)

@section('content')
<!-- Breadcrumbs -->
<div class="bg-slate-50 border-b border-slate-200 text-xs py-2.5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center space-x-2 text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-blue-700">Home</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-blue-700">Products</a>
            <span>/</span>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-blue-700">{{ $product->category->name }}</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold truncate">{{ $product->model_code }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Top Product Overview Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-12">
        <!-- Left: Image & Badges -->
        <div class="lg:col-span-6 space-y-4">
            <div class="bg-white rounded-3xl p-3 border border-slate-200 shadow-xs overflow-hidden">
                <div class="relative h-80 sm:h-96 rounded-2xl overflow-hidden bg-slate-50 flex items-center justify-center">
                    <img id="main-image" src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                        <span class="px-2.5 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-white/90 text-slate-900 backdrop-blur-xs shadow-xs">
                            {{ $product->category->name }}
                        </span>
                        @if($product->is_new)
                            <span class="px-2.5 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-emerald-600 text-white">
                                New Model
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Trust Badges Under Image (Fully Dynamic) -->
            <div class="grid grid-cols-3 gap-2 text-center text-xs">
                <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200 text-slate-600">
                    <span class="font-bold text-blue-700 block">{{ $product->certified_quality ?: 'ISO 13485' }}</span>
                    Certified Quality
                </div>
                <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200 text-slate-600">
                    <span class="font-bold text-slate-900 block">{{ $product->regulatory_standard ?: 'Korea MFDS' }}</span>
                    Clinical Approved
                </div>
                <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200 text-slate-600">
                    <span class="font-bold text-emerald-600 block">Warranty</span>
                    {{ $product->warranty ?: '24 Months Global' }}
                </div>
            </div>
        </div>

        <!-- Right: Details & Call to Action -->
        <div class="lg:col-span-6 space-y-5">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-50 px-3 py-1 rounded-full">
                    Model: {{ $product->model_code }} &bull; South Korea
                </span>
                <h1 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2.5 leading-tight">
                    {{ $product->name }}
                </h1>
                @if($product->tagline)
                    <p class="text-xs sm:text-sm font-medium text-slate-500 mt-1 italic">
                        "{{ $product->tagline }}"
                    </p>
                @endif
            </div>

            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                {{ $product->short_description }}
            </p>

            <!-- Key Quick Feature Highlights (Fully Dynamic) -->
            @if(!empty($product->features) && count($product->features) > 0)
                <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200 space-y-2">
                    <h4 class="font-heading text-xs font-bold uppercase tracking-wider text-slate-700">Clinical Highlights:</h4>
                    <ul class="space-y-1.5 text-xs text-slate-600">
                        @foreach($product->features as $feat)
                            <li class="flex items-start">
                                <svg class="w-3.5 h-3.5 text-emerald-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ $feat }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Action Buttons: Request Quotation and Direct Inquiry -->
            <div class="flex items-center gap-2.5 pt-1">
                <a href="{{ route('quote', ['product_id' => $product->id]) }}" class="flex-1 whitespace-nowrap inline-flex items-center justify-center px-5 py-3 rounded-xl font-bold text-xs bg-blue-700 hover:bg-blue-800 text-white shadow-xs transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Request Official Quotation
                </a>
                <a href="#quick-inquiry" class="whitespace-nowrap inline-flex items-center justify-center px-4 py-3 rounded-xl font-semibold text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-200 transition">
                    Quick Inquiry
                </a>
            </div>
        </div>
    </div>

    <!-- Technical Details Tabs (White Theme) -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xs p-6 sm:p-8 mb-12">
        <h3 class="font-heading text-xl font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">
            Technical Specifications & Description
        </h3>

        <div class="prose max-w-none text-slate-600 text-xs sm:text-sm leading-relaxed mb-6">
            @if(strip_tags($product->description) !== $product->description)
                {!! $product->description !!}
            @else
                <p class="whitespace-pre-line">{{ $product->description }}</p>
            @endif
        </div>

        @if($product->specifications && count($product->specifications) > 0)
            <div class="mt-6">
                <h4 class="font-heading text-xs font-bold uppercase tracking-wider text-slate-700 mb-3">
                    Technical Parameters
                </h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <tbody class="divide-y divide-slate-100">
                            @foreach($product->specifications as $param => $val)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="py-2.5 px-3 font-semibold text-slate-700 bg-slate-50/70 w-1/3 sm:w-1/4">
                                        {{ $param }}
                                    </td>
                                    <td class="py-2.5 px-3 text-slate-800">
                                        {{ $val }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <!-- Direct Quick Inquiry Form on Page (White Theme) -->
    <div id="quick-inquiry" class="bg-slate-50 text-slate-900 rounded-3xl p-6 sm:p-10 mb-12 border border-slate-200 shadow-xs">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-6">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Direct Inquiry</span>
                <h3 class="font-heading text-xl font-bold mt-2">Inquire About {{ $product->model_code }}</h3>
                <p class="text-xs text-slate-500 mt-0.5">
                    Receive official commercial terms, shipping lead-time, and technical configuration support from Seoul.
                </p>
            </div>

            <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-3.5">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="inquiry_type" value="quote">
                <input type="hidden" name="subject" value="Quote for {{ $product->name }} ({{ $product->model_code }})">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Your Name *</label>
                        <input type="text" name="full_name" required placeholder="Dr. / Engineer Name" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-slate-900 text-xs focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Email Address *</label>
                        <input type="email" name="email" required placeholder="contact@hospital.com" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-slate-900 text-xs focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Hospital / Organization</label>
                        <input type="text" name="organization" placeholder="Clinic / Health Ministry" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-slate-900 text-xs focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Country / Destination</label>
                        <input type="text" name="country" placeholder="e.g. South Korea" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-slate-900 text-xs focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Message / Desired Units *</label>
                    <textarea name="message" rows="3" required placeholder="Specify quantity, destination port/airport, or accessories needed..." class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-slate-900 text-xs focus:ring-2 focus:ring-blue-600 outline-none"></textarea>
                </div>

                <div class="text-center pt-1">
                    <button type="submit" class="px-7 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs tracking-wide shadow-xs transition">
                        Submit Request for {{ $product->model_code }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Related Medical Equipment -->
    @if($relatedProducts->isNotEmpty())
        <div>
            <h3 class="font-heading text-lg font-bold text-slate-900 mb-4">
                Related Equipment in {{ $product->category->name }}
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($relatedProducts as $rel)
                    <div class="bg-white rounded-2xl border border-slate-200 p-4 hover:shadow-md transition">
                        <div class="h-36 bg-slate-100 rounded-xl overflow-hidden mb-3">
                            <img src="{{ $rel->image }}" alt="{{ $rel->name }}" class="w-full h-full object-cover">
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700 block mb-1">
                            {{ $rel->model_code }}
                        </span>
                        <h4 class="font-heading font-bold text-xs text-slate-900 mb-2 line-clamp-1">
                            <a href="{{ route('products.show', $rel->slug) }}" class="hover:text-blue-700">
                                {{ $rel->name }}
                            </a>
                        </h4>
                        <a href="{{ route('products.show', $rel->slug) }}" class="text-xs font-semibold text-blue-700 hover:underline">
                            View Model &rarr;
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
