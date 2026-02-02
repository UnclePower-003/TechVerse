@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-10">

    {{-- Header Section --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                <i class="fas fa-edit mr-2 text-primary"></i> Edit Product
            </h1>
            <p class="text-sm text-gray-500 mt-1">Update the details and technical specifications for this item.</p>
        </div>

        <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-primary transition-colors group">
            <span class="mr-2 transition-transform group-hover:-translate-x-1">←</span> Back to Products
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        
        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="m-8 mb-0 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 shadow-sm">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                    <span class="font-bold">Please correct the following:</span>
                </div>
                <ul class="list-disc list-inside text-sm ml-7">
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
                <div class="col-span-1">
                    <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-widest">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id" class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 transition p-3 text-sm">
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1">
                    <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-widest">
                        Model <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="model" value="{{ old('model', $product->model) }}" 
                           class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 transition p-3 text-sm">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-widest">
                        Product Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $product->title) }}" 
                           class="w-full rounded-xl border-gray-300 focus:border-primary focus:ring focus:ring-primary/20 transition p-3 text-sm">
                </div>

                <div class="col-span-1">
                    <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-widest">
                        Price <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-400 font-semibold">$</span>
                        <input type="text" name="price" value="{{ old('price', $product->price) }}" 
                               class="w-full rounded-xl border-gray-300 pl-8 focus:border-primary focus:ring focus:ring-primary/20 transition p-3 text-sm">
                    </div>
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- Image Section --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-1">
                    <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-widest">Product Image</label>
                    <p class="text-xs text-gray-400 mb-4">Recommended: 800x800px. PNG or JPG.</p>
                    
                    @if ($product->image)
                        <div class="relative w-40 h-40 group">
                            <img src="{{ asset($product->image) }}" class="w-full h-full object-cover rounded-2xl border border-gray-200 shadow-md">
                            <div class="absolute inset-0 bg-primary/60 rounded-2xl opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <span class="text-white text-xs font-bold uppercase tracking-tighter">Current Image</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="md:col-span-2 flex items-center">
                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:uppercase file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition pointer-cursor">
                </div>
            </div>

            <hr class="border-gray-100">

            {{-- Badge Logic --}}
            <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-widest">Badge Text</label>
                    <input type="text" name="badge_text" value="{{ old('badge_text', $product->badge_text) }}" 
                           placeholder="e.g. New Arrival" class="w-full rounded-xl border-gray-300 focus:ring-primary/20 p-3 text-sm">
                </div>
                <div>
                    <label class="block mb-2 text-xs font-bold text-gray-700 uppercase tracking-widest">Badge Color (Tailwind)</label>
                    <input type="text" name="badge_color" value="{{ old('badge_color', $product->badge_color) }}" 
                           placeholder="bg-emerald-500" class="w-full rounded-xl border-gray-300 focus:ring-primary/20 p-3 text-sm">
                </div>
            </div>

            {{-- Specifications --}}
            <div>
                <label class="block mb-4 text-xs font-bold text-gray-700 uppercase tracking-widest">Specifications</label>
                <div id="specs-wrapper" class="space-y-3">
                    @forelse (old('specs', $product->specs ?? []) as $index => $spec)
                        <div class="flex gap-3 group">
                            <input name="specs[{{ $index }}][icon]" value="{{ $spec['icon'] ?? '' }}" 
                                   placeholder="Icon (fa-cpu)" class="w-1/3 rounded-xl border-gray-300 p-3 text-sm focus:ring-primary/20">
                            <input name="specs[{{ $index }}][text]" value="{{ $spec['text'] ?? '' }}" 
                                   placeholder="Feature description" class="w-2/3 rounded-xl border-gray-300 p-3 text-sm focus:ring-primary/20">
                            <button type="button" onclick="this.parentElement.remove()" class="text-gray-400 hover:text-red-500 transition px-2">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 italic mb-2">No specifications added yet.</p>
                    @endforelse
                </div>

                <button type="button" onclick="addSpec()" class="mt-4 inline-flex items-center text-xs font-bold uppercase tracking-widest text-primary hover:text-white bg-blue-50 hover:bg-primary px-5 py-2.5 rounded-xl transition-all border border-blue-100">
                    <i class="fas fa-plus mr-2"></i> Add Specification
                </button>
            </div>

            {{-- Form Actions --}}
            <div class="flex items-center justify-end gap-4 pt-8 border-t border-gray-100">
                <a href="{{ route('products.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold text-gray-500 hover:bg-gray-50 transition">
                    Discard Changes
                </a>
                <button type="submit" class="px-8 py-3 rounded-xl bg-primary text-white font-bold hover:bg-[#266eb1] shadow-lg shadow-indigo-100 transition-all transform active:scale-95">
                    Save Product
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
                <input name="specs[${specIndex}][icon]" placeholder="Icon (fa-icon)" 
                       class="w-1/3 rounded-xl border-gray-300 p-3 text-sm focus:ring-primary/20">
                <input name="specs[${specIndex}][text]" placeholder="Feature description" 
                       class="w-2/3 rounded-xl border-gray-300 p-3 text-sm focus:ring-primary/20">
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