<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ObjetivoEspecifico extends Model
{
    use HasFactory;

    protected $table = 'objetivos_especificos';

    protected $fillable = [
        'descripcion', // longtext required
        'proyecto_id', // int 10 required
    ];

    public function proyecto()
    {
        return $this->belongsTo('App\Models\Proyecto');
    }

    public function resultados()
    {
        return $this->hasMany('App\Models\Resultado');
    }

    public function evaluacion()
    {
        return $this->hasOne('App\Models\Evaluacion');
    }

    public function hasResultado($id) : bool
    {
        if ($this->resultados()->where('objetivo_especifico_id', $id)->first()) {
            return true;
        }
        return false;
    }
}
