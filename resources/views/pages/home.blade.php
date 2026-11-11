@extends('layouts.app')

@section('title', 'DIARAX Medical Systems | South Korean Medical Technology & Hospital Solutions')

@section('content')

<!-- 1. Hero Section (Clean Light Theme) -->
<section class="relative bg-gradient-to-b from-slate-50 via-sky-50/20 to-white text-slate-900 overflow-hidden py-12 lg:py-16 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            
            <!-- Left Column: Copy & Statistics -->
            <div class="lg:col-span-6 space-y-5 text-center lg:text-left">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-200/80 text-blue-700 text-xs font-semibold tracking-wide uppercase">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    <span>South Korean Technology &bull; ISO 13485 &bull; CE &bull; MFDS</span>
                </div>

                <h1 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 leading-tight">
                    South Korean Engineering for <span class="text-blue-700">Global Healthcare</span>
                </h1>

                <p class="text-sm sm:text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    DIARAX manufactures over 250 advanced medical equipment models across 40 clinical categories. From precision robotic-assisted operating suites to complete turnkey hospital equipping projects from Seoul, South Korea.
                </p>

                <!-- Statistics Strip (Clean White Cards) -->
                <div class="pt-4 grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                    <div class="p-3 bg-white rounded-xl border border-slate-200 shadow-xs">
                        <div class="font-heading text-2xl font-bold text-slate-900">40+</div>
                        <div class="text-[11px] text-slate-500 font-medium">Product Groups</div>
                    </div>
                    <div class="p-3 bg-white rounded-xl border border-slate-200 shadow-xs">
                        <div class="font-heading text-2xl font-bold text-slate-900">250+</div>
                        <div class="text-[11px] text-slate-500 font-medium">Medical Models</div>
                    </div>
                    <div class="p-3 bg-white rounded-xl border border-slate-200 shadow-xs">
                        <div class="font-heading text-2xl font-bold text-slate-900">80+</div>
                        <div class="text-[11px] text-slate-500 font-medium">Countries Served</div>
                    </div>
                    <div class="p-3 bg-white rounded-xl border border-slate-200 shadow-xs">
                        <div class="font-heading text-2xl font-bold text-blue-700">20+</div>
                        <div class="text-[11px] text-slate-500 font-medium">Years in Korea</div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Interactive Auto Image Slider -->
            <div class="lg:col-span-6 relative">
                <div class="relative rounded-3xl overflow-hidden shadow-xl border border-slate-200 bg-white group">
                    
                    <!-- Slider Container -->
                    <div id="hero-slider" class="relative h-80 sm:h-96 w-full overflow-hidden">
                        
                        <!-- Slide 1 -->
                        <div class="hero-slide absolute inset-0 transition-opacity duration-700 opacity-100 z-10">
                            <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1000&q=80" alt="DIARAX Operamed 3000 Operating Table" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                            <div class="absolute bottom-5 left-5 right-5 p-3.5 rounded-xl bg-white/90 backdrop-blur-md border border-white/80 flex items-center justify-between text-slate-900 shadow-sm">
                                <div>
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-blue-700 block">Surgical Suite</span>
                                    <h3 class="font-heading text-sm font-bold text-slate-900">DIARAX Operamed 3000</h3>
                                    <p class="text-[11px] text-slate-500">Electro-hydraulic Operating System</p>
                                </div>
                                <a href="{{ route('products.show', 'diarax-operamed-3000') }}" class="px-3 py-1.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-semibold text-xs transition">
                                    Details &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="hero-slide absolute inset-0 transition-opacity duration-700 opacity-0 z-0">
                            <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1000&q=80" alt="DIARAX Convelar 1675 Surgical Light" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                            <div class="absolute bottom-5 left-5 right-5 p-3.5 rounded-xl bg-white/90 backdrop-blur-md border border-white/80 flex items-center justify-between text-slate-900 shadow-sm">
                                <div>
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-blue-700 block">Operating Theater</span>
                                    <h3 class="font-heading text-sm font-bold text-slate-900">DIARAX Convelar 1675</h3>
                                    <p class="text-[11px] text-slate-500">Dual LED Shadowless Surgical Light</p>
                                </div>
                                <a href="{{ route('products.show', 'diarax-convelar-1675') }}" class="px-3 py-1.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-semibold text-xs transition">
                                    Details &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="hero-slide absolute inset-0 transition-opacity duration-700 opacity-0 z-0">
                            <img src="https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?auto=format&fit=crop&w=1000&q=80" alt="DIARAX Aeros 4600 Anesthesia Workstation" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                            <div class="absolute bottom-5 left-5 right-5 p-3.5 rounded-xl bg-white/90 backdrop-blur-md border border-white/80 flex items-center justify-between text-slate-900 shadow-sm">
                                <div>
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-blue-700 block">Anesthesia & ICU</span>
                                    <h3 class="font-heading text-sm font-bold text-slate-900">DIARAX Aeros 4600</h3>
                                    <p class="text-[11px] text-slate-500">Intelligent Digital Anesthesia Workstation</p>
                                </div>
                                <a href="{{ route('products.show', 'diarax-aeros-4600') }}" class="px-3 py-1.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-semibold text-xs transition">
                                    Details &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Slide 4 -->
                        <div class="hero-slide absolute inset-0 transition-opacity duration-700 opacity-0 z-0">
                            <img src="https://images.unsplash.com/photo-1530497610245-94d3c16cda28?auto=format&fit=crop&w=1000&q=80" alt="DIARAX Storm 5900 Patient Monitor" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                            <div class="absolute bottom-5 left-5 right-5 p-3.5 rounded-xl bg-white/90 backdrop-blur-md border border-white/80 flex items-center justify-between text-slate-900 shadow-sm">
                                <div>
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-blue-700 block">Critical Monitoring</span>
                                    <h3 class="font-heading text-sm font-bold text-slate-900">DIARAX Storm 5900</h3>
                                    <p class="text-[11px] text-slate-500">Modular Multi-Parameter Patient Monitor</p>
                                </div>
                                <a href="{{ route('products.show', 'diarax-storm-5900') }}" class="px-3 py-1.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-semibold text-xs transition">
                                    Details &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Slide 5 -->
                        <div class="hero-slide absolute inset-0 transition-opacity duration-700 opacity-0 z-0">
                            <img src="https://images.unsplash.com/photo-1587745416684-47953f16f02f?auto=format&fit=crop&w=1000&q=80" alt="DIARAX Mobile Clinic" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>
                            <div class="absolute bottom-5 left-5 right-5 p-3.5 rounded-xl bg-white/90 backdrop-blur-md border border-white/80 flex items-center justify-between text-slate-900 shadow-sm">
                                <div>
                                    <span class="text-[10px] uppercase font-bold tracking-wider text-blue-700 block">Turnkey Solutions</span>
                                    <h3 class="font-heading text-sm font-bold text-slate-900">DIARAX MobileClinic X1</h3>
                                    <p class="text-[11px] text-slate-500">All-Terrain Mobile Resuscitation Unit</p>
                                </div>
                                <a href="{{ route('products.show', 'diarax-mobileclinic-x1') }}" class="px-3 py-1.5 rounded-lg bg-blue-700 hover:bg-blue-800 text-white font-semibold text-xs transition">
                                    Details &rarr;
                                </a>
                            </div>
                        </div>

                    </div>

                    <!-- Slider Controls -->
                    <button type="button" onclick="prevHeroSlide()" class="absolute left-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/80 hover:bg-white text-slate-800 shadow flex items-center justify-center transition z-20" aria-label="Previous Slide">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button type="button" onclick="nextHeroSlide()" class="absolute right-3 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/80 hover:bg-white text-slate-800 shadow flex items-center justify-center transition z-20" aria-label="Next Slide">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>

                    <!-- Slider Indicators -->
                    <div class="absolute top-4 right-4 flex items-center space-x-1.5 z-20 bg-slate-900/40 backdrop-blur-xs px-2.5 py-1 rounded-full">
                        <span class="hero-dot w-2 h-2 rounded-full bg-white transition-all cursor-pointer" onclick="goToHeroSlide(0)"></span>
                        <span class="hero-dot w-2 h-2 rounded-full bg-white/40 transition-all cursor-pointer" onclick="goToHeroSlide(1)"></span>
                        <span class="hero-dot w-2 h-2 rounded-full bg-white/40 transition-all cursor-pointer" onclick="goToHeroSlide(2)"></span>
                        <span class="hero-dot w-2 h-2 rounded-full bg-white/40 transition-all cursor-pointer" onclick="goToHeroSlide(3)"></span>
                        <span class="hero-dot w-2 h-2 rounded-full bg-white/40 transition-all cursor-pointer" onclick="goToHeroSlide(4)"></span>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- 2. Medical Category Explorer Grid (White Theme) -->
<section class="py-14 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-50 px-3 py-1 rounded-full">Clinical Specialties</span>
            <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">
                Medical Equipment Catalog
            </h2>
            <p class="text-slate-600 text-xs sm:text-sm mt-1">
                Browse DIARAX's South Korean clinical portfolio categorized by hospital departments.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group relative rounded-2xl p-5 bg-slate-50 hover:bg-white border border-slate-200 hover:border-blue-300 hover:shadow-lg transition-all duration-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg group-hover:bg-blue-700 group-hover:text-white transition duration-200">
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
                            <span class="inline-flex items-center text-[11px] font-semibold px-2 py-0.5 rounded-full bg-slate-200/70 text-slate-700">
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

                    <div class="flex items-center text-xs font-bold text-blue-700 group-hover:text-blue-800 pt-2.5 border-t border-slate-200/60">
                        <span>Explore Department</span>
                        <svg class="w-3.5 h-3.5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- 3. Featured Products Showcase (White Theme) -->
<section class="py-14 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-8 gap-3">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Flagship Technology</span>
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

<!-- 4. Turnkey Solutions Section (White/Clean Theme) -->
<section class="py-14 bg-white border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-50 px-3 py-1 rounded-full">Turnkey Healthcare</span>
            <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">
                Hospital Engineering & Equipping Solutions
            </h2>
            <p class="text-slate-600 text-xs sm:text-sm mt-1">
                Complete hospital engineering from 3D architectural planning to modular cleanroom operating suites and mobile clinics.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($solutions as $solution)
                <div class="rounded-2xl bg-white border border-slate-200 overflow-hidden shadow-xs hover:shadow-lg transition duration-200 flex flex-col justify-between group">
                    <div class="relative h-44 overflow-hidden">
                        <img src="{{ $solution->image }}" alt="{{ $solution->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <span class="absolute bottom-2.5 left-3 text-[11px] font-semibold px-2 py-0.5 rounded bg-blue-700 text-white">
                            {{ $solution->category }}
                        </span>
                    </div>

                    <div class="p-5 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="font-heading text-base font-bold text-slate-900 mb-1.5 group-hover:text-blue-700 transition">
                                {{ $solution->title }}
                            </h3>
                            <p class="text-xs text-slate-500 leading-relaxed mb-3">
                                {{ $solution->overview }}
                            </p>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('solutions.show', $solution->slug) }}" class="text-xs font-bold text-blue-700 hover:text-blue-800">
                                Project Overview &rarr;
                            </a>
                            <a href="{{ route('quote', ['type' => 'turnkey', 'subject' => $solution->title]) }}" class="text-xs font-semibold px-2.5 py-1 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 rounded text-slate-700 transition">
                                Consult
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- 5. South Korean Quality & Compliance Section (White Theme) -->
<section class="py-14 bg-slate-50 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <div class="lg:col-span-6 space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Quality Assurance</span>
                <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900">
                    Engineered in Seoul to South Korean & Global Standards
                </h2>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Every medical device manufactured by DIARAX undergoes rigorous multi-stage quality control. From precision robotics to clinical biocompatibility testing and international regulatory certification.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2">
                    <div class="p-3.5 rounded-xl bg-white border border-slate-200 shadow-xs">
                        <span class="font-heading font-bold text-blue-700 text-sm block">ISO 13485:2016</span>
                        <p class="text-[11px] text-slate-500 mt-0.5">Medical Device Quality Management System accredited.</p>
                    </div>
                    <div class="p-3.5 rounded-xl bg-white border border-slate-200 shadow-xs">
                        <span class="font-heading font-bold text-emerald-600 text-sm block">MFDS Korea & CE</span>
                        <p class="text-[11px] text-slate-500 mt-0.5">Compliant with Korea MFDS and European CE clinical directives.</p>
                    </div>
                </div>
            </div>

            <!-- Fast Consultation Box in Light Theme -->
            <div class="lg:col-span-6">
                <div class="p-7 rounded-2xl bg-white border border-blue-200 shadow-sm text-slate-800 space-y-3">
                    <span class="text-[11px] font-bold tracking-widest text-blue-700 uppercase">Tender & Hospital Procurement</span>
                    <h3 class="font-heading text-xl font-bold text-slate-900">Request Official Quotations & Technical Documentation</h3>
                    <p class="text-slate-600 text-xs leading-relaxed">
                        Are you outfitting a new hospital wing, upgrading surgical suites, or preparing an international procurement tender? Our biomedical engineering team in Seoul provides complete technical dossiers and export pricing.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('quote') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-xs transition">
                            Initiate Tender Request &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Fast Interactive Medical Inquiry Form (White Theme) -->
<section class="py-14 bg-white" id="inquiry-form">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-slate-50 rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-sm">
            <div class="text-center max-w-lg mx-auto mb-6">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Direct Inquiry</span>
                <h2 class="font-heading text-xl sm:text-2xl font-bold text-slate-900 mt-2">
                    Request a Fast Quote or Consultation
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Connect with our sales specialists for pricing, specifications, and shipment schedules.
                </p>
            </div>

            <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-3.5">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Full Name *</label>
                        <input type="text" name="full_name" required placeholder="Dr. / Engineer Name" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Email Address *</label>
                        <input type="email" name="email" required placeholder="contact@hospital.org" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Phone / Mobile</label>
                        <input type="text" name="phone" placeholder="+82 2..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Organization / Clinic</label>
                        <input type="text" name="organization" placeholder="Hospital / Distributor" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Country</label>
                        <input type="text" name="country" placeholder="e.g. South Korea, Bangladesh" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-white">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Inquiry Purpose *</label>
                        <select name="inquiry_type" required class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-white">
                            <option value="quote">Equipment Price Quotation</option>
                            <option value="tender">Hospital Tender & Turnkey Project</option>
                            <option value="partnership">Dealer / Distribution Partnership</option>
                            <option value="support">Service & Spare Parts Support</option>
                            <option value="general">General Information</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Model Selection</label>
                        <select name="product_id" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-white">
                            <option value="">-- General Selection / Entire Catalog --</option>
                            @foreach($allProductsForTabs as $prod)
                                <option value="{{ $prod->id }}">{{ $prod->name }} ({{ $prod->model_code }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Message / Requirements *</label>
                    <textarea name="message" rows="3" required placeholder="Specify model quantities, shipping destination, or project requirements..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-white"></textarea>
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

<!-- Hero Slider Javascript (Smooth Auto-Cycle) -->
<script>
    let currentHeroSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.hero-dot');
    let sliderTimer = null;

    function showHeroSlide(index) {
        if (!slides.length) return;
        if (index >= slides.length) index = 0;
        if (index < 0) index = slides.length - 1;
        currentHeroSlide = index;

        slides.forEach((slide, i) => {
            if (i === currentHeroSlide) {
                slide.classList.remove('opacity-0', 'z-0');
                slide.classList.add('opacity-100', 'z-10');
            } else {
                slide.classList.remove('opacity-100', 'z-10');
                slide.classList.add('opacity-0', 'z-0');
            }
        });

        dots.forEach((dot, i) => {
            if (i === currentHeroSlide) {
                dot.classList.remove('bg-white/40');
                dot.classList.add('bg-white');
            } else {
                dot.classList.remove('bg-white');
                dot.classList.add('bg-white/40');
            }
        });
    }

    function nextHeroSlide() {
        showHeroSlide(currentHeroSlide + 1);
        resetHeroSliderTimer();
    }

    function prevHeroSlide() {
        showHeroSlide(currentHeroSlide - 1);
        resetHeroSliderTimer();
    }

    function goToHeroSlide(index) {
        showHeroSlide(index);
        resetHeroSliderTimer();
    }

    function startHeroSliderTimer() {
        sliderTimer = setInterval(() => {
            showHeroSlide(currentHeroSlide + 1);
        }, 3500);
    }

    function resetHeroSliderTimer() {
        if (sliderTimer) clearInterval(sliderTimer);
        startHeroSliderTimer();
    }

    document.addEventListener('DOMContentLoaded', () => {
        showHeroSlide(0);
        startHeroSliderTimer();
    });
</script>

@endsection
