@extends('layouts.admin')

@section('title', 'Edit Equipment &bull; DIARAX Admin')
@section('page_title', 'Edit Product')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-heading text-xl font-bold text-slate-900">Edit {{ $product->name }}</h2>
            <p class="text-xs text-slate-500">Model: <span class="font-mono font-bold text-blue-700">{{ $product->model_code }}</span></p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-blue-700 hover:underline">
            &larr; Back to Catalog
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-2xs">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Equipment Name *</label>
                    <input type="text" name="name" required value="{{ old('name', $product->name) }}" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Model Code *</label>
                    <input type="text" name="model_code" required value="{{ old('model_code', $product->model_code) }}" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Clinical Department *</label>
                    <select name="category_id" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
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

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Full Technical Description *</label>
                <textarea name="description" rows="4" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Image URL</label>
                <input type="url" name="image" value="{{ old('image', $product->image) }}" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
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
@endsection
