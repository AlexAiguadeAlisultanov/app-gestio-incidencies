@php
    // El rol viene guardado en la base de datos; aquí solo se enseña su etiqueta.
    $rolGuardado = trim((string) auth()->user()?->rol_usuari);
    $rolesTraducidos = trans('vocabulario.roles');
    $rol = $rolGuardado === '' ? null : ($rolesTraducidos[$rolGuardado] ?? $rolGuardado);
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('perfil.titulo')]) }}</x-slot>

    <x-capcalera-pagina
        numero="04"
        :titol="__('perfil.titulo')"
        :entrada="__('perfil.entrada')">

        @if ($rol)
            <span class="xip border border-linia bg-fons-3 text-tinta-2">{{ __('perfil.papel') }} {{ $rol }}</span>
        @endif
    </x-capcalera-pagina>

    <div class="mt-8 grid max-w-6xl gap-6 lg:grid-cols-2">
        <div class="entra targeta p-6 sm:p-8" style="--r: 60ms">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="entra targeta p-6 sm:p-8" style="--r: 120ms">
            @include('profile.partials.update-password-form')
        </div>

        <div class="entra targeta border-perill/25 p-6 sm:p-8 lg:col-span-2" style="--r: 180ms">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
