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

        <div class="flex min-h-screen flex-col">
            <header class="ample flex h-14 items-center justify-between gap-4">
                <a href="{{ url('/') }}" class="flex min-h-[44px] items-center gap-2.5 rounded-control">
                    <x-application-logo class="h-7 w-7 text-ambre" />
                    <span class="text-sm font-semibold tracking-tight text-tinta">{{ __('app.marca') }}</span>
                </a>

                <x-selector-idioma />
            </header>

            <main class="ample flex flex-1 flex-col justify-center py-10">
                <div class="mx-auto w-full max-w-md entra">
                    <div class="targeta p-6 shadow-elevat sm:p-8">
                        {{ $slot }}
                    </div>

                    <p class="mt-6 text-center text-xs leading-relaxed text-tinta-3">
                        {{ __('app.reclamo') }}
                    </p>
                </div>
            </main>
        </div>
    </body>
</html>
