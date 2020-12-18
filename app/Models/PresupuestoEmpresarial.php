<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class PresupuestoEmpresarial extends Model
{
    use HasFactory;

    protected $table = 'presupuestos_empresariales';

    protected $fillable = [
        'nombreItem',
        'valor',
        'descripcion',
        'archivo',
        'aliado_id',
        // 'proyecto_id',
    ];

    // public function proyecto()
    // {
    //     return $this->belongsTo('App\Models\Proyecto');
    // }

    public function aliado()
    {
        return $this->belongsTo('App\Models\Aliado');
    }

    public function evaluacion()
    {
        return $this->hasOne('App\Models\Evaluacion');
    }

    public function totalPresupuesto($aliado_id)
    {
        return $this->select('valor')
            ->where('aliado_id', $aliado_id)
            ->sum('valor');
    }

    public function obtenerRecomendacion($idPresupuestoEmpresarial, $itemAEvaluar)
    {
        return $this->evaluacion()->where('evaluaciones.presupuesto_empresarial_id', '=', $idPresupuestoEmpresarial)->where('itemAEvaluar', '=', $itemAEvaluar)->first();
    }

    // public function scopeHasItem($query, $nombreItem, $proyecto_id)
    // {
    //     return $query->from('presupuestos')
    //     ->join('proyectos', 'proyectos.id', 'presupuestos.proyecto_id')
    //     ->where('presupuestos.nombreItem', $nombreItem)
    //     ->where('proyectos.id', $proyecto_id)->get();
    // }

    // public function scopeHasAliado($query, $proyecto_id)
    // {
    //     return $query->from('aliados')
    //     ->select('id')
    //     ->where('proyecto_id', '=', $proyecto_id)->get();
}
