@extends('frontend.app')

@section('content')
    <title>About | TechVerse</title>
    @push('style')
        <!-- Custom CSS for Animations -->
        <style>
            /* Animation Utilities */
            .reveal {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s ease-out;
            }

            .reveal.active {
                opacity: 1;
                transform: translateY(0);
            }

            .hover-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .hover-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.15), 0 8px 10px -6px rgba(37, 99, 235, 0.1);
            }

            /* Gradient Text */
            .text-gradient {
                background: linear-gradient(90deg, #2563eb, #60a5fa);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        </style>
    @endpush

    <section class="text-[var(--slate)] antialiased overflow-x-hidden">

        <header class="relative bg-[var(--slate)] overflow-hidden h-[90vh] p-3 flex items-center">
            <div class="absolute inset-0">
                @if ($hero)
                    {{-- <img src="{{ asset('imagess/heroimages/aboutM.png') }}" alt="Network Background"
                        class="w-full h-full object-cover md:hidden">

                    <img src="{{ asset('imagess/heroimages/aboutT.png') }}" alt="Network Background"
                        class="w-full h-full object-cover lg:hidden">

                    <img src="{{ asset('imagess/heroimages/about.png') }}" alt="Network Background"
                        class="w-full h-full object-cover object-center hidden lg:block"> --}}

                    @if ($hero->mobile_image)
                        <img src="{{ asset('storage/' . $hero->mobile_image) }}" class="w-full h-full object-cover md:hidden">
                    @endif

                    @if ($hero->tablet_image)
                        <img src="{{ asset('storage/' . $hero->tablet_image) }}"
                            class="w-full h-full object-cover lg:hidden hidden md:block">
                    @endif

                    @if ($hero->desktop_image)
                        <img src="{{ asset('storage/' . $hero->desktop_image) }}"
                            class="w-full h-full object-cover object-center hidden lg:block">
                    @endif
                @endif
            </div>

            <!-- Gradient Overlay -->
            <div class="absolute inset-0 lg:bg-gradient-to-r from-transparent via-black/5 to-black/70"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/40 to-black/70 lg:hidden"></div>

            <!-- Added max-w-3xl to control text width -->
            <div class="max-w-3xl lg:text-left text-center items-center lg:items-start lg:px-20 px-4 ">
                {{-- <h1 class="text-4xl md:text-6xl font-bold text-slate-600 mb-6 reveal">
                    About Tech Verse
                </h1>

                <p class="text-lg md:text-xl text-[var(--sky)] lg:text-slate-600 leading-relaxed reveal"
                    style="animation-delay: 100ms;">
                    Empowering businesses with secure, scalable technology since 2014. We specialize in networking,
                    surveillance, and resilient IT infrastructure.
                </p>

                <div class="mt-10 reveal" style="animation-delay: 200ms;">
                    <div
                        class="inline-flex items-center gap-2 md:text-sm text-[12px] font-semibold text-[var(--royal)] bg-[var(--sky)] px-4 py-2 rounded-full shadow-lg shadow-[#2563eb]/40">
                        <i class="fa-solid fa-certificate"></i> Certified Engineers & Rapid Delivery
                    </div>
                </div> --}}

                @if ($header)
                    <h1 class="text-4xl md:text-6xl font-bold text-slate-600 mb-6 reveal">
                        {{ $header->title }}
                    </h1>

                    <p class="text-lg md:text-xl text-[var(--sky)] lg:text-slate-600 leading-relaxed reveal"
                        style="animation-delay: 100ms;">
                        {{ $header->description }}
                    </p>

                    <div class="mt-10 reveal" style="animation-delay: 200ms;">
                        <div
                            class="inline-flex items-center gap-2 md:text-sm text-[12px] font-semibold text-[var(--royal)] bg-[var(--sky)] px-4 py-2 rounded-full shadow-lg shadow-[#2563eb]/40">
                            <i class="{{ $header->badge_icon }}"></i>
                            {{ $header->badge_text }}
                        </div>
                    </div>
                @endif
            </div>
        </header>

        <!-- Intro & Tech Stack -->
        <section class="py-20 bg-[var(--sky)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <!-- Who We Are -->
                    <div class="reveal">
                        <h2 class="text-3xl font-bold text-[var(--slate)] mb-6 border-l-4 border-[var(--royal)] pl-4">Who we
                            are
                        </h2>
                        <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                            A team of network, security, and systems engineers delivering high-availability solutions across
                            Nepal. From smart airports to city-wide ANPR, we design, deploy, and support mission-critical
                            systems.
                        </p>
                        <div class="flex flex-wrap gap-3 mt-8">
                            <span
                                class="px-4 py-2 bg-[var(--sky)] text-[var(--royal)] rounded-lg text-sm font-semibold border border-[var(--sky)]">Cisco
                                & Alcatel-Lucent</span>
                            <span
                                class="px-4 py-2 bg-[var(--sky)] text-[var(--royal)] rounded-lg text-sm font-semibold border border-[var(--sky)]">Hikvision</span>
                            <span
                                class="px-4 py-2 bg-[var(--sky)] text-[var(--royal)] rounded-lg text-sm font-semibold border border-[var(--sky)]">BCP/DR</span>
                            <span
                                class="px-4 py-2 bg-[var(--sky)] text-[var(--royal)] rounded-lg text-sm font-semibold border border-[var(--sky)]">Zero
                                Trust</span>
                        </div>
                    </div>

                    <!-- What Drives Us -->
                    <div class="bg-[var(--slate)] rounded-2xl p-8 md:p-12 text-white relative hover-card reveal"
                        style="transition-delay: 150ms;">
                        <div class="absolute top-6 right-8 text-[var(--royal)] opacity-20">
                            <i class="fa-solid fa-bolt text-9xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-[var(--sky)] mb-4">What drives us</h3>
                        <p class="text-gray-300 leading-relaxed mb-6">
                            Reliability, speed, and measurable outcomes. We pair best-in-class hardware with disciplined
                            project delivery, giving clients predictable uptime and clear SLAs.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3">
                                <i class="fa-solid fa-check text-[var(--royal)]"></i> Reliable Hardware
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fa-solid fa-check text-[var(--royal)]"></i> Disciplined Delivery
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fa-solid fa-check text-[var(--royal)]"></i> Predictable Uptime
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Highlights / Projects -->
        <section class="py-20 bg-[var(--sky)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 reveal">
                    <h2 class="text-[var(--royal)] font-bold tracking-wide uppercase text-sm mb-2">Portfolio</h2>
                    <h3 class="text-3xl md:text-4xl font-bold text-[var(--slate)]">Highlights & Installations</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-white p-8 rounded-xl shadow-sm border-t-4 border-[var(--royal)] hover-card reveal">
                        <div
                            class="w-12 h-12 bg-[var(--sky)] rounded-lg flex items-center justify-center mb-6 text-[var(--royal)]">
                            <i class="fa-solid fa-building-shield text-xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-[var(--slate)] mb-2">Major Installations</h4>
                        <p class="text-gray-600">Delivered secure networking and surveillance for KOICA, Cyber Bureau, and
                            large public-sector sites ensuring maximum security.</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white p-8 rounded-xl shadow-sm border-t-4 border-[var(--royal)] hover-card reveal"
                        style="transition-delay: 100ms;">
                        <div
                            class="w-12 h-12 bg-[var(--sky)] rounded-lg flex items-center justify-center mb-6 text-[var(--royal)]">
                            <i class="fa-solid fa-plane-departure text-xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-[var(--slate)] mb-2">Smart Airport Upgrades</h4>
                        <p class="text-gray-600">Tribhuvan International Airport: Implemented redundant comms, safety
                            integrations, and 24/7 monitored operations.</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white p-8 rounded-xl shadow-sm border-t-4 border-[var(--royal)] hover-card reveal"
                        style="transition-delay: 200ms;">
                        <div
                            class="w-12 h-12 bg-[var(--sky)] rounded-lg flex items-center justify-center mb-6 text-[var(--royal)]">
                            <i class="fa-solid fa-road text-xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-[var(--slate)] mb-2">City ANPR Rollout</h4>
                        <p class="text-gray-600">Deployed ANPR distribution with edge AI, low-light specialized cameras, and
                            centralized analytics for city management.</p>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-white p-8 rounded-xl shadow-sm border-t-4 border-[var(--royal)] hover-card reveal"
                        style="transition-delay: 300ms;">
                        <div
                            class="w-12 h-12 bg-[var(--sky)] rounded-lg flex items-center justify-center mb-6 text-[var(--royal)]">
                            <i class="fa-solid fa-city text-xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-[var(--slate)] mb-2">Integrated Buildings</h4>
                        <p class="text-gray-600">Rising Builders: Unified building management systems combining CCTV, access
                            control, and HVAC integrations.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Promise -->
        <section class="py-20 bg-[var(--sky)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16 reveal">
                    <h2 class="text-3xl md:text-4xl font-bold text-[var(--slate)]">Our Promise</h2>
                    <div class="w-20 h-1 bg-[var(--royal)] mx-auto mt-4 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature 1 -->
                    <div class="text-center reveal">
                        <div
                            class="mx-auto w-16 h-16 rounded-full bg-[var(--slate)] flex items-center justify-center text-white mb-4 shadow-lg shadow-[#2563eb]/40">
                            <i class="fa-solid fa-pen-ruler text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-lg mb-2">Design-first</h4>
                        <p class="text-sm text-gray-600 px-4">Resilient architectures with clear documentation.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="text-center reveal" style="transition-delay: 100ms;">
                        <div
                            class="mx-auto w-16 h-16 rounded-full bg-[var(--slate)] flex items-center justify-center text-white mb-4 shadow-lg shadow-[#2563eb]/40">
                            <i class="fa-solid fa-truck-fast text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-lg mb-2">Fast Delivery</h4>
                        <p class="text-sm text-gray-600 px-4">Rapid response and on-site support windows.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="text-center reveal" style="transition-delay: 200ms;">
                        <div
                            class="mx-auto w-16 h-16 rounded-full bg-[var(--slate)] flex items-center justify-center text-white mb-4 shadow-lg shadow-[#2563eb]/40">
                            <i class="fa-solid fa-headset text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-lg mb-2">24/7 Support</h4>
                        <p class="text-sm text-gray-600 px-4">Real humans, clear SLAs, and proactive monitoring.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="text-center reveal" style="transition-delay: 300ms;">
                        <div
                            class="mx-auto w-16 h-16 rounded-full bg-[var(--slate)] flex items-center justify-center text-white mb-4 shadow-lg shadow-[#2563eb]/40">
                            <i class="fa-solid fa-medal text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-lg mb-2">Quality Guarantee</h4>
                        <p class="text-sm text-gray-600 px-4">Vetted vendors and validated configurations.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="py-20 bg-[var(--slate)] text-center relative overflow-hidden">
            <!-- Decoration -->
            <div class="absolute inset-0 bg-[var(--royal)] opacity-5 pattern-grid-lg"></div>

            <div class="max-w-4xl mx-auto px-4 relative z-10 reveal">
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-8">Ready to upgrade your infrastructure?</h2>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}"
                        class="px-8 py-4 bg-[var(--royal)] text-white font-bold rounded-lg shadow-lg shadow-[#2563eb]/40 hover:bg-blue-600 transition transform hover:-translate-y-1">
                        Talk with our team
                    </a>
                    <a href="{{ route('projects') }}"
                        class="px-8 py-4 bg-transparent border-2 border-[var(--sky)] text-[var(--sky)] font-bold rounded-lg hover:bg-[var(--sky)] hover:text-[var(--slate)] transition transform hover:-translate-y-1">
                        See projects <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>




    </section>

    @push('script')
        <!-- JS for Scroll Animation -->
        <script>
            // Simple Intersection Observer for scroll animations
            document.addEventListener('DOMContentLoaded', () => {
                const reveals = document.querySelectorAll('.reveal');

                const revealOnScroll = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                            observer.unobserve(entry.target); // Only animate once
                        }
                    });
                }, {
                    threshold: 0.1,
                    rootMargin: "0px 0px -50px 0px"
                });

                reveals.forEach(reveal => {
                    revealOnScroll.observe(reveal);
                });
            });
        </script>
    @endpush
@endsection
