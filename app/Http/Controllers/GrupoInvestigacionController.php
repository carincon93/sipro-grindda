<?php

namespace App\Http\Controllers;

use App\Models\GrupoInvestigacion;

use App\Http\Requests\GrupoInvestigacionRequest;
use Illuminate\Http\Request;

class GrupoInvestigacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grupoInestigacion = GrupoInvestigacion::all();
        return view('panel_administracion.grupos_investigacion.listar', compact('grupoInestigacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel_administracion.grupos_investigacion.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrupoInvestigacionRequest $request)
    {
        $grupoInvestigacion =new GrupoInvestigacion();
        $grupoInvestigacion->nombre         = $request->nombre;
        $grupoInvestigacion->descripcion    = $request->descripcion;
        $grupoInvestigacion->save();
        return redirect()->route('grupos_investigacion.index')
            ->with('status', "El grupo de investigación {$grupoInvestigacion->nombre} ha sido creado con éxito.");
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
        $grupoInvestigacion = GrupoInvestigacion::findOrFail($id);

        return view('panel_administracion.grupos_investigacion.editar', compact('grupoInvestigacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GrupoInvestigacionRequest $request, $id)
    {
        $grupoInvestigacion = GrupoInvestigacion::findOrFail($id);
        $grupoInvestigacion->nombre         = $request->get('nombre');
        $grupoInvestigacion->descripcion    = $request->get('descripcion');
        $grupoInvestigacion->save();
        return redirect()->route('grupos_investigacion.index')
            ->with('status', "El grupo de investigación {$grupoInvestigacion->nombre} ha sido modificado con éxito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        GrupoInvestigacion::destroy($id);
        return redirect()->route('grupos_investigacion.index')
            ->with('status', 'El grupo de investigación ha sido eliminado con éxito.');
    }
}
