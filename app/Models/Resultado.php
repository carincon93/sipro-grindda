<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    use HasFactory;

    protected $table = 'resultados';

    protected $fillable = [
        'codigo', // varchar 191 required
        'descripcion', // longtext required
        'indicador', // longtext required
        'medioVerificacion', // varchar 191 required
        'meta', // text required
        'objetivo_especifico_id', // int 10 required
    ];

    public function objetivoEspecifico()
    {
        return $this->belongsTo('App\Models\ObjetivoEspecifico');
    }

    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }

    public function evaluacion()
    {
        return $this->hasOne('App\Models\Evaluacion');
    }

    public function scopeObtenerProductos($query, $idResultado, $codigo)
    {
        return $query->from('productos')->where('codigo', '=', $codigo)->where('resultado_id', $idResultado)->get();
    }

    public function obtenerRecomendacion($idResultado, $itemAEvaluar)
    {
        return $this->evaluacion()->where('evaluaciones.resultado_id', '=', $idResultado)->where('itemAEvaluar', '=', $itemAEvaluar)->first();
    }

    public function hasAnyProducto($codigo, $id) : bool
    {
        if ($this->productos()->where('codigo', $codigo)->where('resultado_id', $id)->first()) {
            return true;
        }
        return false;
    }
}
