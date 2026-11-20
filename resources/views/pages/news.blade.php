@extends('layouts.app')

@section('title', 'News & Medical Trade Fairs | DIARAX South Korea')

@section('content')
<!-- Header (White Theme) -->
<div class="bg-gradient-to-b from-slate-50 to-white text-slate-900 py-12 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Exhibitions & Events</span>
            <h1 class="font-heading text-2xl sm:text-4xl font-extrabold mt-2 text-slate-900">
                News & Medical Trade Fairs
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-1.5 leading-relaxed">
                Stay updated on upcoming medical congresses, product launches, and corporate updates from DIARAX South Korea.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="max-w-xl mx-auto bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 text-center shadow-xs">
        <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <h2 class="font-heading text-lg font-bold text-slate-900 mb-2">
            No Active Events Scheduled
        </h2>
        <p class="text-xs text-slate-500 leading-relaxed mb-6">
            Official trade fair participation dates, medical congresses, and exhibitions will be posted here once announced. For partnership or delegation inquiries, please connect directly with our Seoul team.
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs tracking-wide transition shadow-xs">
            Contact DIARAX Team &rarr;
        </a>
    </div>
</div>
@endsection
