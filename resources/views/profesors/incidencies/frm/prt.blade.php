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
    <title>Título de tu página</title>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container">
                    <div class="titulo">Actualizar Incidencies</div>
                    <section class="panel border border-dark">
                        <div class="panel-body">
                            @if (!empty($incidencies->id))

                            <div class="mb3">
                                <label for="nombre" class="negrita">Nombre:</label>
                                <div>
                                    <input class="form-control" placeholder="Introduce el nombre del producto" required="required" name="nombre" type="text" id="nombre" value="{{ $incidencies->nombre }}">
                                </div>
                            </div>

                            <div class="mb3">
                                <label for="descripcion" class="negrita">Descripcion:</label>
                                <div>
                                    <input class="form-control" placeholder="Introduce la descripcion" required="required" name="nombre" type="text" id="nombre" value="{{ $incidencies->descripcion }}">
                                </div>
                            </div>

                            <div class="mb3">
                                <label for="precio" class="negrita">Precio:</label>
                                <div>
                                    <input class="form-control" placeholder="Introduce el precio" required="required" name="precio" type="text" id="precio" value="{{ $incidencies->precio }}">
                                </div>
                            </div>

                            <div class="mb3">
                                <label for="stock" class="negrita">Stock:</label>
                                <div>
                                    <input class="form-control" placeholder="Introduce el stock" required="required" name="stock" type="text" id="stock" value="{{ $incidencies->stock }}">
                                </div>
                            </div>

                            <div class="mb3">
                                <label for="img" class="negrita">Selecciona una imagen:</label>
                                <div>
                                    <input name="imagen" type="file" id="img">
                                    <br>
                                    <br>
                                    @if (!empty($incidencies->imagen))

                                    <span>Imagen Actual: </span>
                                    <br>
                                    <img src="../../../uploads/{{ $incidencies->imagen }}" width="200" class="img-fluid">

                                    @else

                                    <!-- Aún no se ha cargado una imagen para este producto -->

                                    @endif
                                </div>
                            </div>

                            @else

                            <!--  Acá el formulario en Limpio para crear un nuevo registro -->

                            <div class="mb-3">
                                <label for="nombre" class="negrita">Nombre:</label>
                                <div>
                                    <input class="form-control" placeholder="Zapatos Marrones de Cuero" required="required" name="nombre" type="text" id="nombre">
                                </div>
                            </div>

                            <div class="mb3">
                                <label for="descripcion" class="negrita">Descripcion:</label>
                                <div>
                                    <input class="form-control" placeholder="Introduce la descripcion" required="required" name="descripcion" type="text" id="descripcion">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="precio" class="negrita">Precio:</label>
                                <div>
                                    <input class="form-control" placeholder="4.50" required="required" name="precio" type="text" id="precio">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="stock" class="negrita">Stock:</label>
                                <div>
                                    <input class="form-control" placeholder="40" required="required" name="stock" type="text" id="stock">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="img" class="negrita">Selecciona una imagen:</label>
                                <div>
                                    <input name="imagen" type="file" id="img">
                                </div>
                            </div>

                            @endif

                            <button type="submit" class="btn btn-info">Guardar</button>
                            <a href="{{ route('profesors/incidencies') }}" class="btn btn-warning">Cancelar</a>

                            <br>
                            <br>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-eAEXL6b5qvyJcYUAfx12+COZlJSX3e6l5Ie6L4q6LdTN3kK1C3R8jDXsX5Y3WfKn" crossorigin="anonymous"></script>
</body>

</html>