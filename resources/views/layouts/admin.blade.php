<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DIARAX Medical Systems &bull; Admin Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Admin Nav -->
    <header class="bg-white text-slate-800 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.png') }}" alt="DIARAX" class="h-6 w-auto object-contain">
                    <span class="text-xs font-semibold px-2 py-0.5 rounded bg-blue-50 text-blue-700">Admin Portal</span>
                </div>

                <div class="flex items-center space-x-3 text-xs font-semibold">
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 text-white' : 'text-slate-600 hover:text-blue-700' }}">Dashboard</a>
                    <a href="{{ route('admin.inquiries') }}" class="px-3 py-1.5 rounded-lg {{ request()->routeIs('admin.inquiries*') ? 'bg-blue-700 text-white' : 'text-slate-600 hover:text-blue-700' }}">Inquiries & Quotes</a>
                    <div class="h-4 w-px bg-slate-300"></div>
                    <a href="{{ route('home') }}" class="text-blue-700 hover:text-blue-800">&larr; Return to Website</a>
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
        DIARAX Medical Systems &bull; Connected to MySQL Database (<code class="bg-slate-100 px-1 py-0.5 rounded text-blue-700 font-mono">diarax_dixion</code>)
    </footer>

</body>
</html>

