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

    // Los tres recuentos son el titular de esta pantalla: lo primero que se lee es si hay
    // algo pendiente. Pendiente se lleva el ámbar; los otros dos van en el gris del resto.
    $resum = [
        [
            'clau' => 'pendent',
            'text' => __('vocabulario.estados_plural.pendent'),
            'total' => $compta(['pendent', 'obert']),
            'xifra' => 'xifra xifra-ambre',
            'barra' => 'bg-estat-pendent',
        ],
        [
            'clau' => 'curs',
            'text' => __('vocabulario.estados_plural.curs'),
            'total' => $compta(['curs', 'proc']),
            'xifra' => 'xifra',
            'barra' => 'bg-estat-curs',
        ],
        [
            'clau' => 'resolt',
            'text' => __('vocabulario.estados_plural.resolt'),
            'total' => $compta(['resol', 'tanca']),
            'xifra' => 'xifra',
            'barra' => 'bg-estat-resolt',
        ],
    ];

    $ultimes = (clone $consulta)->orderByDesc('data')->orderByDesc('hora')->limit(6)->get();
@endphp

<x-app-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('incidencias.titulo_inicio')]) }}</x-slot>

    <div class="entra flex flex-wrap items-end justify-between gap-x-8 gap-y-4">
        <div class="flex items-baseline gap-4">
            <span class="num shrink-0" aria-hidden="true">01</span>

            <div class="min-w-0">
                <p class="rotul">{{ __('incidencias.panel.saludo', ['nombre' => $usuari?->name]) }}</p>
                <h1 class="titular titular-m mt-1.5">
                    {{ $veuTot ? __('incidencias.panel.todo') : __('incidencias.panel.propias') }}
                </h1>
            </div>
        </div>

        <a href="#alta" class="boto-primari">
            <x-icona nom="afegir" class="h-4 w-4" />
            {{ __('incidencias.listado.nueva') }}
        </a>
    </div>

    {{-- El marcador. Cada recuento lleva al listado ya filtrado por ese estado. --}}
    <section aria-label="{{ __('incidencias.panel.resumen') }}" class="mt-8">
        <ul class="grid gap-4 sm:grid-cols-3">
            @foreach ($resum as $i => $bloc)
                <li class="entra" style="--r: {{ 80 + $i * 70 }}ms">
                    <a href="{{ url('/profesors/incidencies') }}?estat={{ $bloc['clau'] }}"
                       class="group block h-full overflow-hidden rounded-targeta border border-linia bg-fons-2 transition duration-200 ease-suau hover:border-linia hover:bg-fons-3">
                        <span class="block h-[3px] w-full {{ $bloc['barra'] }} opacity-50 transition-opacity duration-200 group-hover:opacity-100"></span>

                        {{-- En movil el numero y el rotulo van en la misma linea, para que las
                             tres tarjetas no se coman la pantalla antes del listado. --}}
                        <span class="flex items-center justify-between gap-4 p-5 sm:items-end sm:p-6">
                            <span class="flex min-w-0 items-baseline gap-3 sm:block">
                                <span class="{{ $bloc['xifra'] }} block">{{ $bloc['total'] }}</span>
                                <span class="rotul block sm:mt-3">{{ $bloc['text'] }}</span>
                            </span>

                            <x-icona nom="endavant" class="h-5 w-5 shrink-0 text-tinta-3 transition-colors duration-200 group-hover:text-ambre" />
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </section>

    <div class="mt-10 grid gap-6 xl:grid-cols-12">
        <section aria-labelledby="ultimas" class="entra targeta p-6 sm:p-8 xl:col-span-7" style="--r: 300ms">
            <div class="flex flex-wrap items-baseline justify-between gap-3">
                <h2 id="ultimas" class="text-lg font-semibold tracking-tight text-tinta">{{ __('incidencias.panel.ultimas') }}</h2>

                <a href="{{ url('/profesors/incidencies') }}" class="inline-flex min-h-[44px] items-center gap-1 rounded-control text-sm font-medium text-ambre transition-colors duration-200 hover:text-ambre-clar">
                    {{ __('incidencias.panel.verlas_todas') }}
                    <x-icona nom="endavant" class="h-4 w-4" />
                </a>
            </div>

            @if ($ultimes->isEmpty())
                <div class="mt-6 flex flex-col items-center gap-3 rounded-targeta border border-dashed border-linia px-6 py-12 text-center">
                    <x-icona nom="buit" class="h-8 w-8 text-tinta-3" />
                    <p class="text-sm text-tinta-2">{{ __('incidencias.panel.sin_nada') }}</p>
                </div>
            @else
                <ul class="mt-4 divide-y divide-linia-suau">
                    @foreach ($ultimes as $inci)
                        <li>
                            <a href="{{ route('profesors/incidencies/detalles', $inci->id) }}"
                               class="-mx-3 flex min-h-[44px] items-center justify-between gap-4 rounded-control px-3 py-4 transition-colors duration-200 ease-suau hover:bg-fons-3">
                                <span class="min-w-0">
                                    <span class="block truncate text-sm font-medium text-tinta">{{ $inci->titol }}</span>
                                    <span class="mt-1 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-tinta-3">
                                        <span class="flex items-center gap-1.5">
                                            <x-icona nom="lloc" class="h-3.5 w-3.5" />
                                            {{ $inci->lloc }}
                                        </span>
                                        <span class="flex items-center gap-1.5 tabular-nums">
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

        <section id="alta" aria-labelledby="alta-titol" class="entra targeta p-6 sm:p-8 xl:col-span-5" style="--r: 360ms">
            <h2 id="alta-titol" class="text-lg font-semibold tracking-tight text-tinta">{{ __('incidencias.panel.alta_titulo') }}</h2>
            <p class="mt-2 max-w-lectura text-sm leading-relaxed text-tinta-2">
                {{ __('incidencias.panel.alta_texto') }}
            </p>

            <form method="POST" action="{{ route('profesors/incidencies/store') }}" class="mt-8">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @include('profesors.incidencies.frm.prt', ['incidencies' => null])
            </form>
        </section>
    </div>
</x-app-layout>
