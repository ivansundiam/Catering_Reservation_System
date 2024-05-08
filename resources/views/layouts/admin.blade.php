<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Robert Camba's catering services accepts reservations for weddings, debuts, birthdays, and other events. Log in to set up your reservations now!">
        <meta name="theme-color" content="#D09c4c"/>

        <title>{{ $title ?? config('app.name', 'Robert Camba') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon/favicon.ico') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noticia+Text:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Tai+Heritage+Pro:wght@400;700&display=swap">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
        
        <!-- Preload -->
        <link rel="dns-prefetch" href="https://fonts.googleapis.com/">
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Noticia+Text:ital,wght@0,400;0,700;1,400;1,700" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Tai+Heritage+Pro:wght@400;700&display=swap" as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&display=swap" as="font" type="font/woff2" crossorigin>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased" x-data="{ loading: true }" x-init="$nextTick(() => loading = false)">
        <!-- Loading screen -->
        <x-page-loader />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @livewire('navigation-menu')

            <x-alert id="success" type='success' />
            <x-alert id="warning" type='warning' />
            <x-alert id="error" type='error' />
            <x-alert id="info" type='info' />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @stack('scripts')
        
        @livewireScripts

    </body>
</html>
