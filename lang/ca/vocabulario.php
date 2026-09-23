<?php

// Vocabularis fixos de l'aplicació.
//
// Les claus de 'categorias' i 'roles' són el valor tal com està desat a la base de
// dades. Aquí només es tradueix l'etiqueta que es mostra: el que es desa i el que
// comparen els controladors no canvia.
return [

    'estados' => [
        'pendent' => 'Pendent',
        'curs' => 'En curs',
        'resolt' => 'Resolt',
        'otro' => 'Sense estat',
    ],

    'estados_plural' => [
        'todas' => 'Totes',
        'pendent' => 'Pendents',
        'curs' => 'En curs',
        'resolt' => 'Resoltes',
    ],

    'categorias' => [
        'Informatica' => 'Informàtica',
        'Electricitat' => 'Electricitat',
        'Mobiliari' => 'Mobiliari',
        'Climatitzacio' => 'Climatització',
    ],

    'sin_categoria' => 'Sense categoria',

    'roles' => [
        'profesor' => 'Professorat',
        'reparador' => 'Reparador',
        'manteniment' => 'Manteniment',
    ],

];
