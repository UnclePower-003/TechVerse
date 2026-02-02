    @extends('frontend.app')

    @section('content')
        <title>Products | TechVerse</title>
        @push('style')
            {{-- herosection  --}}
            <style>
                .hero-bg {
                    position: absolute;
                    inset: 0;
                    z-index: 0;
                }

                .hero-bg img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    object-fit: center;
                    /* The dark filter (opacity) */
                    opacity: 0.5;
                }

                /* Gradient overlay for extra depth */
                .overlay {
                    position: absolute;
                    inset: 0;
                    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), transparent, rgba(0, 0, 0, 0.6));
                }

                /* 3. Content Wrapper */
                .hero-content {

                    color: white;
                    /* Floating Animation */
                    animation: float 5s ease-in-out infinite;
                }

                /* 4. Typography & Buttons */
                .hero-content h1 {
                    font-size: clamp(3rem, 8vw, 4.5rem);
                    font-weight: 800;
                    line-height: 1.1;
                    margin-bottom: 24px;
                }



                .hero-content p {
                    font-size: 1.25rem;
                    margin-bottom: 40px;
                    line-height: 1.6;
                }

                .cta-btn {
                    display: inline-block;
                    background-color: white;
                    color: black;
                    padding: 16px 32px;
                    border-radius: 9999px;
                    font-weight: 700;
                    text-decoration: none;
                    transition: all 0.3s ease;
                    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                }

                .cta-btn:hover {
                    background-color: #3b82f6;
                    color: white;
                    transform: scale(1.05);
                }

                /* 5. Reveal Animations (Applied on Reload) */
                .reveal {
                    opacity: 0;
                    transform: translateY(30px);
                    animation: revealEffect 1.2s ease-out forwards;
                }

                .delay-1 {
                    animation-delay: 0.2s;
                }

                .delay-2 {
                    animation-delay: 0.5s;
                }

                .delay-3 {
                    animation-delay: 0.8s;
                }

                /* 6. Keyframes */
                @keyframes revealEffect {
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                @keyframes float {

                    0%,
                    100% {
                        transform: translateY(0);
                    }

                    50% {
                        transform: translateY(-15px);
                    }
                }

                /* Scroll Indicator */
                .scroll-indicator {
                    position: absolute;
                    bottom: 30px;
                    left: 50%;
                    transform: translateX(-50%);
                    color: rgba(255, 255, 255, 0.5);
                    animation: bounce 2s infinite;
                }

                @keyframes bounce {

                    0%,
                    20%,
                    50%,
                    80%,
                    100% {
                        transform: translateY(0) translateX(-50%);
                    }

                    40% {
                        transform: translateY(-10px) translateX(-50%);
                    }

                    60% {
                        transform: translateY(-5px) translateX(-50%);
                    }
                }
            </style>

            {{-- body --}}
            <style>
                /* Custom Reveal Animations */
                .reveal {
                    opacity: 0;
                    transform: translateY(30px);
                    transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
                }

                .reveal.active {
                    opacity: 1;
                    transform: translateY(0);
                }




                .reveal-down {
                    transform: translateY(-30px);
                }


                .reveal.active.reveal-down {
                    transform: translate(0);
                }

                /* Hide scrollbar for clean UI */
                .no-scrollbar::-webkit-scrollbar {
                    display: none;
                }

                .no-scrollbar {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
            </style>
        @endpush

        <!-- Header Section -->
        <section class="hero min-h-[90vh] relative bg-black overflow-hidden flex items-center">
            <div class="absolute inset-0">

                {{-- <img src="{{ asset('imagess/heroimages/productM.png') }}" alt="Network Background"
                    class="w-full h-full object-cover md:hidden">

                <img src="{{ asset('imagess/heroimages/productT.png') }}" alt="Network Background"
                    class="w-full h-full object-cover lg:hidden">

                <img src="{{ asset('imagess/heroimages/product.png') }}" alt="Network Background"
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
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-black/40 to-black/70 lg:hidden"></div>
            @if ($header)
                <div
                    class="hero-content relative z-10 w-full flex flex-col lg:items-start items-center lg:text-left text-center p-6 lg:px-20">

                    {{-- <h1 class="reveal delay-1 text-5xl md:text-7xl font-bold text-slate-700 leading-tight">
                        Premium Sound. <br>
                        <span class="text-[#3b82f6]">Unmatched.</span>
                    </h1> --}}
                    <h1 class="reveal delay-1 text-5xl md:text-7xl font-bold text-slate-700 leading-tight">
                        {{ $header->title }} <br>
                        <span class="text-[#3b82f6]">{{ $header->highlight_text }}</span>
                    </h1>

                    {{-- <p class="reveal delay-2 lg:text-slate-800 text-stone-200  font-bold text-lg md:text-xl max-w-xl mt-4">
                        Experience studio-quality audio with our latest noise-canceling technology.
                        Designed for those who demand perfection.
                    </p> --}}
                    <p class="reveal delay-2 lg:text-slate-800 text-stone-200  font-bold text-lg md:text-xl max-w-xl mt-4">
                        {{ $header->description }}
                    </p>
                </div>
            @endif

            <div class="scroll-indicator absolute bottom-8 left-1/2 -translate-x-1/2">
                <a href="#filter-bar"
                    class="text-white/70 hover:text-white text-sm uppercase tracking-widest no-underline flex flex-col items-center gap-2">
                    Scroll Down
                </a>
            </div>
        </section>
        <!-- Sticky Filter Section -->
        <section
            class="sticky top-0 z-40 bg-[#d1e2f6]   border-b border-slate-200/60 mb-12 mt-20 shadow-sm transition-all duration-300"
            id="filter-bar">
            <div class="container mx-auto px-4 md:px-6 py-4 flex flex-col md:flex-row justify-between items-center gap-4">

                <div class="reveal reveal-left w-full md:w-auto text-center md:text-left">
                    <h2 id="current-category"
                        class="text-xl md:text-2xl font-bold text-slate-800 flex items-center justify-center md:justify-start gap-2">
                        <i class="fas fa-layer-group text-blue-500 text-lg"></i>
                        <span>All Products</span>
                        <span id="count-badge"
                            class="bg-slate-200 text-slate-600 text-xs px-2 py-1 rounded-full ml-2 align-middle">0</span>
                    </h2>
                </div>

                <!-- Dropdown Container -->
                <div class="relative reveal reveal-right z-50 w-full md:w-auto">
                    <button id="dropdown-btn"
                        class="w-full md:w-auto px-6 py-3 rounded-xl flex items-center justify-between gap-3 min-w-[240px]  hover:border-blue-300 transition-all cursor-pointer select-none group">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg  text-blue-600 flex items-center justify-center">
                                <i class="fas fa-filter text-sm"></i>
                            </div>
                            <span class="font-semibold text-slate-700 group-hover:text-blue-600 transition-colors">Filter
                                Category</span>
                        </div>
                        <i id="dropdown-chevron"
                            class="fas fa-chevron-down text-slate-400 text-xs transition-transform duration-300"></i>
                    </button>

                    <div id="dropdown-menu"
                        class="absolute right-0 mt-2 w-full md:w-[280px] bg-white rounded-2xl overflow-hidden shadow-2xl ring-1 ring-black/5 opacity-0 invisible scale-95 transition-all duration-200 transform origin-top-right z-50">
                        <div class="py-2">
                            <button onclick="filterCategory('all', 'All Products')"
                                class="w-full text-left px-5 py-3 hover:bg-slate-50 transition-colors flex items-center gap-3 group">
                                <span
                                    class="w-2 h-2 rounded-full bg-slate-300 group-hover:bg-blue-500 transition-colors"></span>
                                <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900">All
                                    Products</span>
                            </button>
                            <button onclick="filterCategory('cctv', 'CCTV & WiFi Cameras')"
                                class="w-full text-left px-5 py-3 hover:bg-slate-50 transition-colors flex items-center gap-3 group">
                                <span
                                    class="w-2 h-2 rounded-full bg-slate-300 group-hover:bg-blue-500 transition-colors"></span>
                                <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900">CCTV &
                                    WiFi</span>
                            </button>
                            <button onclick="filterCategory('Xvrs', 'Xvrs')"
                                class="w-full text-left px-5 py-3 hover:bg-slate-50 transition-colors flex items-center gap-3 group">
                                <span
                                    class="w-2 h-2 rounded-full bg-slate-300 group-hover:bg-blue-500 transition-colors"></span>
                                <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900">NetXVRs</span>
                            </button>
                            <button onclick="filterCategory('hardware', 'Hardware & Computers')"
                                class="w-full text-left px-5 py-3 hover:bg-slate-50 transition-colors flex items-center gap-3 group">
                                <span
                                    class="w-2 h-2 rounded-full bg-slate-300 group-hover:bg-blue-500 transition-colors"></span>
                                <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900">Computers &
                                    Hardware</span>
                            </button>
                            <button onclick="filterCategory('security', 'Security Systems')"
                                class="w-full text-left px-5 py-3 hover:bg-slate-50 transition-colors flex items-center gap-3 group">
                                <span
                                    class="w-2 h-2 rounded-full bg-slate-300 group-hover:bg-blue-500 transition-colors"></span>
                                <span class="text-sm font-medium text-slate-600 group-hover:text-slate-900">Security
                                    Systems</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Grid -->
        <main class="container mx-auto px-4 md:px-6 pb-24 min-h-[600px]">
            <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                <!-- Products will be injected here via JavaScript -->
            </div>

            <!-- Empty State (Hidden by default) -->
            <div id="empty-state" class="hidden text-center py-20">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-100 mb-6">
                    <i class="fas fa-search text-3xl text-slate-300"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-700 mb-2">No products found</h3>
                <p class="text-slate-500">Try selecting a different category.</p>
            </div>
        </main>

        <!-- Inquiry Form Section -->
        <section id="inquiry" class="bg-slate-900 py-16 md:py-24 overflow-hidden relative">
            <!-- Background decorative elements -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute -top-[20%] -right-[10%] w-[600px] h-[600px] rounded-full bg-blue-600/10 blur-[100px]">
                </div>
                <div class="absolute bottom-[10%] left-[5%] w-[400px] h-[400px] rounded-full bg-purple-600/10 blur-[80px]">
                </div>
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div
                    class="max-w-7xl mx-auto flex flex-col lg:flex-row items-stretch rounded-3xl overflow-hidden shadow-2xl reveal reveal-up bg-[#f1f5f9]">

                    <!-- Contact Info Side -->
                    <div
                        class="lg:w-2/5 bg-gradient-to-br from-blue-600 to-blue-800 p-10 md:p-12 text-white flex flex-col justify-between relative overflow-hidden">
                        <!-- Pattern overlay -->
                        <div class="absolute inset-0 opacity-10"
                            style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;">
                        </div>

                        <div class="relative z-10">
                            <h2 class="text-3xl font-extrabold mb-4 tracking-tight">Partner With Us</h2>
                            <p class="text-blue-100 mb-10 leading-relaxed font-light">Let's discuss your project. Whether it's a small office setup or a city-wide surveillance project, we provide the best tech support in Nepal.</p>

                            {{-- <div class="space-y-8">
                                <div class="flex items-start gap-5 group">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 group-hover:bg-white/20 transition-colors backdrop-blur-sm border border-white/10">
                                        <i class="fas fa-map-marker-alt text-blue-200"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-lg">Head Office</p>
                                        <p class="text-sm text-blue-100 opacity-80">Kathmandu, Nepal</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-5 group">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 group-hover:bg-white/20 transition-colors backdrop-blur-sm border border-white/10">
                                        <i class="fas fa-phone-alt text-blue-200"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-lg">Support Line</p>
                                        <p class="text-sm text-blue-100 opacity-80">+977-1-4XXXXXX</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-5 group">
                                    <div
                                        class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 group-hover:bg-white/20 transition-colors backdrop-blur-sm border border-white/10">
                                        <i class="fas fa-envelope text-blue-200"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-lg">Email Us</p>
                                        <p class="text-sm text-blue-100 opacity-80">info@premiumsolutions.com.np</p>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="space-y-8">
                                @foreach ($info->items as $item)
                                    <div class="flex items-start gap-5 group">
                                        <div
                                        class="w-12 h-12 rounded-2xl bg-white/10 flex items-center justify-center shrink-0 group-hover:bg-white/20 transition-colors backdrop-blur-sm border border-white/10">
                                            <i class="{{ $item['icon'] }}"></i>
                                        </div>
                                        <div class="ml-5">
                                            <h3 class="font-bold text-lg">{{ $item['title'] }}</h3>
                                            <p class="text-sm text-blue-100 opacity-80">{{ $item['description'] ?? '' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- <div class="relative z-10 flex gap-4 mt-12">
                            <a href="#"
                                class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-blue-700 transition-all"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a href="#"
                                class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-blue-700 transition-all"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a href="#"
                                class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-blue-700 transition-all"><i
                                    class="fab fa-instagram"></i></a>
                        </div> --}}
                        <div class="relative z-10 flex gap-4 mt-12">
                            @foreach ($socialLinks as $link)
                                <a href="{{ $link->url }}" target="_blank"
                                    class="w-10 h-10 rounded-full border border-white/20 flex items-center justify-center hover:bg-{{ $link->hover_color }} hover:border-{{ $link->hover_color }} transition-all">
                                    <i class="fab {{ $link->icon }} text-sm"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Form Side -->
                    <div class="lg:w-3/5 p-8 md:p-12 bg-[#f1f5f9]">
                        {{-- <form id="contact-form" onsubmit="handleFormSubmit(event)" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Full
                                        Name</label>
                                    <input type="text" required placeholder="e.g. Ram Bahadur"
                                        class="w-full bg-slate-50 px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all placeholder:text-slate-400 text-slate-700">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Phone
                                        Number</label>
                                    <input type="tel" required placeholder="+977-98..."
                                        class="w-full bg-slate-50 px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all placeholder:text-slate-400 text-slate-700">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Interested
                                    In</label>
                                <div class="relative">
                                    <select
                                        class="w-full bg-slate-50 px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none cursor-pointer appearance-none text-slate-700">
                                        <option>CCTV Systems</option>
                                        <option>Enterprise Networking</option>
                                        <option>Computing Hardware</option>
                                        <option>Security Systems</option>
                                        <option>General Inquiry</option>
                                    </select>

                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">Your Message</label>
                                <textarea id="message-area" rows="8" placeholder="Tell us about your requirements..."
                                    class="w-full bg-slate-50 px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all resize-y placeholder:text-slate-400 text-slate-700"></textarea>
                            </div>
                            <button type="submit"
                                class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-4 rounded-xl transition-all shadow-xl shadow-slate-900/10 hover:shadow-blue-600/20 transform hover:-translate-y-1 active:translate-y-0 duration-200 flex items-center justify-center gap-2 group">
                                <span>Send Message</span>
                                <i class="fas fa-paper-plane text-sm group-hover:translate-x-1 transition-transform"></i>
                            </button>
                        </form> --}}
                        <form action="{{ route('product-requirements.store') }}" method="POST" class="space-y-6" id="productRequirementForm" >
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-2">
            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">
                Full Name
            </label>
            <input type="text" name="full_name" required
                placeholder="e.g. Ram Bahadur"
                class="w-full bg-slate-50 px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all placeholder:text-slate-400 text-slate-700">
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">
                Phone Number
            </label>
            <input type="tel" name="phone" required
                placeholder="+977-98..."
                class="w-full bg-slate-50 px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all placeholder:text-slate-400 text-slate-700">
        </div>
    </div>

    <div class="space-y-2">
        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">
            Interested In
        </label>
        <select name="interest"
            class="w-full bg-slate-50 px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none cursor-pointer appearance-none text-slate-700">
            <option value="CCTV Systems">CCTV Systems</option>
            <option value="Enterprise Networking">Enterprise Networking</option>
            <option value="Computing Hardware">Computing Hardware</option>
            <option value="Security Systems">Security Systems</option>
            <option value="General Inquiry">General Inquiry</option>
        </select>
    </div>

    <div class="space-y-2">
        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-1">
            Your Message
        </label>
        <textarea name="message" rows="8"
            placeholder="Tell us about your requirements..."
            class="w-full bg-slate-50 px-4 py-3 rounded-xl border border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 outline-none transition-all resize-y placeholder:text-slate-400 text-slate-700"></textarea>
    </div>

    <button type="submit"
        class="w-full bg-slate-900 hover:bg-blue-600 text-white font-bold py-4 rounded-xl transition-all shadow-xl shadow-slate-900/10 hover:shadow-blue-600/20 transform hover:-translate-y-1 active:translate-y-0 duration-200 flex items-center justify-center gap-2 group">
        <span>Send Message</span>
        <i class="fas fa-paper-plane text-sm group-hover:translate-x-1 transition-transform"></i>
    </button>
</form>

                    </div>
                </div>
            </div>
        </section>


        @push('script')
        <script>
document.getElementById('productRequirementForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const form = this;
    const formData = new FormData(form);

    fetch("{{ route('product-requirements.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status) {
            form.reset();
            alert(data.message); // replace with toast if you want
        }
    })
    .catch(err => {
        alert('Something went wrong. Please try again.');
    });
});
</script>

            <script>
                // Data Source
                const products = [{
                        id: 1,
                        category: 'cctv',
                        model: 'DH-HAC-T1A21P-U-IL',
                        title: '2MP Smart Dual Light HDCVI Eyeball',
                        price: 'Rs. 2,070',
                        image: '{{ asset('imagess/products/camera1.png') }}',
                        badge: {
                            text: 'Fixed-Focal',
                            color: 'bg-[#0ea5e9]'
                        },
                        specs: [{
                                icon: 'fa-microchip',
                                text: '2.8 mm fixed lens'
                            },
                            {
                                icon: 'fa-lightbulb',
                                text: 'Smart Dual Light'
                            }
                        ]
                    },
                    {
                        id: 2,
                        category: 'Xvrs',
                        model: 'MODEL: DH-XVR1B08-I',
                        title: '8CH XVR 1HDD',
                        price: 'Rs. 6,990',
                        image: '{{ asset('imagess/products/xvrs1.png') }}',
                        badge: {
                            text: 'Enterprise',
                            color: 'bg-purple-500'
                        },
                        specs: [{
                                icon: 'fa-hdd',
                                text: 'Supports 1 SATA HDD'
                            },
                            {
                                icon: 'fa-network-wired',
                                text: 'H.265+/H.265'
                            }
                        ]
                    },
                    {
                        id: 3,
                        category: 'hardware',
                        model: 'Intel® Core™ Ultra 7 265KF CPU',
                        title: 'Intel Core Ultra Gen Pro Gaming PC',
                        price: 'coming soon',
                        image: '{{ asset('imagess/products/hardware.png') }}',
                        badge: {
                            text: 'High Perf',
                            color: 'bg-orange-500'
                        },
                        specs: [{
                                icon: 'fa-microchip',
                                text: 'Intel Core i5-10500T'
                            },
                            {
                                icon: 'fa-memory',
                                text: '8GB DDR4 RAM'
                            }
                        ]
                    },
                    {
                        id: 4,
                        category: 'cctv',
                        model: 'MODEL: DH-HAC-B1A21P-U-IL',
                        title: '2MP HDCVI IR Bullet Camera',
                        price: 'Rs. 1,950',
                        image: '{{ asset('imagess/products/camera2.png') }}',
                        badge: {
                            text: 'Outdoor',
                            color: 'bg-[#0ea5e9]'
                        },
                        specs: [{
                                icon: 'fa-eye',
                                text: '20m IR Distance'
                            },
                            {
                                icon: 'fa-shield-alt',
                                text: 'IP67 Weatherproof'
                            }
                        ]
                    },
                ];


                // UI References
                const productGrid = document.getElementById('product-grid');
                const emptyState = document.getElementById('empty-state');
                const countBadge = document.getElementById('count-badge');
                const dropdownBtn = document.getElementById('dropdown-btn');
                const dropdownMenu = document.getElementById('dropdown-menu');
                const dropdownChevron = document.getElementById('dropdown-chevron');
                const currentCategoryTitle = document.getElementById('current-category');

                // Initial Render
                document.addEventListener('DOMContentLoaded', () => {
                    renderProducts('all');
                    initRevealAnimation();
                });

                // Dropdown Logic
                dropdownBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleDropdown();
                });

                document.addEventListener('click', (e) => {
                    if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        closeDropdown();
                    }
                });

                function toggleDropdown() {
                    const isClosed = dropdownMenu.classList.contains('opacity-0');
                    if (isClosed) {
                        dropdownMenu.classList.remove('opacity-0', 'invisible', 'scale-95');
                        dropdownChevron.classList.add('rotate-180');
                    } else {
                        closeDropdown();
                    }
                }

                function closeDropdown() {
                    dropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                    dropdownChevron.classList.remove('rotate-180');
                }

                // Render Function
                function renderProducts(filter) {
                    productGrid.innerHTML = '';

                    const filteredProducts = filter === 'all' ?
                        products :
                        products.filter(p => p.category === filter);

                    // Update Badge Count
                    countBadge.innerText = filteredProducts.length;

                    if (filteredProducts.length === 0) {
                        emptyState.classList.remove('hidden');
                    } else {
                        emptyState.classList.add('hidden');

                        filteredProducts.forEach((product, index) => {
                            // Stagger animation delay
                            const delay = index * 100;
                            const card = createProductCard(product, delay);
                            productGrid.insertAdjacentHTML('beforeend', card);
                        });

                        // Re-trigger animations for new elements
                        setTimeout(() => {
                            const newCards = document.querySelectorAll('.product-card-new');
                            newCards.forEach(card => card.classList.add('active'));
                        }, 50);
                    }
                }

                function createProductCard(product, delay) {
                    // Generate specs HTML
                    const specsHtml = product.specs.map(spec => `
                <div class="flex items-center text-xs text-slate-500 bg-[#d1e2f6] px-2 py-1.5 rounded-md border border-slate-100">
                    <i class="fas ${spec.icon} mr-2 text-blue-500"></i> ${spec.text}
                </div>
            `).join('');

                    return `
                <div class="product-card-new reveal reveal-up bg-[#e5effa] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-blue-900/5 border border-slate-100 transition-all duration-300 group" style="transition-delay: ${delay}ms">
                    <div class="h-full flex flex-col cursor-pointer">
                        <div class="relative overflow-hidden bg-black aspect-[4/3] flex items-center justify-center">
                            <img src="${product.image}" alt="${product.title}" 
                                class="object-cover object-center w-full h-full opacity-90 group-hover:scale-110 group-hover:opacity-100 transition-transform duration-700 ease-out">
                            <div class="absolute top-4 left-4 ${product.badge.color} text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-lg">
                                ${product.badge.text}
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="flex-grow px-5 pt-5 pb-2">
                            <p class="text-blue-500 text-[10px] font-bold mb-1 tracking-wider uppercase">${product.model}</p>
                            <h3 class="text-lg font-bold leading-tight mb-3 text-slate-800 group-hover:text-blue-600 transition-colors line-clamp-2">${product.title}</h3>
                            <div class="flex flex-wrap gap-2 mb-4">
                                ${specsHtml}
                            </div>
                        </div>

                        <div class="flex items-center justify-between px-5 pb-5 pt-2 mt-auto">
                            <div>
                                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Price</p>
                                <p class="text-xl font-bold text-slate-800">${product.price}</p>
                            </div>
                            <button onclick="scrollToInquiry('${product.model}')" class="text-white bg-blue-600 hover:bg-blue-700 px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-lg shadow-blue-500/20 hover:shadow-blue-600/40 transform hover:-translate-y-0.5 active:translate-y-0">
                                Inquire
                            </button>
                        </div>
                    </div>
                </div>
            `;
                }

                // Filter Action
                window.filterCategory = function(category, title) {
                    // Update Title using FontAwesome icon + text to maintain structure
                    currentCategoryTitle.querySelector('span').innerText = title;
                    closeDropdown();
                    renderProducts(category);

                    // Re-init reveal observer for new elements is handled by the render timeout, 
                    // but we need to ensure the observer catches them if they scroll into view later.
                    // For this simple implementation, we just add 'active' class directly in renderProducts
                };

                // Scroll to Inquiry
                window.scrollToInquiry = function(model) {
                    const inquirySection = document.getElementById('inquiry');
                    const messageArea = document.getElementById('message-area');

                    inquirySection.scrollIntoView({
                        behavior: 'smooth'
                    });

                    if (model) {
                        setTimeout(() => {
                            messageArea.value = `I am interested in the: ${model}. Please provide more details.`;
                            messageArea.focus();
                        }, 800);
                    }
                };

                // Handle Form Submit
                window.handleFormSubmit = function(e) {
                    e.preventDefault();
                    const btn = e.target.querySelector('button');
                    const originalText = btn.innerHTML;

                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
                    btn.disabled = true;
                    btn.classList.add('opacity-75');

                    setTimeout(() => {
                        alert('Thank you! Your inquiry has been sent successfully.');
                        e.target.reset();
                        btn.innerHTML = originalText;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75');
                    }, 1500);
                };

                // Reveal Animation Observer
                function initRevealAnimation() {
                    const observerOptions = {
                        root: null,
                        rootMargin: '0px',
                        threshold: 0.1
                    };

                    const observer = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add('active');
                                // Optional: Stop observing once revealed
                                // observer.unobserve(entry.target);
                            }
                        });
                    }, observerOptions);

                    const revealElements = document.querySelectorAll('.reveal');
                    revealElements.forEach(el => observer.observe(el));
                }
            </script>
        @endpush
    @endsection
