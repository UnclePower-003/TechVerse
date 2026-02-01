@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('about-drive.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Drive List</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas {{ $drive ? 'fa-edit' : 'fa-plus-circle' }} mr-3 opacity-80"></i>
                    {{ $drive ? 'Edit About Drive' : 'Create New About Drive' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Manage the details and key selling points for the Drive section.</p>
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
                    action="{{ $drive ? route('about-drive.update', $drive) : route('about-drive.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($drive)
                        @method('PUT')
                    @endif

                    <input type="hidden" name="is_active" value="0">

                    <div class="grid grid-cols-1 gap-6">
                        {{-- Title --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title', $drive->title ?? '') }}" required
                                placeholder="e.g., Drive with Confidence"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold">
                        </div>

                        {{-- Description --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Description</label>
                            <textarea name="description" rows="3" placeholder="Enter a brief description..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">{{ old('description', $drive->description ?? '') }}</textarea>
                        </div>

                        {{-- Dynamic Points Section --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Key Points
                            </label>
                            <div id="points-container" class="space-y-3">
                                @php
                                    $points = old('points', $drive->points ?? []);
                                @endphp
                                @foreach ($points as $i => $point)
                                    <div class="flex items-center gap-3">
                                        <div class="relative flex-grow">
                                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                            <input type="text" name="points[{{ $i }}]" value="{{ $point }}"
                                                placeholder="Enter a feature or point"
                                                class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                                        </div>
                                        <button type="button" onclick="this.parentElement.remove()"
                                            class="p-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            
                            <button type="button" onclick="addPoint()"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-gray-50 text-gray-700 border border-gray-200 rounded-lg text-sm font-bold hover:bg-gray-100 transition-all">
                                <i class="fas fa-plus mr-2 text-xs"></i> Add New Point
                            </button>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Active Status --}}
                    <div class="flex items-center space-x-3 py-2">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_active" value="1" id="isActive"
                                {{ old('is_active', $drive->is_active ?? true) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary transition-all cursor-pointer">
                        </div>
                        <label for="isActive"
                            class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer select-none">
                            Mark as Active
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('about-drive.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $drive ? 'Update' : 'Save' }} Drive Content</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let counter = {{ count(old('points', $drive->points ?? [])) }};

        function addPoint() {
            const container = document.getElementById('points-container');
            const div = document.createElement('div');
            div.className = 'flex items-center gap-3 animate-fadeIn';
            div.innerHTML = `
                <div class="relative flex-grow">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-check-circle"></i>
                    </span>
                    <input type="text" name="points[${counter}]" placeholder="Enter a feature or point"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                </div>
                <button type="button" onclick="this.parentElement.remove()"
                    class="p-3 text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                    <i class="fas fa-trash-alt"></i>
                </button>
            `;
            container.appendChild(div);
            counter++;
        }
    </script>

    <style>
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection