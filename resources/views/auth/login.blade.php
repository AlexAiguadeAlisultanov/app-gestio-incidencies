<x-guest-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('acceso.entrar.titulo')]) }}</x-slot>

    <header class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('acceso.entrar.titulo') }}</h1>
        <p class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
            {{ __('acceso.entrar.entrada') }}
        </p>
    </header>

    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('acceso.campos.correo')" />
            <x-text-input id="email" class="mt-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" :placeholder="__('acceso.campos.correo_pista')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-baseline justify-between gap-4">
                <x-input-label for="password" :value="__('acceso.campos.contrasena')" />

                @if (Route::has('password.request'))
                    <a class="rounded-control text-xs font-medium text-acent-600 hover:text-acent-700 dark:text-acent-400 dark:hover:text-acent-300" href="{{ route('password.request') }}">
                        {{ __('acceso.entrar.olvidada') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="mt-2" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex items-center gap-3">
            <input id="remember_me" type="checkbox" name="remember"
                   class="rounded border-tinta-300 text-acent-600 shadow-sm focus:ring-acent-500 dark:border-tinta-600 dark:bg-tinta-800 dark:focus:ring-acent-400">
            <span class="text-sm text-tinta-600 dark:text-tinta-400">{{ __('acceso.entrar.recordarme') }}</span>
        </label>

        <x-primary-button class="w-full">{{ __('acceso.entrar.enviar') }}</x-primary-button>
    </form>

    @if (Route::has('register'))
        <p class="mt-8 border-t border-tinta-200 pt-6 text-center text-sm text-tinta-600 dark:border-tinta-800 dark:text-tinta-400">
            {{ __('acceso.entrar.sin_cuenta') }}
            <a href="{{ route('register') }}" class="rounded-control font-medium text-acent-600 hover:text-acent-700 dark:text-acent-400 dark:hover:text-acent-300">{{ __('acceso.entrar.crearla') }}</a>
        </p>
    @endif
</x-guest-layout>
