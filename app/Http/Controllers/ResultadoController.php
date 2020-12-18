<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Resultado;
use App\Models\ObjetivoEspecifico;

use App\Http\Requests\ResultadoRequest;
use Illuminate\Http\Request;

use Cookie;

class ResultadoController extends Controller
{
    public function index()
    {
        //
    }

    public function create($idProyecto, $idObjetivoEspecificoecifico)
    {
        $objetivoEspecifico = ObjetivoEspecifico::findOrFail($idObjetivoEspecificoecifico);

        $proyecto           = Proyecto::findOrFail($idProyecto);

        return view('panel_administracion.proyectos.planeacion.resultados.crear', compact('objetivoEspecifico', 'proyecto', 'idObjetivoEspecifico'));
    }

    public function store(ResultadoRequest $request, $idProyecto, $idObjetivoEspecifico)
    {
        $objetivoEspecifico = ObjetivoEspecifico::findOrFail($idObjetivoEspecifico);

        if ($objetivoEspecifico->resultados->count() == 0) {
            $resultado = new Resultado();
            $resultado->codigo                  = $request->get('codigo');
            $resultado->descripcion             = $request->get('descripcion');
            $resultado->indicador               = $request->get('indicador');
            $resultado->medioVerificacion       = $request->get('medioVerificacion');
            $resultado->meta                    = $request->get('meta');
            $resultado->objetivoEspecifico()->associate($objetivoEspecifico->id);
            $resultado->save();

            return redirect()->route('resultados.show', [$resultado->objetivoEspecifico->proyecto->id, $resultado->objetivoEspecifico->id])
                ->with('status', 'El resultado ha sido creado con éxito');
        }

        return redirect()->route('resultados.show', [$idProyecto, $idObjetivoEspecifico])
            ->with('status', 'El máximo de resultados es 1');
    }

    public function show($idProyecto, $idObjetivoEspecifico)
    {
        Cookie::queue(Cookie::make('nombre', 'tutorial', 262800));

        // $objetivoEspecifico = ObjetivoEspecifico::findOrFail($idObjetivoEspecifico);
        $objetivoEspecifico = ObjetivoEspecifico::whereHas('proyecto', function ($query) use($idProyecto, $idObjetivoEspecifico) {
            $query->where('objetivos_especificos.proyecto_id', '=', $idProyecto)->where('objetivos_especificos.id', '=', $idObjetivoEspecifico);
        })->firstOrFail();

        $proyecto   = Proyecto::findOrFail($idProyecto);

        return view('panel_administracion.proyectos.planeacion.resultados.listar', compact('proyecto', 'objetivoEspecifico'));
    }

    public function edit($idProyecto, $idResultado)
    {
        $resultado  = Resultado::findOrFail($idResultado);
        $proyecto   = Proyecto::findOrFail($idProyecto);

        $resultado          = Resultado::findOrFail($idResultado);
        return view('panel_administracion.proyectos.planeacion.resultados.editar', compact('proyecto', 'resultado'));
    }

    public function update(ResultadoRequest $request, $idProyecto, $idResultado)
    {
        $resultado = Resultado::findOrFail($idResultado);

        // RESULTADOS
        // **********
        $resultado->codigo                  = $request->get('codigo');
        $resultado->descripcion             = $request->get('descripcion');
        $resultado->indicador               = $request->get('indicador');
        $resultado->medioVerificacion       = $request->get('medioVerificacion');
        $resultado->meta                    = $request->get('meta');
        $resultado->objetivoEspecifico()->associate($resultado->objetivoEspecifico->id);
        $resultado->save();

        return redirect()->route('resultados.show', [$idProyecto, $resultado->objetivoEspecifico->id])
            ->with('status', 'El resultado ha sido modificado con éxito');
    }

    public function destroy(Request $request, $idProyecto, $idResultado)
    {
        $resultado = Resultado::findOrFail($idResultado);

        $resultado->destroy($idResultado);

        return redirect()->route('resultados.show', [$resultado->objetivoEspecifico->proyecto->id, $resultado->objetivoEspecifico->id])
            ->with('status', 'El resultado ha sido eliminado con éxito');
    }


}
