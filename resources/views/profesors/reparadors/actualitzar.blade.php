<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('reparadores.titulo_editar')]) }}</x-slot>

    <x-capcalera-pagina
        numero="03"
        :titol="$reparadors ? __('reparadores.titulo_editar') : __('reparadores.ficha.no_encontrado')"
        :entrada="$reparadors ? $reparadors->nombre.' '.$reparadors->apellidos : null"
        :enrere="url('/profesors/reparadors')"
        :enrere-text="__('reparadores.ficha.volver')" />

    @if (! $reparadors)
        <div class="targeta mt-8 flex flex-col items-center gap-4 px-6 py-16 text-center">
            <x-icona nom="avis" class="h-10 w-10 text-tinta-3" />
            <p class="text-base font-medium text-tinta">{{ __('reparadores.ficha.no_encontrado_titulo') }}</p>
            <a href="{{ url('/profesors/reparadors') }}" class="boto-primari mt-2">{{ __('reparadores.ficha.volver') }}</a>
        </div>
    @else
        <div class="entra mt-8 max-w-3xl" style="--r: 60ms">
            <form method="POST" action="{{ route('profesors/reparadors/update', $reparadors->id) }}" class="targeta p-6 sm:p-8">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @include('profesors.reparadors.frm.prt')
            </form>
        </div>
    @endif
</x-app-layout>
