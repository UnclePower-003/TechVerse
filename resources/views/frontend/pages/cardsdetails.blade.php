@extends('frontend.app')

@section('content')
    @push('style')
        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-up {
                animation: fadeInUp 0.6s ease-out forwards;
            }

            .glass-card {
                background: rgba(30, 41, 59, 0.7);
                backdrop-filter: blur(10px);
            }

            .blue-gradient {
                background: linear-gradient(135deg, #0f172a, #1e293b);
                opacity: 60%;
            }
        </style>
    @endpush

    <section class="p-4">
        <div class="max-w-6xl mx-auto pt-6">

            {{-- Header --}}
            <header class="flex justify-between items-center mb-8 animate-fade-up">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold tracking-tight">{{ $project->title }}</h1>
                    @if ($project->badge)
                        <p class="text-[#0ea5e9] font-medium flex items-center gap-2 mt-1">
                            <i class="fas fa-shield-alt"></i> {{ $project->badge }}
                        </p>
                    @endif
                </div>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Main Column --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Image --}}
                    <div class="rounded-2xl overflow-hidden glass-card h-64 md:h-96 relative group animate-fade-up"
                        style="animation-delay: 0.1s">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] to-transparent opacity-60 z-10"></div>
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @if ($project->badge)
                            <div class="absolute bottom-6 left-6 z-20">
                                <span
                                    class="px-3 py-1 rounded-full text-xs text-slate-200 font-bold uppercase tracking-wider blue-gradient shadow-lg">{{ $project->badge }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Overview --}}
                    <section class="shadow-lg bg-white/20 p-6 md:p-8 rounded-2xl animate-fade-up"
                        style="animation-delay: 0.2s">
                        <h2 class="text-xl font-semibold text-stone-800 mb-4 border-l-4 border-[#0ea5e9] pl-4">Overview</h2>
                        <p class="text-stone-800 leading-relaxed text-lg">{{ $project->overview }}</p>
                    </section>

                    {{-- Key Features & Technical Details --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 animate-fade-up" style="animation-delay: 0.3s">
                        <div class="bg-white/20 shadow-lg p-6 rounded-2xl">
                            <h3 class="text-lg font-semibold mb-4 text-[#3b82f6]">Key Features</h3>
                            <ul class="space-y-3">
                                @if (!empty($project->key_features) && is_array($project->key_features))
                                    @foreach ($project->key_features as $feature)
                                        <li class="flex items-center gap-3 text-stone-800">
                                            <i class="fas fa-check-circle text-[#0ea5e9]"></i> {{ $feature }}
                                        </li>
                                    @endforeach
                                @else
                                    <li class="text-stone-500 text-sm italic">No features listed.</li>
                                @endif
                            </ul>
                        </div>

                        <div class="bg-white/20 shadow-lg p-6 rounded-2xl">
                            <h3 class="text-lg font-semibold mb-4 text-[#3b82f6]">Technical Details</h3>
                            <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-wrap">
                                {{ $project->technical_details }}</p>
                        </div>
                    </div>

                    {{-- Quote --}}
                    @if ($project->quote)
                        <section
                            class="bg-white/20 shadow-lg border-l-4 border-[#2563eb] p-8 rounded-r-2xl italic animate-fade-up"
                            style="animation-delay: 0.4s">
                            <i class="fas fa-quote-left text-3xl text-[#0ea5e9] mb-4 opacity-50"></i>
                            <p class="text-stone-800 text-lg mb-4">{{ $project->quote }}</p>
                            @if ($project->quote_author)
                                <cite class="text-sm font-semibold text-[#3b82f6] not-italic">—
                                    {{ $project->quote_author }}</cite>
                            @endif
                        </section>
                    @endif

                </div>

                {{-- Sidebar --}}
                <aside class="space-y-6">
                    <div class="bg-white/20 shadow-lg p-6 rounded-2xl sticky top-8 animate-fade-up"
                        style="animation-delay: 0.5s">
                        <h2 class="text-xl font-semibold mb-6">Project Specifications</h2>

                        <div class="space-y-6">
                            @if (!empty($project->project_specifications) && is_array($project->project_specifications))
                                @foreach ($project->project_specifications as $spec)
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-[#3b82f6]/10 flex items-center justify-center text-[#3b82f6]">
                                            <i class="fas fa-list"></i>
                                        </div>
                                        <div>
                                            {{-- Using ?? 'N/A' prevents errors if a specific key is missing --}}
                                            <p class="text-xs text-stone-800 uppercase font-bold">
                                                {{ $spec['title'] ?? 'Specification' }}
                                            </p>
                                            <p class="text-stone-800">
                                                {{ $spec['description'] ?? 'No details provided' }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-sm text-stone-500 italic">No specifications available.</p>
                            @endif

                            @if (!empty($project))
                                <div class="flex items-center gap-4 border-t border-slate-700 pt-6">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-red-600/10 flex items-center justify-center text-red-600">
                                        <i class="fas fa-flag-checkered"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-stone-800 uppercase font-bold">Completion</p>
                                        <p class="text-stone-600 font-semibold">
                                            {{ $project->completion ?? 'No completion date provided' }}</p>
                                    </div>
                            @endif
                        </div>

                        <div class="mt-8 space-y-3">
                            <button
                                class="w-full bg-[#3b82f6] text-white py-4 rounded-xl font-bold hover:shadow-[0_0_20px_rgba(14,165,233,0.4)] transition-all duration-300 transform hover:-translate-y-1">
                                Start Similar Project
                            </button>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @push('script')
    @endpush
@endsection
