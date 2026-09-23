@props(['icona' => null, 'etiqueta'])

{{-- Un dato de la ficha: etiqueta pequeña arriba, valor debajo --}}
<div {{ $attributes->merge(['class' => 'flex gap-3']) }}>
    @if ($icona)
        <x-icona :nom="$icona" class="mt-0.5 h-5 w-5 shrink-0 text-tinta-3" />
    @endif
    <div class="min-w-0">
        <dt class="rotul">{{ $etiqueta }}</dt>
        <dd class="mt-1 break-words text-sm text-tinta">{{ $slot }}</dd>
    </div>
</div>
