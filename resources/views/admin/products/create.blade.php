@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-plus-circle mr-2 text-primary"></i> Add Product
                </h1>
                <p class="text-sm text-gray-500 mt-1">Fill in the details below to create a new product entry.</p>
            </div>

            <a href="{{ route('products.index') }}" 
               class="flex items-center space-x-2 text-gray-500 hover:text-primary font-semibold transition-all">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Products</span>
            </a>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
                <div class="flex items-center mb-1">
                    <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                    <span class="font-bold text-sm text-red-800">Please fix the following errors:</span>
                </div>
                <ul class="list-disc list-inside text-xs space-y-1 ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Category <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id"
                            class="w-full rounded-xl border-gray-200 border p-3 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            <option value="">Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Model <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="model" value="{{ old('model') }}" placeholder="e.g. Pro-2024"
                            class="w-full rounded-xl border-gray-200 border p-3 focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Product display name"
                            class="w-full rounded-xl border-gray-200 border p-3 focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Price <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="price" value="{{ old('price') }}" placeholder="Rs. 2,070 / Coming soon"
                            class="w-full rounded-xl border-gray-200 border p-3 focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Product Image <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="image" 
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-primary hover:file:bg-blue-100 border border-gray-200 rounded-xl p-2">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Badge Text
                        </label>
                        <input type="text" name="badge_text" value="{{ old('badge_text') }}"
                            placeholder="Fixed-Focal / Enterprise" class="w-full rounded-xl border-gray-200 border p-3 focus:ring-2 focus:ring-primary">
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wider">
                            Badge Color (Tailwind)
                        </label>
                        <input type="text" name="badge_color" value="{{ old('badge_color') }}" placeholder="bg-blue-500"
                            class="w-full rounded-xl border-gray-200 border p-3 focus:ring-2 focus:ring-primary">
                    </div>
                </div>

                <hr class="border-gray-100">

                <div>
                    <label class="flex items-center mb-4 text-sm font-bold text-gray-700 uppercase tracking-wider">
                        <i class="fas fa-list-ul mr-2 text-primary"></i> Specifications
                    </label>

                    <div id="specs-wrapper" class="space-y-3">
                        <div class="flex gap-3 items-center bg-gray-50 p-3 rounded-xl border border-gray-100">
                            <div class="w-1/3">
                                <span class="text-[10px] font-bold text-gray-400 block mb-1">ICON (FA)</span>
                                <input name="specs[0][icon]" placeholder="fa-microchip"
                                    class="w-full rounded-lg border-gray-200 border p-2 text-sm focus:ring-1 focus:ring-primary">
                            </div>
                            <div class="w-2/3">
                                <span class="text-[10px] font-bold text-gray-400 block mb-1">DESCRIPTION</span>
                                <input name="specs[0][text]" placeholder="Spec description"
                                    class="w-full rounded-lg border-gray-200 border p-2 text-sm focus:ring-1 focus:ring-primary">
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="addSpec()" 
                        class="mt-4 flex items-center text-xs font-bold text-primary hover:text-[#266eb1] transition-colors uppercase tracking-widest">
                        <i class="fas fa-plus-circle mr-1"></i> Add another spec
                    </button>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-gray-50">
                    <a href="{{ route('products.index') }}"
                        class="px-6 py-2.5 rounded-xl border border-gray-200 text-gray-500 font-semibold hover:bg-gray-50 transition-all">
                        Cancel
                    </a>

                    <button type="submit" 
                        class="px-8 py-2.5 rounded-xl bg-primary text-white font-bold transition-all hover:bg-[#266eb1] shadow-lg shadow-blue-100">
                        <i class="fas fa-save mr-2"></i> Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script with updated styling --}}
    <script>
        let specIndex = 1;

        function addSpec() {
            const wrapper = document.getElementById('specs-wrapper');
            const newSpec = `
                <div class="flex gap-3 items-center bg-gray-50 p-3 rounded-xl border border-gray-100 animate-fadeIn">
                    <div class="w-1/3">
                        <input name="specs[${specIndex}][icon]"
                               placeholder="fa-icon"
                               class="w-full rounded-lg border-gray-200 border p-2 text-sm focus:ring-1 focus:ring-primary">
                    </div>
                    <div class="w-2/3">
                        <input name="specs[${specIndex}][text]"
                               placeholder="Spec description"
                               class="w-full rounded-lg border-gray-200 border p-2 text-sm focus:ring-1 focus:ring-primary">
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 transition-colors">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', newSpec);
            specIndex++;
        }
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.3s ease-out forwards; }
    </style>
@endsection