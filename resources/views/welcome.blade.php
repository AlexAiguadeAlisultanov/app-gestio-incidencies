<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="color-scheme" content="dark">
        <meta name="theme-color" content="#101012">
        <meta name="description" content="{{ __('app.descripcion') }}">

        <title>{{ __('app.marca') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full font-sans">
        <div class="fons-taques" aria-hidden="true"></div>

        <div class="flex min-h-screen flex-col">
            <header class="ample flex h-14 items-center justify-between gap-4">
                <div class="flex items-center gap-2.5">
                    <x-application-logo class="h-7 w-7 text-ambre" />
                    <span class="hidden text-sm font-semibold tracking-tight text-tinta sm:block">{{ __('app.marca') }}</span>
                </div>

                <nav class="flex items-center gap-2">
                    <x-selector-idioma />

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="boto-primari">{{ __('app.portada.entrar_panel') }}</a>
                        @else
                            <a href="{{ route('login') }}" class="boto-secundari">{{ __('app.portada.iniciar_sesion') }}</a>
                        @endauth
                    @endif
                </nav>
            </header>

            <main class="ample flex-1 py-10 sm:py-16">
                <div class="grid items-start gap-10 xl:grid-cols-12 xl:gap-16">
                    <div class="entra xl:col-span-7">
                        <p class="rotul">{{ __('app.portada.seccion') }}</p>

                        <h1 class="titular mt-4 text-[clamp(2.25rem,6.5vw,5.5rem)]">
                            {{ __('app.marca') }}
                        </h1>

                        <p class="mt-6 max-w-lectura text-base leading-relaxed text-tinta-2">
                            {{ __('app.portada.entrada') }}
                        </p>

                        @if (Route::has('login'))
                            <div class="mt-8 flex flex-wrap items-center gap-3">
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

                        <dl class="mt-12 grid gap-8 sm:grid-cols-3">
                            <div class="entra" style="--r: 120ms">
                                <dt class="flex items-center gap-2 text-sm font-medium text-tinta">
                                    <x-icona nom="afegir" class="h-4 w-4 text-ambre" />
                                    {{ __('app.portada.alta_titulo') }}
                                </dt>
                                <dd class="mt-2 text-sm leading-relaxed text-tinta-2">
                                    {{ __('app.portada.alta_texto') }}
                                </dd>
                            </div>
                            <div class="entra" style="--r: 180ms">
                                <dt class="flex items-center gap-2 text-sm font-medium text-tinta">
                                    <x-icona nom="curs" class="h-4 w-4 text-ambre" />
                                    {{ __('app.portada.estado_titulo') }}
                                </dt>
                                <dd class="mt-2 text-sm leading-relaxed text-tinta-2">
                                    {{ __('app.portada.estado_texto') }}
                                </dd>
                            </div>
                            <div class="entra" style="--r: 240ms">
                                <dt class="flex items-center gap-2 text-sm font-medium text-tinta">
                                    <x-icona nom="reparadors" class="h-4 w-4 text-ambre" />
                                    {{ __('app.portada.quien_titulo') }}
                                </dt>
                                <dd class="mt-2 text-sm leading-relaxed text-tinta-2">
                                    {{ __('app.portada.quien_texto') }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <div class="entra rounded-panell border border-linia bg-fons-2 p-6 shadow-elevat xl:col-span-5" style="--r: 200ms">
                        <div class="flex items-baseline justify-between gap-4">
                            <h2 class="text-sm font-medium text-tinta">{{ __('app.portada.muestra_titulo') }}</h2>
                            <span class="rotul">{{ __('app.portada.muestra_etiqueta') }}</span>
                        </div>

                        <ul class="mt-6 space-y-3">
                            @foreach ([
                                ['proyector', 'aula_a12', 'Pendent'],
                                ['enchufe', 'taller_b04', 'En curs'],
                                ['silla', 'sala', 'Pendent'],
                                ['ordenador', 'aula_b02', 'Resolt'],
                            ] as $mostra)
                                <li class="flex flex-wrap items-center justify-between gap-3 rounded-targeta border border-linia-suau bg-fons-3 px-4 py-3">
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-medium text-tinta">{{ __('app.portada.muestra.'.$mostra[0]) }}</p>
                                        <p class="mt-1 flex items-center gap-1.5 text-xs text-tinta-3">
                                            <x-icona nom="lloc" class="h-3.5 w-3.5" />
                                            {{ __('app.portada.muestra.'.$mostra[1]) }}
                                        </p>
                                    </div>
                                    <x-estat-insignia :estat="$mostra[2]" />
                                </li>
                            @endforeach
                        </ul>

                        <p class="mt-6 text-xs leading-relaxed text-tinta-3">
                            {{ __('app.portada.muestra_pie') }}
                        </p>
                    </div>
                </div>
            </main>

            <footer class="border-t border-linia-suau">
                <p class="ample py-6 text-xs text-tinta-3">{{ __('app.pie') }}</p>
            </footer>
        </div>
    </body>
</html>
