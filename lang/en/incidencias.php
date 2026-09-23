<?php

// Incident list, detail page and form, plus the home panel.
return [

    'titulo_listado' => 'Incidents',
    'titulo_nueva' => 'New incident',
    'titulo_editar' => 'Edit the incident',
    'titulo_ficha' => 'Incident',
    'titulo_inicio' => 'Home',

    'panel' => [
        'saludo' => 'Hello, :nombre',
        'todo' => 'How the school is doing',
        'propias' => 'Your incidents',
        'resumen' => 'Summary by status',
        'alta_titulo' => 'Report an incident',
        'alta_texto' => 'Say what is wrong and where. The repairer for that category will see it in their list.',
        'ultimas' => 'Latest incidents',
        'verlas_todas' => 'See them all',
        'sin_nada' => 'Incidents will show up here as soon as you report the first one.',
    ],

    'listado' => [
        'todas' => 'All incidents',
        'propias' => 'Your incidents',
        'recuento' => '{1} :total incident in the list.|[2,*] :total incidents in the list.',
        'nueva' => 'New incident',
        'filtrar' => 'Filter by status',
        'buscar_etiqueta' => 'Search the list',
        'buscar_pista' => 'Search by title, place or category',
        'resumen_tabla' => 'List of incidents with their status, place and category',
        'sin_resultados' => 'No incident matches what you are looking for.',
        'vacio_titulo' => 'No incidents yet',
        'vacio_texto' => 'Once you report the first one, it will show up here with its status.',
        'vacio_accion' => 'Report an incident',
    ],

    'tabla' => [
        'estado' => 'Status',
        'incidencia' => 'Incident',
        'sitio' => 'Place',
        'categoria' => 'Category',
        'dia_hora' => 'Date and time',
        'acciones' => 'Actions',
    ],

    'campos' => [
        'sitio' => 'Place',
        'categoria' => 'Category',
        'dia' => 'Date',
        'hora' => 'Time',
        'alta' => 'Reported by',
    ],

    'ficha' => [
        'volver' => 'Back to the list',
        'numero' => 'Incident number :id',
        'que_pasa' => 'What is wrong',
        'editar' => 'Edit the incident',
        'quien_arregla' => 'Who fixes it',
        'sin_reparador' => 'This category has no repairer assigned yet.',
        'telefono' => 'Phone',
        'correo' => 'Email',
        'enviar' => 'Send them the incident',
        'enviar_pista' => 'WhatsApp opens with the message already written.',
        'no_existe' => 'This incident no longer exists',
        'no_encontrada' => 'Incident not found',
        'no_encontrada_titulo' => 'We could not find this incident',
        'no_encontrada_texto' => 'Someone may have deleted it while you were looking at it.',
        'usuario' => 'User :id',
    ],

    'whatsapp' => [
        'sitio' => 'Place',
        'dia' => 'Date',
        'a_las' => 'at',
        'estado' => 'Status',
    ],

    'nueva' => [
        'entrada' => 'Say what is wrong and where. Maintenance takes care of the rest.',
    ],

    'formulario' => [
        'titulo' => 'What is wrong',
        'titulo_pista' => 'The classroom projector gets no signal',
        'descripcion' => 'Tell us the details',
        'descripcion_pista' => 'What you have tried, how long it has been happening, whether it affects other places',
        'sitio' => 'Where it is',
        'sitio_pista' => 'Room A12',
        'categoria' => 'Category',
        'categoria_vacia' => 'Pick a category',
        'categoria_pista' => 'Every category has its own repairer.',
        'dia' => 'Date',
        'hora' => 'Time',
        'estado' => 'Status',
        'a_nombre_de' => 'Reported by :nombre',
        'usuario' => 'user :id',
        'enviar' => 'Report the incident',
    ],

    'eliminar' => [
        'titulo' => 'Delete the incident?',
        'texto' => 'You are about to delete',
        'aviso' => 'This cannot be undone.',
        'abrir' => 'Delete :titulo',
        'ver' => 'View the details of :titulo',
        'editar' => 'Edit :titulo',
        'ver_corto' => 'View the details',
    ],

];
