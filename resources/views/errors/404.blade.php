<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="color-scheme" content="dark">
        <meta name="theme-color" content="#101012">

        <title>{{ __('app.titulo', ['pagina' => __('app.error404.titulo_pagina')]) }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap">

        @vite(['resources/css/app.css'])
    </head>
    <body class="min-h-full font-sans">
        <div class="fons-taques" aria-hidden="true"></div>

        <div class="ample flex min-h-screen flex-col items-center justify-center gap-6 py-12 text-center">
            <span class="num" aria-hidden="true">404</span>

            <div>
                <h1 class="titular titular-m">{{ __('app.error404.titulo') }}</h1>
                <p class="mx-auto mt-4 max-w-lectura text-sm leading-relaxed text-tinta-2">
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
