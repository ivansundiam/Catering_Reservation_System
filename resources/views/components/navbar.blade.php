<nav x-data="{ open: false }" class="mx-4 text-black md:6 lg:mx-10 border-b border-gray-100 dark:text-white">
    <div class="flex justify-between">
        <a href="/" class="flex items-end my-2 ">
            <x-application-mark class="block" />
            <x-brand-name class="ml-2" />
        </a>
    
        <div class="items-center hidden sm:-my-px md:flex">
            <a href="/#services" class="nav-link">Services</a>
            <a href="/#about" class="nav-link">About</a>
            <a href="/#gallery" class="nav-link">Gallery</a>
        
            @if (Route::has('login'))
                @auth
                    @if (auth()->user()->user_type == 'admin')
                        <a href="{{ route('admin-dashboard') }}" class="nav-link">Dashboard</a>
                    @else
                        <x-dropdown width="48" align="left">
                            <x-slot name="trigger"  x-bind:triggerType="'hover'">
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="nav-link flex items-center">
                                            {{ __('Reservations') }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Reservations') }}
                                </div>

                                <x-dropdown-link href="{{ route('reservation.index') }}">
                                    {{ __('My Reservations') }}
                                </x-dropdown-link>


                                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                <x-dropdown-link href="{{ route('reservation.create') }}">
                                    {{ __('Add Reservation') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                        <!-- Settings Dropdown -->
                        <div class="relative flex ms-3 ">
                            <x-dropdown width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                            <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button" x-bind:class="{ '!bg-gray-200': open }" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-black transition duration-150 ease-in-out border border-transparent rounded-md shadow-md bg-gray-50 hover:bg-gray-100 active:bg-gray-200 dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 dark:active:bg-gray-700">
                                                {{ Auth::user()->name }}
    
                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>
    
                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>
    
                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
    
                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif
    
                                    <div class="border-t border-gray-200 dark:border-gray-600"></div>
    
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
    
                                        <x-dropdown-link href="{{ route('logout') }}"
                                                    @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif
            @else
                    {{-- <livewire:auth.login-modal :buttonName="'Login'" :classes="'nav-link'" /> --}}
                    <a href="{{ route('login') }}" class="nav-link">
                        {{ __('Login') }}
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link bg-primary !text-white hover:bg-primary-hover !no-underline">
                            {{ __('Sign Up') }}
                        </a>
                        {{-- @livewire('auth.RegisterModal') --}}
                    @endif
                @endauth
            @endif
        </div>
    
        <!-- Hamburger -->
        <div class="flex items-center -me-2 md:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="/#services">
                {{ __('Services') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/#about">
                {{ __('About') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="/#gallery">
                {{ __('Gallery') }}
            </x-responsive-nav-link>
            @if (auth()->user())
                <x-responsive-nav-link href="{{ route('reservation.create') }}" :active="request()->routeIs('reservation.create')">
                    {{ __('Reservation') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link href="{{ route('login') }}">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('register') }}">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endif
        </div>
        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 me-3">
                            <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>