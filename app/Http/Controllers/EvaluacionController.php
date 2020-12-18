<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Criterio;
use App\Models\Evaluacion;
use App\Models\Presupuesto;
use App\Models\Subcriterio;
use App\Models\CriterioEvaluacion;
use App\Models\SubcriterioEvaluacion;

use App\Notifications\ProyectoEvaluado;
use Notification;

use App\Http\Requests\EvaluacionFinalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EvaluacionController extends Controller
{
    public function formularioEvaluacion($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        return view('panel_administracion.proyectos.evaluacion.evaluar', compact('proyecto'));
    }

    public function guardarEvaluacion(Request $request, $idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        $recomendacionTitulo                = $request->get('recomendacionTitulo');
        $recomendacionLineasInvestigacion   = $request->get('recomendacionLineasInvestigacion');
        $recomendacionJustificacion         = $request->get('recomendacionJustificacion');
        $recomendacionProblema              = $request->get('recomendacionProblema');
        $recomendacionMetodologia           = $request->get('recomendacionMetodologia');
        $recomendacionObjetivoGeneral       = $request->get('recomendacionObjetivoGeneral');
        $recomendacionObjetivoEspecifico1   = $request->get('recomendacionObjetivoEspecifico1');
        $recomendacionObjetivoEspecifico2   = $request->get('recomendacionObjetivoEspecifico2');
        $recomendacionObjetivoEspecifico3   = $request->get('recomendacionObjetivoEspecifico3');
        $recomendacionObjetivoEspecifico4   = $request->get('recomendacionObjetivoEspecifico4');
        $recomendacionSemilleros            = $request->get('recomendacionSemilleros');
        $recomendacionProgramasFormacion    = $request->get('recomendacionProgramasFormacion');
        $recomendacionImpactoAmbiental      = $request->get('recomendacionImpactoAmbiental');
        $recomendacionImpactoSocial         = $request->get('recomendacionImpactoSocial');
        $recomendacionImpactoEconomico      = $request->get('recomendacionImpactoEconomico');
        $recomendacionImpactoTecnologico    = $request->get('recomendacionImpactoTecnologico');
        $recomendacionPosconflicto          = $request->get('recomendacionPosconflicto');

        // 2da Evaluación
        $cumplimientoTitulo                = $request->get('cumplimientoTitulo');
        $cumplimientoLineasInvestigacion   = $request->get('cumplimientoLineasInvestigacion');
        $cumplimientoJustificacion         = $request->get('cumplimientoJustificacion');
        $cumplimientoProblema              = $request->get('cumplimientoProblema');
        $cumplimientoMetodologia           = $request->get('cumplimientoMetodologia');
        $cumplimientoObjetivoGeneral       = $request->get('cumplimientoObjetivoGeneral');
        $cumplimientoObjetivoEspecifico1   = $request->get('cumplimientoObjetivoEspecifico1');
        $cumplimientoObjetivoEspecifico2   = $request->get('cumplimientoObjetivoEspecifico2');
        $cumplimientoObjetivoEspecifico3   = $request->get('cumplimientoObjetivoEspecifico3');
        $cumplimientoObjetivoEspecifico4   = $request->get('cumplimientoObjetivoEspecifico4');
        $cumplimientoSemilleros            = $request->get('cumplimientoSemilleros');
        $cumplimientoProgramasFormacion    = $request->get('cumplimientoProgramasFormacion');
        $cumplimientoImpactoSocial         = $request->get('cumplimientoImpactoSocial');
        $cumplimientoImpactoAmbiental      = $request->get('cumplimientoImpactoAmbiental');
        $cumplimientoImpactoEconomico      = $request->get('cumplimientoImpactoEconomico');
        $cumplimientoImpactoTecnologico    = $request->get('cumplimientoImpactoTecnologico');
        $cumplimientoPosconflicto          = $request->get('cumplimientoPosconflicto');

        if ($recomendacionTitulo != null || $cumplimientoTitulo != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'titulo',
                ],
                [
                    'recomendacion' => $recomendacionTitulo,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoTitulo,
                ]);
        }

        if ($recomendacionLineasInvestigacion != null || $cumplimientoLineasInvestigacion != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'lineasInvestigacion',
                ],
                [
                    'recomendacion' => $recomendacionLineasInvestigacion,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoLineasInvestigacion,
                ]);
        }

        if ($recomendacionJustificacion != null || $cumplimientoJustificacion != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'antecedentesJustificacionProyecto',
                ],
                [
                    'recomendacion' => $recomendacionJustificacion,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoJustificacion,
                ]);
        }

        if ($recomendacionProblema != null || $cumplimientoProblema != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'problema',
                ],
                [
                    'recomendacion' => $recomendacionProblema,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoProblema,
                ]);
        }

        if ($recomendacionMetodologia != null || $cumplimientoMetodologia != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'metodologia',
                ],
                [
                    'recomendacion' => $recomendacionMetodologia,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoMetodologia,
                ]);
        }

        if ($recomendacionObjetivoGeneral != null || $cumplimientoObjetivoGeneral != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'objetivoGeneral',
                ],
                [
                    'recomendacion' => $recomendacionObjetivoGeneral,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoObjetivoGeneral,
                ]);
        }

        if ($recomendacionObjetivoEspecifico1 != null || $cumplimientoObjetivoEspecifico1 != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'               => $idProyecto,
                    'objetivo_especifico_id'    => $request->get('idObjetivoEspecifico1'),
                    'itemAEvaluar'              => 'objetivoEspecifico1',
                ],
                [
                    'recomendacion' => $recomendacionObjetivoEspecifico1,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoObjetivoEspecifico1,
                ]);
        }

        if ($recomendacionObjetivoEspecifico2 != null || $cumplimientoObjetivoEspecifico2 != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'               => $idProyecto,
                    'objetivo_especifico_id'    => $request->get('idObjetivoEspecifico2'),
                    'itemAEvaluar'              => 'objetivoEspecifico2',
                ],
                [
                    'recomendacion' => $recomendacionObjetivoEspecifico2,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoObjetivoEspecifico2,
                ]);
        }

        if ($recomendacionObjetivoEspecifico3 != null || $cumplimientoObjetivoEspecifico3 != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'               => $idProyecto,
                    'objetivo_especifico_id'    => $request->get('idObjetivoEspecifico3'),
                    'itemAEvaluar'              => 'objetivoEspecifico3',
                ],
                [
                    'recomendacion' => $recomendacionObjetivoEspecifico3,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoObjetivoEspecifico3,
                ]);
        }

        if ($recomendacionObjetivoEspecifico4 != null || $cumplimientoObjetivoEspecifico4 != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'               => $idProyecto,
                    'objetivo_especifico_id'    => $request->get('idObjetivoEspecifico4'),
                    'itemAEvaluar'              => 'objetivoEspecifico4',
                ],
                [
                    'recomendacion' => $recomendacionObjetivoEspecifico4,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoObjetivoEspecifico4,
                ]);
        }

        if ($recomendacionSemilleros != null || $cumplimientoSemilleros != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'semilleros',
                ],
                [
                    'recomendacion' => $recomendacionSemilleros,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoSemilleros,
                ]);
        }

        if ($recomendacionProgramasFormacion != null || $cumplimientoProgramasFormacion != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'programasFormacion',
                ],
                [
                    'recomendacion' => $recomendacionProgramasFormacion,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoProgramasFormacion,
                ]);
        }

        if ($recomendacionImpactoAmbiental != null || $cumplimientoImpactoAmbiental != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'impactoAmbiental',
                ],
                [
                    'recomendacion' => $recomendacionImpactoAmbiental,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoImpactoAmbiental,
                ]);
        }

        if ($recomendacionImpactoSocial != null || $cumplimientoImpactoSocial != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'impactoSocial',
                ],
                [
                    'recomendacion' => $recomendacionImpactoSocial,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoImpactoSocial,
                ]);
        }

        if ($recomendacionImpactoEconomico != null || $cumplimientoImpactoEconomico != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'impactoEconomico',
                ],
                [
                    'recomendacion' => $recomendacionImpactoEconomico,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoImpactoEconomico,
                ]);
        }

        if ($recomendacionImpactoTecnologico != null || $cumplimientoImpactoTecnologico != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'impactoTecnologico',
                ],
                [
                    'recomendacion' => $recomendacionImpactoTecnologico,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoImpactoTecnologico,
                ]);
        }

        if ($recomendacionPosconflicto != null || $cumplimientoPosconflicto != null) {
            Evaluacion::updateOrCreate(
                [
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'posconflicto',
                ],
                [
                    'recomendacion' => $recomendacionPosconflicto,
                    'evaluacionInformacion' => true,
                    'cumplimiento' => $cumplimientoPosconflicto,
                ]);
        }

        return redirect()->route('evaluacion.evaluarResultados', $idProyecto)->with('status', "La información básica del proyecto ha sido evaluada con éxito");
    }

    public function formularioEvaluacionResultado($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        return view('panel_administracion.proyectos.evaluacion.evaluar_resultado', compact('proyecto'));
    }

    public function guardarEvaluacionResultado(Request $request, $idProyecto)
    {
        if($request->has('recomendacionResultado')) {
            $recomendacionesResultado   = $request->get('recomendacionResultado');
            $cumplimientoResultado      = $request->get('cumplimientoResultado');
            $idResultado                = $request->get('idResultado');

            Evaluacion::updateOrCreate(
                [
                    'resultado_id'  => $idResultado,
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'resultado',
                ],
                [
                    'recomendacion' => $recomendacionesResultado,
                    'cumplimiento'  => $cumplimientoResultado,
                ]);

            return 'guardado';
        }
        // return redirect()->route('evaluacion.evaluarProductos', $idProyecto)->with('status', "Los resultados del proyecto han sido evaluados con éxito");
    }

    public function formularioEvaluacionProducto($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        return view('panel_administracion.proyectos.evaluacion.evaluar_producto', compact('proyecto'));
    }

    public function guardarEvaluacionProducto(Request $request, $idProyecto)
    {
        if($request->has('recomendacionProducto')) {
            $recomendacionesProductos   = $request->get('recomendacionProducto');
            $cumplimientoProducto       = $request->get('cumplimientoProducto');
            $idProducto                 = $request->get('idProducto');

            Evaluacion::updateOrCreate(
                [
                    'producto_id'   => $idProducto,
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'producto',
                ],
                [
                    'recomendacion' => $recomendacionesProductos,
                    'cumplimiento'  => $cumplimientoProducto,
                ]);

                return 'guardado';

        }
        // return redirect()->route('evaluacion.evaluarActividades', $idProyecto)->with('status', "Los productos del proyecto han sido evaluados con éxito");
    }

    public function formularioEvaluacionActividad($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        return view('panel_administracion.proyectos.evaluacion.evaluar_actividad', compact('proyecto'));
    }

    public function guardarEvaluacionActividad(Request $request, $idProyecto)
    {
        if($request->has('recomendacionActividad')) {
            $recomendacionActividad   = $request->get('recomendacionActividad');
            $idActividad              = $request->get('idActividad');
            $cumplimientoActividad    = $request->get('cumplimientoActividad');

            Evaluacion::updateOrCreate(
                [
                    'actividad_id'  => $idActividad,
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'actividad',
                ],
                [
                    'recomendacion' => $recomendacionActividad,
                    'cumplimiento'  => $cumplimientoActividad,
                ]);

                return 'guardado';
        }

        // return redirect()->route('evaluacion.evaluarAliados', $idProyecto)->with('status', "Las actividades del proyecto han sido evaluadas con éxito");
    }

    public function formularioEvaluacionAliado($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        return view('panel_administracion.proyectos.evaluacion.evaluar_aliado', compact('proyecto'));
    }

    public function guardarEvaluacionAliado(Request $request, $idProyecto)
    {
        if($request->has('recomendacionAliado')) {
            $recomendacionesAliado  = $request->get('recomendacionAliado');
            $cumplimientoAliado     = $request->get('cumplimientoAliado');
            $idAliado               = $request->get('idAliado');

            Evaluacion::updateOrCreate(
                [
                    'aliado_id'  => $idAliado,
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'aliado',
                ],
                [
                    'recomendacion' => $recomendacionesAliado,
                    'cumplimiento'  => $cumplimientoAliado,
                ]);

            return 'guardado';

        }
        // return redirect()->route('evaluacion.evaluarRecursosHumanos', $idProyecto)->with('status', "Los aliados del proyecto han sido evaluados con éxito");
    }

    public function formularioEvaluacionRecursoHumano($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        return view('panel_administracion.proyectos.evaluacion.evaluar_recurso_humano', compact('proyecto'));
    }

    public function guardarEvaluacionRecursoHumano(Request $request, $idProyecto)
    {
        if($request->has('recomendacionRecursoHumano')) {
            $recomendacionRecursoHumano     = $request->get('recomendacionRecursoHumano');
            $idRecursoHumano                = $request->get('idRecursoHumano');
            $cumplimientoRecursoHumano      = $request->get('cumplimientoRecursoHumano');

            Evaluacion::updateOrCreate(
                [
                    'recurso_humano_id'  => $idRecursoHumano,
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'personal',
                ],
                [
                    'recomendacion' => $recomendacionRecursoHumano,
                    'cumplimiento'  => $cumplimientoRecursoHumano,
                ]);

                return 'guardado';
        }
        // return redirect()->route('evaluacion.evaluarPresupuestoEmpresarial', $idProyecto)->with('status', "El personal del proyecto ha sido evaluado con éxito");
    }

    public function formularioEvaluacionPresupuestoEmpresarial($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        return view('panel_administracion.proyectos.evaluacion.evaluar_presupuesto_empresarial', compact('proyecto'));
    }

    public function guardarEvaluacionPresupuestoEmpresarial(Request $request, $idProyecto)
    {
        if($request->has('recomendacionPresupuestoEmpresarial')) {
            $recomendacionPresupuestoEmpresarial    = $request->get('recomendacionPresupuestoEmpresarial');
            $idPresupuestoEmpresarial               = $request->get('idPresupuestoEmpresarial');
            $cumplimientoPresupuestoEmpresarial     = $request->get('cumplimientoPresupuestoEmpresarial');

            Evaluacion::updateOrCreate(
                [
                    'presupuesto_empresarial_id'  => $idPresupuestoEmpresarial,
                    'proyecto_id'   => $idProyecto,
                    'itemAEvaluar'  => 'presupuestoEmpresarial',
                ],
                [
                    'recomendacion' => $recomendacionPresupuestoEmpresarial,
                    'cumplimiento'  => $cumplimientoPresupuestoEmpresarial,
                ]);

                return 'guardado';
        }
        // return redirect()->route('evaluacion.evaluarPresupuestoSENNOVA', $idProyecto)->with('status', "El presupuesto empresarial del proyecto ha sido evaluado con éxito");
    }

    public function formularioEvaluacionPresupuestoSENNOVA($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return view('panel_administracion.proyectos.evaluacion.evaluar_presupuesto_sennova', compact('proyecto'));
    }

    public function guardarEvaluacionPresupuestoSENNOVA(Request $request, $idProyecto)
    {
        if($request->has('recomendacionPresupuestoSENNOVA')) {
            $recomendacionesPresupuestoSENNOVA  = $request->get('recomendacionPresupuestoSENNOVA');
            $cumplimientoPresupuestoSennova     = $request->get('cumplimientoPresupuestoSennova');
            $idPresupuestoSENNOVA               = $request->get('idPresupuestoSENNOVA');

            Evaluacion::updateOrCreate(
                [
                    'presupuesto_id'    => $idPresupuestoSENNOVA,
                    'proyecto_id'       => $idProyecto,
                    'itemAEvaluar'      => 'presupuestoSennova',
                ],
                [
                    'recomendacion' => $recomendacionesPresupuestoSENNOVA,
                    'cumplimiento'  => $cumplimientoPresupuestoSennova,
                ]);

                return 'guardado';
        }
        // return redirect()->route('evaluacion.enviarEvaluacion', $idProyecto)->with('status', "El presupuesto SENNOVA del proyecto ha sido evaluado con éxito");
    }
    public function formularioEvaluacionPertinencia($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);
        return view('panel_administracion.proyectos.evaluacion.evaluar_pertinencia', compact('proyecto'));
    }

    public function guardarEvaluacionPertinencia(Request $request, $idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        $proyecto->nivelPertinencia = $request->get('nivelPertinencia');
        $proyecto->save();

        return redirect()->back()->with('status', "Se le ha asignado la pertinencia al proyecto con éxito");
    }

    public function formularioCriterioEvaluacion($idProyecto, $criterio)
    {
        $criterio       = Criterio::where('slug', $criterio)->firstOrFail();
        $criterios      = Criterio::all();
        $proyecto       = Proyecto::findOrFail($idProyecto);
        // $subcriterios = Subcriterio::all();
        return view('panel_administracion.proyectos.evaluacion.criterio', compact('proyecto', 'criterio', 'criterios'));
    }

    // public function guardarCriterioEvaluacion(Request $request, $idProyecto)
    // {
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Contrato de aprendizaje',
    //             'codigo'        => 'A1',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Contrato de aprendizaje interno miembro de semilleros del CPIC',
    //             'porcentaje'        => $request->has('contrato_aprendizaje_interno') ? $request->get('contrato_aprendizaje_interno'): 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Contrato de aprendizaje',
    //             'codigo'        => 'A2',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Contrato de aprendizaje interno no integrante de semilleros del CPIC',
    //             'porcentaje'        => $request->has('contrato_aprendizaje_no_integrante') ? $request->get('contrato_aprendizaje_no_integrante') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Contrato de aprendizaje',
    //             'codigo'        => 'A3',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Contrato de aprendizaje externo miembro de semilleros',
    //             'porcentaje'        => $request->has('contrato_aprendizaje_externo') ? $request->get('contrato_aprendizaje_externo') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Contrato de aprendizaje',
    //             'codigo'        => 'A4',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Contrato de aprendizaje externo no integrante de semilleros',
    //             'porcentaje'        => $request->has('contrato_aprendizaje_externo_no_integrante') ? $request->get('contrato_aprendizaje_externo_no_integrante') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Contratación de egresados',
    //             'codigo'        => 'B1',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Contrato por prestación de servicios recien egresado miembro de semilleros',
    //             'porcentaje'        => $request->has('contrato_servicios_recien_egresado') ? $request->get('contrato_servicios_recien_egresado') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Contratación de egresados',
    //             'codigo'        => 'B2',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Contrato prestación de servicios egresado con experiencia miembro de semilleros',
    //             'porcentaje'        => $request->has('contrato_servicios_egresado_experiencia') ? $request->get('contrato_servicios_egresado_experiencia') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Contratación de egresados',
    //             'codigo'        => 'B3',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Contrato de prestación de servicios egresado no perteneciente a semilleros',
    //             'porcentaje'        => $request->has('contrato_servicios_egresado_no_semilleros') ? $request->get('contrato_servicios_egresado_no_semilleros') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Vinculación de instructores',
    //             'codigo'        => 'C1',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Vinculación de instructores ejecutores',
    //             'porcentaje'        => $request->has('instructores_ejecutores') ? $request->get('instructores_ejecutores') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Vinculación de instructores',
    //             'codigo'        => 'C2',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Vinculación de instructores de apoyo',
    //             'porcentaje'        => $request->has('instructores_apoyo') ? $request->get('instructores_apoyo') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Vinculación con Tecnoparque y/o Tecnoacademias y Empresas del sector',
    //             'codigo'        => 'D1',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Articulación con Tecnoparque',
    //             'porcentaje'        => $request->has('articulacion_tecnoparque') ? $request->get('articulacion_tecnoparque') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Vinculación con Tecnoparque y/o Tecnoacademias y Empresas del sector',
    //             'codigo'        => 'D2',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Articulación con Tecnoacademias',
    //             'porcentaje'        => $request->has('articulacion_tecnoacademia') ? $request->get('articulacion_tecnoacademia') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Vinculación con Tecnoparque y/o Tecnoacademias y Empresas del sector',
    //             'codigo'        => 'D3',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Articulación con Empresas y/o Universidades',
    //             'porcentaje'        => $request->has('articulacion_empresas_universidades') ? $request->get('articulacion_empresas_universidades') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Pertinencia con la vocación del Centro de Formación y su sector empresarial',
    //             'codigo'        => 'E1',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'El proyecto pretende dar respuesta a necesidades específicas del Centro de Formación',
    //             'porcentaje'        => $request->has('necesidades_centro') ? $request->get('necesidades_centro') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Pertinencia con la vocación del Centro de Formación y su sector empresarial',
    //             'codigo'        => 'E2',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'El proyecto pretende dar respuesta a necesidades específicas del sector empresarial del Centro de Formación',
    //             'porcentaje'        => $request->has('necesidades_sector_empresarial') ? $request->get('necesidades_sector_empresarial') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Pertinencia con las líneas de investigación del grupo GRINDDA',
    //             'codigo'        => 'F1',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Articulación con 1 línea de investigación',
    //             'porcentaje'        => $request->has('una_linea_investigacion') ? $request->get('una_linea_investigacion') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Pertinencia con las líneas de investigación del grupo GRINDDA',
    //             'codigo'        => 'F2',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Articulación con 2 líneas de investigación',
    //             'porcentaje'        => $request->has('dos_lineas_investigacion') ? $request->get('dos_lineas_investigacion') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Pertinencia con las líneas de investigación del grupo GRINDDA',
    //             'codigo'        => 'F3',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Articulación con más de 2 líneas de investigación',
    //             'porcentaje'        => $request->has('mas_lineas_investigacion') ? $request->get('mas_lineas_investigacion') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Producción y Resultados esperados',
    //             'codigo'        => 'G1',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Patentes',
    //             'porcentaje'        => $request->has('patentes') ? $request->get('patentes') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Producción y Resultados esperados',
    //             'codigo'        => 'G2',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Publicación individual',
    //             'porcentaje'        => $request->has('publicacion_individual') ? $request->get('publicacion_individual') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Producción y Resultados esperados',
    //             'codigo'        => 'G3',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Publicación colaborativa',
    //             'porcentaje'        => $request->has('publicacion_colaborativa') ? $request->get('publicacion_colaborativa') : 0,
    //         ]);
    //
    //     CriterioEvaluacion::updateOrCreate(
    //         [
    //             'itemGeneral'   => 'Producción y Resultados esperados',
    //             'codigo'        => 'G4',
    //             'proyecto_id'   => $idProyecto,
    //         ],
    //         [
    //             'itemEspecifico'    => 'Eventos de divulgación',
    //             'porcentaje'        => $request->has('eventos_divulgacion') ? $request->get('eventos_divulgacion') : 0,
    //         ]);
    //
    //         return redirect()->route('evaluacion.evaluarPertinencia', $idProyecto)->with('status', "El proyecto ha sido evaluado");
    // }

    public function descargarCartaCompromiso($id)
    {
        $instructor     = RecursoHumano::findOrFail($id);

        $pathToFile     = storage_path("app/{$instructor->cartaCompromisoInstructor}");
        if (file_exists($pathToFile)) {
            $extension      = '.'.pathinfo($pathToFile)['extension'];
            $nombreArchivo  = $instructor->nombrePersonal.$extension;

            return response()->download($pathToFile, $nombreArchivo);
        }

        return redirect()->back()->with('status-danger', 'El archivo no existe');
    }

    public function formularioEnviarEvaluacion($idProyecto)
    {
        $proyecto   = Proyecto::findOrFail($idProyecto);
        return view('panel_administracion.proyectos.evaluacion.enviar_evaluacion', compact('proyecto'));
    }

    public function enviarEvaluacion($idProyecto)
    {
        $usuario  = Auth::user();
        $proyecto = Proyecto::findOrFail($idProyecto);

        $proyecto->evaluado = true;
        $proyecto->enviado  = false;
        $proyecto->save();

        foreach ($proyecto->autores as $autor) {
            Notification::send($autor, new ProyectoEvaluado($proyecto, $usuario));
        }
        return redirect()->route('evaluacion.evaluarCriteriosValoracion', $idProyecto)->with('status', "La evaluación ha sido enviada al investigador/aprendiz");
    }

    public function guardarEvaluacionCriterio(EvaluacionFinalRequest $request, $idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto);

        $item                   = $request->get('item');
        $puntajeAsignadoItem    = $request->get('puntajeAsignadoItem');
        $idsSubcriterios        = $request->get('ids');
        $criterioPuntajeMaximo  = $request->get('criterioPuntajeMaximo');


        if(collect($puntajeAsignadoItem)->sum() <= $criterioPuntajeMaximo) {
            $criterio = CriterioEvaluacion::updateOrCreate(
                [
                    'nombreCriterio' => $request->get('criterio'),
                    'proyecto_id'    => $idProyecto,
                ],
                [
                    'observacion' => $request->get('observacionCriterio'),
                ]
            );

            for ($i=0; $i < count($request->get('item')); $i++) {
                SubcriterioEvaluacion::updateOrCreate(
                    [
                        'criterio_evaluacion_id'    => $criterio->id,
                        'subcriterio_id'            => $idsSubcriterios[$i],
                    ],
                    [
                        'estado'            => $item[$i],
                        'puntajeAsignado'   => $puntajeAsignadoItem[$i],
                    ]
                );
            }
            return redirect()->back()->with('status', 'La evaluación de este criterio ha sido guardada con éxito!');;
        } else {
            return redirect()->back()->withInput($request->input())
                ->with('status-danger', 'El puntaje máximo ha sido superado, por favor revisa cada puntaje!');
        }
    }

    public function descargarExcel($idProyecto)
    {
        $proyecto = Proyecto::findOrFail($idProyecto); // Cambiar - dinámico


        $file           = storage_path('app/public/archivos/Formato-evaluación-proyectos.xlsx');
        $spreadsheet    = IOFactory::load($file);
        $sheet          = $spreadsheet->getActiveSheet();
        // $collection     = $proyecto->lineasInvestigacion()->selectRaw("group_concat(nombre, ', ') as aggregate")->get()->toArray();
        $collection = $proyecto->obtenerLineasInvestigacionVinculadas($proyecto->id)->aggregate;

        $sheet->setCellValue('B11', $proyecto->titulo);
        $sheet->setCellValue('B25', $proyecto->centroFormacion->nombreCentroFormacion);
        $sheet->setCellValue('B26', $proyecto->centroFormacion->regional);
        $sheet->setCellValue('C13', $proyecto->grupoInvestigacion->nombre);
        $sheet->setCellValue('C14', $collection); // Líneas de investigación

        // Título item 1
        $sheet->setCellValue('C40', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(1)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D40', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(1)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E40', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(1)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G40', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(1)->puntajeAsignado);

        $sheet->setCellValue('C41', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(2)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D41', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(2)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E41', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(2)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G41', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(2)->puntajeAsignado);

        $sheet->setCellValue('C42', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(3)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D42', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(3)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E42', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(3)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G42', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(3)->puntajeAsignado);

        $sheet->setCellValue('C43', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(4)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D43', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(4)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E43', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(4)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G43', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(4)->puntajeAsignado);

        $sheet->setCellValue('C44', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(5)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D44', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(5)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E44', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(5)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G44', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(5)->puntajeAsignado);
        // Título observación
        $sheet->setCellValue('I40', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(1)->observacion);

        // Planteamiento del problema ítem 1
        $sheet->setCellValue('C45', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(6)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D45', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(6)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E45', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(6)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G45', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(6)->puntajeAsignado);

        $sheet->setCellValue('C46', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(7)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D46', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(7)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E46', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(7)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G46', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(7)->puntajeAsignado);

        $sheet->setCellValue('C47', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(8)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D47', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(8)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E47', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(8)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G47', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(8)->puntajeAsignado);
        // Planteamiento del problema observación
        $sheet->setCellValue('I45', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(6)->observacion);

        // Antecedentes y justificación ítem 1
        $sheet->setCellValue('C48', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(9)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D48', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(9)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E48', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(9)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G48', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(9)->puntajeAsignado);

        $sheet->setCellValue('C49', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(10)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D49', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(10)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E49', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(10)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G49', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(10)->puntajeAsignado);

        $sheet->setCellValue('C50', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(11)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D50', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(11)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E50', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(11)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G50', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(11)->puntajeAsignado);

        $sheet->setCellValue('C51', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(12)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D51', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(12)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E51', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(12)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G51', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(12)->puntajeAsignado);

        $sheet->setCellValue('C52', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(13)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D52', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(13)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E52', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(13)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G52', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(13)->puntajeAsignado);
        // Antecedentes y justificación observación
        $sheet->setCellValue('I48', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(9)->observacion);

        // Objetivos ítem 1
        $sheet->setCellValue('C53', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(14)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D53', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(14)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E53', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(14)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G53', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(14)->puntajeAsignado);

        $sheet->setCellValue('C54', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(15)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D54', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(15)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E54', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(15)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G54', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(15)->puntajeAsignado);

        $sheet->setCellValue('C55', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(16)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D55', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(16)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E55', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(16)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G55', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(16)->puntajeAsignado);

        $sheet->setCellValue('C56', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(17)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D56', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(17)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E56', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(17)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G56', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(17)->puntajeAsignado);

        $sheet->setCellValue('C57', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(18)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D57', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(18)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E57', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(18)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G57', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(18)->puntajeAsignado);

        $sheet->setCellValue('C58', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(19)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D58', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(19)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E58', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(19)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G58', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(19)->puntajeAsignado);
        // Objetivos observación
        $sheet->setCellValue('I53', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(14)->observacion);

        // Metodología
        $sheet->setCellValue('C59', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(20)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D59', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(20)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E59', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(20)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G59', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(20)->puntajeAsignado);

        $sheet->setCellValue('C60', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(21)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D60', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(21)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E60', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(21)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G60', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(21)->puntajeAsignado);

        $sheet->setCellValue('C61', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(22)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D61', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(22)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E61', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(22)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G61', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(22)->puntajeAsignado);

        $sheet->setCellValue('C62', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(23)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D62', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(23)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E62', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(23)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G62', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(23)->puntajeAsignado);

        $sheet->setCellValue('C63', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(24)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D63', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(24)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E63', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(24)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G63', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(24)->puntajeAsignado);
        // Metodología observación
        $sheet->setCellValue('I59', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(20)->observacion);

        // Resultados esperados y productos ítem 1
        $sheet->setCellValue('C64', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(25)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D64', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(25)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E64', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(25)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G64', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(25)->puntajeAsignado);

        $sheet->setCellValue('C65', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(26)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D65', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(26)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E65', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(26)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G65', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(26)->puntajeAsignado);

        $sheet->setCellValue('C66', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(27)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D66', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(27)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E66', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(27)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G66', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(27)->puntajeAsignado);

        $sheet->setCellValue('C67', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(28)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D67', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(28)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E67', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(28)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G67', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(28)->puntajeAsignado);

        $sheet->setCellValue('C68', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(29)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D68', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(29)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E68', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(29)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G68', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(29)->puntajeAsignado);

        $sheet->setCellValue('C69', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(30)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D69', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(30)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E69', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(30)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G69', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(30)->puntajeAsignado);

        $sheet->setCellValue('C70', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(31)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D70', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(31)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E70', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(31)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G70', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(31)->puntajeAsignado);

        $sheet->setCellValue('C71', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(32)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D71', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(32)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E71', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(32)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G71', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(32)->puntajeAsignado);
        // Resultados esperados y productos observación
        $sheet->setCellValue('I64', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(25)->observacion);

        // Cronograma de actividades ítem 1
        $sheet->setCellValue('C72', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(33)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D72', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(33)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E72', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(33)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G72', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(33)->puntajeAsignado);

        $sheet->setCellValue('C73', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(34)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D73', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(34)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E73', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(34)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G73', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(34)->puntajeAsignado);
        // Cronograma de actividades observación
        $sheet->setCellValue('I72', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(33)->observacion);

        // Presupuesto ítem 1
        $sheet->setCellValue('C74', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(35)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D74', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(35)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E74', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(35)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G74', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(35)->puntajeAsignado);

        $sheet->setCellValue('C75', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(36)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D75', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(36)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E75', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(36)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G75', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(36)->puntajeAsignado);

        $sheet->setCellValue('C76', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(37)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D76', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(37)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E76', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(37)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G76', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(37)->puntajeAsignado);

        $sheet->setCellValue('C77', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(38)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D77', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(38)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E77', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(38)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G77', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(38)->puntajeAsignado);

        $sheet->setCellValue('C78', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(39)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D78', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(39)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E78', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(39)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G78', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(39)->puntajeAsignado);
        // Presupuesto observación
        $sheet->setCellValue('I74', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(35)->observacion);

        // Imptaco ítem 1
        $sheet->setCellValue('C79', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(40)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D79', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(40)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E79', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(40)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G79', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(40)->puntajeAsignado);

        $sheet->setCellValue('C80', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(41)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D80', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(41)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E80', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(41)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G80', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(41)->puntajeAsignado);

        $sheet->setCellValue('C81', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(42)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D81', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(42)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E81', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(42)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G81', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(42)->puntajeAsignado);

        $sheet->setCellValue('C82', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(43)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D82', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(43)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E82', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(43)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G82', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(43)->puntajeAsignado);

        $sheet->setCellValue('C83', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(44)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D83', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(44)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E83', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(44)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G83', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(44)->puntajeAsignado);
        // Impacto observación
        $sheet->setCellValue('I79', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(40)->observacion);

        // Coherencia general ítem 1
        $sheet->setCellValue('C84', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(45)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D84', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(45)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E84', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(45)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G84', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(45)->puntajeAsignado);
        $sheet->setCellValue('I84', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(45)->observacion);

        $sheet->setCellValue('C85', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(46)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D85', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(46)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E85', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(46)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G85', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(46)->puntajeAsignado);
        // Coherencia general observación
        $sheet->setCellValue('I85', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(46)->observacion);

        // Perfil del proponente ítem
        $sheet->setCellValue('C88', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(47)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D88', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(47)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E88', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(47)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G88', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(47)->puntajeAsignado);

        $sheet->setCellValue('C89', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(48)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D89', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(48)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E89', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(48)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G89', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(48)->puntajeAsignado);

        $sheet->setCellValue('C90', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(49)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D90', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(49)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E90', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(49)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G90', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(49)->puntajeAsignado);

        $sheet->setCellValue('C91', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(50)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D91', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(50)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E91', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(50)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G91', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(50)->puntajeAsignado);

        $sheet->setCellValue('C92', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(51)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D92', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(51)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E92', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(51)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G92', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(51)->puntajeAsignado);
        // Perfil del proponente observación
        $sheet->setCellValue('I88', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(47)->observacion);

        // Programas de formación
        $sheet->setCellValue('C93', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(52)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D93', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(52)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E93', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(52)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G93', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(52)->puntajeAsignado);

        $sheet->setCellValue('C94', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(53)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D94', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(53)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E94', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(53)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G94', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(53)->puntajeAsignado);

        $sheet->setCellValue('C95', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(54)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D95', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(54)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E95', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(54)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G95', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(54)->puntajeAsignado);

        $sheet->setCellValue('C96', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(55)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D96', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(55)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E96', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(55)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G96', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(55)->puntajeAsignado);

        $sheet->setCellValue('C97', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(56)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D97', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(56)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E97', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(56)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G97', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(56)->puntajeAsignado);
        // Programas de formación observación
        $sheet->setCellValue('I93', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(52)->observacion);

        // Sector productivo ítem 1
        $sheet->setCellValue('C98', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(57)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D98', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(57)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E98', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(57)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G98', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(57)->puntajeAsignado);

        $sheet->setCellValue('C99', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(58)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D99', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(58)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E99', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(58)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G99', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(58)->puntajeAsignado);

        $sheet->setCellValue('C100', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(59)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D100', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(59)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E100', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(59)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G100', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(59)->puntajeAsignado);

        $sheet->setCellValue('C101', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(60)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D101', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(60)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E101', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(60)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G101', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(60)->puntajeAsignado);

        $sheet->setCellValue('C102', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(61)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D102', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(61)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E102', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(61)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G102', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(61)->puntajeAsignado);
        // Sector productivo observación
        $sheet->setCellValue('I98', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(57)->observacion);

        $sheet->setCellValue('C103', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(62)->estado == 'Satisfactorio' ? 'X' : '');
        $sheet->setCellValue('D103', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(62)->estado == 'Requiere modificaciones' ? 'X' : '');
        $sheet->setCellValue('E103', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(62)->estado == 'No cumple' ? 'X' : '');
        $sheet->setCellValue('G103', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(62)->puntajeAsignado);
        // Impacto ambiental observación
        $sheet->setCellValue('I103', $proyecto->obtenerCriteriosYSubcriteriosEvaluados(62)->observacion);

        $sheet->setCellValue('C28', $proyecto->tipoProyecto == 'Proyecto de investigación' ? 'X' : '');
        $sheet->setCellValue('C29', $proyecto->tipoProyecto == 'Proyecto de innovación' ? 'X' : '');
        $sheet->setCellValue('C30', $proyecto->tipoProyecto == 'Proyecto de divulgación' ? 'X' : '');
        $sheet->setCellValue('C31', $proyecto->tipoProyecto == 'Proyecto de modernización' ? 'X' : '');
        $sheet->setCellValue('C32', $proyecto->tipoProyecto == 'Servicios Tecnologicos' ? 'X' : '');
        $sheet->setCellValue('C33', $proyecto->tipoProyecto == 'Tecnoparque' ? 'X' : '');
        $sheet->setCellValue('C34', $proyecto->tipoProyecto == 'Tecnoacademia' ? 'X' : '');

        $sheet->setCellValue('B113', 'Manizales, ' . date('d-m-Y'));

        // ------- ULTIMO -------

        // Programas de formación
        $sheet->insertNewRowBefore(24, $proyecto->programasFormacion->count());
        // $sheet->mergeCells('A24:C24');
        // $sheet->mergeCells('D24:G24');
        // $sheet->mergeCells('H24:I24');

        $arrayFormacion = $proyecto->programasFormacion()->select('nivelAcademico', 'nombre', 'sectorProductivo')->get()->toArray();

        $sheet->fromArray(
                $arrayFormacion,   // The data to set
                NULL,        // Array values with this value will not be set
                'A24'         // Top left coordinate of the worksheet range where
                             //    we want to set these values (default is A1)
            );

        // Integrantes del grupo de investigación
        $sheet->insertNewRowBefore(21, $proyecto->autores->count());
        // $sheet->mergeCells('E21:F21');
        $arrayAutores = $proyecto->obtenerAutoresConVinculacion()->toArray();

        // $arrayAutores = $proyecto->autores()->select('nombre', 'email', 'tipoDocumento', 'numeroDocumento', 'tipoVinculacion', 'profesion')->get()->toArray();
        $sheet->fromArray(
                $arrayAutores,   // The data to set
                NULL,        // Array values with this value will not be set
                'A21'         // Top left coordinate of the worksheet range where
                             //    we want to set these values (default is A1)
            );

        $writer = new Xlsx($spreadsheet);
        // $writer->save(storage_path('app/public/archivos/hello world.xlsx'));
        // $path   = storage_path('app/public/archivos/hello world.xlsx');
        // readfile($path);
        // exit;

        header('Content-Disposition: attachment; filename=Evaluación final.xlsx');
        $writer->save('php://output');
    }
}
