@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'rounded-control border border-estat-resolt/30 bg-estat-resolt-fons px-4 py-3 text-sm font-medium text-estat-resolt']) }}>
        {{ $status }}
    </div>
@endif
