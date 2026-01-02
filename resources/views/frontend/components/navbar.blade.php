<section class="fixed w-full z-[100] bg-gray-50 text-slate-800 font-sans antialiased">
               <!-- TOP BAR (Contact Info) -->
            <div class="bg-[#08379b] text-white text-xs py-2 hidden md:block">
                <div class="container mx-auto px-6 flex justify-between items-center">
                    <div class="flex gap-4">
                        <span><i class="fas fa-envelope mr-2"></i>support@techserve.com</span>
                        <span><i class="fas fa-phone mr-2"></i>+1 (800) 123-4567</span>
                    </div>
                    <div class="flex gap-4">
                        <span>Expert Installation Services Available</span>
                        <div class="flex gap-3">
                            <a href="#" class="hover:text-gray-300"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="hover:text-gray-300"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="hover:text-gray-300"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </div>
    <!-- NAVIGATION -->
    <nav
        class="bg-[#cee2f9] fixed w-full z-[100] shadow-lg transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2 cursor-pointer group">
                    <a href='{{ url('/') }}'
                        class="rounded-lg flex items-center justify-center group-hover:rotate-3 transition-transform duration-300">
                        <img src="{{ asset('imagess/logo.png') }}" alt="Logo" class="mr-2 h-10">
                        <!-- Added h-10 for sizing -->
                    </a>
                </div>

                <!-- DESKTOP MENU -->
                <div class="hidden lg:block">
                    <div class="ml-10 flex items-baseline space-x-6">
                        <a href="{{ url('/') }}"
                            class="text-stone-600 hover:text-stone-700 px-3 py-2 rounded-md text-sm font-semibold transition-colors">Home</a>
                        <a href="{{ route('services') }}"
                            class="text-stone-600 hover:text-stone-700 px-3 py-2 rounded-md text-sm font-semibold transition-colors">Services</a>
                        <a href="{{ route('services') }}"
                            class="text-stone-600 hover:text-stone-700 px-3 py-2 rounded-md text-sm font-semibold transition-colors">Projects</a>

                        <!-- Dropdown (Products) -->
                        <div class="static group" id="productDropdownWrapper">
                            <button onclick="toggleDropdown()"
                                class="text-stone-600 group-hover:text-stone-700 px-3 py-2 rounded-md text-sm font-semibold inline-flex items-center gap-2 outline-none focus:text-stone-900">
                                <span>Products</span>
                                <i
                                    class="fa-solid fa-chevron-down text-[10px] opacity-70 chevron-icon transition-transform duration-300"></i>
                            </button>
                            <!-- Dropdown Content -->
                            <div id="productDropdown"
                                class="desktop-dropdown absolute left-0 right-0 top-full w-full bg-white border-t border-gray-100 shadow-2xl overflow-hidden">
                                <div class="mx-auto max-w-7xl px-8 py-8">
                                    <div class="grid grid-cols-4 gap-8">
                                        <!-- Column 1 -->
                                        <div>
                                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">
                                                Core Platform</h3>
                                            <ul class="space-y-3">
                                                <li><a href="#"
                                                        class="text-sm text-gray-600 hover:text-[#0b5ffa] block">Analytics</a>
                                                </li>
                                                <li><a href="#"
                                                        class="text-sm text-gray-600 hover:text-[#0b5ffa] block">Management</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Column 2 -->
                                        <div>
                                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">
                                                Solutions</h3>
                                            <ul class="space-y-3">
                                                <li><a href="#"
                                                        class="text-sm text-gray-600 hover:text-[#0b5ffa] block">Marketing</a>
                                                </li>
                                                <li><a href="#"
                                                        class="text-sm text-gray-600 hover:text-[#0b5ffa] block">Enterprise</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Column 3 -->
                                        <div>
                                            <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4">
                                                Resources</h3>
                                            <ul class="space-y-3">
                                                <li><a href="#"
                                                        class="text-sm text-gray-600 hover:text-[#0b5ffa] block">Community</a>
                                                </li>
                                                <li><a href="#"
                                                        class="text-sm text-gray-600 hover:text-[#0b5ffa] block">Help
                                                        Center</a></li>
                                            </ul>
                                        </div>
                                        <!-- Column 4 -->
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <h3 class="text-sm font-bold text-gray-900 mb-2">New Feature</h3>
                                            <p class="text-xs text-gray-500 mb-3">Check out our latest dashboard update
                                                available now.</p>
                                            <a href="#"
                                                class="text-sm font-semibold text-[#0b5ffa] hover:underline">Learn more
                                                &rarr;</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="#"
                            class="text-stone-600 hover:text-stone-700 px-3 py-2 rounded-md text-sm font-semibold transition-colors">About</a>
                        <a href="{{ route('services') }}"
                            class="text-stone-600 hover:text-stone-700 px-3 py-2 rounded-md text-sm font-semibold transition-colors">Contact</a>
                    </div>
                </div>

                <!-- CTA Button Desktop -->
                <div class="hidden lg:block">
                    <a href="#"
                        class="bg-[#08379b] hover:bg-[#062a78] text-white px-5 py-2.5 rounded-full text-sm font-bold shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                        Get Started
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 flex lg:hidden">
                    <button type="button" id="mobile-toggle"
                        class="bg-transparent inline-flex items-center justify-center px-3 py-1 rounded-md text-stone-600 hover:text-stone-700 hover:bg-black/20 focus:outline-none transition-colors">
                        <span class="sr-only">Open main menu</span>
                        <i id="burger-icon" class="fa-solid fa-bars text-2xl"></i>
                        <i id="close-icon" class="fa-solid fa-times text-2xl hidden"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- MOBILE MENU OVERLAY -->
        <div id="mobile-menu"
            class="hidden lg:hidden fixed inset-0 top-20 md:top-28 bg-[#0b5ffa] z-40 overflow-y-auto h-[calc(100vh-5rem)]">
            <div class="px-4 pt-4 pb-12 space-y-2">
                <a href="{{ url('/') }}"
                    class="text-white block px-3 py-4 rounded-lg text-lg font-medium hover:bg-[#08379b] transition-colors border-b border-white/10">Home</a>
                <a href="{{ route('services') }}"
                    class="text-white block px-3 py-4 rounded-lg text-lg font-medium hover:bg-[#08379b] transition-colors border-b border-white/10">Services</a>
                <a href="{{ route('services') }}"
                    class="text-white block px-3 py-4 rounded-lg text-lg font-medium hover:bg-[#08379b] transition-colors border-b border-white/10">Projects</a>
                <!-- Mobile Accordion 1 -->
                <div class="lg:hidden w-full border-b border-white/10">
                    <!-- Mobile Trigger Button -->
                    <button onclick="toggleMobileProducts()"
                        class="w-full flex justify-between items-center py-4 px-4 text-left text-lg font-semibold text-neutral-50 rounded-lg hover:bg-[#08379b] transition-colors">
                        <span>Products</span>
                        <!-- Icon that rotates when open -->
                        <i id="mobileChevron"
                            class="fa-solid fa-chevron-down text-xs transition-transform duration-300"></i>
                    </button>

                    <!-- Mobile Accordion Content -->
                    <div id="mobileProductContent" class="hidden  px-4 pb-6 space-y-6">

                        <!-- Section 1 -->
                        <div class="pt-2">
                            <h3 class="text-xs font-bold text-neutral-50 uppercase tracking-wider mb-3">Core Platform
                            </h3>
                            <ul class="space-y-3 border-l-2 border-gray-100 pl-1">
                                <li><a href="#"
                                        class="text-sm text-neutral-50 block font-medium py-3 rounded-lg hover:bg-[#08379b] transition-colors pl-4">Analytics</a>
                                </li>
                                <li><a href="#"
                                        class="text-sm text-neutral-50 block font-medium py-3 rounded-lg hover:bg-[#08379b] transition-colors pl-4">Management</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Section 2 -->
                        <div>
                            <h3 class="text-xs font-bold text-neutral-50 uppercase tracking-wider mb-3">Solutions</h3>
                            <ul class="space-y-3 border-l-2 border-gray-100 pl-1">
                                <li><a href="#"
                                        class="text-sm text-neutral-50 block font-medium py-3 rounded-lg hover:bg-[#08379b] transition-colors pl-4">Marketing</a>
                                </li>
                                <li><a href="#"
                                        class="text-sm text-neutral-50 block font-medium py-3 rounded-lg hover:bg-[#08379b] transition-colors pl-4">Enterprise</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Section 3 -->
                        <div>
                            <h3 class="text-xs font-bold text-neutral-50 uppercase tracking-wider mb-3">Resources</h3>
                            <ul class="space-y-3 border-l-2 border-gray-100 pl-1">
                                <li><a href="#"
                                        class="text-sm text-neutral-50 block font-medium py-3 rounded-lg hover:bg-[#08379b] transition-colors pl-4">Community</a>
                                </li>
                                <li><a href="#"
                                        class="text-sm text-neutral-50 block font-medium py-3 rounded-lg hover:bg-[#08379b] transition-colors pl-4">Help
                                        Center</a></li>
                            </ul>
                        </div>

                        <!-- Promo Section (Stacked) -->
                        <div class="bg-gray-50 rounded-lg p-4 mt-4">
                            <div class="flex items-start gap-3">
                                <div class="flex-1">
                                    <h3 class="text-sm font-bold text-gray-900 mb-1">New Feature</h3>
                                    <p class="text-xs text-gray-500 mb-2">Check out our latest dashboard update.</p>
                                    <a href="#" class="text-xs font-bold text-[#0b5ffa]">Learn more &rarr;</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <a href="#"
                    class="text-white block px-3 py-4 rounded-lg text-lg font-medium hover:bg-[#08379b] transition-colors border-b border-white/10">About</a>
                <a href="{{ route('services') }}"
                    class="text-white block px-3 py-4 rounded-lg text-lg font-medium hover:bg-[#08379b] transition-colors border-b border-white/10">Contact</a>

                <div class="pt-6">
                    <a href="#"
                        class="block w-full text-center bg-white text-[#0b5ffa] px-5 py-4 rounded-xl text-lg font-bold shadow-lg hover:bg-gray-100 transition-colors">
                        Get Started Now
                    </a>
                </div>
            </div>
        </div>
    </nav>
</section>