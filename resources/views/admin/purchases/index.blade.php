@extends('layouts.admin')

@section('title', 'Procurement & Purchases &bull; DIARAX Admin')
@section('page_title', 'Purchases')

@section('content')
<div class="space-y-6">

    <!-- Header Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-2xs">
        <div>
            <h2 class="font-heading text-lg sm:text-xl font-bold text-slate-900">
                Supply Chain & Component Procurement
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                Manage factory purchase orders, hydraulic actuators, sensors, and surgical components from South Korean suppliers.
            </p>
        </div>

        <button 
            type="button" 
            onclick="document.getElementById('new-purchase-modal').classList.remove('hidden')"
            class="px-4 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs shadow-2xs transition flex items-center space-x-1.5 self-start sm:self-auto"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>New Purchase Order</span>
        </button>
    </div>

    <!-- 4 KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Procurement</span>
            <div class="text-2xl font-bold font-heading text-slate-900 mt-1">${{ number_format($totalPurchasesAmount) }}</div>
            <span class="text-[11px] text-slate-500">Current Q4 Fiscal Cycle</span>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Received & Inspected</span>
            <div class="text-2xl font-bold font-heading text-emerald-700 mt-1">{{ $receivedCount }} Completed</div>
            <span class="text-[11px] text-slate-500">Stocked at Seoul Factory</span>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600">Active Shipments</span>
            <div class="text-2xl font-bold font-heading text-blue-700 mt-1">{{ $transitCount }} In Transit</div>
            <span class="text-[11px] text-slate-500">Expected within 7 days</span>
        </div>

        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-2xs">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Domestic Suppliers</span>
            <div class="text-2xl font-bold font-heading text-slate-900 mt-1">12 Industrial Partners</div>
            <span class="text-[11px] text-slate-500">Seoul, Daegu, Busan & Incheon</span>
        </div>

    </div>

    <!-- Purchases Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-2xs overflow-hidden">
        <div class="p-4 sm:p-5 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900 text-sm">Purchase Orders Log</h3>
            <span class="text-xs text-slate-500">Real-time status of component consignments</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider text-[10px] border-b border-slate-100">
                    <tr>
                        <th class="py-3 px-4">PO Number</th>
                        <th class="py-3 px-4">Supplier Partner</th>
                        <th class="py-3 px-4">Items / Components</th>
                        <th class="py-3 px-4">Total Amount</th>
                        <th class="py-3 px-4">Payment</th>
                        <th class="py-3 px-4">Delivery</th>
                        <th class="py-3 px-4">Timeline</th>
                        <th class="py-3 px-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @foreach($purchases as $po)
                        <tr class="hover:bg-slate-50/70 transition">
                            <td class="py-3 px-4 font-mono font-bold text-blue-700">
                                {{ $po['po_number'] }}
                            </td>
                            <td class="py-3 px-4">
                                <div class="font-bold text-slate-900">{{ $po['supplier'] }}</div>
                                <div class="text-[11px] text-slate-400">{{ $po['contact'] }}</div>
                            </td>
                            <td class="py-3 px-4 max-w-xs">
                                <span class="text-slate-800 font-medium block">{{ $po['items'] }}</span>
                                <span class="text-[10px] text-slate-400 uppercase tracking-wider">{{ $po['category'] }}</span>
                            </td>
                            <td class="py-3 px-4 font-bold text-slate-900">
                                ${{ number_format($po['total_amount']) }}
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $po['payment_status'] === 'Paid' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($po['payment_status'] === 'Partial' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                                    {{ $po['payment_status'] }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $po['delivery_status'] === 'Received' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : ($po['delivery_status'] === 'In Transit' ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'bg-slate-100 text-slate-700') }}">
                                    {{ $po['delivery_status'] }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-[11px] text-slate-500">
                                <div>Ordered: {{ $po['order_date'] }}</div>
                                <div class="text-slate-400">Due: {{ $po['delivery_date'] }}</div>
                            </td>
                            <td class="py-3 px-4 text-right">
                                <button type="button" onclick="alert('Purchase Order {{ $po['po_number'] }} details ready to print.')" class="px-2.5 py-1 rounded-lg border border-slate-200 hover:bg-slate-100 text-slate-600 font-semibold text-[11px]">
                                    PO Sheet
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal: New Purchase Order -->
<div id="new-purchase-modal" class="fixed inset-0 z-50 bg-slate-950/60 backdrop-blur-xs hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 relative animate-in fade-in duration-200">
        
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="font-heading text-lg font-bold text-slate-900">Create Purchase Order</h3>
                <p class="text-xs text-slate-500">Procure medical parts & materials from certified suppliers</p>
            </div>
            <button type="button" onclick="document.getElementById('new-purchase-modal').classList.add('hidden')" class="p-1 rounded-lg text-slate-400 hover:text-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.purchases.store') }}" method="POST" class="mt-4 space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Supplier Name *</label>
                    <input type="text" name="supplier" required placeholder="e.g. Seoul Precision Hydraulics" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Total Amount ($ USD) *</label>
                    <input type="number" name="total_amount" required placeholder="e.g. 15000" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Items / Specifications *</label>
                <textarea name="items" rows="2" required placeholder="Specify component types, models, serial requirements, and delivery address..." class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Payment Status</label>
                    <select name="payment_status" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        <option value="Paid">Paid</option>
                        <option value="Partial">Partial</option>
                        <option value="Unpaid">Unpaid</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Delivery Status</label>
                    <select name="delivery_status" class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50">
                        <option value="Ordered">Ordered</option>
                        <option value="In Transit">In Transit</option>
                        <option value="Received">Received</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end space-x-2 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('new-purchase-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-100">
                    Cancel
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-700 hover:bg-blue-800 text-white text-xs font-bold transition shadow-xs">
                    Register Purchase Order
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

