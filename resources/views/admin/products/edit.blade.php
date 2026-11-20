@extends('layouts.admin')

@section('title', 'Edit ' . $product->model_code . ' &bull; DIARAX Admin')
@section('page_title', 'Edit Product: ' . $product->model_code)

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
            <h2 class="font-heading text-xl font-bold text-slate-900">Edit {{ $product->name }}</h2>
            <p class="text-xs text-slate-500">Update medical equipment specifications, categories, and imagery</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="text-xs font-semibold text-slate-600 hover:text-blue-700">
                View Public Page &rarr;
            </a>
            <span class="text-slate-300">&bull;</span>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-blue-700 hover:underline">
                &larr; Back to Catalog
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs">
        <form id="productEditForm" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Equipment Name *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Model Code *</label>
                    <input type="text" name="model_code" value="{{ old('model_code', $product->model_code) }}" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Clinical Category *</label>
                        <a href="{{ route('admin.categories.index') }}" target="_blank" class="text-[11px] text-blue-700 hover:underline font-semibold">+ Manage</a>
                    </div>
                    <select id="product_category_id" name="category_id" required onchange="filterSubcategories()" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">Subcategory (Optional)</label>
                        <span class="text-[10px] text-slate-400">Line/Segment</span>
                    </div>
                    <select id="product_subcategory_id" name="subcategory_id" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        <option value="">-- None (Direct Category) --</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}" data-parent="{{ $sub->parent_id }}" {{ (old('subcategory_id', $product->subcategory_id) == $sub->id) ? 'selected' : '' }}>
                                {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Status *</label>
                    <select name="status" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="draft" {{ $product->status === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="discontinued" {{ $product->status === 'discontinued' ? 'selected' : '' }}>Discontinued</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline', $product->tagline) }}" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Short Description *</label>
                <textarea name="short_description" rows="2" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">{{ old('short_description', $product->short_description) }}</textarea>
            </div>

            <!-- Trust & Quality Badges (Under Image on Product Details Page) -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                        Trust & Quality Badges (Under Image)
                    </label>
                    <span class="text-[10px] text-slate-400">Dynamic 3 badges shown below image</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Certified Quality</label>
                        <input type="text" name="certified_quality" value="{{ old('certified_quality', $product->certified_quality ?? 'ISO 13485') }}" placeholder="e.g. ISO 13485" class="w-full px-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Clinical Approved</label>
                        <input type="text" name="regulatory_standard" value="{{ old('regulatory_standard', $product->regulatory_standard ?? 'Korea MFDS') }}" placeholder="e.g. Korea MFDS" class="w-full px-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Global Warranty</label>
                        <input type="text" name="warranty" value="{{ old('warranty', $product->warranty ?? '24 Months Global') }}" placeholder="e.g. 24 Months Global" class="w-full px-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white">
                    </div>
                </div>
            </div>

            <!-- Clinical Highlights (Features List) -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2.5">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                        Clinical Highlights (Features List)
                    </label>
                    <span class="text-[10px] text-slate-400">Displayed as checklist bullet points</span>
                </div>
                <p class="text-[11px] text-slate-500">
                    Enter key clinical advantages/highlights (one item per line):
                </p>
                <textarea name="features_text" rows="5" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white leading-relaxed font-mono">{{ old('features_text', !empty($product->features) ? implode("\n", $product->features) : '') }}</textarea>
            </div>

            <!-- Free Quill Rich Text Editor for Full Description -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Full Technical Description (Rich Text Editor) *
                    </label>
                    <span class="text-[10px] text-slate-400">Format headings, lists, bold, and specs</span>
                </div>
                <input type="hidden" name="description" id="hidden_description" value="{{ old('description', $product->description) }}">
                <div id="quill_editor">{!! old('description', $product->description) !!}</div>
            </div>

            <!-- Technical Parameters (Specifications Table) -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                        Technical Parameters (Specifications Table)
                    </label>
                    <button type="button" onclick="addSpecRow()" class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                        + Add Parameter Row
                    </button>
                </div>
                <p class="text-[11px] text-slate-500">
                    Edit key-value technical parameters for the specifications table on the product details page:
                </p>
                <div id="specs_container" class="space-y-2">
                    @if(!empty($product->specifications))
                        @foreach($product->specifications as $key => $val)
                            <div class="spec-row flex items-center space-x-2">
                                <input type="text" name="spec_keys[]" value="{{ $key }}" placeholder="Parameter Name" class="w-1/2 px-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white">
                                <input type="text" name="spec_values[]" value="{{ $val }}" placeholder="Value" class="w-1/2 px-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white">
                                <button type="button" onclick="this.parentElement.remove()" class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg" title="Remove parameter">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="spec-row flex items-center space-x-2">
                            <input type="text" name="spec_keys[]" placeholder="Parameter Name" class="w-1/2 px-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white">
                            <input type="text" name="spec_values[]" placeholder="Value" class="w-1/2 px-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white">
                            <button type="button" onclick="this.parentElement.remove()" class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg" title="Remove parameter">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Image Selection: File Upload OR URL -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <div class="flex items-center justify-between">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                        Equipment Image
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
                            onchange="previewImageFile(this, 'product_edit_preview')"
                            class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        >
                    </div>

                    <!-- Option B: Image URL -->
                    <div class="p-3 bg-white rounded-xl border border-slate-200 space-y-1.5">
                        <span class="text-[11px] font-bold text-slate-700 block">Option 2: Replace via URL</span>
                        <input 
                            type="url" 
                            name="image_url" 
                            value="{{ old('image_url', $product->image && str_starts_with($product->image, 'http') ? $product->image : '') }}"
                            placeholder="https://images.unsplash.com/..." 
                            oninput="previewImageUrl(this.value, 'product_edit_preview')"
                            class="w-full px-2.5 py-1 text-xs rounded-lg border border-slate-300 focus:ring-1 focus:ring-blue-600 focus:outline-none font-mono"
                        >
                    </div>
                </div>

                <!-- Preview Thumbnail -->
                <div class="pt-1 flex items-center space-x-3">
                    <span class="text-[10px] text-slate-500 uppercase tracking-wider font-semibold">Current Image:</span>
                    <div class="w-20 h-20 rounded-xl bg-slate-200 overflow-hidden border border-slate-300 shadow-2xs">
                        <img id="product_edit_preview" src="{{ $product->image }}" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-6 pt-2">
                <label class="inline-flex items-center text-xs text-slate-700 font-semibold cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 mr-2">
                    <span>Feature on Homepage</span>
                </label>

                <label class="inline-flex items-center text-xs text-slate-700 font-semibold cursor-pointer">
                    <input type="checkbox" name="is_new" value="1" {{ $product->is_new ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500 mr-2">
                    <span>Mark as New Model</span>
                </label>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-3 border-t border-slate-100">
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-xs transition">
                    Update Equipment
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
    const productEditForm = document.getElementById('productEditForm');
    productEditForm.addEventListener('submit', function (e) {
        const hiddenDesc = document.getElementById('hidden_description');
        hiddenDesc.value = quill.root.innerHTML;
        if (quill.getText().trim().length === 0) {
            e.preventDefault();
            alert('Please provide a full technical description.');
        }
    });

    function addSpecRow() {
        const container = document.getElementById('specs_container');
        const div = document.createElement('div');
        div.className = 'spec-row flex items-center space-x-2';
        div.innerHTML = `
            <input type="text" name="spec_keys[]" placeholder="Parameter Name" class="w-1/2 px-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white">
            <input type="text" name="spec_values[]" placeholder="Value" class="w-1/2 px-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white">
            <button type="button" onclick="this.parentElement.remove()" class="p-1.5 text-rose-500 hover:bg-rose-50 rounded-lg" title="Remove parameter">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        `;
        container.appendChild(div);
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

    function filterSubcategories() {
        const catSelect = document.getElementById('product_category_id');
        const subSelect = document.getElementById('product_subcategory_id');
        if (!catSelect || !subSelect) return;
        const selectedCatId = catSelect.value;
        const currentSubVal = subSelect.value;

        for (let i = 0; i < subSelect.options.length; i++) {
            const opt = subSelect.options[i];
            const parentId = opt.getAttribute('data-parent');
            if (!parentId) {
                opt.hidden = false;
                continue;
            }
            if (selectedCatId && parentId === selectedCatId) {
                opt.hidden = false;
            } else {
                opt.hidden = true;
                if (opt.value === currentSubVal) {
                    subSelect.value = '';
                }
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        filterSubcategories();
    });
</script>
@endpush
@endsection
