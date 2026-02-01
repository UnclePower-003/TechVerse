@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('project-hero.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Project Heroes</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-project-diagram mr-3 opacity-80"></i>
                    {{ isset($projectHero) ? 'Edit Project Hero' : 'Create Project Hero' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Update the visual identity and titles for your project's hero section.</p>
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
                    action="{{ isset($projectHero) ? route('project-hero.update', $projectHero) : route('project-hero.store') }}"
                    enctype="multipart/form-data" 
                    class="space-y-6">

                    @csrf
                    @isset($projectHero)
                        @method('PUT')
                    @endisset

                    {{-- Title Field --}}
                    {{-- <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Project Title</label>
                        <input type="text" name="title" placeholder="Enter hero title..."
                            value="{{ old('title', $projectHero->title ?? '') }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                    </div> --}}

                    {{-- Image Upload Section --}}
                    <div class="bg-gray-50 p-6 rounded-2xl border border-dashed border-gray-300">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">Hero Image</label>
                        
                        <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
                            @isset($projectHero)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $projectHero->image) }}" 
                                         alt="Current Hero" 
                                         class="w-48 h-32 object-cover rounded-lg shadow-md border-2 border-white">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                        <span class="text-white text-xs font-bold">Current Image</span>
                                    </div>
                                </div>
                            @endisset

                            <div class="flex-1">
                                <input type="file" name="image" 
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-black file:text-white hover:file:bg-[#0f3961] transition-all cursor-pointer">
                                <p class="mt-2 text-xs text-gray-400">Recommended size: 1920x1080px. Formats: JPG, PNG, WEBP.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Active Status Toggle --}}
                    <div class="flex items-center space-x-3 py-4">
                        <input type="hidden" name="is_active" value="0">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_active" value="1" id="isActive"
                                {{ old('is_active', $projectHero->is_active ?? true) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary transition-all cursor-pointer">
                        </div>
                        <label for="isActive"
                            class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer select-none">
                            Mark as Active
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('project-hero.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ isset($projectHero) ? 'Update' : 'Save' }} Project Hero</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection