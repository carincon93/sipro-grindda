<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Contador extends Model
{
    use HasFactory;

    protected $table = 'contadores';

    public $timestamps = false;

    protected $fillable = [
        'ano', // varchar 191 required
        'proyecto_contador', // varchar 191 required
    ];
}
