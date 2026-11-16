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
                        <div class="absolute left-0 mt-1 w-[760px] bg-white rounded-2xl shadow-2xl border border-slate-200/90 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 translate-y-2 z-50 flex overflow-hidden">
                            
                            <!-- Left: Categories List -->
                            <div class="w-64 bg-slate-50/80 p-3 border-r border-slate-200/80 space-y-1">
                                <div class="px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                                    Clinical Categories
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

                            <!-- Right: Products for Hovered Category -->
                            <div class="flex-1 p-5 bg-white min-h-[340px] flex flex-col justify-between">
                                <div>
                                    @foreach($navCategories ?? [] as $navCat)
                                        <div id="cat-panel-{{ $navCat->id }}" class="category-product-panel {{ $loop->first ? 'block' : 'hidden' }}">
                                            <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                                                <h4 class="font-heading font-bold text-xs uppercase tracking-wider text-slate-900">
                                                    {{ $navCat->name }} ({{ $navCat->products->count() }} Models)
                                                </h4>
                                                <a href="{{ route('products.index', ['category' => $navCat->slug]) }}" class="text-[11px] font-bold text-blue-700 hover:underline">
                                                    View All Models &rarr;
                                                </a>
                                            </div>

                                            <div class="grid grid-cols-2 gap-3 max-h-[260px] overflow-y-auto pr-1">
                                                @forelse($navCat->products as $catProd)
                                                    <a href="{{ route('products.show', $catProd->slug) }}" class="flex items-start p-2 rounded-xl hover:bg-blue-50/60 border border-slate-100 hover:border-blue-200 transition group/prod">
                                                        <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0 mr-2.5 border border-slate-200/60">
                                                            <img src="{{ $catProd->image }}" alt="{{ $catProd->name }}" class="w-full h-full object-cover">
                                                        </div>
                                                        <div class="min-w-0">
                                                            <span class="text-[10px] font-bold text-blue-700 font-mono block leading-tight">
                                                                {{ $catProd->model_code }}
                                                            </span>
                                                            <div class="text-xs font-semibold text-slate-800 truncate group-hover/prod:text-blue-700 leading-snug">
                                                                {{ $catProd->name }}
                                                            </div>
                                                        </div>
                                                    </a>
                                                @empty
                                                    <div class="col-span-2 text-center py-6 text-slate-400 text-xs">
                                                        No models currently listed in this category.
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="pt-3 border-t border-slate-100 text-right">
                                    <a href="{{ route('products.index') }}" class="text-xs font-bold text-blue-700 hover:underline">
                                        Browse Complete Catalog &rarr;
                                    </a>
                                </div>
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pb-10 border-b border-slate-200">
                
                <!-- Col 1: Brand Info (No address) -->
                <div class="space-y-3">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="DIARAX Logo" class="h-6 w-auto object-contain">
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed max-w-sm">
                        DIARAX Medical Systems &bull; South Korea. Advanced medical equipment manufacturing, surgical tables, anesthesia workstations, and hospital equipping worldwide.
                    </p>
                    <div class="pt-1">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-blue-50 text-blue-700 border border-blue-100">
                            South Korean Precision Engineering
                        </span>
                    </div>
                </div>

                <!-- Col 2: Equipment Divisions -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 mb-3">Equipment</h4>
                    <ul class="space-y-2 text-xs text-slate-600">
                        <li><a href="{{ route('products.index', ['category' => 'surgery-operating-theatres']) }}" class="hover:text-blue-700 transition">Operating Tables & Lights</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'anesthesia-respiratory']) }}" class="hover:text-blue-700 transition">Anesthesia & Ventilators</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'intensive-care-neonatology']) }}" class="hover:text-blue-700 transition">Patient Monitors & NICU</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'diagnostics-imaging']) }}" class="hover:text-blue-700 transition">ECG & Ultrasound</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'hospital-furniture']) }}" class="hover:text-blue-700 transition">Electric ICU Beds</a></li>
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

                <!-- Col 4: Quality & Compliance (No address) -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 mb-3">Quality & Compliance</h4>
                    <div class="p-3.5 rounded-xl bg-white border border-slate-200 text-xs text-slate-600 space-y-2 shadow-2xs">
                        <div class="font-bold text-slate-900">International Medical Standards</div>
                        <p class="text-[11px] text-slate-500 leading-relaxed">
                            Certified under ISO 13485:2016 quality management systems, European CE directives, and Korea MFDS specifications.
                        </p>
                        <div class="pt-1 text-[11px] text-blue-700 font-semibold">
                            Global Biomedical Assurance
                        </div>
                    </div>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                <p>&copy; {{ date('Y') }} DIARAX Medical Systems &bull; South Korea. All rights reserved.</p>
                <div class="flex items-center space-x-4">
                    <span class="text-slate-400">South Korean Precision Medical Technology</span>
                    <a href="{{ route('contact') }}" class="hover:text-blue-700">Privacy</a>
                </div>
            </div>
        </div>
    </footer>

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

            // Hide all product panels
            document.querySelectorAll('.category-product-panel').forEach(panel => {
                panel.classList.add('hidden');
                panel.classList.remove('block');
            });

            // Show active product panel
            const activePanel = document.getElementById('cat-panel-' + catId);
            if (activePanel) {
                activePanel.classList.remove('hidden');
                activePanel.classList.add('block');
            }
        }
    </script>
    @stack('scripts')
</body>
</html>
