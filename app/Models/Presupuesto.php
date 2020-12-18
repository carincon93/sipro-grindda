<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;

    protected $table = 'presupuestos';

    protected $fillable = [
        'nombreItem',
        'valor',
        'descripcion',
        'archivo',
        'proyecto_id',
    ];

    public function proyecto()
    {
        return $this->belongsTo('App\Models\Proyecto');
    }

    public function evaluacion()
    {
        return $this->hasOne('App\Models\Evaluacion');
    }

    public function totalPresupuesto($proyecto_id)
    {
        return $this->select('valor')
            ->where('proyecto_id', $proyecto_id)
            ->sum('valor');
    }

    public function scopeHasItem($query, $nombreItem, $proyecto_id)
    {
        return $query->from('presupuestos')
        ->join('proyectos', 'proyectos.id', 'presupuestos.proyecto_id')
        ->where('presupuestos.nombreItem', $nombreItem)
        ->where('proyectos.id', $proyecto_id)->get();
    }

    public function scopeHasAliado($query, $proyecto_id)
    {
        return $query->from('aliados')
        ->select('id')
        ->where('proyecto_id', '=', $proyecto_id)->get();
    }

    public function obtenerRecomendacion($idPresupuesto, $itemAEvaluar)
    {
        return $this->evaluacion()->where('evaluaciones.presupuesto_id', '=', $idPresupuesto)->where('itemAEvaluar', '=', $itemAEvaluar)->first();
    }

}
