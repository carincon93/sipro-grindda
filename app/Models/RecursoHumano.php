<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class RecursoHumano extends Model
{
    use HasFactory;

    protected $table = 'recursos_humanos';

    protected $fillable = [
        'nombrePersonal', // varchar 191 required
        'numeroDocumentoPersonal', // bigint 20 required
        'cartaCompromisoInstructor', // text
        'personalInterno', // tinyint 1
        'personalInstructor', // tinyint 1
        // 'personalExterno', // tinyint 1
        'proyecto_id', // int 10 required
    ];

    public function proyecto()
    {
        return $this->belongsTo('App\Models\Proyecto');
    }

    public function evaluacion()
    {
        return $this->hasOne('App\Models\Evaluacion');
    }

    public function obtenerRecomendacion($idRecursoHumano, $itemAEvaluar)
    {
        return $this->evaluacion()->where('evaluaciones.recurso_humano_id', '=', $idRecursoHumano)->where('itemAEvaluar', '=', $itemAEvaluar)->first();
    }
}
