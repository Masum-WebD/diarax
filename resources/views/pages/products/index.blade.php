@extends('layouts.app')

@section('title', 'Medical Equipment Catalog | DIXION Medical Systems')

@section('content')
<!-- Page Header -->
<div class="bg-gradient-to-r from-slate-900 to-slate-950 text-white py-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-sky-400 bg-sky-500/10 px-3 py-1 rounded-full">Official Catalog</span>
            <h1 class="font-heading text-3xl sm:text-4xl font-extrabold mt-3">
                {{ $currentCategory ? $currentCategory->name : 'Medical Equipment & Systems' }}
            </h1>
            <p class="text-slate-300 text-sm mt-2">
                {{ $currentCategory ? $currentCategory->short_description : 'Explore DIXION\'s complete portfolio of certified German medical technologies, from modular operating suites to intensive care monitors.' }}
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Filters -->
        <aside class="space-y-6">
            <!-- Search Widget -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
                <h3 class="font-heading text-sm font-bold text-slate-900 mb-3 uppercase tracking-wider">Search Equipment</h3>
                <form action="{{ route('products.index') }}" method="GET" class="space-y-2">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="relative">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search model or keyword..." class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <button type="submit" class="w-full py-2 bg-slate-900 hover:bg-sky-600 text-white rounded-xl text-xs font-semibold transition">
                        Search Catalog
                    </button>
                    @if(request()->hasAny(['q', 'category', 'featured', 'new', 'sort']))
                        <a href="{{ route('products.index') }}" class="block text-center text-xs text-rose-500 hover:underline pt-1">
                            Clear all filters
                        </a>
                    @endif
                </form>
            </div>

            <!-- Categories Filter -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
                <h3 class="font-heading text-sm font-bold text-slate-900 mb-3 uppercase tracking-wider">Departments</h3>
                <ul class="space-y-1 text-xs">
                    <li>
                        <a href="{{ route('products.index', array_merge(request()->except('category', 'page'))) }}" class="flex items-center justify-between py-2 px-3 rounded-xl transition {{ !request('category') ? 'bg-sky-50 text-sky-700 font-bold' : 'text-slate-600 hover:bg-slate-50' }}">
                            <span>All Equipment</span>
                            <span class="text-slate-400 font-normal">({{ \App\Models\Product::count() }})</span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $cat->slug])) }}" class="flex items-center justify-between py-2 px-3 rounded-xl transition {{ request('category') === $cat->slug ? 'bg-sky-50 text-sky-700 font-bold' : 'text-slate-600 hover:bg-slate-50' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="text-slate-400 font-normal">({{ $cat->products_count }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Fast Contact Assistance Box -->
            <div class="bg-gradient-to-br from-sky-900 to-slate-900 text-white p-6 rounded-2xl shadow-md">
                <h4 class="font-heading font-bold text-sm mb-1">Need Project Support?</h4>
                <p class="text-xs text-slate-300 leading-relaxed mb-4">
                    Our biomedical engineering team can assist you in selecting the ideal medical models for your clinical budget.
                </p>
                <a href="{{ route('quote') }}" class="block text-center py-2 px-3 rounded-xl bg-sky-500 hover:bg-sky-400 text-slate-950 font-bold text-xs transition">
                    Request Consultation
                </a>
            </div>
        </aside>

        <!-- Product Listing Grid -->
        <main class="lg:col-span-3">
            <!-- Filter Bar & Counter -->
            <div class="bg-white p-4 rounded-2xl border border-slate-200/80 mb-6 flex flex-wrap items-center justify-between gap-4">
                <div class="text-xs text-slate-600">
                    Showing <span class="font-bold text-slate-900">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span> of <span class="font-bold text-slate-900">{{ $products->total() }}</span> models
                </div>

                <!-- Sort Dropdown -->
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center space-x-2 text-xs">
                    @foreach(request()->except('sort', 'page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <label for="sort" class="text-slate-500">Sort by:</label>
                    <select name="sort" id="sort" onchange="this.form.submit()" class="py-1.5 px-3 rounded-xl border border-slate-300 text-xs bg-white text-slate-800 focus:ring-2 focus:ring-sky-500 outline-none">
                        <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured First</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Models</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z-A</option>
                    </select>
                </form>
            </div>

            @if($products->isEmpty())
                <div class="bg-white rounded-2xl p-12 text-center border border-slate-200">
                    <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3 class="font-heading text-lg font-bold text-slate-800">No medical devices found</h3>
                    <p class="text-xs text-slate-500 mt-1 mb-4">Try adjusting your search criteria or explore all categories.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-sky-600 text-white text-xs font-semibold rounded-xl hover:bg-sky-700 transition">
                        View Entire Catalog
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:border-sky-300 transition duration-300 flex flex-col justify-between group">
                            <!-- Image -->
                            <div class="relative h-48 bg-slate-100 overflow-hidden">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <span class="absolute top-3 left-3 px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-slate-900/80 text-white backdrop-blur-sm">
                                    {{ $product->category->name }}
                                </span>
                                @if($product->is_new)
                                    <span class="absolute top-3 right-3 px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-emerald-600 text-white">
                                        New
                                    </span>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="text-[11px] font-bold uppercase tracking-wider text-sky-600 mb-1">
                                        {{ $product->model_code }}
                                    </div>
                                    <h3 class="font-heading text-base font-bold text-slate-900 group-hover:text-sky-600 transition mb-2">
                                        <a href="{{ route('products.show', $product->slug) }}">
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-4">
                                        {{ $product->short_description }}
                                    </p>
                                </div>

                                <div class="pt-3 border-t border-slate-100 flex items-center justify-between gap-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="flex-1 text-center py-2 px-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition">
                                        Specs & Details
                                    </a>
                                    <a href="{{ route('quote', ['product_id' => $product->id]) }}" class="flex-1 text-center py-2 px-3 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-semibold text-xs transition">
                                        Quote
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
