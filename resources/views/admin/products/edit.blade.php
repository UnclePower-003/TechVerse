@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                <i class="fas fa-edit mr-2 text-primary"></i> Edit Product
            </h1>
            <p class="text-sm text-gray-500 mt-1">Update the details and technical specifications for <span class="font-bold text-gray-700">"{{ $product->title }}"</span></p>
        </div>

        <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-primary transition-colors group">
            <i class="fas fa-arrow-left mr-2 text-xs transition-transform group-hover:-translate-x-1"></i> Back to Products
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        {{-- Decorative top bar --}}
        <div class="h-2 bg-primary w-full"></div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="m-8 mb-0 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 shadow-sm">
                <div class="flex items-center mb-1">
                    <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                    <span class="text-sm font-bold uppercase tracking-wide">Please correct the following:</span>
                </div>
                <ul class="list-disc list-inside text-sm ml-6 opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Category Select --}}
                <div class="col-span-1 space-y-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all p-3.5 text-sm outline-none">
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Model Input --}}
                <div class="col-span-1 space-y-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest">
                        Model <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="model" value="{{ old('model', $product->model) }}" 
                           class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all p-3.5 text-sm outline-none">
                </div>

                {{-- Title Input --}}
                <div class="col-span-1 md:col-span-2 space-y-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest">
                        Product Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $product->title) }}" 
                           class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all p-3.5 text-sm outline-none">
                </div>

                {{-- Price Input --}}
                <div class="col-span-1 space-y-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest">
                        Price <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 font-bold">
                            $
                        </div>
                        <input type="text" name="price" value="{{ old('price', $product->price) }}" 
                               class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all pl-10 p-3.5 text-sm outline-none">
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- Image Section --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-1">
                    <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-widest">Product Image</label>
                    <p class="text-xs text-gray-400 mb-4 italic">Recommended: 800x800px PNG/JPG.</p>
                    
                    @if ($product->image)
                        <div class="relative w-40 h-40 group">
                            <img src="{{ asset($product->image) }}" class="w-full h-full object-cover rounded-2xl border border-gray-200 shadow-md">
                            <div class="absolute inset-0 bg-primary/60 rounded-2xl opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <span class="text-white text-[10px] font-bold uppercase tracking-widest">Current Image</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="md:col-span-2 flex items-center">
                    <div class="w-full">
                        <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-bold file:uppercase file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition cursor-pointer">
                    </div>
                </div>
            </div>

            {{-- Badge Logic --}}
            <div class="bg-gray-50/80 p-6 rounded-2xl border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest">Badge Text</label>
                    <input type="text" name="badge_text" value="{{ old('badge_text', $product->badge_text) }}" 
                           placeholder="e.g. New Arrival" class="w-full rounded-xl border-gray-200 bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 p-3.5 text-sm transition-all outline-none">
                </div>
                <div class="space-y-2">
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest">Badge Color (Tailwind)</label>
                    <input type="text" name="badge_color" value="{{ old('badge_color', $product->badge_color) }}" 
                           placeholder="bg-emerald-500" class="w-full rounded-xl border-gray-200 bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 p-3.5 text-sm transition-all outline-none">
                </div>
            </div>

            {{-- Specifications --}}
            <div class="space-y-4">
                <label class="block text-xs font-bold text-gray-700 uppercase tracking-widest">Specifications</label>
                <div id="specs-wrapper" class="space-y-3">
                    @forelse (old('specs', $product->specs ?? []) as $index => $spec)
                        <div class="flex gap-3 group animate-in fade-in duration-300">
                            <div class="relative w-1/3">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-microchip text-xs"></i>
                                </div>
                                <input name="specs[{{ $index }}][icon]" value="{{ $spec['icon'] ?? '' }}" 
                                       placeholder="Icon (fa-cpu)" class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 p-3.5 pl-10 text-sm transition-all outline-none">
                            </div>
                            <input name="specs[{{ $index }}][text]" value="{{ $spec['text'] ?? '' }}" 
                                   placeholder="Feature description" class="w-2/3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 p-3.5 text-sm transition-all outline-none">
                            <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-red-500 transition px-2">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 italic mb-2">No specifications added yet.</p>
                    @endforelse
                </div>

                <button type="button" onclick="addSpec()" class="inline-flex items-center text-xs font-bold uppercase tracking-widest text-primary hover:bg-primary hover:text-white bg-white px-5 py-3 rounded-xl transition-all border border-gray-200 shadow-sm active:scale-95">
                    <i class="fas fa-plus mr-2"></i> Add Specification
                </button>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-4 pt-8 border-t border-gray-100">
                <a href="{{ route('products.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-500 hover:bg-gray-100 transition">
                    Discard Changes
                </a>
                <button type="submit" class="flex items-center space-x-2 bg-primary text-white px-10 py-3.5 rounded-xl font-bold transition-all hover:bg-[#266eb1] shadow-lg shadow-indigo-100 focus:ring-4 focus:ring-primary/20 active:scale-95">
                    <i class="fas fa-save text-sm"></i>
                    <span>Save Product</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let specIndex = {{ count(old('specs', $product->specs ?? [])) }};

    function addSpec() {
        const wrapper = document.getElementById('specs-wrapper');
        const html = `
            <div class="flex gap-3 animate-in fade-in slide-in-from-top-2 duration-200">
                <div class="relative w-1/3">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-microchip text-xs"></i>
                    </div>
                    <input name="specs[${specIndex}][icon]" placeholder="Icon (fa-cpu)" 
                           class="w-full rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 p-3.5 pl-10 text-sm transition-all outline-none">
                </div>
                <input name="specs[${specIndex}][text]" placeholder="Feature description" 
                       class="w-2/3 rounded-xl border-gray-200 bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 p-3.5 text-sm transition-all outline-none">
                <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-red-500 transition px-2">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        wrapper.insertAdjacentHTML('beforeend', html);
        specIndex++;
    }
</script>
@endsection