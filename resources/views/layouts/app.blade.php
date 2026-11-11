<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'DIXION Medical Systems | German Medical Equipment & Healthcare Solutions')</title>
    <meta name="description" content="@yield('meta_description', 'DIXION Vertrieb medizinischer Geräte GmbH — Leading German manufacturer of high-precision surgical tables, anesthesia workstations, ICU ventilators, patient monitors, and turnkey hospital equipping solutions.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">

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
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-sky-500 selection:text-white flex flex-col min-h-screen">

    <!-- Top Mini Info Bar -->
    <header class="bg-slate-950 text-slate-300 text-xs border-b border-slate-800 sticky top-0 z-50 transition-all duration-200" id="top-bar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-between py-2 gap-2">
                <!-- Location & Badges -->
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center text-slate-300">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block mr-2 animate-pulse"></span>
                        <strong class="text-white font-medium">DIXION GmbH</strong> &bull; Düsseldorf, Germany
                    </span>
                    <span class="hidden md:inline-flex items-center text-slate-400">
                        <svg class="w-3.5 h-3.5 mr-1 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        ISO 13485 &bull; CE &bull; EU MDR Compliant
                    </span>
                </div>

                <!-- Direct Contacts & Actions -->
                <div class="flex items-center space-x-4">
                    <a href="tel:+49211445566" class="hidden sm:inline-flex items-center text-slate-300 hover:text-white transition">
                        <svg class="w-3.5 h-3.5 mr-1 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        +49 (0) 211 445566
                    </a>
                    <a href="mailto:info@dixion.de" class="hidden lg:inline-flex items-center text-slate-300 hover:text-white transition">
                        <svg class="w-3.5 h-3.5 mr-1 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        info@dixion.de
                    </a>
                    <div class="h-3 w-px bg-slate-800 hidden sm:block"></div>
                    <!-- Entrance Mode Switch -->
                    <a href="{{ route('home', ['entrance' => request('entrance') === 'splash' ? 'skip' : 'splash']) }}" class="text-sky-400 hover:text-sky-300 font-medium inline-flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                        {{ request('entrance') === 'splash' ? 'Skip Entrance' : 'Entrance View' }}
                    </a>
                    <div class="h-3 w-px bg-slate-800"></div>
                    <a href="{{ route('admin.dashboard') }}" class="text-amber-400 hover:text-amber-300 font-medium">
                        Admin Portal
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Navigation Bar -->
    <nav class="bg-white/95 backdrop-blur-md shadow-sm border-b border-slate-100 sticky top-9 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Brand Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-sky-600 via-blue-700 to-slate-900 flex items-center justify-center text-white shadow-md shadow-sky-600/20 group-hover:scale-105 transition-transform duration-200">
                            <!-- Medical Cross SVG with Modern Touch -->
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M10.5 4.5a1.5 1.5 0 0 1 3 0v4.5H18a1.5 1.5 0 0 1 0 3h-4.5V16.5a1.5 1.5 0 0 1-3 0V12H6a1.5 1.5 0 0 1 0-3h4.5V4.5z"/>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-heading text-2xl font-bold tracking-tight text-slate-900 leading-none group-hover:text-sky-700 transition">
                                DIXION
                            </span>
                            <span class="text-[10px] tracking-wider uppercase font-semibold text-slate-500 mt-1">
                                Medical Systems &bull; Germany
                            </span>
                        </div>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="px-3.5 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('home') ? 'text-sky-700 bg-sky-50 font-semibold' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                        Home
                    </a>

                    <!-- Products Dropdown Link -->
                    <div class="relative group">
                        <a href="{{ route('products.index') }}" class="px-3.5 py-2 text-sm font-medium rounded-lg transition inline-flex items-center {{ request()->routeIs('products.*') ? 'text-sky-700 bg-sky-50 font-semibold' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                            Equipment & Products
                            <svg class="w-4 h-4 ml-1 text-slate-400 group-hover:text-sky-600 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <!-- Mega Menu Dropdown -->
                        <div class="absolute left-0 mt-1 w-80 bg-white rounded-2xl shadow-xl border border-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform group-hover:translate-y-0 translate-y-2 p-3 z-50">
                            <div class="text-xs font-semibold uppercase tracking-wider text-slate-400 px-3 py-2">
                                Clinical Categories
                            </div>
                            <div class="space-y-1">
                                <a href="{{ route('products.index', ['category' => 'surgery-operating-theatres']) }}" class="flex items-center p-2 rounded-xl hover:bg-sky-50/70 transition group/item">
                                    <div class="w-8 h-8 rounded-lg bg-sky-100 text-sky-700 flex items-center justify-center mr-3 group-hover/item:bg-sky-600 group-hover/item:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879a3 3 0 11-4.243-4.242 3 3 0 014.243 0z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-slate-800 group-hover/item:text-sky-700">Surgery & Operating Theatres</div>
                                        <div class="text-xs text-slate-500">Tables, lights & generators</div>
                                    </div>
                                </a>
                                <a href="{{ route('products.index', ['category' => 'anesthesia-respiratory']) }}" class="flex items-center p-2 rounded-xl hover:bg-sky-50/70 transition group/item">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center mr-3 group-hover/item:bg-emerald-600 group-hover/item:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-slate-800 group-hover/item:text-emerald-700">Anesthesia & Respiratory</div>
                                        <div class="text-xs text-slate-500">Workstations & ICU ventilators</div>
                                    </div>
                                </a>
                                <a href="{{ route('products.index', ['category' => 'intensive-care-neonatology']) }}" class="flex items-center p-2 rounded-xl hover:bg-sky-50/70 transition group/item">
                                    <div class="w-8 h-8 rounded-lg bg-pink-100 text-pink-700 flex items-center justify-center mr-3 group-hover/item:bg-pink-600 group-hover/item:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-slate-800 group-hover/item:text-pink-700">Intensive Care & Neonatology</div>
                                        <div class="text-xs text-slate-500">Monitors, incubators & pumps</div>
                                    </div>
                                </a>
                                <a href="{{ route('products.index', ['category' => 'diagnostics-imaging']) }}" class="flex items-center p-2 rounded-xl hover:bg-sky-50/70 transition group/item">
                                    <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center mr-3 group-hover/item:bg-amber-600 group-hover/item:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-slate-800 group-hover/item:text-amber-700">Diagnostics & Imaging</div>
                                        <div class="text-xs text-slate-500">ECG, ultrasound & film viewers</div>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-2 pt-2 border-t border-slate-100">
                                <a href="{{ route('products.index') }}" class="block text-center text-xs font-semibold text-sky-600 hover:text-sky-700 py-1.5 rounded-lg hover:bg-sky-50 transition">
                                    Browse Complete Catalog &rarr;
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('solutions.index') }}" class="px-3.5 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('solutions.*') ? 'text-sky-700 bg-sky-50 font-semibold' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                        Turnkey Solutions
                    </a>

                    <a href="{{ route('about') }}" class="px-3.5 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('about') ? 'text-sky-700 bg-sky-50 font-semibold' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                        Company & Quality
                    </a>

                    <a href="{{ route('news') }}" class="px-3.5 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('news') ? 'text-sky-700 bg-sky-50 font-semibold' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                        News & Exhibitions
                    </a>

                    <a href="{{ route('contact') }}" class="px-3.5 py-2 text-sm font-medium rounded-lg transition {{ request()->routeIs('contact') ? 'text-sky-700 bg-sky-50 font-semibold' : 'text-slate-700 hover:text-sky-600 hover:bg-slate-50' }}">
                        Contact
                    </a>
                </div>

                <!-- Right Action Buttons -->
                <div class="hidden sm:flex items-center space-x-3">
                    <!-- Quick Search Trigger -->
                    <button type="button" onclick="openSearchModal()" class="p-2.5 text-slate-500 hover:text-sky-600 hover:bg-slate-100 rounded-xl transition" title="Search medical equipment">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>

                    <!-- Quote CTA -->
                    <a href="{{ route('quote') }}" class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-semibold rounded-xl text-white bg-gradient-to-r from-sky-600 to-blue-700 hover:from-sky-500 hover:to-blue-600 shadow-md shadow-sky-600/20 hover:shadow-lg hover:shadow-sky-600/30 transition transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Request Quote
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center sm:hidden space-x-2">
                    <button type="button" onclick="openSearchModal()" class="p-2 text-slate-600 rounded-lg hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                    <button type="button" onclick="toggleMobileMenu()" class="p-2 text-slate-700 hover:text-sky-600 rounded-lg focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="hidden sm:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-2 shadow-lg">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium rounded-lg text-slate-800 hover:bg-sky-50 hover:text-sky-600">Home</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 text-base font-medium rounded-lg text-slate-800 hover:bg-sky-50 hover:text-sky-600">All Products & Catalog</a>
            <a href="{{ route('solutions.index') }}" class="block px-3 py-2 text-base font-medium rounded-lg text-slate-800 hover:bg-sky-50 hover:text-sky-600">Turnkey Solutions</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 text-base font-medium rounded-lg text-slate-800 hover:bg-sky-50 hover:text-sky-600">About Dixion & Quality</a>
            <a href="{{ route('news') }}" class="block px-3 py-2 text-base font-medium rounded-lg text-slate-800 hover:bg-sky-50 hover:text-sky-600">News & Exhibitions</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 text-base font-medium rounded-lg text-slate-800 hover:bg-sky-50 hover:text-sky-600">Contact Us</a>
            <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                <a href="{{ route('quote') }}" class="w-full text-center px-4 py-2.5 rounded-xl font-semibold text-white bg-sky-600 hover:bg-sky-700 shadow">
                    Request a Quote
                </a>
                <a href="{{ route('admin.dashboard') }}" class="w-full text-center px-4 py-2 rounded-xl text-xs font-semibold text-amber-600 bg-amber-50 hover:bg-amber-100">
                    Admin Management
                </a>
            </div>
        </div>
    </nav>

    <!-- Global Flash Notification Messages -->
    @if(session('success'))
        <div class="bg-emerald-600 text-white px-4 py-3 shadow-md relative z-50 animate-fadeIn">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center space-x-2 text-sm font-medium">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
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

    <!-- Search Modal -->
    <div id="search-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-start justify-center pt-20 px-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-6 border border-slate-100 transform transition-all">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <h3 class="font-heading text-lg font-bold text-slate-900">Search Medical Equipment</h3>
                <button type="button" onclick="closeSearchModal()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="{{ route('products.index') }}" method="GET" class="mt-4">
                <div class="relative">
                    <input type="text" name="q" placeholder="Search by model (e.g. Operamed 3000, Aeros 4600, ECG, ICU)..." class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 focus:border-sky-500 text-sm outline-none" autofocus>
                    <svg class="w-5 h-5 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <div class="mt-3 flex flex-wrap gap-2 text-xs text-slate-500">
                    <span class="font-medium text-slate-700">Popular:</span>
                    <a href="{{ route('products.index', ['q' => 'Operamed']) }}" class="px-2 py-1 bg-slate-100 hover:bg-sky-50 hover:text-sky-700 rounded-md transition">Operamed 3000</a>
                    <a href="{{ route('products.index', ['q' => 'Aeros']) }}" class="px-2 py-1 bg-slate-100 hover:bg-sky-50 hover:text-sky-700 rounded-md transition">Aeros 4600</a>
                    <a href="{{ route('products.index', ['q' => 'Storm']) }}" class="px-2 py-1 bg-slate-100 hover:bg-sky-50 hover:text-sky-700 rounded-md transition">Storm 5900</a>
                    <a href="{{ route('products.index', ['q' => 'BabyGuard']) }}" class="px-2 py-1 bg-slate-100 hover:bg-sky-50 hover:text-sky-700 rounded-md transition">BabyGuard Incubator</a>
                </div>
                <div class="mt-5 flex justify-end">
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-sky-600 text-white font-medium text-sm hover:bg-sky-700 shadow">
                        Search Catalog
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mega Footer -->
    <footer class="bg-slate-950 text-slate-300 border-t border-slate-900 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: Brand & German HQ -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-sky-600/30">
                            +
                        </div>
                        <span class="font-heading text-2xl font-bold tracking-tight text-white">DIXION</span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                        DIXION Vertrieb medizinischer Geräte GmbH is a German healthcare manufacturing partner specializing in advanced medical devices, operating suites, intensive care equipment, and turnkey hospital installations worldwide.
                    </p>
                    <div class="space-y-1.5 text-xs text-slate-400">
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            Schiessstrasse 55, 40549 Düsseldorf, Germany
                        </p>
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            Phone: +49 (0) 211 445566
                        </p>
                        <p class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Email: export@dixion.de / info@dixion.de
                        </p>
                    </div>
                </div>

                <!-- Col 2: Equipment Divisions -->
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-white mb-4">Equipment</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="{{ route('products.index', ['category' => 'surgery-operating-theatres']) }}" class="hover:text-sky-400 transition">Operating Tables & Lights</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'anesthesia-respiratory']) }}" class="hover:text-sky-400 transition">Anesthesia & Ventilators</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'intensive-care-neonatology']) }}" class="hover:text-sky-400 transition">Patient Monitors & NICU</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'diagnostics-imaging']) }}" class="hover:text-sky-400 transition">ECG & Ultrasound</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'hospital-furniture']) }}" class="hover:text-sky-400 transition">Electric ICU Beds</a></li>
                        <li><a href="{{ route('products.index', ['category' => 'turnkey-mobile-healthcare']) }}" class="hover:text-sky-400 transition">Mobile Medical Units</a></li>
                    </ul>
                </div>

                <!-- Col 3: Solutions & Company -->
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-white mb-4">Company</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li><a href="{{ route('about') }}" class="hover:text-sky-400 transition">About DIXION</a></li>
                        <li><a href="{{ route('solutions.index') }}" class="hover:text-sky-400 transition">Turnkey Hospital Solutions</a></li>
                        <li><a href="{{ route('about') }}#quality" class="hover:text-sky-400 transition">German Quality & ISO 13485</a></li>
                        <li><a href="{{ route('news') }}" class="hover:text-sky-400 transition">Medical Exhibitions</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-sky-400 transition">Become a Distributor</a></li>
                        <li><a href="{{ route('quote') }}" class="hover:text-sky-400 transition">Tender Inquiries</a></li>
                    </ul>
                </div>

                <!-- Col 4: Quality & Compliance -->
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-white mb-4">Certifications</h4>
                    <div class="space-y-3">
                        <div class="p-3 rounded-xl bg-slate-900/80 border border-slate-800 text-xs">
                            <span class="font-bold text-sky-400 block mb-1">ISO 13485:2016</span>
                            <span class="text-slate-400">Certified Medical Device Quality Management System.</span>
                        </div>
                        <div class="p-3 rounded-xl bg-slate-900/80 border border-slate-800 text-xs">
                            <span class="font-bold text-emerald-400 block mb-1">CE & EU MDR</span>
                            <span class="text-slate-400">Full compliance with European Union Medical Device Regulation 2017/745.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright & Legal -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} DIXION Vertrieb medizinischer Geräte GmbH. All rights reserved.</p>
                <div class="flex items-center space-x-6">
                    <span class="text-slate-400">German Quality &bull; Global Care</span>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-slate-300">Admin</a>
                    <a href="{{ route('contact') }}" class="hover:text-slate-300">Privacy Policy</a>
                    <a href="{{ route('contact') }}" class="hover:text-slate-300">Imprint</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Global Scripts -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        function openSearchModal() {
            document.getElementById('search-modal').classList.remove('hidden');
        }

        function closeSearchModal() {
            document.getElementById('search-modal').classList.add('hidden');
        }

        // Close search on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSearchModal();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
