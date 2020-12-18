<?php

namespace App\Http\Controllers;

use App\Models\Aliado;
use App\Models\Proyecto;
use App\Models\Evaluacion;
use App\Models\Presupuesto;

use App\Http\Requests\PresupuestoRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PresupuestoController extends Controller
{
    public function index($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $presupuestosSennova = Presupuesto::where('proyecto_id', $id)->get();
        return view('panel_administracion.proyectos.planeacion.presupuestos_sennova.listar', compact('proyecto', 'presupuestosSennova'));
    }

    public function create($id)
    {
        $proyecto   = Proyecto::findOrFail($id);
        return view('panel_administracion.proyectos.planeacion.presupuestos_sennova.crear', compact('proyecto'));
    }

    public function store(PresupuestoRequest $request, $idProyecto)
    {
        $proyecto       = Proyecto::findOrFail($idProyecto);
        $data = [];
        if ($request->has('nombreItem')) {
            $count              = count($request->get('nombreItem'));
            $nombreItem         = $request->get('nombreItem');
            $valor              = $request->get('valor');
            $descripcion        = $request->get('descripcion');
            $proyecto_id        = $proyecto->id;

            if ($request->hasFile('archivo')) {
                $archivo = $request->file('archivo');
                foreach($archivo as $file) {
                    $rutaArchivo[]  = Storage::putFile(
                        'presupuesto-archivos', $file
                    );
                }
            } else {
                $rutaArchivo[] = null;
            }

            for ($i=0; $i < $count ; $i++) {
                $data = array(
                    'nombreItem'        => $nombreItem[$i],
                    'valor'             => $valor[$i],
                    'descripcion'       => $descripcion[$i],
                    'archivo'           => $rutaArchivo[$i],
                    'proyecto_id'       => $proyecto_id,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s'),
                );
                Presupuesto::insert($data);
            }
        }
        return redirect()->route('presupuestos_sennova.index', $proyecto->id)
            ->with('status', 'El presupuesto ha sido creado con éxito.');
    }

    public function show($idProyecto, $idPresupuesto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        $presupuesto  = Presupuesto::findOrFail($idPresupuesto);
        return view('panel_administracion.proyectos.planeacion.presupuestos_sennova.ver', compact('proyecto', 'presupuesto'));
    }

    public function edit($idProyecto, $idPresupuesto) {
        $proyecto       = Proyecto::findOrFail($idProyecto);
        $presupuesto    = Presupuesto::findOrFail($idPresupuesto);

        return view('panel_administracion.proyectos.planeacion.presupuestos_sennova.editar', compact('proyecto', 'presupuesto'));
    }

    public function update(PresupuestoRequest $request, $idProyecto, $idPresupuesto) {
        $proyecto       = Proyecto::findOrFail($idProyecto);
        $presupuesto    = Presupuesto::findOrFail($idPresupuesto);

        $presupuesto->nombreItem                    = $request->get('nombreItem');
        $presupuesto->valor                         = $request->get('valor');
        $presupuesto->descripcion                   = $request->get('descripcion');
        if ($request->hasFile('archivo')) {
            Storage::delete($presupuesto->archivo);
            $rutaArchivo  = Storage::putFile(
                'presupuesto-archivos', $request->file('archivo')
            );
            $presupuesto->archivo = $rutaArchivo;
        }

        $presupuesto->save();

        return redirect()->route('presupuestos_sennova.index', $presupuesto->proyecto->id)
            ->with('status', 'El presupuesto ha sido modificado con éxito.');
    }

    public function destroy(Request $request, $idProyecto, $idPresupuesto)
    {
        $presupuesto    = Presupuesto::findOrFail($idPresupuesto);
        Storage::delete($presupuesto->archivo);
        $presupuesto->destroy($idPresupuesto);

        return redirect()->route('presupuestos_sennova.index', $presupuesto->proyecto->id)
            ->with('status', 'El presupuesto ha sido eliminado con éxito.');
    }

    public function descargarCartaPresupuesto($id)
    {
        $presupuesto    = Presupuesto::findOrFail($id);

        $pathToFile     = storage_path("app/{$presupuesto->archivo}");
        if (file_exists($pathToFile) && $presupuesto->archivo !== null) {
            $extension      = '.'.pathinfo($pathToFile)['extension'];
            $nombreArchivo  = $presupuesto->nombreItem.$extension;

            return response()->download($pathToFile, $nombreArchivo);
        }

        return redirect()->back()->with('status-danger', 'El archivo no existe');
    }
}
