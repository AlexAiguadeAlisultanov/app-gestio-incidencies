<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    @dump(session('rol_usuari'))
    @if(session('rol_usuari') == 'manteniment')
    {{-- Mostrar menú para profesor --}}
    <div class="container mt-4">
        <div class="card">
        <!-- <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ __("You're logged in!") }}
                            <a href="https://wa.me/+34695449935?text=hola" target="_blank">Share via WhatsApp</a>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="card-body">
                <h2>Bienvenido, usuario Mantenimiento</h2>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="profesors/incidencies">Incidencias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profesors/reparadors">Reparaciones</a>
                    </li>
                    <!-- Agrega más elementos del menú según sea necesario -->
                </ul>
            </div>
        </div>

        {{-- Mostrar formulario con título grande --}}
        <div class="card mt-4">
            <div class="card-body">
                <h1 class="card-title">Insertar una Incidencia</h1>
                <form method="POST" action="{{ route('profesors/incidencies/store') }}" role="form" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('profesors.incidencies.frm.prt')
                </form>
            </div>
        </div>
    </div>

    @else
    {{-- Mostrar formulario de creación para otros roles --}}
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h2>Bienvenido, Professor</h2>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="profesors/incidencies">Incidencias</a>
                    </li>
                    <!-- Agrega más elementos del menú según sea necesario -->
                </ul>
            </div>
        </div>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h1 class="mt-4">Insertar una Incidencia</h1>
                <form method="POST" action="{{ route('profesors/incidencies/store') }}" role="form" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @include('profesors.incidencies.frm.prt')
                </form>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
    