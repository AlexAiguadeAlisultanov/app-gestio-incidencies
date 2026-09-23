@php
    // $incidencies llega del controlador. Las categorías no, así que se leen aquí
    // para poder enseñar el nombre en vez del número.
    $categories = \App\Models\Categories::pluck('tipus', 'id');

    // Etiquetas de categoría en el idioma puesto. La clave es el valor guardado.
    $etiquetesCategoria = trans('vocabulario.categorias');
    $nomCategoria = fn ($tipus) => $etiquetesCategoria[$tipus] ?? $tipus;

    $usuari = auth()->user();
    $veuTot = in_array($usuari?->rol_usuari, ['manteniment', 'reparador'], true);

    $clauEstat = function ($estat) {
        $estat = \Illuminate\Support\Str::lower(trim((string) $estat));

        if (str_contains($estat, 'resol') || str_contains($estat, 'tanca')) {
            return 'resolt';
        }

        if (str_contains($estat, 'curs') || str_contains($estat, 'proc')) {
            return 'curs';
        }

        if (str_contains($estat, 'pendent') || str_contains($estat, 'obert')) {
            return 'pendent';
        }

        return 'altres';
    };

    // El buscador mira también el nombre traducido de la categoría y la etiqueta del
    // estado, para que buscar funcione en el idioma que se está viendo.
    $files = collect($incidencies)->map(function ($inci) use ($clauEstat, $categories, $nomCategoria) {
        $clau = $clauEstat($inci->estat);
        $etiquetaEstat = __('vocabulario.estados.'.($clau === 'altres' ? 'otro' : $clau));

        return [
            'estat' => $clau,
            'text' => \Illuminate\Support\Str::lower(
                $inci->titol.' '.$inci->descripcio.' '.$inci->lloc.' '
                .$nomCategoria($categories[$inci->categoria_id] ?? '').' '.$etiquetaEstat
            ),
        ];
    })->values();

    $recompte = $files->countBy('estat');

    // El punto de color de cada filtro repite el del estado, para que el botón y la
    // insignia de la fila se lean como lo mismo.
    $filtres = [
        ['clau' => 'tots', 'text' => __('vocabulario.estados_plural.todas'), 'total' => $files->count(), 'punt' => 'bg-tinta-3'],
        ['clau' => 'pendent', 'text' => __('vocabulario.estados_plural.pendent'), 'total' => $recompte['pendent'] ?? 0, 'punt' => 'bg-estat-pendent'],
        ['clau' => 'curs', 'text' => __('vocabulario.estados_plural.curs'), 'total' => $recompte['curs'] ?? 0, 'punt' => 'bg-estat-curs'],
        ['clau' => 'resolt', 'text' => __('vocabulario.estados_plural.resolt'), 'total' => $recompte['resolt'] ?? 0, 'punt' => 'bg-estat-resolt'],
    ];

    $filtreInicial = in_array(request('estat'), ['pendent', 'curs', 'resolt'], true) ? request('estat') : 'tots';
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('incidencias.titulo_listado')]) }}</x-slot>

    <x-capcalera-pagina
        numero="02"
        :titol="$veuTot ? __('incidencias.listado.todas') : __('incidencias.listado.propias')"
        :entrada="trans_choice('incidencias.listado.recuento', $files->count(), ['total' => $files->count()])">

        <a href="{{ url('/dashboard') }}#alta" class="boto-primari">
            <x-icona nom="afegir" class="h-4 w-4" />
            {{ __('incidencias.listado.nueva') }}
        </a>
    </x-capcalera-pagina>

    <div x-data="{
            filtre: '{{ $filtreInicial }}',
            cerca: '',
            files: {{ Js::from($files) }},
            esborrar: { obert: false, id: null, titol: '' },
            visible(i) {
                const fila = this.files[i];
                const perEstat = this.filtre === 'tots' || this.filtre === fila.estat;
                const perCerca = this.cerca.trim() === '' || fila.text.includes(this.cerca.trim().toLowerCase());
                return perEstat && perCerca;
            },
            get quantes() { return this.files.filter((fila, i) => this.visible(i)).length },
            obreEsborrar(id, titol) {
                this.esborrar = { obert: true, id: id, titol: titol };
                this.$nextTick(() => this.$refs.cancela?.focus());
            },
        }"
        @keydown.escape.window="esborrar.obert = false"
        class="mt-8">

        {{-- Los filtros se quedan pegados bajo la barra: el listado se puede recorrer
             entero sin perder de vista con qué se está filtrando. --}}
        <div class="sticky top-14 z-30 rounded-targeta border border-linia bg-fons-2/90 p-3 backdrop-blur-xl">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <div class="-mx-1 flex gap-2 overflow-x-auto px-1 py-0.5 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden"
                     role="group" aria-label="{{ __('incidencias.listado.filtrar') }}">
                    @foreach ($filtres as $filtre)
                        <button type="button"
                                @click="filtre = '{{ $filtre['clau'] }}'"
                                :aria-pressed="filtre === '{{ $filtre['clau'] }}' ? 'true' : 'false'"
                                :class="filtre === '{{ $filtre['clau'] }}'
                                    ? 'border-ambre bg-ambre-fons text-ambre'
                                    : 'border-linia bg-fons-2 text-tinta-2 hover:bg-fons-3 hover:text-tinta'"
                                class="xip min-h-[44px] shrink-0 whitespace-nowrap border px-3 transition duration-200 ease-suau">
                            <span aria-hidden="true" class="h-1.5 w-1.5 shrink-0 rounded-full {{ $filtre['punt'] }}"></span>
                            {{ $filtre['text'] }}
                            <span class="tabular-nums opacity-60">{{ $filtre['total'] }}</span>
                        </button>
                    @endforeach
                </div>

                <div class="relative lg:w-80">
                    <label for="cerca" class="sr-only">{{ __('incidencias.listado.buscar_etiqueta') }}</label>
                    <x-icona nom="cercar" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-tinta-3" />
                    <input id="cerca" type="search" x-model="cerca" placeholder="{{ __('incidencias.listado.buscar_pista') }}"
                           class="camp ps-9">
                </div>
            </div>
        </div>

        @if ($files->isEmpty())
            <div class="targeta mt-8 flex flex-col items-center gap-4 px-6 py-16 text-center">
                <x-icona nom="buit" class="h-10 w-10 text-tinta-3" />
                <div>
                    <p class="text-base font-medium text-tinta">{{ __('incidencias.listado.vacio_titulo') }}</p>
                    <p class="mt-2 text-sm text-tinta-2">{{ __('incidencias.listado.vacio_texto') }}</p>
                </div>
                <a href="{{ url('/dashboard') }}#alta" class="boto-primari mt-2">
                    <x-icona nom="afegir" class="h-4 w-4" />
                    {{ __('incidencias.listado.vacio_accion') }}
                </a>
            </div>
        @else
            {{-- Móvil: una tarjeta por incidencia --}}
            <ul class="mt-6 space-y-4 lg:hidden">
                @foreach ($incidencies as $inci)
                    <li x-show="visible({{ $loop->index }})" class="targeta p-5">
                        <div class="flex items-start justify-between gap-3">
                            <h2 class="text-base font-medium text-tinta">{{ $inci->titol }}</h2>
                            <x-estat-insignia :estat="$inci->estat" class="shrink-0" />
                        </div>

                        <p class="mt-2 text-sm leading-relaxed text-tinta-2">{{ $inci->descripcio }}</p>

                        <dl class="mt-4 grid grid-cols-2 gap-4">
                            <x-fitxa-camp :etiqueta="__('incidencias.campos.sitio')" icona="lloc">{{ $inci->lloc }}</x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('incidencias.campos.categoria')" icona="categoria">
                                <x-nom-categoria :tipus="$categories[$inci->categoria_id] ?? null" />
                            </x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('incidencias.campos.dia')" icona="data">{{ $inci->data }}</x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('incidencias.campos.hora')" icona="hora">{{ \Illuminate\Support\Str::substr((string) $inci->hora, 0, 5) }}</x-fitxa-camp>
                        </dl>

                        <div class="mt-5 flex flex-wrap gap-2 border-t border-linia-suau pt-4">
                            <a href="{{ route('profesors/incidencies/detalles', $inci->id) }}" class="boto-secundari">{{ __('app.acciones.ver_ficha') }}</a>
                            <a href="{{ route('profesors/incidencies/actualitzar', $inci->id) }}" class="boto-secundari">{{ __('app.acciones.editar') }}</a>
                            <button type="button" class="boto-discret text-perill hover:bg-perill-fons hover:text-perill"
                                    @click="obreEsborrar({{ $inci->id }}, {{ Js::from($inci->titol) }})">
                                {{ __('app.acciones.eliminar') }}
                            </button>
                        </div>
                    </li>
                @endforeach

                <li x-show="quantes === 0" x-cloak class="targeta px-6 py-12 text-center text-sm text-tinta-2">
                    {{ __('incidencias.listado.sin_resultados') }}
                </li>
            </ul>

            {{-- Escritorio: tabla, con el estado en la primera columna --}}
            <div class="targeta mt-6 hidden overflow-x-auto lg:block">
                <table class="w-full text-left text-sm">
                    <caption class="sr-only">{{ __('incidencias.listado.resumen_tabla') }}</caption>
                    <thead class="border-b border-linia">
                        <tr>
                            <th scope="col" class="rotul px-6 py-4">{{ __('incidencias.tabla.estado') }}</th>
                            <th scope="col" class="rotul px-6 py-4">{{ __('incidencias.tabla.incidencia') }}</th>
                            <th scope="col" class="rotul px-6 py-4">{{ __('incidencias.tabla.sitio') }}</th>
                            <th scope="col" class="rotul px-6 py-4">{{ __('incidencias.tabla.categoria') }}</th>
                            <th scope="col" class="rotul px-6 py-4">{{ __('incidencias.tabla.dia_hora') }}</th>
                            <th scope="col" class="rotul px-6 py-4 text-right">{{ __('incidencias.tabla.acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-linia-suau">
                        @foreach ($incidencies as $inci)
                            <tr x-show="visible({{ $loop->index }})" class="transition-colors duration-200 ease-suau hover:bg-fons-3">
                                <td class="px-6 py-4">
                                    <x-estat-insignia :estat="$inci->estat" />
                                </td>
                                <th scope="row" class="max-w-md px-6 py-3 font-medium text-tinta">
                                    {{-- El enlace abarca título y descripción: así se puede pinchar
                                         en todo el bloque y no solo en una línea de texto. --}}
                                    <a href="{{ route('profesors/incidencies/detalles', $inci->id) }}"
                                       class="flex min-h-[44px] flex-col justify-center rounded-control transition-colors duration-200 hover:text-ambre">
                                        <span>{{ $inci->titol }}</span>
                                        <span class="mt-1 block truncate text-xs font-normal text-tinta-3">{{ $inci->descripcio }}</span>
                                    </a>
                                </th>
                                <td class="px-6 py-4 text-tinta-2">{{ $inci->lloc }}</td>
                                <td class="px-6 py-4 text-tinta-2">
                                    <x-nom-categoria :tipus="$categories[$inci->categoria_id] ?? null" />
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 tabular-nums text-tinta-2">
                                    {{ $inci->data }}
                                    <span class="block text-xs text-tinta-3">{{ \Illuminate\Support\Str::substr((string) $inci->hora, 0, 5) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('profesors/incidencies/detalles', $inci->id) }}" class="boto-discret px-2" title="{{ __('incidencias.eliminar.ver_corto') }}">
                                            <x-icona nom="endavant" class="h-4 w-4" />
                                            <span class="sr-only">{{ __('incidencias.eliminar.ver', ['titulo' => $inci->titol]) }}</span>
                                        </a>
                                        <a href="{{ route('profesors/incidencies/actualitzar', $inci->id) }}" class="boto-discret px-2" title="{{ __('app.acciones.editar') }}">
                                            <x-icona nom="editar" class="h-4 w-4" />
                                            <span class="sr-only">{{ __('incidencias.eliminar.editar', ['titulo' => $inci->titol]) }}</span>
                                        </a>
                                        <button type="button" class="boto-discret px-2 text-perill hover:bg-perill-fons hover:text-perill"
                                                title="{{ __('app.acciones.eliminar') }}"
                                                @click="obreEsborrar({{ $inci->id }}, {{ Js::from($inci->titol) }})">
                                            <x-icona nom="eliminar" class="h-4 w-4" />
                                            <span class="sr-only">{{ __('incidencias.eliminar.abrir', ['titulo' => $inci->titol]) }}</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p x-show="quantes === 0" x-cloak class="px-6 py-12 text-center text-sm text-tinta-2">
                    {{ __('incidencias.listado.sin_resultados') }}
                </p>
            </div>
        @endif

        {{-- Confirmación antes de eliminar --}}
        <div x-show="esborrar.obert" x-cloak class="fixed inset-0 z-50 flex items-end justify-center p-4 sm:items-center"
             role="dialog" aria-modal="true" aria-labelledby="titol-esborrar">
            <div class="absolute inset-0 bg-fons/80 backdrop-blur-sm" @click="esborrar.obert = false"></div>

            <div class="relative w-full max-w-md rounded-panell border border-linia bg-fons-2 p-6 shadow-elevat"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <h2 id="titol-esborrar" class="text-lg font-semibold tracking-tight text-tinta">{{ __('incidencias.eliminar.titulo') }}</h2>
                <p class="mt-2 text-sm leading-relaxed text-tinta-2">
                    {{ __('incidencias.eliminar.texto') }}
                    <span class="font-medium text-tinta" x-text="esborrar.titol"></span>.
                    {{ __('incidencias.eliminar.aviso') }}
                </p>

                <form method="POST" :action="'{{ url('/profesors/incidencies/eliminar') }}/' + esborrar.id" class="mt-6 flex flex-wrap justify-end gap-3">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button type="button" class="boto-secundari" x-ref="cancela" @click="esborrar.obert = false">{{ __('app.acciones.dejarlo') }}</button>
                    <button type="submit" class="boto-perill">{{ __('app.acciones.eliminar') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
