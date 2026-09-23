{{--
    Pantalla de alta de una incidencia.
    Aviso: hoy ninguna ruta GET sirve esta vista. El alta se hace desde /dashboard,
    que usa el mismo formulario. Si algún día se añade la ruta, esta pantalla ya funciona.
--}}
<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('incidencias.titulo_nueva')]) }}</x-slot>

    <x-capcalera-pagina
        numero="02"
        :titol="__('incidencias.titulo_nueva')"
        :entrada="__('incidencias.nueva.entrada')"
        :enrere="url('/profesors/incidencies')"
        :enrere-text="__('incidencias.ficha.volver')" />

    <div class="entra mt-8 max-w-3xl" style="--r: 60ms">
        <form method="POST" action="{{ route('profesors/incidencies/store') }}" class="targeta p-6 sm:p-8">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @include('profesors.incidencies.frm.prt', ['incidencies' => null])
        </form>
    </div>
</x-app-layout>
