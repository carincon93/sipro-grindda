<?php

namespace App\Http\Controllers;

use App\Models\AreaConocimiento;

use Illuminate\Http\Request;
use App\Http\Requests\AreaConocimientoRequest;

class AreaConocimientoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $areas = AreaConocimiento::orderBy('nombre')->get();
        return view('panel_administracion.areas_conocimiento.listar', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel_administracion.areas_conocimiento.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaConocimientoRequest $request)
    {
        $area = new AreaConocimiento();
        $area->codigo = $request->get('codigo');
        $area->nombre = strtoupper($request->get('nombre'));
        $area->save();

        return redirect()->route('areas_conocimiento.index')
            ->with('status', "El área de conocimiento {$area->nombre} ha sido creado con éxito.");
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
        $area = AreaConocimiento::findOrFail($id);
        return view('panel_administracion.areas_conocimiento.editar', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaConocimientoRequest $request, $id)
    {
        $area = AreaConocimiento::findOrFail($id);

        $area->codigo = $request->get('codigo');
        $area->nombre = strtoupper($request->get('nombre'));

        if($area->save()) {
          return redirect()->route('areas_conocimiento.index')
            ->with('status', "El área de conocimiento {$area->nombre} ha sido modificado con éxito.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AreaConocimiento::destroy($id);
        return redirect()->route('areas_conocimiento.index')
            ->with('status', "El área de conocimiento ha sido eliminado con éxito.");
    }
}
