@extends('layouts.app')

@section('title', $solution->title . ' | Turnkey Solutions DIARAX South Korea')

@section('content')
<div class="bg-slate-50 border-b border-slate-200 text-xs py-2.5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center space-x-2 text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-blue-700">Home</a>
            <span>/</span>
            <a href="{{ route('solutions.index') }}" class="hover:text-blue-700">Turnkey Solutions</a>
            <span>/</span>
            <span class="text-slate-800 font-semibold truncate">{{ $solution->title }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8 space-y-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-50 px-3 py-1 rounded-full">
                    {{ $solution->category }} &bull; South Korea Engineering
                </span>
                <h1 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">
                    {{ $solution->title }}
                </h1>
                @if($solution->subtitle)
                    <p class="text-xs sm:text-sm font-semibold text-slate-500 mt-1">
                        {{ $solution->subtitle }}
                    </p>
                @endif
            </div>

            <div class="rounded-3xl overflow-hidden shadow-md border border-slate-200">
                <img src="{{ $solution->image }}" alt="{{ $solution->title }}" class="w-full h-72 sm:h-96 object-cover">
            </div>

            <div class="prose max-w-none text-slate-600 text-xs sm:text-sm leading-relaxed space-y-3">
                <p>{{ $solution->description }}</p>
            </div>

            @if($solution->deliverables)
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs">
                    <h3 class="font-heading text-base font-bold text-slate-900 mb-3">Complete Scope of Deliverables</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs text-slate-600">
                        @foreach($solution->deliverables as $deliv)
                            <div class="flex items-start p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                                <svg class="w-4 h-4 text-emerald-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ $deliv }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($solution->benefits)
                <div class="bg-blue-50/60 rounded-2xl p-6 border border-blue-100">
                    <h3 class="font-heading text-base font-bold text-blue-950 mb-3">Key Hospital Advantages</h3>
                    <ul class="space-y-2 text-xs text-blue-900">
                        @foreach($solution->benefits as $benefit)
                            <li class="flex items-start">
                                <svg class="w-4 h-4 text-blue-700 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ $benefit }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Sidebar Actions -->
        <div class="lg:col-span-4 space-y-6">
            <div class="bg-slate-50 text-slate-900 p-6 rounded-2xl border border-blue-200 shadow-xs">
                <h3 class="font-heading text-lg font-bold mb-1.5">Request Project Estimate</h3>
                <p class="text-xs text-slate-600 leading-relaxed mb-4">
                    Connect with our turnkey hospital engineers in Seoul, South Korea to discuss room layouts, technical specifications, and budgetary planning.
                </p>
                <a href="{{ route('quote', ['type' => 'turnkey', 'subject' => $solution->title]) }}" class="block text-center py-2.5 px-4 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs uppercase tracking-wider transition">
                    Contact Engineering Desk
                </a>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
                <h4 class="font-heading font-bold text-xs text-slate-900 mb-3 uppercase tracking-wider">Other Turnkey Projects</h4>
                <ul class="space-y-2 text-xs">
                    @foreach($otherSolutions as $other)
                        <li>
                            <a href="{{ route('solutions.show', $other->slug) }}" class="block p-2.5 rounded-xl bg-slate-50 hover:bg-blue-50 hover:text-blue-700 transition font-medium text-slate-700">
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
