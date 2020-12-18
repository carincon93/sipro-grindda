<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones';

    protected $fillable = [
        'itemAEvaluar', // varchar 191 required
        'recomendacion', // longtext required
        'estado', // tinyint 1 required
        'proyecto_id', // int 10 required
        'resultado_id',
        'objetivo_especifico_id',
        'producto_id',
        'actividad_id',
        'aliado_id',
        'recurso_humano_id',
        'presupuesto_id',
        'presupuesto_empresarial_id',
        'evaluacionInformacion',
        'cumplimiento',
    ];

    public function proyecto()
    {
        return $this->belongsTo('App\Models\Proyecto');
    }

    public function objetivoEspecifico()
    {
        return $this->belongsTo('App\Models\ObjetivoEspecifico');
    }

    public function resultado()
    {
        return $this->belongsTo('App\Models\Resultado');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }

    public function actividad()
    {
        return $this->belongsTo('App\Models\Actividad');
    }

    public function aliado()
    {
        return $this->belongsTo('App\Models\Aliado');
    }

    public function recursoHumano()
    {
        return $this->belongsTo('App\Models\RecursoHumano');
    }

    public function presupuesto()
    {
        return $this->belongsTo('App\Models\Presupuesto');
    }

    public function presupuestoEmpresarial()
    {
        return $this->belongsTo('App\Models\presupuestoEmpresarial');
    }
}
