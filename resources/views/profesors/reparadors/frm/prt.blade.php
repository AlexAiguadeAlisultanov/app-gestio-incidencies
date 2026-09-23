@php
    // Campos del reparador. Se incluye dentro de un <form> ya abierto, al crear y al editar.
    // Los name son los que lee ReparadorsController.
    $fitxa = $reparadors ?? null;
    $edicio = ! empty($fitxa?->id);
@endphp

<div class="space-y-6">
    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="nombre" :value="__('reparadores.campos.nombre')" />
            <x-text-input id="nombre" name="nombre" type="text" class="mt-2" required maxlength="255"
                          :value="old('nombre', $fitxa->nombre ?? '')" />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="apellidos" :value="__('reparadores.campos.apellidos')" />
            <x-text-input id="apellidos" name="apellidos" type="text" class="mt-2" required maxlength="255"
                          :value="old('apellidos', $fitxa->apellidos ?? '')" />
            <x-input-error :messages="$errors->get('apellidos')" class="mt-2" />
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="email" :value="__('reparadores.campos.correo')" />
            <x-text-input id="email" name="email" type="email" class="mt-2" required maxlength="255"
                          :value="old('email', $fitxa->email ?? '')" :placeholder="__('reparadores.formulario.correo_pista')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="telefono" :value="__('reparadores.campos.telefono')" />
            <x-text-input id="telefono" name="telefono" type="tel" class="mt-2" required maxlength="255"
                          :value="old('telefono', $fitxa->telefono ?? '')" :placeholder="__('reparadores.formulario.telefono_pista')" />
            <p class="mt-2 text-xs text-tinta-3">{{ __('reparadores.formulario.telefono_nota') }}</p>
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="direccion" :value="__('reparadores.campos.direccion')" />
            <x-text-input id="direccion" name="direccion" type="text" class="mt-2" required maxlength="255"
                          :value="old('direccion', $fitxa->direccion ?? '')" />
            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="ciudad" :value="__('reparadores.campos.ciudad')" />
            <x-text-input id="ciudad" name="ciudad" type="text" class="mt-2" required maxlength="255"
                          :value="old('ciudad', $fitxa->ciudad ?? '')" />
            <x-input-error :messages="$errors->get('ciudad')" class="mt-2" />
        </div>
    </div>

    <div class="flex flex-wrap items-center gap-3 border-t border-linia-suau pt-6">
        <x-primary-button>
            <x-icona nom="{{ $edicio ? 'editar' : 'afegir' }}" class="h-4 w-4" />
            {{ $edicio ? __('app.acciones.guardar_cambios') : __('reparadores.formulario.enviar') }}
        </x-primary-button>

        <a href="{{ url('/profesors/reparadors') }}" class="boto-discret">{{ __('app.acciones.cancelar') }}</a>
    </div>
</div>
