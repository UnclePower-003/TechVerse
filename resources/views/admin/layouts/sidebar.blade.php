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

            <a href="{{ route('contact-submission.index') }}" @click="sidebarOpen = false"
                class="relative flex items-center px-4 py-3 transition-all duration-200
                {{ request()->routeIs('contact-submission.*')
                    ? 'bg-[#266eb1] text-black font-semibold rounded-lg shadow-sm'
                    : 'text-white hover:bg-[#266eb1] hover:text-black rounded-lg' }}">

                <i class="fas fa-envelope w-6"></i>
                <span class="font-medium ml-2">Contact Messages</span>

                @if ($contactUnreadCount > 0)
                    <span
                        class="absolute top-2 right-3 min-w-[18px] h-[18px] px-1 bg-[#ffe81a] text-black text-[10px] font-bold rounded-full flex items-center justify-center shadow-sm">
                        {{ $contactUnreadCount }}
                    </span>
                @endif
            </a>

            <a href="{{ route('product-requirements.index') }}" @click="sidebarOpen = false"
                class="relative flex items-center px-4 py-3 transition-all duration-200
                {{ request()->routeIs('product-requirements.*')
                    ? 'bg-[#266eb1] text-black font-semibold rounded-lg shadow-sm'
                    : 'text-white hover:bg-[#266eb1] hover:text-black rounded-lg' }}">

                <i class="fas fa-inbox w-6"></i>
                <span class="font-medium ml-2">Product Requirements</span>

                @if ($productUnreadCount > 0)
                    <span
                        class="absolute top-2 right-3 min-w-[18px] h-[18px] px-1 bg-[#ffe81a] text-black text-[10px] font-bold rounded-full flex items-center justify-center shadow-sm">
                        {{ $productUnreadCount }}
                    </span>
                @endif
            </a>

            @php
                $dropdowns = [
                    [
                        'title' => 'Home',
                        'icon' => 'fa-solid fa-house',
                        'routes' => ['home-hero.*', 'hero-header.*', 'home-stat.*', 'home-partners.*'],
                        'links' => [
                            ['route' => 'home-hero.index', 'icon' => 'fa-solid fa-star', 'text' => 'Hero Section'],
                            ['route' => 'hero-header.index', 'icon' => 'fa-solid fa-heading', 'text' => 'Hero Header'],
                            [
                                'route' => 'home-stat.index',
                                'icon' => 'fa-solid fa-chart-simple',
                                'text' => 'Home Stats',
                            ],
                            ['route' => 'home-partners.index', 'icon' => 'fa-solid fa-handshake', 'text' => 'Partners'],
                        ],
                    ],
                    [
                        'title' => 'Services',
                        'icon' => 'fa-solid fa-gears',
                        'routes' => ['services-hero.*', 'service-header.*', 'service-list.*', 'service-pick.*'],
                        'links' => [
                            [
                                'route' => 'services-hero.index',
                                'icon' => 'fa-solid fa-wand-magic-sparkles',
                                'text' => 'Hero Section',
                            ],
                            [
                                'route' => 'service-header.index',
                                'icon' => 'fa-solid fa-window-maximize',
                                'text' => 'Service Header',
                            ],
                            [
                                'route' => 'service-list.index',
                                'icon' => 'fa-solid fa-list-check',
                                'text' => 'Service List',
                            ],
                            [
                                'route' => 'service-pick.index',
                                'icon' => 'fa-solid fa-check-to-slot',
                                'text' => 'Service Pick',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Projects',
                        'icon' => 'fa-solid fa-diagram-project',
                        'routes' => ['project-hero.*', 'project-header.*', 'projects.*', 'project-quality.*'],
                        'links' => [
                            ['route' => 'project-hero.index', 'icon' => 'fa-solid fa-rocket', 'text' => 'Hero Section'],
                            [
                                'route' => 'project-header.index',
                                'icon' => 'fa-solid fa-id-card',
                                'text' => 'Project Header',
                            ],
                            ['route' => 'projects.index', 'icon' => 'fa-solid fa-briefcase', 'text' => 'Project List'],
                            [
                                'route' => 'project-quality.index',
                                'icon' => 'fa-solid fa-medal',
                                'text' => 'Project Quality Cards',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Products',
                        'icon' => 'fa-solid fa-box-archive',
                        'routes' => ['products-hero.*', 'products-header.*', 'categories.*', 'products.*'],
                        'links' => [
                            ['route' => 'products-hero.index', 'icon' => 'fa-solid fa-tag', 'text' => 'Hero Section'],
                            [
                                'route' => 'products-header.index',
                                'icon' => 'fa-solid fa-table-list',
                                'text' => 'Products Header',
                            ],
                            [
                                'route' => 'categories.index',
                                'icon' => 'fa-solid fa-layer-group',
                                'text' => 'Category List',
                            ],
                            [
                                'route' => 'products.index',
                                'icon' => 'fa-solid fa-cart-shopping',
                                'text' => 'Product List',
                            ],
                        ],
                    ],
                    [
                        'title' => 'About',
                        'icon' => 'fa-solid fa-circle-info',
                        'routes' => [
                            'about-hero.*',
                            'about-header.*',
                            'about-expertise.*',
                            'about-drive.*',
                            'about-highlight.*',
                            'about-promise.*',
                        ],
                        'links' => [
                            [
                                'route' => 'about-hero.index',
                                'icon' => 'fa-solid fa-address-card',
                                'text' => 'Hero Section',
                            ],
                            [
                                'route' => 'about-header.index',
                                'icon' => 'fa-solid fa-bullseye',
                                'text' => 'About Header',
                            ],
                            [
                                'route' => 'about-expertise.index',
                                'icon' => 'fa-solid fa-brain',
                                'text' => 'About Expertise',
                            ],
                            [
                                'route' => 'about-drive.index',
                                'icon' => 'fa-solid fa-gauge-high',
                                'text' => 'About Drive',
                            ],
                            [
                                'route' => 'about-highlight.index',
                                'icon' => 'fa-solid fa-highlighter',
                                'text' => 'About Highlights',
                            ],
                            [
                                'route' => 'about-promise.index',
                                'icon' => 'fa-solid fa-hand-holding-heart',
                                'text' => 'About Promises',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Get a Quote',
                        'icon' => 'fa-solid fa-file-invoice-dollar',
                        'routes' => [
                            'contact-hero.*',
                            'contact-header.*',
                            'contact-info.*',
                            'contact-support-promise.*',
                            'contact-choose.*',
                        ],
                        'links' => [
                            [
                                'route' => 'contact-hero.index',
                                'icon' => 'fa-solid fa-paper-plane',
                                'text' => 'Hero Section',
                            ],
                            [
                                'route' => 'contact-header.index',
                                'icon' => 'fa-solid fa-envelope-open-text',
                                'text' => 'Contact Header',
                            ],
                            [
                                'route' => 'contact-info.index',
                                'icon' => 'fa-solid fa-phone-volume',
                                'text' => 'Contact Info',
                            ],
                            [
                                'route' => 'contact-support-promise.index',
                                'icon' => 'fa-solid fa-headset',
                                'text' => 'Support Promise',
                            ],
                            [
                                'route' => 'contact-choose.index',
                                'icon' => 'fa-solid fa-thumbs-up',
                                'text' => 'Why Choose Us',
                            ],
                        ],
                    ],
                ];
            @endphp

            {{-- Dropdown Loop --}}
            @foreach ($dropdowns as $dropdown)
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
                        class="flex items-center justify-between w-full px-4 py-3 hover:bg-[#266eb1] hover:text-black hover:rounded-lg transition
                    {{ $isActive ? 'bg-[#266eb1] text-black font-semibold rounded-lg' : '' }}">

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
                                class="flex items-center px-4 py-2 rounded-lg hover:bg-[#266eb1] hover:text-black
                                {{ request()->routeIs(explode('.', $link['route'])[0] . '.*')
                                    ? 'bg-[#266eb1]  text-black font-semibold'
                                    : 'text-white' }}">
                                <i class="{{ $link['icon'] }} w-6"></i>
                                <span class="font-medium">{{ $link['text'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <a href="{{ route('social-links.index') }}" @click="sidebarOpen = false"
                class="flex items-center px-4 py-3 hover:bg-[#266eb1] hover:text-black hover:rounded-lg
                    {{ request()->routeIs('social-links.*') ? 'bg-[#266eb1] text-black font-semibold rounded-lg' : '' }}">
                <i class="fa-solid fa-users w-6"></i>
                <span class="font-medium">Social Links (Footer)</span>
            </a>
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
