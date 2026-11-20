@extends('layouts.app')

@section('title', 'Contact DIARAX | Headquarters Seoul, South Korea')

@section('content')
<!-- Header (White Theme) -->
<div class="bg-gradient-to-b from-slate-50 to-white text-slate-900 py-12 border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-700 bg-blue-100 px-3 py-1 rounded-full">Global Headquarters</span>
            <h1 class="font-heading text-2xl sm:text-4xl font-extrabold mt-2 text-slate-900">
                Contact DIARAX Ltd
            </h1>
            <p class="text-slate-600 text-xs sm:text-sm mt-1.5 leading-relaxed">
                Connect directly with our headquarters in Seoul, South Korea for medical device quotations, technical support, authorized distributorships, or turnkey hospital equipping.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Contact Info & Address -->
        <div class="lg:col-span-5 space-y-6">
            <div>
                <h3 class="font-heading text-xl font-bold text-slate-900 mb-1">
                    DIARAX Ltd
                </h3>
                <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">
                    Global Corporate Headquarters &bull; Seoul, South Korea
                </p>
            </div>

            <div class="space-y-3 text-xs text-slate-600">
                <div class="flex items-start p-3.5 bg-slate-50 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mr-3.5 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    </div>
                    <div>
                        <span class="font-bold text-slate-900 block uppercase tracking-wider text-[11px]">Headquarters Address</span>
                        <span>288, Dapsimni-ro, Dongdaemun-gu,<br>Seoul, Korea.</span>
                        <span class="block text-slate-500 mt-1 font-medium">Tel: +82-2-5382561, E-mail: info.diarax@gmail.com</span>
                    </div>
                </div>

                <div class="flex items-start p-3.5 bg-slate-50 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mr-3.5 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <span class="font-bold text-slate-900 block uppercase tracking-wider text-[11px]">Telephone Phone</span>
                        <span>Telephone Phone: +82-2-5382561<br>Customer Service: +82-2-5382561</span>
                    </div>
                </div>

                <div class="flex items-start p-3.5 bg-slate-50 rounded-2xl border border-slate-200 shadow-xs">
                    <div class="w-9 h-9 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center mr-3.5 flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <span class="font-bold text-slate-900 block uppercase tracking-wider text-[11px]">Electronic Inquiries</span>
                        <span>E-mail: info.diarax@gmail.com<br>International Sales: export@diarax.com</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:col-span-7">
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <h3 class="font-heading text-xl font-bold text-slate-900 mb-1">Send Us a Direct Message</h3>
                <p class="text-xs text-slate-500 mb-5">Our international team responds within one business day.</p>

                <form action="{{ route('inquiries.store') }}" method="POST" class="space-y-3.5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Full Name *</label>
                            <input type="text" name="full_name" required placeholder="Dr. / Mr. / Ms." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Email Address *</label>
                            <input type="email" name="email" required placeholder="name@institution.com" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Phone</label>
                            <input type="text" name="phone" placeholder="+82..." class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Hospital / Entity</label>
                            <input type="text" name="organization" placeholder="Clinic / Company" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Country</label>
                            <input type="text" name="country" placeholder="e.g. South Korea" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Inquiry Purpose *</label>
                            <select name="inquiry_type" required class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none bg-white">
                                <option value="general">General Inquiries</option>
                                <option value="quote">Price Quotation & Datasheets</option>
                                <option value="tender">Hospital Tender Proposal</option>
                                <option value="partnership">Dealer / Distribution Partnership</option>
                                <option value="support">Service, Warranty & Parts</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Subject</label>
                            <input type="text" name="subject" placeholder="Summary of request" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Detailed Message *</label>
                        <textarea name="message" rows="4" required placeholder="How can DIARAX support your clinical or commercial goals?" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 text-xs outline-none"></textarea>
                    </div>

                    <button type="submit" class="w-full sm:w-auto px-7 py-2.5 rounded-xl bg-blue-700 hover:bg-blue-800 text-white font-bold text-xs tracking-wide shadow-xs transition">
                        Dispatch Message to DIARAX
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
