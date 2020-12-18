<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class SubcriterioEvaluacion extends Model
{
    use HasFactory;

    protected $table = 'subcriterios_evaluacion';

    protected $fillable = [
        'estado',
        'puntajeAsignado',
        'subcriterio_id',
        'criterio_evaluacion_id',
    ];

    public function subcriterio()
    {
        return $this->belongsTo('App\Models\Subcriterio');
    }

    public function subcriterioEvaluacion()
    {
        return $this->belongsTo('App\Models\CriterioEvaluacion');
    }
}
