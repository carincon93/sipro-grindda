<?php

namespace App\Http\Controllers;

use App\Models\Convocatoria;

use App\Http\Requests\ConvocatoriaRequest;
use Illuminate\Http\Request;


class ConvocatoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convocatorias = Convocatoria::orderBy('fecha_inicio', 'desc')->get();
        return view('panel_administracion.convocatorias.listar', compact('convocatorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel_administracion.convocatorias.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConvocatoriaRequest $request)
    {
        $convocatoria = new Convocatoria();
        $convocatoria->fecha_inicio             = $request->get('fecha_inicio');
        $convocatoria->fecha_fin                = $request->get('fecha_fin');
        $convocatoria->descripcion              = $request->get('descripcion');
        $convocatoria->convocatoriaCorreccion   = $request->get('tipoConvocatoria') == 0 ? false : true;
        $convocatoria->save();
        return redirect()->route('convocatorias.index')
            ->with('status', "La convocatoria se ha abierto desde {$convocatoria->fecha_inicio} hasta {$convocatoria->fecha_fin}.");

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
        $convocatoria = Convocatoria::findOrFail($id);
        return view('panel_administracion.convocatorias.editar', compact('convocatoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ConvocatoriaRequest $request, $id)
    {
        $convocatoria = Convocatoria::findOrFail($id);
        $convocatoria->fecha_inicio             = $request->get('fecha_inicio');
        $convocatoria->fecha_fin                = $request->get('fecha_fin');
        $convocatoria->descripcion              = $request->get('descripcion');
        $convocatoria->convocatoriaCorreccion   = $request->get('tipoConvocatoria') == 0 ? false : true;
        $convocatoria->save();

        return redirect()->route('convocatorias.index')->with('status', "La convocatoria ha sido modificada. Nueva fecha: {$convocatoria->fecha_inicio} hasta {$convocatoria->fecha_fin}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Convocatoria::destroy($id);
        return redirect()->route('convocatorias.index')
            ->with('status', 'La convocatoria ha sido eliminada con éxito');
    }
}
