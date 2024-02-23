<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="apple-touch-startup-image" href="https://www.wepora.com/asset/img/wepora-logo.png">
    <link rel="icon" type="image/x-icon" href="https://www.wepora.com/asset/img/wepora-logo.png">
    <meta name="description" content="Wepora is a best Graphics, software and Web Development company and provides all IT solutions to their client. In India.." />
    <meta name="Keywords" content="website design | website development | website logo  |  website hosting  | logo design| logo design ideas  | SEO | android |  best software company in India | cheapest | graphic design | Shrikant Kushwaha">
    <meta name="author" content="contain by Wepora team">
    <meta name="copyright" content="Copyright © 2020 Wepora" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-LD65H6P9IkOz5jqm4KPHv9JwR+pL/LThbYL7nE/T3sIpxcAzz5W3wAPMhiZ9j1Wz" crossorigin="anonymous"></script>
    <title>Reparadors</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <section class="panel">
                        @if (!empty($reparadors->id))

                        <div class="mb-3">
                            <label for="nombre" class="negrita">Nombre:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el nombre del producto" required="required" name="nombre" type="text" id="nombre">
                            </div>
                        </div>

                        <div class="mb3">
                            <label for="apellidos" class="negrita">Apellidos:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce los apellidos" required="required" name="apellidos" type="text" id="apellidos">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="email" class="negrita">Email:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el email" required="required" name="email" type="text" id="email" value="{{ $reparadors->email ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="telefono" class="negrita">Telefono:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el telefono" required="required" name="telefono" type="text" id="telefono" value="{{ $reparadors->telefono ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="direccion" class="negrita">Direccion:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce la direccion" required="required" name="direccion" type="text" id="direccion" value="{{ $reparadors-> direccion ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="ciudad" class="negrita">Ciudad:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce la ciudad" required="required" name="ciudad" type="text" id="ciudad" value="{{ $reparadors->ciudad ?? '' }}">
                            </div>
                        </div>
                        <br>

                        @endif

                        @if(session('rol_usuari') == 'profesor')
                        <br>
                        <button type="submit" class="btn btn-info">Guardar</button>
                        <a href="{{ route('profesors/reparadors') }}" class="btn btn-warning">Cancelar</a>
                        @else
                        <button type="submit" class="btn btn-info">Guardar</button>
                        @endif
                        <br>
                        <br>
                    </section>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-eAEXL6b5qvyJcYUAfx12+COZlJSX3e6l5Ie6L4q6LdTN3kK1C3R8jDXsX5Y3WfKn" crossorigin="anonymous"></script>
</body>

</html>