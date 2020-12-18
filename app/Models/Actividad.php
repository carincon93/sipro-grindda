<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;
    
    protected $table = 'actividades';

    protected $fillable = [
        'codigo', // varchar 191 required
        'descripcion', // longtext required
        'fechaInicio', // date required
        'fechaFin', // date required
        'duracion', // int 11 required
        'producto_id', // int 10 required
    ];

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto');
    }

    public function evaluacion()
    {
        return $this->hasOne('App\Models\Evaluacion');
    }

    public function obtenerRecomendacion($idActividad, $itemAEvaluar)
    {
        return $this->evaluacion()->where('evaluaciones.actividad_id', '=', $idActividad)->where('itemAEvaluar', '=', $itemAEvaluar)->first();
    }
}
