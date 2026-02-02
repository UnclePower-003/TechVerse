@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-5xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    {{ $project->title }}
                </h1>
                @if ($project->subtitle)
                    <p class="text-gray-500 mt-1">{{ $project->subtitle }}</p>
                @endif
            </div>

            {{-- Actions --}}
            <div class="flex gap-2">
                <a href="{{ route('projects.edit', $project) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 flex items-center gap-2">
                    <i class="fas fa-edit"></i> Edit
                </a>

                <form action="{{ route('projects.destroy', $project) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this project?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 flex items-center gap-2">
                        <i class="fas fa-trash-alt"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Sidebar --}}
            <div class="md:col-span-1 space-y-6">

                {{-- Image --}}
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                        class="w-full h-auto object-cover">
                </div>

                {{-- Badge & Completion --}}
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-4 space-y-2">
                    @if ($project->badge)
                        <span
                            class="px-2 py-1 bg-yellow-100 text-yellow-800 font-semibold rounded">{{ $project->badge }}</span>
                    @endif
                    <p class="text-sm text-gray-600"><strong>Completion:</strong> {{ $project->completion }}</p>
                </div>

                {{-- Quote --}}
                @if ($project->quote)
                    <div class="bg-gray-50 rounded-2xl border border-dashed border-gray-300 p-4 italic text-gray-700">
                        “{{ $project->quote }}”
                        @if ($project->quote_author)
                            <p class="text-sm font-semibold mt-2 text-gray-900">— {{ $project->quote_author }}</p>
                        @endif
                    </div>
                @endif

            </div>

            {{-- Main Details --}}
            <div class="md:col-span-2 space-y-6">

                {{-- Overview --}}
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-2">Overview</h2>
                    <p class="text-gray-700">{{ $project->overview }}</p>
                </div>

                {{-- Project Specifications --}}
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">Project Specifications</h2>
                    <ul class="space-y-3">
                        @foreach ($project->project_specifications as $spec)
                            <li class="border-l-4 border-blue-500 pl-3">
                                <strong>{{ $spec['title'] }}:</strong> {{ $spec['description'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Key Features --}}
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">Key Features</h2>
                    <ul class="list-disc list-inside space-y-1 text-gray-700">
                        @foreach ($project->key_features as $feature)
                            <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>

                {{-- Technical Details --}}
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">Technical Details</h2>
                    <p class="text-gray-700 whitespace-pre-wrap">{{ $project->technical_details }}</p>
                </div>

            </div>
        </div>
    </div>
@endsection
