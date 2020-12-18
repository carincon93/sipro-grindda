<?php

namespace App\Http\Controllers;

use App\Models\LineaInvestigacion;

use App\Http\Requests\LineaInvestigacionRequest;
use Illuminate\Http\Request;


class LineaInvestigacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lineaInvestigacion = LineaInvestigacion::all();
        return view('panel_administracion.lineas_investigacion.listar', compact('lineaInvestigacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel_administracion.lineas_investigacion.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LineaInvestigacionRequest $request)
    {

        $lineaInvestigacion                  = new LineaInvestigacion();
        $lineaInvestigacion->nombre          = $request->nombre;
        $lineaInvestigacion->descripcion     = $request->descripcion;
        $lineaInvestigacion->save();
        return redirect()->route('lineas_investigacion.index')
            ->with('status', "La línea de investigación {$lineaInvestigacion->nombre} ha sido creada con éxito");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $lineaInvestigacion = LineaInvestigacion::findOrFail($id);
        return view('panel_administracion.lineas_investigacion.editar', compact('lineaInvestigacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LineaInvestigacionRequest $request, $id)
    {

        $lineaInvestigacion                 = LineaInvestigacion::findOrFail($id);
        $lineaInvestigacion->nombre         = $request->get('nombre');
        $lineaInvestigacion->descripcion    = $request->get('descripcion');
        $lineaInvestigacion->save();
        return redirect()->route('lineas_investigacion.index')
            ->with('status', "La línea de investigación {$lineaInvestigacion->nombre} ha sido modificada con éxito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        LineaInvestigacion::destroy($id);
        return redirect()->route('lineas_investigacion.index')
            ->with('status', 'La línea de investigación ha sido eliminada con éxito');
    }
}
