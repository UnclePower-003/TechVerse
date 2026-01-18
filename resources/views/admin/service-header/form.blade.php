@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('service-header.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Service Headers</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-edit mr-3 opacity-80"></i>
                    {{ $header ? 'Edit Service Header' : 'Create Service Header' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Define the badge, main heading, and feature list for the service
                    hero section.</p>
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
                    action="{{ $header ? route('service-header.update', $header) : route('service-header.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($header)
                        @method('PUT')
                    @endif

                    {{-- Text Configuration --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Badge
                                Text</label>
                            <input type="text" name="badge_text" placeholder="e.g. Our Expertise"
                                value="{{ old('badge_text', $header->badge_text ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Main
                                Heading</label>
                            <input type="text" name="heading_main" placeholder="e.g. Scalable Tech"
                                value="{{ old('heading_main', $header->heading_main ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Gradient
                                Heading (Highlight)</label>
                            <input type="text" name="heading_gradient" placeholder="e.g. Solutions"
                                value="{{ old('heading_gradient', $header->heading_gradient ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none text-primary font-extrabold">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Description</label>
                        <textarea name="description" rows="3" placeholder="Explain the service value proposition..."
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">{{ old('description', $header->description ?? '') }}</textarea>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Dynamic Features Section --}}
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Service
                                Features</label>
                            <button type="button" id="add-feature"
                                class="px-4 py-1.5 bg-primary text-white text-xs font-bold rounded-lg hover:bg-blue-600 transition-all flex items-center">
                                <i class="fas fa-plus mr-2"></i> Add Feature
                            </button>
                        </div>

                        <div id="features-container" class="space-y-3">
                            @php
    $features = old('features', $header->features ?? []);
    if (is_string($features)) {
        $features = json_decode($features, true) ?? [];
    }
@endphp
                            @foreach ($features as $i => $feature)
                                <div
                                    class="feature-item flex flex-col md:flex-row gap-3 bg-white p-3 rounded-xl border border-gray-200 shadow-sm animate-fadeIn">
                                    <div class="flex-1">
                                        <input type="text" name="features[{{ $i }}][icon]"
                                            placeholder="Icon Class (e.g., fas fa-check)"
                                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:ring-1 focus:ring-primary outline-none"
                                            value="{{ $feature['icon'] ?? '' }}">
                                    </div>
                                    <div class="flex-[2]">
                                        <input type="text" name="features[{{ $i }}][text]"
                                            placeholder="Feature Text"
                                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:ring-1 focus:ring-primary outline-none"
                                            value="{{ $feature['text'] ?? '' }}">
                                    </div>
                                    <button type="button"
                                        class="remove-feature px-3 py-2 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all">
                                        <i class="fas fa-trash-alt pointer-events-none"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Active Status --}}
                    <div class="flex items-center space-x-3 py-2">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" id="isActive"
                            {{ old('is_active', $header->is_active ?? true) ? 'checked' : '' }}
                            class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary transition-all cursor-pointer">
                        <label for="isActive"
                            class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer">
                            Mark as Active
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('service-header.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-blue-600 transition-all flex items-center space-x-2">
                            <i class="fas fa-save"></i>
                            <span>{{ $header ? 'Update' : 'Save' }} Header</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('features-container');
            const addBtn = document.getElementById('add-feature');

            addBtn.addEventListener('click', () => {
                const index = container.querySelectorAll('.feature-item').length;
                const div = document.createElement('div');
                div.className =
                    'feature-item flex flex-col md:flex-row gap-3 bg-white p-3 rounded-xl border border-gray-200 shadow-sm transition-all';
                div.innerHTML = `
                    <div class="flex-1">
                        <input type="text" name="features[${index}][icon]" placeholder="Icon Class (e.g., fas fa-check)"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:ring-1 focus:ring-primary outline-none">
                    </div>
                    <div class="flex-[2]">
                        <input type="text" name="features[${index}][text]" placeholder="Feature Text"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:ring-1 focus:ring-primary outline-none">
                    </div>
                    <button type="button" class="remove-feature px-3 py-2 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all">
                        <i class="fas fa-trash-alt pointer-events-none"></i>
                    </button>
                `;
                container.appendChild(div);
            });

            container.addEventListener('click', e => {
                if (e.target.classList.contains('remove-feature')) {
                    e.target.closest('.feature-item').remove();
                    // Optional: Re-index inputs here if your backend strictly requires sequential keys
                }
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
@endsection
