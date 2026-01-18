@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('hero-header.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Hero Headers</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-heading mr-3 opacity-80"></i>
                    {{ $header ? 'Edit Hero Header' : 'Create New Hero Header' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the text, highlights, and call-to-action buttons for
                    your hero section.</p>
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
                    action="{{ $header ? route('hero-header.update', $header) : route('hero-header.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($header)
                        @method('PUT')
                    @endif

                    {{-- Title Configuration Section --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Badge
                                Text</label>
                            <input type="text" name="badge_text" placeholder="e.g. Best Choice"
                                value="{{ old('badge_text', $header->badge_text ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Small Title 1
                                (Prefix)</label>
                            <input type="text" name="title_small_1" placeholder="YOUR"
                                value="{{ old('title_small_1', $header->title_small_1 ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Main
                                Title</label>
                            <input type="text" name="title_main" placeholder="TECH PARTNER"
                                value="{{ old('title_main', $header->title_main ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Small Title 2
                                (Connector)</label>
                            <input type="text" name="title_small_2" placeholder="FOR"
                                value="{{ old('title_small_2', $header->title_small_2 ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Title
                                Highlight</label>
                            <input type="text" name="title_highlight" placeholder="Success"
                                value="{{ old('title_highlight', $header->title_highlight ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none text-primary font-bold">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Description</label>
                        <textarea name="description" rows="3" placeholder="Enter a brief description for the hero section..."
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">{{ old('description', $header->description ?? '') }}</textarea>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Buttons Section --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <div>
                            <label class="block text-sm font-bold text-gray-600 mb-2">Primary Button Text</label>
                            <input type="text" name="primary_btn_text" placeholder="Get Started"
                                value="{{ old('primary_btn_text', $header->primary_btn_text ?? '') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary transition-all outline-none">

                            <label class="block text-xs font-bold text-gray-400 mt-2 uppercase">Link</label>
                            <input type="text" name="primary_btn_link" placeholder="https://..."
                                value="{{ old('primary_btn_link', $header->primary_btn_link ?? '') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary transition-all outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-600 mb-2">Secondary Button Text</label>
                            <input type="text" name="secondary_btn_text" placeholder="Learn More"
                                value="{{ old('secondary_btn_text', $header->secondary_btn_text ?? '') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary transition-all outline-none">

                            <label class="block text-xs font-bold text-gray-400 mt-2 uppercase">Link</label>
                            <input type="text" name="secondary_btn_link" placeholder="https://..."
                                value="{{ old('secondary_btn_link', $header->secondary_btn_link ?? '') }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary transition-all outline-none">
                        </div>
                    </div>

                    {{-- Active Status Toggle --}}
                    <div class="flex items-center space-x-3 py-4">
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
                        <a href="{{ route('hero-header.index') }}"
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
