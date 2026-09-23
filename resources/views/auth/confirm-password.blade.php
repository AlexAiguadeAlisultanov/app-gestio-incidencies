<x-guest-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('acceso.confirmar.titulo_pagina')]) }}</x-slot>

    <header class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('acceso.confirmar.titulo') }}</h1>
        <p class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
            {{ __('acceso.confirmar.entrada') }}
        </p>
    </header>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="password" :value="__('acceso.campos.contrasena')" />
            <x-text-input id="password" class="mt-2" type="password" name="password" required autocomplete="current-password" autofocus />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">{{ __('acceso.confirmar.enviar') }}</x-primary-button>
    </form>
</x-guest-layout>
