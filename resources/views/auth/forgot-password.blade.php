<x-guest-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('acceso.olvidada.titulo')]) }}</x-slot>

    <header class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('acceso.olvidada.titulo') }}</h1>
        <p class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
            {{ __('acceso.olvidada.entrada') }}
        </p>
    </header>

    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('acceso.campos.correo')" />
            <x-text-input id="email" class="mt-2" type="email" name="email" :value="old('email')" required autofocus :placeholder="__('acceso.campos.correo_pista')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">{{ __('acceso.olvidada.enviar') }}</x-primary-button>
    </form>

    <p class="mt-8 border-t border-tinta-200 pt-6 text-center text-sm dark:border-tinta-800">
        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-control font-medium text-acent-600 hover:text-acent-700 dark:text-acent-400 dark:hover:text-acent-300">
            <x-icona nom="enrere" class="h-4 w-4" />
            {{ __('acceso.olvidada.volver') }}
        </a>
    </p>
</x-guest-layout>
