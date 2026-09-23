@php
    // El rol viene guardado en la base de datos; aquí solo se enseña su etiqueta.
    $rolGuardado = trim((string) auth()->user()?->rol_usuari);
    $rolesTraducidos = trans('vocabulario.roles');
    $rol = $rolGuardado === '' ? null : ($rolesTraducidos[$rolGuardado] ?? $rolGuardado);
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('perfil.titulo')]) }}</x-slot>

    <x-slot name="header">
        <h1 class="text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('perfil.titulo') }}</h1>
        <p class="mt-2 text-sm text-tinta-600 dark:text-tinta-400">{{ __('perfil.entrada') }}</p>

        @if ($rol)
            <p class="mt-4 flex items-center gap-2 text-sm text-tinta-600 dark:text-tinta-400">
                {{ __('perfil.papel') }}
                <span class="xip bg-acent-50 text-acent-700 dark:bg-acent-900/40 dark:text-acent-200">{{ $rol }}</span>
            </p>
        @endif
    </x-slot>

    <div class="mx-auto max-w-2xl space-y-8">
        <div class="targeta p-6 sm:p-8">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="targeta p-6 sm:p-8">
            @include('profile.partials.update-password-form')
        </div>

        <div class="targeta border-perill-600/20 p-6 sm:p-8 dark:border-perill-600/30">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
