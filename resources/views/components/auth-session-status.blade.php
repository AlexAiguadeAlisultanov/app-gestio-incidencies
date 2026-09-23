@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'rounded-control bg-estat-resolt-fons px-4 py-3 text-sm font-medium text-estat-resolt dark:bg-estat-resolt/20 dark:text-estat-resolt-clar']) }}>
        {{ $status }}
    </div>
@endif
