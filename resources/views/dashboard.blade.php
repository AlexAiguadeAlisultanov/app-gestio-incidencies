@php
    // El controlador de esta pantalla no pasa datos a la vista (la ruta devuelve la vista
    // directamente), así que el resumen se lee aquí. Mismo criterio que en el listado:
    // quien repara ve todo el centro, el profesorado ve lo suyo.
    $usuari = auth()->user();
    $veuTot = in_array($usuari?->rol_usuari, ['manteniment', 'reparador'], true);

    $consulta = \App\Models\Incidencies::query();

    if (! $veuTot) {
        $consulta->where('user_id', $usuari?->id);
    }

    $recompte = (clone $consulta)
        ->selectRaw('estat, count(*) as total')
        ->groupBy('estat')
        ->pluck('total', 'estat');

    $compta = function (array $claus) use ($recompte) {
        $total = 0;

        foreach ($recompte as $estat => $quantes) {
            $normalitzat = \Illuminate\Support\Str::lower((string) $estat);

            foreach ($claus as $clau) {
                if (str_contains($normalitzat, $clau)) {
                    $total += $quantes;
                    break;
                }
            }
        }

        return $total;
    };

    $resum = [
        ['clau' => 'pendent', 'text' => __('vocabulario.estados_plural.pendent'), 'icona' => 'pendent', 'total' => $compta(['pendent', 'obert']),
         'classe' => 'text-estat-pendent dark:text-estat-pendent-clar'],
        ['clau' => 'curs', 'text' => __('vocabulario.estados_plural.curs'), 'icona' => 'curs', 'total' => $compta(['curs', 'proc']),
         'classe' => 'text-estat-curs dark:text-estat-curs-clar'],
        ['clau' => 'resolt', 'text' => __('vocabulario.estados_plural.resolt'), 'icona' => 'resolt', 'total' => $compta(['resol', 'tanca']),
         'classe' => 'text-estat-resolt dark:text-estat-resolt-clar'],
    ];

    $ultimes = (clone $consulta)->orderByDesc('data')->orderByDesc('hora')->limit(5)->get();
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('incidencias.titulo_inicio')]) }}</x-slot>

    <x-slot name="header">
        <p class="text-sm text-tinta-500 dark:text-tinta-400">{{ __('incidencias.panel.saludo', ['nombre' => $usuari?->name]) }}</p>
        <h1 class="mt-1 text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">
            {{ $veuTot ? __('incidencias.panel.todo') : __('incidencias.panel.propias') }}
        </h1>
    </x-slot>

    <section aria-label="{{ __('incidencias.panel.resumen') }}">
        <ul class="grid gap-4 sm:grid-cols-3">
            @foreach ($resum as $bloc)
                <li>
                    <a href="{{ url('/profesors/incidencies') }}?estat={{ $bloc['clau'] }}"
                       class="targeta flex items-center justify-between gap-4 p-6 transition duration-200 ease-suau hover:border-tinta-300 hover:shadow-elevat dark:hover:border-tinta-700">
                        <span>
                            <span class="block text-3xl font-semibold tabular-nums tracking-tight text-tinta-900 dark:text-tinta-50">{{ $bloc['total'] }}</span>
                            <span class="mt-1 block text-sm text-tinta-600 dark:text-tinta-400">{{ $bloc['text'] }}</span>
                        </span>
                        <x-icona :nom="$bloc['icona']" class="h-6 w-6 {{ $bloc['classe'] }}" />
                    </a>
                </li>
            @endforeach
        </ul>
    </section>

    <div class="mt-8 grid gap-8 lg:grid-cols-2">
        <section aria-labelledby="alta" class="targeta p-6 sm:p-8">
            <h2 id="alta" class="text-lg font-medium tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('incidencias.panel.alta_titulo') }}</h2>
            <p class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
                {{ __('incidencias.panel.alta_texto') }}
            </p>

            <form method="POST" action="{{ route('profesors/incidencies/store') }}" class="mt-8">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @include('profesors.incidencies.frm.prt', ['incidencies' => null])
            </form>
        </section>

        <section aria-labelledby="ultimas" class="targeta p-6 sm:p-8">
            <div class="flex flex-wrap items-baseline justify-between gap-3">
                <h2 id="ultimas" class="text-lg font-medium tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('incidencias.panel.ultimas') }}</h2>

                <a href="{{ url('/profesors/incidencies') }}" class="inline-flex items-center gap-1 rounded-control text-sm font-medium text-acent-600 hover:text-acent-700 dark:text-acent-400 dark:hover:text-acent-300">
                    {{ __('incidencias.panel.verlas_todas') }}
                    <x-icona nom="endavant" class="h-4 w-4" />
                </a>
            </div>

            @if ($ultimes->isEmpty())
                <div class="mt-8 flex flex-col items-center gap-3 rounded-targeta border border-dashed border-tinta-300 px-6 py-12 text-center dark:border-tinta-700">
                    <x-icona nom="buit" class="h-8 w-8 text-tinta-400" />
                    <p class="text-sm text-tinta-600 dark:text-tinta-400">{{ __('incidencias.panel.sin_nada') }}</p>
                </div>
            @else
                <ul class="mt-6 divide-y divide-tinta-200 dark:divide-tinta-800">
                    @foreach ($ultimes as $inci)
                        <li>
                            <a href="{{ route('profesors/incidencies/detalles', $inci->id) }}"
                               class="flex items-center justify-between gap-4 rounded-control py-4 transition duration-200 ease-suau hover:bg-tinta-50 dark:hover:bg-tinta-800/60">
                                <span class="min-w-0">
                                    <span class="block truncate text-sm font-medium text-tinta-900 dark:text-tinta-50">{{ $inci->titol }}</span>
                                    <span class="mt-1 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-tinta-500 dark:text-tinta-400">
                                        <span class="flex items-center gap-1.5">
                                            <x-icona nom="lloc" class="h-3.5 w-3.5" />
                                            {{ $inci->lloc }}
                                        </span>
                                        <span class="flex items-center gap-1.5">
                                            <x-icona nom="data" class="h-3.5 w-3.5" />
                                            {{ $inci->data }}
                                        </span>
                                    </span>
                                </span>
                                <x-estat-insignia :estat="$inci->estat" class="shrink-0" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
</x-app-layout>
