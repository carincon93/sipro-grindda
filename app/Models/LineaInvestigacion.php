<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class LineaInvestigacion extends Model
{
    use HasFactory;

    protected $table = 'lineas_investigacion';
    protected $hidden = [
        'pivot'
    ];

    protected $fillable = [
        'nombre', // varchar 191 required
        'descripcion', // longtext required
    ];

    public function usuarios()
    {
        return $this->hasMany('App\Models\User');
    }

    public function proyectos()
    {
        return $this->belongsToMany('App\Models\Proyecto', 'lineas_investigacion_proyecto', 'linea_investigacion_id', 'proyecto_id');
    }
}
