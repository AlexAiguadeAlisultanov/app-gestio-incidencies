<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('reparadores.titulo_nuevo')]) }}</x-slot>

    <x-slot name="header">
        <a href="{{ url('/profesors/reparadors') }}" class="inline-flex items-center gap-2 rounded-control text-sm font-medium text-tinta-600 hover:text-tinta-900 dark:text-tinta-400 dark:hover:text-tinta-100">
            <x-icona nom="enrere" class="h-4 w-4" />
            {{ __('reparadores.ficha.volver') }}
        </a>

        <h1 class="mt-4 text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('reparadores.titulo_nuevo') }}</h1>
        <p class="mt-2 text-sm text-tinta-600 dark:text-tinta-400">{{ __('reparadores.nuevo.entrada') }}</p>
    </x-slot>

    <div class="mx-auto max-w-2xl">
        <form method="POST" action="{{ route('profesors/reparadors/store') }}" class="targeta p-6 sm:p-8">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @include('profesors.reparadors.frm.prt', ['reparadors' => null])
        </form>
    </div>
</x-app-layout>
