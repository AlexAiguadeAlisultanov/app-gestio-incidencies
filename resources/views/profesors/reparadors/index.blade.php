@php
    $llista = collect($reparadors ?? []);

    // Categorías que atiende cada reparador, para saber de qué se encarga
    $categoriesPerReparador = \App\Models\Categories::orderBy('tipus')->get()->groupBy('reparador_id');
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('reparadores.titulo_listado')]) }}</x-slot>

    <x-capcalera-pagina
        numero="03"
        :titol="__('reparadores.titulo_listado')"
        :entrada="__('reparadores.listado.entrada')">

        <a href="{{ url('/profesors/reparadors/crear') }}" class="boto-primari">
            <x-icona nom="afegir" class="h-4 w-4" />
            {{ __('reparadores.listado.nuevo') }}
        </a>
    </x-capcalera-pagina>

    <div x-data="{ esborrar: { obert: false, id: null, nom: '' },
                   obreEsborrar(id, nom) {
                       this.esborrar = { obert: true, id: id, nom: nom };
                       this.$nextTick(() => this.$refs.cancela?.focus());
                   } }"
         @keydown.escape.window="esborrar.obert = false"
         class="mt-8">

        @if ($llista->isEmpty())
            <div class="targeta flex flex-col items-center gap-4 px-6 py-16 text-center">
                <x-icona nom="reparadors" class="h-10 w-10 text-tinta-3" />
                <div>
                    <p class="text-base font-medium text-tinta">{{ __('reparadores.listado.vacio_titulo') }}</p>
                    <p class="mt-2 text-sm leading-relaxed text-tinta-2">
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
            <ul class="space-y-4 lg:hidden">
                @foreach ($llista as $reparador)
                    <li class="targeta p-5">
                        <h2 class="text-base font-medium text-tinta">{{ $reparador->nombre }} {{ $reparador->apellidos }}</h2>

                        @if (($categoriesPerReparador[$reparador->id] ?? collect())->isNotEmpty())
                            <p class="mt-3 flex flex-wrap gap-2">
                                @foreach ($categoriesPerReparador[$reparador->id] as $categoria)
                                    <span class="xip border border-linia bg-fons-3 text-tinta-2"><x-nom-categoria :tipus="$categoria->tipus" /></span>
                                @endforeach
                            </p>
                        @endif

                        <dl class="mt-4 space-y-4">
                            <x-fitxa-camp :etiqueta="__('reparadores.campos.telefono')" icona="telefon">{{ $reparador->telefono }}</x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('reparadores.campos.correo')" icona="correu">{{ $reparador->email }}</x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('reparadores.campos.donde')" icona="ciutat">{{ $reparador->direccion }}, {{ $reparador->ciudad }}</x-fitxa-camp>
                        </dl>

                        <div class="mt-5 flex flex-wrap gap-2 border-t border-linia-suau pt-4">
                            <a href="{{ route('profesors/reparadors/detalles', $reparador->id) }}" class="boto-secundari">{{ __('app.acciones.ver_ficha') }}</a>
                            <a href="{{ route('profesors/reparadors/actualitzar', $reparador->id) }}" class="boto-secundari">{{ __('app.acciones.editar') }}</a>
                            <button type="button" class="boto-discret text-perill hover:bg-perill-fons hover:text-perill"
                                    @click="obreEsborrar({{ $reparador->id }}, {{ Js::from($reparador->nombre.' '.$reparador->apellidos) }})">
                                {{ __('app.acciones.eliminar') }}
                            </button>
                        </div>
                    </li>
                @endforeach
            </ul>

            {{-- Escritorio: tabla --}}
            <div class="targeta hidden overflow-x-auto lg:block">
                <table class="w-full text-left text-sm">
                    <caption class="sr-only">{{ __('reparadores.listado.resumen_tabla') }}</caption>
                    <thead class="border-b border-linia">
                        <tr>
                            <th scope="col" class="rotul px-6 py-4">{{ __('reparadores.tabla.reparador') }}</th>
                            <th scope="col" class="rotul px-6 py-4">{{ __('reparadores.tabla.categorias') }}</th>
                            <th scope="col" class="rotul px-6 py-4">{{ __('reparadores.tabla.contacto') }}</th>
                            <th scope="col" class="rotul px-6 py-4">{{ __('reparadores.tabla.ciudad') }}</th>
                            <th scope="col" class="rotul px-6 py-4 text-right">{{ __('reparadores.tabla.acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-linia-suau">
                        @foreach ($llista as $reparador)
                            <tr class="transition-colors duration-200 ease-suau hover:bg-fons-3">
                                <th scope="row" class="px-6 py-4 font-medium text-tinta">
                                    {{ $reparador->nombre }} {{ $reparador->apellidos }}
                                </th>
                                <td class="px-6 py-4">
                                    @forelse ($categoriesPerReparador[$reparador->id] ?? [] as $categoria)
                                        <span class="xip mb-1 me-1 border border-linia bg-fons-3 text-tinta-2"><x-nom-categoria :tipus="$categoria->tipus" /></span>
                                    @empty
                                        <span class="text-tinta-3">{{ __('reparadores.tabla.sin_categoria') }}</span>
                                    @endforelse
                                </td>
                                <td class="px-6 py-4 text-tinta-2">
                                    {{ $reparador->telefono }}
                                    <span class="block text-xs text-tinta-3">{{ $reparador->email }}</span>
                                </td>
                                <td class="px-6 py-4 text-tinta-2">{{ $reparador->ciudad }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('profesors/reparadors/detalles', $reparador->id) }}" class="boto-discret px-2" title="{{ __('reparadores.eliminar.ver_corto') }}">
                                            <x-icona nom="endavant" class="h-4 w-4" />
                                            <span class="sr-only">{{ __('reparadores.eliminar.ver', ['nombre' => $reparador->nombre]) }}</span>
                                        </a>
                                        <a href="{{ route('profesors/reparadors/actualitzar', $reparador->id) }}" class="boto-discret px-2" title="{{ __('app.acciones.editar') }}">
                                            <x-icona nom="editar" class="h-4 w-4" />
                                            <span class="sr-only">{{ __('reparadores.eliminar.editar', ['nombre' => $reparador->nombre]) }}</span>
                                        </a>
                                        <button type="button" class="boto-discret px-2 text-perill hover:bg-perill-fons hover:text-perill"
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
            <div class="absolute inset-0 bg-fons/80 backdrop-blur-sm" @click="esborrar.obert = false"></div>

            <div class="relative w-full max-w-md rounded-panell border border-linia bg-fons-2 p-6 shadow-elevat">
                <h2 id="titol-esborrar-reparador" class="text-lg font-semibold tracking-tight text-tinta">{{ __('reparadores.eliminar.titulo') }}</h2>
                <p class="mt-2 text-sm leading-relaxed text-tinta-2">
                    {{ __('reparadores.eliminar.texto') }}
                    <span class="font-medium text-tinta" x-text="esborrar.nom"></span>.
                    {{ __('reparadores.eliminar.aviso') }}
                </p>

                <form method="POST" :action="'{{ url('/profesors/reparadors/eliminar') }}/' + esborrar.id" class="mt-6 flex flex-wrap justify-end gap-3">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button type="button" class="boto-secundari" x-ref="cancela" @click="esborrar.obert = false">{{ __('app.acciones.dejarlo') }}</button>
                    <button type="submit" class="boto-perill">{{ __('app.acciones.eliminar') }}</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
