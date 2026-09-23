@php
    // Los controladores dejan el mensaje con su propio texto; aquí se traduce al idioma
    // que esté puesto. Si llega un mensaje que no está en la lista, se enseña tal cual.
    $missatge = session('message');

    $traduccio = [
        'Guardado Satisfactoriamente!' => __('app.aviso.guardada'),
        'Editado Satisfactoriamente!' => __('app.aviso.cambios'),
        'Eliminado Satisfactoriamente!' => __('app.aviso.eliminada'),
    ];
@endphp

@if ($missatge)
    <div role="status"
         x-data="{ visible: true }"
         x-show="visible"
         x-transition.duration.200ms
         class="mb-8 flex items-start gap-3 rounded-targeta border border-estat-resolt/25 bg-estat-resolt-fons px-4 py-3 text-sm text-estat-resolt dark:border-estat-resolt/40 dark:bg-estat-resolt/15 dark:text-estat-resolt-clar">
        <x-icona nom="resolt" class="mt-0.5 h-5 w-5 shrink-0" />
        <p class="flex-1">{{ $traduccio[$missatge] ?? $missatge }}</p>
        <button type="button" @click="visible = false" class="rounded-control p-1 hover:bg-estat-resolt/10" aria-label="{{ __('app.aviso.cerrar') }}">
            <x-icona nom="tancar" class="h-4 w-4" />
        </button>
    </div>
@endif
