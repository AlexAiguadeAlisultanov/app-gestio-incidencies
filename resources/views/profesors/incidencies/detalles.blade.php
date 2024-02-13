<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Detalles del Producto</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="panel-body text-center">

                    @if(Session::has('message'))
                    <div class="alert alert-primary" role="alert">
                        {{ Session::get('message') }}
                    </div>
                    @endif

                    <div class="mb-3">
                        <p class="h5 fw-bold">Titol:</p>
                        <p class="h6 mb-3">{{ $incidencies->titol }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="h5 fw-bold">Descripcion:</p>
                        <p class="h6 mb-3">{{ $incidencies->descripcio }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="h5 fw-bold">Data:</p>
                        <p class="h6 mb-3">{{ $incidencies->data }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="h5 fw-bold">Hora:</p>
                        <p class="h6 mb-3">{{ $incidencies->hora }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="h5 fw-bold">Estat:</p>
                        <p class="h6 mb-3">{{ $incidencies->estat }}</p>
                    </div>

                    <div class="mb-3">
                        <p class="h5 fw-bold">Lloc:</p>
                        <p class="h6 mb-3">{{ $incidencies->lloc }}</p>
                    </div>
                </div>
                <a href="https://wa.me/+34695449935?text=Título: {{ $incidencies->titol }}%0ADescripción: {{ $incidencies->descripcio }}%0AFecha: {{ $incidencies->data }}%0AHora: {{ $incidencies->hora }}%0AEstado: {{ $incidencies->estat }}%0ALugar: {{ $incidencies->lloc }}" target="_blank">Compartir via WhatsApp</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-eAEXL6b5qvyJcYUAfx12+COZlJSX3e6l5Ie6L4q6LdTN3kK1C3R8jDXsX5Y3WfKn" crossorigin="anonymous"></script>
</body>

</html>
