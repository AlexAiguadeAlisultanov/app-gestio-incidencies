<section>
    <header>
        <h2 class="text-lg font-semibold tracking-tight text-tinta">{{ __('perfil.contrasena.titulo') }}</h2>
        <p class="mt-2 text-sm leading-relaxed text-tinta-2">
            {{ __('perfil.contrasena.entrada') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('perfil.contrasena.actual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-2" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('perfil.contrasena.nueva')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-2" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('perfil.contrasena.repetir')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-2" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('perfil.contrasena.guardar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ visible: true }"
                   x-show="visible"
                   x-transition
                   x-init="setTimeout(() => visible = false, 3000)"
                   class="text-sm text-tinta-2">{{ __('perfil.contrasena.guardada') }}</p>
            @endif
        </div>
    </form>
</section>
