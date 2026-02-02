@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                    <i class="fas fa-folder-open mr-2 text-primary"></i> Projects
                </h1>
                <p class="text-sm text-gray-500 mt-1">Manage all projects added to the portfolio.</p>
            </div>

            <a href="{{ route('projects.create') }}"
                class="flex items-center space-x-2 bg-primary text-white px-5 py-2.5 rounded-xl font-semibold transition-all hover:bg-[#266eb1] shadow-lg shadow-indigo-100 focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                <i class="fas fa-plus text-xs"></i>
                <span>Add Project</span>
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
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest w-16">SN</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Title & Subtitle
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Badge</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Completion</th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest">Date</th>
                            <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-widest w-40">Actions</th>
                        </tr>
                    </thead>

                    {{-- Table Body --}}
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($projects as $project)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                {{-- SN --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-400">
                                    {{ $loop->iteration + ($projects->currentPage() - 1) * $projects->perPage() }}
                                </td>

                                {{-- Title --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $project->title }}</div>
                                    <div class="text-xs text-gray-500">{{ Str::limit($project->subtitle, 40) }}</div>
                                </td>

                                {{-- Badge --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($project->badge)
                                        <span
                                            class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded border border-gray-200">
                                            {{ $project->badge }}
                                        </span>
                                    @else
                                        <span class="text-gray-300 text-xs italic">None</span>
                                    @endif
                                </td>

                                {{-- Completion Status --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-600">
                                        {{ $project->completion }}
                                    </span>
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $project->created_at->format('d M Y') }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center space-x-2">
                                        {{-- View --}}
                                        <a href="{{ route('projects.show', $project) }}"
                                            class="p-2 text-blue-600 hover:bg-blue-400 hover:text-white rounded-lg transition-all"
                                            title="View Project">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('projects.edit', $project) }}"
                                            class="p-2 text-[#266eb1] hover:bg-blue-400 hover:text-white rounded-lg transition-all"
                                            title="Edit Project">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this project?');"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all"
                                                title="Delete Project">
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
                                        <i class="fas fa-folder-open text-5xl text-gray-200 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No projects found.</p>
                                        <a href="{{ route('projects.create') }}"
                                            class="mt-2 text-primary hover:underline text-sm font-semibold">
                                            Add your first project
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($projects->hasPages())
                <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
