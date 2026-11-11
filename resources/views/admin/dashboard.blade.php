@extends('layouts.admin')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Hospital Inquiries & Inventory Overview</h1>
            <p class="text-xs text-slate-500 mt-1">Real-time status of quote requests submitted via website and active medical models.</p>
        </div>
        <a href="{{ route('admin.inquiries') }}" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-semibold">
            View All Inquiries &rarr;
        </a>
    </div>

    <!-- Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Inquiries</span>
            <div class="text-3xl font-extrabold text-slate-900 mt-2">{{ $totalInquiries }}</div>
            <span class="text-[11px] text-slate-400">Stored in MySQL DB</span>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Pending Review</span>
            <div class="text-3xl font-extrabold text-amber-600 mt-2">{{ $newInquiries }}</div>
            <span class="text-[11px] text-amber-500">Requires follow-up</span>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-sky-600">Active Products</span>
            <div class="text-3xl font-extrabold text-slate-900 mt-2">{{ $totalProducts }}</div>
            <span class="text-[11px] text-slate-400">Medical equipment models</span>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-600">Clinical Departments</span>
            <div class="text-3xl font-extrabold text-slate-900 mt-2">{{ $totalCategories }}</div>
            <span class="text-[11px] text-slate-400">Surgical, ICU, Neonatal, etc.</span>
        </div>
    </div>

    <!-- Recent Inquiries Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Recent Quote & Information Requests</h3>
            <span class="text-xs text-slate-500">Latest 10 submissions</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Contact</th>
                        <th class="py-3 px-4">Organization / Country</th>
                        <th class="py-3 px-4">Type</th>
                        <th class="py-3 px-4">Equipment / Subject</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Received</th>
                        <th class="py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($recentInquiries as $inq)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-3 px-4 font-bold text-slate-900">#{{ $inq->id }}</td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-slate-900">{{ $inq->full_name }}</div>
                                <div class="text-slate-400">{{ $inq->email }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <div>{{ $inq->organization ?? 'N/A' }}</div>
                                <div class="text-slate-400">{{ $inq->country ?? 'N/A' }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $inq->inquiry_type === 'quote' ? 'bg-sky-100 text-sky-800' : 'bg-slate-100 text-slate-700' }}">
                                    {{ $inq->inquiry_type }}
                                </span>
                            </td>
                            <td class="py-3 px-4 max-w-xs truncate">
                                @if($inq->product)
                                    <span class="font-bold text-sky-700">{{ $inq->product->model_code }}</span> -
                                @endif
                                {{ $inq->subject ?? Str::limit($inq->message, 40) }}
                            </td>
                            <td class="py-3 px-4">
                                <form action="{{ route('admin.inquiries.status', $inq->id) }}" method="POST">
                                    @csrf
                                    <select name="status" onchange="this.form.submit()" class="text-xs py-1 px-2 rounded-lg border border-slate-200 bg-white font-medium">
                                        <option value="new" {{ $inq->status === 'new' ? 'selected' : '' }}>New</option>
                                        <option value="reviewed" {{ $inq->status === 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                                        <option value="contacted" {{ $inq->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                        <option value="closed" {{ $inq->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-3 px-4 text-slate-400">
                                {{ $inq->created_at->diffForHumans() }}
                            </td>
                            <td class="py-3 px-4">
                                <button type="button" onclick="alert(`Inquiry from {{ $inq->full_name }}:\n\n{{ addslashes($inq->message) }}`)" class="text-sky-600 hover:underline font-semibold">
                                    View Message
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-8 text-slate-400">No inquiries received yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

