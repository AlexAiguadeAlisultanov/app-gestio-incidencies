<?php

// Listado, ficha y formulario de incidencias, más el panel de inicio.
return [

    'titulo_listado' => 'Incidencias',
    'titulo_nueva' => 'Nueva incidencia',
    'titulo_editar' => 'Editar la incidencia',
    'titulo_ficha' => 'Incidencia',
    'titulo_inicio' => 'Inicio',

    'panel' => [
        'saludo' => 'Hola, :nombre',
        'todo' => 'Estado del centro',
        'propias' => 'Tus incidencias',
        'resumen' => 'Resumen por estado',
        'alta_titulo' => 'Dar de alta una incidencia',
        'alta_texto' => 'Di qué pasa y dónde. El reparador de esa categoría la verá en su listado.',
        'ultimas' => 'Últimas incidencias',
        'verlas_todas' => 'Verlas todas',
        'sin_nada' => 'Aquí aparecerán las incidencias en cuanto des de alta la primera.',
    ],

    'listado' => [
        'todas' => 'Todas las incidencias',
        'propias' => 'Tus incidencias',
        'recuento' => '{1} :total incidencia en el listado.|[2,*] :total incidencias en el listado.',
        'nueva' => 'Nueva incidencia',
        'filtrar' => 'Filtrar por estado',
        'buscar_etiqueta' => 'Buscar en el listado',
        'buscar_pista' => 'Buscar por título, sitio o categoría',
        'resumen_tabla' => 'Listado de incidencias con su estado, sitio y categoría',
        'sin_resultados' => 'Ninguna incidencia coincide con lo que buscas.',
        'vacio_titulo' => 'Todavía no hay incidencias',
        'vacio_texto' => 'Cuando des de alta la primera, aparecerá aquí con su estado.',
        'vacio_accion' => 'Dar de alta una incidencia',
    ],

    'tabla' => [
        'estado' => 'Estado',
        'incidencia' => 'Incidencia',
        'sitio' => 'Sitio',
        'categoria' => 'Categoría',
        'dia_hora' => 'Día y hora',
        'acciones' => 'Acciones',
    ],

    'campos' => [
        'sitio' => 'Sitio',
        'categoria' => 'Categoría',
        'dia' => 'Día',
        'hora' => 'Hora',
        'alta' => 'La dio de alta',
    ],

    'ficha' => [
        'volver' => 'Volver al listado',
        'numero' => 'Incidencia número :id',
        'que_pasa' => 'Qué pasa',
        'editar' => 'Editar la incidencia',
        'quien_arregla' => 'Quién lo arregla',
        'sin_reparador' => 'Esta categoría todavía no tiene reparador asignado.',
        'telefono' => 'Teléfono',
        'correo' => 'Correo',
        'enviar' => 'Enviarle la incidencia',
        'enviar_pista' => 'Se abre WhatsApp con el mensaje escrito.',
        'no_existe' => 'Esta incidencia ya no existe',
        'no_encontrada' => 'Incidencia no encontrada',
        'no_encontrada_titulo' => 'No hemos encontrado esta incidencia',
        'no_encontrada_texto' => 'Puede que alguien la haya eliminado mientras la mirabas.',
        'usuario' => 'Usuario :id',
    ],

    'whatsapp' => [
        'sitio' => 'Sitio',
        'dia' => 'Día',
        'a_las' => 'a las',
        'estado' => 'Estado',
    ],

    'nueva' => [
        'entrada' => 'Di qué pasa y dónde. Del resto se encarga mantenimiento.',
    ],

    'formulario' => [
        'titulo' => 'Qué pasa',
        'titulo_pista' => 'El proyector del aula no da señal',
        'descripcion' => 'Cuéntalo con detalle',
        'descripcion_pista' => 'Lo que has probado, desde cuándo pasa, si afecta a más sitios',
        'sitio' => 'Dónde está',
        'sitio_pista' => 'Aula A12',
        'categoria' => 'Categoría',
        'categoria_vacia' => 'Elige una categoría',
        'categoria_pista' => 'Cada categoría tiene su reparador asignado.',
        'dia' => 'Día',
        'hora' => 'Hora',
        'estado' => 'Estado',
        'a_nombre_de' => 'A nombre de :nombre',
        'usuario' => 'usuario :id',
        'enviar' => 'Dar de alta la incidencia',
    ],

    'eliminar' => [
        'titulo' => '¿Eliminar la incidencia?',
        'texto' => 'Vas a eliminar',
        'aviso' => 'No se puede deshacer.',
        'abrir' => 'Eliminar :titulo',
        'ver' => 'Ver la ficha de :titulo',
        'editar' => 'Editar :titulo',
        'ver_corto' => 'Ver la ficha',
    ],

];
