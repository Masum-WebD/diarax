@extends('layouts.admin')

@section('title', 'Categories & Subcategories Management • DIARAX Admin')
@section('page_title', 'Equipment Categories & Subcategories')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-heading text-xl font-bold text-slate-900">Medical Categories Catalog & Subcategories</h2>
            <p class="text-xs text-slate-500">Manage clinical divisions, subcategories, navigation mega-menu, and equipment catalog groupings</p>
        </div>
        <button 
            type="button" 
            onclick="openAddCategoryModal()" 
            class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl font-bold text-xs bg-blue-700 hover:bg-blue-800 text-white shadow-xs transition"
        >
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Category / Subcategory
        </button>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Main Categories</span>
            <span class="text-2xl font-bold text-slate-900 font-heading">
                {{ $categories->whereNull('parent_id')->count() }}
            </span>
            <span class="text-xs text-slate-500 block mt-0.5">Top-level clinical divisions</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Subcategories</span>
            <span class="text-2xl font-bold text-blue-700 font-heading">
                {{ $categories->whereNotNull('parent_id')->count() }}
            </span>
            <span class="text-xs text-slate-500 block mt-0.5">Specific equipment lines</span>
        </div>
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">Total Catalog Groups</span>
            <span class="text-2xl font-bold text-emerald-600 font-heading">
                {{ $categories->count() }}
            </span>
            <span class="text-xs text-slate-500 block mt-0.5">Active across public portal</span>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3 px-4 w-12 text-center">#</th>
                        <th class="py-3 px-4">Category Name & Details</th>
                        <th class="py-3 px-4">Level / Hierarchy</th>
                        <th class="py-3 px-4">Slug (URL)</th>
                        <th class="py-3 px-4 text-center">Sort Order</th>
                        <th class="py-3 px-4 text-center">Products</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $cat)
                        <tr class="hover:bg-slate-50 transition {{ $cat->parent_id ? 'bg-slate-50/40' : '' }}">
                            <td class="py-3.5 px-4 text-center font-mono text-slate-400 font-bold">
                                {{ $cat->id }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-slate-100 border border-slate-200 overflow-hidden flex-shrink-0 flex items-center justify-center">
                                        @if($cat->image)
                                            <img src="{{ $cat->image }}" alt="{{ $cat->name }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                            @if($cat->parent_id)
                                                <span class="text-slate-400 font-mono text-xs">&rarr;</span>
                                            @endif
                                            {{ $cat->name }}
                                        </div>
                                        @if($cat->short_description)
                                            <div class="text-[11px] text-slate-500 line-clamp-1 max-w-xs">{{ $cat->short_description }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                @if($cat->parent_id)
                                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-purple-50 text-purple-700 border border-purple-200">
                                        Subcategory of: {{ $cat->parent->name ?? 'Parent #' . $cat->parent_id }}
                                    </div>
                                @else
                                    <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        Main Division
                                        @if($cat->subcategories->count() > 0)
                                            <span class="ml-1.5 px-1.5 py-0.2 rounded-full bg-blue-200/70 text-blue-900 text-[10px]">
                                                {{ $cat->subcategories->count() }} Sub
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-600">
                                {{ $cat->slug }}
                            </td>
                            <td class="py-3.5 px-4 text-center font-semibold text-slate-700">
                                {{ $cat->sort_order }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @php
                                    $prodCount = $cat->products_count + ($cat->subcategory_products_count ?? 0);
                                @endphp
                                <a href="{{ route('admin.products.index', [$cat->parent_id ? 'subcategory' : 'category' => $cat->slug]) }}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                                    {{ $prodCount }} Products
                                </a>
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($cat->is_featured)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-500">
                                        Standard
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="inline-flex items-center space-x-1.5">
                                    <button 
                                        type="button" 
                                        onclick="openEditCategoryModal({{ json_encode($cat) }})" 
                                        class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 transition" 
                                        title="Edit Category"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    
                                    @if($prodCount === 0 && $cat->subcategories->count() === 0)
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove \'{{ $cat->name }}\'?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Delete Category">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="p-1.5 text-slate-300 cursor-not-allowed" title="Category has products or subcategories attached. Reassign or remove them first.">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-8 text-center text-slate-500">
                                No categories found. Click "Add Category / Subcategory" above to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div id="addCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs hidden">
    <div class="bg-white rounded-3xl max-w-3xl w-full p-6 sm:p-7 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto" style="max-width: 780px; width: 95%;">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <div>
                <h3 class="font-heading text-base font-bold text-slate-900">Add Category / Subcategory</h3>
                <p class="text-[11px] text-slate-500">Create a clinical division or link a subcategory to an existing parent</p>
            </div>
            <button type="button" onclick="closeAddCategoryModal()" class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition shadow-2xs cursor-pointer" title="Close Modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pt-4">
            @csrf

            <!-- Parent Category Selection -->
            <div class="bg-blue-50/50 p-3.5 rounded-2xl border border-blue-100">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 mb-1">
                    Category Type & Parent Hierarchy
                </label>
                <select name="parent_id" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white font-medium">
                    <option value="">-- None (This is a Top-Level Main Clinical Division) --</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}">↳ Subcategory under: {{ $parent->name }}</option>
                    @endforeach
                </select>
                <p class="text-[11px] text-slate-500 mt-1.5 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Leave as <strong>None</strong> for a top-level division (e.g. "Surgery & Operation Theater"). Select a parent if this is a subcategory (e.g. "Surgical Tables").
                </p>
            </div>

            <!-- 2 Columns: Name & Slug -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Category / Subcategory Name *</label>
                    <input type="text" name="name" required placeholder="e.g. Hematology Analyzer or Surgical Tables" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">URL Slug</label>
                    <input type="text" name="slug" placeholder="e.g. hematology-analyzer" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
                    <p class="text-[10px] text-slate-400 mt-0.5">Leave blank to auto-generate from name</p>
                </div>
            </div>

            <!-- 2 Columns: Sort Order & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Display Sort Order</label>
                    <input type="number" name="sort_order" value="0" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                    <p class="text-[10px] text-slate-400 mt-0.5">Lower numbers display first (0, 1, 2...)</p>
                </div>

                <div class="pt-2 md:pt-4">
                    <label class="flex items-center space-x-2.5 p-3 rounded-xl bg-slate-50 border border-slate-200/80 cursor-pointer hover:bg-slate-100 transition">
                        <input type="checkbox" name="is_featured" id="add_cat_featured" value="1" checked class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                        <div>
                            <span class="text-xs text-slate-800 font-bold block">Active in Navigation Menus</span>
                            <span class="text-[10px] text-slate-500 block">Show in header mega-menus and catalog filters</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Full Width: Short Description -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Short Description</label>
                <textarea name="short_description" rows="2" placeholder="Brief clinical description or equipment overview..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50"></textarea>
            </div>

            <!-- Cover Image (Upload File OR URL side by side in 2 columns) -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                    Cover Image
                </label>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 bg-white rounded-xl border border-slate-200/90">
                        <span class="text-[11px] font-bold text-slate-700 block mb-1.5">Option 1: Upload from Computer</span>
                        <input type="file" name="image_file" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div class="p-3 bg-white rounded-xl border border-slate-200/90">
                        <span class="text-[11px] font-bold text-slate-700 block mb-1.5">Option 2: Image Web URL</span>
                        <input type="url" name="image_url" placeholder="https://images.unsplash.com/..." class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-300 focus:ring-1 focus:ring-blue-600 focus:outline-none font-mono">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-2.5 border-t border-slate-100">
                <button type="button" onclick="closeAddCategoryModal()" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold bg-blue-700 hover:bg-blue-800 text-white shadow-xs transition cursor-pointer">
                    Save Category
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs hidden">
    <div class="bg-white rounded-3xl max-w-3xl w-full p-6 sm:p-7 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto" style="max-width: 780px; width: 95%;">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <div>
                <h3 class="font-heading text-base font-bold text-slate-900">Edit Category / Subcategory</h3>
                <p class="text-[11px] text-slate-500">Update category hierarchy, URL slug, and display settings</p>
            </div>
            <button type="button" onclick="closeEditCategoryModal()" class="w-9 h-9 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 flex items-center justify-center transition shadow-2xs cursor-pointer" title="Close Modal">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="editCategoryForm" method="POST" enctype="multipart/form-data" class="space-y-4 pt-4">
            @csrf
            @method('PUT')

            <!-- Parent Category Selection -->
            <div class="bg-blue-50/50 p-3.5 rounded-2xl border border-blue-100">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 mb-1">
                    Category Type & Parent Hierarchy
                </label>
                <select id="edit_cat_parent_id" name="parent_id" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-white font-medium">
                    <option value="">-- None (This is a Top-Level Main Clinical Division) --</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}">↳ Subcategory under: {{ $parent->name }}</option>
                    @endforeach
                </select>
                <p class="text-[11px] text-slate-500 mt-1.5 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Leave as <strong>None</strong> for Main Categories, or select a Parent for Subcategories.
                </p>
            </div>

            <!-- 2 Columns: Name & Slug -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Category / Subcategory Name *</label>
                    <input type="text" id="edit_cat_name" name="name" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">URL Slug *</label>
                    <input type="text" id="edit_cat_slug" name="slug" required class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
                </div>
            </div>

            <!-- 2 Columns: Sort Order & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Display Sort Order</label>
                    <input type="number" id="edit_cat_sort" name="sort_order" class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                    <p class="text-[10px] text-slate-400 mt-0.5">Lower numbers display first (0, 1, 2...)</p>
                </div>

                <div class="pt-2 md:pt-4">
                    <label class="flex items-center space-x-2.5 p-3 rounded-xl bg-slate-50 border border-slate-200/80 cursor-pointer hover:bg-slate-100 transition">
                        <input type="checkbox" name="is_featured" id="edit_cat_featured" value="1" class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                        <div>
                            <span class="text-xs text-slate-800 font-bold block">Active in Navigation Menus</span>
                            <span class="text-[10px] text-slate-500 block">Show in header mega-menus and catalog filters</span>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Short Description</label>
                <textarea id="edit_cat_desc" name="short_description" rows="2" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50"></textarea>
            </div>

            <!-- Current Image Preview -->
            <div id="edit_cat_current_img_box" class="hidden">
                <span class="text-[11px] font-bold text-slate-600 block mb-1">Current Cover Image:</span>
                <div class="h-20 w-32 rounded-xl bg-slate-100 overflow-hidden border border-slate-200">
                    <img id="edit_cat_current_img" src="" alt="Category Image" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Cover Image (Upload File OR URL side by side in 2 columns) -->
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                    Update Cover Image
                </label>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 bg-white rounded-xl border border-slate-200/90">
                        <span class="text-[11px] font-bold text-slate-700 block mb-1.5">Option 1: Upload New File</span>
                        <input type="file" name="image_file" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div class="p-3 bg-white rounded-xl border border-slate-200/90">
                        <span class="text-[11px] font-bold text-slate-700 block mb-1.5">Option 2: Image Web URL</span>
                        <input type="url" id="edit_cat_url" name="image_url" placeholder="https://..." class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-300 focus:ring-1 focus:ring-blue-600 focus:outline-none font-mono">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-2.5 border-t border-slate-100">
                <button type="button" onclick="closeEditCategoryModal()" class="px-5 py-2.5 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition cursor-pointer">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl text-xs font-bold bg-blue-700 hover:bg-blue-800 text-white shadow-xs transition cursor-pointer">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
    }

    function closeAddCategoryModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
    }

    function openEditCategoryModal(cat) {
        document.getElementById('editCategoryForm').action = '/admin/categories/' + cat.id;
        document.getElementById('edit_cat_name').value = cat.name || '';
        document.getElementById('edit_cat_slug').value = cat.slug || '';
        document.getElementById('edit_cat_parent_id').value = cat.parent_id || '';
        document.getElementById('edit_cat_sort').value = cat.sort_order ?? 0;
        document.getElementById('edit_cat_desc').value = cat.short_description || '';
        document.getElementById('edit_cat_featured').checked = !!cat.is_featured;

        // Prevent selecting itself as parent
        const parentSelect = document.getElementById('edit_cat_parent_id');
        for (let i = 0; i < parentSelect.options.length; i++) {
            if (parentSelect.options[i].value == cat.id) {
                parentSelect.options[i].disabled = true;
            } else {
                parentSelect.options[i].disabled = false;
            }
        }

        const imgBox = document.getElementById('edit_cat_current_img_box');
        const imgEl = document.getElementById('edit_cat_current_img');
        if (cat.image) {
            imgEl.src = cat.image;
            imgBox.classList.remove('hidden');
            if (cat.image.startsWith('http')) {
                document.getElementById('edit_cat_url').value = cat.image;
            } else {
                document.getElementById('edit_cat_url').value = '';
            }
        } else {
            imgBox.classList.add('hidden');
            document.getElementById('edit_cat_url').value = '';
        }

        document.getElementById('editCategoryModal').classList.remove('hidden');
    }

    function closeEditCategoryModal() {
        document.getElementById('editCategoryModal').classList.add('hidden');
    }
</script>
@endsection
