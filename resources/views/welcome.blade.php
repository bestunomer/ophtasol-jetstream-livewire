<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

    </head>
    <body class="antialiased">

        <header class="">
            <nav x-data="{ open: false }" class="block">
                <div class="flex flex-row justify-around items-center bg-slate-700 text-slate-400">

                    <div class="box-content flex-initial w-32 p-4">
                        <a href="/">
                            <img src="/img/ophtasol-logo-white.png" alt="Ophtasol Logo" class="w-full">
                        </a>
                    </div>

                    <div class="hidden md:flex flex-1 grow inline-flex gap-4">
                         <a href="#" class="flex lg:inline-flex hover:text-white items-center">
                            Home
                         </a>
                        <div class="">
                            <x-dropdown width="96">
                                <x-slot name="trigger">
                                        <a href="#" class="group flex lg:inline-flex hover:text-white items-center">
                                            <span class="clear-left">Products</span>
                                            <x-icon svgName="down-arrow" class="ml-1 stroke-slate-200 group-hover:stroke-white group-hover:stroke-2" style="right: 12px;" width="22" height="22" />
                                        </a>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-item>Ophthalmic Lasers</x-dropdown-item>
                                    <x-dropdown-item>Eye Ultrasounds</x-dropdown-item>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        <div class="hover:text-white">
                            <a href="#" class="">
                                Contact Us
                            </a>
                        </div>
                        <div class="hover:text-white">
                            <a href="#">
                                About Us
                            </a>
                        </div>
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
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">

                    <div class="pt-2 pb-3 space-y-1">
                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')" class="hover:text-sky-900">
                            {{ __('Home') }}
                        </x-responsive-nav-link>

                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')" class="hover:text-sky-900">
                            {{ __('Products') }}
                        </x-responsive-nav-link>

                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')" class="hover:text-sky-900">
                            {{ __('Contact Us') }}
                        </x-responsive-nav-link>

                        <x-responsive-nav-link href="#" :active="request()->routeIs('dashboard')" class="hover:text-sky-900">
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
        </header>
        <main>

        </main>
        <footer>

        </footer>
        
        @stack('modals')

        @livewireScripts
    </body>
</html>
