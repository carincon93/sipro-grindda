<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class CentroFormacion extends Model
{
    use HasFactory;

    protected $table = 'centros_formacion';

    protected $fillable = [
        'regional', // varchar 191 required
        'nombreCentroFormacion', // varchar 191 required
        'nombreSubdirector', // varchar 191 required
        'correoElectronicoSubdirector', // varchar 191 required
        'numeroCelularSubdirector', // bigint 20 required
        'nombreLiderSennova', // varchar 191 required
        'correoElectronicoLiderSennova', // varchar 191 required
        'numeroCelularLiderSennova', // bigint 20 required
    ];
    
    public function proyecto()
    {
        return $this->hasOne('App\Models\Proyecto');
    }
}
