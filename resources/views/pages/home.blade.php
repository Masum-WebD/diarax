@extends('layouts.app')

@section('title', 'DIARAX Medical Systems | South Korean Medical Technology & Hospital Solutions')

@section('content')

<!-- 1. Hero Banner Slider (Full-Width Background Images with Overlay Text & Auto Transition) -->
<section class="relative bg-slate-950 text-white min-h-[440px] sm:min-h-[480px] lg:min-h-[520px] overflow-hidden" id="hero-slider-section">
    
    <!-- Slides Container -->
    <div class="relative w-full h-[440px] sm:h-[480px] lg:h-[520px]">
        @foreach($banners as $index => $banner)
            <div class="banner-slide absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }} flex items-center">
                <img 
                    src="{{ $banner->image }}" 
                    alt="{{ $banner->title }}" 
                    class="absolute inset-0 w-full h-full object-cover object-center filter brightness-75 scale-105"
                >
                <div class="absolute inset-0 bg-gradient-to-r from-slate-950/90 via-slate-950/75 to-slate-900/40"></div>
                <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-12">
                    <div class="max-w-2xl space-y-4">
                        @if($banner->badge)
                            <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-blue-600/30 backdrop-blur-md border border-blue-400/40 text-blue-200 text-xs font-semibold tracking-wide uppercase">
                                <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                                <span>{{ $banner->badge }}</span>
                            </div>
                        @endif
                        <h1 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-white leading-tight">
                            {{ $banner->title }}
                        </h1>
                        <p class="text-sm sm:text-base text-slate-200 leading-relaxed font-normal">
                            {{ $banner->subtitle }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Navigation Arrows -->
    @if(count($banners) > 1)
        <button type="button" onclick="prevBannerSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/40 hover:bg-black/70 text-white backdrop-blur-md border border-white/20 flex items-center justify-center transition z-30" aria-label="Previous Slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button type="button" onclick="nextBannerSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-black/40 hover:bg-black/70 text-white backdrop-blur-md border border-white/20 flex items-center justify-center transition z-30" aria-label="Next Slide">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        <!-- Slide Indicators -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center space-x-2 z-30 bg-black/40 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/20">
            @foreach($banners as $index => $banner)
                <button type="button" onclick="goToBannerSlide({{ $index }})" class="banner-dot {{ $index === 0 ? 'w-6 bg-white' : 'w-2 bg-white/40 hover:bg-white/70' }} h-2 rounded-full transition-all"></button>
            @endforeach
        </div>
    @endif
</section>

<!-- 2. Statistics Counter Strip (Dedicated Part Below Banner) -->
<section class="bg-white border-b border-slate-200 py-6 sm:py-8 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 text-center">
            
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-blue-300 hover:bg-white hover:shadow-md transition duration-200">
                <div class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900">40+</div>
                <div class="text-xs sm:text-sm font-semibold text-slate-700 mt-1">Product Groups</div>
                <div class="text-[11px] text-slate-400 mt-0.5">Specialized Clinical Categories</div>
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-blue-300 hover:bg-white hover:shadow-md transition duration-200">
                <div class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900">250+</div>
                <div class="text-xs sm:text-sm font-semibold text-slate-700 mt-1">Medical Models</div>
                <div class="text-[11px] text-slate-400 mt-0.5">Precision Certified Equipment</div>
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-blue-300 hover:bg-white hover:shadow-md transition duration-200">
                <div class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900">80+</div>
                <div class="text-xs sm:text-sm font-semibold text-slate-700 mt-1">Countries Served</div>
                <div class="text-[11px] text-slate-400 mt-0.5">Worldwide Hospital Installations</div>
            </div>

            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-blue-300 hover:bg-white hover:shadow-md transition duration-200">
                <div class="text-2xl sm:text-3xl font-extrabold font-heading text-blue-700">20+</div>
                <div class="text-xs sm:text-sm font-semibold text-slate-700 mt-1">Years in Korea</div>
                <div class="text-[11px] text-slate-400 mt-0.5">Seoul Biomedical Innovation</div>
            </div>

        </div>
    </div>
</section>

<!-- 3. Compact About DIARAX Section -->
<section class="py-12 lg:py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- Left: About Text & Highlights -->
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold uppercase tracking-wider">
                    <span>About DIARAX Medical Systems</span>
                </div>

                <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight leading-snug">
                    Pioneering South Korean Medical Technology Since 2004
                </h2>

                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Headquartered in Teheran-ro, Gangnam-gu, Seoul, DIARAX is a premier South Korean medical technology manufacturer. We specialize in surgical suite solutions, life support ventilation, patient monitoring, and critical diagnostic systems built to the most stringent international standards.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <div class="text-xs font-bold text-slate-900">MFDS & CE Certified</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Full compliance with Korea MFDS and European CE standards.</div>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <div class="text-xs font-bold text-slate-900">Seoul R&D Facility</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Cutting-edge biomedical robotics and precision engineering.</div>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                        <div class="text-xs font-bold text-slate-900">Global Support</div>
                        <div class="text-[11px] text-slate-500 mt-0.5">Authorized service centers and spare parts in 80+ nations.</div>
                    </div>
                </div>

                <div class="pt-2">
                    <a href="{{ route('about') }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-semibold text-xs transition shadow-xs">
                        <span>Read More About DIARAX</span>
                        <svg class="w-3.5 h-3.5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right: Facility / Equipment Image Card -->
            <div class="lg:col-span-5">
                <div class="relative rounded-2xl overflow-hidden border border-slate-200 shadow-md group">
                    <img 
                        src="https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=800&q=80" 
                        alt="DIARAX South Korea Medical Facility" 
                        class="w-full h-72 sm:h-80 object-cover group-hover:scale-105 transition-transform duration-300"
                    >
                    <div class="absolute bottom-4 left-4 right-4 p-3.5 rounded-xl bg-white/95 backdrop-blur-md border border-white/80 shadow-xs flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700 block">Headquarters & Manufacturing</span>
                            <div class="text-xs font-bold text-slate-900">Seoul, South Korea</div>
                            <div class="text-[11px] text-slate-500">ISO 13485:2016 Certified</div>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-xs">
                            KR
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 4. Medical Category Explorer Grid (White Theme) -->
<section class="py-12 lg:py-14 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Clinical Specialties</span>
            <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">
                Medical Equipment Catalog
            </h2>
            <p class="text-slate-600 text-xs sm:text-sm mt-1">
                Browse DIARAX's South Korean clinical portfolio categorized by hospital departments.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group relative rounded-2xl p-5 bg-white hover:bg-white border border-slate-200 hover:border-blue-300 hover:shadow-lg transition-all duration-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-lg group-hover:bg-blue-700 group-hover:text-white transition duration-200">
                                @if($category->slug == 'surgery-operating-theatres')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879a3 3 0 11-4.243-4.242 3 3 0 014.243 0z"/></svg>
                                @elseif($category->slug == 'anesthesia-respiratory')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                @elseif($category->slug == 'intensive-care-neonatology')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                @elseif($category->slug == 'diagnostics-imaging')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                @elseif($category->slug == 'hospital-furniture')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                @endif
                            </div>
                            <span class="inline-flex items-center text-[11px] font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-700">
                                {{ $category->products_count }} {{ Str::plural('Model', $category->products_count) }}
                            </span>
                        </div>

                        <h3 class="font-heading text-base font-bold text-slate-900 group-hover:text-blue-700 transition mb-1.5">
                            {{ $category->name }}
                        </h3>

                        <p class="text-xs text-slate-500 leading-relaxed mb-3">
                            {{ $category->short_description }}
                        </p>
                    </div>

                    <div class="flex items-center text-xs font-bold text-blue-700 group-hover:text-blue-800 pt-2.5 border-t border-slate-100">
                        <span>Explore Department</span>
                        <svg class="w-3.5 h-3.5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- 5. Featured Products Showcase (White Theme) -->
<section class="py-12 lg:py-16 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-3">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-50 px-3 py-1 rounded-full">Flagship Technology</span>
                <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">
                    Featured Medical Devices
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm mt-1">
                    Precision South Korean clinical systems engineered for demanding hospital applications.
                </p>
            </div>
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-xs font-bold text-blue-700 hover:text-blue-800 group">
                <span>View Full Catalog</span>
                <svg class="w-3.5 h-3.5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($featuredProducts as $product)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-lg hover:border-blue-300 transition duration-200 flex flex-col justify-between group">
                    <div class="relative h-44 bg-slate-100 overflow-hidden">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        <span class="absolute top-2.5 left-2.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-white/90 text-slate-900 backdrop-blur-xs shadow-xs">
                            {{ $product->category->name }}
                        </span>
                        @if($product->is_new)
                            <span class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-600 text-white">
                                New
                            </span>
                        @endif
                    </div>

                    <div class="p-4 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-[11px] font-bold text-blue-700 tracking-wider uppercase block mb-1">
                                {{ $product->model_code }}
                            </span>
                            <h3 class="font-heading text-sm font-bold text-slate-900 group-hover:text-blue-700 transition mb-1.5 line-clamp-1">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-3">
                                {{ $product->short_description }}
                            </p>
                        </div>

                        <!-- Card Action Buttons in Single Line -->
                        <div class="pt-2.5 border-t border-slate-100 flex items-center gap-2">
                            <a href="{{ route('products.show', $product->slug) }}" class="flex-1 text-center py-1.5 px-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition">
                                Details
                            </a>
                            <a href="{{ route('quote', ['product_id' => $product->id]) }}" class="flex-1 text-center py-1.5 px-2 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-semibold text-xs transition">
                                Quote
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 6. Fast Medical Inquiry Form (White Theme) -->
<section class="py-14 bg-slate-50" id="inquiry-form">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm">
            <div class="text-center max-w-lg mx-auto mb-6">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-50 px-3 py-1 rounded-full">Direct Inquiry</span>
                <h2 class="font-heading text-xl sm:text-2xl font-bold text-slate-900 mt-2">
                    Request a Fast Quote or Consultation
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Connect with our biomedical specialists in Seoul for pricing, specifications, and shipment schedules.
                </p>
            </div>

            <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-3.5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Full Name *</label>
                        <input type="text" name="full_name" required placeholder="Dr. / Engineer Name" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-slate-50 focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Email Address *</label>
                        <input type="email" name="email" required placeholder="contact@hospital.org" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-slate-50 focus:bg-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Phone / Mobile</label>
                        <input type="text" name="phone" placeholder="+82 2..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-slate-50 focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Organization / Clinic</label>
                        <input type="text" name="organization" placeholder="Hospital / Distributor" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-slate-50 focus:bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Country</label>
                        <input type="text" name="country" placeholder="e.g. South Korea" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-slate-50 focus:bg-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Inquiry Purpose *</label>
                        <select name="inquiry_type" required class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-slate-50 focus:bg-white">
                            <option value="quote">Equipment Price Quotation</option>
                            <option value="tender">Hospital Tender & Project</option>
                            <option value="partnership">Dealer / Distribution Partnership</option>
                            <option value="support">Service & Spare Parts Support</option>
                            <option value="general">General Information</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Model Selection</label>
                        <select name="product_id" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-slate-50 focus:bg-white">
                            <option value="">-- General Selection / Entire Catalog --</option>
                            @foreach($allProductsForTabs as $prod)
                                <option value="{{ $prod->id }}">{{ $prod->name }} ({{ $prod->model_code }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Message / Requirements *</label>
                    <textarea name="message" rows="3" required placeholder="Specify model quantities, shipping destination, or hospital specifications..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-slate-50 focus:bg-white"></textarea>
                </div>

                <div class="text-center pt-2">
                    <button type="submit" class="w-full sm:w-auto px-7 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs tracking-wide shadow-sm transition">
                        Submit Inquiry to DIARAX
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
    let currentBannerSlide = 0;
    const bannerSlides = document.querySelectorAll('.banner-slide');
    const bannerDots = document.querySelectorAll('.banner-dot');
    let bannerTimer = null;

    function showBannerSlide(index) {
        if (!bannerSlides.length) return;
        if (index >= bannerSlides.length) index = 0;
        if (index < 0) index = bannerSlides.length - 1;
        currentBannerSlide = index;

        bannerSlides.forEach((slide, i) => {
            if (i === currentBannerSlide) {
                slide.classList.remove('opacity-0', 'z-0');
                slide.classList.add('opacity-100', 'z-10');
            } else {
                slide.classList.remove('opacity-100', 'z-10');
                slide.classList.add('opacity-0', 'z-0');
            }
        });

        bannerDots.forEach((dot, i) => {
            if (i === currentBannerSlide) {
                dot.classList.remove('w-2', 'bg-white/40');
                dot.classList.add('w-6', 'bg-white');
            } else {
                dot.classList.remove('w-6', 'bg-white');
                dot.classList.add('w-2', 'bg-white/40');
            }
        });
    }

    function nextBannerSlide() {
        showBannerSlide(currentBannerSlide + 1);
        resetBannerTimer();
    }

    function prevBannerSlide() {
        showBannerSlide(currentBannerSlide - 1);
        resetBannerTimer();
    }

    function goToBannerSlide(index) {
        showBannerSlide(index);
        resetBannerTimer();
    }

    function startBannerTimer() {
        bannerTimer = setInterval(() => {
            showBannerSlide(currentBannerSlide + 1);
        }, 4500);
    }

    function resetBannerTimer() {
        if (bannerTimer) clearInterval(bannerTimer);
        startBannerTimer();
    }

    document.addEventListener('DOMContentLoaded', () => {
        showBannerSlide(0);
        startBannerTimer();
    });
</script>
@endpush

@endsection
