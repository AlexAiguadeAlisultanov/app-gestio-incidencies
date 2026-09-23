@php
    $usuari = Auth::user();

    $enlaces = [
        ['ruta' => url('/dashboard'), 'text' => __('app.nav.inicio'), 'icona' => 'inici', 'actiu' => request()->is('dashboard')],
        ['ruta' => url('/profesors/incidencies'), 'text' => __('app.nav.incidencias'), 'icona' => 'incidencies', 'actiu' => request()->is('profesors/incidencies*')],
        ['ruta' => url('/profesors/reparadors'), 'text' => __('app.nav.reparadores'), 'icona' => 'reparadors', 'actiu' => request()->is('profesors/reparadors*')],
    ];
@endphp

<nav x-data="{ obert: false }" class="sticky top-0 z-40 border-b border-linia/70 bg-fons/85 backdrop-blur-xl">
    <div class="ample flex h-14 items-center justify-between gap-4">
        <div class="flex min-w-0 items-center gap-8">
            <a href="{{ url('/dashboard') }}" class="flex min-h-[44px] shrink-0 items-center gap-2.5 rounded-control pe-1">
                <x-application-logo class="h-7 w-7 text-ambre" />
                <span class="hidden text-sm font-semibold tracking-tight text-tinta sm:block">{{ __('app.marca') }}</span>
            </a>

            <ul class="hidden items-center gap-1 lg:flex">
                @foreach ($enlaces as $enlace)
                    <li>
                        <x-nav-link :href="$enlace['ruta']" :active="$enlace['actiu']">
                            <x-icona :nom="$enlace['icona']" class="h-4 w-4" />
                            {{ $enlace['text'] }}
                        </x-nav-link>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="flex items-center gap-2">
            <x-selector-idioma />

            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button type="button" class="boto-discret px-3" aria-haspopup="true">
                            <span class="max-w-[10rem] truncate">{{ $usuari?->name }}</span>
                            <x-icona nom="avall" class="h-4 w-4" />
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="border-b border-linia px-4 py-3">
                            <p class="truncate text-sm font-medium text-tinta">{{ $usuari?->name }}</p>
                            <p class="truncate text-xs text-tinta-3">{{ $usuari?->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            <x-icona nom="perfil" class="h-4 w-4 text-tinta-3" />
                            {{ __('app.nav.perfil') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                <x-icona nom="sortir" class="h-4 w-4 text-tinta-3" />
                                {{ __('app.nav.salir') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <button type="button" @click="obert = ! obert" :aria-expanded="obert" aria-controls="menu-movil"
                    class="boto-discret px-2 sm:hidden">
                <span class="sr-only">{{ __('app.nav.abrir_menu') }}</span>
                <x-icona nom="menu" x-show="! obert" class="h-5 w-5" />
                <x-icona nom="tancar" x-show="obert" x-cloak class="h-5 w-5" />
            </button>
        </div>
    </div>

    {{-- Entre movil y escritorio la navegacion baja a una fila propia que se arrastra de
         lado, para no perderla ni meter un desplegable de mas. --}}
    <div class="hidden border-t border-linia/50 sm:block lg:hidden">
        <ul class="ample flex items-center gap-1 overflow-x-auto py-1 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            @foreach ($enlaces as $enlace)
                <li>
                    <x-nav-link :href="$enlace['ruta']" :active="$enlace['actiu']">
                        <x-icona :nom="$enlace['icona']" class="h-4 w-4" />
                        {{ $enlace['text'] }}
                    </x-nav-link>
                </li>
            @endforeach
        </ul>
    </div>

    <div id="menu-movil" x-show="obert" x-cloak class="border-t border-linia sm:hidden">
        <div class="py-2">
            @foreach ($enlaces as $enlace)
                <x-responsive-nav-link :href="$enlace['ruta']" :active="$enlace['actiu']">
                    <x-icona :nom="$enlace['icona']" class="h-5 w-5" />
                    {{ $enlace['text'] }}
                </x-responsive-nav-link>
            @endforeach
        </div>

        <div class="border-t border-linia py-4">
            <div class="px-4">
                <p class="text-sm font-medium text-tinta">{{ $usuari?->name }}</p>
                <p class="text-xs text-tinta-3">{{ $usuari?->email }}</p>
            </div>

            <div class="mt-3">
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
