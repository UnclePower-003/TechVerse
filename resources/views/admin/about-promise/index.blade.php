@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-handshake mr-2 text-primary"></i> About Promises
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the core promises and values displayed in the about section.</p>
            </div>

            <a href="{{ route('about-promise.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#266eb1] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add Promise</span>
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center shadow-sm">
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
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">SN</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Icon</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Title</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Description</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-32">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse($promises as $promise)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- SN --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Icon --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-10 h-10 flex items-center justify-center bg-gray-100 rounded-lg text-primary border border-gray-200">
                                        <i class="{{ $promise->icon }} text-lg"></i>
                                    </div>
                                </td>

                                {{-- Title --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $promise->title }}</div>
                                </td>

                                {{-- Description --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600 line-clamp-1 max-w-xs">
                                        {{ $promise->description }}
                                    </div>
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($promise->is_active)
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-200 text-primary border border-indigo-100 uppercase tracking-tighter">
                                            Active
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-gray-100 text-gray-500 border border-gray-200 uppercase tracking-tighter">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- Edit --}}
                                        <a href="{{ route('about-promise.edit', $promise) }}"
                                            class="p-2 text-[#266eb1] hover:bg-blue-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Promise">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('about-promise.destroy', $promise) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this promise?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Promise">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-handshake text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No promises found.</p>
                                        <a href="{{ route('about-promise.create') }}"
                                            class="mt-2 text-primary hover:underline text-sm font-semibold">Create your first promise</a>
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