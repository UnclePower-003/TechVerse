@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-share-alt mr-2 text-primary"></i> Social Links
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage your brand's social media presence and hover styles.</p>
            </div>

            {{-- Add Button --}}
            <a href="{{ route('social-links.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-blue-600 shadow-lg shadow-blue-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add Social Link</span>
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div
                class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
                <i class="fas fa-check-circle mr-2 text-green-500"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Table Section (Card Layout) --}}
        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    {{-- Table Header --}}
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">Order</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Platform</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">URL</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($links as $link)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- Order --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $link->order }}
                                </td>

                                {{-- Icon & Platform Info --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        {{-- Icon Preview Container --}}
                                        {{-- Logic: Checks if hover_color starts with '#' for HEX, otherwise treats it as a Tailwind class --}}
                                        <div class="w-10 h-10 flex items-center justify-center rounded-xl border border-gray-100 shadow-sm text-white {{ !str_starts_with($link->hover_color, '#') ? 'bg-' . $link->hover_color : '' }}"
                                            style="{{ str_starts_with($link->hover_color, '#') ? 'background-color: ' . $link->hover_color : '' }}">
                                            <i class="fab fa-{{ $link->icon }} text-lg"></i>
                                        </div>

                                        {{-- Platform Name & Subtext --}}
                                        <div>
                                            <div
                                                class="text-sm font-bold text-gray-900 uppercase tracking-tighter leading-none">
                                                {{ str_replace(['fa-', 'fab-'], '', $link->icon) }}
                                            </div>
                                            <div class="text-[10px] text-gray-400 font-medium mt-1 uppercase">
                                                {{ $link->hover_color }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- URL --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ $link->url }}" target="_blank"
                                        class="text-sm text-blue-500 hover:underline flex items-center space-x-1">
                                        <span>{{ Str::limit($link->url, 40) }}</span>
                                        <i class="fas fa-external-link-alt text-[10px] opacity-50"></i>
                                    </a>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center items-center space-x-3">
                                        {{-- Edit --}}
                                        <a href="{{ route('social-links.edit', $link->id) }}"
                                            class="p-2 text-primary hover:bg-blue-50 rounded-lg transition-all"
                                            title="Edit Link">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('social-links.destroy', $link->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this social link?');" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-400 hover:bg-red-50 hover:text-red-600 rounded-lg transition-all"
                                                title="Delete Link">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-link text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No social links added yet.</p>
                                        <a href="{{ route('social-links.create') }}"
                                            class="mt-2 text-primary hover:underline text-sm font-semibold">
                                            Add your first link
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
