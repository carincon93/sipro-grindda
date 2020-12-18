<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Convocatoria extends Model
{
    use HasFactory;
    
    protected $table = 'convocatorias';

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'convocatoriaCorreccion',
    ];

}
