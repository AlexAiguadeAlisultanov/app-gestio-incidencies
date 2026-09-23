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
        <div class="flex min-h-screen flex-col px-4 py-6 sm:px-6">
            <header class="flex justify-end">
                <x-selector-idioma />
            </header>

            <div class="flex flex-1 flex-col justify-center py-8">
                <div class="mx-auto w-full max-w-md">
                    <a href="{{ url('/') }}" class="mx-auto flex w-fit items-center gap-3 rounded-control px-1 py-1">
                        <x-application-logo class="h-9 w-9 text-acent-600 dark:text-acent-400" />
                        <span class="text-base font-medium tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('app.marca') }}</span>
                    </a>

                    <div class="mt-8 rounded-panell border border-tinta-200 bg-white p-8 shadow-suau dark:border-tinta-800 dark:bg-tinta-900">
                        {{ $slot }}
                    </div>

                    <p class="mt-8 text-center text-xs leading-relaxed text-tinta-500 dark:text-tinta-400">
                        {{ __('app.reclamo') }}
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
