<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ProgramaFormacion extends Model
{
    use HasFactory;

    protected $table = 'programas_formacion';
    
    protected $hidden = [
        'pivot'
    ];

    protected $fillable = [
        'nombre', // varchar 191 required
        'nivelAcademico', // varchar 191 required
        'sectorProductivo', // varchar 191 required
    ];

    public function proyectos()
    {
        return $this->belongsToMany('App\Models\Proyecto', 'programas_formacion_beneficiados', 'programa_formacion_id', 'proyecto_id');
    }

    public function aprendices()
    {
        return $this->hasMany('App\Models\User');
    }
}
