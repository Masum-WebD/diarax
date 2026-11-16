@extends('layouts.admin')

@section('title', 'Executive Medical ERP Dashboard &bull; DIARAX')
@section('page_title', 'Executive Dashboard')

@section('content')
<div class="space-y-6">

    <!-- Welcome & Quick Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
        <div>
            <div class="flex items-center space-x-2">
                <h2 class="font-heading text-xl font-bold text-slate-900">
                    Welcome, {{ auth()->user()->name ?? 'DIARAX Administrator' }}
                </h2>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                    Verified
                </span>
            </div>
            <p class="text-xs text-slate-500 mt-0.5">
                Real-time overview of hospital equipment sales, procurement purchases, banners, and catalog models.
            </p>
        </div>

        <!-- Quick Action Buttons -->
        <div class="flex items-center flex-wrap gap-2 text-xs font-semibold">
            <a href="{{ route('admin.sales.index') }}" class="px-3.5 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white transition shadow-2xs flex items-center space-x-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>New Sale</span>
            </a>
            <a href="{{ route('admin.purchases.index') }}" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition flex items-center space-x-1.5">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>New Purchase</span>
            </a>
            <a href="{{ route('admin.banners.index') }}" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition flex items-center space-x-1.5">
                <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Banners</span>
            </a>
        </div>
    </div>

    <!-- 4 Key Performance Indicator (KPI) Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- 1. Equipment Sales -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Equipment Sales</span>
                <span class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </span>
            </div>
            <div class="text-2xl font-extrabold font-heading text-slate-900 mt-2">$342,850</div>
            <div class="flex items-center justify-between text-xs mt-2 pt-2 border-t border-slate-100">
                <span class="text-emerald-600 font-semibold flex items-center">
                    <svg class="w-3 h-3 mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    +14.2% MoM
                </span>
                <a href="{{ route('admin.sales.index') }}" class="text-blue-700 hover:underline">View Sales &rarr;</a>
            </div>
        </div>

        <!-- 2. Procurement Purchases -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Procurement</span>
                <span class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </span>
            </div>
            <div class="text-2xl font-extrabold font-heading text-slate-900 mt-2">$186,400</div>
            <div class="flex items-center justify-between text-xs mt-2 pt-2 border-t border-slate-100">
                <span class="text-slate-500 font-medium">18 Active POs</span>
                <a href="{{ route('admin.purchases.index') }}" class="text-blue-700 hover:underline">View Purchases &rarr;</a>
            </div>
        </div>

        <!-- 3. Active Products Catalog -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Medical Catalog</span>
                <span class="w-8 h-8 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </span>
            </div>
            <div class="text-2xl font-extrabold font-heading text-slate-900 mt-2">{{ $totalProducts }} Models</div>
            <div class="flex items-center justify-between text-xs mt-2 pt-2 border-t border-slate-100">
                <span class="text-slate-500 font-medium">{{ $totalCategories }} Specialties</span>
                <a href="{{ route('admin.products.index') }}" class="text-blue-700 hover:underline">Manage &rarr;</a>
            </div>
        </div>

        <!-- 4. Hospital Quote Inquiries -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs hover:shadow-sm transition">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Inquiries & Leads</span>
                <span class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                </span>
            </div>
            <div class="text-2xl font-extrabold font-heading text-slate-900 mt-2">{{ $totalInquiries }}</div>
            <div class="flex items-center justify-between text-xs mt-2 pt-2 border-t border-slate-100">
                <span class="text-amber-600 font-semibold">{{ $newInquiries }} Pending Review</span>
                <a href="{{ route('admin.inquiries') }}" class="text-blue-700 hover:underline">Review &rarr;</a>
            </div>
        </div>

    </div>

    <!-- Two-Column Layout for Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left: Recent Sales & Inquiries (7 cols) -->
        <div class="lg:col-span-7 space-y-6">
            
            <!-- Recent Sales Orders -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900 text-sm">Recent Equipment Sales</h3>
                        <p class="text-[11px] text-slate-500">Direct hospital procurement and export shipments</p>
                    </div>
                    <a href="{{ route('admin.sales.index') }}" class="text-xs font-bold text-blue-700 hover:text-blue-800">
                        View All &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50/80 text-slate-500 uppercase tracking-wider text-[10px]">
                            <tr>
                                <th class="py-2.5 px-4">Invoice #</th>
                                <th class="py-2.5 px-4">Client Hospital</th>
                                <th class="py-2.5 px-4">Equipment</th>
                                <th class="py-2.5 px-4">Total</th>
                                <th class="py-2.5 px-4">Fulfillment</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @foreach($recentSales as $sale)
                                <tr class="hover:bg-slate-50/60 transition">
                                    <td class="py-3 px-4 font-mono font-bold text-slate-900">{{ $sale['id'] }}</td>
                                    <td class="py-3 px-4">
                                        <div class="font-semibold text-slate-900">{{ $sale['hospital'] }}</div>
                                        <div class="text-[11px] text-slate-400">{{ $sale['country'] }}</div>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600 max-w-xs truncate">{{ $sale['equipment'] }}</td>
                                    <td class="py-3 px-4 font-bold text-slate-900">${{ number_format($sale['amount']) }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $sale['delivery'] === 'Delivered' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                                            {{ $sale['delivery'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Inquiries -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900 text-sm">Latest Website Inquiries</h3>
                        <p class="text-[11px] text-slate-500">Live requests from global hospital directors & engineers</p>
                    </div>
                    <a href="{{ route('admin.inquiries') }}" class="text-xs font-bold text-blue-700 hover:text-blue-800">
                        View All &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-slate-50/80 text-slate-500 uppercase tracking-wider text-[10px]">
                            <tr>
                                <th class="py-2.5 px-4">Contact</th>
                                <th class="py-2.5 px-4">Organization</th>
                                <th class="py-2.5 px-4">Purpose</th>
                                <th class="py-2.5 px-4">Status</th>
                                <th class="py-2.5 px-4">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($recentInquiries as $inq)
                                <tr class="hover:bg-slate-50/60 transition">
                                    <td class="py-3 px-4">
                                        <div class="font-semibold text-slate-900">{{ $inq->full_name }}</div>
                                        <div class="text-[11px] text-slate-400">{{ $inq->email }}</div>
                                    </td>
                                    <td class="py-3 px-4 text-slate-600">{{ $inq->organization ?? 'Clinic' }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-slate-100 text-slate-700">
                                            {{ $inq->inquiry_type }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $inq->status === 'new' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-emerald-50 text-emerald-700' }}">
                                            {{ $inq->status }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <a href="{{ route('admin.inquiries') }}" class="text-[11px] font-bold text-blue-700 hover:underline">Review</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-slate-400">No inquiries yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Right: Purchases & System Health (5 cols) -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Recent Purchases -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
                <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-slate-900 text-sm">Recent Purchases</h3>
                        <p class="text-[11px] text-slate-500">Component suppliers & raw materials</p>
                    </div>
                    <a href="{{ route('admin.purchases.index') }}" class="text-xs font-bold text-blue-700 hover:text-blue-800">
                        All POs &rarr;
                    </a>
                </div>

                <div class="p-4 divide-y divide-slate-100 space-y-3">
                    @foreach($recentPurchases as $po)
                        <div class="pt-3 first:pt-0">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs font-bold text-slate-900">{{ $po['id'] }}</span>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $po['status'] === 'Received' ? 'bg-emerald-50 text-emerald-700' : 'bg-blue-50 text-blue-700' }}">
                                    {{ $po['status'] }}
                                </span>
                            </div>
                            <div class="text-xs font-semibold text-slate-800 mt-1">{{ $po['supplier'] }}</div>
                            <div class="text-[11px] text-slate-500 line-clamp-1">{{ $po['items'] }}</div>
                            <div class="flex items-center justify-between text-[11px] text-slate-400 mt-1.5">
                                <span>{{ $po['date'] }}</span>
                                <strong class="text-slate-800 font-bold">${{ number_format($po['amount']) }}</strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- System Architecture & Status Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-2xs space-y-3">
                <h3 class="font-bold text-slate-900 text-sm">System & Server Status</h3>
                <div class="space-y-2 text-xs">
                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-600 font-medium">Database Connection</span>
                        <span class="text-emerald-700 font-bold font-mono">MySQL (Laragon 3306)</span>
                    </div>
                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-600 font-medium">Authentication Guard</span>
                        <span class="text-blue-700 font-bold">Session &bull; Web Guard</span>
                    </div>
                    <div class="flex items-center justify-between p-2.5 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-slate-600 font-medium">Frontend Compiler</span>
                        <span class="text-purple-700 font-bold">Vite &bull; Tailwind CSS</span>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
