<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('incidencias.titulo_editar')]) }}</x-slot>

    <x-slot name="header">
        <a href="{{ url('/profesors/incidencies') }}" class="inline-flex items-center gap-2 rounded-control text-sm font-medium text-tinta-600 hover:text-tinta-900 dark:text-tinta-400 dark:hover:text-tinta-100">
            <x-icona nom="enrere" class="h-4 w-4" />
            {{ __('incidencias.ficha.volver') }}
        </a>

        <h1 class="mt-4 text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">
            {{ $incidencies ? __('incidencias.titulo_editar') : __('incidencias.ficha.no_encontrada') }}
        </h1>

        @if ($incidencies)
            <p class="mt-2 text-sm text-tinta-600 dark:text-tinta-400">{{ $incidencies->titol }}</p>
        @endif
    </x-slot>

    @if (! $incidencies)
        <div class="targeta flex flex-col items-center gap-4 px-6 py-16 text-center">
            <x-icona nom="avis" class="h-10 w-10 text-tinta-400" />
            <p class="text-base font-medium text-tinta-900 dark:text-tinta-50">{{ __('incidencias.ficha.no_encontrada_titulo') }}</p>
            <p class="text-sm text-tinta-600 dark:text-tinta-400">{{ __('incidencias.ficha.no_encontrada_texto') }}</p>
            <a href="{{ url('/profesors/incidencies') }}" class="boto-primari mt-2">{{ __('incidencias.ficha.volver') }}</a>
        </div>
    @else
        <div class="mx-auto max-w-2xl">
            <form method="POST" action="{{ route('profesors/incidencies/update', $incidencies->id) }}" class="targeta p-6 sm:p-8">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @include('profesors.incidencies.frm.prt')
            </form>
        </div>
    @endif
</x-app-layout>
