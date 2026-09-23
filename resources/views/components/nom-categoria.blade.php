@props(['tipus' => null])

@php
    // El nombre de la categoría se guarda en catalán en la base de datos. Aquí solo se
    // cambia la etiqueta que se ve; el valor guardado no se toca. Si llega una categoría
    // que no está en el vocabulario, se enseña tal cual.
    $guardado = trim((string) $tipus);
    $etiquetas = trans('vocabulario.categorias');
@endphp

{{ $guardado === '' ? __('vocabulario.sin_categoria') : ($etiquetas[$guardado] ?? $guardado) }}
