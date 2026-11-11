@extends('layouts.app')

@section('title', 'News & International Exhibitions | DIARAX South Korea')

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
                Stay updated on upcoming medical congresses (KIMES Seoul, Arab Health, MEDICA), product launches, and corporate updates from DIARAX South Korea.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($news as $article)
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-md transition flex flex-col justify-between">
                <div class="h-44 overflow-hidden bg-slate-100">
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                </div>

                <div class="p-5 flex-grow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                            <span class="font-bold text-blue-700 uppercase">{{ $article->category }}</span>
                            <span>{{ $article->event_date ? $article->event_date->format('M d, Y') : '' }}</span>
                        </div>
                        <h3 class="font-heading text-base font-bold text-slate-900 mb-2">
                            {{ $article->title }}
                        </h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-3">
                            {{ $article->summary }}
                        </p>
                        <p class="text-xs text-slate-600 line-clamp-3">
                            {{ $article->content }}
                        </p>
                    </div>

                    <div class="pt-3 border-t border-slate-100 mt-3 flex items-center justify-between text-xs text-slate-500">
                        <span class="flex items-center">
                            <svg class="w-3.5 h-3.5 text-slate-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $article->location }}
                        </span>
                        <a href="{{ route('contact') }}" class="text-blue-700 font-semibold hover:underline">
                            Meet Us &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $news->links() }}
    </div>
</div>
@endsection
