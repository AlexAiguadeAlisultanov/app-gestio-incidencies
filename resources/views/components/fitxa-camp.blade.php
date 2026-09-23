@props(['icona' => null, 'etiqueta'])

{{-- Una dada de la fitxa: etiqueta petita a dalt, valor a sota --}}
<div {{ $attributes->merge(['class' => 'flex gap-3']) }}>
    @if ($icona)
        <x-icona :nom="$icona" class="mt-0.5 h-5 w-5 shrink-0 text-tinta-400 dark:text-tinta-500" />
    @endif
    <div class="min-w-0">
        <dt class="text-xs font-medium uppercase tracking-wide text-tinta-500 dark:text-tinta-400">{{ $etiqueta }}</dt>
        <dd class="mt-1 break-words text-sm text-tinta-900 dark:text-tinta-100">{{ $slot }}</dd>
    </div>
</div>
