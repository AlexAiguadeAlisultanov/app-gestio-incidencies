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

    $estils = [
        'pendent' => 'bg-estat-pendent-fons text-estat-pendent dark:bg-estat-pendent/15 dark:text-estat-pendent-clar',
        'curs' => 'bg-estat-curs-fons text-estat-curs dark:bg-estat-curs/20 dark:text-estat-curs-clar',
        'resolt' => 'bg-estat-resolt-fons text-estat-resolt dark:bg-estat-resolt/20 dark:text-estat-resolt-clar',
        'neutre' => 'bg-tinta-100 text-tinta-600 dark:bg-tinta-800 dark:text-tinta-300',
    ];

    $punts = [
        'pendent' => 'bg-estat-pendent dark:bg-estat-pendent-clar',
        'curs' => 'bg-estat-curs dark:bg-estat-curs-clar',
        'resolt' => 'bg-estat-resolt dark:bg-estat-resolt-clar',
        'neutre' => 'bg-tinta-400',
    ];

    $mida = $gran ? 'px-4 py-1.5 text-sm' : 'px-3 py-1 text-xs';
@endphp

<span {{ $attributes->merge(['class' => 'xip '.$estils[$to].' '.$mida]) }}>
    <span class="h-2 w-2 shrink-0 rounded-full {{ $punts[$to] }}"></span>
    {{ $text }}
</span>
