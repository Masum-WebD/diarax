<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'DIARAX Medical Systems | South Korean Medical Technology & Hospital Solutions')</title>
    <meta name="description" content="@yield('meta_description', 'DIARAX Medical Systems — Leading South Korean manufacturer of high-precision surgical tables, anesthesia workstations, ICU ventilators, patient monitors, and turnkey hospital equipping solutions.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        .font-heading {
            font-family: 'Space Grotesk', 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-white text-slate-800 antialiased selection:bg-blue-600 selection:text-white flex flex-col min-h-screen">

    <!-- Main Navigation Bar (Clean, Compact, White Theme) -->
    <nav class="bg-white/95 backdrop-blur-md shadow-xs border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand Logo (Clean, Small, No Text Beside It) -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <img src="{{ asset('images/logo.png') }}" alt="DIARAX" class="h-6 sm:h-7 w-auto object-contain group-hover:opacity-90 transition">
                    </a>
                </div>

                <!-- Desktop Menu (Exactly as requested) -->
                <div class="hidden lg:flex items-center space-x-1 xl:space-x-2 text-xs font-semibold">
                    
                    <!-- 1. Products with Cascading Hover Mega Menu -->
                    <div class="relative group" id="products-mega-group">
                        <a href="{{ route('products.index') }}" class="px-3 py-1.5 rounded-lg transition inline-flex items-center {{ request()->routeIs('products.*') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                            <span>Products</span>
                            <svg class="w-3.5 h-3.5 ml-1 text-slate-400 group-hover:text-blue-700 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>

                        <!-- Dropdown Container -->
                        <div class="absolute left-0 mt-1 bg-white rounded-2xl shadow-2xl border border-slate-200/90 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 translate-y-2 z-50 flex overflow-hidden" style="width: 880px; max-width: calc(100vw - 2rem);">
                            
                            <!-- Tier 1: Main Categories List (Left Column, w-56) -->
                            <div class="w-56 bg-slate-50/90 p-3 border-r border-slate-200/80 space-y-1 flex-shrink-0" style="width: 224px; min-width: 224px;">
                                <div class="px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                                    Clinical Divisions
                                </div>
                                @foreach($navCategories ?? [] as $navCat)
                                    <div 
                                        class="category-hover-item flex items-center justify-between px-3 py-2 rounded-xl text-xs font-medium cursor-pointer transition {{ $loop->first ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-700' }}"
                                        data-cat-id="{{ $navCat->id }}"
                                        onmouseenter="switchMegaCategory({{ $navCat->id }}, this)"
                                    >
                                        <a href="{{ route('products.index', ['category' => $navCat->slug]) }}" class="truncate flex-1">
                                            {{ $navCat->name }}
                                        </a>
                                        <svg class="w-3.5 h-3.5 text-slate-400 ml-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Tier 2 & Tier 3: Category Content Panels -->
                            <div class="flex-1 bg-white min-h-[360px] flex flex-col justify-between overflow-hidden" style="width: 656px; min-width: 656px;">
                                @foreach($navCategories ?? [] as $navCat)
                                    @php
                                        $hasSubcategories = $navCat->subcategories->count() > 0;
                                        $directProds = $navCat->products->whereNull('subcategory_id');
                                    @endphp
                                    <div id="cat-panel-{{ $navCat->id }}" class="category-product-panel {{ $loop->first ? 'flex' : 'hidden' }} flex-1 flex-col justify-between h-full" style="width: 100%;">
                                        
                                        @if($hasSubcategories)
                                            <!-- Layout for Category WITH Subcategories (3-Tier Layout) -->
                                            <div class="flex flex-1 min-h-[310px]">
                                                
                                                <!-- Tier 2: Subcategories Column (Middle, w-52) -->
                                                <div class="w-52 bg-slate-50/50 p-2.5 border-r border-slate-100 flex-shrink-0 space-y-1" style="width: 208px; min-width: 208px;">
                                                    <div class="px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400 flex items-center justify-between">
                                                        <span>Subcategories</span>
                                                        <span class="text-[9px] text-blue-600 font-bold">({{ $navCat->subcategories->count() }})</span>
                                                    </div>

                                                    @foreach($navCat->subcategories as $subCat)
                                                        @php
                                                            $subProds = $subCat->subcategoryProducts->isNotEmpty() ? $subCat->subcategoryProducts : $subCat->products;
                                                        @endphp
                                                        <div 
                                                            class="subcat-hover-item subcat-item-for-cat-{{ $navCat->id }} flex items-center justify-between px-2.5 py-2 rounded-xl text-xs font-medium cursor-pointer transition {{ $loop->first ? 'bg-blue-50 text-blue-700 font-bold shadow-2xs' : 'text-slate-700 hover:bg-slate-100 hover:text-blue-700' }}"
                                                            data-cat-id="{{ $navCat->id }}"
                                                            data-sub-id="{{ $subCat->id }}"
                                                            onmouseenter="switchMegaSubcategory({{ $navCat->id }}, {{ $subCat->id }}, this)"
                                                        >
                                                            <span class="truncate flex-1">{{ $subCat->name }}</span>
                                                            <span class="subcat-badge text-[10px] px-1.5 py-0.2 rounded-full {{ $loop->first ? 'bg-blue-200/70 text-blue-800' : 'bg-slate-200/60 text-slate-600' }} ml-1.5 flex-shrink-0 font-mono">
                                                                {{ $subProds->count() }}
                                                            </span>
                                                        </div>
                                                    @endforeach

                                                    {{-- Direct products not in any subcategory --}}
                                                    @if($directProds->count() > 0)
                                                        <div 
                                                            class="subcat-hover-item subcat-item-for-cat-{{ $navCat->id }} flex items-center justify-between px-2.5 py-2 rounded-xl text-xs font-medium cursor-pointer transition text-slate-700 hover:bg-slate-100 hover:text-blue-700"
                                                            data-cat-id="{{ $navCat->id }}"
                                                            data-sub-id="direct-{{ $navCat->id }}"
                                                            onmouseenter="switchMegaSubcategory({{ $navCat->id }}, 'direct-{{ $navCat->id }}', this)"
                                                        >
                                                            <span class="truncate flex-1">General Models</span>
                                                            <span class="subcat-badge text-[10px] px-1.5 py-0.2 rounded-full bg-slate-200/60 text-slate-600 ml-1.5 flex-shrink-0 font-mono">
                                                                {{ $directProds->count() }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Tier 3: Products Column (Right, flex-1) -->
                                                <div class="flex-1 p-4 bg-white flex flex-col justify-between overflow-hidden" style="width: 448px; min-width: 448px;">
                                                    <div>
                                                        @foreach($navCat->subcategories as $subCat)
                                                            @php
                                                                $subProds = $subCat->subcategoryProducts->isNotEmpty() ? $subCat->subcategoryProducts : $subCat->products;
                                                            @endphp
                                                            <div id="sub-panel-{{ $navCat->id }}-{{ $subCat->id }}" class="subcat-product-panel subcat-panel-cat-{{ $navCat->id }} {{ $loop->first ? 'block' : 'hidden' }}">
                                                                <div class="flex items-center justify-between pb-2.5 mb-3 border-b border-slate-100">
                                                                    <div>
                                                                        <h4 class="font-heading font-bold text-xs uppercase tracking-wider text-slate-900">
                                                                            {{ $subCat->name }}
                                                                        </h4>
                                                                        <p class="text-[10px] text-slate-400">
                                                                            {{ $subProds->count() }} equipment {{ Str::plural('model', $subProds->count()) }} available
                                                                        </p>
                                                                    </div>
                                                                    <a href="{{ route('products.index', ['category' => $navCat->slug, 'subcategory' => $subCat->slug]) }}" class="text-[11px] font-bold text-blue-700 hover:underline">
                                                                        View All {{ $subCat->name }} &rarr;
                                                                    </a>
                                                                </div>

                                                                <div class="grid grid-cols-2 gap-2.5 max-h-[240px] overflow-y-auto pr-1">
                                                                    @forelse($subProds as $subProd)
                                                                        <a href="{{ route('products.show', $subProd->slug) }}" class="flex items-start p-2 rounded-xl bg-slate-50/60 hover:bg-blue-50/50 border border-slate-100 hover:border-blue-200 transition group/prod">
                                                                            <div class="w-12 h-12 rounded-lg bg-white overflow-hidden flex-shrink-0 mr-2.5 border border-slate-200/60 flex items-center justify-center p-0.5">
                                                                                <img src="{{ $subProd->image }}" alt="{{ $subProd->name }}" class="w-full h-full object-contain">
                                                                            </div>
                                                                            <div class="min-w-0">
                                                                                <span class="text-[10px] font-bold text-blue-700 font-mono block leading-tight">
                                                                                    {{ $subProd->model_code }}
                                                                                </span>
                                                                                <div class="text-xs font-semibold text-slate-800 truncate group-hover/prod:text-blue-700 leading-snug">
                                                                                    {{ $subProd->name }}
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    @empty
                                                                        <div class="col-span-2 text-center py-8 text-slate-400 text-xs">
                                                                            No equipment models currently listed in this subcategory.
                                                                        </div>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                        @if($directProds->count() > 0)
                                                            <div id="sub-panel-{{ $navCat->id }}-direct-{{ $navCat->id }}" class="subcat-product-panel subcat-panel-cat-{{ $navCat->id }} hidden">
                                                                <div class="flex items-center justify-between pb-2.5 mb-3 border-b border-slate-100">
                                                                    <div>
                                                                        <h4 class="font-heading font-bold text-xs uppercase tracking-wider text-slate-900">
                                                                            General {{ $navCat->name }} Models
                                                                        </h4>
                                                                        <p class="text-[10px] text-slate-400">
                                                                            {{ $directProds->count() }} general equipment models
                                                                        </p>
                                                                    </div>
                                                                    <a href="{{ route('products.index', ['category' => $navCat->slug]) }}" class="text-[11px] font-bold text-blue-700 hover:underline">
                                                                        View Category &rarr;
                                                                    </a>
                                                                </div>

                                                                <div class="grid grid-cols-2 gap-2.5 max-h-[240px] overflow-y-auto pr-1">
                                                                    @foreach($directProds as $dirProd)
                                                                        <a href="{{ route('products.show', $dirProd->slug) }}" class="flex items-start p-2 rounded-xl bg-slate-50/60 hover:bg-blue-50/50 border border-slate-100 hover:border-blue-200 transition group/prod">
                                                                            <div class="w-12 h-12 rounded-lg bg-white overflow-hidden flex-shrink-0 mr-2.5 border border-slate-200/60 flex items-center justify-center p-0.5">
                                                                                <img src="{{ $dirProd->image }}" alt="{{ $dirProd->name }}" class="w-full h-full object-contain">
                                                                            </div>
                                                                            <div class="min-w-0">
                                                                                <span class="text-[10px] font-bold text-blue-700 font-mono block leading-tight">
                                                                                    {{ $dirProd->model_code }}
                                                                                </span>
                                                                                <div class="text-xs font-semibold text-slate-800 truncate group-hover/prod:text-blue-700 leading-snug">
                                                                                    {{ $dirProd->name }}
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        @else
                                            <!-- Layout for Category WITHOUT Subcategories (Direct 2-column Product Grid) -->
                                            <div class="p-5 flex-1 flex flex-col justify-between overflow-x-hidden" style="width: 100%;">
                                                <div>
                                                    <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                                                        <div>
                                                            <h4 class="font-heading font-bold text-xs uppercase tracking-wider text-slate-900">
                                                                {{ $navCat->name }}
                                                            </h4>
                                                            <p class="text-[10px] text-slate-400">
                                                                {{ $navCat->products->count() }} equipment {{ Str::plural('model', $navCat->products->count()) }} available
                                                            </p>
                                                        </div>
                                                        <a href="{{ route('products.index', ['category' => $navCat->slug]) }}" class="text-[11px] font-bold text-blue-700 hover:underline">
                                                            View All Models &rarr;
                                                        </a>
                                                    </div>

                                                    <div class="grid grid-cols-2 gap-3.5 max-h-[250px] overflow-y-auto overflow-x-hidden pr-1">
                                                        @forelse($navCat->products as $catProd)
                                                            <a href="{{ route('products.show', $catProd->slug) }}" class="flex items-center p-3 rounded-xl bg-slate-50/70 hover:bg-blue-50/60 border border-slate-100 hover:border-blue-200 transition group/prod">
                                                                <div class="w-14 h-14 rounded-lg bg-white overflow-hidden flex-shrink-0 mr-3 border border-slate-200/60 flex items-center justify-center p-1">
                                                                    <img src="{{ $catProd->image }}" alt="{{ $catProd->name }}" class="w-full h-full object-contain">
                                                                </div>
                                                                <div class="min-w-0 flex-1">
                                                                    <span class="text-[10px] font-bold text-blue-700 font-mono block leading-tight">
                                                                        {{ $catProd->model_code }}
                                                                    </span>
                                                                    <div class="text-xs font-semibold text-slate-800 truncate group-hover/prod:text-blue-700 leading-snug">
                                                                        {{ $catProd->name }}
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        @empty
                                                            <div class="col-span-2 text-center py-8 text-slate-400 text-xs">
                                                                No models currently listed in this category.
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Bottom Footer Bar -->
                                        <div class="px-5 py-2.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-[11px]">
                                            <span class="text-slate-500 font-medium">
                                                {{ $navCat->name }} &bull; Engineered to Global Standards
                                            </span>
                                            <a href="{{ route('products.index', ['category' => $navCat->slug]) }}" class="font-bold text-blue-700 hover:underline">
                                                Explore Full {{ $navCat->name }} Portfolio &rarr;
                                            </a>
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <!-- 2. Service & support -->
                    <a href="{{ route('service.support') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('service.support') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        Service & support
                    </a>

                    <!-- 3. Downloads -->
                    <a href="{{ route('downloads') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('downloads') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        Downloads
                    </a>

                    <!-- 4. News & Gallery -->
                    <a href="{{ route('news.gallery') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('news*') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        News & Gallery
                    </a>

                    <!-- 5. Contact us -->
                    <a href="{{ route('contact') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('contact*') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        Contact us
                    </a>

                    <!-- 6. About -->
                    <a href="{{ route('about') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('about*') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        About
                    </a>

                </div>

                <!-- Right Action: South Korea Flag Badge (No Search, No Request Quote button as requested) -->
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-1.5 px-2.5 py-1 rounded-full bg-slate-100/90 border border-slate-200/90 shadow-2xs" title="Republic of Korea (South Korea)">
                        <!-- Authentic South Korea Flag (Taegeukgi) SVG -->
                        <svg class="w-5 h-3.5 rounded-xs shadow-2xs overflow-hidden border border-slate-200/50" viewBox="0 0 72 48" fill="none">
                            <rect width="72" height="48" fill="#FFFFFF"/>
                            <circle cx="36" cy="24" r="12" fill="#C60C30"/>
                            <path d="M24 24A12 12 0 0 0 48 24A6 6 0 0 1 36 24A6 6 0 0 0 24 24Z" fill="#003478"/>
                            <g stroke="#000" stroke-width="1.8" stroke-linecap="round">
                                <line x1="12" y1="11" x2="20" y2="17" />
                                <line x1="10" y1="13.5" x2="18" y2="19.5" />
                                <line x1="8" y1="16" x2="16" y2="22" />
                                <line x1="52" y1="26" x2="56" y2="29" />
                                <line x1="60" y1="32" x2="64" y2="35" />
                                <line x1="54" y1="28.5" x2="58" y2="31.5" />
                                <line x1="62" y1="34.5" x2="66" y2="37.5" />
                                <line x1="56" y1="31" x2="60" y2="34" />
                                <line x1="64" y1="37" x2="68" y2="40" />
                                <line x1="52" y1="17" x2="56" y2="14" />
                                <line x1="60" y1="11" x2="64" y2="8" />
                                <line x1="54" y1="19.5" x2="62" y2="13.5" />
                                <line x1="56" y1="22" x2="60" y2="19" />
                                <line x1="64" y1="16" x2="68" y2="13" />
                                <line x1="12" y1="37" x2="20" y2="31" />
                                <line x1="10" y1="34.5" x2="14" y2="31.5" />
                                <line x1="18" y1="28.5" x2="22" y2="25.5" />
                                <line x1="8" y1="32" x2="16" y2="26" />
                            </g>
                        </svg>
                        <span class="text-[11px] font-extrabold tracking-wider text-slate-800">KOREA</span>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button type="button" onclick="toggleMobileMenu()" class="lg:hidden p-1.5 text-slate-700 hover:text-blue-700 rounded focus:outline-none" aria-label="Toggle navigation">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 bg-white px-4 py-3 space-y-1.5 shadow-md text-xs">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">Home</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">Products</a>
            <a href="{{ route('service.support') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">Service & support</a>
            <a href="{{ route('downloads') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">Downloads</a>
            <a href="{{ route('news.gallery') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">News & Gallery</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">Contact us</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">About</a>
        </div>
    </nav>

    <!-- Global Flash Notification Messages -->
    @if(session('success'))
        <div class="bg-emerald-600 text-white px-4 py-2.5 shadow-sm text-xs font-semibold relative z-50">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-white hover:text-emerald-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Content Area -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Clean White Theme Footer (Address info removed as requested) -->
    <footer class="bg-slate-50 text-slate-700 border-t border-slate-200 pt-12 pb-10 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-10 border-b border-slate-200">
                
                <!-- Col 1: Brand Info -->
                <div class="space-y-3">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="DIARAX Logo" class="h-6 w-auto object-contain">
                    </div>
                    <div class="text-xs text-slate-600 leading-relaxed max-w-sm space-y-1">
                        <span class="font-bold text-slate-900 block">DIARAX LTD.</span>
                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            This Diarax worldwide Advanced medical equipment manufacturing Company. Laboratory Equipment (Hematology Analyzer, POCT Hormone Analyzer, Bio Chemistry Analyzer, Electrolyte Analyzer), Surgical Table, Surgical Light, Surgical Diathermy, Intensive Care Equipments and Medical Furniture Solutions.
                        </p>
                    </div>
                    <div class="pt-0.5">
                        <a href="mailto:info.diarax@gmail.com" class="inline-flex items-center text-xs text-slate-700 hover:text-blue-700 font-semibold transition group">
                            <svg class="w-3.5 h-3.5 mr-1.5 text-blue-700 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>info.diarax@gmail.com</span>
                        </a>
                    </div>
                    <div class="pt-1">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-100">
                            South Korean Precision Engineering
                        </span>
                    </div>
                </div>

                <!-- Col 2: Dynamic Equipment Categories -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 mb-3">Equipment</h4>
                    <ul class="space-y-2 text-xs text-slate-600">
                        @if(isset($navCategories) && $navCategories->isNotEmpty())
                            @foreach($navCategories as $cat)
                                <li>
                                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}" class="hover:text-blue-700 transition">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li><a href="{{ route('products.index') }}" class="hover:text-blue-700 transition">All Equipment Categories</a></li>
                        @endif
                    </ul>
                </div>

                <!-- Col 3: Quick Navigation -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 mb-3">Quick Links</h4>
                    <ul class="space-y-2 text-xs text-slate-600">
                        <li><a href="{{ route('about') }}" class="hover:text-blue-700 transition">About DIARAX Korea</a></li>
                        <li><a href="{{ route('service.support') }}" class="hover:text-blue-700 transition">Service & Support</a></li>
                        <li><a href="{{ route('downloads') }}" class="hover:text-blue-700 transition">Downloads & Catalogs</a></li>
                        <li><a href="{{ route('news.gallery') }}" class="hover:text-blue-700 transition">News & Gallery</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-blue-700 transition">Contact Us</a></li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                <p>&copy; {{ date('Y') }} DIARAX LTD. &bull; South Korea. All rights reserved.</p>
                <div class="flex items-center space-x-3 text-slate-500">
                    <a href="{{ route('contact') }}" class="hover:text-blue-700 transition">Privacy Policy</a>
                    <span class="text-slate-300">&bull;</span>
                    <a href="{{ route('contact') }}" class="hover:text-blue-700 transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Dynamic Welcome Message Popup Modal -->
    @if(isset($welcomePopup) && $welcomePopup && $welcomePopup->is_active)
        <div id="welcome-modal-overlay" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs transition-opacity duration-300 hidden opacity-0">
            <div id="welcome-modal-card" class="bg-white rounded-3xl max-w-lg w-full overflow-hidden shadow-2xl border border-slate-100 transform transition-all duration-300 scale-95 opacity-0">
                @if($welcomePopup->image)
                    <div class="relative h-48 sm:h-56 bg-slate-100 overflow-hidden">
                        <img src="{{ $welcomePopup->image }}" alt="{{ $welcomePopup->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/20 to-transparent"></div>
                        @if($welcomePopup->badge)
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-white/95 text-blue-700 backdrop-blur-xs shadow-xs">
                                    {{ $welcomePopup->badge }}
                                </span>
                            </div>
                        @endif
                        <button type="button" onclick="closeWelcomeModal()" class="absolute top-3.5 right-3.5 w-8 h-8 rounded-full bg-black/40 hover:bg-black/60 text-white flex items-center justify-center transition backdrop-blur-xs" aria-label="Close dialog">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @else
                    <div class="flex items-center justify-between px-6 pt-5 pb-2">
                        @if($welcomePopup->badge)
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-100">
                                {{ $welcomePopup->badge }}
                            </span>
                        @else
                            <span></span>
                        @endif
                        <button type="button" onclick="closeWelcomeModal()" class="text-slate-400 hover:text-slate-700 p-1 rounded-lg transition" aria-label="Close dialog">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                @endif

                <div class="p-6 sm:p-7 space-y-4">
                    <div>
                        <h3 class="font-heading text-lg sm:text-xl font-bold text-slate-900 leading-snug">
                            {{ $welcomePopup->title }}
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mt-2.5">
                            {{ $welcomePopup->message }}
                        </p>
                    </div>

                    <div class="pt-2 flex flex-col sm:flex-row items-center gap-2.5">
                        @if($welcomePopup->button_link && $welcomePopup->button_text)
                            <a href="{{ $welcomePopup->button_link }}" onclick="closeWelcomeModal()" class="w-full sm:w-auto flex-1 text-center px-5 py-2.5 rounded-xl font-bold text-xs bg-blue-700 hover:bg-blue-800 text-white shadow-xs transition">
                                {{ $welcomePopup->button_text }} &rarr;
                            </a>
                        @endif
                        <button type="button" onclick="closeWelcomeModal()" class="w-full sm:w-auto px-4 py-2.5 rounded-xl font-semibold text-xs text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 transition">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Show modal if not dismissed in current browser session
                if (!sessionStorage.getItem('diarax_welcome_modal_closed')) {
                    setTimeout(() => {
                        const overlay = document.getElementById('welcome-modal-overlay');
                        const card = document.getElementById('welcome-modal-card');
                        if (overlay && card) {
                            overlay.classList.remove('hidden');
                            setTimeout(() => {
                                overlay.classList.remove('opacity-0');
                                card.classList.remove('scale-95', 'opacity-0');
                                card.classList.add('scale-100', 'opacity-100');
                            }, 30);
                        }
                    }, 500);
                }
            });

            function closeWelcomeModal() {
                const overlay = document.getElementById('welcome-modal-overlay');
                const card = document.getElementById('welcome-modal-card');
                if (overlay && card) {
                    overlay.classList.add('opacity-0');
                    card.classList.add('scale-95', 'opacity-0');
                    setTimeout(() => {
                        overlay.classList.add('hidden');
                    }, 300);
                }
                sessionStorage.setItem('diarax_welcome_modal_closed', 'true');
            }
        </script>
    @endif

    <!-- Scripts -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        function switchMegaCategory(catId, itemEl) {
            // Remove active classes on all category items
            document.querySelectorAll('.category-hover-item').forEach(el => {
                el.classList.remove('bg-blue-50', 'text-blue-700', 'font-bold');
                el.classList.add('text-slate-700');
            });
            // Add active class to hovered item
            itemEl.classList.remove('text-slate-700');
            itemEl.classList.add('bg-blue-50', 'text-blue-700', 'font-bold');

            // Hide all category panels
            document.querySelectorAll('.category-product-panel').forEach(panel => {
                panel.classList.add('hidden');
                panel.classList.remove('flex');
            });

            // Show active category panel
            const activePanel = document.getElementById('cat-panel-' + catId);
            if (activePanel) {
                activePanel.classList.remove('hidden');
                activePanel.classList.add('flex');

                // If this category has subcategories, activate the first one
                const firstSubItem = activePanel.querySelector('.subcat-item-for-cat-' + catId);
                if (firstSubItem) {
                    const subId = firstSubItem.getAttribute('data-sub-id');
                    switchMegaSubcategory(catId, subId, firstSubItem);
                }
            }
        }

        function switchMegaSubcategory(catId, subId, itemEl) {
            // Remove active classes on all subcategory items in this category
            document.querySelectorAll('.subcat-item-for-cat-' + catId).forEach(el => {
                el.classList.remove('bg-blue-50', 'text-blue-700', 'font-bold', 'shadow-2xs');
                el.classList.add('text-slate-700');
                const badge = el.querySelector('.subcat-badge');
                if (badge) {
                    badge.classList.remove('bg-blue-200/70', 'text-blue-800');
                    badge.classList.add('bg-slate-200/60', 'text-slate-600');
                }
            });

            // Add active class to hovered subcategory item
            itemEl.classList.remove('text-slate-700');
            itemEl.classList.add('bg-blue-50', 'text-blue-700', 'font-bold', 'shadow-2xs');
            const activeBadge = itemEl.querySelector('.subcat-badge');
            if (activeBadge) {
                activeBadge.classList.remove('bg-slate-200/60', 'text-slate-600');
                activeBadge.classList.add('bg-blue-200/70', 'text-blue-800');
            }

            // Hide all subcategory product panels in this category
            document.querySelectorAll('.subcat-panel-cat-' + catId).forEach(panel => {
                panel.classList.add('hidden');
                panel.classList.remove('block');
            });

            // Show target subcategory product panel
            const targetPanel = document.getElementById('sub-panel-' + catId + '-' + subId);
            if (targetPanel) {
                targetPanel.classList.remove('hidden');
                targetPanel.classList.add('block');
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
