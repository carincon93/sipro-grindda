<?php

namespace App\Http\Controllers;

use App\Models\Aliado;
use App\Models\Proyecto;
use App\Models\PresupuestoEmpresarial;

use App\Http\Requests\PresupuestoRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PresupuestoEmpresarialController extends Controller
{
    public function index($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('panel_administracion.proyectos.planeacion.presupuestos_empresariales.listar', compact('proyecto'));
    }

    public function create($idProyecto, $idAliado)
    {
        $aliado     = Aliado::findOrFail($idAliado);
        $proyecto   = Proyecto::findOrFail($idProyecto);

        return view('panel_administracion.proyectos.planeacion.presupuestos_empresariales.crear', compact('proyecto', 'aliado'));
    }

    public function store(PresupuestoRequest $request, $idProyecto)
    {
        $proyecto       = Proyecto::findOrFail($idProyecto);
        $idAliado       = $request->get('aliadoId');
        $aliado         = Aliado::findOrFail($idAliado);

        $data = [];
        if ($request->has('nombreItem')) {
            $count              = count($request->get('nombreItem'));
            $nombreItem         = $request->get('nombreItem');
            $valor              = $request->get('valor');
            $descripcion        = $request->get('descripcion');

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
                    'archivo'           => $rutaArchivo[$i],
                    'descripcion'       => $descripcion[$i],
                    'aliado_id'         => $idAliado,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s'),
                );
                PresupuestoEmpresarial::insert($data);
            }
        }
        return redirect()->route('presupuestos_empresariales.index', $aliado->proyecto->id)
            ->with('status', 'El presupuesto empresarial ha sido creado con éxito.');
    }

    public function show($idProyecto, $idPresupuesto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        $presupuesto  = PresupuestoEmpresarial::findOrFail($idPresupuesto);
        return view('panel_administracion.proyectos.planeacion.presupuestos_empresariales.ver', compact('proyecto', 'presupuesto'));
    }

    public function edit($id, $idPresupuesto) {
        $proyecto       = Proyecto::findOrFail($id);
        $presupuestoEmpresarial    = PresupuestoEmpresarial::findOrFail($idPresupuesto);

        return view('panel_administracion.proyectos.planeacion.presupuestos_empresariales.editar', compact('proyecto', 'presupuestoEmpresarial'));
    }

    public function update(PresupuestoRequest $request, $id, $idPresupuesto) {
        $proyecto                 = Proyecto::findOrFail($id);
        $presupuestoEmpresarial   = PresupuestoEmpresarial::findOrFail($idPresupuesto);

        $presupuestoEmpresarial->nombreItem                    = $request->get('nombreItem');
        $presupuestoEmpresarial->valor                         = $request->get('valor');
        $presupuestoEmpresarial->descripcion                   = $request->get('descripcion');
        if ($request->hasFile('archivo')) {
            $rutaArchivo  = Storage::putFile(
                'presupuesto-archivos', $request->file('archivo')
            );
            $presupuestoEmpresarial->archivo   = $rutaArchivo;
        }

        $presupuestoEmpresarial->save();

        return redirect()->route('presupuestos_empresariales.index', $presupuestoEmpresarial->aliado->proyecto->id)
            ->with('status', 'El presupuesto empresarial ha sido modificado con éxito.');
    }

    public function destroy(Request $request, $idProyecto, $idPresupuesto)
    {
        $presupuestoEmpresarial = PresupuestoEmpresarial::findOrFail($idPresupuesto);

        $presupuestoEmpresarial->destroy($idPresupuesto);

        return redirect()->route('presupuestos_empresariales.index', $presupuestoEmpresarial->aliado->proyecto->id)
            ->with('status', 'El presupuesto empresarial ha sido eliminado con éxito.');
    }

    public function descargarCartaPresupuesto($id)
    {
        $presupuestoEmpresarial    = PresupuestoEmpresarial::findOrFail($id);

        $pathToFile     = storage_path("app/{$presupuestoEmpresarial->archivo}");
        if (file_exists($pathToFile) && $presupuestoEmpresarial->archivo !== null) {
            $extension      = '.'.pathinfo($pathToFile)['extension'];
            $nombreArchivo  = $presupuestoEmpresarial->nombreItem.$extension;

            return response()->download($pathToFile, $nombreArchivo);
        }

        return redirect()->back()->with('status-danger', 'El archivo no existe');
    }
}
