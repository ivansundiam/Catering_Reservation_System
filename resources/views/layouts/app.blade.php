<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Robert Camba's catering services accepts reservations for weddings, debuts, birthdays, and other events. Log in to set up your reservations now!">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="https://www.abc/com/drive/uploads/2019/10/favicon.ico">

        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Preload -->
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Noticia+Text:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Tai+Heritage+Pro:wght@400;700&display=swap" as="font" type="font/woff2" crossorigin>
        <link rel="preload" fetchPriority="high" href="{{ asset('assets/images/hero-bg.jpg') }}" as="image">
        <link rel="preload" fetchPriority="high" href="{{ asset('assets/images/logo.png') }}" as="image">
        <link rel="preload" fetchPriority="high" href="{{ asset('assets/images/service1.png') }}" as="image">
        <link rel="preload" fetchPriority="high" href="{{ asset('assets/images/service2.png') }}" as="image">
        <link rel="preload" fetchPriority="high" href="{{ asset('assets/images/service3.png') }}" as="image">
        <link rel="preload" fetchPriority="high" href="{{ asset('assets/images/about-img1.jpg') }}" as="image">
        <link rel="preload" fetchPriority="high" href="{{ asset('assets/images/about-img2.jpg') }}" as="image">
        <link rel="preload" fetchPriority="high" href="{{ asset('assets/images/facility1.jpg') }}" as="image">
        <link rel="preload" fetchPriority="high" href="{{ asset('assets/images/facility2.jpg') }}" as="image">
        <link rel="preload" fetchPriority="high" href="{{ asset('assets/images/facility3.jpg') }}" as="image">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
            .bg-dots-lighter{background-image:url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")}
        </style>

        @livewireStyles
    </head>
    <body class="font-sans antialiased" x-data="{ loading: true }" x-init="$nextTick(() => loading = false)">
        <!-- Loading screen -->
        <div x-show="loading"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed z-50 flex items-center justify-center w-full h-full bg-primary-light">
            <div class="flex flex-col items-center text-center">
                <svg class="animate-spin" width="35px" height="35px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.0001 12C20.0001 13.3811 19.6425 14.7386 18.9623 15.9405C18.282 17.1424 17.3022 18.1477 16.1182 18.8587C14.9341 19.5696 13.5862 19.9619 12.2056 19.9974C10.825 20.0328 9.45873 19.7103 8.23975 19.0612" stroke="#bfbfbf" stroke-width="3.55556" stroke-linecap="round"></path> </g></svg>
            </div>
        </div>
        <x-navbar />

        <x-alert id="success" type='success' />
        <x-alert id="warning" type='warning' />
        <x-alert id="error" type='error' />
        <x-alert id="info" type='info' />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            {{-- @livewire('navigation-menu') --}}

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto font-semibold max-w-7xl sm:px-6 lg:px-8 sm:text-lg lg:text-xl">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <x-footer />

        @stack('modals')
        @stack('scripts')
        @livewireScripts

    </body>
</html>
