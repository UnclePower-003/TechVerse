@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-hand-pointer mr-2 text-primary"></i> Service Pick Items
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the featured icons and titles for your service selection
                    section.</p>
            </div>

            {{-- Add Button --}}
            <a href="{{ route('service-pick.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#266eb1] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add New Item</span>
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
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Icon</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Title</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse($items as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- Order --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $item->order }}
                                </td>

                                {{-- Icon --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="w-10 h-10 bg-blue-50 text-primary rounded-lg flex items-center justify-center">
                                        <i class="{{ $item->icon }} text-lg"></i>
                                    </div>
                                </td>

                                {{-- Title --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">
                                        {{ $item->title }}
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('service-pick.edit', $item->id) }}"
                                            class="p-2 text-[#266eb1] hover:bg-blue-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Item">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('service-pick.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this item?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Item">
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
                                        <i class="fas fa-mouse-pointer text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No service pick items found.</p>
                                        <a href="{{ route('service-pick.create') }}"
                                            class="mt-2 text-primary hover:underline text-sm font-semibold">
                                            Add your first item
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
