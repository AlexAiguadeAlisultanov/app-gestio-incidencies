<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="color-scheme" content="light dark">

        <title>{{ $titol ?? __('app.marca') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full font-sans">
        <a href="#contenido" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded-control focus:bg-white focus:px-4 focus:py-2 focus:text-sm focus:font-medium focus:text-acent-700 focus:shadow-elevat dark:focus:bg-tinta-900 dark:focus:text-acent-200">
            {{ __('app.saltar_contenido') }}
        </a>

        <div class="min-h-screen">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="border-b border-tinta-200 bg-white dark:border-tinta-800 dark:bg-tinta-900">
                    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main id="contenido" class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
                @include('layouts.aviso')

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
