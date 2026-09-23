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

    $filtres = [
        ['clau' => 'tots', 'text' => __('vocabulario.estados_plural.todas'), 'total' => $files->count()],
        ['clau' => 'pendent', 'text' => __('vocabulario.estados_plural.pendent'), 'total' => $recompte['pendent'] ?? 0],
        ['clau' => 'curs', 'text' => __('vocabulario.estados_plural.curs'), 'total' => $recompte['curs'] ?? 0],
        ['clau' => 'resolt', 'text' => __('vocabulario.estados_plural.resolt'), 'total' => $recompte['resolt'] ?? 0],
    ];

    $filtreInicial = in_array(request('estat'), ['pendent', 'curs', 'resolt'], true) ? request('estat') : 'tots';
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('incidencias.titulo_listado')]) }}</x-slot>

    <x-slot name="header">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">
                    {{ $veuTot ? __('incidencias.listado.todas') : __('incidencias.listado.propias') }}
                </h1>
                <p class="mt-2 text-sm text-tinta-600 dark:text-tinta-400">
                    {{ trans_choice('incidencias.listado.recuento', $files->count(), ['total' => $files->count()]) }}
                </p>
            </div>

            <a href="{{ url('/dashboard') }}" class="boto-primari">
                <x-icona nom="afegir" class="h-4 w-4" />
                {{ __('incidencias.listado.nueva') }}
            </a>
        </div>
    </x-slot>

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
        @keydown.escape.window="esborrar.obert = false">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-wrap gap-2" role="group" aria-label="{{ __('incidencias.listado.filtrar') }}">
                @foreach ($filtres as $filtre)
                    <button type="button"
                            @click="filtre = '{{ $filtre['clau'] }}'"
                            :aria-pressed="filtre === '{{ $filtre['clau'] }}' ? 'true' : 'false'"
                            :class="filtre === '{{ $filtre['clau'] }}'
                                ? 'border-acent-600 bg-acent-600 text-white dark:border-acent-400 dark:bg-acent-500'
                                : 'border-tinta-300 bg-white text-tinta-600 hover:bg-tinta-100 dark:border-tinta-700 dark:bg-tinta-900 dark:text-tinta-300 dark:hover:bg-tinta-800'"
                            class="xip border px-3 py-1.5 transition duration-200 ease-suau">
                        {{ $filtre['text'] }}
                        <span class="tabular-nums opacity-70">{{ $filtre['total'] }}</span>
                    </button>
                @endforeach
            </div>

            <div class="relative sm:w-72">
                <label for="cerca" class="sr-only">{{ __('incidencias.listado.buscar_etiqueta') }}</label>
                <x-icona nom="cercar" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-tinta-400" />
                <input id="cerca" type="search" x-model="cerca" placeholder="{{ __('incidencias.listado.buscar_pista') }}"
                       class="camp ps-9">
            </div>
        </div>

        @if ($files->isEmpty())
            <div class="targeta mt-8 flex flex-col items-center gap-4 px-6 py-16 text-center">
                <x-icona nom="buit" class="h-10 w-10 text-tinta-400" />
                <div>
                    <p class="text-base font-medium text-tinta-900 dark:text-tinta-50">{{ __('incidencias.listado.vacio_titulo') }}</p>
                    <p class="mt-2 text-sm text-tinta-600 dark:text-tinta-400">{{ __('incidencias.listado.vacio_texto') }}</p>
                </div>
                <a href="{{ url('/dashboard') }}" class="boto-primari mt-2">
                    <x-icona nom="afegir" class="h-4 w-4" />
                    {{ __('incidencias.listado.vacio_accion') }}
                </a>
            </div>
        @else
            {{-- Móvil: una tarjeta por incidencia --}}
            <ul class="mt-8 space-y-4 md:hidden">
                @foreach ($incidencies as $inci)
                    <li x-show="visible({{ $loop->index }})" class="targeta p-5">
                        <div class="flex items-start justify-between gap-3">
                            <h2 class="text-base font-medium text-tinta-900 dark:text-tinta-50">{{ $inci->titol }}</h2>
                            <x-estat-insignia :estat="$inci->estat" class="shrink-0" />
                        </div>

                        <p class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">{{ $inci->descripcio }}</p>

                        <dl class="mt-4 grid grid-cols-2 gap-4">
                            <x-fitxa-camp :etiqueta="__('incidencias.campos.sitio')" icona="lloc">{{ $inci->lloc }}</x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('incidencias.campos.categoria')" icona="categoria">
                                <x-nom-categoria :tipus="$categories[$inci->categoria_id] ?? null" />
                            </x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('incidencias.campos.dia')" icona="data">{{ $inci->data }}</x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('incidencias.campos.hora')" icona="hora">{{ \Illuminate\Support\Str::substr((string) $inci->hora, 0, 5) }}</x-fitxa-camp>
                        </dl>

                        <div class="mt-5 flex flex-wrap gap-2 border-t border-tinta-200 pt-4 dark:border-tinta-800">
                            <a href="{{ route('profesors/incidencies/detalles', $inci->id) }}" class="boto-secundari">{{ __('app.acciones.ver_ficha') }}</a>
                            <a href="{{ route('profesors/incidencies/actualitzar', $inci->id) }}" class="boto-secundari">{{ __('app.acciones.editar') }}</a>
                            <button type="button" class="boto-discret text-perill-600 hover:bg-perill-fons dark:text-perill-clar dark:hover:bg-perill-600/20"
                                    @click="obreEsborrar({{ $inci->id }}, {{ Js::from($inci->titol) }})">
                                {{ __('app.acciones.eliminar') }}
                            </button>
                        </div>
                    </li>
                @endforeach

                <li x-show="quantes === 0" x-cloak class="targeta px-6 py-12 text-center text-sm text-tinta-600 dark:text-tinta-400">
                    {{ __('incidencias.listado.sin_resultados') }}
                </li>
            </ul>

            {{-- Escritorio: tabla --}}
            <div class="targeta mt-8 hidden overflow-x-auto md:block">
                <table class="w-full text-left text-sm">
                    <caption class="sr-only">{{ __('incidencias.listado.resumen_tabla') }}</caption>
                    <thead class="border-b border-tinta-200 text-xs uppercase tracking-wide text-tinta-500 dark:border-tinta-800 dark:text-tinta-400">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium">{{ __('incidencias.tabla.estado') }}</th>
                            <th scope="col" class="px-6 py-4 font-medium">{{ __('incidencias.tabla.incidencia') }}</th>
                            <th scope="col" class="px-6 py-4 font-medium">{{ __('incidencias.tabla.sitio') }}</th>
                            <th scope="col" class="px-6 py-4 font-medium">{{ __('incidencias.tabla.categoria') }}</th>
                            <th scope="col" class="px-6 py-4 font-medium">{{ __('incidencias.tabla.dia_hora') }}</th>
                            <th scope="col" class="px-6 py-4 text-right font-medium">{{ __('incidencias.tabla.acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-tinta-200 dark:divide-tinta-800">
                        @foreach ($incidencies as $inci)
                            <tr x-show="visible({{ $loop->index }})" class="transition duration-200 ease-suau hover:bg-tinta-50 dark:hover:bg-tinta-800/50">
                                <td class="px-6 py-4">
                                    <x-estat-insignia :estat="$inci->estat" />
                                </td>
                                <th scope="row" class="max-w-xs px-6 py-4 font-medium text-tinta-900 dark:text-tinta-50">
                                    <a href="{{ route('profesors/incidencies/detalles', $inci->id) }}" class="rounded-control hover:text-acent-700 dark:hover:text-acent-300">
                                        {{ $inci->titol }}
                                    </a>
                                    <span class="mt-1 block truncate text-xs font-normal text-tinta-500 dark:text-tinta-400">{{ $inci->descripcio }}</span>
                                </th>
                                <td class="px-6 py-4 text-tinta-600 dark:text-tinta-300">{{ $inci->lloc }}</td>
                                <td class="px-6 py-4 text-tinta-600 dark:text-tinta-300">
                                    <x-nom-categoria :tipus="$categories[$inci->categoria_id] ?? null" />
                                </td>
                                <td class="px-6 py-4 tabular-nums text-tinta-600 dark:text-tinta-300">
                                    {{ $inci->data }}
                                    <span class="block text-xs text-tinta-500 dark:text-tinta-400">{{ \Illuminate\Support\Str::substr((string) $inci->hora, 0, 5) }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('profesors/incidencies/detalles', $inci->id) }}" class="boto-discret p-2" title="{{ __('incidencias.eliminar.ver_corto') }}">
                                            <x-icona nom="endavant" class="h-4 w-4" />
                                            <span class="sr-only">{{ __('incidencias.eliminar.ver', ['titulo' => $inci->titol]) }}</span>
                                        </a>
                                        <a href="{{ route('profesors/incidencies/actualitzar', $inci->id) }}" class="boto-discret p-2" title="{{ __('app.acciones.editar') }}">
                                            <x-icona nom="editar" class="h-4 w-4" />
                                            <span class="sr-only">{{ __('incidencias.eliminar.editar', ['titulo' => $inci->titol]) }}</span>
                                        </a>
                                        <button type="button" class="boto-discret p-2 text-perill-600 hover:bg-perill-fons dark:text-perill-clar dark:hover:bg-perill-600/20"
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

                <p x-show="quantes === 0" x-cloak class="px-6 py-12 text-center text-sm text-tinta-600 dark:text-tinta-400">
                    {{ __('incidencias.listado.sin_resultados') }}
                </p>
            </div>
        @endif

        {{-- Confirmación antes de eliminar --}}
        <div x-show="esborrar.obert" x-cloak class="fixed inset-0 z-50 flex items-end justify-center p-4 sm:items-center"
             role="dialog" aria-modal="true" aria-labelledby="titol-esborrar">
            <div class="absolute inset-0 bg-tinta-950/50" @click="esborrar.obert = false"></div>

            <div class="relative w-full max-w-md rounded-panell border border-tinta-200 bg-white p-6 shadow-elevat dark:border-tinta-800 dark:bg-tinta-900"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <h2 id="titol-esborrar" class="text-lg font-medium text-tinta-900 dark:text-tinta-50">{{ __('incidencias.eliminar.titulo') }}</h2>
                <p class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
                    {{ __('incidencias.eliminar.texto') }}
                    <span class="font-medium text-tinta-900 dark:text-tinta-100" x-text="esborrar.titol"></span>.
                    {{ __('incidencias.eliminar.aviso') }}
                </p>

                <form method="POST" :action="'{{ url('/profesors/incidencies/eliminar') }}/' + esborrar.id" class="mt-6 flex justify-end gap-3">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button type="button" class="boto-secundari" x-ref="cancela" @click="esborrar.obert = false">{{ __('app.acciones.dejarlo') }}</button>
                    <button type="submit" class="boto-perill">{{ __('app.acciones.eliminar') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
