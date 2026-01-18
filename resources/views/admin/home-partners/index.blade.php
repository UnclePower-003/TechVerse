@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-handshake mr-2 text-primary"></i> Home Partners
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage the partner logos and brands displayed on the landing page.</p>
            </div>

            {{-- Add Button --}}
            <a href="{{ route('home-partners.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-blue-600 shadow-lg shadow-blue-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add Partner</span>
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
        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    {{-- Table Header --}}
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">SN</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Icon / Logo</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Partner Name</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($partners as $partner)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- Serial Number --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Icon --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div
                                        class="w-12 h-12 flex items-center justify-center bg-gray-50 text-gray-700 rounded-xl border border-gray-100 text-xl shadow-sm">
                                        <i class="{{ $partner->icon }}"></i>
                                    </div>
                                </td>

                                {{-- Name --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                                        {{ $partner->name }}
                                    </div>
                                </td>

                                {{-- Active Status --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    @if ($partner->is_active)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-400 border border-gray-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-1.5"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex justify-center items-center space-x-3">
                                        <a href="{{ route('home-partners.edit', $partner) }}"
                                            class="p-2 text-primary hover:bg-blue-50 rounded-lg transition-all"
                                            title="Edit Partner">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('home-partners.destroy', $partner) }}" method="POST"
                                            onsubmit="return confirm('Delete this partner logo?');" class="inline-block">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-400 hover:bg-red-50 hover:text-red-600 rounded-lg transition-all"
                                                title="Delete Partner">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-handshake-slash text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No partners listed yet.</p>
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
