@extends('admin.layouts.app')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">
        {{-- Breadcrumb/Back Link --}}
        <div class="mb-6">
            <a href="{{ route('home-stat.index') }}"
                class="text-sm text-primary hover:text-blue-500 transition-colors flex items-center space-x-1 font-semibold">
                <i class="fas fa-arrow-left text-xs"></i>
                <span>Back to Statistics</span>
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
            {{-- Form Header --}}
            <div class="bg-primary px-8 py-6">
                <h1 class="text-2xl font-bold text-white tracking-tight flex items-center">
                    <i class="fas fa-chart-bar mr-3 opacity-80"></i>
                    Edit Statistic: {{ $stat->title }}
                </h1>
                <p class="text-indigo-100/80 text-sm mt-1">Update the numerical value and labels for this homepage counter.
                </p>
            </div>

            <div class="p-8">
                {{-- Display Errors --}}
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 text-red-800 rounded-r-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span class="font-bold">Please correct the following:</span>
                        </div>
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('home-stat.update', $stat) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Quantity/Value --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Quantity / Value
                            </label>
                            <input type="text" name="quantity" placeholder="e.g. 500+"
                                value="{{ old('quantity', $stat->quantity) }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none font-bold text-primary">
                            <p class="text-xs text-gray-400 mt-1 italic">Include symbols if needed (e.g., +, %)</p>
                        </div>

                        {{-- Title/Label --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                                Title / Label
                            </label>
                            <input type="text" name="title" placeholder="e.g. Happy Clients"
                                value="{{ old('title', $stat->title) }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">
                            Description
                        </label>
                        <textarea name="description" rows="3" placeholder="Brief context for this statistic..."
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-primary focus:border-primary transition-all outline-none">{{ old('description', $stat->description) }}</textarea>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-100 mt-8">
                        <a href="{{ route('home-stat.index') }}"
                            class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-blue-500 transition-all flex items-center space-x-2">
                            <i class="fas fa-save text-sm"></i>
                            <span>Update Statistic</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
