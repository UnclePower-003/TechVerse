@extends('frontend.app')

@section('content')
    @push('style')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap');

            body {
                font-family: 'Inter', sans-serif;
                background-color: #f3f4f6;
                /* Light gray background for contrast */
            }

            /* Utilities */
            .hidden-view {
                display: none !important;
            }

            .fade-in {
                animation: fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(15px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
            }

            ::-webkit-scrollbar-track {
                background: #1f2937;
            }

            ::-webkit-scrollbar-thumb {
                background: #4b5563;
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #6b7280;
            }

            /* Prevent layout shift on hover */
            .border-transparent-fix {
                border-width: 2px;
                border-style: solid;
                border-color: transparent;
            }

            .group:hover .border-transparent-fix {
                border-color: rgba(59, 130, 246, 0.3);
            }
        </style>
    @endpush


    <!-- Main Container with Top Padding for Fixed Header -->
    <main class="mt-10 pb-12 min-h-screen">

        <!-- STEP 1: Device Selection View -->
        <section id="view-selection" class="max-w-6xl mx-auto px-4 sm:px-6 fade-in">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-3xl sm:text-5xl md:text-6xl font-extrabold mb-4 tracking-tight text-slate-800">
                    Build your <span class="text-blue-600">Masterpiece.</span>
                </h2>
                <p class="text-slate-500 text-base sm:text-lg max-w-2xl mx-auto px-4">
                    Configure high-performance hardware with precision and real-time compatibility checks.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-10">
                <!-- PC Option -->
                <div onclick="initBuilder('pc')"
                    class="group cursor-pointer bg-[#e5effa] rounded-3xl shadow-xl  hover:shadow-2xl hover:shadow-blue-500/10 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                    <div class="aspect-[16/9] overflow-hidden bg-slate-100 relative">
                        <!-- Placeholder or Real Image -->
                        <img src="{{ asset('imagess/buildupimages/PC.png') }}"
                            onerror="this.src='https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&q=80&w=800'"
                            alt="PC"
                            class="w-full h-full object-cover transition-transform duration-700">
                        <div class="absolute inset-0  bg-gradient-to-t from-[#e5effa] via-transparent to-transparent opacity-95">
                        </div>
                    </div>
                    <div class="p-6 sm:p-8 relative -mt-16">
                        <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-2">Workstation / PC</h3>
                        <p class="text-slate-500 text-sm sm:text-base mb-6 leading-relaxed">Optimized for high clock speeds,
                            gaming, and 3D creative workflows.</p>
                        <span
                            class="inline-flex items-center text-blue-600 font-bold uppercase text-xs sm:text-sm tracking-widest group-hover:gap-2 transition-all">
                            Configure PC
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </span>
                    </div>
                </div>

                <!-- Server Option -->
                <div onclick="initBuilder('server')"
                    class="group cursor-pointer bg-[#e5effa] rounded-xl shadow-xl hover:shadow-3xl hover:shadow-green-500/10 hover:-translate-y-1 transition-all duration-300 overflow-hidden ">
                    <div class="aspect-[16/9] overflow-hidden bg-slate-100 relative">
                        <img src="{{ asset('imagess/buildupimages/server.png') }}"
                            onerror="this.src='https://images.unsplash.com/photo-1558494949-efc5e66cd38f?auto=format&fit=crop&q=80&w=800'"
                            alt="Server"
                            class="w-full h-full object-cover  transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#e5effa] via-transparent to-transparent opacity-90">
                        </div>
                    </div>
                    <div class="p-6 sm:p-8 relative -mt-16">
                        <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mb-2">Enterprise Server</h3>
                        <p class="text-slate-500 text-sm sm:text-base mb-6 leading-relaxed">Scalable infrastructure designed
                            for 24/7 reliability and massive throughput.</p>
                        <span
                            class="inline-flex items-center text-green-600 font-bold uppercase text-xs sm:text-sm tracking-widest group-hover:gap-2 transition-all">
                            Configure Server
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </span>
                    </div>
                </div>


            </div>
        </section>

        <!-- STEP 2: Component Builder View -->

        <!-- Added pb-40 to prevent bottom bar from covering last item -->
        <section id="view-builder" class="hidden-view max-w-4xl mx-auto px-4 sm:px-6 pb-40 fade-in">
            <section>
                <div class="w-full py-4 flex justify-between text-center ">
                    <div class="flex justify-center items-center text-center ">
                        <p id="platform-badge" class='bg-white text-slate-400 py-1 px-4 rounded-full'>pc</p>
                    </div>
                    <button onclick="resetBuilder()"
                        class="text-xs font-bold text-slate-200 bg-blue-600 p-3 rounded-lg hover:text-slate-300 transition uppercase tracking-widest flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span class="hidden sm:inline">Start Over</span>
                    </button>
                </div>
            </section>

            <header
                class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-slate-200 pb-6">
                <div>
                    <h2 id="builder-title" class="text-2xl sm:text-3xl font-black text-slate-800">Configuring Build</h2>
                    <p class="text-slate-500 mt-1 text-sm sm:text-base">Compatible components selected for your
                        architecture.</p>
                </div>

            </header>

            <div id="component-list" class="space-y-4 ">
                <!-- Dynamic components injected here -->
            </div>
        </section>

        <!-- STEP 3: Review View -->
        <section id="view-review" class="hidden-view max-w-3xl mx-auto px-4 sm:px-6 pb-40 fade-in text-center">
            <div
                class="w-16 h-16 sm:w-20 sm:h-20 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl sm:text-4xl shadow-xl shadow-blue-500/30">
                ✓</div>
            <h2 class="text-3xl sm:text-4xl font-black mb-3 text-slate-800">Ready for Deployment</h2>
            <p class="text-slate-500 mb-8 sm:mb-10">Review your final configuration summary below.</p>

            <div id="summary-content"
                class="bg-[#e5effa] shadow-xl shadow-slate-200/50 rounded-lg p-6 sm:p-8 text-left  mb-8">
                <!-- Summary injected here -->
            </div>

            <button onclick="resetBuilder()"
                class="text-slate-400 hover:text-red-600 font-bold transition uppercase text-xs tracking-widest py-3">
                Discard & Start Over
            </button>
        </section>

    </main>

    <!-- MODAL: Selection Menu -->
    <div id="modal"
        class="hidden fixed inset-0 z-[50] pt-[90px] justify-center flex items-center px-2 backdrop-blur-md bg-slate-900/60 transition-opacity duration-300">

        <div class="absolute inset-0" onclick="closeModal()"></div>

        <div
            class="relative bg-[#d1e2f6] w-full max-w-5xl max-h-[80vh] rounded-lg shadow-2xl flex flex-col overflow-hidden">

            <div class="p-4 border-b border-slate-100 flex justify-between items-center bg-[#d1e2f6] sticky top-0 z-20">
                <div>
                    <h3 id="modal-title" class="text-base sm:text-xl font-bold text-slate-800">Select Component</h3>
                    <p class="text-[9px] sm:text-xs text-slate-400 uppercase tracking-widest mt-0.5 font-semibold">
                        Authorized Inventory</p>
                </div>
                <button onclick="closeModal()"
                    class="w-8 h-8 sm:w-10 sm:h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-red-50 text-slate-400 hover:text-red-500 transition-colors">
                    <span class="text-2xl leading-none">&times;</span>
                </button>
            </div>

            <div id="modal-options"
                class="flex-1 p-4 sm:p-6 grid grid-cols-1 md:grid-cols-2  gap-4  overflow-y-auto custom-scrollbar">
            </div>
            {{-- bg-[#e5effa] --}}
            <div class="p-3   bg-[#d1e2f6]">

            </div>

        </div>
    </div>

    <!-- FIXED BOTTOM TOTAL BAR -->
    <div id="bottom-bar"
        class=" bottom-0 left-0 right-0 bg-white border-t border-slate-200 p-4 sm:p-5 z-40 shadow-[0_-5px_20px_rgba(0,0,0,0.05)] transition-transform duration-500 translate-y-full">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">

            <div class="flex items-center justify-between w-full sm:w-auto gap-4 sm:gap-8">
                <div class="hidden md:block">
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1">Architecture Progress
                    </p>
                    <div id="selection-count" class="flex gap-1.5 h-2 items-center">
                        <!-- Dots indicating progress -->
                    </div>
                </div>
                <div>
                    <p
                        class="text-[10px] text-slate-400 uppercase tracking-widest font-bold mb-1 text-center sm:text-left">
                        Total Configuration Price</p>
                    <h2 id="total-price"
                        class="text-2xl sm:text-3xl font-black text-slate-800 leading-none min-w-[100px] text-center sm:text-left">
                        Rs 0.00</h2>
                </div>
            </div>

            <button id="review-btn" onclick="showReview()" disabled
                class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 disabled:bg-slate-200 disabled:text-slate-400 disabled:cursor-not-allowed px-8 py-3 sm:py-4 rounded-xl text-white font-bold transition-all shadow-lg shadow-blue-500/20 disabled:shadow-none uppercase text-xs tracking-widest whitespace-nowrap">
                Review Build
            </button>
        </div>
    </div>


    @push('script')
        <script>
            function openModal() {
                const modal = document.getElementById('modal');
                modal.classList.remove('hidden');
                // Disable body scroll
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                const modal = document.getElementById('modal');
                modal.classList.add('hidden');
                // Enable body scroll
                document.body.style.overflow = 'auto';
            }
            // --- DATA START --- (Same Data as before, kept for functionality)
            const partsData = {
                pc: [{
                        id: 'motherboard',
                        name: 'MotherBoard',
                        icon: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.9375 5.0625C16.0867 5.0625 16.2298 5.12176 16.3352 5.22725C16.4407 5.33274 16.5 5.47582 16.5 5.625V13.5C16.5 13.6492 16.4407 13.7923 16.3352 13.8977C16.2298 14.0032 16.0867 14.0625 15.9375 14.0625C15.7883 14.0625 15.6452 14.0032 15.5398 13.8977C15.4343 13.7923 15.375 13.6492 15.375 13.5V5.625C15.375 5.47582 15.4343 5.33274 15.5398 5.22725C15.6452 5.12176 15.7883 5.0625 15.9375 5.0625ZM18.1875 5.0625C18.3367 5.0625 18.4798 5.12176 18.5852 5.22725C18.6907 5.33274 18.75 5.47582 18.75 5.625V13.5C18.75 13.6492 18.6907 13.7923 18.5852 13.8977C18.4798 14.0032 18.3367 14.0625 18.1875 14.0625C18.0383 14.0625 17.8952 14.0032 17.7898 13.8977C17.6843 13.7923 17.625 13.6492 17.625 13.5V5.625C17.625 5.47582 17.6843 5.33274 17.7898 5.22725C17.8952 5.12176 18.0383 5.0625 18.1875 5.0625ZM6.9375 14.0625C6.78832 14.0625 6.64524 14.1218 6.53975 14.2273C6.43426 14.3327 6.375 14.4758 6.375 14.625C6.375 14.7742 6.43426 14.9173 6.53975 15.0227C6.64524 15.1282 6.78832 15.1875 6.9375 15.1875H13.6875C13.8367 15.1875 13.9798 15.1282 14.0852 15.0227C14.1907 14.9173 14.25 14.7742 14.25 14.625C14.25 14.4758 14.1907 14.3327 14.0852 14.2273C13.9798 14.1218 13.8367 14.0625 13.6875 14.0625H6.9375ZM6.9375 16.3125C6.78832 16.3125 6.64524 16.3718 6.53975 16.4773C6.43426 16.5827 6.375 16.7258 6.375 16.875C6.375 17.0242 6.43426 17.1673 6.53975 17.2727C6.64524 17.3782 6.78832 17.4375 6.9375 17.4375H13.6875C13.8367 17.4375 13.9798 17.3782 14.0852 17.2727C14.1907 17.1673 14.25 17.0242 14.25 16.875C14.25 16.7258 14.1907 16.5827 14.0852 16.4773C13.9798 16.3718 13.8367 16.3125 13.6875 16.3125H6.9375ZM8.625 6.1875C8.32663 6.1875 8.04048 6.30603 7.82951 6.517C7.61853 6.72798 7.5 7.01413 7.5 7.3125H6.9375C6.78832 7.3125 6.64524 7.37176 6.53975 7.47725C6.43426 7.58274 6.375 7.72582 6.375 7.875C6.375 8.02418 6.43426 8.16726 6.53975 8.27275C6.64524 8.37824 6.78832 8.4375 6.9375 8.4375H7.5V9.5625H6.9375C6.78832 9.5625 6.64524 9.62176 6.53975 9.72725C6.43426 9.83274 6.375 9.97582 6.375 10.125C6.375 10.2742 6.43426 10.4173 6.53975 10.5227C6.64524 10.6282 6.78832 10.6875 6.9375 10.6875H7.5C7.5 10.9859 7.61853 11.272 7.82951 11.483C8.04048 11.694 8.32663 11.8125 8.625 11.8125V12.375C8.625 12.5242 8.68426 12.6673 8.78975 12.7727C8.89524 12.8782 9.03832 12.9375 9.1875 12.9375C9.33668 12.9375 9.47976 12.8782 9.58525 12.7727C9.69074 12.6673 9.75 12.5242 9.75 12.375V11.8125H10.875V12.375C10.875 12.5242 10.9343 12.6673 11.0398 12.7727C11.1452 12.8782 11.2883 12.9375 11.4375 12.9375C11.5867 12.9375 11.7298 12.8782 11.8352 12.7727C11.9407 12.6673 12 12.5242 12 12.375V11.8125C12.2984 11.8125 12.5845 11.694 12.7955 11.483C13.0065 11.272 13.125 10.9859 13.125 10.6875H13.6875C13.8367 10.6875 13.9798 10.6282 14.0852 10.5227C14.1907 10.4173 14.25 10.2742 14.25 10.125C14.25 9.97582 14.1907 9.83274 14.0852 9.72725C13.9798 9.62176 13.8367 9.5625 13.6875 9.5625H13.125V8.4375H13.6875C13.8367 8.4375 13.9798 8.37824 14.0852 8.27275C14.1907 8.16726 14.25 8.02418 14.25 7.875C14.25 7.72582 14.1907 7.58274 14.0852 7.47725C13.9798 7.37176 13.8367 7.3125 13.6875 7.3125H13.125C13.125 7.01413 13.0065 6.72798 12.7955 6.517C12.5845 6.30603 12.2984 6.1875 12 6.1875V5.625C12 5.47582 11.9407 5.33274 11.8352 5.22725C11.7298 5.12176 11.5867 5.0625 11.4375 5.0625C11.2883 5.0625 11.1452 5.12176 11.0398 5.22725C10.9343 5.33274 10.875 5.47582 10.875 5.625V6.1875H9.75V5.625C9.75 5.47582 9.69074 5.33274 9.58525 5.22725C9.47976 5.12176 9.33668 5.0625 9.1875 5.0625C9.03832 5.0625 8.89524 5.12176 8.78975 5.22725C8.68426 5.33274 8.625 5.47582 8.625 5.625V6.1875ZM8.625 7.3125H12V10.6875H8.625V7.3125ZM15.9375 15.1875C15.7883 15.1875 15.6452 15.2468 15.5398 15.3523C15.4343 15.4577 15.375 15.6008 15.375 15.75V16.875C15.375 17.0242 15.4343 17.1673 15.5398 17.2727C15.6452 17.3782 15.7883 17.4375 15.9375 17.4375H18.1875C18.3367 17.4375 18.4798 17.3782 18.5852 17.2727C18.6907 17.1673 18.75 17.0242 18.75 16.875V15.75C18.75 15.6008 18.6907 15.4577 18.5852 15.3523C18.4798 15.2468 18.3367 15.1875 18.1875 15.1875H15.9375Z" fill="black"></path><path d="M4.125 5.0625C4.125 4.46576 4.36205 3.89347 4.78401 3.47151C5.20597 3.04955 5.77826 2.8125 6.375 2.8125H18.75C19.3467 2.8125 19.919 3.04955 20.341 3.47151C20.7629 3.89347 21 4.46576 21 5.0625V17.4375C21 18.0342 20.7629 18.6065 20.341 19.0285C19.919 19.4504 19.3467 19.6875 18.75 19.6875H6.375C5.77826 19.6875 5.20597 19.4504 4.78401 19.0285C4.36205 18.6065 4.125 18.0342 4.125 17.4375V15.1875H3.5625C3.41332 15.1875 3.27024 15.1282 3.16475 15.0227C3.05926 14.9173 3 14.7742 3 14.625V13.5C3 13.3508 3.05926 13.2077 3.16475 13.1023C3.27024 12.9968 3.41332 12.9375 3.5625 12.9375H4.125V11.8125H3.5625C3.41332 11.8125 3.27024 11.7532 3.16475 11.6477C3.05926 11.5423 3 11.3992 3 11.25V10.125C3 9.97582 3.05926 9.83274 3.16475 9.72725C3.27024 9.62176 3.41332 9.5625 3.5625 9.5625H4.125V8.4375H3.5625C3.41332 8.4375 3.27024 8.37824 3.16475 8.27275C3.05926 8.16726 3 8.02418 3 7.875V5.625C3 5.47582 3.05926 5.33274 3.16475 5.22725C3.27024 5.12176 3.41332 5.0625 3.5625 5.0625H4.125ZM5.25 17.4375C5.25 17.7359 5.36853 18.022 5.5795 18.233C5.79048 18.444 6.07663 18.5625 6.375 18.5625H18.75C19.0484 18.5625 19.3345 18.444 19.5455 18.233C19.7565 18.022 19.875 17.7359 19.875 17.4375V5.0625C19.875 4.76413 19.7565 4.47798 19.5455 4.267C19.3345 4.05603 19.0484 3.9375 18.75 3.9375H6.375C6.07663 3.9375 5.79048 4.05603 5.5795 4.267C5.36853 4.47798 5.25 4.76413 5.25 5.0625V17.4375Z" fill="black"></path></svg>',
                        options: [{
                                name: 'Intel Core i9-14900K',
                                price: 620,
                                img: 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?auto=format&fit=crop&q=80&w=400'
                            },
                            {
                                name: 'AMD Ryzen 9 7950X3D',
                                price: 699,
                                img: 'https://images.unsplash.com/photo-1555617766-c94804975da3?auto=format&fit=crop&q=80&w=400'
                            },
                            {
                                name: 'Intel Core i7-14700K',
                                price: 409,
                                img: 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?auto=format&fit=crop&q=80&w=400'
                            }
                        ]
                    },
                    {
                        id: 'cpu',
                        name: 'Processor',
                        icon: '<svg width="24" height="24" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.6682 5.72017C9.55896 5.59718 8.43955 5.59718 7.33033 5.72017C6.50141 5.81247 5.82941 6.46601 5.73157 7.30509C5.59989 8.4311 5.59989 9.56862 5.73157 10.6946C5.82941 11.5346 6.50141 12.1863 7.33033 12.2796C8.43064 12.4023 9.56787 12.4023 10.6682 12.2796C11.0744 12.2344 11.4533 12.0532 11.7436 11.7655C12.0338 11.4778 12.2182 11.1004 12.2669 10.6946C12.3989 9.56847 12.3989 8.43124 12.2669 7.30509C12.2182 6.89932 12.0338 6.52194 11.7436 6.23422C11.4533 5.9465 11.0744 5.76534 10.6682 5.72017ZM7.48356 7.09647C8.48233 6.9857 9.51618 6.9857 10.5149 7.09647C10.6101 7.10698 10.699 7.14906 10.7674 7.21598C10.8358 7.28291 10.8799 7.37082 10.8925 7.4657C11.0116 8.48478 11.0116 9.51494 10.8925 10.534C10.8798 10.629 10.8356 10.7171 10.767 10.784C10.6984 10.8509 10.6093 10.8929 10.514 10.9032C9.50695 11.0147 8.49064 11.0147 7.48356 10.9032C7.38843 10.8927 7.29955 10.8507 7.23112 10.7837C7.16269 10.7168 7.11865 10.6289 7.10603 10.534C6.98695 9.51471 6.98695 8.48501 7.10603 7.4657C7.11869 7.37069 7.16287 7.28266 7.23148 7.21572C7.3001 7.14878 7.38918 7.10679 7.48449 7.09647H7.48356Z" fill="black"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M12.4615 0.692308C12.4615 0.508696 12.3886 0.332605 12.2588 0.202772C12.1289 0.0729393 11.9528 0 11.7692 0C11.5856 0 11.4095 0.0729393 11.2797 0.202772C11.1499 0.332605 11.0769 0.508696 11.0769 0.692308V3.02215C10.616 2.9898 10.1543 2.96825 9.69231 2.95754V1.61538C9.69231 1.43177 9.61937 1.25568 9.48954 1.12585C9.3597 0.996016 9.18361 0.923077 9 0.923077C8.81639 0.923077 8.6403 0.996016 8.51046 1.12585C8.38063 1.25568 8.30769 1.43177 8.30769 1.61538V2.95754C7.84571 2.96825 7.38405 2.9898 6.92308 3.02215V0.692308C6.92308 0.508696 6.85014 0.332605 6.7203 0.202772C6.59047 0.0729393 6.41438 0 6.23077 0C6.04716 0 5.87107 0.0729393 5.74123 0.202772C5.6114 0.332605 5.53846 0.508696 5.53846 0.692308V3.15877C4.94824 3.26604 4.4051 3.55167 3.98224 3.97717C3.55938 4.40267 3.27713 4.94759 3.17354 5.53846H0.692308C0.508696 5.53846 0.332605 5.6114 0.202772 5.74123C0.0729393 5.87107 0 6.04716 0 6.23077C0 6.41438 0.0729393 6.59047 0.202772 6.7203C0.332605 6.85014 0.508696 6.92308 0.692308 6.92308H3.03415C3.00092 7.38462 2.97877 7.84615 2.96677 8.30769H1.61538C1.43177 8.30769 1.25568 8.38063 1.12585 8.51046C0.996016 8.6403 0.923077 8.81639 0.923077 9C0.923077 9.18361 0.996016 9.3597 1.12585 9.48954C1.25568 9.61937 1.43177 9.69231 1.61538 9.69231H2.96677C2.97877 10.1538 3.00092 10.6154 3.03415 11.0769H0.692308C0.508696 11.0769 0.332605 11.1499 0.202772 11.2797C0.0729393 11.4095 0 11.5856 0 11.7692C0 11.9528 0.0729393 12.1289 0.202772 12.2588C0.332605 12.3886 0.508696 12.4615 0.692308 12.4615H3.17354C3.27713 13.0524 3.55938 13.5973 3.98224 14.0228C4.4051 14.4483 4.94824 14.734 5.53846 14.8412V17.3077C5.53846 17.4913 5.6114 17.6674 5.74123 17.7972C5.87107 17.9271 6.04716 18 6.23077 18C6.41438 18 6.59047 17.9271 6.7203 17.7972C6.85014 17.6674 6.92308 17.4913 6.92308 17.3077V14.9778C7.38277 15.0102 7.84523 15.0323 8.30769 15.0425V16.3846C8.30769 16.5682 8.38063 16.7443 8.51046 16.8742C8.6403 17.004 8.81639 17.0769 9 17.0769C9.18361 17.0769 9.3597 17.004 9.48954 16.8742C9.61937 16.7443 9.69231 16.5682 9.69231 16.3846V15.0425C10.1543 15.0318 10.616 15.0102 11.0769 14.9778V17.3077C11.0769 17.4913 11.1499 17.6674 11.2797 17.7972C11.4095 17.9271 11.5856 18 11.7692 18C11.9528 18 12.1289 17.9271 12.2588 17.7972C12.3886 17.6674 12.4615 17.4913 12.4615 17.3077V14.8412C13.0518 14.734 13.5949 14.4483 14.0178 14.0228C14.4406 13.5973 14.7229 13.0524 14.8265 12.4615H17.3077C17.4913 12.4615 17.6674 12.3886 17.7972 12.2588C17.9271 12.1289 18 11.9528 18 11.7692C18 11.5856 17.9271 11.4095 17.7972 11.2797C17.6674 11.1499 17.4913 11.0769 17.3077 11.0769H14.9658C14.9991 10.6154 15.0212 10.1538 15.0332 9.69231H16.3846C16.5682 9.69231 16.7443 9.61937 16.8742 9.48954C17.004 9.3597 17.0769 9.18361 17.0769 9C17.0769 8.81639 17.004 8.6403 16.8742 8.51046C16.7443 8.38063 16.5682 8.30769 16.3846 8.30769H15.0332C15.0212 7.84615 14.9991 7.38462 14.9658 6.92308H17.3077C17.4913 6.92308 17.6674 6.85014 17.7972 6.7203C17.9271 6.59047 18 6.41438 18 6.23077C18 6.04716 17.9271 5.87107 17.7972 5.74123C17.6674 5.6114 17.4913 5.53846 17.3077 5.53846H14.8265C14.7229 4.94759 14.4406 4.40267 14.0178 3.97717C13.5949 3.55167 13.0518 3.26604 12.4615 3.15877V0.692308ZM5.892 4.50462C7.95768 4.27567 10.0423 4.27567 12.108 4.50462C12.8215 4.58492 13.3911 5.14892 13.4732 5.85138C13.7179 7.94333 13.7179 10.0567 13.4732 12.1486C13.4299 12.4938 13.2715 12.8144 13.0237 13.0586C12.7758 13.3027 12.4529 13.4563 12.1071 13.4945C10.0417 13.7233 7.95738 13.7233 5.892 13.4945C5.54633 13.4561 5.22366 13.3025 4.97598 13.0583C4.7283 12.8141 4.57007 12.4937 4.52677 12.1486C4.28211 10.0567 4.28211 7.94333 4.52677 5.85138C4.57011 5.50616 4.72848 5.18561 4.97634 4.94143C5.2242 4.69726 5.54709 4.5437 5.89292 4.50554L5.892 4.50462Z" fill="black"></path></svg>',
                        options: [{
                                name: 'Intel Core i9-14900K',
                                price: 620,
                                img: 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?auto=format&fit=crop&q=80&w=400'
                            },
                            {
                                name: 'AMD Ryzen 9 7950X3D',
                                price: 699,
                                img: 'https://images.unsplash.com/photo-1555617766-c94804975da3?auto=format&fit=crop&q=80&w=400'
                            },
                            {
                                name: 'Intel Core i7-14700K',
                                price: 409,
                                img: 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?auto=format&fit=crop&q=80&w=400'
                            }
                        ]
                    },
                    // ... (Other PC components: GPU, RAM, Storage, Fan, Power, Case - Keeping your original structure but shortening for brevity in this response. Ensure all your original data is here)
                    {
                        id: 'gpu',
                        name: 'Graphics Card',
                        icon: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z" stroke="currentColor" stroke-width="2"/><path d="M12 12a3 3 0 100-6 3 3 0 000 6z" stroke="currentColor" stroke-width="2"/><path d="M6 18h12" stroke="currentColor" stroke-width="2"/></svg>',
                        options: [{
                                name: 'NVIDIA RTX 4090 24GB',
                                price: 1699,
                                img: 'https://images.unsplash.com/photo-1624705002806-5d72df19c3ad?auto=format&fit=crop&q=80&w=400'
                            },
                            {
                                name: 'NVIDIA RTX 4080 Super',
                                price: 999,
                                img: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=400'
                            }
                        ]
                    },
                    {
                        id: 'ram',
                        name: 'Memory',
                        icon: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 6h16M4 10h16M4 14h16M4 18h16" stroke="currentColor" stroke-width="2"/></svg>',
                        options: [{
                            name: '32GB DDR5-6400 RGB',
                            price: 125,
                            img: 'https://images.unsplash.com/photo-1562976540-1502c2145186?auto=format&fit=crop&q=80&w=400'
                        }]
                    },
                    {
                        id: 'storage',
                        name: 'Storage',
                        icon: '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 5h14v14H5z" stroke="currentColor" stroke-width="2"/><path d="M7 9h10M7 12h10M7 15h10" stroke="currentColor" stroke-width="1"/></svg>',
                        options: [{
                            name: '2TB Gen5 NVMe SSD',
                            price: 280,
                            img: 'https://images.unsplash.com/photo-1597872200370-4a9eb4693e08?auto=format&fit=crop&q=80&w=400'
                        }]
                    }
                ],
                server: [{
                        id: 'cpu',
                        name: 'Server CPU',
                        icon: '<svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21h18M3 7v8a6 6 0 006 6h6a6 6 0 006-6V7M7 3v4M11 3v4M15 3v4M19 3v4"></path></svg>',
                        options: [{
                                name: 'AMD EPYC 9754 (128C)',
                                price: 11900,
                                img: 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=400'
                            },
                            {
                                name: 'Intel Xeon Platinum 8480+',
                                price: 10700,
                                img: 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&q=80&w=400'
                            }
                        ]
                    },
                    {
                        id: 'ram',
                        name: 'ECC RDIMM',
                        icon: '<svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>',
                        options: [{
                                name: '256GB DDR5 ECC',
                                price: 1400,
                                img: 'https://images.unsplash.com/photo-1562976540-1502c2145186?auto=format&fit=crop&q=80&w=400'
                            },
                            {
                                name: '512GB DDR5 ECC',
                                price: 3200,
                                img: 'https://images.unsplash.com/photo-1562976540-1502c2145186?auto=format&fit=crop&q=80&w=400'
                            }
                        ]
                    }
                ]
            };
            // --- DATA END ---

            let currentBuildType = '';
            let selections = {};

            function initBuilder(type) {
                currentBuildType = type;
                selections = {};

                document.getElementById('view-selection').classList.add('hidden-view');
                document.getElementById('view-builder').classList.remove('hidden-view');
                document.getElementById('view-review').classList.add('hidden-view');

                document.getElementById('builder-title').innerText = type === 'pc' ? 'Personal Workstation' :
                    'Enterprise Infrastructure';
                document.getElementById('platform-badge').innerText = type.toUpperCase();

                // Animate bottom bar
                document.getElementById('bottom-bar').classList.remove('translate-y-full');

                renderComponentList();
                updateTotal();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            function resetBuilder() {
                document.getElementById('view-selection').classList.remove('hidden-view');
                document.getElementById('view-builder').classList.add('hidden-view');
                document.getElementById('view-review').classList.add('hidden-view');
                document.getElementById('bottom-bar').classList.add('translate-y-full');
                selections = {};
                updateTotal();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            function renderComponentList() {
                const container = document.getElementById('component-list');
                container.innerHTML = '';
                const categories = partsData[currentBuildType];

                categories.forEach(category => {
                    const selectedPart = selections[category.id];
                    const div = document.createElement('div');
                    // Responsive flex: col on mobile, row on tablet+
                    div.className =
                        "group border-transparent-fix bg-[#e5effa] p-4 sm:p-5 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between cursor-pointer transition-all duration-200 hover:shadow-lg hover:border-blue-500/30 gap-4 mb-3 border border-slate-100";
                    div.onclick = () => openModal(category.id);

                    div.innerHTML = `   
                        <div class="flex items-center gap-4 sm:gap-5 w-full">
                            <!-- Fixed dimensions for icon/image to prevent layout shift -->
                            <div class="w-14 h-14 min-w-[3.5rem] rounded-xl bg-white/60 flex items-center justify-center  border border-slate-200 overflow-hidden shrink-0">
                                ${selectedPart ? 
                                    `<img src="${selectedPart.img}" class="w-full h-full object-cover">` : 
                                    `<span class="text-slate-400 transform group-hover:scale-110 transition-transform">${category.icon}</span>`
                                }
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-slate-400 text-[10px] uppercase tracking-widest mb-0.5">${category.name}</h4>
                                <p class="${selectedPart ? 'text-blue-600' : 'text-slate-800'} font-bold text-sm sm:text-lg leading-tight truncate">
                                    ${selectedPart ? selectedPart.name : 'Choose Component'}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between sm:justify-end w-full sm:w-auto gap-4 pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-100 mt-2 sm:mt-0">
                            <p class="w-28 text-sm font-bold ${selectedPart ? 'text-slate-800' : 'text-slate-300'}">
                                ${selectedPart ? 'Rs ' + selectedPart.price.toLocaleString() : '--'}
                            </p>
                            <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-colors shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </div>
                    `;
                    container.appendChild(div);
                });

                updateProgressDots();
            }

            function updateProgressDots() {
                const dotContainer = document.getElementById('selection-count');
                dotContainer.innerHTML = '';
                const categories = partsData[currentBuildType];

                categories.forEach(cat => {
                    const dot = document.createElement('div');
                    const isSelected = !!selections[cat.id];
                    dot.className =
                        `h-2 rounded-full transition-all duration-300 ${isSelected ? 'bg-blue-500 w-6' : 'bg-slate-300 w-2'}`;
                    dotContainer.appendChild(dot);
                });
            }

            function openModal(categoryId) {
                const category = partsData[currentBuildType].find(c => c.id === categoryId);
                document.getElementById('modal-title').innerText = `Select ${category.name}`;
                const optionsContainer = document.getElementById('modal-options');
                optionsContainer.innerHTML = '';
                category.options.forEach(option => {
                    // Safely check if selected
                    const isSelected = selections[categoryId] && selections[categoryId].name === option.name;

                    const card = document.createElement('div');

                    // Improved Card Shell: responsive padding and border
                    card.className = `
        group relative h-auto bg-white border-2 cursor-pointer 
        transition-all duration-300 hover:shadow-lg rounded-lg overflow-clip
        ${isSelected ? 'border border-blue-400' : ''}
    `.trim();

                    card.onclick = () => selectPart(categoryId, option);

                    card.innerHTML = `
        <div class="aspect-[2/1] relative overflow-hidden ">
            <img src="${option.img}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
            
            <div class="absolute bottom-2 left-2 right-2 flex justify-between items-center">
                <span class="text-[9px] font-bold bg-blue-600 text-white px-2 py-0.5 rounded-full uppercase tracking-wider">
                    In Stock
                </span>
                <span class="font-mono font-bold text-sm sm:text-base text-white">
                    Rs ${option.price.toLocaleString()}
                </span>
            </div>
        </div>

        <div class="p-3 sm:p-4 bg-[#e5effa]">
            <h4 class="font-bold text-slate-800 text-xs sm:text-sm line-clamp-1 group-hover:text-blue-600 transition-colors">
                ${option.name}
            </h4>
            <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-widest font-medium">
                Premium Grade
            </p>
        </div>
        
        ${isSelected ? `
                                                                                            <div class="absolute top-2 right-2 bg-blue-600 text-white rounded-full p-1 shadow-md">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                                                                </svg>
                                                                                            </div>
                                                                                        ` : ''}
    `;
                    optionsContainer.appendChild(card);
                });

                document.getElementById('modal').classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            }

            function closeModal() {
                document.getElementById('modal').classList.add('hidden');
                document.body.style.overflow = ''; // Restore scrolling
            }

            function selectPart(categoryId, part) {
                selections[categoryId] = part;
                renderComponentList();
                updateTotal();
                closeModal();
            }

            function updateTotal() {
                const total = Object.values(selections).reduce((sum, item) => sum + item.price, 0);
                document.getElementById('total-price').innerText = `Rs ${total.toLocaleString()}`;

                const totalRequired = partsData[currentBuildType]?.length || 0;
                const currentSelected = Object.keys(selections).length;

                const btn = document.getElementById('review-btn');
                btn.disabled = currentSelected < totalRequired;
                btn.innerText = currentSelected < totalRequired ? `Select ${currentSelected}/${totalRequired}` :
                    'Finalize Review';
            }

            function showReview() {
                document.getElementById('view-builder').classList.add('hidden-view');
                document.getElementById('view-review').classList.remove('hidden-view');
                document.getElementById('bottom-bar').classList.add('translate-y-full');

                const summary = document.getElementById('summary-content');
                summary.innerHTML = `<div class="mb-6 pb-4 border-b border-slate-100 flex justify-between items-center">
                    <span class="text-slate-400 font-bold uppercase tracking-widest text-[10px]">Spec Sheet</span>
                    <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-widest border border-blue-100">${currentBuildType} platform</span>
                </div>`;

                Object.entries(selections).forEach(([key, part]) => {
                    const cat = partsData[currentBuildType].find(c => c.id === key);
                    summary.innerHTML += `
                        <div class="flex justify-between items-center py-3 border-b border-slate-50 last:border-0">
                            <div class="flex items-center gap-3 sm:gap-4">
                                <img src="${part.img}" class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg object-cover border border-slate-200">
                                <div>
                                    <p class="text-[9px] text-slate-400 uppercase font-black tracking-widest">${cat.name}</p>
                                    <p class="font-bold text-slate-800 text-sm sm:text-base">${part.name}</p>
                                </div>
                            </div>
                            <p class="font-mono text-slate-600 font-bold text-sm sm:text-base">Rs ${part.price.toLocaleString()}</p>
                        </div>
                    `;
                });

                const total = Object.values(selections).reduce((sum, item) => sum + item.price, 0);
                summary.innerHTML += `
                    <div class="mt-8 pt-6 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-center sm:text-left">
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">Total Investment</p>
                            <span class="text-3xl font-black text-blue-600 leading-none">Rs ${total.toLocaleString()}</span>
                        </div>
                        <button class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-xl font-bold transition shadow-xl shadow-green-500/20 uppercase tracking-widest text-sm">Checkout Now</button>
                    </div>
                `;
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // Mobile menu fix
            window.addEventListener('resize', () => {
                // Optional: Close modal on resize to prevent layout issues
            });
        </script>
    @endpush
@endsection
