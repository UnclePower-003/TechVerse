@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-envelope-open-text mr-2 text-primary"></i> Contact Submissions
                </h1>
                <p class="text-sm text-gray-500 mt-1">Review and manage inquiries submitted through the contact form.</p>
            </div>
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
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Name</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Inquiry Type</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($submissions as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- SN --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                {{-- Name --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-gray-900">{{ $item->full_name }}</div>
                                </td>

                                {{-- Email --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $item->email }}</div>
                                </td>

                                {{-- Inquiry Type --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded border border-gray-200">
                                        {{ $item->inquiry_type }}
                                    </span>
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $item->created_at->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    @if ($item->is_read)
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded border border-green-200">
                                            Read
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded border border-yellow-200">
                                            Unread
                                        </span>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">

                                        {{-- View --}}
                                        <a href="{{ route('contact-submission.show', $item) }}"
                                            class="p-2 text-[#266eb1] hover:bg-blue-400 hover:text-white rounded-lg transition-all"
                                            title="View Submission">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- Mark Read / Undo --}}
                                        @if (!$item->is_read)
                                            <form action="{{ route('contact-submission.read', $item) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="p-2 text-green-600 hover:bg-green-500 hover:text-white rounded-lg transition-all"
                                                    title="Mark as Read">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('contact-submission.unread', $item) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="p-2 text-yellow-600 hover:bg-yellow-500 hover:text-white rounded-lg transition-all"
                                                    title="Mark as Unread">
                                                    <i class="fas fa-undo"></i>
                                                </button>
                                            </form>
                                        @endif

                                        {{-- Delete --}}
                                        <form action="{{ route('contact-submission.destroy', $item) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this submission?');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Submission">
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
                                        <i class="fas fa-inbox text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No contact submissions found.</p>
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
