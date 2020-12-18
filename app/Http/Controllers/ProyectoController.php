<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gruplac;
use App\Models\Proyecto;
use App\Models\Contador;
use App\Models\Semillero;
use App\Models\Evaluacion;
use App\Models\Convocatoria;
use App\Models\AreaConocimiento;
use App\Models\ProgramaFormacion;
use App\Models\ObjetivoEspecifico;
use App\Models\GrupoInvestigacion;
use App\Models\LineaInvestigacion;

use App\Notifications\ProyectoFormulado;
use App\Notifications\RecordatorioVencimientoConvocatoria;
use Notification;

use App\Http\Requests\ProyectoRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use Dompdf\Dompdf;
use App;
use View;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos      = Proyecto::orderBy('created_at', 'desc')->get();
        $convocatoria   = Convocatoria::orderBy('fecha_inicio', 'desc')->first();

        return view('panel_administracion.proyectos.listar', compact('proyectos', 'convocatoria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Proyecto $proyecto)
    {
        $autores                = User::all();
        $gruplac                = Gruplac::all();
        $semilleros             = Semillero::all();
        $gruposInvestigacion    = GrupoInvestigacion::all();
        $lineasInvestigacion    = LineaInvestigacion::all();
        $areasConocimiento      = AreaConocimiento::orderBy('nombre')->get();
        $programasFormacion     = ProgramaFormacion::orderBy('nombre')->get();
        return view('panel_administracion.proyectos.crear', compact('gruposInvestigacion', 'programasFormacion', 'autores', 'semilleros', 'areasConocimiento', 'gruplac', 'lineasInvestigacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProyectoRequest $request)
    {
        $usuario = Auth::user();

        foreach ($usuario->roles as $key => $rol) {
            $nombreRol = $rol->nombre;
        }

        $proyecto_contador = Contador::firstOrCreate(['ano' => now()->year])->proyecto_contador;
        Contador::where('ano', now()->year)->increment('proyecto_contador');

        $proyecto = new Proyecto();

        $proyecto->codigo                   = 'SIPRO-'. str_pad($proyecto_contador, 5, '0', STR_PAD_LEFT) .'-'.now()->year;
        $proyecto->titulo                   = $request->get('titulo');
        $proyecto->tipoProyecto             = $request->get('tipoProyecto');
        $proyecto->vinculacionAutor         = $nombreRol;

        // INFORMACIÓN PRINCIPAL DEL PROYECTO
        // **********************************
        $proyecto->areaConocimiento1                 = $request->get('areaConocimiento1');
        $proyecto->areaConocimiento2                 = $request->get('areaConocimiento2');
        $proyecto->antecedentesJustificacionProyecto = $request->get('antecedentesJustificacionProyecto');
        $proyecto->planteamientoProblema             = $request->get('planteamientoProblema');
        $proyecto->metodologia                       = $request->get('metodologia');
        $proyecto->objetivoGeneral                   = $request->get('objetivoGeneral');
        $proyecto->fechaInicioProyecto               = $request->get('fechaInicioProyecto');
        $proyecto->fechaFinProyecto                  = $request->get('fechaFinProyecto');
        $proyecto->codigoGruplac                     = $request->get('codigoGruplac');
        $proyecto->impactoSocial                     = $request->get('impactoSocial');
        $proyecto->impactoEconomico                  = $request->get('impactoEconomico');
        $proyecto->impactoTecnologico                = $request->get('impactoTecnologico');
        $proyecto->impactoAmbiental                  = $request->get('impactoAmbiental');

        if ($request->has('aplicacionPosconflictoSi')) {
            $proyecto->aplicacionPosconflicto            = $request->get('aplicacionPosconflictoSi');
        } else {
            $proyecto->aplicacionPosconflicto            = $request->get('aplicacionPosconflictoNo');
        }
        $proyecto->municipiosAImpactar               = $request->get('municipiosAImpactar');
        $proyecto->descripcionEstrategia             = $request->get('descripcionEstrategia');
        $proyecto->recursosPosconflicto              = $request->get('recursosPosconflicto');

        $proyecto->modificado               = false;
        $proyecto->evaluado                 = false;
        $proyecto->grupo_investigacion_id   = $request->get('grupoInvestigacion'); // GRINDDA id
        $proyecto->centro_formacion_id      = 1;

        $proyecto->save();

        // AUTORES DEL PROYECTO
        // ********************

        $autores = $request->get('nombreAutor');
        $proyecto->autores()->attach($autores);

        $proyecto->autores()->attach($usuario->id);

        // OBJETIVOS ESPECÍFICOS
        // ********************
        if ( $request->get('objetivoEspecifico') ) {
            foreach(array_filter($request->get('objetivoEspecifico')) as $objetivoEspecificoDescripcion) {
                $proyecto->objetivosEspecificos()->create(['descripcion' => $objetivoEspecificoDescripcion]);
            }
        }

        // LINEAS DE INVESTIGACIÓN
        // ********************

        $lineasInvestigacion = $request->get('lineasInvestigacion');
        $proyecto->lineasInvestigacion()->attach($lineasInvestigacion);

        // PROGRAMAS DE FORMACIÓN BENEFICIADOS
        // ********************

        $programasFormacion = $request->get('programaFormacion');
        $proyecto->programasFormacion()->attach($programasFormacion);

        // SEMILLEROS BENEFICIADOS
        // ********************

        $semilleros = $request->get('semillero');
        $proyecto->semilleros()->attach($semilleros);

        return redirect()->route('resultados.show', [$proyecto->id, $proyecto->objetivosEspecificos->first()->id])
            ->with('status', 'El proyecto ha sido creado con éxito. Ahora debes generar la planeación');
    }

    /**
     * PLANEACIÓN
     * Eliminar
     */
    public function indexPlaneacion($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('panel_administracion.proyectos.planeacion.index', compact('id', 'proyecto'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $gruplac                = Gruplac::all();
        $semilleros             = Semillero::all();
        $areasConocimiento      = AreaConocimiento::orderBy('nombre')->get();
        $programasFormacion     = ProgramaFormacion::orderBy('nombre')->get();
        $lineasInvestigacion    = LineaInvestigacion::all();
        $gruposInvestigacion    = GrupoInvestigacion::all();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProyectoRequest $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->titulo                   = $request->get('titulo');
        $proyecto->tipoProyecto             = $request->get('tipoProyecto');

        // INFORMACIÓN PRINCIPAL DEL PROYECTO
        // **********************************
        $proyecto->areaConocimiento1                     = $request->get('areaConocimiento1');
        $proyecto->areaConocimiento2                     = $request->get('areaConocimiento2');
        $proyecto->antecedentesJustificacionProyecto     = $request->get('antecedentesJustificacionProyecto');
        $proyecto->planteamientoProblema                 = $request->get('planteamientoProblema');
        $proyecto->metodologia                           = $request->get('metodologia');
        $proyecto->objetivoGeneral                       = $request->get('objetivoGeneral');
        $proyecto->fechaInicioProyecto                   = $request->get('fechaInicioProyecto');
        $proyecto->fechaFinProyecto                      = $request->get('fechaFinProyecto');

        $proyecto->codigoGruplac                         = $request->get('codigoGruplac');
        $proyecto->impactoSocial                         = $request->get('impactoSocial');
        $proyecto->impactoEconomico                      = $request->get('impactoEconomico');
        $proyecto->impactoTecnologico                    = $request->get('impactoTecnologico');
        $proyecto->impactoAmbiental                      = $request->get('impactoAmbiental');

        if ($request->has('aplicacionPosconflictoSi')) {
            $proyecto->aplicacionPosconflicto            = $request->get('aplicacionPosconflictoSi');
            $proyecto->municipiosAImpactar               = $request->get('municipiosAImpactar');
            $proyecto->descripcionEstrategia             = $request->get('descripcionEstrategia');
            $proyecto->recursosPosconflicto              = $request->get('recursosPosconflicto');
        } else {
            $proyecto->aplicacionPosconflicto            = $request->get('aplicacionPosconflictoNo');
        }

        $proyecto->grupo_investigacion_id                = $request->get('grupoInvestigacion'); // GRINDDA id

        $proyecto->save();

        // LINEAS DE INVESTIGACIÓN
        // ********************

        $lineasInvestigacion = $request->get('lineasInvestigacion');
        $proyecto->lineasInvestigacion()->sync($lineasInvestigacion);

        // PROGRAMAS DE FORMACIÓN BENEFICIADOS
        // ********************

        $programasFormacion = $request->get('programaFormacion');
        $proyecto->programasFormacion()->sync($programasFormacion);

        // SEMILLEROS BENEFICIADOS
        // ********************

        $semilleros = $request->get('semillero');
        $proyecto->semilleros()->sync($semilleros);

        // CO-AUTORES
        // ********************

        $autores = $request->get('nombreAutor');
        $proyecto->autores()->sync($autores);

        // Actualizar los objetivos especificos
        $objetivosEspecificos = array_combine($request->get('idObjetivoEspecifico'), $request->get('objetivoEspecifico'));
        foreach ($objetivosEspecificos as $ids => $descripcion) {
            $proyecto->objetivosEspecificos()->where('id', $ids)->update(
                ['descripcion' => $descripcion]
            );
        }

        // Crear el cuarto objetivo específico
        if ($request->has('objetivoEspecifico4') && $proyecto->objetivosEspecificos()->count() < 4) {
            $objetivoEspecifico4Descripcion = $request->get('objetivoEspecifico4');
            $proyecto->objetivosEspecificos()->create(['descripcion' => $objetivoEspecifico4Descripcion]);
        }

        return redirect()->route('resultados.show', [$proyecto->id, $proyecto->objetivosEspecificos->first()->id])
            ->with('status', 'El proyecto ha sido modificado con éxito. Ahora debes generar la planeación');

    }

    public function guardarEstado(Request $request, $idProyecto)
    {
        $estado     = $request->get('estado');
        $porcentaje = $request->get('porcentaje');
        $proyecto   = Proyecto::findOrFail($idProyecto);
        $proyecto->estado = $porcentaje;
        $proyecto->save();

        return redirect()->route('proyectos.grupoInvestigacion', 'GRINDDA')
            ->with("status", "Al proyecto se le ha asignado el estado {$estado}.");
    }

    public function modificarObjetivoEspecifico(Request $request)
    {
        $idObjetivoEspecifico               = $request->get('idObjetivoEspecifico');
        $objetivoEspecifico                 = ObjetivoEspecifico::findOrFail($idObjetivoEspecifico);
        $objetivoEspecifico->descripcion    = $request->get('objetivoEspecifico');
        if($objetivoEspecifico->save()) {
            return 'guardado';
        }
    }

    public function eliminarObjetivoEspecifico($idObjetivoEspecifico)
    {
        $objetivoEspecifico = ObjetivoEspecifico::findOrFail($idObjetivoEspecifico);
        ObjetivoEspecifico::destroy($idObjetivoEspecifico);

        return redirect()->route('resultados.show', [$objetivoEspecifico->proyecto->id, $objetivoEspecifico->proyecto->objetivosEspecificos->first()->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        Proyecto::destroy($id);

        return redirect()->route('proyectos.index')
            ->with('status', 'El proyecto ha sido eliminado con éxito.');
    }

    public function obtenerRecomendacion($id)
    {
        return $recomendacion = Evaluacion::where('proyecto_id', $id)->get();
    }

    public function listarProyectosGrupoInvestigacion($nombreGrupoInvestigacion)
    {
        $grupoInvestigacion = GrupoInvestigacion::where('nombre', $nombreGrupoInvestigacion)->orderBy('created_at', 'desc')->firstOrFail();
        return view('panel_administracion.proyectos.grupo_investigacion', compact('grupoInvestigacion'));
    }

    public function listarSemilleros($nombre = null)
    {
        $semilleros = Semillero::all();
        return view('panel_administracion.proyectos.semillero', compact('semilleros'));
    }

    public function listarProyectosFormativos()
    {
        $proyectos = Proyecto::where('tipoProyecto', 'Proyecto formativo')->get();
        return view('panel_administracion.proyectos.proyecto_formativo', compact('proyectos'));
    }

    public function mostrarProyectosSemilleros($nombre = null)
    {
        $semillero = Semillero::proyectoSemillero($nombre)->firstOrFail();
        return view('panel_administracion.proyectos.semillero_proyecto', compact('semillero'));
    }

    public function listarProyectosPriorizados()
    {
        $proyectosPriorizados = Proyecto::proyectosPriorizados()->get();
        return view('panel_administracion.proyectos.priorizados', compact('proyectosPriorizados'));
    }

    public function pdf($idProyecto)
    {
    	$proyecto   = Proyecto::findOrFail($idProyecto);

        $dompdf     = new Dompdf();

        $view       = View::make('panel_administracion.proyectos.pdf', compact('proyecto'))->render();
        $dompdf     = App::make('dompdf.wrapper');

    	$dompdf->loadHTML($view);

    	return $dompdf->stream('proyecto.pdf');
    }

    public function enviarProyectoAEvaluacion($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->enviado = true;
        $proyecto->save();

        $usuario = Auth::user();

        foreach ($usuario->roles->first()->usuarioNotificacion as $key => $value) {
            $usuariosArray[] = $key;
        }

        $admins = User::whereHas('roles', function ($query) use ($usuariosArray) {
                $query->whereIn('roles.slug', $usuariosArray);
            })->get();

        Notification::send($admins , new ProyectoFormulado($proyecto, $usuario));

        return redirect()->route('proyectos.index')
            ->with('status', "El proyecto ha sido enviado a evaluación");
    }

    public function enviarCorrecionProyecto($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->modificado   = true;
        $proyecto->enviado      = true;
        $proyecto->save();

        $usuario = Auth::user();

        foreach ($usuario->roles->first()->usuarioNotificacion as $key => $value) {
            $usuariosArray[] = $key;
        }

        $admins = User::whereHas('roles', function ($query) use ($usuariosArray) {
                $query->whereIn('roles.slug', $usuariosArray);
            })->get();

        Notification::send($admins , new ProyectoFormulado($proyecto, $usuario));

        return redirect()->route('proyectos.index')
            ->with('status', "El proyecto ha sido enviado a evaluación");
    }
}
