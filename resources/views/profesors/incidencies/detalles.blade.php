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

    <x-slot name="header">
        <a href="{{ url('/profesors/incidencies') }}" class="inline-flex items-center gap-2 rounded-control text-sm font-medium text-tinta-600 hover:text-tinta-900 dark:text-tinta-400 dark:hover:text-tinta-100">
            <x-icona nom="enrere" class="h-4 w-4" />
            {{ __('incidencias.ficha.volver') }}
        </a>

        @if ($inci)
            <div class="mt-4 flex flex-wrap items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ $inci->titol }}</h1>
                    <p class="mt-2 text-sm text-tinta-600 dark:text-tinta-400">{{ __('incidencias.ficha.numero', ['id' => $inci->id]) }}</p>
                </div>

                <x-estat-insignia :estat="$inci->estat" gran />
            </div>
        @endif
    </x-slot>

    @if (! $inci)
        <div class="targeta flex flex-col items-center gap-4 px-6 py-16 text-center">
            <x-icona nom="avis" class="h-10 w-10 text-tinta-400" />
            <p class="text-base font-medium text-tinta-900 dark:text-tinta-50">{{ __('incidencias.ficha.no_existe') }}</p>
            <a href="{{ url('/profesors/incidencies') }}" class="boto-primari">{{ __('incidencias.ficha.volver') }}</a>
        </div>
    @else
        <div class="grid gap-8 lg:grid-cols-3">
            <div class="space-y-8 lg:col-span-2">
                <section class="targeta p-6 sm:p-8">
                    <h2 class="text-sm font-medium uppercase tracking-wide text-tinta-500 dark:text-tinta-400">{{ __('incidencias.ficha.que_pasa') }}</h2>
                    <p class="mt-4 text-base leading-relaxed text-tinta-800 dark:text-tinta-200">{{ $inci->descripcio }}</p>

                    <dl class="mt-8 grid gap-6 border-t border-tinta-200 pt-8 sm:grid-cols-2 dark:border-tinta-800">
                        <x-fitxa-camp :etiqueta="__('incidencias.campos.sitio')" icona="lloc">{{ $inci->lloc }}</x-fitxa-camp>
                        <x-fitxa-camp :etiqueta="__('incidencias.campos.categoria')" icona="categoria">
                            <x-nom-categoria :tipus="$categoria->tipus ?? null" />
                        </x-fitxa-camp>
                        <x-fitxa-camp :etiqueta="__('incidencias.campos.dia')" icona="data">{{ $inci->data }}</x-fitxa-camp>
                        <x-fitxa-camp :etiqueta="__('incidencias.campos.hora')" icona="hora">{{ \Illuminate\Support\Str::substr((string) $inci->hora, 0, 5) }}</x-fitxa-camp>
                        <x-fitxa-camp :etiqueta="__('incidencias.campos.alta')" icona="persona">{{ $professor->name ?? __('incidencias.ficha.usuario', ['id' => $inci->user_id]) }}</x-fitxa-camp>
                    </dl>
                </section>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('profesors/incidencies/actualitzar', $inci->id) }}" class="boto-primari">
                        <x-icona nom="editar" class="h-4 w-4" />
                        {{ __('incidencias.ficha.editar') }}
                    </a>
                    <a href="{{ url('/profesors/incidencies') }}" class="boto-secundari">{{ __('incidencias.ficha.volver') }}</a>
                </div>
            </div>

            <aside class="space-y-8">
                <section class="targeta p-6">
                    <h2 class="text-sm font-medium uppercase tracking-wide text-tinta-500 dark:text-tinta-400">{{ __('incidencias.ficha.quien_arregla') }}</h2>

                    @if ($reparador)
                        <p class="mt-4 text-base font-medium text-tinta-900 dark:text-tinta-50">{{ $reparador->nombre }} {{ $reparador->apellidos }}</p>

                        <dl class="mt-4 space-y-4">
                            <x-fitxa-camp :etiqueta="__('incidencias.ficha.telefono')" icona="telefon">{{ $reparador->telefono }}</x-fitxa-camp>
                            <x-fitxa-camp :etiqueta="__('incidencias.ficha.correo')" icona="correu">{{ $reparador->email }}</x-fitxa-camp>
                        </dl>
                    @else
                        <p class="mt-4 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
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
                        <p class="mt-2 text-xs text-tinta-500 dark:text-tinta-400">{{ __('incidencias.ficha.enviar_pista') }}</p>
                    @endif
                </section>
            </aside>
        </div>
    @endif
</x-app-layout>
