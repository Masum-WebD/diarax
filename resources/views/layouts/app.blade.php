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

    <!-- Top Mini Info Bar (Clean Light Theme) -->
    <div class="bg-slate-100 text-slate-600 text-xs border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-1.5 gap-2">
                <!-- Location & Badges -->
                <div class="flex items-center space-x-3 text-[11px] sm:text-xs">
                    <span class="inline-flex items-center font-medium text-slate-800">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block mr-1.5"></span>
                        <strong>DIARAX</strong> &bull; Seoul, South Korea
                    </span>
                    <span class="hidden md:inline-flex items-center text-slate-500">
                        <svg class="w-3.5 h-3.5 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        ISO 13485 &bull; CE &bull; MFDS Korea Certified
                    </span>
                </div>

                <!-- Direct Contacts & Actions -->
                <div class="flex items-center space-x-3 text-[11px] sm:text-xs">
                    <a href="tel:+8225551234" class="hidden sm:inline-flex items-center text-slate-600 hover:text-blue-700 transition">
                        <svg class="w-3.5 h-3.5 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        +82 2 555 1234
                    </a>
                    <a href="mailto:export@diarax.com" class="hidden md:inline-flex items-center text-slate-600 hover:text-blue-700 transition">
                        <svg class="w-3.5 h-3.5 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        export@diarax.com
                    </a>
                    <div class="h-3 w-px bg-slate-300 hidden sm:block"></div>
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-700 hover:text-blue-800 font-semibold">
                        Admin Portal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar (Clean, Compact, White Theme) -->
    <nav class="bg-white/95 backdrop-blur-md shadow-xs border-b border-slate-200 sticky top-7 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand Logo (Uploaded DIARAX Image) -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center group">
                        <img src="{{ asset('images/logo.png') }}" alt="DIARAX" class="h-6 sm:h-7 w-auto object-contain group-hover:opacity-90 transition">
                    </a>
                </div>

                <!-- Desktop Menu (Compact, Sleek, Not Bulky) -->
                <div class="hidden md:flex items-center space-x-1 lg:space-x-2 text-xs font-semibold">
                    <a href="{{ route('home') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('home') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        Home
                    </a>
                    <a href="{{ route('products.index') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('products.*') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        Products
                    </a>
                    <a href="{{ route('solutions.index') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('solutions.*') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        Turnkey Solutions
                    </a>
                    <a href="{{ route('products.compare') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('products.compare') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        Compare
                    </a>
                    <a href="{{ route('about') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('about') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        About Us
                    </a>
                    <a href="{{ route('news') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('news') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        News
                    </a>
                    <a href="{{ route('contact') }}" class="px-3 py-1.5 rounded-lg transition {{ request()->routeIs('contact') ? 'text-blue-700 bg-blue-50 font-bold' : 'text-slate-700 hover:text-blue-700 hover:bg-slate-50' }}">
                        Contact
                    </a>
                </div>

                <!-- Right Action: Search & Single-Line Compact Quote Button -->
                <div class="hidden sm:flex items-center space-x-2">
                    <button type="button" onclick="openSearchModal()" class="p-2 text-slate-500 hover:text-blue-700 hover:bg-slate-100 rounded-lg transition" title="Search medical equipment">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>

                    <!-- Single-line compact quote button -->
                    <a href="{{ route('quote') }}" class="whitespace-nowrap inline-flex items-center justify-center px-4 py-2 text-xs font-bold rounded-lg text-white bg-blue-700 hover:bg-blue-800 shadow-sm transition">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Request Quote</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center sm:hidden space-x-1.5">
                    <a href="{{ route('quote') }}" class="px-2.5 py-1 text-[11px] font-bold rounded bg-blue-700 text-white">
                        Quote
                    </a>
                    <button type="button" onclick="openSearchModal()" class="p-1.5 text-slate-600 rounded hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                    <button type="button" onclick="toggleMobileMenu()" class="p-1.5 text-slate-700 hover:text-blue-700 rounded focus:outline-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobile-menu" class="hidden sm:hidden border-t border-slate-200 bg-white px-4 py-3 space-y-1.5 shadow-md text-xs">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">Home</a>
            <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">Products & Catalog</a>
            <a href="{{ route('solutions.index') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">Turnkey Solutions</a>
            <a href="{{ route('products.compare') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">Compare Models</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">About Us (South Korea)</a>
            <a href="{{ route('news') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">News & Exhibitions</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg font-medium text-slate-800 hover:bg-slate-50 hover:text-blue-700">Contact Us</a>
            <div class="pt-2 border-t border-slate-100 flex gap-2">
                <a href="{{ route('quote') }}" class="flex-1 text-center py-2 rounded-lg font-bold text-white bg-blue-700">
                    Request Quote
                </a>
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg font-medium text-slate-700 bg-slate-100 text-center">
                    Admin
                </a>
            </div>
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

    <!-- Search Modal -->
    <div id="search-modal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-50 hidden flex items-start justify-center pt-20 px-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-xl w-full p-5 border border-slate-200">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <h3 class="font-heading text-sm font-bold text-slate-900 uppercase tracking-wider">Search DIARAX Medical Catalog</h3>
                <button type="button" onclick="closeSearchModal()" class="text-slate-400 hover:text-slate-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="{{ route('products.index') }}" method="GET" class="mt-4">
                <div class="relative">
                    <input type="text" name="q" placeholder="Search by model (e.g. Operamed 3000, Aeros 4600, ECG, ICU)..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none" autofocus>
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <div class="mt-3 flex flex-wrap gap-1.5 text-[11px] text-slate-500">
                    <span class="font-medium text-slate-700">Quick Searches:</span>
                    <a href="{{ route('products.index', ['q' => 'Operamed']) }}" class="px-2 py-0.5 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 rounded transition">Operamed 3000</a>
                    <a href="{{ route('products.index', ['q' => 'Aeros']) }}" class="px-2 py-0.5 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 rounded transition">Aeros 4600</a>
                    <a href="{{ route('products.index', ['q' => 'Storm']) }}" class="px-2 py-0.5 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 rounded transition">Storm 5900</a>
                    <a href="{{ route('products.index', ['q' => 'BabyGuard']) }}" class="px-2 py-0.5 bg-slate-100 hover:bg-blue-50 hover:text-blue-700 rounded transition">BabyGuard Incubator</a>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="px-4 py-2 rounded-xl bg-blue-700 text-white font-bold text-xs hover:bg-blue-800 shadow-xs">
                        Search Catalog
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Clean White Theme Footer -->
    <footer class="bg-slate-50 text-slate-700 border-t border-slate-200 pt-14 pb-10 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 pb-10 border-b border-slate-200">
                <!-- Col 1: Brand & South Korea Info -->
                <div class="lg:col-span-2 space-y-3">
                    <div class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="DIARAX Logo" class="h-8 w-auto object-contain">
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed max-w-sm">
                        DIARAX Medical Systems &bull; South Korea. Advanced medical equipment manufacturing, surgical tables, anesthesia workstations, and turnkey hospital equipping worldwide.
                    </p>
                    <div class="space-y-1 text-xs text-slate-500 pt-1">
                        <p class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            Teheran-ro, Gangnam-gu, Seoul, South Korea
                        </p>
                        <p class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            Phone: +82 2 555 1234
                        </p>
                        <p class="flex items-center">
                            <svg class="w-3.5 h-3.5 mr-2 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Email: export@diarax.com
                        </p>
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

                <!-- Col 3: Company & Solutions -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 mb-3">Company</h4>
                    <ul class="space-y-2 text-xs text-slate-600">
                        <li><a href="{{ route('about') }}" class="hover:text-blue-700 transition">About DIARAX Korea</a></li>
                        <li><a href="{{ route('solutions.index') }}" class="hover:text-blue-700 transition">Turnkey Hospital Solutions</a></li>
                        <li><a href="{{ route('products.compare') }}" class="hover:text-blue-700 transition">Compare Models</a></li>
                        <li><a href="{{ route('news') }}" class="hover:text-blue-700 transition">News & KIMES Seoul</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-blue-700 transition">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Col 4: Quality & Compliance -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-900 mb-3">Certifications</h4>
                    <div class="space-y-2 text-xs">
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-blue-700 block">ISO 13485:2016</span>
                            <span class="text-slate-500 text-[11px]">Medical Device Quality Management System.</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-white border border-slate-200">
                            <span class="font-bold text-emerald-600 block">MFDS Korea & CE</span>
                            <span class="text-slate-500 text-[11px]">Compliant with South Korean MFDS & European CE standards.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-3">
                <p>&copy; {{ date('Y') }} DIARAX Medical Systems &bull; South Korea. All rights reserved.</p>
                <div class="flex items-center space-x-4">
                    <span class="text-slate-400">South Korean Precision Medical Technology</span>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-700">Admin</a>
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

        function openSearchModal() {
            document.getElementById('search-modal').classList.remove('hidden');
        }

        function closeSearchModal() {
            document.getElementById('search-modal').classList.add('hidden');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSearchModal();
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
