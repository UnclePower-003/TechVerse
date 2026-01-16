<!-- sidebar.blade.php -->
<div x-data="{ sidebarOpen: false }" class="relative">

    <!-- Mobile Toggle Button -->
    <button @click="sidebarOpen = true"
        class="md:hidden fixed top-4 left-4 z-40 p-2 bg-secondary text-white rounded shadow-lg">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
        class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="bg-primary text-white w-[270px] h-full flex flex-col transition-transform duration-300 fixed z-40 md:relative md:translate-x-0">

        <!-- Logo -->
        <div class="h-16 flex items-center justify-center bg-primary shadow-xl">
            <img src="{{ asset('imagess/logo.svg') }}" alt="" class="w-[60px] bg-white rounded-md px-2">
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-2 py-4 space-y-2 overflow-y-auto styled-scrollbar" x-data="{ activeDropdown: null }">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false"
                class="flex items-center px-4 py-3 hover:bg-[#266eb1] hover:text-black hover:rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-[#266eb1] text-black font-semibold rounded-lg' : '' }}">
                <i class="fas fa-tachometer-alt w-6"></i>
                <span class="font-medium">Dashboard</span>
            </a>

            {{-- Users (Super Admin Only) --}}
            @if (auth()->user()->role === 'super_admin')
                <a href="{{ route('users.index') }}" @click="sidebarOpen = false"
                    class="flex items-center px-4 py-3 hover:bg-[#266eb1] hover:text-black hover:rounded-lg
                    {{ request()->routeIs('users.*') ? 'bg-[#266eb1] text-black font-semibold rounded-lg' : '' }}">
                    <i class="fa-solid fa-users w-6"></i>
                    <span class="font-medium">Users</span>
                </a>
            @endif

            {{-- @php
                $dropdowns = [
                    [
                        'title' => 'Home',
                        'icon' => 'fa-solid fa-house-chimney', // Home specific
                        'routes' => [
                            'home-location-content.*',
                            'home-images-grid.*',
                            'home-highlight-two.*',
                            'home-features.*',
                            'home-highlight-one.*',
                            'home-taste.*',
                            'home-hero-slider.*',
                        ],
                        'links' => [
                            [
                                'route' => 'home-hero-slider.index',
                                'icon' => 'fa-solid fa-images',
                                'text' => 'Hero Section',
                            ],
                            [
                                'route' => 'home-highlight-one.index',
                                'icon' => 'fa-solid fa-star',
                                'text' => 'Highlight 1 (Photo)',
                            ],
                            [
                                'route' => 'home-taste.index',
                                'icon' => 'fa-solid fa-utensils',
                                'text' => 'Taste Section',
                            ],
                            [
                                'route' => 'home-features.index',
                                'icon' => 'fa-solid fa-list-check',
                                'text' => 'Features',
                            ],
                            [
                                'route' => 'home-highlight-two.index',
                                'icon' => 'fa-solid fa-wand-magic-sparkles',
                                'text' => 'Highlight 2',
                            ],
                            [
                                'route' => 'home-images-grid.index',
                                'icon' => 'fa-solid fa-border-all',
                                'text' => 'Images Grid',
                            ],
                            [
                                'route' => 'home-location-content.index',
                                'icon' => 'fa-solid fa-map-location-dot',
                                'text' => 'Location Content',
                            ],
                        ],
                    ],
                    [
                        'title' => 'About',
                        'icon' => 'fa-solid fa-address-card', // About specific
                        'routes' => [
                            'about-hero.*',
                            'about-header.*',
                            'who-we-are-photos.*',
                            'who-we-are-contents.*',
                            'about-one.*',
                            'about-two.*',
                            'about-images-grid.*',
                            'about-quote.*',
                        ],
                        'links' => [
                            ['route' => 'about-hero.index', 'icon' => 'fa-solid fa-panorama', 'text' => 'Hero Section'],
                            [
                                'route' => 'about-header.index',
                                'icon' => 'fa-solid fa-heading',
                                'text' => 'Header Section',
                            ],
                            [
                                'route' => 'who-we-are-photos.index',
                                'icon' => 'fa-solid fa-camera-retro',
                                'text' => 'Who We Are Photos',
                            ],
                            [
                                'route' => 'who-we-are-contents.index',
                                'icon' => 'fa-solid fa-file-lines',
                                'text' => 'Who We Are Content',
                            ],
                            ['route' => 'about-one.index', 'icon' => 'fa-solid fa-1', 'text' => 'About One'],
                            ['route' => 'about-two.index', 'icon' => 'fa-solid fa-2', 'text' => 'About Two'],
                            [
                                'route' => 'about-images-grid.index',
                                'icon' => 'fa-solid fa-table-cells',
                                'text' => 'Images Grid',
                            ],
                            ['route' => 'about-quote.index', 'icon' => 'fa-solid fa-quote-left', 'text' => 'Quote'],
                        ],
                    ],
                    [
                        'title' => 'Accommodation',
                        'icon' => 'fa-solid fa-bed', // Accommodation specific
                        'routes' => [
                            'accommodation-hero.*',
                            'accommodation-header.*',
                            'rooms.*',
                            'accommodation-highlight.*',
                            'accommodation-highlight-pic.*',
                        ],
                        'links' => [
                            [
                                'route' => 'accommodation-hero.index',
                                'icon' => 'fa-solid fa-hotel',
                                'text' => 'Hero Section',
                            ],
                            [
                                'route' => 'accommodation-header.index',
                                'icon' => 'fa-solid fa-window-maximize',
                                'text' => 'Header Section',
                            ],
                            ['route' => 'rooms.index', 'icon' => 'fa-solid fa-door-open', 'text' => 'Rooms'],
                            [
                                'route' => 'accommodation-highlight.index',
                                'icon' => 'fa-solid fa-tags',
                                'text' => 'Highlights',
                            ],
                            [
                                'route' => 'accommodation-highlight-pic.index',
                                'icon' => 'fa-solid fa-image',
                                'text' => 'Highlight Photo',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Rates',
                        'icon' => 'fa-solid fa-file-invoice-dollar', // Rates specific
                        'routes' => [
                            'rates-hero.*',
                            'rate-header.*',
                            'room-rates.*',
                            'rates-table.*',
                            'exclusive-special-offer.*',
                            'important-infos.*',
                        ],
                        'links' => [
                            [
                                'route' => 'rates-hero.index',
                                'icon' => 'fa-solid fa-money-bill-wave',
                                'text' => 'Hero Section',
                            ],
                            ['route' => 'rate-header.index', 'icon' => 'fa-solid fa-font', 'text' => 'Rate Headers'],
                            [
                                'route' => 'room-rates.index',
                                'icon' => 'fa-solid fa-hand-holding-dollar',
                                'text' => 'Room Rates',
                            ],
                            [
                                'route' => 'rates-table.index',
                                'icon' => 'fa-solid fa-table-list',
                                'text' => 'Rates Table',
                            ],
                            [
                                'route' => 'exclusive-special-offer.index',
                                'icon' => 'fa-solid fa-gift',
                                'text' => 'Exclusive Offers',
                            ],
                            [
                                'route' => 'important-infos.index',
                                'icon' => 'fa-solid fa-circle-info',
                                'text' => 'Important Info',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Gallery',
                        'icon' => 'fa-solid fa-photo-film', // Gallery specific
                        'routes' => ['gallery-hero.*', 'gallery-headers.*', 'gallery-contents.*'],
                        'links' => [
                            [
                                'route' => 'gallery-hero.index',
                                'icon' => 'fa-solid fa-image-portrait',
                                'text' => 'Hero Section',
                            ],
                            [
                                'route' => 'gallery-headers.index',
                                'icon' => 'fa-solid fa-paragraph',
                                'text' => 'Hero Header',
                            ],
                            [
                                'route' => 'gallery-contents.index',
                                'icon' => 'fa-solid fa-images',
                                'text' => 'Gallery Contents',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Contact',
                        'icon' => 'fa-solid fa-paper-plane', // Contact specific
                        'routes' => [
                            'contact-hero.*',
                            'contact-header.*',
                            'contact-info.*',
                            'map-location.*',
                            'faqs.*',
                        ],
                        'links' => [
                            [
                                'route' => 'contact-hero.index',
                                'icon' => 'fa-solid fa-mountain-sun',
                                'text' => 'Hero Section',
                            ],
                            [
                                'route' => 'contact-header.index',
                                'icon' => 'fa-solid fa-header',
                                'text' => 'Hero Header',
                            ],
                            [
                                'route' => 'contact-info.index',
                                'icon' => 'fa-solid fa-address-book',
                                'text' => 'Contact Info',
                            ],
                            [
                                'route' => 'map-location.index',
                                'icon' => 'fa-solid fa-location-dot',
                                'text' => 'Map Location',
                            ],
                            ['route' => 'faqs.index', 'icon' => 'fa-solid fa-circle-question', 'text' => 'FAQs'],
                        ],
                    ],
                ];
            @endphp --}}

            {{-- Dropdown Loop --}}
            {{-- @foreach ($dropdowns as $dropdown)
                @php
                    $isActive = false;
                    foreach ($dropdown['routes'] as $pattern) {
                        if (request()->routeIs($pattern)) {
                            $isActive = true;
                            break;
                        }
                    }
                @endphp

                <div class="mb-2" x-init="{{ $isActive ? 'activeDropdown = \'' . $dropdown['title'] . '\'' : '' }}">

                    <button
                        @click="activeDropdown === '{{ $dropdown['title'] }}'
                    ? activeDropdown = null
                    : activeDropdown = '{{ $dropdown['title'] }}'"
                        class="flex items-center justify-between w-full px-4 py-3 hover:bg-[#9a9a1e] hover:text-black hover:rounded-lg transition
                    {{ $isActive ? 'bg-[#9a9a1e] text-black font-semibold rounded-lg' : '' }}">

                        <span class="flex items-center space-x-2">
                            <i class="{{ $dropdown['icon'] }} w-6"></i>
                            <span class="font-medium">{{ $dropdown['title'] }}</span>
                        </span>

                        <i :class="activeDropdown === '{{ $dropdown['title'] }}'
                            ?
                            'fa-solid fa-chevron-up' :
                            'fa-solid fa-chevron-down'"
                            class="transition-transform duration-300"></i>
                    </button>

                    <div x-show="activeDropdown === '{{ $dropdown['title'] }}'" x-transition
                        class="mt-1 space-y-1 pl-6">

                        @foreach ($dropdown['links'] as $link)
                            <a href="{{ route($link['route']) }}" @click="sidebarOpen = false"
                                class="flex items-center px-4 py-2 rounded-lg hover:bg-[#9a9a1e] hover:text-black
                                                        {{ request()->routeIs(explode('.', $link['route'])[0] . '.*')
                                                            ? 'bg-[#9a9a1e]  text-black font-semibold'
                                                            : 'text-white' }}">
                                <i class="{{ $link['icon'] }} w-6"></i>
                                <span class="font-medium">{{ $link['text'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach --}}

            {{-- <a href="{{ route('social-links.index') }}" @click="sidebarOpen = false"
                class="flex items-center px-4 py-3 hover:bg-[#9a9a1e] hover:text-black hover:rounded-lg
                    {{ request()->routeIs('social-links.*') ? 'bg-secondary text-black font-semibold rounded-lg' : '' }}">
                <i class="fa-solid fa-users w-6"></i>
                <span class="font-medium">Social Links (Footer)</span>
            </a> --}}
        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex w-full items-center px-4 py-2 text-gray-300 hover:text-white transition-colors">
                    <i class="fas fa-sign-out-alt w-6"></i>
                    <span class="font-medium ml-2">Logout</span>
                </button>
            </form>
        </div>
    </aside>
</div>
