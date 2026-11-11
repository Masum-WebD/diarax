@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Hospital Quotes & Inquiries</h1>
            <p class="text-xs text-slate-500 mt-1">Filter, examine, and update the status of incoming inquiries.</p>
        </div>
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.inquiries') }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ !request('status') ? 'bg-slate-900 text-white' : 'bg-white border text-slate-700' }}">All</a>
            <a href="{{ route('admin.inquiries', ['status' => 'new']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ request('status') === 'new' ? 'bg-amber-600 text-white' : 'bg-white border text-slate-700' }}">New</a>
            <a href="{{ route('admin.inquiries', ['status' => 'contacted']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ request('status') === 'contacted' ? 'bg-sky-600 text-white' : 'bg-white border text-slate-700' }}">Contacted</a>
            <a href="{{ route('admin.inquiries', ['status' => 'closed']) }}" class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ request('status') === 'closed' ? 'bg-emerald-600 text-white' : 'bg-white border text-slate-700' }}">Closed</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Contact Person</th>
                        <th class="py-3 px-4">Hospital / Country</th>
                        <th class="py-3 px-4">Inquiry Type</th>
                        <th class="py-3 px-4">Model / Subject</th>
                        <th class="py-3 px-4">Message</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($inquiries as $inq)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-3 px-4 font-bold text-slate-900">#{{ $inq->id }}</td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-slate-900">{{ $inq->full_name }}</div>
                                <div class="text-slate-400">{{ $inq->email }}</div>
                                @if($inq->phone)
                                    <div class="text-[11px] text-slate-500">{{ $inq->phone }}</div>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-semibold">{{ $inq->organization ?? 'Not specified' }}</div>
                                <div class="text-slate-400">{{ $inq->country ?? 'Global' }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $inq->inquiry_type === 'quote' ? 'bg-sky-100 text-sky-800' : 'bg-slate-100 text-slate-700' }}">
                                    {{ $inq->inquiry_type }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                @if($inq->product)
                                    <span class="font-bold text-sky-700 block">{{ $inq->product->model_code }}</span>
                                @endif
                                <span class="text-slate-600">{{ $inq->subject ?? 'General' }}</span>
                            </td>
                            <td class="py-3 px-4 max-w-sm">
                                <p class="line-clamp-3 text-slate-600 bg-slate-50 p-2 rounded-lg border border-slate-100">
                                    {{ $inq->message }}
                                </p>
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
                            <td class="py-3 px-4 text-slate-400 whitespace-nowrap">
                                {{ $inq->created_at->format('M d, Y H:i') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-10 text-slate-400">No inquiries found matching criteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $inquiries->links() }}
        </div>
    </div>
</div>
@endsection

