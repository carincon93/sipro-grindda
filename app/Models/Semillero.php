<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Semillero extends Model
{
    use HasFactory;

    protected $table = 'semilleros';

    protected $fillable = [
        'nombre', // varchar 191 required
        'descripcion', // longtext
    ];

    public function proyectos()
    {
        return $this->belongsToMany('App\Models\Proyecto', 'semilleros_beneficiados', 'semillero_id', 'proyecto_id');
    }

    public function scopeProyectoSemillero($query, $nombre)
    {
        return $query->where('nombre', $nombre);
    }
}
