@props(['active'])

@php
    $base = 'inline-flex min-h-[44px] items-center gap-2 whitespace-nowrap rounded-control px-3 text-sm font-medium transition-colors duration-200 ease-suau';

    $classes = ($active ?? false)
        ? $base.' bg-ambre-fons text-ambre'
        : $base.' text-tinta-2 hover:bg-fons-3 hover:text-tinta';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} @if ($active ?? false) aria-current="page" @endif>
    {{ $slot }}
</a>
