<?php

// Repairer list, detail page and form.
return [

    'titulo_listado' => 'Repairers',
    'titulo_nuevo' => 'New repairer',
    'titulo_editar' => 'Edit the repairer',
    'titulo_ficha' => 'Repairer',

    'listado' => [
        'entrada' => 'Who handles each category of incidents.',
        'nuevo' => 'New repairer',
        'resumen_tabla' => 'List of repairers with their contact details and the categories they handle',
        'vacio_titulo' => 'No repairers yet',
        'vacio_texto' => 'Add whoever takes care of IT, electrics, furniture or heating and cooling.',
        'vacio_accion' => 'Add the first one',
    ],

    'tabla' => [
        'reparador' => 'Repairer',
        'categorias' => 'Categories',
        'contacto' => 'Contact',
        'ciudad' => 'City',
        'acciones' => 'Actions',
        'sin_categoria' => 'No category assigned',
    ],

    'campos' => [
        'nombre' => 'First name',
        'apellidos' => 'Surname',
        'correo' => 'Email',
        'telefono' => 'Phone',
        'direccion' => 'Address',
        'ciudad' => 'City',
        'donde' => 'Where they are',
    ],

    'ficha' => [
        'volver' => 'Back to repairers',
        'contacto' => 'Contact',
        'de_que' => 'What they handle',
        'sin_categoria' => 'No category assigned yet.',
        'editar' => 'Edit the details',
        'no_existe' => 'This repairer no longer exists',
        'no_encontrado' => 'Repairer not found',
        'no_encontrado_titulo' => 'We could not find this repairer',
    ],

    'nuevo' => [
        'entrada' => 'Contact details for whoever comes to fix things.',
    ],

    'formulario' => [
        'correo_pista' => 'name@company.cat',
        'telefono_pista' => '600 000 000',
        'telefono_nota' => 'Incidents are sent to this number over WhatsApp.',
        'enviar' => 'Add the repairer',
    ],

    'eliminar' => [
        'titulo' => 'Delete the repairer?',
        'texto' => 'You are about to delete',
        'aviso' => 'Incidents in their categories will be left without a contact.',
        'abrir' => 'Delete :nombre',
        'ver' => 'View the details of :nombre',
        'editar' => 'Edit :nombre',
        'ver_corto' => 'View the details',
    ],

];
