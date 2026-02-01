@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('about-header.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to About Headers</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $header ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $header ? 'Edit About Header' : 'Create New About Header' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the main heading, badge text, and descriptions for the
                    about section.</p>
            </div>

            <div class="p-8">
                {{-- Display Errors --}}
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span class="font-bold">Please correct the following:</span>
                        </div>
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                    action="{{ $header ? route('about-header.update', $header) : route('about-header.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($header)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Title Configuration --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Main Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title', $header->title ?? '') }}" required
                                placeholder="e.g., We Are Dedicated To Your Success"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold">
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Description</label>
                            <textarea name="description" rows="4" placeholder="Enter a brief description for the about section..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">{{ old('description', $header->description ?? '') }}</textarea>
                        </div>

                        {{-- Badge Text --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Badge
                                Text</label>
                            <input type="text" name="badge_text"
                                value="{{ old('badge_text', $header->badge_text ?? '') }}"
                                placeholder="e.g., About Our Company"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                        </div>

                        {{-- Badge Icon --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Badge Icon
                                (FontAwesome)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-icons"></i>
                                </span>
                                <input type="text" name="badge_icon"
                                    value="{{ old('badge_icon', $header->badge_icon ?? '') }}"
                                    placeholder="fa-solid fa-certificate"
                                    class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                            </div>
                            <p class="mt-1 text-xs text-gray-400 italic">Example: fa-solid fa-star</p>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Active Status Toggle --}}
                    <div class="flex items-center space-x-3 py-2">
                        <input type="hidden" name="is_active" value="0">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_active" value="1" id="isActive"
                                {{ old('is_active', $header->is_active ?? true) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary transition-all cursor-pointer">
                        </div>
                        <label for="isActive"
                            class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer select-none">
                            Mark as Active
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('about-header.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $header ? 'Update' : 'Save' }} Header</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
