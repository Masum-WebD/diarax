@extends('layouts.app')

@section('title', 'Service & Support | DIARAX South Korea')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-b from-slate-50 to-white text-slate-900 py-12 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Customer Care & Engineering</span>
            <h1 class="font-heading text-2xl sm:text-4xl font-extrabold mt-2 text-slate-900">
                Service & Technical Support
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-1.5 leading-relaxed">
                Dedicated biomedical engineer training, original South Korean spare parts supply, preventive maintenance, and remote telemedicine technical assistance.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Service Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-xs hover:border-blue-300 transition">
            <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="font-heading font-bold text-slate-900 text-base mb-2">Original Spare Parts</h3>
            <p class="text-xs text-slate-500 leading-relaxed">
                Direct dispatch of OEM certified replacement modules, hydraulic actuators, sensors, and optical assemblies from Seoul headquarters warehouse.
            </p>
        </div>

        <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-xs hover:border-blue-300 transition">
            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-lg mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <h3 class="font-heading font-bold text-slate-900 text-base mb-2">Biomedical Engineer Training</h3>
            <p class="text-xs text-slate-500 leading-relaxed">
                Certification courses for hospital clinical engineers and regional distributor technicians covering calibration and preventive maintenance.
            </p>
        </div>

        <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-xs hover:border-blue-300 transition">
            <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-lg mb-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <h3 class="font-heading font-bold text-slate-900 text-base mb-2">24/7 Global Help Desk</h3>
            <p class="text-xs text-slate-500 leading-relaxed">
                Rapid diagnosis and software update assistance for all operating room tables, ICU monitors, and digital radiography systems.
            </p>
        </div>
    </div>

    <!-- Contact Support Direct Form -->
    <div class="bg-slate-50 rounded-3xl p-6 sm:p-10 border border-slate-200">
        <div class="max-w-xl mx-auto text-center mb-6">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Support Ticket</span>
            <h2 class="font-heading text-xl font-bold text-slate-900 mt-2">Submit a Service or Parts Request</h2>
            <p class="text-xs text-slate-500 mt-1">Our biomedical technical team in Seoul will review and respond promptly.</p>
        </div>

        <div class="max-w-2xl mx-auto">
            <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-3.5">
                @csrf
                <input type="hidden" name="inquiry_type" value="support">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Your Name *</label>
                        <input type="text" name="full_name" required placeholder="Dr. / Engineer Name" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-xs focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Email Address *</label>
                        <input type="email" name="email" required placeholder="contact@hospital.org" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-xs focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Hospital / Clinic</label>
                        <input type="text" name="organization" placeholder="Hospital Name" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-xs focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Serial Number / Model Code</label>
                        <input type="text" name="subject" placeholder="e.g. Operamed 3000 SN: DX-2026-09" class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-xs focus:ring-2 focus:ring-blue-600 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Describe Service / Support Issue *</label>
                    <textarea name="message" rows="3" required placeholder="Describe technical problem or required spare parts..." class="w-full px-3.5 py-2 rounded-xl bg-white border border-slate-300 text-xs focus:ring-2 focus:ring-blue-600 outline-none"></textarea>
                </div>

                <div class="text-center pt-2">
                    <button type="submit" class="px-7 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs tracking-wide shadow-xs transition">
                        Dispatch Support Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
