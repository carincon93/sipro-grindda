<?php

namespace App\Http\Controllers;

use App\Models\Semillero;

use App\Http\Requests\SemilleroRequest;
use Illuminate\Http\Request;

class SemilleroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $semilleros = Semillero::all();
        return view('panel_administracion.semilleros.listar', compact('semilleros'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('panel_administracion.semilleros.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SemilleroRequest $request)
    {

        $semillero                  = new Semillero();
        $semillero->nombre          = $request->get('nombre');
        $semillero->descripcion     = $request->get('descripcion');
        $semillero->save();

        return redirect()->route('semilleros.index')
            ->with('status', "El semillero {$semillero->nombre} ha sido creado con éxito.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $semillero = Semillero::findOrFail($id);
        return view('panel_administracion.semilleros.editar', compact('semillero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SemilleroRequest $request, $id)
    {
        $semillero = Semillero::findOrFail($id);
        $semillero->nombre      = $request->get('nombre');
        $semillero->descripcion = $request->get('descripcion');
        $semillero->save();
        return redirect()->route('semilleros.index')
            ->with('status', "El semillero {$semillero->nombre} ha sido modificado con éxito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Semillero::destroy($id);
        return redirect()->route('semilleros.index')
            ->with('status', "El semillero ha sido eliminado con éxito.");
    }
}
