@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('social-links.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Social Links</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-share-alt mr-3 opacity-80"></i>
                    {{ $link->exists ? 'Edit Social Link' : 'Create New Social Link' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure social media platforms, brand colors, and redirect URLs.
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
                    action="{{ $link->exists ? route('social-links.update', $link->id) : route('social-links.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($link->exists)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Icon Selection --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider ml-1">
                                Font Awesome Icon
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fab {{ old('icon', $link->icon ?? 'fa-link') }}"></i>
                                </span>
                                <input type="text" name="icon" value="{{ old('icon', $link->icon) }}"
                                    placeholder="fa-facebook-f"
                                    class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none transition-all"
                                    required>
                            </div>
                            <p class="text-[10px] text-gray-400 ml-1 font-medium">Use brand classes like: <span
                                    class="text-primary italic">fa-instagram, fa-twitter, fa-linkedin-in</span></p>
                        </div>

                        {{-- Hover Color --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider ml-1">
                                Brand Color (HEX or Tailwind)
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="fas fa-palette"></i>
                                </span>
                                <input type="text" name="hover_color"
                                    value="{{ old('hover_color', $link->hover_color) }}"
                                    placeholder="e.g., #1877F2 or blue-600"
                                    class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none transition-all"
                                    required>
                            </div>
                            <p class="text-[10px] text-gray-400 ml-1 font-medium">This color appears when users hover over
                                the icon.</p>
                        </div>
                    </div>

                    {{-- URL --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider ml-1">
                            Profile URL
                        </label>
                        <input type="text" name="url" value="{{ old('url', $link->url) }}"
                            placeholder="https://facebook.com/yourpage"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none transition-all"
                            required>
                    </div>

                    {{-- Display Order --}}
                    <div class="w-full md:w-1/3 space-y-2">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider ml-1">
                            Display Order
                        </label>
                        <input type="number" name="order" value="{{ old('order', $link->order) }}" placeholder="0"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none transition-all">
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('social-links.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $link->exists ? 'Update Link' : 'Save Link' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
