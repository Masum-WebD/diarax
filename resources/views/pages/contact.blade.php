@extends('layouts.app')

@section('title', 'Contact DIXION | Medical Headquarters Düsseldorf, Germany')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 via-slate-900 to-slate-950 text-white py-16 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-sky-400 bg-sky-500/10 px-3 py-1 rounded-full">Global Headquarters</span>
            <h1 class="font-heading text-3xl sm:text-5xl font-extrabold mt-3">
                Contact DIXION Medical Systems
            </h1>
            <p class="text-slate-300 text-sm sm:text-base mt-3 leading-relaxed">
                Connect directly with our headquarters in Düsseldorf for equipment quotes, technical service, dealer inquiries, or turnkey hospital engineering.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Contact Info & Address -->
        <div class="lg:col-span-5 space-y-8">
            <div>
                <h3 class="font-heading text-2xl font-bold text-slate-900 mb-2">
                    DIXION Vertrieb medizinischer Geräte GmbH
                </h3>
                <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">
                    Registered in Düsseldorf, Germany &bull; HRB 49952
                </p>
            </div>

            <div class="space-y-4 text-sm text-slate-600">
                <div class="flex items-start p-4 bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    </div>
                    <div>
                        <span class="font-bold text-slate-900 block text-xs uppercase tracking-wider">Corporate Address</span>
                        <span>Schiessstrasse 55<br>40549 Düsseldorf, Germany</span>
                    </div>
                </div>

                <div class="flex items-start p-4 bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <span class="font-bold text-slate-900 block text-xs uppercase tracking-wider">Direct Telephone</span>
                        <span>Phone: +49 (0) 211 445566<br>Fax: +49 (0) 211 445567</span>
                    </div>
                </div>

                <div class="flex items-start p-4 bg-white rounded-2xl border border-slate-200 shadow-sm">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center mr-4 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <span class="font-bold text-slate-900 block text-xs uppercase tracking-wider">Electronic Inquiries</span>
                        <span>Sales: export@dixion.de<br>General: info@dixion.de</span>
                    </div>
                </div>
            </div>

            <!-- Stylized Map Indicator -->
            <div class="p-6 bg-slate-900 text-white rounded-2xl border border-slate-800 relative overflow-hidden">
                <div class="relative z-10">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-sky-400">Headquarters Location</span>
                    <h4 class="font-heading font-bold text-base mt-1">Düsseldorf &bull; North Rhine-Westphalia</h4>
                    <p class="text-xs text-slate-400 mt-1">
                        Conveniently situated 10 minutes from Düsseldorf International Airport (DUS) and Messe Düsseldorf exhibition grounds.
                    </p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-xl">
                <h3 class="font-heading text-2xl font-bold text-slate-900 mb-2">Send Us a Direct Message</h3>
                <p class="text-xs text-slate-500 mb-6">Our multilingual team responds within one business day.</p>

                <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Full Name *</label>
                            <input type="text" name="full_name" required placeholder="Dr. / Mr. / Ms." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email Address *</label>
                            <input type="email" name="email" required placeholder="name@institution.com" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Phone</label>
                            <input type="text" name="phone" placeholder="+123..." class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Hospital / Entity</label>
                            <input type="text" name="organization" placeholder="Clinic / Company" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Country</label>
                            <input type="text" name="country" placeholder="e.g. Bangladesh" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Inquiry Purpose *</label>
                            <select name="inquiry_type" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none bg-white">
                                <option value="general">General Inquiries</option>
                                <option value="quote">Price Quotation & Datasheets</option>
                                <option value="tender">Hospital Tender Proposal</option>
                                <option value="partnership">Dealer / Distribution Partnership</option>
                                <option value="support">Service, Warranty & Parts</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Subject</label>
                            <input type="text" name="subject" placeholder="Summary of request" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Detailed Message *</label>
                        <textarea name="message" rows="5" required placeholder="How can DIXION support your clinical or commercial goals?" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-sky-500 text-sm outline-none"></textarea>
                    </div>

                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm tracking-wide shadow-md transition">
                        Dispatch Message to DIXION
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
