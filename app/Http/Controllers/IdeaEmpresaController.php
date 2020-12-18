<?php

namespace App\Http\Controllers;

use App\Models\IdeaEmpresa;

use Illuminate\Http\Request;
use App\Http\Requests\IdeaEmpresaRequest;


class IdeaEmpresaController extends Controller
{
    public function index()
    {
        $cajaIdeas = IdeaEmpresa::all();
        return view('panel_administracion.caja_ideas.listar', compact('cajaIdeas'));
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
    public function store(Request $request)
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
        $idea = IdeaEmpresa::findOrFail($id);
        return view('panel_administracion.caja_ideas.ver', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idea = IdeaEmpresa::findOrFail($id);
        return view('panel_administracion.caja_ideas.editar', compact('idea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IdeaEmpresaRequest $request, $id)
    {
        $idea = IdeaEmpresa::findOrFail($id);
        $idea->nombreEmpresa        = $request->get('nombreEmpresa');
        $idea->nit                  = $request->get('nit');
        $idea->representanteLegal   = $request->get('representanteLegal');
        $idea->sectorEmpresa        = $request->get('sectorEmpresa');
        $idea->nombrePersona        = $request->get('nombrePersona');
        $idea->telefonoCelular      = $request->get('telefonoCelular');
        $idea->telefonoFijo         = $request->get('telefonoFijo');
        $idea->correoElectronico    = $request->get('correoElectronico');
        $idea->idea                 = $request->get('idea');
        $idea->presupuesto          = $request->get('presupuesto');
        $idea->save();

        return redirect()->route('caja_ideas.index')->with('status', 'La idea se ha modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IdeaEmpresa::destroy($id);
        return redirect()->route('caja_ideas.index')
            ->with('status', 'La idea se ha eliminado con éxito');
    }
}
