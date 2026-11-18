@extends('layouts.admin')

@section('title', 'Categories Management &bull; DIARAX Admin')
@section('page_title', 'Equipment Categories')

@section('content')
<div class="space-y-6">

    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-heading text-xl font-bold text-slate-900">Medical Categories Catalog</h2>
            <p class="text-xs text-slate-500">Manage clinical divisions, navigation menus, and equipment categories</p>
        </div>
        <button 
            type="button" 
            onclick="openAddCategoryModal()" 
            class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl font-bold text-xs bg-blue-700 hover:bg-blue-800 text-white shadow-xs transition"
        >
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Category
        </button>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3 px-4 w-12 text-center">#</th>
                        <th class="py-3 px-4">Category Details</th>
                        <th class="py-3 px-4">Slug (URL)</th>
                        <th class="py-3 px-4 text-center">Sort Order</th>
                        <th class="py-3 px-4 text-center">Products</th>
                        <th class="py-3 px-4 text-center">Featured</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $cat)
                        <tr class="hover:bg-slate-50 transition">
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
                                        <div class="font-bold text-slate-900">{{ $cat->name }}</div>
                                        @if($cat->short_description)
                                            <div class="text-[11px] text-slate-500 line-clamp-1 max-w-xs">{{ $cat->short_description }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-600">
                                {{ $cat->slug }}
                            </td>
                            <td class="py-3.5 px-4 text-center font-semibold text-slate-700">
                                {{ $cat->sort_order }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                <a href="{{ route('admin.products.index', ['category' => $cat->slug]) }}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                                    {{ $cat->products_count }} Products
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
                                    
                                    @if($cat->products_count === 0)
                                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove category \'{{ $cat->name }}\'?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Delete Category">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="p-1.5 text-slate-300 cursor-not-allowed" title="Category has products attached. Reassign them first to delete.">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-500">
                                No categories found. Click "Add New Category" above to create one.
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
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-7 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="font-heading text-base font-bold text-slate-900">Add Medical Category</h3>
            <button type="button" onclick="closeAddCategoryModal()" class="text-slate-400 hover:text-slate-600 p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 pt-4">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Category Name *</label>
                <input type="text" name="name" required placeholder="e.g. Operating Tables & Lights" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">URL Slug</label>
                    <input type="text" name="slug" placeholder="e.g. operating-tables-lights" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
                    <p class="text-[10px] text-slate-400 mt-0.5">Leave blank to auto-generate</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="0" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Short Description</label>
                <textarea name="short_description" rows="2" placeholder="Brief clinical description of devices in this category..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50"></textarea>
            </div>

            <!-- Image Selection: File Upload OR URL -->
            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                    Category Cover Image
                </label>

                <div class="space-y-2 text-xs">
                    <div>
                        <span class="text-[11px] font-semibold text-slate-700 block mb-1">Option 1: Upload from Computer</span>
                        <input type="file" name="image_file" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div class="relative flex py-1 items-center">
                        <div class="flex-grow border-t border-slate-200"></div>
                        <span class="flex-shrink mx-2 text-[10px] text-slate-400 uppercase font-bold">OR</span>
                        <div class="flex-grow border-t border-slate-200"></div>
                    </div>
                    <div>
                        <span class="text-[11px] font-semibold text-slate-700 block mb-1">Option 2: Image Web URL</span>
                        <input type="url" name="image_url" placeholder="https://images.unsplash.com/..." class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-300 focus:ring-1 focus:ring-blue-600 focus:outline-none font-mono">
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-2 pt-1">
                <input type="checkbox" name="is_featured" id="add_cat_featured" value="1" checked class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                <label for="add_cat_featured" class="text-xs text-slate-700 font-semibold cursor-pointer">
                    Show as Featured in Navbar & Highlights
                </label>
            </div>

            <div class="pt-3 flex items-center justify-end space-x-2">
                <button type="button" onclick="closeAddCategoryModal()" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold bg-blue-700 hover:bg-blue-800 text-white shadow-xs transition">
                    Save Category
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div id="editCategoryModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs hidden">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-7 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <h3 class="font-heading text-base font-bold text-slate-900">Edit Medical Category</h3>
            <button type="button" onclick="closeEditCategoryModal()" class="text-slate-400 hover:text-slate-600 p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="editCategoryForm" method="POST" enctype="multipart/form-data" class="space-y-4 pt-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Category Name *</label>
                <input type="text" id="edit_cat_name" name="name" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">URL Slug *</label>
                    <input type="text" id="edit_cat_slug" name="slug" required class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Sort Order</label>
                    <input type="number" id="edit_cat_sort" name="sort_order" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
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

            <!-- Image Selection: File Upload OR URL -->
            <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                    Update Cover Image
                </label>

                <div class="space-y-2 text-xs">
                    <div>
                        <span class="text-[11px] font-semibold text-slate-700 block mb-1">Option 1: Upload New File</span>
                        <input type="file" name="image_file" accept="image/*" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div class="relative flex py-1 items-center">
                        <div class="flex-grow border-t border-slate-200"></div>
                        <span class="flex-shrink mx-2 text-[10px] text-slate-400 uppercase font-bold">OR</span>
                        <div class="flex-grow border-t border-slate-200"></div>
                    </div>
                    <div>
                        <span class="text-[11px] font-semibold text-slate-700 block mb-1">Option 2: Image Web URL</span>
                        <input type="url" id="edit_cat_url" name="image_url" placeholder="https://..." class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-300 focus:ring-1 focus:ring-blue-600 focus:outline-none font-mono">
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-2 pt-1">
                <input type="checkbox" name="is_featured" id="edit_cat_featured" value="1" class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                <label for="edit_cat_featured" class="text-xs text-slate-700 font-semibold cursor-pointer">
                    Show as Featured in Navbar & Highlights
                </label>
            </div>

            <div class="pt-3 flex items-center justify-end space-x-2">
                <button type="button" onclick="closeEditCategoryModal()" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100 transition">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl text-xs font-bold bg-blue-700 hover:bg-blue-800 text-white shadow-xs transition">
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
        document.getElementById('edit_cat_sort').value = cat.sort_order ?? 0;
        document.getElementById('edit_cat_desc').value = cat.short_description || '';
        document.getElementById('edit_cat_featured').checked = !!cat.is_featured;

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
