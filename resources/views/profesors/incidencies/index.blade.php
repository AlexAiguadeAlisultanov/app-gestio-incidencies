<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <div class="container mt-5">
        @if(session('rol_usuari') == 'manteniment')
        <h1>Listado de Incidencias</h1>
        <table class="table table-striped table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estat</th>
                    <th>Lloc</th>
                    <th>User_ID</th>
                    <th>Categoria_ID</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incidencies as $inci)
                <tr>
                    <td class="v-align-middle">{{$inci->id}}</td>
                    <td class="v-align-middle">{{$inci->titol}}</td>
                    <td class="v-align-middle">{{$inci->descripcio}}</td>
                    <td class="v-align-middle">{{$inci->data}}</td>
                    <td class="v-align-middle">{{$inci->hora}}</td>
                    <td class="v-align-middle">{{$inci->estat}}</td>
                    <td class="v-align-middle">{{$inci->lloc}}</td>
                    <td class="v-align-middle">{{$inci->user_id}}</td>
                    <td class="v-align-middle">{{$inci->categories_id}}</td>
                    <td class="v-align-middle">
                        <a href="{{ route('profesors/incidencies/detalles',$inci->id) }}" class="btn btn-dark">Detalles</a>
                        <a href="{{ route('profesors/incidencies/actualitzar',$inci->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('profesors/incidencies/eliminar',$inci->id) }}" method="POST" class="form-horizontal" role="form" onsubmit="return confirmarEliminar()">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <script>
                    function confirmarEliminar() {
                        return confirm("¿Estás seguro de que deseas eliminar esta incidencia?");
                    }
                </script>
                @endforeach
            </tbody>
        </table>
        <a href="/dashboard" class="btn btn-dark">Insertar</a>
        @else
        <h1>Tus Incidencias</h1>
        <table class="table table-striped table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estat</th>
                    <th>Lloc</th>
                    <th>User_ID</th>
                    <th>Categoria_ID</th>
                </tr>
            </thead>
            <tbody>
                @forelse($incidencies as $inci)
                <tr>
                    <td class="v-align-middle">{{$inci->id}}</td>
                    <td class="v-align-middle">{{$inci->titol}}</td>
                    <td class="v-align-middle">{{$inci->descripcio}}</td>
                    <td class="v-align-middle">{{$inci->data}}</td>
                    <td class="v-align-middle">{{$inci->hora}}</td>
                    <td class="v-align-middle">{{$inci->estat}}</td>
                    <td class="v-align-middle">{{$inci->lloc}}</td>
                    <td class="v-align-middle">{{$inci->user_id}}</td>
                    <td class="v-align-middle">{{$inci->categories_id}}</td>
                    <td class="v-align-middle">
                        <!-- Acciones específicas para el usuario -->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10">No tienes incidencias registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <a href="/dashboard" class="btn btn-dark">Insertar</a>
        @endif

        <!-- Función JavaScript para confirmar la eliminación -->
    </div>
</x-app-layout>