@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb --}}
        <div class="mb-6">
            <a href="{{ route('about-hero.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to About Heroes</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-info-circle mr-3 opacity-80"></i>
                    {{ $hero ? 'Edit About Hero' : 'Create New About Hero' }}
                </h1>
            </div>

            <div class="p-8">
                <form method="POST"
                    action="{{ $hero ? route('about-hero.update', $hero->id) : route('about-hero.store') }}"
                    enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @if ($hero) @method('PUT') @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach(['mobile_image' => 'mobile', 'tablet_image' => 'tablet', 'desktop_image' => 'desktop'] as $name => $icon)
                        <div class="space-y-3">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">
                                {{ str_replace('_', ' ', $name) }}
                            </label>
                            
                            {{-- Upload Box --}}
                            <div class="group relative bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-4 transition-all hover:border-primary">
                                <input type="file" name="{{ $name }}" onchange="previewImage(this, '{{ $name }}_preview')"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="text-center">
                                    <i class="fas fa-{{ $icon }}-alt text-2xl text-gray-300 group-hover:text-primary mb-2"></i>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">Click to Upload</p>
                                </div>
                            </div>

                            {{-- Preview Container --}}
                            <div id="{{ $name }}_preview_container" class="mt-3 p-1 bg-white border border-gray-100 rounded-xl shadow-sm {{ ($hero && $hero->$name) ? '' : 'hidden' }}">
                                <img id="{{ $name }}_preview" 
                                     src="{{ $hero && $hero->$name ? asset('storage/' . $hero->$name) : '#' }}"
                                     class="w-full h-32 object-cover rounded-lg" alt="Preview">
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Active Toggle --}}
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-2xl border border-gray-100 w-fit">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" id="isActive"
                            {{ old('is_active', $hero->is_active ?? 0) ? 'checked' : '' }}
                            class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary cursor-pointer">
                        <label for="isActive" class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer">
                            Set as Active Banner
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('about-hero.index') }}" class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold">Cancel</a>
                        <button type="submit" class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all">
                            {{ $hero ? 'Update Hero' : 'Save Hero' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Live Preview Script --}}
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const container = document.getElementById(previewId + '_container');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection