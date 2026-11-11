@extends('layouts.app')

@section('title', 'Turnkey Hospital Solutions & Healthcare Engineering | DIARAX South Korea')

@section('content')
<!-- Header (White Theme) -->
<div class="bg-gradient-to-b from-slate-50 to-white text-slate-900 py-12 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Turnkey Healthcare</span>
            <h1 class="font-heading text-2xl sm:text-4xl font-extrabold mt-2 text-slate-900 leading-tight">
                Turnkey Hospital Equipping & Modular Complexes
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-2 leading-relaxed">
                From 3D architectural planning and sterile cleanroom paneling to complete clinical outfitting, staff training, and biomedical servicing engineered from Seoul, South Korea.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="space-y-12">
        @foreach($solutions as $index => $solution)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center {{ $index % 2 == 1 ? 'lg:flex-row-reverse' : '' }}">
                <div class="lg:col-span-6 {{ $index % 2 == 1 ? 'lg:order-2' : '' }}">
                    <div class="relative rounded-3xl overflow-hidden shadow-md border border-slate-200">
                        <img src="{{ $solution->image }}" alt="{{ $solution->title }}" class="w-full h-72 sm:h-80 object-cover">
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-xs font-bold uppercase tracking-wider bg-white/90 text-slate-900 backdrop-blur-xs shadow-xs">
                            {{ $solution->category }}
                        </span>
                    </div>
                </div>

                <div class="lg:col-span-6 space-y-4 {{ $index % 2 == 1 ? 'lg:order-1' : '' }}">
                    <div>
                        <span class="text-[11px] font-bold uppercase tracking-widest text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-full">
                            Solution 0{{ $loop->iteration }}
                        </span>
                        <h2 class="font-heading text-xl sm:text-2xl font-extrabold text-slate-900 mt-2">
                            {{ $solution->title }}
                        </h2>
                        @if($solution->subtitle)
                            <p class="text-xs font-semibold text-slate-500 mt-1">
                                {{ $solution->subtitle }}
                            </p>
                        @endif
                    </div>

                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        {{ $solution->overview }}
                    </p>

                    @if($solution->deliverables)
                        <div class="space-y-1.5 pt-1">
                            <h4 class="font-heading text-[11px] font-bold uppercase tracking-wider text-slate-700">Scope of Supply:</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs text-slate-600">
                                @foreach($solution->deliverables as $deliv)
                                    <div class="flex items-start">
                                        <svg class="w-3.5 h-3.5 text-blue-700 mr-1.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>{{ $deliv }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="pt-2 flex flex-wrap gap-2.5">
                        <a href="{{ route('solutions.show', $solution->slug) }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs transition">
                            Project Specifications &rarr;
                        </a>
                        <a href="{{ route('quote', ['type' => 'turnkey']) }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs transition shadow-xs">
                            Consult Engineering Team
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
