@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">

        {{-- Header & Navigation --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-envelope mr-2 text-primary"></i> Submission Details
                </h1>
                <p class="text-sm text-gray-500 mt-1">Received on
                    {{ $contactSubmission->created_at->format('M d, Y \a\t h:i A') }}</p>
            </div>

            <a href="{{ route('contact-submission.index') }}"
                class="flex items-center space-x-2 bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-xl font-semibold transition-all hover:bg-gray-50 shadow-sm">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to List</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Sidebar: Contact Info --}}
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <div class="bg-primary px-6 py-4">
                        <h3 class="text-white font-bold uppercase tracking-widest text-xs">Sender Information</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Full Name</label>
                            <p class="text-gray-900 font-semibold">{{ $contactSubmission->full_name }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Email Address</label>
                            <p class="text-primary font-medium hover:underline">
                                <a href="mailto:{{ $contactSubmission->email }}">{{ $contactSubmission->email }}</a>
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Phone Number</label>
                            <p class="text-gray-900 font-medium">{{ $contactSubmission->phone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Inquiry Type</label>
                            <div class="mt-1">
                                <span
                                    class="px-2 py-1 bg-blue-50 text-primary text-xs font-bold rounded-lg border border-blue-100">
                                    {{ $contactSubmission->inquiry_type }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions Card --}}
                {{-- Quick Actions Card --}}
                <div class="bg-gray-50 rounded-2xl border border-dashed border-gray-300 p-6 space-y-4">

                    {{-- Mark Read / Unread --}}
                    @if (!$contactSubmission->is_read)
                        <form action="{{ route('contact-submission.read', $contactSubmission) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold text-sm py-2.5 rounded-xl flex items-center justify-center space-x-2 transition">
                                <i class="fas fa-check-circle"></i>
                                <span>Mark as Read</span>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('contact-submission.unread', $contactSubmission) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-semibold text-sm py-2.5 rounded-xl flex items-center justify-center space-x-2 transition">
                                <i class="fas fa-undo"></i>
                                <span>Mark as Unread</span>
                            </button>
                        </form>
                    @endif

                    {{-- Delete --}}
                    <form action="{{ route('contact-submission.destroy', $contactSubmission) }}" method="POST"
                        onsubmit="return confirm('Permanently delete this message?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full text-red-500 hover:text-red-700 font-bold text-sm flex items-center justify-center space-x-2">
                            <i class="fas fa-trash-alt"></i>
                            <span>Delete Submission</span>
                        </button>
                    </form>

                </div>

            </div>

            {{-- Main Content: Message --}}
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 h-full">
                    <div class="border-b border-gray-100 px-8 py-5">
                        <h3 class="text-lg font-bold text-gray-900">Message Content</h3>
                    </div>
                    <div class="p-2">
                        <div class="prose prose-blue max-w-none text-gray-700 leading-relaxed whitespace-pre-wrap">
                            {{ $contactSubmission->message }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
