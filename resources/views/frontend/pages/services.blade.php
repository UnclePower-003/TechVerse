@extends('frontend.app')

@section('content')
    <title>Services | TechVerse</title>
    @push('style')
        <style>
            .perspective-1000 {
                perspective: 1000px;
            }

            /* --- 2. Scroll Reveal Animations --- */
            .reveal-on-scroll {
                opacity: 0;
                transform: translateY(40px) scale(0.98);
                transition: opacity 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94),
                    transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                will-change: opacity, transform;
            }

            .reveal-on-scroll.is-visible {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

            /* --- 3. Floating Animation for Hero Badges --- */
            @keyframes float {

                0%,
                100% {
                    transform: translateY(0px);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            .animate-float {
                animation: float 6s ease-in-out infinite;
            }

            .animate-float-delayed {
                animation: float 7s ease-in-out infinite 1s;
            }

            .animate-float-slow {
                animation: float 8s ease-in-out infinite 2s;
            }

            /* --- 4. Shimmer Effect for CTA Button --- */
            @keyframes shimmer {
                0% {
                    transform: translateX(-100%) skewX(-15deg);
                }

                100% {
                    transform: translateX(200%) skewX(-15deg);
                }
            }

            .btn-shimmer {
                position: relative;
                overflow: hidden;
            }

            .btn-shimmer::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 50%;
                height: 100%;
                background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.4), transparent);
                transform: translateX(-150%) skewX(-15deg);
            }

            .btn-shimmer:hover::after {
                animation: shimmer 1s ease-in-out;
            }

            /* --- 5. Staggered Delays --- */
            .delay-100 {
                transition-delay: 100ms;
            }

            .delay-200 {
                transition-delay: 200ms;
            }

            .delay-300 {
                transition-delay: 300ms;
            }

            .delay-500 {
                transition-delay: 500ms;
            }
        </style>
    @endpush

    <!-- Hero Section with Parallax Hook -->
    <header id="hero-section"
        class="relative pt-10 pb-20 lg:pt-36 lg:pb-32 bg-slate-900 overflow-hidden h-[95vh] flex items-center justify-center">

        <div class="absolute inset-0">

            {{-- <img src="{{ asset('imagess/heroimages/serviceM.png') }}" alt="Network Background"
                class="w-full h-full object-cover md:hidden">

            <img src="{{ asset('imagess/heroimages/serviceT.png') }}" alt="Network Background"
                class="w-full h-full object-cover lg:hidden">

            <img src="{{ asset('imagess/heroimages/service.png') }}" alt="Network Background"
                class="w-full h-full object-cover object-center hidden lg:block"> --}}

            @if ($hero)
                <img src="{{ asset('storage/' . $hero->mobile_image) }}" alt="Network Background"
                    class="w-full h-full object-cover md:hidden">

                <img src="{{ asset('storage/' . $hero->tablet_image) }}" alt="Network Background"
                    class="w-full h-full object-cover lg:hidden">

                <img src="{{ asset('storage/' . $hero->desktop_image) }}" alt="Network Background"
                    class="w-full h-full object-cover object-center hidden lg:block">
            @endif
        </div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 lg:bg-gradient-to-r from-transparent via-black/5 to-black/70"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/50  to-black/80 lg:hidden"></div>

        <!-- Mesh Texture -->
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LCAyNTUsIDI1NSwgMC4wNSkiLz48L3N2Zz4=')] opacity-30 z-0">
        </div>


        <div
            class="w-full text-center justify-center items-center lg:text-left lg:justify-start lg:items-start lg:px-20 px-4">

            @if ($header)
                <!-- Badge -->
                {{-- <div
                    class="reveal-on-scroll inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-slate-500 text-xs font-bold uppercase tracking-wider mb-6 border border-blue-400/30 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    Enterprise Rigor
                </div> --}}
                <div
                    class="reveal-on-scroll inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-slate-500 text-xs font-bold uppercase tracking-wider mb-6 border border-blue-400/30 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    {{ $header->badge_text }}

                </div>

                <!-- Headline -->
                {{-- <h1
                    class="reveal-on-scroll delay-100 text-4xl md:text-6xl font-extrabold text-slate-600 tracking-tight leading-tight mb-6 drop-shadow-lg">
                    Resilient Systems.<br>
                    <!-- Gradient Text -->
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-900 to-[var(--royal)] opacity-90">Clear
                        SLAs.</span>
                </h1> --}}
                <h1
                    class="reveal-on-scroll delay-100 text-4xl md:text-6xl font-extrabold text-slate-600 tracking-tight leading-tight mb-6 drop-shadow-lg">
                    {{ $header->heading_main }}.<br>
                    <!-- Gradient Text -->
                    <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-900 to-[var(--royal)] opacity-90">{{ $header->heading_gradient }}</span>
                </h1>

                <!-- Subtext -->
                {{-- <p
                    class="reveal-on-scroll delay-200 text-lg md:text-xl text-slate-300 lg:text-stone-600 font-bold mb-8 leading-relaxed lg:max-w-2xl ">
                    Networking, surveillance, consultation, and rapid repair delivered with documentation and 24/7 support.
                </p> --}}
                <p
                    class="reveal-on-scroll delay-200 text-lg md:text-xl text-slate-300 lg:text-stone-600 font-bold mb-8 leading-relaxed lg:max-w-2xl ">
                    {{ $header->description }}
                </p>

                <!-- Floating Glass Cards -->
                <div
                    class="reveal-on-scroll delay-300 flex flex-wrap justify-center lg:justify-start gap-4 text-sm font-medium text-white perspective-1000">

                    {{-- <div
                        class="animate-float flex items-center gap-3 bg-white/10 lg:bg-[var(--slate)] backdrop-blur-md px-5 py-3 rounded-lg border border-white/10 hover:bg-white/20 transition-all duration-300 shadow-lg shadow-black/5">
                        <i class="fa-solid fa-certificate text-blue-400"></i>
                        <span>Certified Engineers</span>
                    </div>

                    <div
                        class="animate-float-delayed flex items-center gap-3 bg-white/10 lg:bg-[var(--slate)] backdrop-blur-md px-5 py-3 rounded-lg border border-white/10 hover:bg-white/20 transition-all duration-300 shadow-lg shadow-black/5">
                        <i class="fa-solid fa-bolt text-blue-400"></i>
                        <span>Rapid Deployment</span>
                    </div>

                    <div
                        class="animate-float-slow flex items-center gap-3 bg-white/10 lg:bg-[var(--slate)] backdrop-blur-md px-5 py-3 rounded-lg border border-white/10 hover:bg-white/20 transition-all duration-300 shadow-lg shadow-black/5">
                        <i class="fa-solid fa-headset text-blue-400"></i>
                        <span>24/7 Support</span>
                    </div> --}}

                    @php
                        $features = $header->features;

                        // If it's a JSON string, decode it to array
                        if (is_string($features)) {
                            $features = json_decode($features, true) ?? [];
                        }
                    @endphp

                    @foreach ($features as $feature)
                        <div
                            class="animate-float-slow flex items-center gap-3 bg-white/10 lg:bg-[var(--slate)] backdrop-blur-md px-5 py-3 rounded-lg border border-white/10 hover:bg-white/20 transition-all duration-300 shadow-lg shadow-black/5">
                            <i class="{{ $feature['icon'] ?? '' }} text-blue-400"></i>
                            <span>{{ $feature['text'] ?? '' }}</span>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </header>

    <!-- Services Grid with 3D Tilt Effect -->
    <section class="py-24 bg-slate-50 relative overflow-hidden">
        <!-- Decorative Blob in background -->
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-[#d1e2f6] rounded-full mix-blend-multiply filter blur-3xl opacity-50 translate-y-1/2 -translate-x-1/2">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 reveal-on-scroll">
                <h2 class="text-3xl font-bold text-blue-900">What We Deliver</h2>
                <div class="h-1.5 w-56 bg-gradient-to-r from-blue-400 to-blue-600 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10 perspective-1000">

                <!-- Service 1: Networking -->
                <div
                    class=" reveal-on-scroll delay-100 group bg-white border border-slate-200 rounded-2xl p-8 shadow-xl shadow-black/20 hover:shadow-2xl hover:shadow-blue-900/50 cursor-pointer transition-all duration-500 relative overflow-hidden transform-style-3d">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 to-blue-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 ease-out origin-left">
                    </div>

                    <div
                        class="flex justify-between items-start mb-6 transform transition-transform duration-500 group-hover:translate-z-10">
                        <div
                            class="w-14 h-14 bg-[#eff6ff] text-blue-700 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-network-wired"></i>
                        </div>
                        <i
                            class="fa-solid fa-arrow-right text-slate-300 group-hover:text-blue-700 transition-colors transform group-hover:translate-x-1"></i>
                    </div>

                    <h3 class="text-2xl font-bold text-blue-900 mb-2">Networking</h3>
                    <p class="text-xs font-bold text-blue-500 uppercase tracking-wide mb-4">Campus LAN/WAN + Wi‑Fi</p>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        Secure routing, QoS, SD-WAN, and resilient topologies designed for maximum uptime.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">Cisco</span>
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">QoS</span>
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">SD-WAN</span>
                    </div>
                </div>

                <!-- Service 2: Surveillance -->
                <div
                    class=" reveal-on-scroll delay-200 group bg-white border border-slate-200 rounded-2xl p-8 shadow-xl shadow-black/20 hover:shadow-2xl hover:shadow-blue-900/50 cursor-pointer transition-all duration-500 relative overflow-hidden transform-style-3d">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 to-blue-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 ease-out origin-left">
                    </div>

                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-14 h-14 bg-[#eff6ff] text-blue-700 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-video"></i>
                        </div>
                        <i
                            class="fa-solid fa-arrow-right text-slate-300 group-hover:text-blue-700 transition-colors transform group-hover:translate-x-1"></i>
                    </div>

                    <h3 class="text-2xl font-bold text-blue-900 mb-2">Surveillance</h3>
                    <p class="text-xs font-bold text-blue-500 uppercase tracking-wide mb-4">CCTV Installation</p>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        Design, deploy, and monitor smart surveillance with advanced analytics and remote viewing.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">Hikvision</span>
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">ANPR</span>
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">VMS</span>
                    </div>
                </div>

                <!-- Service 3: Consultation -->
                <div
                    class=" reveal-on-scroll delay-100 group bg-white border border-slate-200 rounded-2xl p-8 shadow-xl shadow-black/20 hover:shadow-2xl hover:shadow-blue-900/50 cursor-pointer transition-all duration-500 relative overflow-hidden transform-style-3d">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 to-blue-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 ease-out origin-left">
                    </div>

                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-14 h-14 bg-[#eff6ff] text-blue-700 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-clipboard-check"></i>
                        </div>
                        <i
                            class="fa-solid fa-arrow-right text-slate-300 group-hover:text-blue-700 transition-colors transform group-hover:translate-x-1"></i>
                    </div>

                    <h3 class="text-2xl font-bold text-blue-900 mb-2">Consultation</h3>
                    <p class="text-xs font-bold text-blue-500 uppercase tracking-wide mb-4">IT Strategy & Hardening</p>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        Zero Trust architecture, BCP/DR planning, and cloud/on-prem guidance with full documentation.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">Zero
                            Trust</span>
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">BCP/DR</span>
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">M365</span>
                    </div>
                </div>

                <!-- Service 4: Support -->
                <div
                    class=" reveal-on-scroll delay-200 group bg-white border border-slate-200 rounded-2xl p-8 shadow-xl shadow-black/20 hover:shadow-2xl hover:shadow-blue-900/50 cursor-pointer transition-all duration-500 relative overflow-hidden transform-style-3d">
                    <div
                        class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-blue-600 to-blue-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 ease-out origin-left">
                    </div>

                    <div class="flex justify-between items-start mb-6">
                        <div
                            class="w-14 h-14 bg-[#eff6ff] text-blue-700 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </div>
                        <i
                            class="fa-solid fa-arrow-right text-slate-300 group-hover:text-blue-700 transition-colors transform group-hover:translate-x-1"></i>
                    </div>

                    <h3 class="text-2xl font-bold text-blue-900 mb-2">Support</h3>
                    <p class="text-xs font-bold text-blue-500 uppercase tracking-wide mb-4">Computer Repair</p>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        Diagnostics, upgrades, and rapid turnaround for teams to minimize downtime.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">Same-day</span>
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">Warranty</span>
                        <span
                            class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded border border-slate-200">On-site</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Why Teams Pick Us -->
    <section class="py-24 bg-[#d1e2f6] relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal-on-scroll">
                <h2 class="text-3xl font-bold text-blue-900">Why Teams Pick Us</h2>
                <p class="mt-4 text-blue-900 font-medium opacity-80">Documented • Monitored • SLA-backed</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Feature 1 -->
                <div
                    class="reveal-on-scroll delay-100 group bg-white/50 backdrop-blur-sm p-8 rounded-xl border border-white hover:bg-white shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-blue-800 text-white rounded-lg flex items-center justify-center text-xl mb-6 shadow-lg shadow-blue-800/20 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-compass-drafting"></i>
                    </div>
                    <h4 class="text-xl font-bold text-blue-900 mb-3">Design-first</h4>
                    <p class="text-slate-700 leading-relaxed text-sm">
                        Resilient architectures with complete handover docs and network diagrams. We don't guess; we
                        engineer.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="reveal-on-scroll delay-200 group bg-white/50 backdrop-blur-sm p-8 rounded-xl border border-white hover:bg-white shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-blue-800 text-white rounded-lg flex items-center justify-center text-xl mb-6 shadow-lg shadow-blue-800/20 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h4 class="text-xl font-bold text-blue-900 mb-3">Rapid response</h4>
                    <p class="text-slate-700 leading-relaxed text-sm">
                        On-site teams with clear escalation and communication. We are there when you need us most.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="reveal-on-scroll delay-300 group bg-white/50 backdrop-blur-sm p-8 rounded-xl border border-white hover:bg-white shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    <div
                        class="w-12 h-12 bg-blue-800 text-white rounded-lg flex items-center justify-center text-xl mb-6 shadow-lg shadow-blue-800/20 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="text-xl font-bold text-blue-900 mb-3">Quality guarantee</h4>
                    <p class="text-slate-700 leading-relaxed text-sm">
                        Validated configs, vetted vendors, and proactive monitoring to ensure enterprise-grade stability.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer CTA -->
    <section class="bg-slate-900 py-20 text-center text-white relative overflow-hidden">
        <!-- Background Gradient Burst -->
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-slate-900 z-0"></div>

        <div class="max-w-4xl mx-auto px-4 relative z-10 reveal-on-scroll">
            <h2 class="text-4xl font-bold mb-6 tracking-tight">Start Your Project Today</h2>
            <p class="text-blue-200 mb-10 text-lg font-light">Experience enterprise rigor with clear SLAs and rapid
                deployment.</p>

            <a href="{{ route('contact') }}">
                <button
                    class="btn-shimmer bg-blue-600 hover:bg-blue-500 text-white px-10 py-4 rounded-lg font-bold text-lg shadow-lg shadow-blue-600/30 transition-all duration-300 hover:scale-105 active:scale-95">
                    Contact Our Engineers <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>
                </button>
            </a>

        </div>
    </section>

    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                /**
                 * 1. Scroll Reveal Logic (Intersection Observer)
                 * Triggers animations when elements enter the viewport.
                 */
                const observerOptions = {
                    root: null,
                    rootMargin: '0px',
                    threshold: 0.15 // Trigger when 15% visible
                };

                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, observerOptions);

                document.querySelectorAll('.reveal-on-scroll').forEach(section => {
                    observer.observe(section);
                });

            });
        </script>
    @endpush
@endsection
