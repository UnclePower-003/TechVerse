<!-- ====== NAVIGATION BAR ====== -->
<nav id="navbar" class="fixed w-full z-40 transition-all duration-300 nav-visible py-4 bg-[#d1e2f6] shadow-xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center z-50">
                <a href="{{ url('/') }}"
                    class="font-bold text-2xl tracking-tighter text-[#0f172a] group flex justify-center items-center gap-2">
                    <img src="{{ asset('imagess/logo.svg') }}" alt="Tech Verse Logo" class='w-14'>
                    <span class='bg-clip-text text-transparent bg-gradient-to-b from-black via-blue-800 to-black'>Tech
                        Verse</span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex space-x-8 items-center h-full">
                <!-- Navigation Links -->
                <a href="{{ route('home') }}"
                    class="font-medium transition hover:text-[#2563eb] {{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : 'text-stone-700' }}">
                    Home
                </a>

                <a href="{{ route('services') }}"
                    class="font-medium transition hover:text-[#2563eb] {{ request()->routeIs('services') ? 'text-blue-600 font-semibold' : 'text-stone-700' }}">
                    Services
                </a>

                <a href="{{ route('projects') }}"
                    class="font-medium transition hover:text-[#2563eb] {{ request()->routeIs('projects') ? 'text-blue-600 font-semibold' : 'text-stone-700' }}">
                    Projects
                </a>

                <!-- Products Dropdown Trigger -->
                <div id="product-trigger" class="h-full flex items-center cursor-pointer group relative">
                    <a href='{{ route('products') }}'
                        class="flex items-center space-x-1 font-medium transition
                        {{ request()->routeIs('products') ? 'text-blue-600 font-semibold' : 'text-stone-700 group-hover:text-[#2563eb]' }}">
                        <span>Products</span>
                        <i
                            class="fas fa-chevron-down text-xs transition-transform duration-200 group-hover:rotate-180"></i>
                    </a>
                </div>

                <a href="{{ route('about') }}"
                    class="font-medium transition hover:text-[#2563eb] {{ request()->routeIs('about') ? 'text-blue-600 font-semibold' : 'text-stone-700' }}">
                    About
                </a>
                <a href="{{ route('buildup') }}"
                    class="font-medium transition hover:text-[#2563eb] {{ request()->routeIs('about') ? 'text-blue-600 font-semibold' : 'text-stone-700' }}">
                    Build Own
                </a>

                <a href="{{ route('contact') }}"
                    class="bg-[#2563eb] text-white px-5 py-2.5 rounded-lg font-medium hover:bg-brand-800 transition shadow-lg shadow-brand-500/30">
                    Get a Quote
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <button id="hamburger"
                class="lg:hidden z-50 focus:outline-none w-8 h-8 flex flex-col justify-center gap-1.5 items-center"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="hamburger-line line-1"></span>
                <span class="hamburger-line line-2"></span>
                <span class="hamburger-line line-3"></span>
            </button>
        </div>
    </div>

    <!-- Desktop Mega Menu -->
    <div id="mega-menu" class="absolute left-0 top-20 w-full bg-[#d1e2f6] border-b border-gray-200 shadow-xl z-40">
        <div class="max-w-7xl mx-auto px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Menu Columns -->
                <div class="menu-column">
                    <h3 class="text-[#2563eb] font-bold uppercase text-xs tracking-wider mb-4">HDCVI CAMERAS</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-stone-700 hover:text-[#2563eb] transition flex items-center">DAHUA</a></li>
                        <li><a href="#"
                                class="text-stone-700 hover:text-[#2563eb] transition flex items-center">IP CCTV Kit</a>
                        </li>
                        <li><a href="#"
                                class="text-stone-700 hover:text-[#2563eb] transition flex items-center">Bullet Camera
                                8MP</a></li>
                    </ul>
                </div>

                <div class="menu-column">
                    <h3 class="text-[#2563eb] font-bold uppercase text-xs tracking-wider mb-4">XVRS</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-stone-700 hover:text-[#2563eb] transition flex items-center">DAHUA</a></li>
                    </ul>
                </div>

                <div class="menu-column">
                    <h3 class="text-[#2563eb] font-bold uppercase text-xs tracking-wider mb-4">Computers & Hardware</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-stone-700 hover:text-[#2563eb] transition flex items-center">Gaming PC</a>
                        </li>
                    </ul>
                </div>

                <div class="menu-column">
                    <h3 class="text-[#2563eb] font-bold uppercase text-xs tracking-wider mb-4">Security Systems</h3>
                    <ul class="space-y-3">
                        <li><a href="#"
                                class="text-stone-700 hover:text-[#2563eb] transition flex items-center">Biometric
                                Access Control</a></li>
                    </ul>
                </div>

                <!-- CTA Section -->
                <div class="bg-[#e5effa] p-6 rounded-xl border border-gray-100 shadow-2xl col-span-full lg:col-auto">
                    <h3 class="text-gray-900 font-bold mb-2">All Products</h3>
                    <p class="text-sm text-gray-500 mb-4">Check out our latest AI-integrated analytics dashboard and
                        other products.</p>
                    <a href="{{ route('products') }}"
                        class="text-[#2563eb] text-sm font-bold hover:underline flex items-center gap-2">
                        View All Products
                        <i class='fa-solid fa-arrow-right'></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div id="overlay"
    class="fixed inset-0 bg-black/60 z-30 opacity-0 invisible transition-all duration-300 backdrop-blur-sm"></div>

<!-- Mobile Slide-out Menu -->
<aside id="offCanvasMenu"
    class="fixed top-0 right-0 w-[85%] max-w-sm h-full z-50 transform translate-x-full transition-transform duration-300 ease-in-out shadow-2xl flex flex-col justify-between ">
    <!-- Mobile Header -->
    <div class="p-4 flex items-center justify-between bg-[#d1e2f6] shadow-xl rounded-l-xl">
        <a href="{{ url('/') }}"
            class="font-bold text-2xl tracking-tighter text-[#0f172a] group flex items-center gap-2">
            <img src="{{ asset('imagess/logo.svg') }}" alt="Tech Verse Logo" class='w-14'>
            <span class='bg-clip-text text-transparent bg-gradient-to-b from-black/70 via-blue-800 to-black'>Tech
                Verse</span>
        </a>
        <button id="closeBtn" class="text-gray-400 hover:text-[#2563eb] transition">
            <i class="fas fa-times text-2xl"></i>
        </button>
    </div>

    <!-- Mobile Navigation -->
    <div class="flex-1 overflow-y-auto bg-[#0f172a] rounded-l-xl">
        <div class="py-8 px-6 space-y-2 flex flex-col text-stone-200 text-lg font-medium">
            <!-- Mobile Links -->
            <a href="{{ url('/') }}"
                class="nav-link mobile-link  px-4 py-3 rounded-lg {{ request()->is(patterns: '/') ? 'rounded-lg bg-white/10' : '' }}">
                Home
            </a>

            <a href="{{ route('services') }}"
                class="nav-link mobile-link  px-4 py-3 rounded-lg {{ request()->is('services') ? 'rounded-lg bg-white/10' : '' }}">
                Services
            </a>

            <a href="{{ route('projects') }}"
                class="nav-link mobile-link  px-4 py-3 rounded-lg {{ request()->is('projects') ? 'rounded-lg bg-white/10' : '' }}">
                Projects
            </a>
            <a href="{{ route('products') }}"
                class="nav-link mobile-link  px-4 py-3 rounded-lg {{ request()->is('products') ? 'rounded-lg bg-white/10' : '' }}">
                Products</a>

            <a href="{{ route('about') }}"
                class="nav-link mobile-link  px-4 py-3 rounded-lg {{ request()->is('about') ? 'rounded-lg bg-white/10' : '' }}">
                About
            </a>

            <a href="{{ route('contact') }}"
                class="nav-link mobile-link  px-4 py-3 rounded-lg {{ request()->is('contact') ? 'rounded-lg bg-white/10' : '' }}">
                Contact
            </a>
        </div>

        <!-- Mobile Footer -->
        <div class="p-6 border-t border-gray-700">
            <a href="#contact"
                class="flex items-center justify-center w-full bg-[#2563eb] text-white font-bold py-3 rounded-lg hover:bg-brand-500 transition mb-4">
                Get a Quote
            </a>
            <div class="flex justify-center space-x-6 text-gray-400">
                <a href="#" class="hover:text-white transition"><i class="fab fa-facebook text-xl"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fab fa-linkedin text-xl"></i></a>
            </div>
        </div>
    </div>
</aside>
