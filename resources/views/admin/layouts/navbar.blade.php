<header
    class="h-16 bg-white shadow-md flex items-center justify-between px-6 sticky top-0 z-30 border-b border-gray-200">

    {{-- Left Section: Branding & Sidebar Toggle --}}
    <div class="flex items-center gap-4">
        {{-- Mobile Sidebar Toggle --}}
        <button id="open-sidebar"
            class="md:hidden text-primary focus:outline-none p-1 rounded hover:bg-gray-100 transition">
            <i class="fas fa-bars text-xl"></i>
        </button>

        {{-- Branding/Page Title Area (Can be customized later) --}}
        <div class="hidden sm:block text-xl font-bold text-gray-800">
            <span class="text-primary">Admin</span> Panel
        </div>
    </div>

    <div x-data="{ open: false }" class="relative">

        <button @click="open = !open" class="flex items-center gap-3 p-2 pr-3 rounded-full 
            text-gray-700 hover:bg-gray-100 
            focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 
            transition duration-200" :aria-expanded="open.toString()">

            {{-- User Avatar --}}
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=266eb1&color=fff"
                alt="User Avatar" class="h-9 w-9 rounded-full object-cover border-2 border-primary shadow-md">

            {{-- User Name --}}
            <span class="hidden md:block font-semibold text-base whitespace-nowrap">
                {{ Auth::user()->name }}
            </span>

            {{-- Dropdown Indicator --}}
            <i class="fas fa-chevron-down text-xs text-gray-400 hidden md:block transition-transform duration-300"
                :class="{'rotate-180': open}">
            </i>
        </button>

        {{-- Dropdown menu --}}
        <div x-show="open" @click.outside="open = false"
            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg overflow-hidden z-50">

            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-user mr-2"></i> Profile
            </a>
        </div>

    </div>

</header>