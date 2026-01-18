@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('services-hero.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Services Sliders</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-images mr-3 opacity-80"></i>
                    {{ $hero ? 'Edit Service Hero' : 'Create New Service Hero' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Upload and manage responsive hero banners for the services page.
                </p>
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
                    action="{{ $hero ? route('services-hero.update', $hero) : route('services-hero.store') }}"
                    enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @if ($hero)
                        @method('PUT')
                    @endif

                    {{-- Image Upload Section --}}
                    <div class="grid grid-cols-1 gap-8">

                        {{-- Desktop Image --}}
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-3">Desktop Image
                                (Large Screens)</label>
                            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                                @if ($hero?->desktop_image)
                                    <img src="{{ asset('storage/' . $hero->desktop_image) }}"
                                        class="w-40 h-24 object-cover rounded-xl border-2 border-white shadow-md">
                                @endif
                                <input type="file" name="desktop_image"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-primary file:text-white hover:file:bg-blue-600 transition-all cursor-pointer">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Tablet Image --}}
                            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-3">Tablet
                                    Image</label>
                                <div class="space-y-4">
                                    @if ($hero?->tablet_image)
                                        <img src="{{ asset('storage/' . $hero->tablet_image) }}"
                                            class="w-32 h-20 object-cover rounded-xl border-2 border-white shadow-md">
                                    @endif
                                    <input type="file" name="tablet_image"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer">
                                </div>
                            </div>

                            {{-- Mobile Image --}}
                            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-3">Mobile
                                    Image</label>
                                <div class="space-y-4">
                                    @if ($hero?->mobile_image)
                                        <img src="{{ asset('storage/' . $hero->mobile_image) }}"
                                            class="w-20 h-24 object-cover rounded-xl border-2 border-white shadow-md">
                                    @endif
                                    <input type="file" name="mobile_image"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Active Status Toggle --}}
                    <div class="flex items-center space-x-3 py-4 border-t border-gray-100">
                        <input type="hidden" name="is_active" value="0">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_active" value="1" id="isActive"
                                {{ old('is_active', $hero->is_active ?? true) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary transition-all cursor-pointer">
                        </div>
                        <label for="isActive"
                            class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer select-none">
                            Mark as Active
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('services-hero.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $hero ? 'Update' : 'Save' }} Hero</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
