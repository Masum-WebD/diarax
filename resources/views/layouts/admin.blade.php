<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DIXION Medical Systems &bull; Admin Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Admin Nav -->
    <header class="bg-slate-900 text-white border-b border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <span class="w-8 h-8 rounded-lg bg-sky-500 flex items-center justify-center font-bold text-slate-950">+</span>
                    <div>
                        <span class="font-bold text-lg">DIXION Admin</span>
                        <span class="text-xs text-slate-400 ml-2">Local Management & Inquiries</span>
                    </div>
                </div>

                <div class="flex items-center space-x-4 text-xs font-semibold">
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-sky-600 text-white' : 'text-slate-300 hover:text-white' }}">Dashboard</a>
                    <a href="{{ route('admin.inquiries') }}" class="px-3 py-1.5 rounded-lg {{ request()->routeIs('admin.inquiries*') ? 'bg-sky-600 text-white' : 'text-slate-300 hover:text-white' }}">Inquiries & Quotes</a>
                    <div class="h-4 w-px bg-slate-700"></div>
                    <a href="{{ route('home') }}" class="text-sky-400 hover:text-sky-300">&larr; Return to Website</a>
                </div>
            </div>
        </div>
    </header>

    @if(session('success'))
        <div class="bg-emerald-600 text-white text-xs font-semibold py-2 px-4 text-center">
            {{ session('success') }}
        </div>
    @endif

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 py-4 text-center text-xs text-slate-500">
        DIXION Medical Systems &bull; Connected to MySQL Database (<code class="bg-slate-100 px-1 py-0.5 rounded text-sky-700 font-mono">diarax_dixion</code>)
    </footer>

</body>
</html>
