<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ObservacionEvaluacion extends Model
{
    use HasFactory;

    protected $table = 'observaciones_evaluacion';

    protected $fillable = [
        'observacion',
        'proyecto_id',
    ];

    public function proyecto()
    {
        return $this->belongsTo('App\Models\Proyecto');
    }
}
