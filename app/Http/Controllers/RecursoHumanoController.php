<?php

namespace App\Http\Controllers;

use App\Models\RecursoHumano;
use App\Models\Proyecto;

use App\Http\Requests\RecursoHumanoRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class RecursoHumanoController extends Controller
{
    public function index($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        return view('panel_administracion.proyectos.planeacion.recursos_humanos.listar', compact('proyecto'));
    }

    public function create($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        return view('panel_administracion.proyectos.planeacion.recursos_humanos.crear', compact('proyecto'));
    }

    public function store(RecursoHumanoRequest $request, $idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        if ( $request->has('opcionPersonalInterno') && $request->has('cantidadPersonalInterno') ) {

            $countPersonalInterno       = count($request->get('personalInternoNombre'));
            $personalInternoNombre      = $request->get('personalInternoNombre');
            $personalInternoDocumento   = $request->get('personalInternoDocumento');

            for($i = 0; $i < $countPersonalInterno; $i++) {
                $data = array(
                    'nombrePersonal'            => $personalInternoNombre[$i],
                    'numeroDocumentoPersonal'   => $personalInternoDocumento[$i],
                    'proyecto_id'               => $idProyecto,
                    'personalInterno'           => true,
                    'created_at'                => date('Y-m-d H:i:s'),
                    'updated_at'                => date('Y-m-d H:i:s'),
                );

                $insertDataInterno[] = $data;
            }

            RecursoHumano::insert($insertDataInterno);
        }

        if ( $request->get('opcionPersonalInstructor') && $request->has('cantidadPersonalInstructor') ) {

            $countPersonalInstructor        = count($request->get('personalInstructorNombre'));
            $personalInstructorNombre       = $request->get('personalInstructorNombre');
            $personalInstructorDocumento    = $request->get('personalInstructorDocumento');
            $personalInstructorCarta        = $request->file('personalInstructorCarta');

            foreach($personalInstructorCarta as $file) {
                $rutaArchivoInstructor[]  = Storage::putFile(
                    'cartas', $file
                );
            }

            for($i = 0; $i < $countPersonalInstructor; $i++) {
                $data = array(
                    'nombrePersonal'            => $personalInstructorNombre[$i],
                    'numeroDocumentoPersonal'   => $personalInstructorDocumento[$i],
                    'cartaCompromisoInstructor' => $rutaArchivoInstructor[$i],
                    'proyecto_id'               => $idProyecto,
                    'personalInstructor'        => true,
                );

                $insertDataInstructor[] = $data;
            }

            RecursoHumano::insert($insertDataInstructor);
        }

        return redirect()->route('recursos_humanos.index', $idProyecto)
            ->with('status', 'El personal ha sido creado con éxito');
    }

    public function show($idProyecto, $idRecursoHumano)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        $recursoHumano  = RecursoHumano::findOrFail($idRecursoHumano);
        return view('panel_administracion.proyectos.planeacion.recursos_humanos.ver', compact('proyecto', 'recursoHumano'));
    }

    public function edit($idProyecto, $idRecursoHumano)
    {
        $recursoHumano  = RecursoHumano::findOrFail($idRecursoHumano);
        $proyecto       = Proyecto::findOrFail($idProyecto);
        return view('panel_administracion.proyectos.planeacion.recursos_humanos.editar', compact('proyecto', 'recursoHumano'));
    }

    public function update(RecursoHumanoRequest $request, $idProyecto, $idRecursoHumano)
    {
        // RECURSOS HUMANOS
        // ****************
        $recursoHumano          = RecursoHumano::findOrFail($idRecursoHumano);

        $recursoHumano->nombrePersonal              = $request->get('personalNombre');
        $recursoHumano->numeroDocumentoPersonal     = $request->get('personalNumeroDocumento');


        if ($request->hasFile('personalInstructorCarta')) {
            Storage::delete($recursoHumano->cartaCompromisoInstructor);
            $rutaArchivoInstructor  = Storage::putFile(
                'cartas', $request->file('personalInstructorCarta')
            );
            $recursoHumano->cartaCompromisoInstructor   = $rutaArchivoInstructor;
        }

        $recursoHumano->save();

        return redirect()->route('recursos_humanos.index', $recursoHumano->proyecto->id)
            ->with('status', 'El personal ha sido modificado con éxito');
    }

    public function destroy($idProyecto, $idRecursoHumano)
    {
        $recursoHumano  = RecursoHumano::findOrFail($idRecursoHumano);
        Storage::delete($recursoHumano->cartaCompromisoInstructor);
        $recursoHumano->destroy($idRecursoHumano);

        return redirect()->route('recursos_humanos.index', $recursoHumano->proyecto->id)
            ->with('status', 'El personal ha sido eliminado con éxito');
    }

    public function descargarCartaCompromiso($id)
    {
        $instructor    = RecursoHumano::findOrFail($id);

        $pathToFile     = storage_path("app/{$instructor->cartaCompromisoInstructor}");
        if (file_exists($pathToFile)) {
            $extension      = '.'.pathinfo($pathToFile)['extension'];
            $nombreArchivo  = $instructor->nombrePersonal.$extension;

            return response()->download($pathToFile, $nombreArchivo);
        }
        
        return redirect()->back()->with('status-danger', 'El archivo no existe');
    }
}
