@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-chart-line mr-2 text-primary"></i> Home Statistics
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the counter values and achievement stats displayed on the home
                    page.</p>
            </div>

            {{-- Optional: Add Button (Styled to match your reference) --}}
            {{-- <a href="{{ route('home-stat.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#266eb1] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add Statistic</span>
            </a> --}}
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
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">SN</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Quantity / Value
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Label / Title</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse($stats as $stat)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- SN (Matched to Reference) --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Quantity (Matched to Hero Badge Style) --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 bg-gray-100 text-primary text-xs font-bold rounded border border-gray-200">
                                        {{ $stat->quantity }}
                                    </span>
                                </td>

                                {{-- Title (Matched to Hero Title Style) --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                                        {{ $stat->title }}
                                    </div>
                                </td>

                                {{-- Actions (Exact Match for Edit Button) --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{ route('home-stat.edit', $stat) }}"
                                            class="p-2 text-[#266eb1] hover:bg-blue-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Statistic">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-chart-bar text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No statistics found.</p>
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
