@extends('frontend.app')

@section('content')
    <title>Home | TechVerse</title>
    @push('style')
        <!-- Custom CSS for Animations -->
        <style>
            html {
                scroll-behavior: smooth;
            }

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

            /* Reveal Animation Classes */
            .reveal {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
            }

            .reveal.active {
                opacity: 1;
                transform: translateY(0);
            }

            /* Staggered delays for grids */
            .delay-100 {
                transition-delay: 100ms;
            }

            .delay-200 {
                transition-delay: 200ms;
            }

            .delay-300 {
                transition-delay: 300ms;
            }

            .gpu-accelerated {
                will-change: transform;
                backface-visibility: hidden;
            }
        </style>
    @endpush

    <!-- Hero Section -->
    <section
        class="relative pt-10 pb-36 lg:pt-40 lg:pb-56 overflow-hidden text-[#d1e2f6] lg:h-[80vh] flex flex-col justify-center">

        <!-- Abstract Background -->
        <div class="absolute inset-0">

            {{-- <img src="{{ asset('imagess/heroimages/mobile.png') }}" alt="Network Background"
                class="w-full h-full object-cover md:hidden">

            <img src="{{ asset('imagess/heroimages/tablet.png') }}" alt="Network Background"
                class="w-full h-full object-cover lg:hidden">

            <img src="{{ asset('imagess/heroimages/image.png') }}" alt="Network Background"
                class="w-full h-full object-cover hidden lg:block"> --}}

            @if ($hero)
                <img src="{{ asset('storage/' . $hero->mobile_image) }}" class="w-full h-full object-cover md:hidden">

                <img src="{{ asset('storage/' . $hero->tablet_image) }}" class="w-full h-full object-cover lg:hidden">

                <img src="{{ asset('storage/' . $hero->desktop_image) }}" class="w-full h-full object-cover hidden lg:block">
            @endif

        </div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 lg:bg-gradient-to-r from-transparent via-black/5 to-black/70"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/40 to-black/70 lg:hidden"></div>

        <!-- Content Container -->
        <div class="relative z-10 w-full mx-auto px-4 sm:px-6 lg:px-20 text-left reveal active flex flex-col lg:flex-row">
            @if ($heroHeader)

                <div class="flex flex-col lg:items-start items-center justify-center text-center lg:text-left">

                    <div
                        class="reveal-on-scroll delay-100 inline-block px-3 py-1 mb-4 text-xs font-semibold tracking-wider text-[#d1e2f6] uppercase bg-[#1e293b] rounded-full border border-[#2563eb]">
                        Live Readiness • 24/7
                    </div>

                    <h1
                        class="reveal-on-scroll text-center lg:text-left text-black delay-200 text-4xl md:text-6xl font-bold tracking-tight mb-6 leading-tight">
                        <span class='md:text-white lg:text-black max-sm:text-black'> YOUR </span> TECH PARTNER<br>
                        <span class='md:text-white lg:text-black sm:text-black'>FOR</span>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-[#3b82f6] to-[#0ea5e9]">Success</span>
                    </h1>

                    <p
                        class="reveal-on-scroll delay-300 mt-4 text-sm md:text-xl lg:text-stone-800 text-slate-300 font-semibold max-w-xl leading-relaxed">
                        Cisco and Alcatel-Lucent networking, Hikvision surveillance, and resilient IT that keeps you
                        online—delivered with clear SLAs and 24/7 response.
                    </p>

                    <div
                        class="reveal-on-scroll delay-500 mt-10 flex flex-col sm:flex-row justify-center items-center lg:items-start lg:justify-start gap-4 w-full">
                        <a href="contact"
                            class="px-8 py-2 text-lg font-bold text-[#d1e2f6] bg-[#2563eb] rounded-lg hover:bg-[#3b82f6] transition shadow-lg shadow-[#2563eb]/40 text-center">
                            Get a quote
                        </a>
                        <a href="{{ route('contact') }}"
                            class="px-8 py-2 text-lg font-bold text-stone-600 border max-lg:bg-white lg:border-gray-500 rounded-lg hover:border-transparent lg:hover:bg-[#d1e2f6] hover:text-[#0f172a] transition text-center">
                            Talk to us
                        </a>
                    </div>
                </div>

        </div>
    </section>


    <!-- Stats Section -->
    <section class="relative -mt-20 z-10 px-4">
        <div
            class="max-w-6xl mx-auto bg-[#d1e2f6] rounded-2xl shadow-xl lg:p-5 p-8 grid grid-cols-1 md:grid-cols-3 gap-8 text-center border-b-4 border-[#2563eb] reveal">
            <div class="space-y-2">
                <div class="text-4xl font-bold text-[#0f172a]">10+ Years</div>
                <div class="text-gray-500 text-sm uppercase tracking-wide">Experience</div>
                <p class="text-gray-600 text-sm">Rapid on-site teams & Quality guarantee</p>
            </div>
            <div class="space-y-2 border-t md:border-t-0 md:border-l md:border-r border-stone-300 pt-4 md:pt-0">
                <div class="text-4xl font-bold text-[#2563eb]">99.9%</div>
                <div class="text-gray-500 text-sm uppercase tracking-wide">Network Uptime</div>
                <p class="text-gray-600 text-sm">Across monitored sites</p>
            </div>
            <div class="space-y-2 border-t md:border-t-0 pt-4 md:pt-0">
                <div class="text-4xl font-bold text-[#0f172a]">50+</div>
                <div class="text-gray-500 text-sm uppercase tracking-wide">Major Deployments</div>
                <p class="text-gray-600 text-sm">24/7 Support window with clear SLAs</p>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 bg-[#d1e2f6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 reveal">
                <h2 class="text-[#2563eb] font-semibold tracking-wide uppercase">Our Services</h2>
                <p class="mt-2 text-3xl font-bold text-[#0f172a] sm:text-4xl">Enterprise-Grade Rigor</p>
                <p class="mt-4 text-gray-600">Networking, CCTV, IT consultation, and rapid computer repair delivered by
                    certified engineers.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Service 1 -->
                <div
                    class="bg-[#e5effa] p-8 rounded-xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-stone-300 reveal delay-100 group">
                    <div
                        class="w-14 h-14 bg-[#d1e2f6] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#2563eb] transition">
                        <i class="fas fa-network-wired text-2xl text-[#2563eb] group-hover:text-[#d1e2f6] transition"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#0f172a] mb-3">Network Solutions</h3>
                    <p class="text-gray-600 mb-4 text-sm">Campus LAN/WAN, Wi‑Fi, secure routing.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 bg-[#d1e2f6] text-xs font-semibold rounded text-gray-600">Cisco</span>
                        <span class="px-2 py-1 bg-[#d1e2f6] text-xs font-semibold rounded text-gray-600">QoS</span>
                        <span class="px-2 py-1 bg-[#d1e2f6] text-xs font-semibold rounded text-gray-600">SD-WAN</span>
                    </div>
                </div>

                <!-- Service 2 -->
                <div
                    class="bg-[#e5effa] p-8 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-stone-300 reveal delay-200 group">
                    <div
                        class="w-14 h-14 bg-[#d1e2f6] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#2563eb] transition">
                        <i class="fas fa-video text-2xl text-[#2563eb] group-hover:text-[#d1e2f6] transition"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#0f172a] mb-3">CCTV Installation</h3>
                    <p class="text-gray-600 mb-4 text-sm">Design, deploy, monitor smart surveillance.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 bg-[#d1e2f6] text-xs font-semibold rounded text-gray-600">Hikvision</span>
                        <span class="px-2 py-1 bg-[#d1e2f6] text-xs font-semibold rounded text-gray-600">ANPR</span>
                        <span class="px-2 py-1 bg-[#d1e2f6] text-xs font-semibold rounded text-gray-600">VMS</span>
                    </div>
                </div>

                <!-- Service 3 -->
                <div
                    class="bg-[#e5effa] p-8 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-stone-300 reveal delay-300 group">
                    <div
                        class="w-14 h-14 bg-[#d1e2f6] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#2563eb] transition">
                        <i class="fas fa-user-shield text-2xl text-[#2563eb] group-hover:text-[#d1e2f6] transition"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#0f172a] mb-3">IT Consultation</h3>
                    <p class="text-gray-600 mb-4 text-sm">Audits, hardening, cloud/on-prem strategy.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 bg-[#d1e2f6] text-xs font-semibold rounded text-gray-600">Zero Trust</span>
                        <span class="px-2 py-1 bg-[#d1e2f6] text-xs font-semibold rounded text-gray-600">BCP/DR</span>
                    </div>
                </div>

                <!-- Service 4 -->
                <div
                    class="bg-[#e5effa] p-8 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-stone-300 reveal delay-100 group">
                    <div
                        class="w-14 h-14 bg-[#d1e2f6] rounded-lg flex items-center justify-center mb-6 group-hover:bg-[#2563eb] transition">
                        <i class="fas fa-microchip text-2xl text-[#2563eb] group-hover:text-[#d1e2f6] transition"></i>
                    </div>
                    <h3 class="text-xl font-bold text-[#0f172a] mb-3">Computer Repair</h3>
                    <p class="text-gray-600 mb-4 text-sm">Diagnostics, upgrades, rapid turnaround.</p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 bg-green-100 text-xs font-semibold rounded text-green-700">Same-day</span>
                        <span class="px-2 py-1 bg-[#d1e2f6] text-xs font-semibold rounded text-gray-600">On-site</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects"
        class="relative min-h-screen py-16 sm:py-20 lg:py-24 text-[var(--sky)] bg-[var(--slate)] overflow-hidden">

        <!-- Background Image -->
        <!-- Optimization: Removed fixed attachment if it was there, just absolute positioning -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-30"
            style="background-image: url('{{ asset('imagess/image.png') }}');">
        </div>

        <!-- Gradient Overlay (Faster than blur) -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#0f172a]/80 via-[#0f172a]/70 to-[var(--slate)]"></div>

        <!-- Content Container -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 mb-12 lg:mb-16 reveal">
                <div class="max-w-2xl">
                    <h2 class="text-[var(--royal)] font-bold tracking-wide uppercase text-sm sm:text-base">
                        Major Projects
                    </h2>
                    <p class="mt-2 text-2xl sm:text-3xl lg:text-4xl font-bold leading-tight text-white">
                        Secure Infrastructure & Integrated Buildings
                    </p>
                </div>
                <a href="#contact"
                    class="inline-flex items-center bg-[var(--royal)] py-2 px-6 rounded-xl text-[var(--sky)] hover:text-white transition-colors duration-300 font-medium group">
                    <span>Start a project</span>
                    <i
                        class="fas fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 lg:gap-8">

                <!-- Project 1 - Janamatri (Original - Unchanged) -->
                <div
                    class="bg-[#0f172a]/90 border border-white/10 rounded-xl sm:rounded-2xl overflow-hidden 
            hover:bg-[var(--royal)] hover:border-[var(--royal)] hover:shadow-2xl hover:shadow-[var(--royal)]
            transition-all duration-300 group reveal delay-100
            transform hover:-translate-y-1 gpu-accelerated">
                    <div class="p-6 sm:p-8">
                        <div class="flex justify-between items-start mb-4">
                            <span
                                class="text-[var(--sky)] font-semibold text-xs sm:text-sm uppercase tracking-wide group-hover:text-[var(--sky)]">
                                Secure Infra
                            </span>
                            <div
                                class="w-10 h-10 rounded-full group-hover:bg-[var(--sky)] bg-[var(--slate)] flex items-center justify-center border border-white/10 group-hover:border-[var(--royal)]">
                                <i
                                    class="fas fa-lock text-gray-400 group-hover:text-[var(--royal)] transition-colors duration-300"></i>
                            </div>
                        </div>
                        <h3
                            class="text-xl sm:text-2xl font-bold mb-2 text-white group-hover:text-[var(--sky)] transition-colors duration-300">
                            Janamatri Project
                        </h3>
                        <p class="text-gray-400 text-sm sm:text-base mb-6 leading-relaxed group-hover:text-gray-300">
                            Scalable, secure deployment initiative for critical infrastructure.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-3 py-1.5 group-hover:bg-[#0f172a]/20 bg-[var(--slate)] rounded-full text-xs font-medium text-gray-300 group-hover:border-[var(--royal)]/50 transition-colors">
                                High Availability
                            </span>
                            <span
                                class="px-3 py-1.5 group-hover:bg-[#0f172a]/20 bg-[var(--slate)] rounded-full text-xs font-medium text-gray-300 group-hover:border-[var(--royal)]/50 transition-colors">
                                Encryption
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Project 2 - Airport (Styles Updated) -->
                <div
                    class="bg-[#0f172a]/90 border border-white/10 rounded-xl sm:rounded-2xl overflow-hidden 
            hover:bg-[var(--royal)] hover:border-[var(--royal)] hover:shadow-2xl hover:shadow-[var(--royal)]
            transition-all duration-300 group reveal delay-200
            transform hover:-translate-y-1 gpu-accelerated">
                    <div class="p-6 sm:p-8">
                        <div class="flex justify-between items-start mb-4">
                            <span
                                class="text-[var(--sky)] font-semibold text-xs sm:text-sm uppercase tracking-wide group-hover:text-[var(--sky)]">
                                Airports
                            </span>
                            <div
                                class="w-10 h-10 rounded-full group-hover:bg-[var(--sky)] bg-[var(--slate)] flex items-center justify-center border border-white/10 group-hover:border-[var(--royal)]">
                                <i
                                    class="fas fa-plane-departure text-gray-400 group-hover:text-[var(--royal)] transition-colors duration-300"></i>
                            </div>
                        </div>
                        <h3
                            class="text-xl sm:text-2xl font-bold mb-2 text-white group-hover:text-[var(--sky)] transition-colors duration-300">
                            Tribhuvan Intl. Airport
                        </h3>
                        <p class="text-gray-400 text-sm sm:text-base mb-6 leading-relaxed group-hover:text-gray-300">
                            Smart communication systems and safety infrastructure upgrades.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-3 py-1.5 group-hover:bg-[#0f172a]/20 bg-[var(--slate)] rounded-full text-xs font-medium text-gray-300 group-hover:border-[var(--royal)]/50 transition-colors">
                                Redundancy
                            </span>
                            <span
                                class="px-3 py-1.5 group-hover:bg-[#0f172a]/20 bg-[var(--slate)] rounded-full text-xs font-medium text-gray-300 group-hover:border-[var(--royal)]/50 transition-colors">
                                24/7 Ops
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Project 3 - ANPR (Styles Updated) -->
                <div
                    class="bg-[#0f172a]/90 border border-white/10 rounded-xl sm:rounded-2xl overflow-hidden 
            hover:bg-[var(--royal)] hover:border-[var(--royal)] hover:shadow-2xl hover:shadow-[var(--royal)]
            transition-all duration-300 group reveal delay-100
            transform hover:-translate-y-1 gpu-accelerated">
                    <div class="p-6 sm:p-8">
                        <div class="flex justify-between items-start mb-4">
                            <span
                                class="text-[var(--sky)] font-semibold text-xs sm:text-sm uppercase tracking-wide group-hover:text-[var(--sky)]">
                                Smart City
                            </span>
                            <div
                                class="w-10 h-10 rounded-full group-hover:bg-[var(--sky)] bg-[var(--slate)] flex items-center justify-center border border-white/10 group-hover:border-[var(--royal)]">
                                <i
                                    class="fas fa-city text-gray-400 group-hover:text-[var(--royal)] transition-colors duration-300"></i>
                            </div>
                        </div>
                        <h3
                            class="text-xl sm:text-2xl font-bold mb-2 text-white group-hover:text-[var(--sky)] transition-colors duration-300">
                            ANPR Camera Distribution
                        </h3>
                        <p class="text-gray-400 text-sm sm:text-base mb-6 leading-relaxed group-hover:text-gray-300">
                            City-wide ANPR surveillance rollout for enhanced security.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-3 py-1.5 group-hover:bg-[#0f172a]/20 bg-[var(--slate)] rounded-full text-xs font-medium text-gray-300 group-hover:border-[var(--royal)]/50 transition-colors">
                                Edge AI
                            </span>
                            <span
                                class="px-3 py-1.5 group-hover:bg-[#0f172a]/20 bg-[var(--slate)] rounded-full text-xs font-medium text-gray-300 group-hover:border-[var(--royal)]/50 transition-colors">
                                Low-light
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Project 4 - Rising Builders (Styles Updated) -->
                <div
                    class="bg-[#0f172a]/90 border border-white/10 rounded-xl sm:rounded-2xl overflow-hidden 
            hover:bg-[var(--royal)] hover:border-[var(--royal)] hover:shadow-2xl hover:shadow-[var(--royal)]
            transition-all duration-300 group reveal delay-200
            transform hover:-translate-y-1 gpu-accelerated">
                    <div class="p-6 sm:p-8">
                        <div class="flex justify-between items-start mb-4">
                            <span
                                class="text-[var(--sky)] font-semibold text-xs sm:text-sm uppercase tracking-wide group-hover:text-[var(--sky)]">
                                BMS + CCTV
                            </span>
                            <div
                                class="w-10 h-10 rounded-full group-hover:bg-[var(--sky)] bg-[var(--slate)] flex items-center justify-center border border-white/10 group-hover:border-[var(--royal)]">
                                <i
                                    class="fas fa-building text-gray-400 group-hover:text-[var(--royal)] transition-colors duration-300"></i>
                            </div>
                        </div>
                        <h3
                            class="text-xl sm:text-2xl font-bold mb-2 text-white group-hover:text-[var(--sky)] transition-colors duration-300">
                            Rising Builders
                        </h3>
                        <p class="text-gray-400 text-sm sm:text-base mb-6 leading-relaxed group-hover:text-gray-300">
                            Integrated building management and surveillance systems.
                        </p>
                        <div class="flex flex-wrap gap-2">
                            <span
                                class="px-3 py-1.5 group-hover:bg-[#0f172a]/20 bg-[var(--slate)] rounded-full text-xs font-medium text-gray-300 group-hover:border-[var(--royal)]/50 transition-colors">
                                Access Control
                            </span>
                            <span
                                class="px-3 py-1.5 group-hover:bg-[#0f172a]/20 bg-[var(--slate)] rounded-full text-xs font-medium text-gray-300 group-hover:border-[var(--royal)]/50 transition-colors">
                                HVAC
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- View All Projects Link -->
            <div class="mt-12 text-center reveal delay-300">
                <a href="{{ route('projects') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 border border-[var(--royal)]/50 
                       rounded-full text-[var(--sky)] hover:bg-[var(--royal)] hover:text-white 
                       transition-all duration-300 font-medium">
                    <span>View All Projects</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section id="partners" class="py-16 bg-[#d1e2f6] border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-500 font-medium mb-8 uppercase tracking-widest text-xs reveal">Collaborations & Technology
                Partners</p>
            <div
                class="flex flex-wrap justify-center items-center gap-8 md:gap-16 reveal delay-100 grayscale hover:grayscale-0 transition-all duration-500">
                <!-- Using text representations as placeholders for logos -->
                <div class="font-bold text-xl text-gray-700 flex items-center gap-2"><i class="fas fa-handshake"></i>
                    Beyond
                    Tech Nepal</div>
                <div class="font-bold text-xl text-gray-700 flex items-center gap-2"><i class="fas fa-truck-loading"></i>
                    Dauha</div>
                <div class="font-bold text-xl text-gray-700 flex items-center gap-2"><i class="fas fa-eye"></i> Hikvision
                </div>
                <div class="font-bold text-xl text-gray-700 flex items-center gap-2"><i class="fas fa-server"></i> Cisco &
                    Alcatel-Lucent</div>
            </div>
        </div>
    </section>

    <!-- Rapid Deployment Banner -->
    <section class="bg-[#2563eb] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between">
            <div class="text-[#d1e2f6] mb-6 md:mb-0 text-center md:text-left">
                <h3 class="text-2xl font-bold">Need a rapid deployment?</h3>
                <p class="text-blue-100 mt-1">We can mobilize certified teams with clear SLAs and documentation.</p>
            </div>
            <a href="#contact"
                class="bg-[#d1e2f6] text-[#2563eb] px-6 py-3 rounded-lg font-bold shadow-lg hover:bg-[#d1e2f6] transition whitespace-nowrap">
                Start a project
            </a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-[#d1e2f6]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Info -->
                <div class="reveal">
                    <h2 class="text-[#2563eb] font-semibold tracking-wide uppercase mb-2">Why Us</h2>
                    <h3 class="text-4xl font-bold text-[#0f172a] mb-6">Get a quick quote</h3>
                    <p class="text-gray-600 mb-8 text-lg">Tell us what you need—networking, CCTV, IT consultation, or
                        product inquiry. Our engineers are ready to assist.</p>

                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-[#d1e2f6] rounded-full flex items-center justify-center text-[#2563eb] mr-4">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Visit Us</h4>
                                <p class="text-gray-600">Lazimpat-2, Kathmandu</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-[#d1e2f6] rounded-full flex items-center justify-center text-[#2563eb] mr-4">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Call Us</h4>
                                <p class="text-gray-600">9702651469</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-[#d1e2f6] rounded-full flex items-center justify-center text-[#2563eb] mr-4">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Email</h4>
                                <p class="text-gray-600">techverse@gmail.com</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 bg-[#d1e2f6] rounded-full flex items-center justify-center text-[#2563eb] mr-4">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Hours</h4>
                                <p class="text-gray-600">Sun–Fri 9am-6pm</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="bg-[#d1e2f6] p-8 rounded-2xl border border-stone-300 shadow-lg reveal delay-100">
                    <form action="#" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                            <input type="text" id="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#3b82f6] focus:ring-[#3b82f6] bg-[#d1e2f6] px-4 py-3 border outline-none transition"
                                placeholder="John Doe">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#3b82f6] focus:ring-[#3b82f6] bg-[#d1e2f6] px-4 py-3 border outline-none transition"
                                    placeholder="john@company.com">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone
                                    (optional)</label>
                                <input type="tel" id="phone"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#3b82f6] focus:ring-[#3b82f6] bg-[#d1e2f6] px-4 py-3 border outline-none transition"
                                    placeholder="98XXXXXXXX">
                            </div>
                        </div>
                        <div>
                            <label for="inquiry" class="block text-sm font-medium text-gray-700">Inquiry Type</label>
                            <select id="inquiry"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#3b82f6] focus:ring-[#3b82f6] bg-[#d1e2f6] px-4 py-3 border outline-none transition">
                                <option>Product Inquiry</option>
                                <option>Service Quote</option>
                                <option>Consultation</option>
                                <option>Support</option>
                            </select>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">Tell us about your
                                requirements</label>
                            <textarea id="message" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#3b82f6] focus:ring-[#3b82f6] bg-[#d1e2f6] px-4 py-3 border outline-none transition"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-[#2563eb] text-[#d1e2f6] py-3 px-4 rounded-md hover:bg-[#1e293b] font-bold transition shadow-lg shadow-[#3b82f6]/30">
                            Send Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- JavaScript for Interactions & Animations -->
    @push('script')
        <script>
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
            // --- Reveal on Scroll Animation (Intersection Observer) ---
            const revealElements = document.querySelectorAll('.reveal');

            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        // Optional: Stop observing once revealed
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                root: null,
                threshold: 0.15, // Trigger when 15% of element is visible
                rootMargin: "0px"
            });

            revealElements.forEach(el => revealObserver.observe(el));
        </script>
    @endpush
@endsection
