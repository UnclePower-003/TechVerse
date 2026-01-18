@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('contact-hero.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Contact Heroes</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-id-card mr-3 opacity-80"></i>
                    {{ $hero ? 'Edit Contact Hero' : 'Create New Contact Hero' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Upload specific dimensions for Mobile, Tablet, and Desktop views
                    to ensure the best performance.</p>
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
                    action="{{ $hero ? route('contact-hero.update', $hero) : route('contact-hero.store') }}"
                    enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @if ($hero)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        {{-- Mobile Image --}}
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Mobile
                                Image</label>
                            <div
                                class="group relative bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-4 transition-all hover:border-primary">
                                <input type="file" name="image_mobile"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="text-center">
                                    <i class="fas fa-mobile-alt text-2xl text-gray-300 group-hover:text-primary mb-2"></i>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">Click to Upload</p>
                                </div>
                            </div>
                            @if ($hero && $hero->image_mobile)
                                <div class="mt-3 p-1 bg-white border border-gray-100 rounded-xl shadow-sm">
                                    <img src="{{ asset('storage/' . $hero->image_mobile) }}"
                                        class="w-full h-32 object-cover rounded-lg" alt="Mobile Preview">
                                </div>
                            @endif
                        </div>

                        {{-- Tablet Image --}}
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Tablet
                                Image</label>
                            <div
                                class="group relative bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-4 transition-all hover:border-primary">
                                <input type="file" name="image_tablet"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="text-center">
                                    <i class="fas fa-tablet-alt text-2xl text-gray-300 group-hover:text-primary mb-2"></i>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">Click to Upload</p>
                                </div>
                            </div>
                            @if ($hero && $hero->image_tablet)
                                <div class="mt-3 p-1 bg-white border border-gray-100 rounded-xl shadow-sm">
                                    <img src="{{ asset('storage/' . $hero->image_tablet) }}"
                                        class="w-full h-32 object-cover rounded-lg" alt="Tablet Preview">
                                </div>
                            @endif
                        </div>

                        {{-- Desktop Image --}}
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Desktop
                                Image</label>
                            <div
                                class="group relative bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-4 transition-all hover:border-primary">
                                <input type="file" name="image_desktop"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="text-center">
                                    <i class="fas fa-desktop text-2xl text-gray-300 group-hover:text-primary mb-2"></i>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">Click to Upload</p>
                                </div>
                            </div>
                            @if ($hero && $hero->image_desktop)
                                <div class="mt-3 p-1 bg-white border border-gray-100 rounded-xl shadow-sm">
                                    <img src="{{ asset('storage/' . $hero->image_desktop) }}"
                                        class="w-full h-32 object-cover rounded-lg" alt="Desktop Preview">
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Active Status Toggle --}}
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-2xl border border-gray-100 w-fit">
                        <input type="hidden" name="is_active" value="0">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_active" value="1" id="isActive"
                                {{ old('is_active', $hero->is_active ?? true) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary transition-all cursor-pointer">
                        </div>
                        <label for="isActive"
                            class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer select-none">
                            Set as Active Banner
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('contact-hero.index') }}"
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
