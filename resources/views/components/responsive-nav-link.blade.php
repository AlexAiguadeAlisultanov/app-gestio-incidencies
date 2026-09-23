@props(['active'])

@php
    $base = 'flex w-full items-center gap-3 border-s-2 py-2 pe-4 ps-4 text-start text-base font-medium transition duration-200 ease-suau';

    $classes = ($active ?? false)
        ? $base.' border-acent-600 bg-acent-50 text-acent-700 dark:border-acent-400 dark:bg-acent-900/40 dark:text-acent-100'
        : $base.' border-transparent text-tinta-600 hover:bg-tinta-100 hover:text-tinta-900 dark:text-tinta-300 dark:hover:bg-tinta-800 dark:hover:text-tinta-50';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} @if ($active ?? false) aria-current="page" @endif>
    {{ $slot }}
</a>
