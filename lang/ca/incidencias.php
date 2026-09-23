<?php

// Llistat, fitxa i formulari d'incidències, més el tauler d'inici.
return [

    'titulo_listado' => 'Incidències',
    'titulo_nueva' => 'Nova incidència',
    'titulo_editar' => "Editar la incidència",
    'titulo_ficha' => 'Incidència',
    'titulo_inicio' => 'Inici',

    'panel' => [
        'saludo' => 'Hola, :nombre',
        'todo' => 'Estat del centre',
        'propias' => 'Les teves incidències',
        'resumen' => 'Resum per estat',
        'alta_titulo' => "Donar d'alta una incidència",
        'alta_texto' => 'Digues què passa i on. El reparador que porta aquesta categoria la veurà al seu llistat.',
        'ultimas' => 'Últimes incidències',
        'verlas_todas' => 'Veure-les totes',
        'sin_nada' => "Aquí apareixeran les incidències tan bon punt donis d'alta la primera.",
    ],

    'listado' => [
        'todas' => 'Totes les incidències',
        'propias' => 'Les teves incidències',
        'recuento' => '{1} :total incidència al llistat.|[2,*] :total incidències al llistat.',
        'nueva' => 'Nova incidència',
        'filtrar' => 'Filtrar per estat',
        'buscar_etiqueta' => 'Cercar al llistat',
        'buscar_pista' => 'Cercar per títol, lloc o categoria',
        'resumen_tabla' => 'Llistat d\'incidències amb el seu estat, lloc i categoria',
        'sin_resultados' => 'Cap incidència coincideix amb el que busques.',
        'vacio_titulo' => 'Encara no hi ha incidències',
        'vacio_texto' => "Quan donis d'alta la primera, apareixerà aquí amb el seu estat.",
        'vacio_accion' => "Donar d'alta una incidència",
    ],

    'tabla' => [
        'estado' => 'Estat',
        'incidencia' => 'Incidència',
        'sitio' => 'Lloc',
        'categoria' => 'Categoria',
        'dia_hora' => 'Dia i hora',
        'acciones' => 'Accions',
    ],

    'campos' => [
        'sitio' => 'Lloc',
        'categoria' => 'Categoria',
        'dia' => 'Dia',
        'hora' => 'Hora',
        'alta' => "Qui la va donar d'alta",
    ],

    'ficha' => [
        'volver' => 'Tornar al llistat',
        'numero' => 'Incidència número :id',
        'que_pasa' => 'Què passa',
        'editar' => 'Editar la incidència',
        'quien_arregla' => 'Qui ho arregla',
        'sin_reparador' => 'Aquesta categoria encara no té reparador assignat.',
        'telefono' => 'Telèfon',
        'correo' => 'Correu',
        'enviar' => 'Enviar-li la incidència',
        'enviar_pista' => "S'obre WhatsApp amb el missatge escrit.",
        'no_existe' => 'Aquesta incidència ja no existeix',
        'no_encontrada' => 'Incidència no trobada',
        'no_encontrada_titulo' => 'No hem trobat aquesta incidència',
        'no_encontrada_texto' => "Potser algú l'ha eliminat mentre la miraves.",
        'usuario' => 'Usuari :id',
    ],

    'whatsapp' => [
        'sitio' => 'Lloc',
        'dia' => 'Dia',
        'a_las' => 'a les',
        'estado' => 'Estat',
    ],

    'nueva' => [
        'entrada' => "Digues què passa i on. De la resta se n'encarrega manteniment.",
    ],

    'formulario' => [
        'titulo' => 'Què passa',
        'titulo_pista' => "El projector de l'aula no dona senyal",
        'descripcion' => 'Explica-ho amb detall',
        'descripcion_pista' => 'El que has provat, des de quan passa, si afecta més llocs',
        'sitio' => 'On és',
        'sitio_pista' => 'Aula A12',
        'categoria' => 'Categoria',
        'categoria_vacia' => 'Tria una categoria',
        'categoria_pista' => 'Cada categoria té el seu reparador assignat.',
        'dia' => 'Dia',
        'hora' => 'Hora',
        'estado' => 'Estat',
        'a_nombre_de' => 'A nom de :nombre',
        'usuario' => 'usuari :id',
        'enviar' => "Donar d'alta la incidència",
    ],

    'eliminar' => [
        'titulo' => 'Vols eliminar la incidència?',
        'texto' => 'Estàs a punt d\'eliminar',
        'aviso' => 'No es pot desfer.',
        'abrir' => 'Eliminar :titulo',
        'ver' => 'Veure la fitxa de :titulo',
        'editar' => 'Editar :titulo',
        'ver_corto' => 'Veure la fitxa',
    ],

];
