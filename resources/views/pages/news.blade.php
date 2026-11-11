@extends('layouts.app')

@section('title', 'News & International Exhibitions | DIXION Medical')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 via-slate-900 to-slate-950 text-white py-16 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-sky-400 bg-sky-500/10 px-3 py-1 rounded-full">Exhibitions & Media</span>
            <h1 class="font-heading text-3xl sm:text-5xl font-extrabold mt-3">
                News & Medical Trade Fairs
            </h1>
            <p class="text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                Stay updated on upcoming medical congresses, product premieres, international distributor conventions, and corporate announcements from DIXION.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($news as $article)
            <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-lg transition flex flex-col justify-between">
                <div class="h-48 overflow-hidden bg-slate-100">
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                </div>

                <div class="p-6 flex-grow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between text-xs text-slate-500 mb-2">
                            <span class="font-bold text-sky-600 uppercase">{{ $article->category }}</span>
                            <span>{{ $article->event_date ? $article->event_date->format('M d, Y') : '' }}</span>
                        </div>
                        <h3 class="font-heading text-lg font-bold text-slate-900 mb-3">
                            {{ $article->title }}
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            {{ $article->summary }}
                        </p>
                        <p class="text-xs text-slate-500 line-clamp-3">
                            {{ $article->content }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100 mt-4 flex items-center justify-between text-xs text-slate-500">
                        <span class="flex items-center">
                            <svg class="w-3.5 h-3.5 text-slate-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $article->location }}
                        </span>
                        <a href="{{ route('contact') }}" class="text-sky-600 font-semibold hover:underline">
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
