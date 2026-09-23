<?php

// Fixed vocabularies of the application.
//
// The keys of 'categorias' and 'roles' are the value exactly as stored in the
// database. Only the label shown on screen is translated here: what gets saved, and
// what the controllers compare against, stays the same.
return [

    'estados' => [
        'pendent' => 'Pending',
        'curs' => 'In progress',
        'resolt' => 'Resolved',
        'otro' => 'No status',
    ],

    'estados_plural' => [
        'todas' => 'All',
        'pendent' => 'Pending',
        'curs' => 'In progress',
        'resolt' => 'Resolved',
    ],

    'categorias' => [
        'Informatica' => 'IT',
        'Electricitat' => 'Electrics',
        'Mobiliari' => 'Furniture',
        'Climatitzacio' => 'Heating and cooling',
    ],

    'sin_categoria' => 'No category',

    'roles' => [
        'profesor' => 'Teaching staff',
        'reparador' => 'Repairer',
        'manteniment' => 'Maintenance',
    ],

];
