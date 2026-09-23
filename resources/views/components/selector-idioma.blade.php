@php
    $idiomas = \App\Http\Middleware\Idioma::DISPONIBLES;
    $actual = app()->getLocale();
@endphp

{{-- Selector de idioma: tres enlaces, uno por idioma. Sin JavaScript, así que funciona
     también en la portada y en el login. --}}
<div {{ $attributes->merge(['class' => 'flex items-center gap-0.5 rounded-control border border-linia bg-fons-2 p-1']) }}
     role="group" aria-label="{{ __('app.idioma.grupo') }}">
    @foreach ($idiomas as $codi => $idioma)
        @php $esActual = $codi === $actual; @endphp

        <a href="{{ route('idioma', $codi) }}"
           @if ($esActual) aria-current="true" @endif
           title="{{ $idioma['nombre'] }}"
           class="flex min-h-[44px] items-center gap-1.5 rounded-control px-2 text-xs font-medium transition-colors duration-200 ease-suau
                  {{ $esActual ? 'bg-ambre-fons text-ambre' : 'text-tinta-3 hover:bg-fons-3 hover:text-tinta' }}">

            <x-bandera :codi="$idioma['bandera']"
                       class="shrink-0 rounded-[2px] ring-1 ring-inset ring-fons/40 {{ $esActual ? '' : 'opacity-70' }}" />

            <span aria-hidden="true" class="hidden sm:inline">{{ $idioma['corto'] }}</span>

            <span class="sr-only">
                {{ $esActual ? $idioma['nombre'] : __('app.idioma.cambiar_a', ['idioma' => $idioma['nombre']]) }}
            </span>
        </a>
    @endforeach
</div>
