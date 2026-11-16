@extends('layouts.admin')

@section('title', 'Hero Banner Management &bull; DIARAX Admin')
@section('page_title', 'Hero Banners')

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
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Configured Slides</span>
            <div class="text-2xl font-bold font-heading text-slate-900 mt-1">{{ count($banners) }} Total ({{ $banners->where('status', 'active')->count() }} Active)</div>
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
            <span class="text-xs text-slate-500">Edit content or order to adjust homepage display sequence</span>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($banners as $banner)
                <div class="p-5 flex flex-col md:flex-row md:items-center justify-between gap-5 hover:bg-slate-50/70 transition">
                    
                    <!-- Left: Preview & Content -->
                    <div class="flex items-start space-x-4">
                        <div class="w-32 h-20 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0 border border-slate-200 shadow-2xs relative">
                            <img src="{{ $banner->image }}" alt="{{ $banner->title }}" class="w-full h-full object-cover">
                            <span class="absolute top-1.5 left-1.5 px-1.5 py-0.5 rounded text-[9px] font-bold uppercase bg-black/60 text-white backdrop-blur-xs">
                                Slide #{{ $banner->sort_order }}
                            </span>
                        </div>

                        <div class="space-y-1">
                            @if($banner->badge)
                                <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700 bg-blue-50 px-2 py-0.5 rounded border border-blue-100">
                                    {{ $banner->badge }}
                                </span>
                            @endif
                            <h4 class="font-heading text-sm font-bold text-slate-900">
                                {{ $banner->title }}
                            </h4>
                            <p class="text-xs text-slate-500 line-clamp-1 max-w-xl">
                                {{ $banner->subtitle }}
                            </p>
                        </div>
                    </div>

                    <!-- Right: Status & Actions -->
                    <div class="flex items-center space-x-2 self-end md:self-center">
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase {{ $banner->status === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600' }}">
                            {{ $banner->status }}
                        </span>
                        
                        <a href="{{ route('home') }}" target="_blank" class="px-3 py-1.5 rounded-lg border border-slate-200 text-slate-700 hover:bg-slate-100 text-xs font-semibold transition">
                            Preview
                        </a>

                        <button 
                            type="button" 
                            onclick='openEditBannerModal(@json($banner))'
                            class="px-3 py-1.5 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-semibold transition"
                        >
                            Edit
                        </button>

                        <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this banner slide?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2.5 py-1.5 rounded-lg hover:bg-rose-50 text-rose-600 text-xs font-semibold transition">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="p-8 text-center text-slate-400 text-xs">
                    No banner slides configured yet. Click "Add New Banner Slide" above.
                </div>
            @endforelse
        </div>
    </div>

</div>

<!-- Modal 1: Add New Banner Slide -->
<div id="add-banner-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-xs hidden flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-in fade-in duration-200 my-8">
        
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="font-heading text-lg font-bold text-slate-900">Add Hero Banner Slide</h3>
                <p class="text-xs text-slate-500">Create a new background slide for the DIARAX homepage</p>
            </div>
            <button type="button" onclick="document.getElementById('add-banner-modal').classList.add('hidden')" class="p-1 rounded-lg text-slate-400 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
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

            <!-- Image Selection: File Upload OR URL -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                    Banner Background Image
                </label>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- Option A: File Upload -->
                    <div class="p-3 bg-white rounded-xl border border-slate-200 space-y-1.5">
                        <span class="text-[11px] font-bold text-slate-700 block">Option 1: Upload from Computer</span>
                        <input 
                            type="file" 
                            name="image_file" 
                            accept="image/*"
                            onchange="previewImageFile(this, 'add_preview')"
                            class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        >
                    </div>

                    <!-- Option B: Image URL -->
                    <div class="p-3 bg-white rounded-xl border border-slate-200 space-y-1.5">
                        <span class="text-[11px] font-bold text-slate-700 block">Option 2: Image Web URL</span>
                        <input 
                            type="url" 
                            name="image_url" 
                            id="add_image_url"
                            placeholder="https://images.unsplash.com/..." 
                            oninput="previewImageUrl(this.value, 'add_preview')"
                            class="w-full px-2.5 py-1 text-xs rounded-lg border border-slate-300 focus:ring-1 focus:ring-blue-600 focus:outline-none font-mono"
                        >
                    </div>
                </div>

                <!-- Preview Thumbnail -->
                <div class="pt-1 flex items-center space-x-3">
                    <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Image Preview:</span>
                    <div class="w-24 h-14 rounded-lg bg-slate-200 overflow-hidden border border-slate-300 shadow-2xs">
                        <img id="add_preview" src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=400&q=80" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>
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

            <div class="pt-4 flex items-center justify-end space-x-2 border-t border-slate-100">
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

<!-- Modal 2: Edit Banner Slide -->
<div id="edit-banner-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-xs hidden flex items-center justify-center p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-in fade-in duration-200 my-8">
        
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="font-heading text-lg font-bold text-slate-900">Edit Hero Banner Slide</h3>
                <p class="text-xs text-slate-500">Update slide text, ordering, and background image</p>
            </div>
            <button type="button" onclick="document.getElementById('edit-banner-modal').classList.add('hidden')" class="p-1 rounded-lg text-slate-400 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="edit-banner-form" action="" method="POST" enctype="multipart/form-data" class="mt-4 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Badge Text</label>
                <input type="text" name="badge" id="edit_badge" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Headline / Title *</label>
                <input type="text" name="title" id="edit_title" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Subtitle / Description *</label>
                <textarea name="subtitle" id="edit_subtitle" rows="2" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50"></textarea>
            </div>

            <!-- Image Selection: File Upload OR URL -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                        Banner Background Image
                    </label>
                    <span class="text-[10px] text-slate-400">Leave unchanged or replace</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- Option A: File Upload -->
                    <div class="p-3 bg-white rounded-xl border border-slate-200 space-y-1.5">
                        <span class="text-[11px] font-bold text-slate-700 block">Option 1: Upload New File</span>
                        <input 
                            type="file" 
                            name="image_file" 
                            accept="image/*"
                            onchange="previewImageFile(this, 'edit_preview')"
                            class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        >
                    </div>

                    <!-- Option B: Image URL -->
                    <div class="p-3 bg-white rounded-xl border border-slate-200 space-y-1.5">
                        <span class="text-[11px] font-bold text-slate-700 block">Option 2: Replace via URL</span>
                        <input 
                            type="url" 
                            name="image_url" 
                            id="edit_image_url"
                            placeholder="https://images.unsplash.com/..." 
                            oninput="previewImageUrl(this.value, 'edit_preview')"
                            class="w-full px-2.5 py-1 text-xs rounded-lg border border-slate-300 focus:ring-1 focus:ring-blue-600 focus:outline-none font-mono"
                        >
                    </div>
                </div>

                <!-- Preview Thumbnail -->
                <div class="pt-1 flex items-center space-x-3">
                    <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Current Image:</span>
                    <div class="w-24 h-14 rounded-lg bg-slate-200 overflow-hidden border border-slate-300 shadow-2xs">
                        <img id="edit_preview" src="" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Display Order</label>
                    <input type="number" name="sort_order" id="edit_sort_order" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Status</label>
                    <select name="status" id="edit_status" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        <option value="active">Active</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-2 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('edit-banner-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold transition shadow-xs">
                    Update Banner Slide
                </button>
            </div>
        </form>

    </div>
</div>

@push('scripts')
<script>
    function openEditBannerModal(banner) {
        const form = document.getElementById('edit-banner-form');
        form.action = "{{ url('admin/banners') }}/" + banner.id;

        document.getElementById('edit_badge').value = banner.badge || '';
        document.getElementById('edit_title').value = banner.title || '';
        document.getElementById('edit_subtitle').value = banner.subtitle || '';
        document.getElementById('edit_sort_order').value = banner.sort_order || 0;
        document.getElementById('edit_status').value = banner.status || 'active';
        document.getElementById('edit_image_url').value = banner.image || '';

        const preview = document.getElementById('edit_preview');
        preview.src = banner.image || 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=400&q=80';

        document.getElementById('edit-banner-modal').classList.remove('hidden');
    }

    function previewImageFile(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewImageUrl(url, previewId) {
        if (url && url.length > 5) {
            document.getElementById(previewId).src = url;
        }
    }
</script>
@endpush

@endsection
