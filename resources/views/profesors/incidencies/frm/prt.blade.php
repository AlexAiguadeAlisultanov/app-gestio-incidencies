@php
    // Campos de la incidencia. Se incluye dentro de un <form> ya abierto,
    // tanto para crear (panel de inicio) como para editar.
    // Los name de los campos son los que leen IncidenciesController@store y @update.
    $fitxa = $incidencies ?? null;
    $edicio = ! empty($fitxa?->id);

    // Los valores de `estat` se guardan tal como están en la base; aquí solo cambia la
    // etiqueta que se lee en el desplegable.
    $estats = [
        'Pendent' => __('vocabulario.estados.pendent'),
        'En curs' => __('vocabulario.estados.curs'),
        'Resolt' => __('vocabulario.estados.resolt'),
    ];

    $estatActual = old('estat', $fitxa->estat ?? 'Pendent');

    // El controlador no pasa las categorías a la vista, así que se leen aquí para
    // poder elegirlas por nombre en vez de escribir un número a mano. El value que
    // viaja sigue siendo el id.
    $categories = \App\Models\Categories::orderBy('tipus')->pluck('tipus', 'id');
    $etiquetesCategoria = trans('vocabulario.categorias');
    $categoriaActual = old('categoria_id', $fitxa->categoria_id ?? null);

    $propietari = \App\Models\User::find($fitxa->user_id ?? auth()->id());
    $propietariId = old('user_id', $fitxa->user_id ?? auth()->id());

    $hora = old('hora', \Illuminate\Support\Str::substr((string) ($fitxa->hora ?? ''), 0, 5));
    $data = old('data', $fitxa->data ?? now()->toDateString());
@endphp

<div class="space-y-6">
    <div>
        <x-input-label for="titol" :value="__('incidencias.formulario.titulo')" />
        <x-text-input id="titol" name="titol" type="text" class="mt-2" required maxlength="255"
                      :value="old('titol', $fitxa->titol ?? '')"
                      :placeholder="__('incidencias.formulario.titulo_pista')" />
        <x-input-error :messages="$errors->get('titol')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="descripcio" :value="__('incidencias.formulario.descripcion')" />
        <x-textarea-input id="descripcio" name="descripcio" class="mt-2" rows="3" required
                          :placeholder="__('incidencias.formulario.descripcion_pista')">{{ old('descripcio', $fitxa->descripcio ?? '') }}</x-textarea-input>
        <x-input-error :messages="$errors->get('descripcio')" class="mt-2" />
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="lloc" :value="__('incidencias.formulario.sitio')" />
            <x-text-input id="lloc" name="lloc" type="text" class="mt-2" required maxlength="255"
                          :value="old('lloc', $fitxa->lloc ?? '')"
                          :placeholder="__('incidencias.formulario.sitio_pista')" />
            <x-input-error :messages="$errors->get('lloc')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="categoria_id" :value="__('incidencias.formulario.categoria')" />
            <x-select-input id="categoria_id" name="categoria_id" class="mt-2" required>
                <option value="" disabled @selected($categoriaActual === null)>{{ __('incidencias.formulario.categoria_vacia') }}</option>
                @foreach ($categories as $id => $tipus)
                    <option value="{{ $id }}" @selected((string) $categoriaActual === (string) $id)>{{ $etiquetesCategoria[$tipus] ?? $tipus }}</option>
                @endforeach
            </x-select-input>
            <p class="mt-2 text-xs text-tinta-500 dark:text-tinta-400">{{ __('incidencias.formulario.categoria_pista') }}</p>
            <x-input-error :messages="$errors->get('categoria_id')" class="mt-2" />
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-3">
        <div>
            <x-input-label for="data" :value="__('incidencias.formulario.dia')" />
            <x-text-input id="data" name="data" type="date" class="mt-2" required :value="$data" />
            <x-input-error :messages="$errors->get('data')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="hora" :value="__('incidencias.formulario.hora')" />
            <x-text-input id="hora" name="hora" type="time" class="mt-2" required :value="$hora" />
            <x-input-error :messages="$errors->get('hora')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="estat" :value="__('incidencias.formulario.estado')" />
            <x-select-input id="estat" name="estat" class="mt-2" required>
                @foreach ($estats as $valor => $etiqueta)
                    <option value="{{ $valor }}" @selected($estatActual === $valor)>{{ $etiqueta }}</option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('estat')" class="mt-2" />
        </div>
    </div>

    {{-- Quién la da de alta viaja en el formulario, pero no se escribe a mano --}}
    <input type="hidden" name="user_id" value="{{ $propietariId }}">

    <p class="flex items-center gap-2 text-xs text-tinta-500 dark:text-tinta-400">
        <x-icona nom="persona" class="h-4 w-4" />
        {{ __('incidencias.formulario.a_nombre_de', ['nombre' => $propietari?->name ?? __('incidencias.formulario.usuario', ['id' => $propietariId])]) }}
    </p>

    <div class="flex flex-wrap items-center gap-3 border-t border-tinta-200 pt-6 dark:border-tinta-800">
        <x-primary-button>
            <x-icona nom="{{ $edicio ? 'editar' : 'afegir' }}" class="h-4 w-4" />
            {{ $edicio ? __('app.acciones.guardar_cambios') : __('incidencias.formulario.enviar') }}
        </x-primary-button>

        <a href="{{ url('/profesors/incidencies') }}" class="boto-discret">{{ __('app.acciones.cancelar') }}</a>
    </div>
</div>
