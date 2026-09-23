<x-guest-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('acceso.nueva.titulo')]) }}</x-slot>

    <header class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('acceso.nueva.titulo') }}</h1>
        <p class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
            {{ __('acceso.nueva.entrada') }}
        </p>
    </header>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('acceso.campos.correo')" />
            <x-text-input id="email" class="mt-2" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('acceso.campos.contrasena_nueva')" />
            <x-text-input id="password" class="mt-2" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('acceso.campos.contrasena_repetir')" />
            <x-text-input id="password_confirmation" class="mt-2" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">{{ __('acceso.nueva.enviar') }}</x-primary-button>
    </form>
</x-guest-layout>
