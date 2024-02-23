<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    @if(session('rol_usuari') == 'manteniment')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Listado de Productos</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <title>QR Code Generator / Decoder</title>

        <link href="../static/img/favicon.png" th:href="@{/img/favicon.png}" rel="shortcut icon" />

    </head>

    <body>

        <div class="container mt-5">
            <h1>Listado de Reparadores</h1>
            <table class="table table-striped table-bordered table-hover mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Direccion</th>
                        <th>Ciudad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reparadors as $reparador)
                    <tr>
                        <td class="v-align-middle">{{$reparador->id}}</td>
                        <td class="v-align-middle">{{$reparador->nombre}}</td>
                        <td class="v-align-middle">{{$reparador->apellidos}}</td>
                        <td class="v-align-middle">{{$reparador->email}}</td>
                        <td class="v-align-middle">{{$reparador->telefono}}</td>
                        <td class="v-align-middle">{{$reparador->direccion}}</td>
                        <td class="v-align-middle">{{$reparador->ciudad}}</td>
                        <td class="v-align-middle">
                            <form action="{{ route('profesors/reparadors/eliminar',$reparador->id) }}" method="POST" class="form-horizontal" role="form" onsubmit="return confirmarEliminar()">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a href="{{ route('profesors/reparadors/detalles',$reparador->id) }}" class="btn btn-dark">Detalles</a>
                                <a href="{{ route('profesors/reparadors/actualitzar',$reparador->id) }}" class="btn btn-primary">Editar</a>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- <a href="https://wa.me/+34695449935?text=hola" target="_blank">Share via WhatsApp</a> -->
            <a href="/dashboard" class="btn btn-dark">Insertar</a>
        </div>

        <!-- Función JavaScript para confirmar la eliminación -->
        <script>
            function confirmarEliminar() {
                return confirm("¿Estás seguro de que deseas eliminar este reparador?");
            }
        </script>

    </body>

    </html>

    @else
    
    @endif
</x-app-layout>