<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Proyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos';

    protected $fillable = [
        'codigo', // required
        'titulo', // longtext required
        'tipoProyecto', // varchar 191 required
        'vinculacionAutor', // varchar 191 required
        'areaConocimiento1', // varchar 191 required
        'areaConocimiento2', // varchar 191
        'antecedentesJustificacionProyecto', // longtext required
        'planteamientoProblema', // longtext required
        'metodologia', // longtext required
        'objetivoGeneral', // longtext required
        'fechaInicioProyecto', // date required
        'fechaFinProyecto', // date required
        'codigoGruplac', // varchar 191 required
        'impactoSocial', // longtext
        'impactoEconomico', // longtext
        'impactoTecnologico', // longtext
        'impactoAmbiental', // longtext
        'aplicacionPosconflicto', // varchar 191 required VERIFICAR
        'municipiosAImpactar', // longtext
        'descripcionEstrategia', // longtext
        'recursosPosconflicto', // bigint 20
        'modificado', // tinyint 1
        'evaluado', // tinyint 1
        'enviado', // tinyint 1
        'estado',
        'nivelPertinencia', // tinyint 1
        'grupo_investigacion_id', // int 10 required
        'centro_formacion_id', // int 10 required
    ];

    public function autores()
    {
        return $this->belongsToMany('App\Models\User', 'proyecto_autor', 'proyecto_id', 'user_id');
    }

    public function programasFormacion()
    {
        return $this->belongsToMany('App\Models\ProgramaFormacion', 'programas_formacion_beneficiados', 'proyecto_id', 'programa_formacion_id');
    }

    public function lineasInvestigacion()
    {
        return $this->belongsToMany('App\Models\LineaInvestigacion', 'lineas_investigacion_proyecto', 'proyecto_id', 'linea_investigacion_id');
    }

    public function semilleros()
    {
        return $this->belongsToMany('App\Models\Semillero', 'semilleros_beneficiados', 'proyecto_id', 'semillero_id');
    }

    public function recursosHumanos()
    {
        return $this->hasMany('App\Models\RecursoHumano');
    }

    public function aliados()
    {
        return $this->hasMany('App\Models\Aliado');
    }

    public function objetivosEspecificos()
    {
        return $this->hasMany('App\Models\ObjetivoEspecifico');
    }

    public function grupoInvestigacion()
    {
        return $this->belongsTo('App\Models\GrupoInvestigacion');
    }

    public function centroFormacion()
    {
        return $this->belongsTo('App\Models\CentroFormacion');
    }

    public function presupuestos()
    {
        return $this->hasMany('App\Models\Presupuesto');
    }

    public function evaluaciones()
    {
        return $this->hasMany('App\Models\Evaluacion');
    }

    public function criteriosEvaluacion()
    {
        return $this->hasMany('App\Models\CriterioEvaluacion');
    }

    public function observacionEvaluacion()
    {
        return $this->hasOne('App\Models\ObservacionEvaluacion');
    }
    // Excel
    public function obtenerCriteriosYSubcriteriosEvaluados($idSubcriterio)
    {
        return $this->criteriosEvaluacion()->select('criterios_evaluacion.nombreCriterio', 'criterios_evaluacion.observacion', 'subcriterios_evaluacion.estado', 'subcriterios_evaluacion.puntajeAsignado')->join('subcriterios_evaluacion', 'criterios_evaluacion.id', 'subcriterios_evaluacion.criterio_evaluacion_id')->where('subcriterios_evaluacion.subcriterio_id', $idSubcriterio)->first();
    }

    public function obtenerAutoresConVinculacion()
    {
        // SELECT nombre, email, IF(tipoVinculacion LIKE '%contratista%', 'x', '') as 'contratista', IF(tipoVinculacion LIKE '%planta%', 'x', '') as 'planta' FROM sipro.users;
        return $this->autores()->selectRaw('nombre, email, tipoDocumento, numeroDocumento, tipoVinculacion, IF(tipoVinculacion LIKE "%contratista%", "X", " ") as "contratista", IF(tipoVinculacion LIKE "%planta%", "X", " ") as "planta", profesion')->from('users')->get();
    }

    public function obtenerLineasInvestigacionVinculadas($idProyecto)
    {
        return $this->selectRaw("group_concat(lineas_investigacion.nombre separator ', ') as aggregate")->from('lineas_investigacion')->join('lineas_investigacion_proyecto', 'lineas_investigacion.id', 'lineas_investigacion_proyecto.proyecto_id')->where('lineas_investigacion_proyecto.proyecto_id', $idProyecto)->first();
    }

    public function obtenerRecomendacionCriterio($nombreCriterio)
    {
        return $this->criteriosEvaluacion()->select('observacion')->where('nombreCriterio', $nombreCriterio)->first();
    }

    public function scopeTipoProyecto($query, $tipoProyecto1, $tipoProyecto2 = null)
    {
        return $query->where('tipoProyecto', $tipoProyecto1)
            ->orWhere('tipoProyecto', $tipoProyecto2);
    }

    public function hasUser($user)
    {
        if ($this->autores()->where('user_id', $user)->first()) {
            return true;
        }
        return false;
    }

    public function hasRecomendacion($item) : bool
    {
        if ($this->evaluaciones()->where('itemAEvaluar', '=', $item)->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function canUpdate($user)
    {
        if (
            $this->autores()->where('user_id', $user)
            ->join('proyectos', 'proyectos.id', '=', 'proyecto_autor.proyecto_id')
            ->where('proyectos.modificado', '=', false)
            ->where('proyectos.evaluado', '=', false)
            ->where('proyectos.enviado', '=', false)
            ->first()

            or $this->autores()->where('user_id', $user)
            ->join('proyectos', 'proyectos.id', '=', 'proyecto_autor.proyecto_id')
            ->where('proyectos.modificado', '=', false)
            ->where('proyectos.evaluado', '=', true)
            ->where('proyectos.enviado', '=', false)
            ->first()
        ) {
            return true;
        }
        return false;
    }

    public function obtenerRecomendacion($proyecto, $itemAEvaluar)
    {
        return $this->evaluaciones()->where('evaluaciones.proyecto_id', '=', $proyecto->id)->where('itemAEvaluar', '=', $itemAEvaluar)->first();
    }

    public function informacionPrincipalEvaluada($proyecto, $evaluacion)
    {
        if ( $this->evaluaciones()->where('evaluaciones.proyecto_id', '=', $proyecto->id)->where('evaluacionInformacion', '=', true)->first() ) {
            return true;
        } else {
            return false;
        }
    }
    public function obtenerEvaluacion($proyecto, $evaluacion)
    {
        if ($this->evaluaciones()->where('evaluaciones.proyecto_id', '=', $proyecto->id)->where($evaluacion, '!=', null)->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerCriterioEvaluacion($proyecto, $criterio)
    {
        if ($this->criteriosEvaluacion()->where('criterios_evaluacion.proyecto_id', '=', $proyecto->id)->where('criterios_evaluacion.id', '=', $criterio)->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerCriterioEvaluacionObservacion($proyecto)
    {
        if ($this->observacionEvaluacion()->where('observaciones_evaluacion.proyecto_id', '=', $proyecto->id)->where('observaciones_evaluacion.observacion', '!=', null)->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerEvaluacionEnviada($proyecto)
    {
        if ($this->where('proyectos.id', '=', $proyecto->id)->where('proyectos.evaluado', '=', true)->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function evaluacionExistente($proyecto, $evaluacion, $itemEvaluado)
    {
        if ($this->evaluaciones()->where('evaluaciones.proyecto_id', '=', $proyecto->id)->where('recomendacion', '!=', null)->where($evaluacion, '=', $itemEvaluado->id)->first()) {
            return true;
        } else {
            return false;
        }
    }

    // public function obtenerCriterio($criterio, $idProyecto)
    // {
    //     if ($this->criteriosEvaluacion()->where('criterios_evaluacion.codigo', '=', $criterio)->where('proyecto_id', '=', $idProyecto)->where('porcentaje', '>', 0)->first()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function sumaPorcentajeCriterios()
    {
        return $this->criteriosEvaluacion()->join('subcriterios_evaluacion', 'criterios_evaluacion.id', 'subcriterios_evaluacion.criterio_evaluacion_id')->select('subcriterios_evaluacion.puntajeAsignado')->sum('subcriterios_evaluacion.puntajeAsignado');
    }

    public function canDescargarExcel($proyecto) : bool
    {
        // $sumaCriteriosEvaluados = $this->criteriosEvaluacion()->select('nombreCriterio')->where('criterios_evaluacion.proyecto_id', '=', $proyecto->id)->count('criterios_evaluacion.nombreCriterio');

        $sumaCriteriosEvaluados = $this->withCount('observacionEvaluacion', 'criteriosEvaluacion')->where('proyectos.id', $proyecto->id)->first();
        if (($sumaCriteriosEvaluados->criterios_evaluacion_count+$sumaCriteriosEvaluados->observacion_evaluacion_count) == 16 ) {
            return true;
        } else {
            return false;
        }
    }

    public function scopeProyectosPriorizados($query)
    {
        return $query
            // ->select('proyectos.id', 'proyectos.codigo', 'proyectos.titulo', 'proyectos.nivelPertinencia', 'proyectos.created_at', DB::raw('sum(criterios_evaluacion.porcentaje) as total'))
            ->select('proyectos.id', 'proyectos.codigo', 'proyectos.titulo', 'proyectos.nivelPertinencia', 'proyectos.estado', 'proyectos.created_at')
            // ->join('criterios_evaluacion', 'proyectos.id', '=', 'criterios_evaluacion.proyecto_id')
            ->groupBy('proyectos.id', 'proyectos.codigo', 'proyectos.titulo', 'proyectos.nivelPertinencia', 'proyectos.estado', 'proyectos.created_at')
            // ->orderBy('total', 'DESC')
            ->orderBy('proyectos.nivelPertinencia', 'DESC');
    }

    public function proyectoAprobacion()
    {
        // select count(*) total, sum(cumplimiento = 'si') as suma from evaluaciones where proyecto_id = 6 and cumplimiento is not null
        return $this->evaluaciones()
            ->select(DB::raw('COUNT(*) as totalEvaluaciones'), DB::raw('SUM(cumplimiento = "si") as totalEvaluacionesSi'))
            ->whereNotNull('cumplimiento')
            ->first();
    }
}
