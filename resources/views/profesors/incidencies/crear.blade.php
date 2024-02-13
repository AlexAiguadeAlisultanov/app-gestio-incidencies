<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Nube Colectiva">
    <link rel="shortcut icon" href="http://nubecolectiva.com/favicon.ico" />

    <meta name="theme-color" content="#000000" />

    <title>Como crear un CRUD con Laravel 10 y Bootstrap 5 </title>

    <!-- Bootstrap -->
    @vite(['resources/js/app.js'])

</head>
<form method="POST" action="{{ route('admin/productos/store') }}" role="form" enctype="multipart/form-data">

    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    @include('admin.productos.frm.prt')

</form>

</body>

</html>