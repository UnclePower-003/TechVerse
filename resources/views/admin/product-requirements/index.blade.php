@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-box mr-2 text-primary"></i> Product Requirements
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Review and manage submitted product requirements.
                </p>
            </div>
        </div>

        {{-- Success --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-hidden shadow-xl rounded-2xl border border-gray-200 bg-white">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase w-16">SN</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Phone</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Interest</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase w-40">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($submissions as $item)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 font-bold">{{ $item->full_name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->phone }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-gray-100 text-xs font-semibold rounded">
                                    {{ $item->interest }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->is_read)
                                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded">Read</span>
                                @else
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs rounded">Unread</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">

                                    <a href="{{ route('product-requirements.show', $item) }}"
                                        class="p-2 text-blue-600 hover:bg-blue-500 hover:text-white rounded-lg">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    @if (!$item->is_read)
                                        <form method="POST" action="{{ route('product-requirements.read', $item) }}">
                                            @csrf @method('PATCH')
                                            <button
                                                class="p-2 text-green-600 hover:bg-green-500 hover:text-white rounded-lg">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('product-requirements.unread', $item) }}">
                                            @csrf @method('PATCH')
                                            <button
                                                class="p-2 text-yellow-600 hover:bg-yellow-500 hover:text-white rounded-lg">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('product-requirements.destroy', $item) }}"
                                        onsubmit="return confirm('Delete this submission?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-500">
                                No product requirements found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
