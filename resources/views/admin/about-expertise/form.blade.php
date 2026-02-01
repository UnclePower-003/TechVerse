@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('about-expertise.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Expertise List</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $expertise ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $expertise ? 'Edit Expertise Section' : 'Create New Expertise Section' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Manage the skills, icons, and descriptions for your expertise area.</p>
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
                    action="{{ $expertise ? route('about-expertise.update', $expertise) : route('about-expertise.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($expertise)
                        @method('PUT')
                    @endif

                    <div class="space-y-6">
                        {{-- Title --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Section Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title', $expertise->title ?? '') }}" required
                                placeholder="e.g., Our Core Expertise"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold">
                        </div>

                        {{-- Description --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Description</label>
                            <textarea name="description" rows="3" placeholder="Briefly describe this expertise area..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">{{ old('description', $expertise->description ?? '') }}</textarea>
                        </div>

                        <hr class="border-gray-100">

                        {{-- Dynamic Items Section --}}
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Expertise Items</label>
                                <button type="button" onclick="addItem()" 
                                    class="text-xs bg-indigo-50 text-primary px-3 py-1 rounded-lg font-bold hover:bg-indigo-100 transition-colors flex items-center">
                                    <i class="fas fa-plus mr-1"></i> Add New Item
                                </button>
                            </div>

                            <div id="items-container" class="space-y-3">
                                @if (old('items', $expertise->items ?? []))
                                    @foreach (old('items', $expertise->items ?? []) as $i => $item)
                                        <div class="flex flex-col md:flex-row gap-3 p-4 bg-gray-50 rounded-xl border border-gray-100 items-end">
                                            <div class="flex-1 w-full">
                                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Label</label>
                                                <input type="text" name="items[{{ $i }}][label]" 
                                                    value="{{ $item['label'] ?? '' }}"
                                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm" placeholder="Label">
                                            </div>
                                            <div class="flex-1 w-full">
                                                <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Icon Class</label>
                                                <input type="text" name="items[{{ $i }}][icon]" 
                                                    value="{{ $item['icon'] ?? '' }}"
                                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm" placeholder="fa-solid fa-check">
                                            </div>
                                            <button type="button" onclick="this.parentElement.remove()" 
                                                class="px-4 py-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-100 transition-colors">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        {{-- Active Status --}}
                        <div class="flex items-center space-x-3 py-2">
                            <input type="hidden" name="is_active" value="0">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="is_active" value="1" id="isActive"
                                    {{ old('is_active', $expertise->is_active ?? true) ? 'checked' : '' }}
                                    class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary transition-all cursor-pointer">
                            </div>
                            <label for="isActive" class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer select-none">
                                Mark as Active
                            </label>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('about-expertise.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $expertise ? 'Update' : 'Save' }} Expertise</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let counter = {{ count(old('items', $expertise->items ?? [])) }};

        function addItem() {
            const container = document.getElementById('items-container');
            const div = document.createElement('div');
            div.className = 'flex flex-col md:flex-row gap-3 p-4 bg-gray-50 rounded-xl border border-gray-100 items-end';
            div.innerHTML = `
                <div class="flex-1 w-full">
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Label</label>
                    <input type="text" name="items[${counter}][label]" 
                        class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm" placeholder="Label">
                </div>
                <div class="flex-1 w-full">
                    <label class="text-[10px] font-bold text-gray-400 uppercase ml-1">Icon Class</label>
                    <input type="text" name="items[${counter}][icon]" 
                        class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-primary outline-none text-sm" placeholder="fa-solid fa-star">
                </div>
                <button type="button" onclick="this.parentElement.remove()" 
                    class="px-4 py-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-100 transition-colors">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            container.appendChild(div);
            counter++;
        }
    </script>
@endsection