<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="flex justify-between h-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="box-content flex-initial w-32 p-4">
            <a href="/">
                <img src="/img/ophtasol-logo.png" alt="Ophtasol Logo" class="w-full">
            </a>
        </div>

        <div class="hidden md:flex flex-1 grow gap-4">
            <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-nav-link>

            <x-dropdown width="96">
                    <x-slot name="trigger">
                        <x-nav-link  :active="request()->routeIs('products')">
                            {{ __('Products') }}
                        </x-nav-link>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-item>Ophthalmic Lasers</x-dropdown-item>
                        <x-dropdown-item>Ophthalmic Ultrasounds</x-dropdown-item>
                        <x-dropdown-item>Ophthalmic Furniture</x-dropdown-item>
                        <x-dropdown-item>Ophthalmic IT Solutions</x-dropdown-item>
                    </x-slot>
            </x-dropdown>

            <x-nav-link href="{{ route('contactUs') }}" :active="request()->routeIs('contactUs')">
                {{ __('Contact Us') }}
            </x-nav-link>

            <x-nav-link href="{{ route('aboutUs') }}" :active="request()->routeIs('aboutUs')">
                {{ __('About Us') }}
            </x-nav-link>
        </div>

        <div class="hidden md:flex gap-4">
            @if (Route::has('login'))
                    @auth
                        <div>
                            <a href="{{ url('/dashboard') }}" class="">Dashboard</a>
                        </div>
                    @else
                        <div>
                            <a href="{{ route('login') }}" class="hover:text-white">Log in</a>
                        </div>
                        @if (Route::has('register'))
                            <div>
                                <a href="{{ route('register') }}" class="hover:text-white mr-4">Register</a>
                            </div>
                        @endif
                    
                    @endauth
            @endif
            
        </div>

        <!-- Hamburger -->
        <div class="-mr-2 flex items-center md:hidden">
            <button @@click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="md:hidden">

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')" class="hover:text-sky-900">
                {{ __('Home') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="#" :active="request()->routeIs('products')" class="hover:text-sky-900">
                {{ __('Products') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="#" :active="request()->routeIs('contactUs')" class="hover:text-sky-900">
                {{ __('Contact Us') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link href="#" :active="request()->routeIs('aboutUs')" class="hover:text-sky-900">
                {{ __('About Us') }}
            </x-responsive-nav-link>

            @if (Route::has('login'))
                    @auth
                        <x-responsive-nav-link href="{{ url('/dashboard') }}">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                    @else
                        <x-responsive-nav-link href="{{ route('login') }}" class="hover:text-sky-900">
                            {{ __('Log in') }}
                        </x-responsive-nav-link>
                        @if (Route::has('register'))
                        <x-responsive-nav-link href="{{ route('register') }}" class="hover:text-sky-900 mr-4">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                        @endif
                    @endauth
            @endif  
        </div>
    </div>
</nav>
