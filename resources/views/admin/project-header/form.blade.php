@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb --}}
        <div class="mb-6">
            <a href="{{ route('project-header.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Project Headers</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-heading mr-3 opacity-80"></i>
                    {{ $header ? 'Edit Project Header' : 'Create Project Header' }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">
                    Configure the title, description, and skill badges for your portfolio showcase.
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
                    action="{{ $header ? route('project-header.update', $header) : route('project-header.store') }}"
                    class="space-y-6">
                    @csrf
                    @if ($header)
                        @method('PUT')
                    @endif

                    <input type="hidden" name="is_active" value="0">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Small Title --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Small
                                Title</label>
                            <input type="text" name="small_title"
                                value="{{ old('small_title', $header->small_title ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none"
                                placeholder="e.g. OUR PORTFOLIO">
                        </div>

                        {{-- Main Title --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Main Title
                                *</label>
                            <input type="text" name="main_title" required
                                value="{{ old('main_title', $header->main_title ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold"
                                placeholder="e.g. Creative Projects">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none leading-relaxed"
                            placeholder="Briefly describe this section...">{{ old('description', $header->description ?? '') }}</textarea>
                    </div>

                    <hr class="border-gray-100">

                    {{-- Dynamic Badges Section --}}
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">
                                <i class="fas fa-tags mr-2 text-primary opacity-70"></i> Badges / Skills
                            </label>
                            <button type="button" onclick="addBadge()"
                                class="inline-flex items-center px-3 py-1 text-xs font-bold text-primary hover:bg-indigo-50 rounded-lg transition-colors uppercase">
                                <i class="fas fa-plus mr-1"></i> Add Badge
                            </button>
                        </div>

                        <div id="badge-container" class="space-y-3">
                            @php $badges = old('badges', $header->badges ?? []); @endphp

                            @forelse ($badges as $i => $badge)
                                <div
                                    class="badge-row grid grid-cols-12 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-100 items-center">
                                    <div class="col-span-4">
                                        <input name="badges[{{ $i }}][icon]"
                                            placeholder="Icon (e.g. fab fa-laravel)" value="{{ $badge['icon'] ?? '' }}"
                                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 outline-none focus:border-primary">
                                    </div>
                                    <div class="col-span-4">
                                        <input name="badges[{{ $i }}][text]"
                                            placeholder="Label (e.g. Web Design)" value="{{ $badge['text'] ?? '' }}"
                                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 outline-none focus:border-primary">
                                    </div>
                                    <div class="col-span-3">
                                        <input name="badges[{{ $i }}][delay]" placeholder="Delay (0.2s)"
                                            value="{{ $badge['delay'] ?? '' }}"
                                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 outline-none focus:border-primary">
                                    </div>
                                    <div class="col-span-1 text-right">
                                        <button type="button" onclick="this.parentElement.parentElement.remove()"
                                            class="text-gray-300 hover:text-red-500 transition-colors">
                                            <i class="fas fa-times-circle text-lg"></i>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <p id="no-badges-msg" class="text-xs text-gray-400 italic py-2">No badges added yet. Click
                                    "+ Add Badge" to start.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Active Toggle --}}
                    <div class="flex items-center space-x-3 py-2">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_active" value="1" id="isActive"
                                {{ old('is_active', $header->is_active ?? 0) ? 'checked' : '' }}
                                class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary cursor-pointer transition-all">
                        </div>
                        <label for="isActive"
                            class="text-sm font-bold text-gray-700 uppercase tracking-wider cursor-pointer select-none">
                            Set as Active Header
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('project-header.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>{{ $header ? 'Update' : 'Save' }} Header</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let badgeIndex = {{ count($badges) }};

        function addBadge() {
            const container = document.getElementById('badge-container');
            const msg = document.getElementById('no-badges-msg');
            if (msg) msg.remove();

            const html = `
            <div class="badge-row grid grid-cols-12 gap-3 p-4 bg-gray-50 rounded-xl border border-gray-100 items-center animate-fadeIn">
                <div class="col-span-4">
                    <input name="badges[${badgeIndex}][icon]" placeholder="Icon (e.g. fas fa-code)" 
                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 outline-none focus:border-primary">
                </div>
                <div class="col-span-4">
                    <input name="badges[${badgeIndex}][text]" placeholder="Label" 
                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 outline-none focus:border-primary">
                </div>
                <div class="col-span-3">
                    <input name="badges[${badgeIndex}][delay]" placeholder="0.2s" 
                        class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 outline-none focus:border-primary">
                </div>
                <div class="col-span-1 text-right">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-gray-300 hover:text-red-500 transition-colors">
                        <i class="fas fa-times-circle text-lg"></i>
                    </button>
                </div>
            </div>
        `;
            container.insertAdjacentHTML('beforeend', html);
            badgeIndex++;
        }
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
