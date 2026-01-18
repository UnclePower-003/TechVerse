@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-concierge-bell mr-2 text-primary"></i> Service List
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the specific services, descriptions, and categories shown in the
                    service section.</p>
            </div>

            {{-- Add Button --}}
            <a href="{{ route('service-list.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-blue-600 shadow-lg shadow-blue-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add Service</span>
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

        {{-- Table Section --}}
        {{-- Table Section --}}
        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    {{-- Table Header --}}
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">Icon</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Title & Subtitle
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Tags</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-24">Delay</th>
                            {{-- Added Status Header --}}
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-24">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($services as $service)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- Icon --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="w-10 h-10 flex items-center justify-center bg-blue-50 text-primary rounded-lg border border-blue-100 text-lg">
                                        <i class="{{ $service->icon }}"></i>
                                    </div>
                                </td>

                                {{-- Title & Subtitle --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                                        {{ $service->title }}</div>
                                    <div class="text-xs text-gray-500 truncate max-w-xs">{{ $service->subtitle }}</div>
                                </td>

                                {{-- Tags --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($service->tags ?? [] as $tag)
                                            <span
                                                class="px-2 py-0.5 bg-gray-100 text-gray-600 text-[10px] font-bold rounded uppercase border border-gray-200">
                                                {{ $tag }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>

                                {{-- Delay --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <span class="text-sm font-mono text-gray-400">{{ $service->animation_delay }}ms</span>
                                </td>

                                {{-- Added Status Column --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if ($service->is_active)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center items-center space-x-3">
                                        <a href="{{ route('service-list.edit', $service) }}"
                                            class="p-2 text-primary hover:bg-blue-50 rounded-lg transition-all"
                                            title="Edit Service">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('service-list.destroy', $service) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this service?');"
                                            class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-400 hover:bg-red-50 hover:text-red-600 rounded-lg transition-all"
                                                title="Delete Service">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center"> {{-- colspan increased to 6 --}}
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-layer-group text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No services found in the database.</p>
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
