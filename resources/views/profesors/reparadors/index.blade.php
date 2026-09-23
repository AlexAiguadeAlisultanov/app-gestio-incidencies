@php
    $llista = collect($reparadors ?? []);

    // Categorías que atiende cada reparador, para saber de qué se encarga
    $categoriesPerReparador = \App\Models\Categories::orderBy('tipus')->get()->groupBy('reparador_id');
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('reparadores.titulo_listado')]) }}</x-slot>

    <x-slot name="header">
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('reparadores.titulo_listado') }}</h1>
                <p class="mt-2 text-sm text-tinta-600 dark:text-tinta-400">
                    {{ __('reparadores.listado.entrada') }}
                </p>
            </div>

            <a href="{{ url('/profesors/reparadors/crear') }}" class="boto-primari">
                <x-icona nom="afegir" class="h-4 w-4" />
                {{ __('reparadores.listado.nuevo') }}
            </a>
        </div>
    </x-slot>

    <div x-data="{ esborrar: { obert: false, id: null, nom: '' },
                   obreEsborrar(id, nom) {
                       this.esborrar = { obert: true, id: id, nom: nom };
                       this.$nextTick(() => this.$refs.cancela?.focus());
                   } }"
         @keydown.escape.window="esborrar.obert = false">

        @if ($llista->isEmpty())
            <div class="targeta flex flex-col items-center gap-4 px-6 py-16 text-center">
                <x-icona nom="reparadors" class="h-10 w-10 text-tinta-400" />
                <div>
                    <p class="text-base font-medium text-tinta-900 dark:text-tinta-50">{{ __('reparadores.listado.vacio_titulo') }}</p>
                    <p class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
                        {{ __('reparadores.listado.vacio_texto') }}
                    </p>
                </div>
                <a href="{{ url('/profesors/reparadors/crear') }}" class="boto-primari mt-2">
                    <x-icona nom="afegir" class="h-4 w-4" />
                    {{ __('reparadores.listado.vacio_accion') }}
                </a>
            </div>
        @else
            {{-- Móvil: una tarjeta por reparador --}}
            <ul class="space-y-4 md:hidden">
                @foreach ($llista as $reparador)
                    <li class="targeta p-5">
                        <h2 class="text-base font-medium text-tinta-900 dark:text-tinta-50">{{ $reparador->nombre }} {{ $reparador->apellidos }}</h2>

                        @if (($categoriesPerReparador[$reparador->id] ?? collect())->isNotEmpty())
                            <p class="mt-2 flex flex-wrap gap-2">
                                @foreach ($categoriesPerReparador[$reparador->id] as $categoria)
                                    <span class="xip bg-acent-50 text-acent-700 dark:bg-acent-900/40 dark:text-acent-200"><x-nom-categoria :tipus="$categoria->tipus" /></span>
                                @endforeach
                            </p>
                        @endif

                        <dl class="mt-4 space-y-4">
                            <x-fitxa-camp :etiqueta="__('reparadores.campos.telefono')" icona="telefon">{{ $reparador->telefono }}</x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('reparadores.campos.correo')" icona="correu">{{ $reparador->email }}</x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('reparadores.campos.donde')" icona="ciutat">{{ $reparador->direccion }}, {{ $reparador->ciudad }}</x-fitxa-camp>
                        </dl>

                        <div class="mt-5 flex flex-wrap gap-2 border-t border-tinta-200 pt-4 dark:border-tinta-800">
                            <a href="{{ route('profesors/reparadors/detalles', $reparador->id) }}" class="boto-secundari">{{ __('app.acciones.ver_ficha') }}</a>
                            <a href="{{ route('profesors/reparadors/actualitzar', $reparador->id) }}" class="boto-secundari">{{ __('app.acciones.editar') }}</a>
                            <button type="button" class="boto-discret text-perill-600 hover:bg-perill-fons dark:text-perill-clar dark:hover:bg-perill-600/20"
                                    @click="obreEsborrar({{ $reparador->id }}, {{ Js::from($reparador->nombre.' '.$reparador->apellidos) }})">
                                {{ __('app.acciones.eliminar') }}
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>

            {{-- Escritorio: tabla --}}
            <div class="targeta hidden overflow-x-auto md:block">
                <table class="w-full text-left text-sm">
                    <caption class="sr-only">{{ __('reparadores.listado.resumen_tabla') }}</caption>
                    <thead class="border-b border-tinta-200 text-xs uppercase tracking-wide text-tinta-500 dark:border-tinta-800 dark:text-tinta-400">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-medium">{{ __('reparadores.tabla.reparador') }}</th>
                            <th scope="col" class="px-6 py-4 font-medium">{{ __('reparadores.tabla.categorias') }}</th>
                            <th scope="col" class="px-6 py-4 font-medium">{{ __('reparadores.tabla.contacto') }}</th>
                            <th scope="col" class="px-6 py-4 font-medium">{{ __('reparadores.tabla.ciudad') }}</th>
                            <th scope="col" class="px-6 py-4 text-right font-medium">{{ __('reparadores.tabla.acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-tinta-200 dark:divide-tinta-800">
                        @foreach ($llista as $reparador)
                            <tr class="transition duration-200 ease-suau hover:bg-tinta-50 dark:hover:bg-tinta-800/50">
                                <th scope="row" class="px-6 py-4 font-medium text-tinta-900 dark:text-tinta-50">
                                    {{ $reparador->nombre }} {{ $reparador->apellidos }}
                                </th>
                                <td class="px-6 py-4">
                                    @forelse ($categoriesPerReparador[$reparador->id] ?? [] as $categoria)
                                        <span class="xip mb-1 me-1 bg-acent-50 text-acent-700 dark:bg-acent-900/40 dark:text-acent-200"><x-nom-categoria :tipus="$categoria->tipus" /></span>
                                    @empty
                                        <span class="text-tinta-500 dark:text-tinta-400">{{ __('reparadores.tabla.sin_categoria') }}</span>
                                    @endforelse
                                </td>
                                <td class="px-6 py-4 text-tinta-600 dark:text-tinta-300">
                                    {{ $reparador->telefono }}
                                    <span class="block text-xs text-tinta-500 dark:text-tinta-400">{{ $reparador->email }}</span>
                                </td>
                                <td class="px-6 py-4 text-tinta-600 dark:text-tinta-300">{{ $reparador->ciudad }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('profesors/reparadors/detalles', $reparador->id) }}" class="boto-discret p-2" title="{{ __('reparadores.eliminar.ver_corto') }}">
                                            <x-icona nom="endavant" class="h-4 w-4" />
                                            <span class="sr-only">{{ __('reparadores.eliminar.ver', ['nombre' => $reparador->nombre]) }}</span>
                                        </a>
                                        <a href="{{ route('profesors/reparadors/actualitzar', $reparador->id) }}" class="boto-discret p-2" title="{{ __('app.acciones.editar') }}">
                                            <x-icona nom="editar" class="h-4 w-4" />
                                            <span class="sr-only">{{ __('reparadores.eliminar.editar', ['nombre' => $reparador->nombre]) }}</span>
                                        </a>
                                        <button type="button" class="boto-discret p-2 text-perill-600 hover:bg-perill-fons dark:text-perill-clar dark:hover:bg-perill-600/20"
                                                title="{{ __('app.acciones.eliminar') }}"
                                                @click="obreEsborrar({{ $reparador->id }}, {{ Js::from($reparador->nombre.' '.$reparador->apellidos) }})">
                                            <x-icona nom="eliminar" class="h-4 w-4" />
                                            <span class="sr-only">{{ __('reparadores.eliminar.abrir', ['nombre' => $reparador->nombre]) }}</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Confirmación antes de eliminar --}}
        <div x-show="esborrar.obert" x-cloak class="fixed inset-0 z-50 flex items-end justify-center p-4 sm:items-center"
             role="dialog" aria-modal="true" aria-labelledby="titol-esborrar-reparador">
            <div class="absolute inset-0 bg-tinta-950/50" @click="esborrar.obert = false"></div>

            <div class="relative w-full max-w-md rounded-panell border border-tinta-200 bg-white p-6 shadow-elevat dark:border-tinta-800 dark:bg-tinta-900">
                <h2 id="titol-esborrar-reparador" class="text-lg font-medium text-tinta-900 dark:text-tinta-50">{{ __('reparadores.eliminar.titulo') }}</h2>
                <p class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
                    {{ __('reparadores.eliminar.texto') }}
                    <span class="font-medium text-tinta-900 dark:text-tinta-100" x-text="esborrar.nom"></span>.
                    {{ __('reparadores.eliminar.aviso') }}
                </p>

                <form method="POST" :action="'{{ url('/profesors/reparadors/eliminar') }}/' + esborrar.id" class="mt-6 flex justify-end gap-3">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button type="button" class="boto-secundari" x-ref="cancela" @click="esborrar.obert = false">{{ __('app.acciones.dejarlo') }}</button>
                    <button type="submit" class="boto-perill">{{ __('app.acciones.eliminar') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
