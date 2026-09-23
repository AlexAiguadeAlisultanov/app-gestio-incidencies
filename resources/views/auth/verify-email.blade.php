<x-guest-layout>
    <x-slot name="titol">{{ __('app.titulo', ['pagina' => __('acceso.verificar.titulo_pagina')]) }}</x-slot>

    <header class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight text-tinta-900 dark:text-tinta-50">{{ __('acceso.verificar.titulo') }}</h1>
        <p class="mt-2 text-sm leading-relaxed text-tinta-600 dark:text-tinta-400">
            {{ __('acceso.verificar.entrada') }}
        </p>
    </header>

    @if (session('status') == 'verification-link-sent')
        <div role="status" class="mb-6 rounded-control bg-estat-resolt-fons px-4 py-3 text-sm font-medium text-estat-resolt dark:bg-estat-resolt/20 dark:text-estat-resolt-clar">
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
