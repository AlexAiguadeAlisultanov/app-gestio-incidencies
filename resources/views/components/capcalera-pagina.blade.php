@props([
    'numero' => null,
    'titol',
    'rotul' => null,
    'entrada' => null,
    'enrere' => null,
    'enrereText' => null,
])

{{-- Cabecera de pantalla: el número de sección en contorno al lado del nombre, como en
     el portafolio, pero en tamaño de herramienta para que debajo quepa ya el trabajo. --}}
<div {{ $attributes->merge(['class' => 'entra']) }}>
    @if ($enrere)
        <a href="{{ $enrere }}" class="inline-flex min-h-[44px] items-center gap-2 rounded-control text-sm font-medium text-tinta-2 transition-colors duration-200 hover:text-tinta">
            <x-icona nom="enrere" class="h-4 w-4" />
            {{ $enrereText }}
        </a>
    @endif

    <div class="flex flex-wrap items-end justify-between gap-x-8 gap-y-4 {{ $enrere ? 'mt-2' : '' }}">
        <div class="flex items-baseline gap-4">
            @if ($numero)
                <span class="num shrink-0" aria-hidden="true">{{ $numero }}</span>
            @endif

            <div class="min-w-0">
                @if ($rotul)
                    <p class="rotul">{{ $rotul }}</p>
                @endif

                <h1 class="titular titular-l {{ $rotul ? 'mt-1.5' : '' }}">{{ $titol }}</h1>
            </div>
        </div>

        @if (! $slot->isEmpty())
            <div class="flex flex-wrap items-center gap-3">
                {{ $slot }}
            </div>
        @endif
    </div>

    @if ($entrada)
        <p class="mt-4 max-w-lectura text-sm leading-relaxed text-tinta-2">{{ $entrada }}</p>
    @endif
</div>
