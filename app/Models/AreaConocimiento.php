<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class AreaConocimiento extends Model
{
    use HasFactory;
    
    protected $table = 'areas_conocimientos';

    protected $fillable = [
        'nombre', // varchar 191 required
        'codigo' // bigint 20 required
    ];
}
