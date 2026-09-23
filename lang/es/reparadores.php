<?php

// Listado, ficha y formulario de reparadores.
return [

    'titulo_listado' => 'Reparadores',
    'titulo_nuevo' => 'Nuevo reparador',
    'titulo_editar' => 'Editar al reparador',
    'titulo_ficha' => 'Reparador',

    'listado' => [
        'entrada' => 'Quién atiende cada categoría de incidencias.',
        'nuevo' => 'Nuevo reparador',
        'resumen_tabla' => 'Listado de reparadores con su contacto y las categorías que atienden',
        'vacio_titulo' => 'Todavía no hay reparadores',
        'vacio_texto' => 'Da de alta a quien se encarga de informática, electricidad, mobiliario o climatización.',
        'vacio_accion' => 'Dar de alta al primero',
    ],

    'tabla' => [
        'reparador' => 'Reparador',
        'categorias' => 'Categorías',
        'contacto' => 'Contacto',
        'ciudad' => 'Ciudad',
        'acciones' => 'Acciones',
        'sin_categoria' => 'Sin categoría asignada',
    ],

    'campos' => [
        'nombre' => 'Nombre',
        'apellidos' => 'Apellidos',
        'correo' => 'Correo',
        'telefono' => 'Teléfono',
        'direccion' => 'Dirección',
        'ciudad' => 'Ciudad',
        'donde' => 'Dónde está',
    ],

    'ficha' => [
        'volver' => 'Volver a reparadores',
        'contacto' => 'Contacto',
        'de_que' => 'De qué se encarga',
        'sin_categoria' => 'Todavía no tiene ninguna categoría asignada.',
        'editar' => 'Editar los datos',
        'no_existe' => 'Este reparador ya no existe',
        'no_encontrado' => 'Reparador no encontrado',
        'no_encontrado_titulo' => 'No hemos encontrado a este reparador',
    ],

    'nuevo' => [
        'entrada' => 'Los datos de contacto de quien viene a arreglar las cosas.',
    ],

    'formulario' => [
        'correo_pista' => 'nombre@empresa.cat',
        'telefono_pista' => '600 000 000',
        'telefono_nota' => 'Con este número se le envían las incidencias por WhatsApp.',
        'enviar' => 'Dar de alta al reparador',
    ],

    'eliminar' => [
        'titulo' => '¿Eliminar al reparador?',
        'texto' => 'Vas a eliminar a',
        'aviso' => 'Las incidencias de sus categorías se quedarán sin contacto.',
        'abrir' => 'Eliminar a :nombre',
        'ver' => 'Ver la ficha de :nombre',
        'editar' => 'Editar a :nombre',
        'ver_corto' => 'Ver la ficha',
    ],

];
