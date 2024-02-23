<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Models\Reparadors;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DateTime;

class ReparadorsController extends Controller
{
    public function index()
    {
        $reparadors = Reparadors::all();
        return view('profesors.reparadors.index', compact('reparadors'));
    }
    public function crear()
    {
        $reparadors = Reparadors::all();
        return view('resources/views/profesors/reparadors/crear.blade.php', compact('reparadors'));
    }
    public function store(ItemCreateRequest $request)
    {

        $reparadors = new Reparadors;
        $reparadors->titol = $request->nombre;
        $reparadors->apellidos = $request->apellidos;
        $reparadors->email = $request->email;
        $reparadors->telefono = $request->telefono;
        $reparadors->direccion = $request->direccion;
        $reparadors->ciudad = $request->ciudad;
        $reparadors->created_at = (new DateTime)->getTimestamp();
        $reparadors->save();

        return redirect('profesors/reparadors')->with('message', 'Guardado Satisfactoriamente!');
    }

    public function show($id)
    {
        $reparadors = Reparadors::find($id);
        return view('profesors.reparadors.detalles', compact('reparadors'));
    }

    public function actualizar($id)
    {
        $reparadors = Reparadors::find($id);
        return view('profesors/reparadors.actualitzar', ['reparadors' => $reparadors]);
    }

    public function update(ItemUpdateRequest $request, $id)
    {
        $reparadors = Reparadors::find($id);
        $reparadors->nombre = $request->nombre;
        $reparadors->apellidos = $request->apellidos;
        $reparadors->email = $request->email;
        $reparadors->telefono = $request->telefono;
        $reparadors->direccion = $request->direccion;
        $reparadors->ciudad = $request->ciudad;
        $reparadors->updated_at = (new DateTime)->getTimestamp();
        $reparadors->save();

        Session::flash('message', 'Editado Satisfactoriamente!');
        return Redirect::to('profesors/reparadors');
    }
    public function eliminar($id)
    {
        $reparadors = Reparadors::find($id);
        Reparadors::destroy($id);

        Session::flash('message', 'Eliminado Satisfactoriamente!');
        return Redirect::to('profesors/reparadors');
    }
}