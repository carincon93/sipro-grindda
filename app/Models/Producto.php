<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'codigo', // varchar 191 required
        'descripcion', // longtext required
        'fechaInicio', // date required
        'fechaFin', // date required
        'duracion', // int 11 required
        'resultado_id', // int 10 required
    ];

    public function resultado()
    {
        return $this->belongsTo('App\Models\Resultado');
    }

    public function actividades()
    {
        return $this->hasMany('App\Models\Actividad');
    }

    public function evaluacion()
    {
        return $this->hasOne('App\Models\Evaluacion');
    }

    public function obtenerRecomendacion($idProducto, $itemAEvaluar)
    {
        return $this->evaluacion()->where('evaluaciones.producto_id', '=', $idProducto)->where('itemAEvaluar', '=', $itemAEvaluar)->first();
    }

    public function hasAnyActividad($codigo, $id) : bool
    {
        if ($this->actividades()->where('codigo', $codigo)->where('producto_id', $id)->first()) {
            return true;
        }
        return false;
    }
}
