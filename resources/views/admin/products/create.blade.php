@extends('layouts.admin')

@section('title', 'Add New Medical Equipment &bull; DIARAX Admin')
@section('page_title', 'Add New Product')

@push('styles')
<!-- Free Quill Rich Text Editor CSS -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-toolbar.ql-snow {
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
        border-color: #cbd5e1;
        background-color: #f8fafc;
    }
    .ql-container.ql-snow {
        border-bottom-left-radius: 0.75rem;
        border-bottom-right-radius: 0.75rem;
        border-color: #cbd5e1;
        font-family: inherit;
        font-size: 0.75rem;
        min-height: 180px;
    }
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-heading text-xl font-bold text-slate-900">Add New Medical Device</h2>
            <p class="text-xs text-slate-500">Register a new precision device into the DIARAX catalog</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-blue-700 hover:underline">
            &larr; Back to Catalog
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs">
        <form id="productForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Equipment Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. DIARAX Operamed 3000" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Model Code *</label>
                    <input type="text" name="model_code" value="{{ old('model_code') }}" required placeholder="e.g. OP-3000-KR" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Clinical Category *</label>
                        <a href="{{ route('admin.categories.index') }}" target="_blank" class="text-[11px] text-blue-700 hover:underline font-semibold">+ Manage Categories</a>
                    </div>
                    <select name="category_id" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Catalog Status *</label>
                    <select name="status" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        <option value="active">Active</option>
                        <option value="draft">Draft</option>
                        <option value="discontinued">Discontinued</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline') }}" placeholder="e.g. Electro-hydraulic Multi-Disciplinary Surgical Table" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Short Description *</label>
                <textarea name="short_description" rows="2" required placeholder="Brief clinical summary for catalog cards..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">{{ old('short_description') }}</textarea>
            </div>

            <!-- Free Rich Text Editor for Full Description -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Full Technical Description (Rich Text Editor) *
                    </label>
                    <span class="text-[10px] text-slate-400">Format headings, lists, bold, and specs</span>
                </div>
                <input type="hidden" name="description" id="hidden_description" value="{{ old('description') }}">
                <div id="quill_editor">{!! old('description') !!}</div>
            </div>

            <!-- Image Selection: File Upload OR URL -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                    Equipment Image
                </label>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <!-- Option A: File Upload -->
                    <div class="p-3 bg-white rounded-xl border border-slate-200 space-y-1.5">
                        <span class="text-[11px] font-bold text-slate-700 block">Option 1: Upload from Computer</span>
                        <input 
                            type="file" 
                            name="image_file" 
                            accept="image/*" 
                            onchange="previewImageFile(this, 'product_preview')"
                            class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        >
                    </div>

                    <!-- Option B: Image URL -->
                    <div class="p-3 bg-white rounded-xl border border-slate-200 space-y-1.5">
                        <span class="text-[11px] font-bold text-slate-700 block">Option 2: Image Web URL</span>
                        <input 
                            type="url" 
                            name="image_url" 
                            value="{{ old('image_url') }}"
                            placeholder="https://images.unsplash.com/..." 
                            oninput="previewImageUrl(this.value, 'product_preview')"
                            class="w-full px-2.5 py-1 text-xs rounded-lg border border-slate-300 focus:ring-1 focus:ring-blue-600 focus:outline-none font-mono"
                        >
                    </div>
                </div>

                <!-- Preview Thumbnail -->
                <div class="pt-1 flex items-center space-x-3">
                    <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Image Preview:</span>
                    <div class="w-20 h-20 rounded-xl bg-slate-200 overflow-hidden border border-slate-300 shadow-2xs">
                        <img id="product_preview" src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=400&q=80" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-6 pt-2">
                <label class="inline-flex items-center text-xs text-slate-700 font-semibold cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 mr-2">
                    <span>Feature on Homepage</span>
                </label>

                <label class="inline-flex items-center text-xs text-slate-700 font-semibold cursor-pointer">
                    <input type="checkbox" name="is_new" value="1" checked class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 mr-2">
                    <span>Mark as New Model</span>
                </label>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3 border-t border-slate-100">
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-xs transition">
                    Create Equipment
                </button>
            </div>
        </form>
    </div>

</div>

@push('scripts')
<!-- Free Quill Rich Text Editor JS -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
    // Initialize Quill
    const quill = new Quill('#quill_editor', {
        theme: 'snow',
        placeholder: 'Write comprehensive technical specifications, clinical indications, South Korean manufacturing certifications...',
        modules: {
            toolbar: [
                [{ 'header': [2, 3, 4, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['blockquote', 'link'],
                ['clean']
            ]
        }
    });

    // Sync Quill content to hidden form input on submit
    const productForm = document.getElementById('productForm');
    productForm.addEventListener('submit', function (e) {
        const hiddenDesc = document.getElementById('hidden_description');
        hiddenDesc.value = quill.root.innerHTML;
        if (quill.getText().trim().length === 0) {
            e.preventDefault();
            alert('Please provide a full technical description.');
        }
    });

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
