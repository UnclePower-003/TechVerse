@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900">
                    <i class="fas fa-box-open mr-2 text-primary"></i> Requirement Details
                </h1>
                <p class="text-sm text-gray-500">
                    Received on {{ $productRequirement->created_at->format('M d, Y \a\t h:i A') }}
                </p>
            </div>

            <a href="{{ route('product-requirements.index') }}"
                class="bg-white border px-4 py-2 rounded-xl font-semibold hover:bg-gray-50">
                <i class="fas fa-arrow-left mr-1"></i> Back
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">

            {{-- Sidebar --}}
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow border">
                    <div class="bg-primary px-6 py-4 text-white text-xs font-bold uppercase">
                        Client Info
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="text-xs uppercase text-gray-400">Full Name</label>
                            <p class="font-semibold">{{ $productRequirement->full_name }}</p>
                        </div>
                        <div>
                            <label class="text-xs uppercase text-gray-400">Phone</label>
                            <p>{{ $productRequirement->phone }}</p>
                        </div>
                        <div>
                            <label class="text-xs uppercase text-gray-400">Interest</label>
                            <span class="px-2 py-1 bg-blue-50 text-primary text-xs rounded">
                                {{ $productRequirement->interest }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="bg-gray-50 rounded-2xl border p-6 space-y-3">
                    @if (!$productRequirement->is_read)
                        <form method="POST" action="{{ route('product-requirements.read', $productRequirement) }}">
                            @csrf @method('PATCH')
                            <button class="w-full bg-green-500 text-white py-2 rounded-xl">
                                Mark as Read
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('product-requirements.unread', $productRequirement) }}">
                            @csrf @method('PATCH')
                            <button class="w-full bg-yellow-500 text-white py-2 rounded-xl">
                                Mark as Unread
                            </button>
                        </form>
                    @endif

                    <form method="POST" action="{{ route('product-requirements.destroy', $productRequirement) }}"
                        onsubmit="return confirm('Delete permanently?')">
                        @csrf @method('DELETE')
                        <button class="w-full text-red-600 font-bold">
                            Delete Submission
                        </button>
                    </form>
                </div>
            </div>

            {{-- Message --}}
            <div class="md:col-span-2">
                <div class="bg-white rounded-2xl shadow border h-full">
                    <div class="border-b px-6 py-4 font-bold">
                        Requirement Message
                    </div>
                    <div class="p-6 whitespace-pre-wrap text-gray-700">
                        {{ $productRequirement->message }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
