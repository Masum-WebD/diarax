@extends('layouts.app')

@section('title', 'About DIARAX | South Korean Medical Technology & Global Healthcare')

@section('content')
<!-- Header (Clean White Theme with subtle border) -->
<div class="bg-gradient-to-b from-slate-50 to-white text-slate-900 py-12 lg:py-16 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Corporate Profile</span>
            <h1 class="font-heading text-3xl sm:text-4xl lg:text-5xl font-extrabold mt-3 text-slate-900 leading-tight">
                About DIARAX Medical Systems &bull; South Korea
            </h1>
            <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                Headquartered in Seoul, South Korea, DIARAX is an internationally acclaimed medical equipment manufacturer and healthcare engineering provider delivering smart clinical devices to over 80 countries worldwide.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
    <!-- Story & Mission Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center mb-16">
        <div class="lg:col-span-6 space-y-5">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-50 px-3 py-1 rounded-full">Our Heritage</span>
            <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-slate-900">
                Pioneering South Korean Medical Precision for Over Two Decades
            </h2>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                Founded in Seoul, South Korea, DIARAX has developed from an engineering research laboratory into a comprehensive international medical technology manufacturer. Our products power operating rooms, intensive care units, and diagnostic imaging centers across hospitals and universities globally.
            </p>
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                South Korea is renowned for its world-leading electronics, semiconductor, and biomedical engineering capabilities. DIARAX leverages this cutting-edge technological ecosystem to create durable, whisper-quiet electro-hydraulic operating tables, intelligent lung-protective anesthesia workstations, and multi-parameter critical care monitors that meet the strictest international clinical standards.
            </p>

            <div class="grid grid-cols-2 gap-4 pt-2">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-heading text-xl font-bold text-blue-700">Seoul, South Korea</span>
                    <p class="text-xs text-slate-500 mt-0.5">Corporate HQ & R&D Center (Gangnam-gu)</p>
                </div>
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <span class="font-heading text-xl font-bold text-slate-900">80+ Nations</span>
                    <p class="text-xs text-slate-500 mt-0.5">Global Partner & Distributor Network</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-6">
            <div class="rounded-3xl overflow-hidden shadow-lg border border-slate-200">
                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1000&q=80" alt="Hospital medical systems" class="w-full h-80 sm:h-96 object-cover">
            </div>
        </div>
    </div>

    <!-- Core Pillars / Values -->
    <div class="mb-16">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-50 px-3 py-1 rounded-full">Core Principles</span>
            <h3 class="font-heading text-2xl font-bold text-slate-900 mt-2">
                Why Healthcare Providers Choose DIARAX
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-blue-300 transition">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg mb-4">
                    1
                </div>
                <h4 class="font-heading font-bold text-slate-900 mb-2">High-Precision Robotics</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Integration of ultra-stable hydraulic mechanisms, low-friction micro-actuators, and smooth pneumatic positioning designed to support surgeons in complex procedures.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-blue-300 transition">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-lg mb-4">
                    2
                </div>
                <h4 class="font-heading font-bold text-slate-900 mb-2">Clinical Reliability</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Designed for 24/7 continuous operation in intensive care units, emergency departments, and high-frequency surgical suites with automated self-diagnostic routines.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs hover:border-blue-300 transition">
                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-lg mb-4">
                    3
                </div>
                <h4 class="font-heading font-bold text-slate-900 mb-2">Global Turnkey Support</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    From room layout CAD blueprints to on-site assembly, biomedical engineer training, and long-term certified spare parts availability across every continent.
                </p>
            </div>
        </div>
    </div>

    <!-- Quality Standards & Regulatory Compliance (White Theme) -->
    <div id="quality" class="bg-slate-50 rounded-3xl p-8 sm:p-12 border border-slate-200">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Quality Accreditations</span>
            <h3 class="font-heading text-2xl font-bold text-slate-900 mt-2">
                International Quality Certifications
            </h3>
            <p class="text-xs text-slate-500 mt-1">
                Zero compromises on clinical safety, biocompatibility, and precision.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs">
                <div class="w-9 h-9 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs mb-3">
                    ISO
                </div>
                <h4 class="font-heading font-bold text-slate-900 mb-1.5 text-sm">EN ISO 13485:2016</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Internationally accredited Medical Device Quality Management System covering biomedical development, sterile assembly, and traceability.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs">
                <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-xs mb-3">
                    MFDS
                </div>
                <h4 class="font-heading font-bold text-slate-900 mb-1.5 text-sm">Korea MFDS Certified</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Fully certified by the Ministry of Food and Drug Safety of South Korea for clinical grade hospital instruments.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-xs">
                <div class="w-9 h-9 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-xs mb-3">
                    CE
                </div>
                <h4 class="font-heading font-bold text-slate-900 mb-1.5 text-sm">CE 0123 / EU MDR</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    European Union Notified Body audit verification guaranteeing full electromagnetic shielding, patient safety, and clinical durability.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
