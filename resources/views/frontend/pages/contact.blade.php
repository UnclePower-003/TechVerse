@extends('frontend.app')
@section('content')
    <title>Contact | TechVerse</title>
    @push('style')
        <style>
            /* 2. ANIMATION UTILITIES */
            .reveal {
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.8s ease-out;
            }

            .reveal.active {
                opacity: 1;
                transform: translateY(0);
            }
        </style>
    @endpush

    <!-- Header / Hero -->
    <header class="bg-[var(--slate)] pt-32 pb-16 md:pt-40 md:pb-24 px-4 relative overflow-hidden h-[65vh]">

        <div class="absolute inset-0">

            {{-- <img src="{{ asset('imagess/heroimages/contactM.png') }}" alt="Network Background"
                class="w-full h-full object-cover md:hidden">

            <img src="{{ asset('imagess/heroimages/contactT.png') }}" alt="Network Background"
                class="w-full h-full object-cover lg:hidden">

            <img src="{{ asset('imagess/heroimages/contact.png') }}" alt="Network Background"
                class="w-full h-full object-cover object-center hidden lg:block"> --}}
            @if ($hero)
                <img src="{{ asset('storage/' . $hero->image_mobile) }}" alt="Contact"
                    class="w-full h-full object-cover md:hidden">
                <img src="{{ asset('storage/' . $hero->image_tablet) }}" alt="Contact"
                    class="w-full h-full object-cover lg:hidden">
                <img src="{{ asset('storage/' . $hero->image_desktop) }}" alt="Contact"
                    class="w-full h-full object-cover hidden lg:block">
            @endif
        </div>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 lg:bg-gradient-to-r from-transparent via-black/5 to-black/70"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/40 to-black/70 lg:hidden"></div>


        <div class="container mx-auto   ">
            <div class=" lg:text-left lg:px-20  text-center relative z-10 reveal">
                {{-- <h1 class="text-4xl md:text-5xl font-bold text-slate-700 mb-4 ">Contact Us</h1>
                <p class="text-[var(--sky)] lg:text-slate-600 font-bold text-lg md:text-xl max-w-2xl">
                    Tell us about your needs—networking, CCTV, IT consultation, or product inquiry. We respond within one
                    business day.
                </p> --}}

                @if ($header)
                    <h1 class="text-4xl md:text-5xl font-bold text-slate-700 mb-4">{{ $header->title }}</h1>
                    <p class="text-[var(--sky)] lg:text-slate-600 font-bold text-lg md:text-xl max-w-2xl">
                        {!! $header->description !!}
                    </p>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content: Form & Info -->
    <section class="py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">

                <!-- Left: Contact Form -->
                <div class="reveal">
                    <div class="bg-white p-8 rounded-2xl shadow-xl shadow-[var(--slate)]/5 border border-gray-100">
                        <h2 class="text-2xl font-bold mb-6 text-[var(--slate)]">Reach out</h2>

                        <form action="#" class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Full name</label>
                                    <input type="text" placeholder="John Doe"
                                        class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[var(--royal)] focus:ring-1 focus:ring-[var(--royal)] outline-none transition">
                                </div>
                                <!-- Phone -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Phone
                                        (optional)</label>
                                    <input type="tel" placeholder="+977 98..."
                                        class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[var(--royal)] focus:ring-1 focus:ring-[var(--royal)] outline-none transition">
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                                <input type="email" placeholder="john@company.com"
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[var(--royal)] focus:ring-1 focus:ring-[var(--royal)] outline-none transition">
                            </div>

                            <!-- Subject/Service Type -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Inquiry Type</label>
                                <select
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[var(--royal)] focus:ring-1 focus:ring-[var(--royal)] outline-none transition text-gray-600">
                                    <option>Product Inquiry</option>
                                    <option>Networking</option>
                                    <option>CCTV / Surveillance</option>
                                    <option>IT Consultation</option>
                                </select>
                            </div>

                            <!-- Message -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Tell us about your
                                    requirements</label>
                                <textarea rows="4" placeholder="How can we help you?"
                                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-[var(--royal)] focus:ring-1 focus:ring-[var(--royal)] outline-none transition"></textarea>
                            </div>

                            <button type="button"
                                class="w-full bg-[var(--royal)] text-white font-bold py-4 rounded-lg hover:bg-blue-700 transition shadow-lg shadow-[var(--royal)]/30">
                                Send Inquiry <i class="fa-solid fa-paper-plane ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right: Contact Info -->
                <div class="flex flex-col justify-between reveal" style="transition-delay: 100ms;">
                    <div>
                        <h2 class="text-2xl font-bold mb-8 text-[var(--slate)]">Visit or call</h2>

                        <!-- Info Cards -->
                        <div class="space-y-6">
                            <!-- Address -->
                            <div class="flex items-start">
                                <div
                                    class="w-12 h-12 rounded-lg bg-[var(--sky)]/30 text-[var(--royal)] flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-location-dot text-xl"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="font-bold text-lg">Lazimpat-2, Kathmandu</h3>
                                    <p class="text-gray-500">Sun–Fri 9am-6pm</p>
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="flex items-start">
                                <div
                                    class="w-12 h-12 rounded-lg bg-[var(--sky)]/30 text-[var(--royal)] flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-phone text-xl"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="font-bold text-lg">9702651469</h3>
                                    <p class="text-gray-500">Rapid on-site support</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex items-start">
                                <div
                                    class="w-12 h-12 rounded-lg bg-[var(--sky)]/30 text-[var(--royal)] flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-envelope text-xl"></i>
                                </div>
                                <div class="ml-5">
                                    <h3 class="font-bold text-lg">techverse@gmail.com</h3>
                                    <p class="text-gray-500">Responds within 24h</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mini Feature Box -->
                    <div class="mt-12 bg-[var(--slate)] rounded-xl p-8 text-white relative overflow-hidden">
                        <div class="absolute right-0 top-0 text-[var(--royal)] opacity-20 -mr-6 -mt-6">
                            <i class="fa-solid fa-headset text-9xl"></i>
                        </div>
                        <div class="relative z-10">
                            <h3 class="text-[var(--sky)] font-bold text-lg mb-4">Support Promise</h3>
                            <ul class="space-y-3">
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-[var(--royal)]"></i>
                                    24/7 Support</li>
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-[var(--royal)]"></i>
                                    Certified Engineers</li>
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-[var(--royal)]"></i>
                                    Rapid On-site</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-20 bg-[var(--sky)]/20 border-t border-[var(--sky)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl font-bold text-[var(--slate)]">Why customers choose us</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card 1 -->
                <div
                    class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition reveal border-t-4 border-[var(--royal)]">
                    <div class="mb-4 text-[var(--royal)]">
                        <i class="fa-solid fa-truck-fast text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2 text-[var(--slate)]">Fast delivery</h3>
                    <p class="text-sm text-gray-600">Quick turnaround for products and services to keep your business
                        running.</p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition reveal border-t-4 border-[var(--royal)]"
                    style="transition-delay: 100ms;">
                    <div class="mb-4 text-[var(--royal)]">
                        <i class="fa-solid fa-handshake text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2 text-[var(--slate)]">Trusted experience</h3>
                    <p class="text-sm text-gray-600">10+ years, thousands of satisfied customers, and enterprise-grade
                        vendors.</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition reveal border-t-4 border-[var(--royal)]"
                    style="transition-delay: 200ms;">
                    <div class="mb-4 text-[var(--royal)]">
                        <i class="fa-solid fa-medal text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2 text-[var(--slate)]">Quality guarantee</h3>
                    <p class="text-sm text-gray-600">Backed by warranties, validated configurations, and proactive
                        monitoring.</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition reveal border-t-4 border-[var(--royal)]"
                    style="transition-delay: 300ms;">
                    <div class="mb-4 text-[var(--royal)]">
                        <i class="fa-solid fa-clock text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2 text-[var(--slate)]">24/7 support</h3>
                    <p class="text-sm text-gray-600">Always-available assistance for critical incidents and SLAs you
                        can count on.</p>
                </div>
            </div>
        </div>
    </section>
    @push('script')
        <!-- JS for Animation -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                        }
                    });
                }, {
                    threshold: 0.1
                });

                document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
            });
        </script>
    @endpush
@endsection
