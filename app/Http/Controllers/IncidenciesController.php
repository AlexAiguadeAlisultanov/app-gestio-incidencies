<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Incidencies;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;

class IncidenciesController extends Controller
{
    public function index()
    {
        $incidencies = Incidencies::all();
        return view('profesors.incidencies.index', compact('incidencies'));
    }

    public function crear()
    {
        $incidencies = Incidencies::all();
        return view('/dashboard', compact('incidencies'));
    }

    public function store(ItemCreateRequest $request)
    {
        $incidencies = new Incidencies;
        $incidencies->titol = $request->nombre;
        $incidencies->descripcio = $request->descripcion;
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
        return view('profesors.incidencies.detalles', compact('incidencies'));
    }

    public function actualizar($id)
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