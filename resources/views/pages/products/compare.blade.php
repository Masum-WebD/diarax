@extends('layouts.app')

@section('title', 'Compare Medical Equipment Models | DIXION Medical Systems')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-slate-900 via-slate-900 to-sky-950 text-white py-14 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-sky-400 bg-sky-500/10 px-3 py-1 rounded-full">Model Evaluation Tool</span>
            <h1 class="font-heading text-3xl sm:text-4xl font-extrabold mt-3">
                Side-by-Side Equipment Comparison
            </h1>
            <p class="text-slate-300 text-sm mt-2">
                Evaluate technical parameters, clinical features, and hospital department compatibility across DIXION medical devices.
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Comparison Selector Form -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm mb-10">
        <h3 class="font-heading font-bold text-sm text-slate-900 uppercase tracking-wider mb-3">
            Select Models to Compare
        </h3>
        <form action="{{ route('products.compare') }}" method="GET" class="flex flex-col sm:flex-row gap-3 items-center">
            <div class="flex-grow grid grid-cols-1 sm:grid-cols-2 gap-3 w-full">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">First Model:</label>
                    <select id="model1" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-xs bg-white text-slate-800 outline-none">
                        @foreach($allProducts as $p)
                            <option value="{{ $p->id }}" {{ isset($selectedProducts[0]) && $selectedProducts[0]->id == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->model_code }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Second Model:</label>
                    <select id="model2" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-xs bg-white text-slate-800 outline-none">
                        @foreach($allProducts as $p)
                            <option value="{{ $p->id }}" {{ isset($selectedProducts[1]) && $selectedProducts[1]->id == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->model_code }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <input type="hidden" name="models" id="models-input" value="">

            <button type="button" onclick="submitComparison()" class="w-full sm:w-auto px-6 py-2.5 bg-sky-600 hover:bg-sky-700 text-white rounded-xl text-xs font-bold transition self-end">
                Compare Selected Models
            </button>
        </form>
    </div>

    @if($selectedProducts->isNotEmpty())
        <!-- Comparison Matrix Table -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs sm:text-sm">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="py-5 px-6 font-bold text-slate-500 uppercase tracking-wider text-xs w-1/4">
                                Parameter / Specification
                            </th>
                            @foreach($selectedProducts as $product)
                                <th class="py-5 px-6 font-bold text-slate-900 w-3/8 align-top">
                                    <div class="space-y-2">
                                        <div class="h-36 rounded-xl overflow-hidden bg-slate-100 border border-slate-200">
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        </div>
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-sky-600 block">
                                            {{ $product->category->name }}
                                        </span>
                                        <h3 class="font-heading font-bold text-base text-slate-900 leading-tight">
                                            {{ $product->name }}
                                        </h3>
                                        <div class="text-xs font-mono font-semibold text-slate-500">
                                            Model: {{ $product->model_code }}
                                        </div>
                                        <div class="pt-2 flex flex-wrap gap-2">
                                            <a href="{{ route('products.show', $product->slug) }}" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-xs font-semibold">
                                                Full Details
                                            </a>
                                            <a href="{{ route('quote', ['product_id' => $product->id]) }}" class="px-3 py-1.5 bg-sky-600 hover:bg-sky-700 text-white rounded-lg text-xs font-semibold">
                                                Quote
                                            </a>
                                        </div>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <!-- Tagline -->
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-4 px-6 font-bold text-slate-700 bg-slate-50/50">Product Focus</td>
                            @foreach($selectedProducts as $product)
                                <td class="py-4 px-6 text-slate-600 italic">
                                    {{ $product->tagline ?? 'Certified German Clinical System' }}
                                </td>
                            @endforeach
                        </tr>

                        <!-- Summary -->
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-4 px-6 font-bold text-slate-700 bg-slate-50/50">Clinical Description</td>
                            @foreach($selectedProducts as $product)
                                <td class="py-4 px-6 text-slate-600 leading-relaxed text-xs">
                                    {{ $product->short_description }}
                                </td>
                            @endforeach
                        </tr>

                        <!-- Key Features -->
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-4 px-6 font-bold text-slate-700 bg-slate-50/50">Primary Features</td>
                            @foreach($selectedProducts as $product)
                                <td class="py-4 px-6">
                                    @if($product->features)
                                        <ul class="space-y-1.5 text-xs text-slate-700">
                                            @foreach($product->features as $feat)
                                                <li class="flex items-start">
                                                    <span class="text-sky-600 font-bold mr-1.5">&bull;</span>
                                                    <span>{{ $feat }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-slate-400">N/A</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <!-- Technical Specs -->
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-4 px-6 font-bold text-slate-700 bg-slate-50/50">Technical Parameters</td>
                            @foreach($selectedProducts as $product)
                                <td class="py-4 px-6">
                                    @if($product->specifications)
                                        <table class="w-full text-xs">
                                            <tbody class="divide-y divide-slate-100">
                                                @foreach($product->specifications as $param => $val)
                                                    <tr>
                                                        <td class="py-1 text-slate-400 font-medium">{{ $param }}:</td>
                                                        <td class="py-1 text-slate-800 font-semibold text-right">{{ $val }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <span class="text-slate-400">N/A</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <!-- Applications -->
                        <tr class="hover:bg-slate-50/50">
                            <td class="py-4 px-6 font-bold text-slate-700 bg-slate-50/50">Departments</td>
                            @foreach($selectedProducts as $product)
                                <td class="py-4 px-6">
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($product->applications ?? [] as $app)
                                            <span class="px-2 py-0.5 bg-sky-50 text-sky-800 text-[11px] rounded font-medium">
                                                {{ $app }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                            @endforeach
                        </tr>

                        <!-- Datasheet Download Row -->
                        <tr class="bg-slate-50/70">
                            <td class="py-4 px-6 font-bold text-slate-700">Official Datasheet</td>
                            @foreach($selectedProducts as $product)
                                <td class="py-4 px-6">
                                    <a href="{{ route('products.datasheet', $product->slug) }}" target="_blank" class="inline-flex items-center text-xs font-bold text-sky-600 hover:text-sky-800">
                                        <svg class="w-4 h-4 mr-1 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        View Printable Datasheet &rarr;
                                    </a>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

<script>
function submitComparison() {
    const m1 = document.getElementById('model1').value;
    const m2 = document.getElementById('model2').value;
    const input = document.getElementById('models-input');
    input.value = `${m1},${m2}`;
    input.form.submit();
}
</script>
@endsection
