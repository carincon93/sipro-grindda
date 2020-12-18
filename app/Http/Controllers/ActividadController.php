<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Producto;
use App\Models\Actividad;
use App\Models\ObjetivoEspecifico;

use App\Http\Requests\ActividadRequest;
use Illuminate\Http\Request;


class ActividadController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id, $idProducto, $nroActividad)
    {
        $proyecto = Proyecto::findOrFail($id);

        $producto = Producto::findOrFail($idProducto);
        return view('panel_administracion.proyectos.planeacion.actividades.crear', compact('id', 'producto', 'proyecto', 'nroActividad'));
    }

    public function store(ActividadRequest $request, $idProyecto, $idProducto)
    {
        $producto   = Producto::findOrFail($idProducto);

        if ($producto->actividades->count() < 4) {
            $actividad = new Actividad();
            $actividad->codigo              = $request->get('codigo');
            $actividad->descripcion         = $request->get('descripcion');
            $actividad->fechaInicio         = $request->get('fechaInicio');
            $actividad->fechaFin            = $request->get('fechaFin');
            $actividad->duracion            = $request->get('duracion');
            $actividad->producto()->associate($producto->id);
            $actividad->save();

            return redirect()->route('actividades.show', [$actividad->producto->resultado->objetivoEspecifico->proyecto->id, $actividad->producto->resultado->objetivoEspecifico->id])
                ->with('status', 'La actividad ha sido creada con éxito.');
        }

        return redirect()->route('actividades.show', [$idProyecto, $producto->resultado->objetivoEspecifico->id])
            ->with('status', 'El máximo de actividades por producto es 4');

    }

    public function show($idProyecto, $idObjetivoEspecifico)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        $objetivoEspecifico = ObjetivoEspecifico::whereHas('proyecto', function ($query) use($idProyecto, $idObjetivoEspecifico) {
            $query->where('objetivos_especificos.proyecto_id', '=', $idProyecto)->where('objetivos_especificos.id', '=', $idObjetivoEspecifico);
        })->firstOrFail();

        return view('panel_administracion.proyectos.planeacion.actividades.listar', compact('proyecto', 'objetivoEspecifico'));
    }

    public function edit($idProyecto, $idActividad)
    {
        $proyecto   = Proyecto::findOrFail($idProyecto);
        $actividad  = Actividad::findOrFail($idActividad);

        return view('panel_administracion.proyectos.planeacion.actividades.editar', compact('proyecto', 'actividad'));
    }

    public function update(ActividadRequest $request, $idProyecto, $idActividad)
    {
        $actividad = Actividad::findOrFail($idActividad);
        $actividad->codigo              = $request->get('codigo');
        $actividad->descripcion         = $request->get('descripcion');
        $actividad->fechaInicio         = $request->get('fechaInicio');
        $actividad->fechaFin            = $request->get('fechaFin');
        $actividad->duracion            = $request->get('duracion');
        $actividad->producto()->associate($actividad->producto->id);
        $actividad->save();

        return redirect()->route('actividades.show', [$actividad->producto->resultado->objetivoEspecifico->proyecto->id, $actividad->producto->resultado->objetivoEspecifico->id])
            ->with('status', 'La actividad ha sido modificada con éxito.');
    }

    public function destroy(Request $request, $idProyecto, $idActividad)
    {
        $actividad = Actividad::findOrFail($idActividad);

        $actividad->destroy($idActividad);

        return redirect()->route('actividades.show', [$actividad->producto->resultado->objetivoEspecifico->proyecto->id, $actividad->producto->resultado->objetivoEspecifico->id])
            ->with('status', 'La actividad ha sido eliminada con éxito');
    }

    public function diagrama($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        return view('panel_administracion.proyectos.planeacion.actividades.diagrama', compact('proyecto'));
    }

    public function obtenerActividad(Request $request)
    {
        $id         = $request->id;
        $actividad  = Actividad::where('id', $id)->first();
        return $actividad;
    }
}
