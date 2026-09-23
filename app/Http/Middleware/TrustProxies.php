<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    // En Render (y en cualquier hosting con proxy delante) el cifrado termina en el
    // proxy y la peticion llega a la aplicacion como http. Sin confiar en el proxy,
    // Laravel genera las direcciones de los estilos con http:// y el navegador las
    // descarta al servirse la web por https, asi que la pagina sale sin CSS.
    protected $proxies = "*";

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
