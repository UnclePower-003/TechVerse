@extends('frontend.app')
@section('content')
    <title>Projects | TechVerse</title>
    @push('style')
        {{-- header --}}
        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes subtleZoom {
                from {
                    transform: scale(1.05);
                }

                to {
                    transform: scale(1.15);
                }
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            .animate-fade-up {
                animation: fadeInUp 0.8s ease-out forwards;
            }

            .delay-1 {
                animation-delay: 0.2s;
            }

            .delay-2 {
                animation-delay: 0.4s;
            }

            .delay-3 {
                animation-delay: 0.6s;
            }

            .hero-overlay {
                background: linear-gradient(to bottom, rgba(0, 0, 0, 0.4), rgba(15, 23, 42, 0.9));
            }

            .glass-card {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(8px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .bg-image-zoom {
                animation: subtleZoom 20s infinite alternate linear;
            }

            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
        </style>

        <style>
            .glass {
                background: rgba(30, 41, 59, 0.7);
                backdrop-filter: blur(12px);
            }

            .card-hover:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
            }

            /* Reveal Animation Styles */
            .reveal-up {
                transform: translateY(30px);
                transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
            }

            .reveal-up.active {
                opacity: 1;
                transform: translateY(0);
            }

            .trust-card:hover {
                background: linear-gradient(145deg, rgba(30, 41, 59, 0.7), rgba(15, 23, 42, 0.7));
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
            }
        </style>
    @endpush

    {{-- hero section 1 --}}
    <section class="bg-slate-900 font-sans antialiased text-white lg:hidden flex">
        <section class="relative min-h-screen w-full overflow-hidden flex items-center max-md:justify-center lg:pl-32">
            @if ($hero)
                <div class="absolute inset-0 z-0">
                    {{-- <img id="hero-bg-mobile"
                    src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=2000"
                    alt="Infrastructure" class="w-full h-full object-cover bg-image-zoom brightness-50"> --}}
                    <img id="hero-bg-mobile" src="{{ asset('storage/' . $hero->image) }}" alt="Infrastructure"
                        class="w-full h-full object-cover bg-image-zoom brightness-50">
                    <div class="absolute inset-0 hero-overlay"></div>
                </div>
            @endif

            <div class="absolute inset-0 z-10 px-4 flex justify-center text-center items-center">
                <div class="space-y-8">
                    @if ($header)
                        <div
                            class="animate-fade-up opacity-0 inline-flex items-center space-x-2 bg-blue-500/20 text-blue-400 px-4 py-1.5 rounded-full border border-blue-500/30 text-sm font-semibold tracking-wide">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                            {{-- <span>PROJECT PORTFOLIO</span> --}}
                            <span>{{ $header->small_title }}</span>
                        </div>

                        {{-- <h1 class="animate-fade-up delay-1 opacity-0 text-5xl md:text-7xl font-bold tracking-tight">
                            Projects
                        </h1> --}}
                        <h1 class="animate-fade-up delay-1 opacity-0 text-5xl md:text-7xl font-bold text-white">
                            {{ $header->main_title }}
                        </h1>

                        {{-- <p
                            class="animate-fade-up delay-2 opacity-0 text-lg md:text-xl text-slate-300 max-w-xl leading-relaxed">
                            Selected deployments across secure infrastructure, smart airports, ANPR rollouts, and integrated
                            buildings.
                        </p> --}}
                        <p class="animate-fade-up delay-2 opacity-0 text-lg md:text-xl text-slate-300 max-w-xl">
                            {{ $header->description }}
                        </p>

                        {{-- <div class="animate-fade-up delay-3 opacity-0 flex flex-wrap gap-4 justify-center pt-4">
                            <div
                                class="animate-float flex items-center space-x-2 text-slate-300 glass-card px-4 py-2 rounded-lg">
                                <i class="fa-solid fa-file-shield text-blue-500"></i>
                                <span class="text-sm font-medium">Documented</span>
                            </div>

                            <div
                                class="animate-float [animation-delay:0.2s] flex items-center space-x-2 text-slate-300 glass-card px-4 py-2 rounded-lg">
                                <i class="fa-solid fa-chart-line text-blue-500"></i>
                                <span class="text-sm font-medium">Monitored</span>
                            </div>

                            <div
                                class="animate-float [animation-delay:0.4s] flex items-center space-x-2 text-slate-300 glass-card px-4 py-2 rounded-lg">
                                <i class="fa-solid fa-handshake-angle text-blue-500"></i>
                                <span class="text-sm font-medium">SLA-backed</span>
                            </div>
                        </div> --}}
                        <div class="animate-fade-up delay-3 opacity-0 flex flex-wrap gap-4 justify-center pt-4">
                            @foreach ($header->badges ?? [] as $badge)
                                <div class="animate-float flex items-center space-x-2 text-slate-300 glass-card px-4 py-2 rounded-lg"
                                    style="animation-delay: {{ $badge['delay'] ?? '0s' }}">
                                    <i class="{{ $badge['icon'] }} text-blue-500"></i>
                                    <span class="text-sm font-medium">{{ $badge['text'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </section>

    {{-- hero section 2 --}}
    <section class="lg:block hidden">
        <div class="relative flex flex-col md:flex-row w-full h-[90vh]">
            {{-- left content --}}
            <div class="relative w-[45%] bg-[#0f172a] flex flex-col justify-center items-start text-left px-24 py-20 z-20">
                @if ($header)
                    <div class="space-y-8">
                        <div
                            class="animate-fade-up opacity-0 inline-flex items-center space-x-2 bg-blue-500/20 text-blue-400 px-4 py-1.5 rounded-full border border-blue-500/30 text-sm font-semibold tracking-wide">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                            {{-- <span>PROJECT PORTFOLIO</span> --}}
                            <span>{{ $header->small_title }}</span>
                        </div>

                        {{-- <h1
                            class="animate-fade-up delay-1 opacity-0 text-5xl md:text-7xl font-bold text-white tracking-tight">
                            Projects
                        </h1> --}}
                        <h1
                            class="animate-fade-up delay-1 opacity-0 text-5xl md:text-7xl font-bold text-white tracking-tight">
                            {{ $header->main_title }}
                        </h1>

                        {{-- <p
                            class="animate-fade-up delay-2 opacity-0 text-lg md:text-xl text-slate-300 max-w-xl leading-relaxed">
                            Selected deployments across secure infrastructure, smart airports, ANPR rollouts, and integrated
                            buildings.
                        </p> --}}
                        <p
                            class="animate-fade-up delay-2 opacity-0 text-lg md:text-xl text-slate-300 max-w-xl leading-relaxed">
                            {{ $header->description }}
                        </p>

                        {{-- <div class="animate-fade-up delay-3 opacity-0 flex flex-wrap gap-4 justify-start pt-4">
                            <div
                                class="animate-float flex items-center space-x-2 text-slate-300 glass-card px-4 py-2 rounded-lg">
                                <i class="fa-solid fa-file-shield text-blue-500"></i>
                                <span class="text-sm font-medium">Documented</span>
                            </div>

                            <div
                                class="animate-float [animation-delay:0.2s] flex items-center space-x-2 text-slate-300 glass-card px-4 py-2 rounded-lg">
                                <i class="fa-solid fa-chart-line text-blue-500"></i>
                                <span class="text-sm font-medium">Monitored</span>
                            </div>

                            <div
                                class="animate-float [animation-delay:0.4s] flex items-center space-x-2 text-slate-300 glass-card px-4 py-2 rounded-lg">
                                <i class="fa-solid fa-handshake-angle text-blue-500"></i>
                                <span class="text-sm font-medium">SLA-backed</span>
                            </div>
                        </div> --}}
                        <div class="animate-fade-up delay-3 opacity-0 flex flex-wrap gap-4 justify-start pt-4">
                            @foreach ($header->badges ?? [] as $index => $badge)
                                <div
                                    class="animate-float
                   {{ isset($badge['delay']) ? '[animation-delay:' . $badge['delay'] . ']' : '' }}
                   flex items-center space-x-2 text-slate-300 glass-card px-4 py-2 rounded-lg">

                                    <i class="{{ $badge['icon'] }} text-blue-500"></i>
                                    <span class="text-sm font-medium">{{ $badge['text'] }}</span>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @endif
            </div>
            {{-- right image  --}}
            <div class="relative md:w-[55%] h-full bg-[#0f172a] overflow-hidden">
                @if ($hero)
                    {{-- <div id=""
                    class="absolute inset-0 bg-cover bg-center transition-transform duration-500` hover:scale-105"
                    style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=2000');"> --}}
                    <div id=""
                        class="absolute inset-0 bg-cover bg-center transition-transform duration-500` hover:scale-105"
                        style="background-image: url('{{ asset('storage/' . $hero->image) }}');">

                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/20 via-[#0f172a]/40 to-[#0f172a]/80">
                        </div>
                    </div>
                @endif

                <svg class="hidden md:block absolute top-0 left-0 h-full w-48 lg:w-72 text-[#0f172a] fill-current z-30 pointer-events-none transform -translate-x-[1px]"
                    viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M 0 0 H 5 C 80 25, -20 75, 5 100 H 0 Z" />
                </svg>

                <svg class="block md:hidden absolute top-0 left-0 w-full h-32 text-white fill-current z-30 pointer-events-none transform -translate-y-[1px]"
                    viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M 0 0 V 5 C 25 80, 75 -20, 100 5 V 0 Z" />
                </svg>
            </div>
        </div>
    </section>

    {{-- projects section --}}
    <section class="p-3 py-16 ">
        {{-- header  --}}
        <div class="mx-auto container max-w-7xl flex justify-between max-sm:flex-col gap-6 mb-3">
            <div class="">
                <h1
                    class="font-bold text-5xl py-3 tracking-wide bg-clip-text text-transparent bg-gradient-to-r from-[#0f172a] to-blue-800">
                    Major Projects
                </h1>
                <p class='text-stone-500 text-lg tracking-wide '>All Projects</p>
            </div>
            <div>
                <a href="{{ route('contact') }}"
                    class="inline-block
              py-3 px-4 bg-blue-700 text-white rounded-xl font-bold cursor-pointer
              transition-transform duration-200
              hover:bg-blue-800
              active:scale-105">
                    Start a Project
                </a>
            </div>
        </div>
        {{-- Card section --}}
        <div class="mx-auto container max-w-7xl grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8  w-full pt-10">
            <!-- Project Card -->
            <a href="{{ route('cardsdetails') }}" target="_blank" rel="noopener noreferrer"
                class=" shadow-xl rounded-2xl card-hover transition-all duration-500 group overflow-hidden block">
                <!-- Project Image -->
                <div class="h-56 w-full overflow-hidden relative">
                    <img src="{{ asset('imagess/projects/janamaitri.png') }}" alt="Project Image"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-6">
                        <span
                            class="text-[10px] font-bold uppercase tracking-widest text-slate-50 bg-black/50 px-2 py-1 rounded  backdrop-blur-sm">
                            Secure Infrastructure
                        </span>
                    </div>
                </div>

                <div class="p-8 bg-white/20">
                    <h3 class="text-2xl font-bold mb-3 text-blue-800 transition">Janamatri Project</h3>
                    <p class="text-slate-400 mb-6 line-clamp-2 text-sm leading-relaxed">
                        A comprehensive secure infrastructure deployment for schools/ offices requiring high availability
                        and advanced security protocols.
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex gap-1.5">
                            <span
                                class="text-[10px]  text-blue-800 px-2 py-1 rounded border border-white/5">Encryption</span>
                            <span class="text-[10px]  text-blue-800 px-2 py-1 rounded border border-white/5">SLA</span>
                        </div>
                        <span class="text-blue-800 font-bold text-xs flex items-center gap-2">
                            VIEW DETAILS <i class="fas fa-arrow-right text-[8px]"></i>
                        </span>
                    </div>
                </div>
            </a>
        </div>

    </section>

    {{-- what we offer --}}
    <section class="bg-slate-900 py-24 px-6 overflow-hidden">
        <div class="max-w-6xl mx-auto">

            <div class="text-center mb-20">
                <h3 class="text-blue-500 font-semibold tracking-widest uppercase text-sm mb-3 opacity-0 reveal-up">
                    Our Best Qualities
                </h3>
                <h2 class="text-3xl md:text-5xl font-bold text-white opacity-0 reveal-up" style="transition-delay: 200ms;">
                    Why customers trust us
                </h2>
                <div class="w-20 h-1 bg-blue-600 mx-auto mt-6 rounded-full opacity-0 reveal-up"
                    style="transition-delay: 300ms;"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- <div class="trust-card group p-8 rounded-2xl bg-slate-800/40 border border-slate-700/50 hover:border-blue-500/50 transition-all duration-500 opacity-0 reveal-up"
                    style="transition-delay: 400ms;">
                    <div
                        class="w-14 h-14 bg-blue-500/10 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                        <i class="fa-solid fa-layer-group text-2xl text-blue-500"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">Resilient design</h4>
                    <p class="text-slate-400 leading-relaxed">
                        Redundant architectures with documented failover paths.
                    </p>
                </div>

                <div class="trust-card group p-8 rounded-2xl bg-slate-800/40 border border-slate-700/50 hover:border-blue-500/50 transition-all duration-500 opacity-0 reveal-up"
                    style="transition-delay: 600ms;">
                    <div
                        class="w-14 h-14 bg-blue-500/10 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                        <i class="fa-solid fa-gauge-high text-2xl text-blue-500"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">Operational SLAs</h4>
                    <p class="text-slate-400 leading-relaxed">
                        Clear uptime targets and monitored performance.
                    </p>
                </div>

                <div class="trust-card group p-8 rounded-2xl bg-slate-800/40 border border-slate-700/50 hover:border-blue-500/50 transition-all duration-500 opacity-0 reveal-up"
                    style="transition-delay: 800ms;">
                    <div
                        class="w-14 h-14 bg-blue-500/10 rounded-lg flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                        <i class="fa-solid fa-shield text-2xl text-blue-500"></i>
                    </div>
                    <h4 class="text-xl font-bold text-white mb-4">Secure deployments</h4>
                    <p class="text-slate-400 leading-relaxed">
                        Hardened configs, least-privilege access, and audits.
                    </p>
                </div> --}}

                @foreach ($qualities as $quality)
                    <div class="trust-card group p-8 rounded-2xl bg-slate-800/40 border border-slate-700/50
                    hover:border-blue-500/50 transition-all duration-500 opacity-0 reveal-up"
                        style="transition-delay: 800ms;">

                        <div
                            class="w-14 h-14 bg-blue-500/10 rounded-lg flex items-center justify-center mb-6
                        group-hover:scale-110 transition-transform duration-500">
                            <i class="{{ $quality->icon }} text-2xl text-blue-500"></i>
                        </div>

                        <h4 class="text-xl font-bold text-white mb-4">
                            {{ $quality->title }}
                        </h4>

                        <p class="text-slate-400 leading-relaxed">
                            {{ $quality->description }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('script')
        <script>
            // Intersection Observer to trigger animations on scroll
            const observerOptions = {
                threshold: 0.1
            };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-up').forEach((el) => {
                observer.observe(el);
            });
        </script>
    @endpush
@endsection
