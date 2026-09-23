<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="color-scheme" content="dark">
        <meta name="theme-color" content="#101012">

        <title>{{ $titol ?? __('app.marca') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full font-sans">
        <div class="fons-taques" aria-hidden="true"></div>

        <a href="#contenido" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-control focus:bg-ambre focus:px-4 focus:py-2 focus:text-sm focus:font-medium focus:text-sobre-ambre">
            {{ __('app.saltar_contenido') }}
        </a>

        <div class="flex min-h-screen flex-col">
            @include('layouts.navigation')

            <main id="contenido" class="ample flex-1 py-8 sm:py-12">
                @include('layouts.aviso')

                {{ $slot }}
            </main>

            <footer class="border-t border-linia-suau">
                <p class="ample py-6 text-xs text-tinta-3">{{ __('app.pie') }}</p>
            </footer>
        </div>
    </body>
</html>
