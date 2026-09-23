<?php

// Vocabularios fijos de la aplicación.
//
// Las claves de 'categorias' y 'roles' son el valor tal como está guardado en la base
// de datos. Aquí solo se traduce la etiqueta que se enseña: lo que se guarda y lo que
// comparan los controladores no cambia. Si llega un valor que no está en la lista, la
// vista enseña el valor guardado sin tocarlo.
return [

    'estados' => [
        'pendent' => 'Pendiente',
        'curs' => 'En curso',
        'resolt' => 'Resuelto',
        'otro' => 'Sin estado',
    ],

    'estados_plural' => [
        'todas' => 'Todas',
        'pendent' => 'Pendientes',
        'curs' => 'En curso',
        'resolt' => 'Resueltas',
    ],

    'categorias' => [
        'Informatica' => 'Informática',
        'Electricitat' => 'Electricidad',
        'Mobiliari' => 'Mobiliario',
        'Climatitzacio' => 'Climatización',
    ],

    'sin_categoria' => 'Sin categoría',

    'roles' => [
        'profesor' => 'Profesorado',
        'reparador' => 'Reparador',
        'manteniment' => 'Mantenimiento',
    ],

];
