<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="color-scheme" content="light dark">

        <title>{{ __('app.titulo', ['pagina' => __('app.error404.titulo_pagina')]) }}</title>

        @vite(['resources/css/app.css'])
    </head>
    <body class="min-h-full font-sans">
        <div class="flex min-h-screen flex-col items-center justify-center gap-6 px-4 text-center">
            <x-application-logo class="h-10 w-10 text-acent-600 dark:text-acent-400" />

            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('app.error404.titulo') }}</h1>
                <p class="mx-auto mt-3 max-w-md text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
                    {{ __('app.error404.texto') }}
                </p>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ url('/profesors/incidencies') }}" class="boto-primari">{{ __('app.error404.ver_incidencias') }}</a>
                <a href="{{ url('/') }}" class="boto-secundari">{{ __('app.error404.ir_portada') }}</a>
            </div>
        </div>
    </body>
</html>
