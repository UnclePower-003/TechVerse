@extends('frontend.app')

@section('content')
@push('style')
                <style>
                body {
                    font-family: 'Inter', sans-serif;
                }

                /* Smooth scrolling */
                html {
                    scroll-behavior: smooth;
                }

                /* Custom scrollbar */
                ::-webkit-scrollbar {
                    width: 8px;
                }

                ::-webkit-scrollbar-track {
                    background: #f1f1f1;
                }

                ::-webkit-scrollbar-thumb {
                    background: #08379b;
                    border-radius: 4px;
                }

                ::-webkit-scrollbar-thumb:hover {
                    background: #0b5ffa;
                }
            </style>

@endpush

    {{-- Herosection --}}
    <section>







            <!-- HERO SECTION -->
<section class="relative w-full h-screen min-h-[600px] overflow-hidden flex items-center">
    
    <!-- 1. BACKGROUND LAYER -->
    <div class="absolute inset-0 z-0">
        <!-- The Image with the Zoom Animation -->
        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
             alt="Team working" 
             class="w-full h-full object-cover animate-hero-zoom">
        
        <!-- Gradient Overlay: Crucial for text readability -->
        <!-- Gradient from Blue (left) to Black/Transparent (right) -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#0b5ffa]/90 via-[#062a78]/80 to-black/40"></div>
    </div>

    <!-- 2. CONTENT LAYER -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-20"> <!-- pt-20 to clear fixed nav -->
        
        <div class="max-w-3xl">
            <!-- Badge -->
            <div class="animate-fade-up inline-block px-4 py-1.5 rounded-full border border-blue-300/30 bg-blue-500/20 backdrop-blur-sm text-blue-50 font-semibold text-sm mb-6">
                <span class="mr-2">🚀</span> New Version 2.0 is Live
            </div>

            <!-- Headline -->
            <h1 class="animate-fade-up delay-100 text-5xl md:text-7xl font-extrabold text-white tracking-tight leading-tight mb-6">
                Build faster with <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white">Intelligent Data.</span>
            </h1>

            <!-- Subtext -->
            <p class="animate-fade-up delay-200 text-lg md:text-xl text-blue-100 mb-8 max-w-2xl leading-relaxed">
                Empower your team with the tools they need to scale efficiently. 
                Our platform integrates seamlessly with your existing workflow to deliver real-time insights.
            </p>

            <!-- Buttons -->
            <div class="animate-fade-up delay-300 flex flex-col sm:flex-row gap-4">
                <a href="#" class="px-8 py-4 bg-white text-[#0b5ffa] rounded-full font-bold text-lg hover:bg-blue-50 transition-all shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:scale-105 transform duration-200 text-center">
                    Get Started Free
                </a>
                <a href="#" class="px-8 py-4 border border-white/30 bg-white/10 backdrop-blur-md text-white rounded-full font-bold text-lg hover:bg-white/20 transition-all flex items-center justify-center gap-2 group">
                    <i class="fa-solid fa-play text-xs group-hover:scale-125 transition-transform"></i>
                    Watch Demo
                </a>
            </div>

            <!-- Social Proof / Stats (Glassmorphism) -->
            <div class="animate-fade-up delay-300 mt-12 pt-8 border-t border-white/10 flex items-center gap-8">
                <div>
                    <p class="text-3xl font-bold text-white">10k+</p>
                    <p class="text-xs text-blue-200 uppercase tracking-wide">Active Users</p>
                </div>
                <div class="h-8 w-px bg-white/20"></div>
                <div>
                    <p class="text-3xl font-bold text-white">99.9%</p>
                    <p class="text-xs text-blue-200 uppercase tracking-wide">Uptime</p>
                </div>
                <div class="h-8 w-px bg-white/20"></div>
                <div class="flex -space-x-3">
                    <img class="w-10 h-10 rounded-full border-2 border-[#0b5ffa]" src="https://i.pravatar.cc/100?img=1" alt="">
                    <img class="w-10 h-10 rounded-full border-2 border-[#0b5ffa]" src="https://i.pravatar.cc/100?img=2" alt="">
                    <img class="w-10 h-10 rounded-full border-2 border-[#0b5ffa]" src="https://i.pravatar.cc/100?img=3" alt="">
                    <div class="w-10 h-10 rounded-full border-2 border-[#0b5ffa] bg-white flex items-center justify-center text-xs font-bold text-[#0b5ffa]">+2k</div>
                </div>
            </div>
        </div>
    </div>
</section>

            <!-- FEATURES / USP -->
            <section
                class="py-12 bg-white -mt-10 relative z-20 container mx-auto px-6 rounded-lg shadow-lg border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="p-4 group">
                        <div
                            class="w-16 h-16 bg-blue-50 text-[#0b5ffa] rounded-full flex items-center justify-center text-2xl mx-auto mb-4 group-hover:bg-[#0b5ffa] group-hover:text-white transition duration-300">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2 text-[#08379b]">Fast Delivery</h3>
                        <p class="text-gray-500 text-sm">Same-day dispatch for hardware and instant activation for software
                            keys.</p>
                    </div>
                    <div class="p-4 group">
                        <div
                            class="w-16 h-16 bg-blue-50 text-[#0b5ffa] rounded-full flex items-center justify-center text-2xl mx-auto mb-4 group-hover:bg-[#0b5ffa] group-hover:text-white transition duration-300">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2 text-[#08379b]">Genuine Products</h3>
                        <p class="text-gray-500 text-sm">Authorized distributors for top brands. 100% original hardware and
                            licenses.</p>
                    </div>
                    <div class="p-4 group">
                        <div
                            class="w-16 h-16 bg-blue-50 text-[#0b5ffa] rounded-full flex items-center justify-center text-2xl mx-auto mb-4 group-hover:bg-[#0b5ffa] group-hover:text-white transition duration-300">
                            <i class="fas fa-headset"></i>
                        </div>
                        <h3 class="font-bold text-lg mb-2 text-[#08379b]">Expert Support</h3>
                        <p class="text-gray-500 text-sm">24/7 technical assistance for installation and configuration.</p>
                    </div>
                </div>
            </section>

            <!-- CATEGORIES -->
            <section id="services" class="py-20 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl font-bold text-[#08379b] mb-4">Our Categories</h2>
                        <div class="w-20 h-1 bg-[#0b5ffa] mx-auto rounded"></div>
                        <p class="text-gray-500 mt-4 max-w-xl mx-auto">Everything you need to build a secure and connected
                            infrastructure.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Cat 1 -->
                        <div
                            class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden group cursor-pointer border border-gray-100">
                            <div class="h-40 bg-gray-200 overflow-hidden relative">
                                <img src="https://placehold.co/400x300/e2e8f0/08379b?text=CCTV+Systems"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                    alt="CCTV">
                                <div
                                    class="absolute inset-0 bg-[#08379b] opacity-0 group-hover:opacity-20 transition duration-300">
                                </div>
                            </div>
                            <div class="p-6 text-center">
                                <h3 class="font-bold text-lg text-gray-800 group-hover:text-[#0b5ffa] transition">
                                    Surveillance (CCTV)</h3>
                                <p class="text-xs text-gray-500 mt-2">Cameras, NVRs, Cables</p>
                            </div>
                        </div>

                        <!-- Cat 2 -->
                        <div
                            class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden group cursor-pointer border border-gray-100">
                            <div class="h-40 bg-gray-200 overflow-hidden relative">
                                <img src="https://placehold.co/400x300/e2e8f0/08379b?text=Networking"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                    alt="Routers">
                                <div
                                    class="absolute inset-0 bg-[#08379b] opacity-0 group-hover:opacity-20 transition duration-300">
                                </div>
                            </div>
                            <div class="p-6 text-center">
                                <h3 class="font-bold text-lg text-gray-800 group-hover:text-[#0b5ffa] transition">Networking
                                </h3>
                                <p class="text-xs text-gray-500 mt-2">Routers, Switches, Access Points</p>
                            </div>
                        </div>

                        <!-- Cat 3 -->
                        <div
                            class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden group cursor-pointer border border-gray-100">
                            <div class="h-40 bg-gray-200 overflow-hidden relative">
                                <img src="https://placehold.co/400x300/e2e8f0/08379b?text=Software"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                    alt="Software">
                                <div
                                    class="absolute inset-0 bg-[#08379b] opacity-0 group-hover:opacity-20 transition duration-300">
                                </div>
                            </div>
                            <div class="p-6 text-center">
                                <h3 class="font-bold text-lg text-gray-800 group-hover:text-[#0b5ffa] transition">Software
                                </h3>
                                <p class="text-xs text-gray-500 mt-2">OS, Antivirus, Office Suites</p>
                            </div>
                        </div>

                        <!-- Cat 4 -->
                        <div
                            class="bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden group cursor-pointer border border-gray-100">
                            <div class="h-40 bg-gray-200 overflow-hidden relative">
                                <img src="https://placehold.co/400x300/e2e8f0/08379b?text=Accessories"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                    alt="Accessories">
                                <div
                                    class="absolute inset-0 bg-[#08379b] opacity-0 group-hover:opacity-20 transition duration-300">
                                </div>
                            </div>
                            <div class="p-6 text-center">
                                <h3 class="font-bold text-lg text-gray-800 group-hover:text-[#0b5ffa] transition">
                                    Accessories</h3>
                                <p class="text-xs text-gray-500 mt-2">Connectors, Tools, Racks</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- FEATURED PRODUCTS -->
            <section id="products" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="flex justify-between items-end mb-10">
                        <div>
                            <h2 class="text-3xl font-bold text-[#08379b]">Featured Products</h2>
                            <p class="text-gray-500 mt-2">Best-selling hardware for your infrastructure.</p>
                        </div>
                        <a href="#" class="hidden md:inline-block text-[#0b5ffa] font-semibold hover:underline">View All
                            Products <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- Product Card 1 -->
                        <div class="group relative bg-white border border-gray-200 rounded-lg hover:shadow-lg transition">
                            <div
                                class="relative w-full h-60 bg-gray-100 rounded-t-lg overflow-hidden flex items-center justify-center p-4">
                                <span
                                    class="absolute top-2 left-2 bg-[#0b5ffa] text-white text-xs font-bold px-2 py-1 rounded">New</span>
                                <img src="https://placehold.co/300x300/ffffff/08379b?text=Dome+Camera+4K" alt="Product"
                                    class="max-h-full">
                            </div>
                            <div class="p-5">
                                <p class="text-sm text-gray-400 mb-1">CCTV</p>
                                <h3 class="text-lg font-bold text-gray-800 mb-2 truncate">4K Dome Security Camera IP67</h3>
                                <div class="flex items-center mb-4">
                                    <div class="text-yellow-400 text-xs">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-gray-400 text-xs ml-2">(42)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-[#08379b]">$129.99</span>
                                    <button onclick="addToCart()"
                                        class="w-10 h-10 rounded-full bg-gray-100 text-[#08379b] flex items-center justify-center hover:bg-[#0b5ffa] hover:text-white transition">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 2 -->
                        <div class="group relative bg-white border border-gray-200 rounded-lg hover:shadow-lg transition">
                            <div
                                class="relative w-full h-60 bg-gray-100 rounded-t-lg overflow-hidden flex items-center justify-center p-4">
                                <img src="https://placehold.co/300x300/ffffff/08379b?text=Gigabit+Router" alt="Product"
                                    class="max-h-full">
                            </div>
                            <div class="p-5">
                                <p class="text-sm text-gray-400 mb-1">Networking</p>
                                <h3 class="text-lg font-bold text-gray-800 mb-2 truncate">Dual-Band Gigabit Router AX3000
                                </h3>
                                <div class="flex items-center mb-4">
                                    <div class="text-yellow-400 text-xs">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="far fa-star"></i>
                                    </div>
                                    <span class="text-gray-400 text-xs ml-2">(15)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-[#08379b]">$89.50</span>
                                    <button onclick="addToCart()"
                                        class="w-10 h-10 rounded-full bg-gray-100 text-[#08379b] flex items-center justify-center hover:bg-[#0b5ffa] hover:text-white transition">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 3 -->
                        <div class="group relative bg-white border border-gray-200 rounded-lg hover:shadow-lg transition">
                            <div
                                class="relative w-full h-60 bg-gray-100 rounded-t-lg overflow-hidden flex items-center justify-center p-4">
                                <span
                                    class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-20%</span>
                                <img src="https://placehold.co/300x300/ffffff/08379b?text=8-Port+Switch" alt="Product"
                                    class="max-h-full">
                            </div>
                            <div class="p-5">
                                <p class="text-sm text-gray-400 mb-1">Networking</p>
                                <h3 class="text-lg font-bold text-gray-800 mb-2 truncate">8-Port PoE+ Managed Switch</h3>
                                <div class="flex items-center mb-4">
                                    <div class="text-yellow-400 text-xs">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-gray-400 text-xs ml-2">(104)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-400 line-through">$100.00</span>
                                        <span class="text-xl font-bold text-[#08379b]">$80.00</span>
                                    </div>
                                    <button onclick="addToCart()"
                                        class="w-10 h-10 rounded-full bg-gray-100 text-[#08379b] flex items-center justify-center hover:bg-[#0b5ffa] hover:text-white transition">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Product Card 4 -->
                        <div class="group relative bg-white border border-gray-200 rounded-lg hover:shadow-lg transition">
                            <div
                                class="relative w-full h-60 bg-gray-100 rounded-t-lg overflow-hidden flex items-center justify-center p-4">
                                <img src="https://placehold.co/300x300/ffffff/08379b?text=Antivirus+Key" alt="Product"
                                    class="max-h-full">
                            </div>
                            <div class="p-5">
                                <p class="text-sm text-gray-400 mb-1">Software</p>
                                <h3 class="text-lg font-bold text-gray-800 mb-2 truncate">Total Security Antivirus (1 Year)
                                </h3>
                                <div class="flex items-center mb-4">
                                    <div class="text-yellow-400 text-xs">
                                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                            class="fas fa-star"></i><i class="fas fa-star"></i>
                                    </div>
                                    <span class="text-gray-400 text-xs ml-2">(300+)</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold text-[#08379b]">$25.00</span>
                                    <button onclick="addToCart()"
                                        class="w-10 h-10 rounded-full bg-gray-100 text-[#08379b] flex items-center justify-center hover:bg-[#0b5ffa] hover:text-white transition">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-10 md:hidden">
                        <a href="#"
                            class="inline-block border border-[#0b5ffa] text-[#0b5ffa] font-semibold px-6 py-3 rounded hover:bg-[#0b5ffa] hover:text-white transition">View
                            All Products</a>
                    </div>
                </div>
            </section>

            <!-- CALL TO ACTION (Service) -->
            <section class="bg-[#08379b] py-20">
                <div class="container mx-auto px-6 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Need Professional Installation?</h2>
                    <p class="text-blue-200 max-w-2xl mx-auto mb-10 text-lg">
                        We don't just sell hardware; we set it up. Our expert team is ready to install CCTV systems and
                        configure complex networks for your office or home.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="#contact"
                            class="bg-[#0b5ffa] text-white px-8 py-4 rounded-md font-bold hover:bg-white hover:text-[#0b5ffa] transition shadow-lg">
                            Book a Service
                        </a>
                        <a href="tel:+18001234567"
                            class="flex items-center justify-center bg-transparent border-2 border-white text-white px-8 py-4 rounded-md font-bold hover:bg-white hover:text-[#08379b] transition">
                            <i class="fas fa-phone-alt mr-2"></i> Call Support
                        </a>
                    </div>
                </div>
            </section>

            <!-- FOOTER -->
            <footer class="bg-gray-900 text-gray-300 pt-16 pb-8">
                <div class="container mx-auto px-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                        <!-- Company Info -->
                        <div>
                            <a href="#" class="text-2xl font-bold text-white flex items-center gap-2 mb-6">
                                <i class="fas fa-server text-[#0b5ffa]"></i> TechServe
                            </a>
                            <p class="text-sm text-gray-400 mb-6">
                                Your trusted partner for IT hardware, software solutions, and professional networking
                                services.
                            </p>
                            <div class="flex space-x-4">
                                <a href="#"
                                    class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center hover:bg-[#0b5ffa] hover:text-white transition"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a href="#"
                                    class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center hover:bg-[#0b5ffa] hover:text-white transition"><i
                                        class="fab fa-twitter"></i></a>
                                <a href="#"
                                    class="w-8 h-8 rounded bg-gray-800 flex items-center justify-center hover:bg-[#0b5ffa] hover:text-white transition"><i
                                        class="fab fa-instagram"></i></a>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-white text-lg font-bold mb-6">Quick Links</h4>
                            <ul class="space-y-3 text-sm">
                                <li><a href="#" class="hover:text-[#0b5ffa] transition">About Us</a></li>
                                <li><a href="#" class="hover:text-[#0b5ffa] transition">Shop Hardware</a></li>
                                <li><a href="#" class="hover:text-[#0b5ffa] transition">Software Licenses</a></li>
                                <li><a href="#" class="hover:text-[#0b5ffa] transition">Installation Services</a></li>
                                <li><a href="#" class="hover:text-[#0b5ffa] transition">Privacy Policy</a></li>
                            </ul>
                        </div>

                        <!-- Categories -->
                        <div>
                            <h4 class="text-white text-lg font-bold mb-6">Categories</h4>
                            <ul class="space-y-3 text-sm">
                                <li><a href="#" class="hover:text-[#0b5ffa] transition">CCTV & Surveillance</a></li>
                                <li><a href="#" class="hover:text-[#0b5ffa] transition">Routers & Modems</a></li>
                                <li><a href="#" class="hover:text-[#0b5ffa] transition">Cables & Connectors</a></li>
                                <li><a href="#" class="hover:text-[#0b5ffa] transition">Smart Home</a></li>
                                <li><a href="#" class="hover:text-[#0b5ffa] transition">Office Networking</a></li>
                            </ul>
                        </div>

                        <!-- Contact -->
                        <div id="contact">
                            <h4 class="text-white text-lg font-bold mb-6">Contact Us</h4>
                            <ul class="space-y-4 text-sm">
                                <li class="flex items-start gap-3">
                                    <i class="fas fa-map-marker-alt mt-1 text-[#0b5ffa]"></i>
                                    <span>123 Tech Avenue, Silicon Valley,<br>CA 94000, USA</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-phone text-[#0b5ffa]"></i>
                                    <span>+1 (800) 123-4567</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <i class="fas fa-envelope text-[#0b5ffa]"></i>
                                    <span>sales@techserve.com</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div
                        class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                        <p>&copy; 2023 TechServe. All rights reserved.</p>
                        <div class="mt-4 md:mt-0 flex space-x-4">
                            <i class="fab fa-cc-visa text-2xl text-white"></i>
                            <i class="fab fa-cc-mastercard text-2xl text-white"></i>
                            <i class="fab fa-cc-paypal text-2xl text-white"></i>
                        </div>
                    </div>
                </div>
            </footer>

    </section>

@push('script')
     <script>
                // Mobile Menu Toggle
                const btn = document.getElementById('mobile-menu-btn');
                const menu = document.getElementById('mobile-menu');

                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });

                // Simple Cart Logic (Simulation)
                function addToCart() {
                    // In a real app, this would add data to local storage or state
                    const cartBadge = document.querySelector('.fa-shopping-cart + span');
                    let count = parseInt(cartBadge.innerText);
                    cartBadge.innerText = count + 1;

                    // Visual feedback
                    alert("Item added to cart successfully!");
                }

                // Sticky Navbar shadow on scroll
                window.addEventListener('scroll', () => {
                    const nav = document.querySelector('nav');
                    if (window.scrollY > 0) {
                        nav.classList.add('shadow-lg');
                    } else {
                        nav.classList.remove('shadow-lg');
                        nav.classList.add('shadow-md');
                    }
                });
            </script>
@endpush
@endsection