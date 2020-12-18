<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class CriterioEvaluacion extends Model
{
    use HasFactory;

    protected $table = 'criterios_evaluacion';

    protected $fillable = [
        'nombreCriterio',
        'observacion',
        'proyecto_id',
    ];

    public function proyecto()
    {
        return $this->belongsTo('App\Models\Proyecto');
    }

    public function subcriteriosEvaluacion()
    {
        return $this->hasMany('App\Models\SubcriterioEvaluacion');
    }
}
