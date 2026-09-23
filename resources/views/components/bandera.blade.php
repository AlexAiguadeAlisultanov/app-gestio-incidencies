@props(['codi'])

@php
    // Banderas dibujadas aquí mismo, no emojis: Windows no dibuja los emojis de bandera
    // (la de España sale como las letras ES) y la senyera ni siquiera existe como emoji.
    //
    // Todas se dibujan en una caja de 30 x 20 para que las tres ocupen lo mismo en línea.
    // La del Reino Unido necesita un recorte para que las aspas rojas queden alternadas,
    // y el identificador de ese recorte tiene que ser único: el selector puede salir más
    // de una vez en la misma página.
    $recorte = 'bandera-gb-'.\Illuminate\Support\Str::random(8);
@endphp

{{-- La caja es 24 x 16, la misma proporción 3:2 del dibujo, para que no queden bordes de aire --}}
<svg {{ $attributes->merge(['class' => 'h-4 w-6']) }}
     viewBox="0 0 30 20" xmlns="http://www.w3.org/2000/svg"
     aria-hidden="true" focusable="false" preserveAspectRatio="xMidYMid meet">

    @if ($codi === 'es')
        {{-- España: roja, amarilla doble y roja. Sin escudo. --}}
        <rect width="30" height="20" fill="#AA151B"/>
        <rect y="5" width="30" height="10" fill="#F1BF00"/>

    @elseif ($codi === 'ca')
        {{-- Senyera: cuatro barras rojas sobre fondo amarillo, nueve franjas iguales. --}}
        <rect width="30" height="20" fill="#FCDD09"/>
        <rect y="2.222" width="30" height="2.222" fill="#DA121A"/>
        <rect y="6.667" width="30" height="2.222" fill="#DA121A"/>
        <rect y="11.111" width="30" height="2.222" fill="#DA121A"/>
        <rect y="15.556" width="30" height="2.222" fill="#DA121A"/>

    @else
        {{-- Reino Unido: la cruz de San Jorge sobre las aspas de San Andrés y San Patricio. --}}
        <clipPath id="{{ $recorte }}">
            <path d="M15,10 h15 v10 z v10 h-15 z h-15 v-10 z v-10 h15 z"/>
        </clipPath>
        <rect width="30" height="20" fill="#012169"/>
        <path d="M0,0 L30,20 M30,0 L0,20" stroke="#FFFFFF" stroke-width="4"/>
        <path d="M0,0 L30,20 M30,0 L0,20" stroke="#C8102E" stroke-width="2.667" clip-path="url(#{{ $recorte }})"/>
        <path d="M15,0 V20 M0,10 H30" stroke="#FFFFFF" stroke-width="6.667"/>
        <path d="M15,0 V20 M0,10 H30" stroke="#C8102E" stroke-width="4"/>
    @endif
</svg>
