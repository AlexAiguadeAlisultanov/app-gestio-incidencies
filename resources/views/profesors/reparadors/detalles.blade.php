@php
    $fitxa = $reparadors ?? null;

    $categories = $fitxa
        ? \App\Models\Categories::where('reparador_id', $fitxa->id)->orderBy('tipus')->get()
        : collect();
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => $fitxa->nombre ?? __('reparadores.titulo_ficha')]) }}</x-slot>

    <x-capcalera-pagina
        numero="03"
        :titol="$fitxa ? $fitxa->nombre.' '.$fitxa->apellidos : __('reparadores.ficha.no_existe')"
        :enrere="url('/profesors/reparadors')"
        :enrere-text="__('reparadores.ficha.volver')" />

    @if (! $fitxa)
        <div class="targeta mt-8 flex flex-col items-center gap-4 px-6 py-16 text-center">
            <x-icona nom="avis" class="h-10 w-10 text-tinta-3" />
            <p class="text-base font-medium text-tinta">{{ __('reparadores.ficha.no_existe') }}</p>
            <a href="{{ url('/profesors/reparadors') }}" class="boto-primari">{{ __('reparadores.ficha.volver') }}</a>
        </div>
    @else
        <div class="entra mt-8 max-w-4xl space-y-6" style="--r: 60ms">
            <section class="targeta p-6 sm:p-8">
                <h2 class="rotul">{{ __('reparadores.ficha.contacto') }}</h2>

                <dl class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <x-fitxa-camp :etiqueta="__('reparadores.campos.telefono')" icona="telefon">{{ $fitxa->telefono }}</x-fitxa-camp>
                    <x-fitxa-camp :etiqueta="__('reparadores.campos.correo')" icona="correu">{{ $fitxa->email }}</x-fitxa-camp>
                    <x-fitxa-camp :etiqueta="__('reparadores.campos.direccion')" icona="lloc">{{ $fitxa->direccion }}</x-fitxa-camp>
                    <x-fitxa-camp :etiqueta="__('reparadores.campos.ciudad')" icona="ciutat">{{ $fitxa->ciudad }}</x-fitxa-camp>
                </dl>

                <div class="mt-8 border-t border-linia-suau pt-8">
                    <h2 class="rotul">{{ __('reparadores.ficha.de_que') }}</h2>

                    @if ($categories->isEmpty())
                        <p class="mt-4 text-sm text-tinta-2">{{ __('reparadores.ficha.sin_categoria') }}</p>
                    @else
                        <p class="mt-4 flex flex-wrap gap-2">
                            @foreach ($categories as $categoria)
                                <span class="xip border border-linia bg-fons-3 text-tinta-2"><x-nom-categoria :tipus="$categoria->tipus" /></span>
                            @endforeach
                        </p>
                    @endif
                </div>
            </section>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('profesors/reparadors/actualitzar', $fitxa->id) }}" class="boto-primari">
                    <x-icona nom="editar" class="h-4 w-4" />
                    {{ __('reparadores.ficha.editar') }}
                </a>
                <a href="{{ url('/profesors/reparadors') }}" class="boto-secundari">{{ __('reparadores.ficha.volver') }}</a>
            </div>
        </div>
    @endif
</x-app-layout>
