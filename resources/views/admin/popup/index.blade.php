@extends('layouts.admin')

@section('title', 'Welcome Popup Settings &bull; DIARAX Admin')
@section('page_title', 'Welcome Popup Announcement')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="font-heading text-xl font-bold text-slate-900">Website Welcome Popup</h2>
            <p class="text-xs text-slate-500">Configure greeting modal shown to visitors when entering the DIARAX portal</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center px-3.5 py-2 rounded-xl text-xs font-semibold text-blue-700 bg-blue-50 hover:bg-blue-100 transition">
            Preview on Public Site &rarr;
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left: Settings Form (7 cols) -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 p-6 sm:p-7 shadow-2xs">
            <form action="{{ route('admin.popup.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Enable / Disable Switch -->
                <div class="p-3.5 rounded-2xl bg-blue-50/70 border border-blue-200/80 flex items-center justify-between">
                    <div>
                        <div class="text-xs font-bold text-slate-900">Popup Display Status</div>
                        <div class="text-[11px] text-slate-600">Activate or deactivate welcome modal on website entrance</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $popup->is_active ? 'checked' : '' }} class="sr-only peer" onchange="updateLivePreview()">
                        <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Popup Title *</label>
                    <input 
                        type="text" 
                        id="popup_title_input" 
                        name="title" 
                        value="{{ old('title', $popup->title) }}" 
                        required 
                        placeholder="e.g. Welcome to DIARAX Medical Systems" 
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-medium"
                        oninput="updateLivePreview()"
                    >
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Badge Tagline</label>
                        <input 
                            type="text" 
                            id="popup_badge_input" 
                            name="badge" 
                            value="{{ old('badge', $popup->badge) }}" 
                            placeholder="e.g. South Korea Precision Tech" 
                            class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50"
                            oninput="updateLivePreview()"
                        >
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Button Text</label>
                        <input 
                            type="text" 
                            id="popup_btn_text_input" 
                            name="button_text" 
                            value="{{ old('button_text', $popup->button_text) }}" 
                            placeholder="e.g. Explore Equipment Catalog" 
                            class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50"
                            oninput="updateLivePreview()"
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Button Link URL</label>
                    <input 
                        type="text" 
                        name="button_link" 
                        value="{{ old('button_link', $popup->button_link) }}" 
                        placeholder="e.g. /products or /contact" 
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 font-mono"
                    >
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1">Welcome Message *</label>
                    <textarea 
                        id="popup_msg_input" 
                        name="message" 
                        rows="4" 
                        required 
                        placeholder="Detailed welcome message for hospital directors, clinical engineers, and visitors..." 
                        class="w-full px-3.5 py-2 text-xs rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-600 focus:outline-none bg-slate-50 leading-relaxed"
                        oninput="updateLivePreview()"
                    >{{ old('message', $popup->message) }}</textarea>
                </div>

                <!-- Image Selection: File Upload OR URL -->
                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-800">
                        Banner / Modal Cover Image
                    </label>

                    <div class="space-y-2 text-xs">
                        <div>
                            <span class="text-[11px] font-semibold text-slate-700 block mb-1">Option 1: Upload from Computer</span>
                            <input 
                                type="file" 
                                name="image_file" 
                                accept="image/*" 
                                onchange="previewPopupImageFile(this)"
                                class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            >
                        </div>
                        <div class="relative flex py-1 items-center">
                            <div class="flex-grow border-t border-slate-200"></div>
                            <span class="flex-shrink mx-2 text-[10px] text-slate-400 uppercase font-bold">OR</span>
                            <div class="flex-grow border-t border-slate-200"></div>
                        </div>
                        <div>
                            <span class="text-[11px] font-semibold text-slate-700 block mb-1">Option 2: Image Web URL</span>
                            <input 
                                type="url" 
                                id="popup_img_url_input" 
                                name="image_url" 
                                value="{{ old('image_url', $popup->image && str_starts_with($popup->image, 'http') ? $popup->image : '') }}" 
                                placeholder="https://images.unsplash.com/..." 
                                oninput="previewPopupImageUrl(this.value)"
                                class="w-full px-3 py-1.5 text-xs rounded-lg border border-slate-300 focus:ring-1 focus:ring-blue-600 focus:outline-none font-mono"
                            >
                        </div>
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" class="w-full px-5 py-2.5 rounded-xl font-bold text-xs bg-blue-700 hover:bg-blue-800 text-white shadow-xs transition">
                        Save Welcome Announcement
                    </button>
                </div>
            </form>
        </div>

        <!-- Right: Live Visual Preview (5 cols) -->
        <div class="lg:col-span-5 space-y-3 sticky top-4">
            <div class="flex items-center justify-between text-xs text-slate-500 font-bold uppercase tracking-wider">
                <span>Visitor Visual Preview</span>
                <span class="text-[10px] font-mono text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                    Live Rendering
                </span>
            </div>

            <div class="bg-slate-900/60 p-4 rounded-3xl backdrop-blur-xs border border-slate-300/40 shadow-xl">
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 text-xs">
                    <!-- Preview Image -->
                    <div id="preview_img_wrapper" class="relative h-36 bg-slate-100 overflow-hidden {{ $popup->image ? '' : 'hidden' }}">
                        <img id="preview_img" src="{{ $popup->image ?: '' }}" alt="Preview" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/20 to-transparent"></div>
                        <div class="absolute top-2.5 left-2.5">
                            <span id="preview_badge" class="px-2.5 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider bg-white/95 text-blue-700 backdrop-blur-xs shadow-2xs">
                                {{ $popup->badge ?: 'South Korea Precision' }}
                            </span>
                        </div>
                        <span class="absolute top-2.5 right-2.5 w-6 h-6 rounded-full bg-black/40 text-white flex items-center justify-center text-[10px]">✕</span>
                    </div>

                    <div class="p-4 space-y-3">
                        <h4 id="preview_title" class="font-heading text-sm font-bold text-slate-900 leading-snug">
                            {{ $popup->title ?: 'Welcome to DIARAX Medical Systems' }}
                        </h4>
                        <p id="preview_msg" class="text-[11px] text-slate-600 leading-relaxed line-clamp-4">
                            {{ $popup->message ?: 'Welcome message will display here...' }}
                        </p>
                        <div class="pt-1 flex items-center gap-2">
                            <span id="preview_btn" class="flex-1 text-center py-2 px-3 rounded-lg font-bold text-[11px] bg-blue-700 text-white shadow-2xs">
                                {{ $popup->button_text ?: 'Explore Products' }} &rarr;
                            </span>
                            <span class="py-2 px-3 rounded-lg font-semibold text-[11px] text-slate-600 bg-slate-100">
                                Close
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function updateLivePreview() {
        const title = document.getElementById('popup_title_input').value;
        const badge = document.getElementById('popup_badge_input').value;
        const msg = document.getElementById('popup_msg_input').value;
        const btnText = document.getElementById('popup_btn_text_input').value;

        if (document.getElementById('preview_title')) {
            document.getElementById('preview_title').textContent = title || 'Welcome to DIARAX Medical Systems';
        }
        if (document.getElementById('preview_badge')) {
            document.getElementById('preview_badge').textContent = badge || 'Precision Medical Tech';
        }
        if (document.getElementById('preview_msg')) {
            document.getElementById('preview_msg').textContent = msg || 'Welcome message content...';
        }
        if (document.getElementById('preview_btn')) {
            document.getElementById('preview_btn').textContent = (btnText || 'Explore Products') + ' \u2192';
        }
    }

    function previewPopupImageUrl(url) {
        const img = document.getElementById('preview_img');
        const wrapper = document.getElementById('preview_img_wrapper');
        if (url && url.length > 5) {
            img.src = url;
            wrapper.classList.remove('hidden');
        }
    }

    function previewPopupImageFile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('preview_img');
                const wrapper = document.getElementById('preview_img_wrapper');
                img.src = e.target.result;
                wrapper.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
