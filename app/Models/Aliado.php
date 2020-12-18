<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Aliado extends Model
{
    use HasFactory;
    
    protected $table = 'aliados';

    protected $fillable = [
        'nombreAliado', // varchar 191
        'nit', // bigint 20
        'nombre', // varchar 191
        'celular', // bigint 20
        'email', // varchar 191
        'recursosEspecie', // bigint 20
        'recursosDinero', // bigint 20
        'ciudadesMunicipiosInfluencia', // longtext
        'archivoAdjunto', // longtext
        'aliadoExterno', // tinyint 1
        'proyecto_id', // int 10 required
    ];

    public function proyecto()
    {
        return $this->belongsTo('App\Models\Proyecto');
    }

    public function presupuestosEmpresariales()
    {
        return $this->hasMany('App\Models\PresupuestoEmpresarial');
    }

    public function evaluacion()
    {
        return $this->hasOne('App\Models\Evaluacion');
    }

    public function obtenerRecomendacion($idAliado, $itemAEvaluar)
    {
        return $this->evaluacion()->where('evaluaciones.aliado_id', '=', $idAliado)->where('itemAEvaluar', '=', $itemAEvaluar)->first();
    }
}
