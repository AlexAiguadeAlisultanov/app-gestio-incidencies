<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

/**
 * Deja la aplicación en el idioma que la persona eligió en el selector.
 *
 * La elección vive en la sesión, así que aguanta al navegar y al recargar. Si no hay
 * nada elegido, o si alguien escribe un código raro en la URL, se queda el idioma por
 * defecto de config/app.php.
 */
class Idioma
{
    /**
     * Los tres idiomas que sirve la aplicación, en el orden en que salen en el selector.
     *
     * La clave es el código de Laravel y la carpeta dentro de lang/. 'bandera' es el
     * dibujo que le toca en el componente de bandera, y 'corto' la abreviatura que se
     * ve al lado.
     */
    public const DISPONIBLES = [
        'es' => ['nombre' => 'Castellano', 'bandera' => 'es', 'corto' => 'ES'],
        'ca' => ['nombre' => 'Català', 'bandera' => 'ca', 'corto' => 'CA'],
        'en' => ['nombre' => 'English', 'bandera' => 'gb', 'corto' => 'EN'],
    ];

    /** Dónde se guarda la elección dentro de la sesión. */
    public const CLAVE = 'idioma';

    public function handle(Request $request, Closure $next): Response
    {
        $elegido = $request->session()->get(self::CLAVE);

        // Al cerrar sesión Laravel invalida la sesión entera, y con ella se iría el
        // idioma. Por eso la elección se duplica en una cookie propia, que es la que
        // manda cuando la sesión viene vacía.
        if (! self::admitido($elegido)) {
            $elegido = $request->cookie(self::CLAVE);
        }

        if (self::admitido($elegido)) {
            App::setLocale($elegido);
            $request->session()->put(self::CLAVE, $elegido);
        }

        $respuesta = $next($request);

        if (self::admitido($elegido) && $request->cookie(self::CLAVE) !== $elegido) {
            $respuesta->withCookie(cookie()->forever(self::CLAVE, $elegido));
        }

        return $respuesta;
    }

    /** Solo se aceptan los tres idiomas de la lista. */
    public static function admitido(mixed $codigo): bool
    {
        return is_string($codigo) && array_key_exists($codigo, self::DISPONIBLES);
    }
}
