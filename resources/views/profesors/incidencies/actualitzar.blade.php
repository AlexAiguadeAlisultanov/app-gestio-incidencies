<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('incidencias.titulo_editar')]) }}</x-slot>

    <x-capcalera-pagina
        numero="02"
        :titol="$incidencies ? __('incidencias.titulo_editar') : __('incidencias.ficha.no_encontrada')"
        :entrada="$incidencies?->titol"
        :enrere="url('/profesors/incidencies')"
        :enrere-text="__('incidencias.ficha.volver')" />

    @if (! $incidencies)
        <div class="targeta mt-8 flex flex-col items-center gap-4 px-6 py-16 text-center">
            <x-icona nom="avis" class="h-10 w-10 text-tinta-3" />
            <p class="text-base font-medium text-tinta">{{ __('incidencias.ficha.no_encontrada_titulo') }}</p>
            <p class="text-sm text-tinta-2">{{ __('incidencias.ficha.no_encontrada_texto') }}</p>
            <a href="{{ url('/profesors/incidencies') }}" class="boto-primari mt-2">{{ __('incidencias.ficha.volver') }}</a>
        </div>
    @else
        <div class="entra mt-8 max-w-3xl" style="--r: 60ms">
            <form method="POST" action="{{ route('profesors/incidencies/update', $incidencies->id) }}" class="targeta p-6 sm:p-8">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @include('profesors.incidencies.frm.prt')
            </form>
        </div>
    @endif
</x-app-layout>
