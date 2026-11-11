@extends('layouts.app')

@section('title', 'Turnkey Hospital Solutions & Healthcare Engineering | DIXION Medical')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 via-slate-900 to-sky-950 text-white py-16 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-sky-400 bg-sky-500/10 px-3 py-1 rounded-full">Turnkey Engineering</span>
            <h1 class="font-heading text-3xl sm:text-5xl font-extrabold mt-3">
                Complex Hospital Equipping & Healthcare Infrastructure
            </h1>
            <p class="text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                From initial 3D architectural planning and sterile cleanroom paneling to complete clinical outfitting, staff training, and biomedical servicing.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="space-y-16">
        @foreach($solutions as $index => $solution)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center {{ $index % 2 == 1 ? 'lg:flex-row-reverse' : '' }}">
                <div class="lg:col-span-6 {{ $index % 2 == 1 ? 'lg:order-2' : '' }}">
                    <div class="relative rounded-3xl overflow-hidden shadow-xl border border-slate-200">
                        <img src="{{ $solution->image }}" alt="{{ $solution->title }}" class="w-full h-80 sm:h-96 object-cover">
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-slate-900/80 text-white backdrop-blur-sm">
                            {{ $solution->category }}
                        </span>
                    </div>
                </div>

                <div class="lg:col-span-6 space-y-5 {{ $index % 2 == 1 ? 'lg:order-1' : '' }}">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">
                            Solution 0{{ $loop->iteration }}
                        </span>
                        <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">
                            {{ $solution->title }}
                        </h2>
                        @if($solution->subtitle)
                            <p class="text-xs sm:text-sm font-semibold text-slate-500 mt-1">
                                {{ $solution->subtitle }}
                            </p>
                        @endif
                    </div>

                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        {{ $solution->overview }}
                    </p>

                    @if($solution->deliverables)
                        <div class="space-y-2 pt-2">
                            <h4 class="font-heading text-xs font-bold uppercase tracking-wider text-slate-700">Scope of Supply:</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-600">
                                @foreach($solution->deliverables as $deliv)
                                    <div class="flex items-start">
                                        <svg class="w-3.5 h-3.5 text-sky-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>{{ $deliv }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="pt-4 flex flex-wrap gap-4">
                        <a href="{{ route('solutions.show', $solution->slug) }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition">
                            Project Details & Specifications &rarr;
                        </a>
                        <a href="{{ route('quote', ['type' => 'turnkey']) }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs transition shadow-sm">
                            Consult with DIXION Engineers
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
