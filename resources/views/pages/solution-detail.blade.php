@extends('layouts.app')

@section('title', $solution->title . ' | Turnkey Solutions DIXION')

@section('content')
<div class="bg-slate-100 border-b border-slate-200 text-xs py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center space-x-2 text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-slate-800">Home</a>
            <span>/</span>
            <a href="{{ route('solutions.index') }}" class="hover:text-slate-800">Turnkey Solutions</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold truncate">{{ $solution->title }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <div class="lg:col-span-8 space-y-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                    {{ $solution->category }}
                </span>
                <h1 class="font-heading text-3xl sm:text-4xl font-extrabold text-slate-900 mt-3">
                    {{ $solution->title }}
                </h1>
                @if($solution->subtitle)
                    <p class="text-sm font-semibold text-slate-500 mt-2">
                        {{ $solution->subtitle }}
                    </p>
                @endif
            </div>

            <div class="rounded-3xl overflow-hidden shadow-lg border border-slate-200">
                <img src="{{ $solution->image }}" alt="{{ $solution->title }}" class="w-full h-80 sm:h-96 object-cover">
            </div>

            <div class="prose max-w-none text-slate-600 text-sm sm:text-base leading-relaxed space-y-4">
                <p>{{ $solution->description }}</p>
            </div>

            @if($solution->deliverables)
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200">
                    <h3 class="font-heading text-lg font-bold text-slate-900 mb-4">Complete Deliverables & Scope</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs sm:text-sm text-slate-600">
                        @foreach($solution->deliverables as $deliv)
                            <div class="flex items-start p-3 bg-slate-50 rounded-xl border border-slate-100">
                                <svg class="w-4 h-4 text-emerald-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ $deliv }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($solution->benefits)
                <div class="bg-sky-50 rounded-3xl p-6 sm:p-8 border border-sky-100">
                    <h3 class="font-heading text-lg font-bold text-sky-950 mb-4">Key Client Advantages</h3>
                    <ul class="space-y-2.5 text-xs sm:text-sm text-sky-900">
                        @foreach($solution->benefits as $benefit)
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-sky-600 mr-2.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ $benefit }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Sidebar Actions -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-slate-900 text-white p-6 rounded-3xl shadow-xl">
                <h3 class="font-heading text-xl font-bold mb-2">Request Project Estimate</h3>
                <p class="text-xs text-slate-300 leading-relaxed mb-6">
                    Connect with our turnkey hospital engineers in Düsseldorf to discuss room layouts, technical specifications, and budgetary planning.
                </p>
                <a href="{{ route('quote', ['type' => 'turnkey', 'subject' => $solution->title]) }}" class="block text-center py-3 px-4 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition">
                    Contact Engineering Desk
                </a>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-slate-200">
                <h4 class="font-heading font-bold text-sm text-slate-900 mb-4">Other Turnkey Solutions</h4>
                <ul class="space-y-3 text-xs">
                    @foreach($otherSolutions as $other)
                        <li>
                            <a href="{{ route('solutions.show', $other->slug) }}" class="block p-3 rounded-xl bg-slate-50 hover:bg-sky-50 hover:text-sky-700 transition font-medium text-slate-700">
                                {{ $other->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
