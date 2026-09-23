@props(['active'])

@php
    $base = 'flex min-h-[44px] w-full items-center gap-3 border-s-2 py-2 pe-4 ps-4 text-start text-sm font-medium transition-colors duration-200 ease-suau';

    $classes = ($active ?? false)
        ? $base.' border-ambre bg-ambre-fons text-ambre'
        : $base.' border-transparent text-tinta-2 hover:bg-fons-3 hover:text-tinta';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} @if ($active ?? false) aria-current="page" @endif>
    {{ $slot }}
</a>
