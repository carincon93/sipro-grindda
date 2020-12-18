<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proyecto;
use App\Models\Resultado;
use App\Models\ObjetivoEspecifico;

use App\Http\Requests\ProductoRequest;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        //
    }

    public function create($idProyecto, $idResultado, $nroProducto)
    {
        $resultado  = Resultado::findOrFail($idResultado);
        $proyecto   = Proyecto::findOrFail($idProyecto);

        return view('panel_administracion.proyectos.planeacion.productos.crear', compact('proyecto', 'resultado', 'nroProducto'));
    }

    public function store(ProductoRequest $request, $idProyecto, $idResultado)
    {
        $resultado      = Resultado::findOrFail($idResultado);

        if ($resultado->productos->count() < 4) {
            $producto = new Producto();
            $producto->codigo               = $request->get('codigo');
            $producto->descripcion          = $request->get('descripcion');
            $producto->fechaInicio          = $request->get('fechaInicio');
            $producto->fechaFin             = $request->get('fechaFin');
            $producto->duracion             = $request->get('duracion');
            $producto->resultado()->associate($resultado->id);
            $producto->save();

            return redirect()->route('productos.show', [$producto->resultado->objetivoEspecifico->proyecto->id, $producto->resultado->objetivoEspecifico->id])
                ->with('status', 'El producto ha sido creado con éxito');
        }

        return redirect()->route('productos.show', [$resultado->objetivoEspecifico->proyecto->id, $resultado->objetivoEspecifico->id])
            ->with('status', 'El máximo de productos permitidos por resultado es 4');
    }

    public function show($idProyecto, $idObjetivoEspecifico)
    {
        $proyecto           = Proyecto::findOrFail($idProyecto);
        // $objetivoEspecifico = ObjetivoEspecifico::findOrFail($idObjetivoEspecifico);
        $objetivoEspecifico = ObjetivoEspecifico::whereHas('proyecto', function ($query) use($idProyecto, $idObjetivoEspecifico) {
            $query->where('objetivos_especificos.proyecto_id', '=', $idProyecto)->where('objetivos_especificos.id', '=', $idObjetivoEspecifico);
        })->firstOrFail();

        return view('panel_administracion.proyectos.planeacion.productos.listar', compact('proyecto', 'objetivoEspecifico'));
    }

    public function edit($idProyecto, $idProducto)
    {
        $proyecto           = Proyecto::findOrFail($idProyecto);
        $producto           = Producto::findOrFail($idProducto);

        return view('panel_administracion.proyectos.planeacion.productos.editar', compact('proyecto', 'producto'));
    }

    public function update(ProductoRequest $request, $idProyecto, $idProducto)
    {
        $producto = Producto::findOrFail($idProducto);
        $producto->codigo               = $request->get('codigo');
        $producto->descripcion          = $request->get('descripcion');
        $producto->fechaInicio          = $request->get('fechaInicio');
        $producto->fechaFin             = $request->get('fechaFin');
        $producto->duracion             = $request->get('duracion');
        // $producto->resultado_id         = $request->get('resultadoId');
        $producto->resultado()->associate($producto->resultado->id);
        $producto->save();

        return redirect()->route('productos.show', [$idProyecto, $producto->resultado->objetivoEspecifico->id])
            ->with('status', 'El producto ha sido modificado con éxito');
    }

    public function destroy(Request $request, $idProyecto, $idProducto)
    {
        $producto = Producto::findOrFail($idProducto);

        $producto->destroy($idProducto);

        return redirect()->route('productos.show', [$producto->resultado->objetivoEspecifico->proyecto->id, $producto->resultado->objetivoEspecifico->id])
            ->with('status', 'El producto ha sido eliminado con éxito');
    }
}
