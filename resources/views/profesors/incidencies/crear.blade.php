{{--
    Pantalla de alta de una incidencia.
    Aviso: hoy ninguna ruta GET sirve esta vista. El alta se hace desde /dashboard,
    que usa el mismo formulario. Si algún día se añade la ruta, esta pantalla ya funciona.
--}}
<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('incidencias.titulo_nueva')]) }}</x-slot>

    <x-slot name="header">
        <a href="{{ url('/profesors/incidencies') }}" class="inline-flex items-center gap-2 rounded-control text-sm font-medium text-tinta-600 hover:text-tinta-900 dark:text-tinta-400 dark:hover:text-tinta-100">
            <x-icona nom="enrere" class="h-4 w-4" />
            {{ __('incidencias.ficha.volver') }}
        </a>

        <h1 class="mt-4 text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('incidencias.titulo_nueva') }}</h1>
        <p class="mt-2 text-sm text-tinta-600 dark:text-tinta-400">{{ __('incidencias.nueva.entrada') }}</p>
    </x-slot>

    <div class="mx-auto max-w-2xl">
        <form method="POST" action="{{ route('profesors/incidencies/store') }}" class="targeta p-6 sm:p-8">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @include('profesors.incidencies.frm.prt', ['incidencies' => null])
        </form>
    </div>
</x-app-layout>
