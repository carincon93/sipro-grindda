<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Subcriterio extends Model
{
    use HasFactory;

    protected $table = 'subcriterios';

    protected $fillable = [
        'descripcionSubcriterio', // longtext
    ];

    public function subcriteriosEvaluacion()
    {
        return $this->hasMany('App\Models\SubcriterioEvaluacion');
    }

    public function criterio()
    {
        return $this->belongsTo('App\Models\Criterio');
    }
}
