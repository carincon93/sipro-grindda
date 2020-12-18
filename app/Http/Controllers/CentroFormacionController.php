<?php

namespace App\Http\Controllers;

use App\Models\CentroFormacion;

use App\Http\Requests\CentroFormacionRequest;
use Illuminate\Http\Request;

class CentroFormacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centroFormacion = CentroFormacion::all();
        return view('panel_administracion.centros_informacion.listar', compact('centroFormacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CentroFormacionRequest $request)
    {
        //
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
        $centroFormacion = CentroFormacion::findOrFail($id);
        return view('panel_administracion.centros_informacion.editar', compact('centroFormacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CentroFormacionRequest $request, $id)
    {
        $centroFormacion = CentroFormacion::findOrFail($id);
        $centroFormacion->nombreCentroFormacion         = $request->get('nombreCentroFormacion');
        $centroFormacion->nombreSubdirector             = $request->get('nombreSubdirector');
        $centroFormacion->correoElectronicoSubdirector  = $request->get('correoElectronicoSubdirector');
        $centroFormacion->numeroCelularSubdirector      = $request->get('numeroCelularSubdirector');
        $centroFormacion->nombreLiderSennova            = $request->get('nombreLiderSennova');
        $centroFormacion->correoElectronicoLiderSennova = $request->get('correoElectronicoLiderSennova');
        $centroFormacion->numeroCelularLiderSennova     = $request->get('numeroCelularLiderSennova');
        $centroFormacion->save();
        return redirect()->route('centros_formacion.index')
            ->with('status', 'La información del personal del centro de formación ha sido modificado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
