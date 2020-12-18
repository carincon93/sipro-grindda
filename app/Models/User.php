<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', // varchar 191 required
        'email', // varchar 191 required
        'password', // varchar 191 required
        'tipoDocumento', // varchar 191 required
        'numeroDocumento', // bigint 20 required
        'numeroCelular', // bigint 20 required
        'tipoVinculacion', // varchar 191
        'profesion', // varchar 191
        'foto',
        'linea_investigacion_id', // varchar 191
        'programa_formacion_id', // int 10 required para aprendiz
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Rol', 'rol_usuario', 'user_id', 'rol_id');
    }

    public function proyectos()
    {
        return $this->belongsToMany('App\Models\Proyecto', 'proyecto_autor', 'user_id', 'proyecto_id');
    }

    public function programaFormacion()
    {
        return $this->belongsTo('App\Models\ProgramaFormacion');
    }

    public function lineaInvestigacion()
    {
        return $this->belongsTo('App\Models\LineaInvestigacion');
    }
}
