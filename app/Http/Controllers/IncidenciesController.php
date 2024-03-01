<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Incidencies;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Models\Categories;
use App\Models\Reparadors;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;
use Illuminate\Support\Facades\Auth;

class IncidenciesController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if ($user && $user->rol_usuari == 'manteniment') {
        // Usuario con rol 'manteniment', mostrar todas las incidencias
        $incidencies = Incidencies::all();
        return view('profesors.incidencies.index', compact('incidencies'));
    } elseif ($user) {
        // Usuario logueado, mostrar solo sus incidencias
        $incidencies = Incidencies::where('user_id', $user->id)->get();
        return view('profesors.incidencies.index', compact('incidencies'));
    } else {
        return abort(403); // Acceso no autorizado para usuarios no logueados
    }
}

    public function crear()
    {
        $incidencies = Incidencies::all();
        return view('/dashboard', compact('incidencies'));
    }

    public function store(ItemCreateRequest $request)
    {
        $incidencies = new Incidencies;
        $incidencies->titol = $request->titol;
        $incidencies->descripcio = $request->descripcio;
        $incidencies->data = $request->data;
        $incidencies->hora = $request->hora;
        $incidencies->estat = $request->estat;
        $incidencies->lloc = $request->lloc;
        $incidencies->user_id = $request->user_id;
        $incidencies->categories_id = $request->categoria_id;
        $incidencies->created_at = (new DateTime)->getTimestamp();
        $incidencies->save();

        return redirect('profesors/incidencies')->with('message', 'Guardado Satisfactoriamente!');
    }

    public function show($id)
{
    $incidencies = Incidencies::find($id);

    if (!$incidencies) {
        return abort(404); // Manejar el caso en que no se encuentre la incidencia
    }

    // Obtener información adicional necesaria
    $categoria = $incidencies->category;

    if (!$categoria) {
        return abort(404); // Manejar el caso en que no se encuentre la categoría asociada
    }

    $reparador = Reparadors::find($categoria->reparador_id);

    // Verificar si se encuentra el reparador
    $telefonoReparador = $reparador ? $reparador->telefono : 'Número no disponible';

    return view('profesors.incidencies.detalles', compact('incidencies', 'telefonoReparador'));
}

    public function actualitzar($id)
    {
        $incidencies = Incidencies::find($id);
        return view('profesors.incidencies.actualitzar', ['incidencies' => $incidencies]);
    }

    public function update(ItemUpdateRequest $request, $id)
    {
        $incidencies = Incidencies::find($id);
        $incidencies->titol = $request->titol;
        $incidencies->descripcio = $request->descripcio;
        $incidencies->data = $request->data;
        $incidencies->hora = $request->hora;
        $incidencies->estat = $request->estat;
        $incidencies->lloc = $request->lloc;
        $incidencies->user_id = $request->user_id;
        $incidencies->categories_id = $request->categoria_id;
        $incidencies->updated_at = (new DateTime)->getTimestamp();
        $incidencies->save();

        Session::flash('message', 'Editado Satisfactoriamente!');
        return Redirect::to('profesors/incidencies');
    }

    public function eliminar($id)
    {
        $incidencies = Incidencies::find($id);
        Incidencies::destroy($id);

        Session::flash('message', 'Eliminado Satisfactoriamente!');
        return Redirect::to('profesors/incidencies');
    }
}