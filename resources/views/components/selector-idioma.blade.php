@php
    $idiomas = \App\Http\Middleware\Idioma::DISPONIBLES;
    $actual = app()->getLocale();
@endphp

{{-- Selector de idioma: tres enlaces, uno por idioma. Sin JavaScript, así que funciona
     también en la portada y en el login. --}}
<div {{ $attributes->merge(['class' => 'flex items-center gap-0.5 rounded-control border border-tinta-200 bg-white p-1 dark:border-tinta-800 dark:bg-tinta-900']) }}
     role="group" aria-label="{{ __('app.idioma.grupo') }}">
    @foreach ($idiomas as $codi => $idioma)
        @php $esActual = $codi === $actual; @endphp

        <a href="{{ route('idioma', $codi) }}"
           @if ($esActual) aria-current="true" @endif
           title="{{ $idioma['nombre'] }}"
           class="flex items-center gap-1.5 rounded-control px-2 py-1 text-xs font-medium transition duration-200 ease-suau
                  {{ $esActual
                        ? 'bg-acent-50 text-acent-700 dark:bg-acent-900/50 dark:text-acent-100'
                        : 'text-tinta-500 hover:bg-tinta-100 hover:text-tinta-800 dark:text-tinta-400 dark:hover:bg-tinta-800 dark:hover:text-tinta-100' }}">

            <x-bandera :codi="$idioma['bandera']"
                       class="shrink-0 rounded-[2px] ring-1 ring-inset ring-tinta-900/15 {{ $esActual ? '' : 'opacity-70' }}" />

            <span aria-hidden="true" class="hidden sm:inline">{{ $idioma['corto'] }}</span>

            <span class="sr-only">
                {{ $esActual ? $idioma['nombre'] : __('app.idioma.cambiar_a', ['idioma' => $idioma['nombre']]) }}
            </span>
        </a>
    @endforeach
</div>
