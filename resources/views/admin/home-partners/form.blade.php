@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('home-partners.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Partners</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-handshake mr-3 opacity-80"></i>
                    {{ isset($partner) ? 'Edit Partner: ' . $partner->name : 'Add New Partner' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">
                    Enter the brand name and FontAwesome icon class to display in the partner scroll section.
                </p>
            </div>

            <div class="p-8">
                {{-- Display Errors --}}
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span class="font-bold">Validation Errors:</span>
                        </div>
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                    action="{{ isset($partner) ? route('home-partners.update', $partner) : route('home-partners.store') }}"
                    class="space-y-6">
                    @csrf
                    @if (isset($partner))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Partner Name --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Partner Name
                            </label>
                            <input type="text" name="name" placeholder="e.g. Google, Microsoft"
                                value="{{ old('name', $partner->name ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold text-gray-700">
                        </div>

                        {{-- Icon Class --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Icon Class
                            </label>
                            <input type="text" name="icon" placeholder="e.g. fab fa-google"
                                value="{{ old('icon', $partner->icon ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-mono text-primary">
                            <p class="text-[10px] text-gray-400 mt-1 italic uppercase tracking-tighter">Use FontAwesome 5/6
                                classes</p>
                        </div>
                    </div>

                    {{-- Status Toggle --}}
                    <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-xl border border-gray-100 w-fit">
                        <div class="relative inline-flex h-6 w-11 items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" id="is_active"
                                {{ old('is_active', $partner->is_active ?? true) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary cursor-pointer">
                        </div>
                        <label for="is_active"
                            class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer">
                            Visible on Website
                        </label>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('home-partners.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-blue-100 hover:bg-blue-600 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ isset($partner) ? 'Update' : 'Save' }} Partner</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
