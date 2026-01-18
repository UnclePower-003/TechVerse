@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('contact-choose.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Choose Cards</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-th-large mr-3 opacity-80"></i>
                    {{ $card->exists ? 'Edit Card' : 'Create New Card' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Configure the title, icon, and description for the contact section
                    cards.</p>
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

                <form
                    action="{{ $card->exists ? route('contact-choose.update', $card->id) : route('contact-choose.store') }}"
                    method="POST" class="space-y-6">
                    @csrf
                    @if ($card->exists)
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Title --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider ml-1">
                                Card Title
                            </label>
                            <input type="text" name="title" value="{{ old('title', $card->title) }}"
                                placeholder="e.g., Customer Support"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none transition-all"
                                required>
                        </div>

                        {{-- Icon --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider ml-1">
                                Icon (Font Awesome class)
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                    <i class="{{ old('icon', $card->icon ?? 'fas fa-icons') }}"></i>
                                </span>
                                <input type="text" name="icon" value="{{ old('icon', $card->icon) }}"
                                    placeholder="fas fa-headset"
                                    class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none transition-all"
                                    required>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider ml-1">
                            Description
                        </label>
                        <textarea name="description" rows="4" placeholder="Briefly describe what this card represents..."
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none transition-all"
                            required>{{ old('description', $card->description) }}</textarea>
                    </div>

                    {{-- Order --}}
                    <div class="w-full md:w-1/3 space-y-2">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider ml-1">
                            Display Order
                        </label>
                        <input type="number" name="order" value="{{ old('order', $card->order) }}" placeholder="0"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary outline-none transition-all">
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('contact-choose.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $card->exists ? 'Update Card' : 'Create Card' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
