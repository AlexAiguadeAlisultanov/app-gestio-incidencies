<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Incidencies;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Validator;
use DateTime;
use DB;
use Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

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
        return view('profesors.incidencies.crear', compact('incidencies'));
    }

    // BEGIN: be15d9bcejpp
    public function store(ItemCreateRequest $request)
    {
        // Instancio al modelo Incidencies que hace llamado a la tabla 'incidencies' de la Base de Datos
        $incidencies = new Incidencies;
        // Recibo todos los datos del formulario de la vista 'crear.blade.php'
        $incidencies->nombre = $request->nombre;
        $incidencies->precio = $request->precio;
        $incidencies->stock = $request->stock;
        // Almaceno la imagen en la carpeta pública especifica, esto lo veremos más adelante
        $incidencies->img = $request->file('imagen')->store('/');
        // Guardo la fecha de creación del registro
        $incidencies->created_at = (new DateTime)->getTimestamp();

        // Inserto todos los datos en mi tabla 'incidencies'
        $incidencies->save();

        // Hago una redirección a la vista principal con un mensaje
        return redirect('profesors/incidencies')->with('message', 'Guardado Satisfactoriamente !');
    }
    public function show($id)
    {
        $incidencies = Incidencies::find($id);
        return view('profesors.incidencies.detalles', compact('incidencies'));
    }
    public function actualizar($id)
    {
        $incidencies = Incidencies::find($id);
        return view('admin/incidencies.actualizar', ['incidencies' => $incidencies]);
    }
    public function update(ItemUpdateRequest $request, $id)
    {
        // Recibo todos los datos desde el formulario Actualizar
        $incidencies = Incidencies::find($id);
        $incidencies->nombre = $request->nombre;
        $incidencies->precio = $request->precio;
        $incidencies->stock = $request->stock;

        // Recibo la imagen desde el formulario Actualizar
        if ($request->hasFile('imagen')) {
            $incidencies->img = $request->file('imagen')->store('/');
        }

        // Guardamos la fecha de actualización del registro 
        $incidencies->updated_at = (new DateTime)->getTimestamp();

        // Actualizo los datos en la tabla 'productos'
        $incidencies->save();

        // Muestro un mensaje y redirecciono a la vista principal 
        Session::flash('message', 'Editado Satisfactoriamente !');
        return Redirect::to('profesors/incidencies');
    }
    public function eliminar($id)
    {
        // Indicamos el 'id' del registro que se va Eliminar
        $incidencies = Incidencies::find($id);

        // Elimino la imagen de la carpeta 'uploads', esto lo veremos más adelante
        $imagen = explode(",", $incidencies->img);
        Storage::delete($imagen);

        // Elimino el registro de la tabla 'productos' 
        Incidencies::destroy($id);

        // Opcional: Si deseas guardar la fecha de eliminación de un registro, debes mantenerlo en 
        // una tabla llamada por ejemplo 'productos_eliminados' y alli guardas su fecha de eliminación 
        // $productos->deleted_at = (new DateTime)->getTimestamp();

        // Muestro un mensaje y redirecciono a la vista principal 
        Session::flash('message', 'Eliminado Satisfactoriamente !');
        return Redirect::to('profesors/incidencies');
    }
}
