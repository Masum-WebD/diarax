@extends('layouts.admin')

@section('title', 'Equipment Sales & Orders &bull; DIARAX Admin')
@section('page_title', 'Sales')

@section('content')
<div class="space-y-6">

    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
        <div>
            <h2 class="font-heading text-lg sm:text-xl font-bold text-slate-900">
                Hospital Equipment Orders & Sales Invoices
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Track global hospital procurement contracts, export shipments, and payment clearance.
            </p>
        </div>

        <button 
            type="button" 
            onclick="document.getElementById('new-sale-modal').classList.remove('hidden')"
            class="px-4 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-2xs transition flex items-center space-x-1.5 self-start sm:self-auto"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>New Equipment Sale</span>
        </button>
    </div>

    <!-- 4 KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Sales Value</span>
            <div class="text-2xl font-bold font-heading text-slate-900 mt-1">${{ number_format($totalSalesAmount) }}</div>
            <span class="text-[11px] text-emerald-600 font-semibold">+18.5% compared to Q3</span>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Cleared Payments</span>
            <div class="text-2xl font-bold font-heading text-emerald-700 mt-1">{{ $paidCount }} Paid Invoices</div>
            <span class="text-[11px] text-slate-500">Bank L/C & Wire Transfer</span>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600">Hospital Deliveries</span>
            <div class="text-2xl font-bold font-heading text-blue-700 mt-1">{{ $deliveredCount }} Installed</div>
            <span class="text-[11px] text-slate-500">Verified by biomedical engineers</span>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Export Markets</span>
            <div class="text-2xl font-bold font-heading text-slate-900 mt-1">6 Active Nations</div>
            <span class="text-[11px] text-slate-500">Korea, Thailand, BD, PH, Saudi</span>
        </div>

    </div>

    <!-- Sales Invoices Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Commercial Equipment Invoices</h3>
            <span class="text-xs text-slate-500">Official hospital sales contracts & export clearance</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider text-[10px] border-b border-slate-100">
                    <tr>
                        <th class="py-3 px-4">Invoice #</th>
                        <th class="py-3 px-4">Client Hospital</th>
                        <th class="py-3 px-4">Department & Destination</th>
                        <th class="py-3 px-4">Equipment Summary</th>
                        <th class="py-3 px-4">Total Amount</th>
                        <th class="py-3 px-4">Payment</th>
                        <th class="py-3 px-4">Fulfillment</th>
                        <th class="py-3 px-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @foreach($sales as $sale)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3 px-4 font-mono font-bold text-blue-700">
                                {{ $sale['invoice_no'] }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-slate-900">{{ $sale['client_hospital'] }}</div>
                                <div class="text-[11px] text-slate-400">Date: {{ $sale['invoice_date'] }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-slate-800 font-medium">{{ $sale['department'] }}</div>
                                <div class="text-[11px] text-slate-400">{{ $sale['destination'] }}</div>
                            </td>
                            <td class="py-3 px-4 max-w-xs text-slate-600">
                                {{ $sale['equipment_details'] }}
                            </td>
                            <td class="py-3 px-4 font-bold text-slate-900">
                                ${{ number_format($sale['total_amount']) }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $sale['payment_status'] === 'Paid' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($sale['payment_status'] === 'Partial' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                                    {{ $sale['payment_status'] }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $sale['fulfillment_status'] === 'Delivered' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($sale['fulfillment_status'] === 'In Transit' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-slate-100 text-slate-700') }}">
                                    {{ $sale['fulfillment_status'] }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <button type="button" onclick="alert('Commercial Invoice {{ $sale['invoice_no'] }} generated with MFDS export stamp.')" class="px-2.5 py-1 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 font-semibold text-[11px]">
                                    Invoice
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal: New Sale Order / Invoice -->
<div id="new-sale-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-in fade-in duration-200">
        
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="font-heading text-lg font-bold text-slate-900">Create New Equipment Sale</h3>
                <p class="text-xs text-slate-500">Issue commercial invoice to hospital or medical distributor</p>
            </div>
            <button type="button" onclick="document.getElementById('new-sale-modal').classList.add('hidden')" class="p-1 rounded-lg text-slate-400 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.sales.store') }}" method="POST" class="mt-4 space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Hospital / Client Name *</label>
                    <input type="text" name="client_hospital" required placeholder="e.g. Asan Medical Center" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Total Sale Amount ($ USD) *</label>
                    <input type="number" name="total_amount" required placeholder="e.g. 48000" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Equipment Models & Quantities *</label>
                <textarea name="equipment_details" rows="2" required placeholder="e.g. 2x DIARAX Operamed 3000 Operating Table, 2x Convelar 1675 Surgical Lights..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Payment Status</label>
                    <select name="payment_status" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        <option value="Paid">Paid</option>
                        <option value="Partial">Partial</option>
                        <option value="Due">Due</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Fulfillment Status</label>
                    <select name="fulfillment_status" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        <option value="Delivered">Delivered</option>
                        <option value="In Transit">In Transit</option>
                        <option value="Processing">Processing</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-2 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('new-sale-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold transition shadow-xs">
                    Generate Commercial Sale
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

