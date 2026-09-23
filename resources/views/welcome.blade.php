<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="color-scheme" content="light dark">
        <meta name="description" content="{{ __('app.descripcion') }}">

        <title>{{ __('app.marca') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full font-sans">
        <div class="mx-auto flex min-h-screen max-w-6xl flex-col px-4 sm:px-6 lg:px-8">
            <header class="flex h-20 items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <x-application-logo class="h-8 w-8 text-acent-600 dark:text-acent-400" />
                    <span class="hidden text-sm font-medium tracking-tight text-tinta-900 sm:block dark:text-tinta-50">{{ __('app.marca') }}</span>
                </div>

                <nav class="flex items-center gap-3">
                    <x-selector-idioma />

                    @if (Route::has('login'))
                        <span class="flex items-center gap-2">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="boto-primari">{{ __('app.portada.entrar_panel') }}</a>
                            @else
                                <a href="{{ route('login') }}" class="boto-discret">{{ __('app.portada.iniciar_sesion') }}</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="boto-primari">{{ __('app.portada.crear_cuenta') }}</a>
                                @endif
                            @endauth
                        </span>
                    @endif
                </nav>
            </header>

            <main class="flex-1 py-12 sm:py-20">
                <div class="grid items-center gap-16 lg:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-acent-600 dark:text-acent-400">{{ __('app.portada.seccion') }}</p>

                        <h1 class="mt-4 text-4xl font-semibold leading-tight tracking-tight text-tinta-900 sm:text-5xl dark:text-tinta-50">
                            {{ __('app.marca') }}
                        </h1>

                        <p class="mt-6 max-w-lg text-base leading-relaxed text-tinta-600 dark:text-tinta-300">
                            {{ __('app.portada.entrada') }}
                        </p>

                        @if (Route::has('login'))
                            <div class="mt-10 flex flex-wrap items-center gap-3">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="boto-primari">
                                        {{ __('app.portada.entrar_panel') }}
                                        <x-icona nom="endavant" class="h-4 w-4" />
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="boto-primari">
                                        {{ __('app.portada.entrar') }}
                                        <x-icona nom="endavant" class="h-4 w-4" />
                                    </a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="boto-secundari">{{ __('app.portada.crear_cuenta') }}</a>
                                    @endif
                                @endauth
                            </div>
                        @endif

                        <dl class="mt-16 grid gap-8 sm:grid-cols-3">
                            <div>
                                <dt class="flex items-center gap-2 text-sm font-medium text-tinta-900 dark:text-tinta-50">
                                    <x-icona nom="afegir" class="h-4 w-4 text-acent-600 dark:text-acent-400" />
                                    {{ __('app.portada.alta_titulo') }}
                                </dt>
                                <dd class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
                                    {{ __('app.portada.alta_texto') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="flex items-center gap-2 text-sm font-medium text-tinta-900 dark:text-tinta-50">
                                    <x-icona nom="curs" class="h-4 w-4 text-acent-600 dark:text-acent-400" />
                                    {{ __('app.portada.estado_titulo') }}
                                </dt>
                                <dd class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
                                    {{ __('app.portada.estado_texto') }}
                                </dd>
                            </div>
                            <div>
                                <dt class="flex items-center gap-2 text-sm font-medium text-tinta-900 dark:text-tinta-50">
                                    <x-icona nom="reparadors" class="h-4 w-4 text-acent-600 dark:text-acent-400" />
                                    {{ __('app.portada.quien_titulo') }}
                                </dt>
                                <dd class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
                                    {{ __('app.portada.quien_texto') }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="rounded-panell border border-tinta-200 bg-white p-6 shadow-elevat dark:border-tinta-800 dark:bg-tinta-900">
                        <div class="flex items-baseline justify-between">
                            <h2 class="text-sm font-medium text-tinta-900 dark:text-tinta-50">{{ __('app.portada.muestra_titulo') }}</h2>
                            <span class="text-xs text-tinta-500 dark:text-tinta-400">{{ __('app.portada.muestra_etiqueta') }}</span>
                        </div>

                        <ul class="mt-6 space-y-3">
                            @foreach ([
                                ['proyector', 'aula_a12', 'Pendent'],
                                ['enchufe', 'taller_b04', 'En curs'],
                                ['silla', 'sala', 'Pendent'],
                                ['ordenador', 'aula_b02', 'Resolt'],
                            ] as $mostra)
                                <li class="flex flex-wrap items-center justify-between gap-3 rounded-targeta border border-tinta-200 px-4 py-3 dark:border-tinta-800">
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-medium text-tinta-900 dark:text-tinta-50">{{ __('app.portada.muestra.'.$mostra[0]) }}</p>
                                        <p class="mt-1 flex items-center gap-1.5 text-xs text-tinta-500 dark:text-tinta-400">
                                            <x-icona nom="lloc" class="h-3.5 w-3.5" />
                                            {{ __('app.portada.muestra.'.$mostra[1]) }}
                                        </p>
                                    </div>
                                    <x-estat-insignia :estat="$mostra[2]" />
                                </li>
                            @endforeach
                        </ul>

                        <p class="mt-6 text-xs leading-relaxed text-tinta-500 dark:text-tinta-400">
                            {{ __('app.portada.muestra_pie') }}
                        </p>
                    </div>
                </div>
            </main>

            <footer class="border-t border-tinta-200 py-8 text-xs text-tinta-500 dark:border-tinta-800 dark:text-tinta-400">
                {{ __('app.pie') }}
            </footer>
        </div>
    </body>
</html>
