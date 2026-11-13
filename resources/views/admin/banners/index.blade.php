@extends('layouts.admin')

@section('title', 'Hero Banner Management &bull; DIARAX Admin')
@section('page_title', 'Hero Banners (ব্যানার মডিউল)')

@section('content')
<div class="space-y-6">

    <!-- Top Action Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
        <div>
            <h2 class="font-heading text-lg sm:text-xl font-bold text-slate-900">
                Homepage Hero Slider Management
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Configure full-width medical background images, South Korean engineering headlines, and transition sequences.
            </p>
        </div>

        <button 
            type="button" 
            onclick="document.getElementById('add-banner-modal').classList.remove('hidden')"
            class="px-4 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-2xs transition flex items-center space-x-1.5 self-start sm:self-auto"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Add New Banner Slide</span>
        </button>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Active Slides</span>
            <div class="text-2xl font-bold font-heading text-slate-900 mt-1">3 Active</div>
            <span class="text-[11px] text-emerald-600 font-semibold">Running on Homepage</span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Cycle Duration</span>
            <div class="text-2xl font-bold font-heading text-slate-900 mt-1">4.5 Seconds</div>
            <span class="text-[11px] text-slate-500">Smooth crossfade transition</span>
        </div>
        <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Controls</span>
            <div class="text-2xl font-bold font-heading text-slate-900 mt-1">Auto & Manual</div>
            <span class="text-[11px] text-slate-500">Arrows & indicator dots enabled</span>
        </div>
    </div>

    <!-- Banner Slides List / Cards -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Configured Hero Slides</h3>
            <span class="text-xs text-slate-500">Drag or edit order to adjust homepage display sequence</span>
        </div>

        <div class="divide-y divide-slate-100">
            @foreach($banners as $banner)
                <div class="p-5 flex flex-col md:flex-row md:items-center justify-between gap-5 hover:bg-slate-50/70 transition">
                    
                    <!-- Left: Preview & Content -->
                    <div class="flex items-start space-x-4">
                        <div class="w-32 h-20 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0 border border-slate-200 shadow-2xs relative">
                            <img src="{{ $banner['image'] }}" alt="{{ $banner['title'] }}" class="w-full h-full object-cover">
                            <span class="absolute top-1.5 left-1.5 px-1.5 py-0.5 rounded text-[9px] font-bold uppercase bg-black/60 text-white backdrop-blur-xs">
                                Slide #{{ $banner['sort_order'] }}
                            </span>
                        </div>

                        <div class="space-y-1">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">
                                {{ $banner['badge'] }}
                            </span>
                            <h4 class="font-heading text-sm font-bold text-slate-900">
                                {{ $banner['title'] }}
                            </h4>
                            <p class="text-xs text-slate-500 line-clamp-1 max-w-xl">
                                {{ $banner['subtitle'] }}
                            </p>
                        </div>
                    </div>

                    <!-- Right: Status & Actions -->
                    <div class="flex items-center space-x-3 self-end md:self-center">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-200">
                            {{ $banner['status'] }}
                        </span>
                        
                        <a href="{{ route('home') }}" target="_blank" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-100 text-xs font-semibold transition">
                            Preview
                        </a>

                        <button 
                            type="button" 
                            onclick="alert('Slide details loaded for editing.')"
                            class="px-3 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-semibold transition"
                        >
                            Edit
                        </button>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

</div>

<!-- Modal: Add New Banner Slide -->
<div id="add-banner-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-in fade-in duration-200">
        
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="font-heading text-lg font-bold text-slate-900">Add Hero Banner Slide</h3>
                <p class="text-xs text-slate-500">Create a new background slide for the DIARAX homepage</p>
            </div>
            <button type="button" onclick="document.getElementById('add-banner-modal').classList.add('hidden')" class="p-1 rounded-lg text-slate-400 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.banners.store') }}" method="POST" class="mt-4 space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Badge Text</label>
                <input type="text" name="badge" placeholder="e.g. South Korean Technology • ISO 13485" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Headline / Title *</label>
                <input type="text" name="title" required placeholder="e.g. South Korean Precision Engineering for Global Healthcare" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Subtitle / Description *</label>
                <textarea name="subtitle" rows="2" required placeholder="DIARAX manufactures over 250 advanced medical equipment models..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50"></textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Background Image URL</label>
                <input type="url" name="image" placeholder="https://images.unsplash.com/photo-..." value="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1920&q=80" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Display Order</label>
                    <input type="number" name="sort_order" value="4" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        <option value="active">Active</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-2">
                <button type="button" onclick="document.getElementById('add-banner-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold transition shadow-xs">
                    Save Banner Slide
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

