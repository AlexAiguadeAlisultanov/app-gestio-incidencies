<section>
    <header>
        <h2 class="text-lg font-semibold tracking-tight text-tinta">{{ __('perfil.borrar.titulo') }}</h2>
        <p class="mt-2 text-sm leading-relaxed text-tinta-2">
            {{ __('perfil.borrar.entrada') }}
        </p>
    </header>

    <x-danger-button
        class="mt-6"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('perfil.borrar.boton') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold tracking-tight text-tinta">{{ __('perfil.borrar.confirmar_titulo') }}</h2>

            <p class="mt-2 text-sm leading-relaxed text-tinta-2">
                {{ __('perfil.borrar.confirmar_texto') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" :value="__('perfil.borrar.contrasena')" class="sr-only" />

                <x-text-input id="password" name="password" type="password" :placeholder="__('perfil.borrar.contrasena')" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex flex-wrap justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('app.acciones.dejarlo') }}</x-secondary-button>
                <x-danger-button>{{ __('perfil.borrar.boton') }}</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
