<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class GrupoInvestigacion extends Model
{
    use HasFactory;

    protected $table = 'grupos_investigacion';

    protected $fillable = [
        'nombre', // varchar 191 required
        'descripcion', // longtext required
    ];

    public function proyectos()
    {
        return $this->hasMany('App\Models\Proyecto');
    }
}
