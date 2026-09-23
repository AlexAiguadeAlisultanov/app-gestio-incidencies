<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('reparadores.titulo_nuevo')]) }}</x-slot>

    <x-capcalera-pagina
        numero="03"
        :titol="__('reparadores.titulo_nuevo')"
        :entrada="__('reparadores.nuevo.entrada')"
        :enrere="url('/profesors/reparadors')"
        :enrere-text="__('reparadores.ficha.volver')" />

    <div class="entra mt-8 max-w-3xl" style="--r: 60ms">
        <form method="POST" action="{{ route('profesors/reparadors/store') }}" class="targeta p-6 sm:p-8">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @include('profesors.reparadors.frm.prt', ['reparadors' => null])
        </form>
    </div>
</x-app-layout>
