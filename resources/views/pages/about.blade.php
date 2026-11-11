@extends('layouts.app')

@section('title', 'About DIXION | German Medical Technology & Healthcare Partner')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 via-slate-900 to-slate-950 text-white py-16 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-sky-400 bg-sky-500/10 px-3 py-1 rounded-full">Corporate Profile</span>
            <h1 class="font-heading text-3xl sm:text-5xl font-extrabold mt-3">
                About DIXION Healthcare Systems
            </h1>
            <p class="text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                Founded in Düsseldorf, Germany, DIXION Vertrieb medizinischer Geräte GmbH is an internationally recognized medical equipment manufacturer and healthcare engineering provider.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-20">
        <div class="lg:col-span-6 space-y-6">
            <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">Our Story & Mission</span>
            <h2 class="font-heading text-3xl font-extrabold text-slate-900">
                Pioneering Precision Medical Engineering for Over Two Decades
            </h2>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                Since 2004, DIXION has established itself as an innovative partner for hospitals, ministries of health, and specialized clinics across Europe, Asia, Latin America, and the Middle East.
            </p>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                Our portfolio encompasses over 40 distinct groups of medical technology comprising more than 250 equipment models under a unified corporate trademark. By controlling the complete lifecycle—from biomedical research and mechanical drafting to cleanroom production and global logistics—we guarantee European clinical excellence at competitive ownership costs.
            </p>

            <div class="grid grid-cols-2 gap-4 pt-2">
                <div class="p-4 rounded-2xl bg-white border border-slate-200">
                    <span class="font-heading text-2xl font-bold text-sky-600">Düsseldorf</span>
                    <p class="text-xs text-slate-500 mt-1">Headquarters, Engineering & Logistics Hub</p>
                </div>
                <div class="p-4 rounded-2xl bg-white border border-slate-200">
                    <span class="font-heading text-2xl font-bold text-slate-900">80+ Nations</span>
                    <p class="text-xs text-slate-500 mt-1">Certified Distributor & Partner Network</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-6">
            <div class="rounded-3xl overflow-hidden shadow-2xl border border-slate-200">
                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1000&q=80" alt="Hospital medical systems" class="w-full h-96 object-cover">
            </div>
        </div>
    </div>

    <!-- Quality Standards Anchor -->
    <div id="quality" class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-sm mb-20">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-sky-600 bg-sky-50 px-3 py-1 rounded-full">Compliance & Safety</span>
            <h3 class="font-heading text-2xl sm:text-3xl font-bold text-slate-900 mt-2">
                European Regulatory Compliance
            </h3>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Zero compromises on clinical safety and patient outcomes.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-sky-600 text-white flex items-center justify-center font-bold text-sm mb-4">
                    ISO
                </div>
                <h4 class="font-heading font-bold text-slate-900 mb-2">EN ISO 13485:2016</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Certified Medical Devices Quality Management System guaranteeing traceability, process control, and risk management at every stage.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-sm mb-4">
                    MDR
                </div>
                <h4 class="font-heading font-bold text-slate-900 mb-2">EU MDR 2017/745</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Compliant with the European Union's latest and most rigorous Medical Device Regulations, ensuring clinical benefit and patient protection.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center font-bold text-sm mb-4">
                    CE
                </div>
                <h4 class="font-heading font-bold text-slate-900 mb-2">CE 0123 Marking</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Verified by European Notified Bodies (such as TÜV SÜD) confirming electromagnetic compatibility (EMC) and electrical safety.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
