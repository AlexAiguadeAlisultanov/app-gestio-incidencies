<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    <a href="https://wa.me/+34695449935?text=hola" target="_blank">Share via WhatsApp</a>
                </div>
            </div>
        </div>
    </div>

    @if(session('rol_usuari') == 'profesor')
    {{-- Mostrar menú para profesor --}}
    <div class="container mt-4">
        <h2>Bienvenido, Profesor</h2>
        <ul class="list-group">
            <li class="list-group-item"><a href="#" class="text-decoration-none">Incidencias</a></li>
            <li class="list-group-item"><a href="#" class="text-decoration-none">Reparaciones</a></li>
            <!-- Agrega más elementos del menú según sea necesario -->
        </ul>
    </div>
    @else
    {{-- Mostrar formulario de creación para otros roles --}}
    <h2>ets un usuari normal puto tonto espabila</h2>
    @endif

</x-app-layout>