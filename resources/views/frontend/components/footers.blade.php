<footer class="relative bg-[#020617] text-slate-300 pt-16 pb-8 overflow-hidden">
    <div
        class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-blue-500/50 to-transparent">
    </div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 mb-16">

            <div class="lg:col-span-4">
                <a href="{{ url('/') }}" class="flex items-center gap-3 mb-6 group">
                    <img src="{{ asset('imagess/logo.svg') }}" alt="Tech Verse Logo"
                        class="w-12 transition-transform duration-300 group-hover:scale-110">
                    <div class="flex flex-col">
                        <span class="text-2xl font-bold tracking-tight text-white">
                            Tech<span class="text-blue-500">Verse</span>
                        </span>
                        <span class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-semibold">Pvt.
                            Ltd.</span>
                    </div>
                </a>
                <p class="text-slate-400 leading-relaxed mb-6 max-w-sm">
                    Empowering the next generation of digital solutions. We build high-performance software with a focus
                    on speed, reliability, and user-centric design.
                </p>
                <div class="flex gap-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-blue-600 hover:border-blue-600 transition-all duration-300">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-blue-600 hover:border-blue-600 transition-all duration-300">
                        <i class="fab fa-linkedin-in text-sm"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 flex items-center justify-center hover:bg-pink-600 hover:border-pink-600 transition-all duration-300">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-2">

            </div>

            <div class="lg:col-span-2">
                <h4 class="text-white font-semibold mb-6">Company</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition-colors">About Us</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-blue-400 transition-colors">Services</a>
                    </li>
                    <li><a href="{{ route('projects') }}" class="hover:text-blue-400 transition-colors">Projects</a>
                    </li>
                    <li><a href="{{ route('products') }}" class="hover:text-blue-400 transition-colors">Products</a>
                    </li>
                    <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition-colors">Contact</a></li>
                </ul>
            </div>

            <div class="lg:col-span-4">
                <h4 class="text-white font-semibold mb-6">Stay Updated</h4>
                <p class="text-sm text-slate-400 mb-4">Subscribe to get the latest tech insights and updates.</p>
                <form class="flex flex-col gap-3">
                    <div class="relative">
                        <input type="email" placeholder="Enter your email"
                            class="w-full bg-slate-900 border border-slate-800 rounded-lg px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-colors">
                        <button type="submit"
                            class="absolute right-2 top-2 bottom-2 bg-blue-600 hover:bg-blue-500 text-white px-4 rounded-md text-xs font-semibold transition-colors">
                            Join
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div
            class="pt-8 border-t border-slate-900 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-medium text-slate-500">
            <p>© 2026 Tech Verse Pvt. Ltd. All rights reserved.</p>
            <div class="flex gap-8">
                <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-white transition-colors">Cookie Policy</a>
            </div>
        </div>
    </div>
</footer>
