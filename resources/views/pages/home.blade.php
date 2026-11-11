@extends('layouts.app')

@section('title', 'DIXION Medical Systems | German Medical Equipment & Turnkey Solutions')

@section('content')

@if($showEntrance)
    <!-- Optional Splash / Entrance Gate (Simulating dixion.com entrance) -->
    <section class="min-h-screen bg-gradient-to-br from-slate-950 via-slate-900 to-sky-950 text-white flex items-center justify-center p-6 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#38bdf8_1px,transparent_1px)] [background-size:20px_20px]"></div>
        <div class="max-w-2xl w-full text-center relative z-10 space-y-8 bg-slate-900/60 backdrop-blur-xl p-8 sm:p-12 rounded-3xl border border-slate-700/50 shadow-2xl">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-tr from-sky-500 to-blue-600 shadow-xl shadow-sky-500/20 mx-auto text-4xl font-black">
                +
            </div>
            <div>
                <h1 class="font-heading text-4xl sm:text-5xl font-extrabold tracking-tight">DIXION</h1>
                <p class="text-sky-400 font-semibold tracking-widest uppercase text-sm mt-2">Vertrieb medizinischer Geräte GmbH &bull; Düsseldorf</p>
            </div>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                Welcome to DIXION's global corporate healthcare portal. High-end medical devices, operating room systems, and comprehensive turnkey hospital equipping solutions.
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs font-semibold">
                <a href="{{ route('home', ['entrance' => 'skip', 'lang' => 'en']) }}" class="p-3 rounded-xl bg-slate-800 hover:bg-sky-600 transition border border-slate-700">
                    <span class="block text-lg mb-1">🇬🇧</span> English
                </a>
                <a href="{{ route('home', ['entrance' => 'skip', 'lang' => 'de']) }}" class="p-3 rounded-xl bg-slate-800 hover:bg-sky-600 transition border border-slate-700">
                    <span class="block text-lg mb-1">🇩🇪</span> Deutsch
                </a>
                <a href="{{ route('home', ['entrance' => 'skip', 'lang' => 'ru']) }}" class="p-3 rounded-xl bg-slate-800 hover:bg-sky-600 transition border border-slate-700">
                    <span class="block text-lg mb-1">🇷🇺</span> Русский
                </a>
                <a href="{{ route('home', ['entrance' => 'skip', 'lang' => 'es']) }}" class="p-3 rounded-xl bg-slate-800 hover:bg-sky-600 transition border border-slate-700">
                    <span class="block text-lg mb-1">🇪🇸</span> Español
                </a>
            </div>

            <div class="pt-4">
                <a href="{{ route('home', ['entrance' => 'skip']) }}" class="inline-flex items-center px-8 py-3.5 rounded-2xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-bold text-sm tracking-wide shadow-lg shadow-sky-500/20 transition transform hover:-translate-y-0.5">
                    Enter Main Portal (Skip Intro)
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </section>
@else

    <!-- 1. Hero Section: High-End Medical Engineering -->
    <section class="relative bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 text-white overflow-hidden py-16 lg:py-24">
        <!-- Subtle medical background grid & glow -->
        <div class="absolute inset-0 opacity-15 bg-[radial-gradient(#38bdf8_1px,transparent_1px)] [background-size:24px_24px]"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-sky-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Column: Copy & Actions -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-sky-500/10 border border-sky-400/20 text-sky-400 text-xs font-semibold tracking-wide uppercase">
                        <span class="w-2 h-2 rounded-full bg-sky-400 animate-ping"></span>
                        <span>German Quality &bull; ISO 13485 &bull; EU MDR 2017/745</span>
                    </div>

                    <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                        German Engineering for <span class="bg-gradient-to-r from-sky-400 to-cyan-300 bg-clip-text text-transparent">Global Healthcare</span>
                    </h1>

                    <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        DIXION delivers more than 250 advanced medical equipment models across 40 product categories. From state-of-the-art operating suites to complete turnkey hospital equipping projects.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="{{ route('products.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 rounded-xl font-bold text-sm bg-sky-500 hover:bg-sky-400 text-slate-950 shadow-lg shadow-sky-500/25 transition transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            Explore Equipment Catalog
                        </a>
                        <a href="{{ route('solutions.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 rounded-xl font-bold text-sm bg-slate-800/80 hover:bg-slate-700 text-white border border-slate-700 transition">
                            Turnkey Hospital Solutions
                        </a>
                        <a href="{{ route('quote') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 rounded-xl font-bold text-sm text-sky-400 hover:text-white transition">
                            Request Quote &rarr;
                        </a>
                    </div>

                    <!-- Statistics Strip -->
                    <div class="pt-8 border-t border-slate-800 grid grid-cols-2 sm:grid-cols-4 gap-6 text-center lg:text-left">
                        <div>
                            <div class="font-heading text-2xl sm:text-3xl font-bold text-white">40+</div>
                            <div class="text-xs text-slate-400 mt-0.5">Product Groups</div>
                        </div>
                        <div>
                            <div class="font-heading text-2xl sm:text-3xl font-bold text-white">250+</div>
                            <div class="text-xs text-slate-400 mt-0.5">Equipment Models</div>
                        </div>
                        <div>
                            <div class="font-heading text-2xl sm:text-3xl font-bold text-white">80+</div>
                            <div class="text-xs text-slate-400 mt-0.5">Countries Served</div>
                        </div>
                        <div>
                            <div class="font-heading text-2xl sm:text-3xl font-bold text-sky-400">20+</div>
                            <div class="text-xs text-slate-400 mt-0.5">Years of Excellence</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Visual Device Showcase Card -->
                <div class="lg:col-span-5 relative">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-slate-700/60 bg-gradient-to-tr from-slate-800 to-slate-900 group">
                        <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1000&q=80" alt="DIXION Operating Theater Suite" class="w-full h-96 object-cover object-center group-hover:scale-105 transition-transform duration-500 opacity-90">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>

                        <!-- Device Floating Tag -->
                        <div class="absolute bottom-6 left-6 right-6 p-4 rounded-2xl bg-slate-900/80 backdrop-blur-md border border-slate-700/60 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] uppercase font-bold tracking-wider text-sky-400">Featured Surgical Suite</span>
                                <h3 class="font-heading text-base font-bold text-white">Dixion Operamed 3000</h3>
                                <p class="text-xs text-slate-300">Electro-hydraulic Operating System</p>
                            </div>
                            <a href="{{ route('products.show', 'dixion-operamed-3000') }}" class="p-2.5 rounded-xl bg-sky-500 text-slate-950 font-bold hover:bg-sky-400 transition" title="View details">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Medical Category Explorer Grid -->
    <section class="py-16 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">Clinical Specialties</span>
                <h2 class="font-heading text-3xl font-extrabold text-slate-900 mt-2 sm:text-4xl">
                    Comprehensive Medical Equipment Catalog
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-2">
                    Browse DIXION's uniform trademark portfolio categorized by hospital and surgical departments.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group relative rounded-2xl p-6 bg-slate-50 hover:bg-white border border-slate-200/80 hover:border-sky-300 hover:shadow-xl hover:shadow-sky-600/5 transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-xl group-hover:bg-sky-600 group-hover:text-white transition duration-300">
                                    @if($category->slug == 'surgery-operating-theatres')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879a3 3 0 11-4.243-4.242 3 3 0 014.243 0z"/></svg>
                                    @elseif($category->slug == 'anesthesia-respiratory')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    @elseif($category->slug == 'intensive-care-neonatology')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                    @elseif($category->slug == 'diagnostics-imaging')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                    @elseif($category->slug == 'hospital-furniture')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    @else
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    @endif
                                </div>
                                <span class="inline-flex items-center text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-200/70 text-slate-700 group-hover:bg-sky-100 group-hover:text-sky-700 transition">
                                    {{ $category->products_count }} {{ Str::plural('Model', $category->products_count) }}
                                </span>
                            </div>

                            <h3 class="font-heading text-lg font-bold text-slate-900 group-hover:text-sky-600 transition mb-2">
                                {{ $category->name }}
                            </h3>

                            <p class="text-xs text-slate-600 leading-relaxed mb-4">
                                {{ $category->short_description }}
                            </p>
                        </div>

                        <div class="flex items-center text-xs font-bold text-sky-600 group-hover:text-sky-700 pt-3 border-t border-slate-200/60">
                            <span>Browse Department</span>
                            <svg class="w-3.5 h-3.5 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 3. Featured Products Showcase Section -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-100 px-3 py-1 rounded-full">Flagship Systems</span>
                    <h2 class="font-heading text-3xl font-extrabold text-slate-900 mt-2 sm:text-4xl">
                        Featured Medical Equipment
                    </h2>
                    <p class="text-slate-600 text-sm mt-1">
                        High-precision clinical workstations designed and certified for demanding hospital environments.
                    </p>
                </div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm font-semibold text-sky-600 hover:text-sky-700 group">
                    <span>View All Equipment</span>
                    <svg class="w-4 h-4 ml-1.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:border-sky-300 transition duration-300 flex flex-col justify-between group">
                        <!-- Image Container -->
                        <div class="relative h-52 bg-slate-100 overflow-hidden">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <!-- Category Badge -->
                            <div class="absolute top-3 left-3">
                                <span class="inline-block px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-slate-900/80 text-white backdrop-blur-sm">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                            @if($product->is_new)
                                <div class="absolute top-3 right-3">
                                    <span class="inline-block px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-emerald-600 text-white">
                                        New Generation
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Body Content -->
                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-sky-600 tracking-wider uppercase block mb-1">
                                    Model: {{ $product->model_code }}
                                </span>
                                <h3 class="font-heading text-base font-bold text-slate-900 group-hover:text-sky-600 transition mb-2">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">
                                    {{ $product->short_description }}
                                </p>
                            </div>

                            <!-- Key Specs Preview -->
                            @if($product->specifications)
                                <div class="bg-slate-50 rounded-xl p-2.5 border border-slate-100 mb-4 text-[11px] text-slate-600 space-y-1">
                                    @foreach(array_slice($product->specifications, 0, 2) as $key => $val)
                                        <div class="flex justify-between items-center">
                                            <span class="text-slate-400 font-medium">{{ $key }}:</span>
                                            <span class="font-semibold text-slate-700">{{ $val }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Card Footer Action Buttons -->
                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                                <a href="{{ route('products.show', $product->slug) }}" class="flex-1 text-center py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition">
                                    Specifications
                                </a>
                                <a href="{{ route('quote', ['product_id' => $product->id]) }}" class="flex-1 text-center py-2 px-3 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-semibold text-xs transition shadow-sm">
                                    Quote Request
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 4. Turnkey Solutions Section -->
    <section class="py-16 bg-slate-950 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="text-xs font-bold uppercase tracking-widest text-sky-400 bg-sky-500/10 border border-sky-400/20 px-3.5 py-1 rounded-full">Turnkey Engineering</span>
                <h2 class="font-heading text-3xl font-extrabold text-white mt-3 sm:text-4xl">
                    Complex Hospital Equipping Solutions
                </h2>
                <p class="text-slate-300 text-sm sm:text-base mt-2">
                    Beyond manufacturing individual instruments, DIXION specializes in complete hospital engineering, cleanroom modular operating theatres, and mobile health fleets.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($solutions as $solution)
                    <div class="rounded-3xl bg-slate-900 border border-slate-800 overflow-hidden shadow-xl flex flex-col justify-between group hover:border-sky-500/50 transition duration-300">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $solution->image }}" alt="{{ $solution->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                            <span class="absolute bottom-3 left-4 text-xs font-semibold px-2.5 py-1 rounded-lg bg-sky-600 text-white">
                                {{ $solution->category }}
                            </span>
                        </div>

                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="font-heading text-lg font-bold text-white mb-2 group-hover:text-sky-400 transition">
                                    {{ $solution->title }}
                                </h3>
                                <p class="text-xs text-slate-400 leading-relaxed mb-4">
                                    {{ $solution->overview }}
                                </p>

                                @if($solution->deliverables)
                                    <ul class="space-y-1.5 mb-6 text-xs text-slate-300">
                                        @foreach(array_slice($solution->deliverables, 0, 3) as $deliv)
                                            <li class="flex items-start">
                                                <svg class="w-3.5 h-3.5 text-sky-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                <span>{{ $deliv }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <a href="{{ route('solutions.show', $solution->slug) }}" class="inline-flex items-center text-xs font-bold text-sky-400 hover:text-sky-300 group/link">
                                <span>Learn More About This Project</span>
                                <svg class="w-3.5 h-3.5 ml-1 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 5. German Quality & Compliance Section -->
    <section class="py-16 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-6 space-y-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">Quality Assurance</span>
                    <h2 class="font-heading text-3xl font-extrabold text-slate-900 sm:text-4xl">
                        Engineered in Düsseldorf to Rigorous European Standards
                    </h2>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Every medical device manufactured under the DIXION trademark undergoes strict multi-stage quality control. From clinical biocompatibility testing to electrical surge isolation and long-term durability benchmarking.
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                            <div class="w-8 h-8 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center font-bold text-sm mb-2">
                                ISO
                            </div>
                            <h4 class="font-heading font-bold text-slate-900 text-sm">ISO 13485:2016</h4>
                            <p class="text-xs text-slate-500 mt-1">Medical Device Quality Management System audited and accredited.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm mb-2">
                                CE
                            </div>
                            <h4 class="font-heading font-bold text-slate-900 text-sm">EU MDR 2017/745</h4>
                            <p class="text-xs text-slate-500 mt-1">Complete clinical safety conformity under European Union MDR.</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-6">
                    <div class="p-8 rounded-3xl bg-gradient-to-br from-slate-900 to-sky-950 text-white shadow-xl relative overflow-hidden">
                        <div class="relative z-10 space-y-4">
                            <span class="text-xs font-bold tracking-widest text-sky-400 uppercase">Tender & Hospital Inquiries</span>
                            <h3 class="font-heading text-2xl font-bold">Request Official Quotations & Technical Documentation</h3>
                            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                                Are you outfitting a new hospital wing, upgrading surgical theatres, or preparing a government procurement tender? Our biomedical engineering team in Düsseldorf provides complete technical dossiers, CAD drawings, and export quotations.
                            </p>
                            <div class="pt-2">
                                <a href="{{ route('quote') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-md transition">
                                    Initiate Tender Request &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Fast Interactive Medical Inquiry Form -->
    <section class="py-16 bg-slate-100" id="inquiry-form">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-xl border border-slate-200">
                <div class="text-center max-w-xl mx-auto mb-8">
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">Direct Contact</span>
                    <h2 class="font-heading text-2xl sm:text-3xl font-bold text-slate-900 mt-2">
                        Request a Fast Quote or Consultation
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-600 mt-1">
                        Connect with our sales specialists for pricing, warranty, and distribution details.
                    </p>
                </div>

                <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Full Name *</label>
                            <input type="text" name="full_name" required placeholder="e.g. Dr. Thomas Becker" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email Address *</label>
                            <input type="email" name="email" required placeholder="t.becker@hospital.de" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 text-sm outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Phone / WhatsApp</label>
                            <input type="text" name="phone" placeholder="+49 211 4455..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Organization / Clinic</label>
                            <input type="text" name="organization" placeholder="University Clinic / Distributor" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Country</label>
                            <input type="text" name="country" placeholder="e.g. Germany, UK, UAE" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 text-sm outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Inquiry Type *</label>
                            <select name="inquiry_type" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 text-sm outline-none bg-white">
                                <option value="quote">Equipment Price Quotation</option>
                                <option value="tender">Hospital Tender & Turnkey Project</option>
                                <option value="partnership">Dealer / Distribution Partnership</option>
                                <option value="support">Service & Spare Parts Support</option>
                                <option value="general">General Information</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Equipment of Interest</label>
                            <select name="product_id" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 text-sm outline-none bg-white">
                                <option value="">-- General Selection / Entire Catalog --</option>
                                @foreach($allProductsForTabs as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->name }} ({{ $prod->model_code }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Message / Requirements *</label>
                        <textarea name="message" rows="4" required placeholder="Specify model numbers, quantity, delivery timeframes, or project specifications..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 text-sm outline-none"></textarea>
                    </div>

                    <div class="text-center pt-2">
                        <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-gradient-to-r from-sky-600 to-blue-700 hover:from-sky-500 hover:to-blue-600 text-white font-bold text-sm tracking-wide shadow-lg shadow-sky-600/25 transition">
                            Submit Inquiry to DIXION
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- 7. News & Medical Exhibitions -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">Events & Updates</span>
                    <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">
                        News & International Exhibitions
                    </h2>
                </div>
                <a href="{{ route('news') }}" class="text-sm font-semibold text-sky-600 hover:text-sky-700">
                    All News &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($latestNews as $article)
                    <article class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80 hover:border-sky-300 transition duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between text-xs text-slate-500 mb-3">
                                <span class="font-semibold text-sky-600">{{ $article->category }}</span>
                                <span>{{ $article->event_date ? $article->event_date->format('M d, Y') : 'Announcement' }}</span>
                            </div>
                            <h3 class="font-heading text-base font-bold text-slate-900 mb-2">
                                {{ $article->title }}
                            </h3>
                            <p class="text-xs text-slate-600 leading-relaxed">
                                {{ $article->summary }}
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-slate-200 text-xs font-medium text-slate-500 flex items-center">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            <span>{{ $article->location }}</span>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endif

@endsection
