<x-guest-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('acceso.verificar.titulo_pagina')]) }}</x-slot>

    <header class="mb-8">
        <h1 class="text-xl font-semibold tracking-tight text-tinta">{{ __('acceso.verificar.titulo') }}</h1>
        <p class="mt-2 text-sm leading-relaxed text-tinta-2">
            {{ __('acceso.verificar.entrada') }}
        </p>
    </header>

    @if (session('status') == 'verification-link-sent')
        <div role="status" class="mb-6 rounded-control border border-estat-resolt/30 bg-estat-resolt-fons px-4 py-3 text-sm font-medium text-estat-resolt">
            {{ __('acceso.verificar.enviado') }}
        </div>
    @endif

    <div class="flex flex-wrap items-center gap-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>{{ __('acceso.verificar.reenviar') }}</x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="boto-discret">{{ __('acceso.verificar.salir') }}</button>
        </form>
    </div>
</x-guest-layout>
