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
                    <section class="panel">
                        @if (!empty($incidencies->id))

                        <div class="mb-3">
                            <label for="nombre" class="negrita">Nombre:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el nombre del producto" required="required" name="nombre" type="text" id="nombre">
                            </div>
                        </div>

                        <div class="mb3">
                            <label for="descripcion" class="negrita">Descripcion:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce la descripcion" required="required" name="descripcion" type="text" id="descripcion">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="data" class="negrita">Data:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce la data" required="required" name="data" type="text" id="data" value="{{ $incidencies->data ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="hora" class="negrita">Hora:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce la hora" required="required" name="hora" type="text" id="hora" value="{{ $incidencies->hora ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="estat" class="negrita">Estat:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el estat" required="required" name="estat" type="text" id="estat" value="{{ $incidencies->estat ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="lloc" class="negrita">Lloc:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el lloc" required="required" name="lloc" type="text" id="lloc" value="{{ $incidencies->lloc ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="user_id" class="negrita">User_ID:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el User_ID" required="required" name="user_id" type="text" id="user_id" value="{{ $incidencies->user_id ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="categoria_id" class="negrita">Categoria_ID:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el Categoria_ID" required="required" name="categoria_id" type="text" id="categoria_id" value="{{ $incidencies->categoria_id ?? '' }}">
                            </div>
                        </div>

                        @else
                        <div class="mb-3">
                            <label for="nombre" class="negrita">Nombre:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el nombre del producto" required="required" name="nombre" type="text" id="nombre">
                            </div>
                        </div>
                        <div class="mb3">
                            <label for="descripcion" class="negrita">Descripcion:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce la descripcion" required="required" name="descripcion" type="text" id="descripcion">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="data" class="negrita">Data:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce la data" required="required" name="data" type="date" id="data" value="{{ $incidencies->data ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="hora" class="negrita">Hora:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce la hora" required="required" name="hora" type="date" id="hora" value="{{ $incidencies->hora ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="estat" class="negrita">Estat:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el estat" required="required" name="estat" type="text" id="estat" value="{{ $incidencies->estat ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="lloc" class="negrita">Lloc:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el lloc" required="required" name="lloc" type="text" id="lloc" value="{{ $incidencies->lloc ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="user_id" class="negrita">User_ID:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el User_ID" required="required" name="user_id" type="text" id="user_id" value="{{ $incidencies->user_id ?? '' }}">
                            </div>
                        </div>
                        <br>
                        <div class="mb3">
                            <label for="categoria_id" class="negrita">Categoria_ID:</label>
                            <div>
                                <input class="form-control" placeholder="Introduce el Categoria_ID" required="required" name="categoria_id" type="text" id="categoria_id" value="{{ $incidencies->categoria_id ?? '' }}">
                            </div>
                        </div>

                        @endif

                        @if(session('rol_usuari') == 'profesor')
                        <br>
                        <button type="submit" class="btn btn-info">Guardar</button>
                        <a href="{{ route('profesors/incidencies') }}" class="btn btn-warning">Cancelar</a>
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