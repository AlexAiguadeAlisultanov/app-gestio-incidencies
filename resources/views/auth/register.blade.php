<x-guest-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('acceso.registro.titulo')]) }}</x-slot>

    <header class="mb-8">
        <h1 class="text-xl font-semibold tracking-tight text-tinta">{{ __('acceso.registro.titulo') }}</h1>
        <p class="mt-2 text-sm leading-relaxed text-tinta-2">
            {{ __('acceso.registro.entrada') }}
        </p>
    </header>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="name" :value="__('acceso.campos.nombre')" />
            <x-text-input id="name" class="mt-2" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('acceso.campos.correo')" />
            <x-text-input id="email" class="mt-2" type="email" name="email" :value="old('email')" required autocomplete="username" :placeholder="__('acceso.campos.correo_pista')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="rol_usuari" :value="__('acceso.registro.rol')" />
            {{-- El name del campo y los valores son los que espera el controlador.
                 Solo cambia la etiqueta que se lee. --}}
            <x-select-input id="rol_usuari" name="rol_usuari" class="mt-2" required>
                <option value="profesor" @selected(old('rol_usuari') === 'profesor')>{{ __('vocabulario.roles.profesor') }}. {{ __('acceso.registro.rol_profesor') }}</option>
                <option value="reparador" @selected(old('rol_usuari') === 'reparador')>{{ __('vocabulario.roles.reparador') }}. {{ __('acceso.registro.rol_reparador') }}</option>
            </x-select-input>
            <x-input-error :messages="$errors->get('rol_usuari')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('acceso.campos.contrasena')" />
            <x-text-input id="password" class="mt-2" type="password" name="password" required autocomplete="new-password" />
            <p class="mt-2 text-xs text-tinta-3">{{ __('acceso.registro.contrasena_nota') }}</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('acceso.campos.contrasena_repetir')" />
            <x-text-input id="password_confirmation" class="mt-2" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full">{{ __('acceso.registro.enviar') }}</x-primary-button>
    </form>

    <p class="mt-8 border-t border-linia-suau pt-6 text-center text-sm text-tinta-2">
        {{ __('acceso.registro.con_cuenta') }}
        <a href="{{ route('login') }}" class="rounded-control font-medium text-ambre hover:text-ambre-clar">{{ __('acceso.registro.entrar') }}</a>
    </p>
</x-guest-layout>
