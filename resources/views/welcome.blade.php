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
           @livewire('guest-navigation-menu')
        </header>
        <main>
            <h1 class="ml-4 text-4xl">Information</h1>
            <p class="ml-4 text-lg">This website is under construction</p>
            <br>
            <br>
            <p class="ml-4 text-lg">Ophtasol Co. Ltd.</p>
        </main>
        <footer>
        </footer>  
        @stack('modals')
        @livewireScripts
    </body>
</html>
