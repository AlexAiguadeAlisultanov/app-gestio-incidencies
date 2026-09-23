<section>
    <header>
        <h2 class="text-lg font-semibold tracking-tight text-tinta">{{ __('perfil.datos.titulo') }}</h2>
        <p class="mt-2 text-sm leading-relaxed text-tinta-2">
            {{ __('perfil.datos.entrada') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('perfil.datos.nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-2" :value="old('name', $user->name)" required autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('perfil.datos.correo')" />
            <x-text-input id="email" name="email" type="email" class="mt-2" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="mt-3 text-sm text-tinta-2">
                    {{ __('perfil.datos.sin_verificar') }}

                    <button form="send-verification" class="rounded-control font-medium text-ambre hover:text-ambre-clar">
                        {{ __('perfil.datos.reenviar') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-medium text-estat-resolt">
                        {{ __('perfil.datos.enviado') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('perfil.datos.guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ visible: true }"
                   x-show="visible"
                   x-transition
                   x-init="setTimeout(() => visible = false, 3000)"
                   class="text-sm text-tinta-2">{{ __('perfil.datos.guardado') }}</p>
            @endif
        </div>
    </form>
</section>
