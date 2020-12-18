<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class IdeaEmpresa extends Model
{
    use HasFactory;

    protected $table = 'ideas_empresas';

    protected $fillable = [
        'nombreEmpresa',
        'nit',
        'representanteLegal',
        'sectorEmpresa',
        'nombrePersona',
        'telefonoCelular',
        'telefonoFijo',
        'correoElectronico',
        'idea',
        'presupuesto',
    ];
}
