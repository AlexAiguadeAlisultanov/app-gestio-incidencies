@props(['estat', 'gran' => false])

@php
    // El valor de la columna `estat` viene en catalán desde la base de datos.
    // Aquí solo se traduce para mostrarlo: lo que se guarda no cambia.
    $clau = \Illuminate\Support\Str::lower(trim((string) $estat));

    if (str_contains($clau, 'resol') || str_contains($clau, 'tanca')) {
        $to = 'resolt';
        $text = __('vocabulario.estados.resolt');
    } elseif (str_contains($clau, 'curs') || str_contains($clau, 'proc')) {
        $to = 'curs';
        $text = __('vocabulario.estados.curs');
    } elseif (str_contains($clau, 'pendent') || str_contains($clau, 'pendiente') || str_contains($clau, 'obert')) {
        $to = 'pendent';
        $text = __('vocabulario.estados.pendent');
    } else {
        $to = 'neutre';
        $text = $estat ?: __('vocabulario.estados.otro');
    }

    // Pendiente se lleva el ámbar de la aplicación: es lo que hay que atender.
    $estils = [
        'pendent' => 'border-estat-pendent/35 bg-estat-pendent-fons text-estat-pendent',
        'curs' => 'border-estat-curs/30 bg-estat-curs-fons text-estat-curs',
        'resolt' => 'border-estat-resolt/30 bg-estat-resolt-fons text-estat-resolt',
        'neutre' => 'border-linia bg-fons-3 text-tinta-2',
    ];

    $punts = [
        'pendent' => 'bg-estat-pendent',
        'curs' => 'bg-estat-curs',
        'resolt' => 'bg-estat-resolt',
        'neutre' => 'bg-tinta-3',
    ];

    $mida = $gran ? 'px-4 py-1.5 text-sm' : 'px-3 py-1 text-xs';
@endphp

<span {{ $attributes->merge(['class' => 'xip whitespace-nowrap border '.$estils[$to].' '.$mida]) }}>
    <span class="h-1.5 w-1.5 shrink-0 rounded-full {{ $punts[$to] }}"></span>
    {{ $text }}
</span>
