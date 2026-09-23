<?php

// Llistat, fitxa i formulari de reparadors.
return [

    'titulo_listado' => 'Reparadors',
    'titulo_nuevo' => 'Nou reparador',
    'titulo_editar' => 'Editar el reparador',
    'titulo_ficha' => 'Reparador',

    'listado' => [
        'entrada' => "Qui atén cada categoria d'incidències.",
        'nuevo' => 'Nou reparador',
        'resumen_tabla' => 'Llistat de reparadors amb el seu contacte i les categories que atenen',
        'vacio_titulo' => 'Encara no hi ha reparadors',
        'vacio_texto' => "Dona d'alta qui s'encarrega d'informàtica, electricitat, mobiliari o climatització.",
        'vacio_accion' => "Donar d'alta el primer",
    ],

    'tabla' => [
        'reparador' => 'Reparador',
        'categorias' => 'Categories',
        'contacto' => 'Contacte',
        'ciudad' => 'Ciutat',
        'acciones' => 'Accions',
        'sin_categoria' => 'Sense categoria assignada',
    ],

    'campos' => [
        'nombre' => 'Nom',
        'apellidos' => 'Cognoms',
        'correo' => 'Correu',
        'telefono' => 'Telèfon',
        'direccion' => 'Adreça',
        'ciudad' => 'Ciutat',
        'donde' => 'On és',
    ],

    'ficha' => [
        'volver' => 'Tornar a reparadors',
        'contacto' => 'Contacte',
        'de_que' => "De què s'encarrega",
        'sin_categoria' => 'Encara no té cap categoria assignada.',
        'editar' => 'Editar les dades',
        'no_existe' => 'Aquest reparador ja no existeix',
        'no_encontrado' => 'Reparador no trobat',
        'no_encontrado_titulo' => 'No hem trobat aquest reparador',
    ],

    'nuevo' => [
        'entrada' => 'Les dades de contacte de qui ve a arreglar les coses.',
    ],

    'formulario' => [
        'correo_pista' => 'nom@empresa.cat',
        'telefono_pista' => '600 000 000',
        'telefono_nota' => "Amb aquest número se li envien les incidències per WhatsApp.",
        'enviar' => "Donar d'alta el reparador",
    ],

    'eliminar' => [
        'titulo' => 'Vols eliminar el reparador?',
        'texto' => "Estàs a punt d'eliminar",
        'aviso' => 'Les incidències de les seves categories es quedaran sense contacte.',
        'abrir' => 'Eliminar :nombre',
        'ver' => 'Veure la fitxa de :nombre',
        'editar' => 'Editar :nombre',
        'ver_corto' => 'Veure la fitxa',
    ],

];
