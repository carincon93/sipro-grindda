<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    use HasFactory;

    protected $table = 'criterios';

    protected $fillable = [
        'nombreCriterio',
        'slug',
        'puntajeMaximo',
    ];

    public function subcriterios()
    {
        return $this->hasMany('App\Models\Subcriterio');
    }
}
