<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'DIARAX Medical Systems &bull; Admin Portal')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        .font-heading {
            font-family: 'Space Grotesk', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased flex overflow-hidden">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebar-backdrop" onclick="toggleAdminSidebar()" class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-xs hidden lg:hidden transition-opacity"></div>

    <!-- 1. Admin Sidebar (Responsive & Sticky) -->
    <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 flex flex-col justify-between transition-transform duration-300 -translate-x-full lg:translate-x-0 lg:static lg:inset-auto lg:flex-shrink-0 border-r border-slate-800">
        
        <!-- Sidebar Header / Brand -->
        <div>
            <div class="h-16 flex items-center justify-between px-5 border-b border-slate-800/80 bg-slate-950/60">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/logo.png') }}" alt="DIARAX" class="h-5 w-auto object-contain brightness-0 invert">
                    <span class="text-[10px] font-extrabold tracking-widest text-blue-400 uppercase bg-blue-950/80 px-2 py-0.5 rounded border border-blue-800/60">Admin</span>
                </a>
                <button type="button" onclick="toggleAdminSidebar()" class="lg:hidden text-slate-400 hover:text-white" aria-label="Close sidebar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="px-3 py-4 space-y-1 text-xs font-semibold">
                <div class="px-3 pt-2 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                    Main Menu
                </div>

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-blue-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                <!-- 1. Banners Module (ব্যানার) -->
                <a href="{{ route('admin.banners.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.banners*') ? 'bg-blue-600 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.banners*') ? 'text-white' : 'text-blue-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span>Banners (ব্যানার)</span>
                </a>

                <!-- 2. Products Module (প্রোডাক্ট) -->
                <a href="{{ route('admin.products.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.products*') ? 'bg-blue-600 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.products*') ? 'text-white' : 'text-blue-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span>Products (প্রোডাক্ট)</span>
                </a>

                <!-- 3. Purchases Module (পারসেজ) -->
                <a href="{{ route('admin.purchases.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.purchases*') ? 'bg-blue-600 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.purchases*') ? 'text-white' : 'text-blue-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    <span>Purchases (পারসেজ)</span>
                </a>

                <!-- 4. Sales Module (সেল) -->
                <a href="{{ route('admin.sales.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.sales*') ? 'bg-blue-600 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.sales*') ? 'text-white' : 'text-blue-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z"/></svg>
                    <span>Sales (সেল মডিউল)</span>
                </a>

                <div class="px-3 pt-4 pb-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">
                    Inquiries & Leads
                </div>

                <!-- Inquiries -->
                <a href="{{ route('admin.inquiries') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('admin.inquiries*') ? 'bg-blue-600 text-white font-bold shadow-sm' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.inquiries*') ? 'text-white' : 'text-blue-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    <span>Quotes & Inquiries</span>
                </a>
            </div>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-3 border-t border-slate-800 bg-slate-950/60 space-y-2">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center justify-between px-3 py-2 rounded-xl bg-slate-800/80 hover:bg-slate-800 text-slate-300 hover:text-white text-xs font-semibold transition">
                <span class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>View Public Site</span>
                </span>
                <span class="text-[10px] text-slate-400">&rarr;</span>
            </a>

            <div class="flex items-center justify-between px-2 pt-1 text-[11px] text-slate-400">
                <span>Seoul HQ Server</span>
                <span class="inline-flex items-center text-emerald-400 font-mono">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 mr-1 animate-pulse"></span>
                    Online
                </span>
            </div>
        </div>

    </aside>

    <!-- 2. Main Wrapper (Top Bar + Main Scrollable Body) -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        
        <!-- Top Navigation Bar -->
        <header class="h-16 bg-white border-b border-slate-200 px-4 sm:px-6 lg:px-8 flex items-center justify-between flex-shrink-0 z-30 shadow-2xs">
            
            <div class="flex items-center space-x-3">
                <button type="button" onclick="toggleAdminSidebar()" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100" aria-label="Open sidebar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div class="flex items-center space-x-2">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider hidden sm:inline">DIARAX ERP</span>
                    <span class="text-slate-300 hidden sm:inline">&bull;</span>
                    <h1 class="text-sm sm:text-base font-bold text-slate-900 font-heading">
                        @yield('page_title', 'Management Dashboard')
                    </h1>
                </div>
            </div>

            <!-- Topbar Right Items -->
            <div class="flex items-center space-x-3 sm:space-x-4">
                
                <!-- Quick Search -->
                <div class="hidden md:flex items-center relative">
                    <input 
                        type="text" 
                        placeholder="Search models, orders, invoices..." 
                        class="w-64 pl-8 pr-3 py-1.5 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition"
                    >
                    <svg class="w-3.5 h-3.5 text-slate-400 absolute left-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <!-- South Korea Badge -->
                <div class="hidden sm:inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-xs font-semibold text-slate-700">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                    <span>Seoul HQ</span>
                </div>

                <!-- User Dropdown & Logout -->
                <div class="relative" id="user-menu-wrapper">
                    <div class="flex items-center space-x-2.5">
                        <div class="w-8 h-8 rounded-full bg-blue-700 text-white font-bold text-xs flex items-center justify-center shadow-2xs">
                            {{ substr(auth()->user()->name ?? 'Admin', 0, 2) }}
                        </div>
                        <div class="hidden sm:block text-left text-xs">
                            <div class="font-bold text-slate-900 leading-tight">{{ auth()->user()->name ?? 'Administrator' }}</div>
                            <div class="text-[10px] text-slate-500">Super Admin</div>
                        </div>

                        <!-- Logout Form Button -->
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button 
                                type="submit" 
                                title="Sign Out" 
                                class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </header>

        <!-- Flash Notification Message -->
        @if(session('success'))
            <div class="bg-emerald-600 text-white text-xs font-semibold py-2 px-6 shadow-2xs flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-white hover:text-emerald-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-600 text-white text-xs font-semibold py-2 px-6 shadow-2xs flex items-center justify-between">
                <span>{{ session('error') }}</span>
                <button type="button" onclick="this.parentElement.remove()" class="text-white hover:text-rose-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        <!-- Scrollable Main Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8 bg-slate-50">
            @yield('content')
        </main>

    </div>

    <!-- Admin Script for Mobile Sidebar Toggle -->
    <script>
        function toggleAdminSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
    </script>
    @stack('scripts')
</body>
</html>
