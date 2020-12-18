<?php

namespace App\Http\Controllers;

use App\Models\ProgramaFormacion;

use App\Http\Requests\ProgramaFormacionRequest;
use Illuminate\Http\Request;

class ProgramaFormacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programasFormacion = ProgramaFormacion::orderBy('nombre')->get();
        return view('panel_administracion.programas_formacion.listar', compact('programasFormacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel_administracion.programas_formacion.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramaFormacionRequest $request)
    {
        $programaFormacion          = new ProgramaFormacion();
        $programaFormacion->nombre              = $request->get('nombre');
        $programaFormacion->nivelAcademico      = $request->get('nivelAcademico');
        $programaFormacion->sectorProductivo    = $request->get('sectorProductivo');
        $programaFormacion->save();
        return redirect()->route('programas_formacion.index')
            ->with('status', "El programa de formación {$programaFormacion->nombre} ha sido creado con éxito.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $programaFormacion = ProgramaFormacion::findOrFail($id);
        return view('panel_administracion.programas_formacion.ver', compact('programaFormacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $programaFormacion = ProgramaFormacion::findOrFail($id);
        return view('panel_administracion.programas_formacion.editar', compact('programaFormacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramaFormacionRequest $request, $id)
    {
        $programaFormacion          = ProgramaFormacion::findOrFail($id);
        $programaFormacion->nombre              = $request->get('nombre');
        $programaFormacion->nivelAcademico      = $request->get('nivelAcademico');
        $programaFormacion->sectorProductivo    = $request->get('sectorProductivo');
        $programaFormacion->save();

        return redirect()->route('programas_formacion.index')
            ->with('status', "El programa de formación {$programaFormacion->nombre} ha sido modificado con éxito.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProgramaFormacion::destroy($id);
        return redirect()->route('programas_formacion.index')
            ->with('status', "El programa de formación ha sido eliminado con éxito.");
    }
}
