@extends('layouts.admin')

@section('title', 'Medical Products Management &bull; DIARAX Admin')
@section('page_title', 'Products Catalog (প্রোডাক্ট মডিউল)')

@section('content')
<div class="space-y-6">

    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
        <div>
            <h2 class="font-heading text-lg sm:text-xl font-bold text-slate-900">
                Medical Equipment Catalog
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Manage all 250+ South Korean clinical devices across surgery, anesthesia, ICU, and diagnostics.
            </p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="px-4 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-2xs transition flex items-center space-x-1.5 self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Add New Equipment</span>
        </a>
    </div>

    <!-- Filters & Search Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <form method="GET" action="{{ route('admin.products.index') }}" class="w-full flex flex-col sm:flex-row items-center gap-3">
            
            <div class="relative flex-1 w-full">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search by model code (e.g. OP-3000) or name..." 
                    class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition"
                >
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>

            <div class="w-full sm:w-64">
                <select name="category" onchange="this.form.submit()" class="w-full px-3 py-2 text-xs rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:outline-none">
                    <option value="">All Clinical Departments</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-800 text-white text-xs font-semibold hover:bg-slate-900 transition self-stretch sm:self-auto">
                Filter
            </button>
            @if(request('search') || request('category'))
                <a href="{{ route('admin.products.index') }}" class="text-xs text-rose-600 hover:underline">Clear</a>
            @endif
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider text-[10px] border-b border-slate-100">
                    <tr>
                        <th class="py-3 px-4">Device Preview</th>
                        <th class="py-3 px-4">Model Code</th>
                        <th class="py-3 px-4">Product Name</th>
                        <th class="py-3 px-4">Category</th>
                        <th class="py-3 px-4">Badges</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($products as $prod)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3 px-4">
                                <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden border border-slate-200 flex-shrink-0">
                                    <img src="{{ $prod->image }}" alt="{{ $prod->name }}" class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="py-3 px-4 font-mono font-bold text-blue-700">
                                {{ $prod->model_code }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-slate-900">{{ $prod->name }}</div>
                                <div class="text-[11px] text-slate-400 line-clamp-1 max-w-xs">{{ $prod->short_description }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-700">
                                    {{ $prod->category->name ?? 'General' }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-1">
                                    @if($prod->is_featured)
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase bg-blue-50 text-blue-700 border border-blue-200">
                                            Featured
                                        </span>
                                    @endif
                                    @if($prod->is_new)
                                        <span class="px-1.5 py-0.5 rounded text-[9px] font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            New
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $prod->status === 'active' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $prod->status }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right space-x-1 whitespace-nowrap">
                                <a href="{{ route('products.show', $prod->slug) }}" target="_blank" class="px-2.5 py-1 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 text-[11px] font-semibold transition inline-block">
                                    View
                                </a>
                                <a href="{{ route('admin.products.edit', $prod->id) }}" class="px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 text-[11px] font-semibold transition inline-block">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $prod->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 rounded-lg hover:bg-rose-50 text-rose-600 text-[11px] font-semibold transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-slate-400">
                                No products found matching your search.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>

</div>
@endsection

