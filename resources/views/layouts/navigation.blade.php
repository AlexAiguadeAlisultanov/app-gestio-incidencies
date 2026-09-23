@php
    $usuari = Auth::user();

    $enlaces = [
        ['ruta' => url('/dashboard'), 'text' => __('app.nav.inicio'), 'icona' => 'inici', 'actiu' => request()->is('dashboard')],
        ['ruta' => url('/profesors/incidencies'), 'text' => __('app.nav.incidencias'), 'icona' => 'incidencies', 'actiu' => request()->is('profesors/incidencies*')],
        ['ruta' => url('/profesors/reparadors'), 'text' => __('app.nav.reparadores'), 'icona' => 'reparadors', 'actiu' => request()->is('profesors/reparadors*')],
    ];
@endphp

<nav x-data="{ obert: false }" class="border-b border-tinta-200 bg-white dark:border-tinta-800 dark:bg-tinta-900">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <a href="{{ url('/dashboard') }}" class="flex shrink-0 items-center gap-3 rounded-control pe-2">
                    <x-application-logo class="h-8 w-8 text-acent-600 dark:text-acent-400" />
                    <span class="hidden text-sm font-medium tracking-tight text-tinta-900 sm:block dark:text-tinta-50">{{ __('app.marca') }}</span>
                </a>

                <div class="hidden sm:-my-px sm:ms-10 sm:flex sm:gap-8">
                    @foreach ($enlaces as $enlace)
                        <x-nav-link :href="$enlace['ruta']" :active="$enlace['actiu']">
                            <x-icona :nom="$enlace['icona']" class="h-4 w-4" />
                            {{ $enlace['text'] }}
                        </x-nav-link>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-3">
                <x-selector-idioma />

                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button type="button" class="boto-discret" aria-haspopup="true">
                                <span class="max-w-[12rem] truncate">{{ $usuari?->name }}</span>
                                <x-icona nom="avall" class="h-4 w-4" />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="border-b border-tinta-200 px-4 py-3 dark:border-tinta-800">
                                <p class="truncate text-sm font-medium text-tinta-900 dark:text-tinta-50">{{ $usuari?->name }}</p>
                                <p class="truncate text-xs text-tinta-500 dark:text-tinta-400">{{ $usuari?->email }}</p>
                            </div>

                            <x-dropdown-link :href="route('profile.edit')">
                                <x-icona nom="perfil" class="h-4 w-4 text-tinta-400" />
                                {{ __('app.nav.perfil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <x-icona nom="sortir" class="h-4 w-4 text-tinta-400" />
                                    {{ __('app.nav.salir') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <div class="-me-2 flex items-center sm:hidden">
                    <button type="button" @click="obert = ! obert" :aria-expanded="obert" aria-controls="menu-movil"
                            class="boto-discret p-2">
                        <span class="sr-only">{{ __('app.nav.abrir_menu') }}</span>
                        <x-icona nom="menu" x-show="! obert" class="h-6 w-6" />
                        <x-icona nom="tancar" x-show="obert" x-cloak class="h-6 w-6" />
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="menu-movil" x-show="obert" x-cloak class="border-t border-tinta-200 sm:hidden dark:border-tinta-800">
        <div class="space-y-1 py-2">
            @foreach ($enlaces as $enlace)
                <x-responsive-nav-link :href="$enlace['ruta']" :active="$enlace['actiu']">
                    <x-icona :nom="$enlace['icona']" class="h-5 w-5" />
                    {{ $enlace['text'] }}
                </x-responsive-nav-link>
            @endforeach
        </div>

        <div class="border-t border-tinta-200 py-4 dark:border-tinta-800">
            <div class="px-4">
                <p class="text-base font-medium text-tinta-900 dark:text-tinta-50">{{ $usuari?->name }}</p>
                <p class="text-sm text-tinta-500 dark:text-tinta-400">{{ $usuari?->email }}</p>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <x-icona nom="perfil" class="h-5 w-5" />
                    {{ __('app.nav.perfil') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        <x-icona nom="sortir" class="h-5 w-5" />
                        {{ __('app.nav.salir') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
