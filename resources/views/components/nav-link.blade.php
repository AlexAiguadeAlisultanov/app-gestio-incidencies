@props(['active'])

@php
    $base = 'inline-flex items-center gap-2 border-b-2 px-1 pt-1 text-sm font-medium transition duration-200 ease-suau';

    $classes = ($active ?? false)
        ? $base.' border-acent-600 text-tinta-900 dark:border-acent-400 dark:text-tinta-50'
        : $base.' border-transparent text-tinta-500 hover:border-tinta-300 hover:text-tinta-800 dark:text-tinta-400 dark:hover:border-tinta-600 dark:hover:text-tinta-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} @if ($active ?? false) aria-current="page" @endif>
    {{ $slot }}
</a>
