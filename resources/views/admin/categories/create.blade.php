@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-plus-circle mr-2 text-primary"></i> Add Category
                </h1>
                <p class="text-sm text-gray-500 mt-1">Create a new classification for your products.</p>
            </div>

            <a href="{{ route('categories.index') }}" 
               class="flex items-center space-x-2 text-gray-500 hover:text-primary transition-colors font-medium text-sm">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Categories</span>
            </a>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 shadow-sm">
                <div class="flex items-center mb-1">
                    <i class="fas fa-exclamation-circle mr-2 text-red-500"></i>
                    <span class="text-sm font-bold uppercase tracking-wide">Submission Errors:</span>
                </div>
                <ul class="list-disc list-inside text-sm ml-6 opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Decorative top bar --}}
            <div class="h-2 bg-primary w-full"></div>
            
            <form method="POST" action="{{ route('categories.store') }}" class="p-8 space-y-6">
                @csrf

                {{-- Category Name Input --}}
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">
                        Category Name <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fas fa-tag"></i>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="e.g. Smart Lighting"
                            class="w-full rounded-xl border-gray-200 pl-11 p-3.5 bg-gray-50 focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all outline-none"
                            required autofocus>
                    </div>
                    <p class="text-xs text-gray-400 italic">This name will be visible to customers on the storefront.</p>
                </div>

                {{-- Form Actions --}}
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('categories.index') }}"
                        class="px-6 py-3 rounded-xl text-gray-600 font-semibold hover:bg-gray-100 transition-all">
                        Cancel
                    </a>

                    <button type="submit"
                        class="flex items-center space-x-2 bg-primary text-white px-8 py-3 rounded-xl font-bold transition-all hover:bg-[#266eb1] shadow-lg shadow-indigo-100 focus:ring-4 focus:ring-primary/20">
                        <i class="fas fa-check text-sm"></i>
                        <span>Save Category</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection