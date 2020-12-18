<?php

namespace App\Http\Controllers;

use App\Models\Aliado;
use App\Models\Proyecto;

use App\Http\Requests\PresupuestoRequest;
use App\Http\Requests\AliadoRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;


class AliadoController extends Controller
{
    public function index($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        return view('panel_administracion.proyectos.planeacion.aliados_empresariales.listar', compact('proyecto'));
    }

    public function create($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        return view('panel_administracion.proyectos.planeacion.aliados_empresariales.crear', compact('proyecto'));
    }

    public function store(AliadoRequest $request, $idProyecto)
    {
        // ENTIDAD ALIADA
        // **************
        $proyecto = Proyecto::findOrFail($idProyecto);

        $entidadAliada = new Aliado();
        $entidadAliada->nombreAliado                    = $request->get('nombreAliado_Externo');
        $entidadAliada->nit                             = $request->get('nitAliado_Externo');
        $entidadAliada->nombre                          = $request->get('nombreContactoAliado_Externo');
        $entidadAliada->celular                         = $request->get('celularContactoAliado_Externo');
        $entidadAliada->email                           = $request->get('emailContactoAliado_Externo');
        $entidadAliada->convenio                        = $request->file('convenioContactoAliado_Externo');
        $entidadAliada->recursosEspecie                 = $request->get('recursosEspecie_Externo');
        $entidadAliada->recursosDinero                  = $request->get('recursosDinero_Externo');
        $entidadAliada->ciudadesMunicipiosInfluencia    = $request->get('ciudadesMunicipios_Externo');

        if ($request->hasFile('convenioContactoAliado_Externo')) {
            $rutaArchivoInterno  = Storage::putFile(
                'cartas', $request->file('convenioContactoAliado_Externo')
            );

            $entidadAliada->convenio = $rutaArchivoInterno;
        }

        $entidadAliada->aliadoExterno = true;
        $entidadAliada->proyecto()->associate($proyecto->id);

        $entidadAliada->save();

        return redirect()->route('aliados.index', $entidadAliada->proyecto->id)
            ->with('status', 'El aliado empresarial ha sido creado con éxito');
    }

    public function show($idProyecto, $idAliado)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        $aliado  = Aliado::findOrFail($idAliado);
        return view('panel_administracion.proyectos.planeacion.aliados_empresariales.ver', compact('proyecto', 'aliado'));
    }

    public function edit($idProyecto, $idEntidadAliada)
    {
        $entidadAliada  = Aliado::findOrFail($idEntidadAliada);
        $proyecto       = Proyecto::findOrFail($idProyecto);

        return view('panel_administracion.proyectos.planeacion.aliados_empresariales.editar', compact('entidadAliada', 'proyecto'));
    }

    public function update(AliadoRequest $request, $idProyecto, $idEntidadAliada)
    {
        $proyecto       = Proyecto::findOrFail($idProyecto);

        // ENTIDAD ALIADA INTERNA
        // **************
        $entidadAliada = Aliado::findOrFail($idEntidadAliada);
        $entidadAliada->nombreAliado                    = $request->get('nombreAliado_Externo');
        $entidadAliada->nit                             = $request->get('nitAliado_Externo');
        $entidadAliada->nombre                          = $request->get('nombreContactoAliado_Externo');
        $entidadAliada->celular                         = $request->get('celularContactoAliado_Externo');
        $entidadAliada->email                           = $request->get('emailContactoAliado_Externo');
        $entidadAliada->recursosEspecie                 = $request->get('recursosEspecie_Externo');
        $entidadAliada->recursosDinero                  = $request->get('recursosDinero_Externo');
        $entidadAliada->ciudadesMunicipiosInfluencia    = $request->get('ciudadesMunicipios_Externo');

        if ($request->hasFile('convenioContactoAliado_Externo')) {
            Storage::delete($entidadAliada->convenio);
            $rutaArchivoInterno  = Storage::putFile(
                'cartas', $request->file('convenioContactoAliado_Externo')
            );

            $entidadAliada->convenio = $rutaArchivoInterno;
        }
        $entidadAliada->save();

        return redirect()->route('aliados.index', $entidadAliada->proyecto->id)
            ->with('status', 'El aliado empresarial ha sido modificado con éxito');
    }

    public function destroy($idProyecto, $idEntidadAliada) {
        $proyecto = Proyecto::findOrFail($idProyecto);

        $entidadAliada = Aliado::findOrFail($idEntidadAliada);
        Storage::delete($entidadAliada->convenio);
        Aliado::destroy($idEntidadAliada);

        return redirect()->route('aliados.index', $entidadAliada->proyecto->id)
            ->with('status', 'El aliado empresarial ha sido eliminado con éxito');
    }

    public function descargarCartaConvenio($id)
    {
        $entidadAliada = Aliado::findOrFail($id);

        $pathToFile     = storage_path("app/{$entidadAliada->convenio}");
        if (file_exists($pathToFile)) {
            $extension      = '.'.pathinfo($pathToFile)['extension'];
            $nombreArchivo  = $entidadAliada->nombreAliado.$extension;

            return response()->download($pathToFile, $nombreArchivo);
        }

        return redirect()->back()->with('status-danger', 'El archivo no existe');
    }
}
