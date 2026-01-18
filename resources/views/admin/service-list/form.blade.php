@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('service-list.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Service List</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-concierge-bell mr-3 opacity-80"></i>
                    {{ isset($service) ? 'Edit Service Details' : 'Create New Service' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure individual service cards, icons, and specialized tags.
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
                    action="{{ isset($service) ? route('service-list.update', $service) : route('service-list.store') }}"
                    class="space-y-6">
                    @csrf
                    @if (isset($service))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Icon Class --}}
                        <div class="md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Icon
                                Class</label>
                            <input type="text" name="icon" placeholder="e.g. fas fa-code"
                                value="{{ old('icon', $service->icon ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-mono text-sm text-primary">
                        </div>

                        {{-- Animation Delay --}}
                        <div class="md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Animation
                                Delay (ms)</label>
                            <input type="number" name="animation_delay" step="100"
                                value="{{ old('animation_delay', $service->animation_delay ?? 100) }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                        </div>

                        {{-- Title --}}
                        <div class="md:col-span-1">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Title</label>
                            <input type="text" name="title" placeholder="e.g. Web Development"
                                value="{{ old('title', $service->title ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold">
                        </div>

                        {{-- Subtitle --}}
                        <div class="md:col-span-1">
                            <label
                                class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Subtitle</label>
                            <input type="text" name="subtitle" placeholder="e.g. Modern Solutions"
                                value="{{ old('subtitle', $service->subtitle ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label
                            class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Description</label>
                        <textarea name="description" rows="3" placeholder="Describe the service in detail..."
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">{{ old('description', $service->description ?? '') }}</textarea>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Dynamic Tags Section --}}
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Service
                                Tags</label>
                            <button type="button" id="add-tag"
                                class="px-4 py-1.5 bg-primary text-white text-xs font-bold rounded-lg hover:bg-blue-600 transition-all flex items-center">
                                <i class="fas fa-plus mr-2"></i> Add Tag
                            </button>
                        </div>

                        <div id="tags-container" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            @php
                                $tags = old('tags', $service->tags ?? []);
                            @endphp
                            @foreach ($tags as $i => $tag)
                                <div
                                    class="tag-item flex gap-2 bg-white p-2 rounded-xl border border-gray-200 shadow-sm animate-fadeIn">
                                    <input type="text" name="tags[{{ $i }}]" value="{{ $tag }}"
                                        placeholder="Tag name"
                                        class="flex-1 px-3 py-2 text-sm rounded-lg border border-gray-100 focus:ring-1 focus:ring-primary outline-none">
                                    <button type="button"
                                        class="remove-tag px-3 py-2 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all">
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
                            {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                            class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary transition-all cursor-pointer">
                        <label for="isActive"
                            class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer">
                            Mark as Published
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('service-list.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-100 hover:bg-blue-600 transition-all flex items-center space-x-2">
                            <i class="fas fa-save"></i>
                            <span>{{ isset($service) ? 'Update' : 'Save' }} Service</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('tags-container');
            const addBtn = document.getElementById('add-tag');

            addBtn.addEventListener('click', () => {
                const index = container.querySelectorAll('.tag-item').length;
                const div = document.createElement('div');
                div.className =
                    'tag-item flex gap-2 bg-white p-2 rounded-xl border border-gray-200 shadow-sm animate-fadeIn';
                div.innerHTML = `
                    <input type="text" name="tags[${index}]" placeholder="Tag name"
                        class="flex-1 px-3 py-2 text-sm rounded-lg border border-gray-100 focus:ring-1 focus:ring-primary outline-none">
                    <button type="button" class="remove-tag px-3 py-2 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all">
                        <i class="fas fa-trash-alt pointer-events-none"></i>
                    </button>
                `;
                container.appendChild(div);
            });

            container.addEventListener('click', e => {
                if (e.target.classList.contains('remove-tag')) {
                    e.target.closest('.tag-item').remove();
                }
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
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
