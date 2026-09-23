@php
    $fitxa = $reparadors ?? null;

    $categories = $fitxa
        ? \App\Models\Categories::where('reparador_id', $fitxa->id)->orderBy('tipus')->get()
        : collect();
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => $fitxa->nombre ?? __('reparadores.titulo_ficha')]) }}</x-slot>

    <x-slot name="header">
        <a href="{{ url('/profesors/reparadors') }}" class="inline-flex items-center gap-2 rounded-control text-sm font-medium text-tinta-600 hover:text-tinta-900 dark:text-tinta-400 dark:hover:text-tinta-100">
            <x-icona nom="enrere" class="h-4 w-4" />
            {{ __('reparadores.ficha.volver') }}
        </a>

        @if ($fitxa)
            <h1 class="mt-4 text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">
                {{ $fitxa->nombre }} {{ $fitxa->apellidos }}
            </h1>
        @endif
    </x-slot>

    @if (! $fitxa)
        <div class="targeta flex flex-col items-center gap-4 px-6 py-16 text-center">
            <x-icona nom="avis" class="h-10 w-10 text-tinta-400" />
            <p class="text-base font-medium text-tinta-900 dark:text-tinta-50">{{ __('reparadores.ficha.no_existe') }}</p>
            <a href="{{ url('/profesors/reparadors') }}" class="boto-primari">{{ __('reparadores.ficha.volver') }}</a>
        </div>
    @else
        <div class="mx-auto max-w-2xl space-y-8">
            <section class="targeta p-6 sm:p-8">
                <h2 class="text-sm font-medium uppercase tracking-wide text-tinta-500 dark:text-tinta-400">{{ __('reparadores.ficha.contacto') }}</h2>

                <dl class="mt-6 grid gap-6 sm:grid-cols-2">
                    <x-fitxa-camp :etiqueta="__('reparadores.campos.telefono')" icona="telefon">{{ $fitxa->telefono }}</x-fitxa-camp>
                    <x-fitxa-camp :etiqueta="__('reparadores.campos.correo')" icona="correu">{{ $fitxa->email }}</x-fitxa-camp>
                    <x-fitxa-camp :etiqueta="__('reparadores.campos.direccion')" icona="lloc">{{ $fitxa->direccion }}</x-fitxa-camp>
                    <x-fitxa-camp :etiqueta="__('reparadores.campos.ciudad')" icona="ciutat">{{ $fitxa->ciudad }}</x-fitxa-camp>
                </dl>

                <div class="mt-8 border-t border-tinta-200 pt-8 dark:border-tinta-800">
                    <h2 class="text-sm font-medium uppercase tracking-wide text-tinta-500 dark:text-tinta-400">{{ __('reparadores.ficha.de_que') }}</h2>

                    @if ($categories->isEmpty())
                        <p class="mt-4 text-sm text-tinta-600 dark:text-tinta-400">{{ __('reparadores.ficha.sin_categoria') }}</p>
                    @else
                        <p class="mt-4 flex flex-wrap gap-2">
                            @foreach ($categories as $categoria)
                                <span class="xip bg-acent-50 text-acent-700 dark:bg-acent-900/40 dark:text-acent-200"><x-nom-categoria :tipus="$categoria->tipus" /></span>
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
