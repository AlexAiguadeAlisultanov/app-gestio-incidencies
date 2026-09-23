<x-guest-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('acceso.entrar.titulo')]) }}</x-slot>

    <header class="mb-8">
        <h1 class="text-xl font-semibold tracking-tight text-tinta">{{ __('acceso.entrar.titulo') }}</h1>
        <p class="mt-2 text-sm leading-relaxed text-tinta-2">
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
                    <a class="rounded-control text-xs font-medium text-ambre hover:text-ambre-clar" href="{{ route('password.request') }}">
                        {{ __('acceso.entrar.olvidada') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="mt-2" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex min-h-[44px] items-center gap-3">
            <input id="remember_me" type="checkbox" name="remember"
                   class="h-5 w-5 rounded border-linia bg-fons-3 text-ambre focus:ring-ambre">
            <span class="text-sm text-tinta-2">{{ __('acceso.entrar.recordarme') }}</span>
        </label>

        <x-primary-button class="w-full">{{ __('acceso.entrar.enviar') }}</x-primary-button>
    </form>

    @if (Route::has('register'))
        <p class="mt-8 border-t border-linia-suau pt-6 text-center text-sm text-tinta-2">
            {{ __('acceso.entrar.sin_cuenta') }}
            <a href="{{ route('register') }}" class="rounded-control font-medium text-ambre hover:text-ambre-clar">{{ __('acceso.entrar.crearla') }}</a>
        </p>
    @endif
</x-guest-layout>
