@php
    $inci = $incidencies ?? null;

    $categoria = $inci ? \App\Models\Categories::find($inci->categoria_id) : null;
    $professor = $inci ? \App\Models\User::find($inci->user_id) : null;
    $reparador = $categoria ? \App\Models\Reparadors::find($categoria->reparador_id) : null;

    $telefon = trim((string) ($telefonoReparador ?? ''));
    $telefonValid = $telefon !== '' && preg_match('/^[0-9 +]+$/', $telefon) === 1;

    // El mensaje de WhatsApp lleva las etiquetas en el idioma puesto, pero el estado y
    // el título viajan tal como están guardados.
    $missatgeWhatsApp = $inci ? rawurlencode(
        $inci->titol."\n".
        $inci->descripcio."\n".
        __('incidencias.whatsapp.sitio').': '.$inci->lloc."\n".
        __('incidencias.whatsapp.dia').': '.$inci->data.' '.__('incidencias.whatsapp.a_las').' '.\Illuminate\Support\Str::substr((string) $inci->hora, 0, 5)."\n".
        __('incidencias.whatsapp.estado').': '.$inci->estat
    ) : '';
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => $inci->titol ?? __('incidencias.titulo_ficha')]) }}</x-slot>

    <x-capcalera-pagina
        numero="02"
        :titol="$inci->titol ?? __('incidencias.ficha.no_existe')"
        :rotul="$inci ? __('incidencias.ficha.numero', ['id' => $inci->id]) : null"
        :enrere="url('/profesors/incidencies')"
        :enrere-text="__('incidencias.ficha.volver')">

        @if ($inci)
            <x-estat-insignia :estat="$inci->estat" gran />
        @endif
    </x-capcalera-pagina>

    @if (! $inci)
        <div class="targeta mt-8 flex flex-col items-center gap-4 px-6 py-16 text-center">
            <x-icona nom="avis" class="h-10 w-10 text-tinta-3" />
            <p class="text-base font-medium text-tinta">{{ __('incidencias.ficha.no_existe') }}</p>
            <a href="{{ url('/profesors/incidencies') }}" class="boto-primari">{{ __('incidencias.ficha.volver') }}</a>
        </div>
    @else
        <div class="mt-8 grid gap-6 xl:grid-cols-12">
            <div class="space-y-6 xl:col-span-8">
                <section class="entra targeta p-6 sm:p-8" style="--r: 60ms">
                    <h2 class="rotul">{{ __('incidencias.ficha.que_pasa') }}</h2>
                    <p class="mt-4 max-w-lectura text-base leading-relaxed text-tinta">{{ $inci->descripcio }}</p>

                    <dl class="mt-8 grid gap-6 border-t border-linia-suau pt-8 sm:grid-cols-2 xl:grid-cols-3">
                        <x-fitxa-camp :etiqueta="__('incidencias.campos.sitio')" icona="lloc">{{ $inci->lloc }}</x-fitxa-camp>
                        <x-fitxa-camp :etiqueta="__('incidencias.campos.categoria')" icona="categoria">
                            <x-nom-categoria :tipus="$categoria->tipus ?? null" />
                        </x-fitxa-camp>
                        <x-fitxa-camp :etiqueta="__('incidencias.campos.dia')" icona="data">{{ $inci->data }}</x-fitxa-camp>
                        <x-fitxa-camp :etiqueta="__('incidencias.campos.hora')" icona="hora">{{ \Illuminate\Support\Str::substr((string) $inci->hora, 0, 5) }}</x-fitxa-camp>
                        <x-fitxa-camp :etiqueta="__('incidencias.campos.alta')" icona="persona">{{ $professor->name ?? __('incidencias.ficha.usuario', ['id' => $inci->user_id]) }}</x-fitxa-camp>
                    </dl>
                </section>

                <div class="entra flex flex-wrap gap-3" style="--r: 120ms">
                    <a href="{{ route('profesors/incidencies/actualitzar', $inci->id) }}" class="boto-primari">
                        <x-icona nom="editar" class="h-4 w-4" />
                        {{ __('incidencias.ficha.editar') }}
                    </a>
                    <a href="{{ url('/profesors/incidencies') }}" class="boto-secundari">{{ __('incidencias.ficha.volver') }}</a>
                </div>
            </div>

            <aside class="entra xl:col-span-4" style="--r: 180ms">
                <section class="targeta p-6">
                    <h2 class="rotul">{{ __('incidencias.ficha.quien_arregla') }}</h2>

                    @if ($reparador)
                        <p class="mt-4 text-base font-medium text-tinta">{{ $reparador->nombre }} {{ $reparador->apellidos }}</p>

                        <dl class="mt-6 space-y-5">
                            <x-fitxa-camp :etiqueta="__('incidencias.ficha.telefono')" icona="telefon">{{ $reparador->telefono }}</x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('incidencias.ficha.correo')" icona="correu">{{ $reparador->email }}</x-fitxa-camp>
                        </dl>
                    @else
                        <p class="mt-4 text-sm leading-relaxed text-tinta-2">
                            {{ __('incidencias.ficha.sin_reparador') }}
                        </p>
                    @endif

                    @if ($telefonValid)
                        <a href="https://wa.me/+34{{ preg_replace('/\s+/', '', $telefon) }}?text={{ $missatgeWhatsApp }}"
                           target="_blank" rel="noopener"
                           class="boto-secundari mt-6 w-full">
                            <x-icona nom="xerrada" class="h-4 w-4" />
                            {{ __('incidencias.ficha.enviar') }}
                        </a>
                        <p class="mt-2 text-xs text-tinta-3">{{ __('incidencias.ficha.enviar_pista') }}</p>
                    @endif
                </section>
            </aside>
        </div>
    @endif
</x-app-layout>
