<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = [
        'nombre', // varchar 191 required
        'slug', // varchar 191 required
        'descripcion', // longtext required
        'permisos', // longtext required
        'usuarioNotificacion', // longtext required
        'nivelSeguridad', // integer 11 required
    ];

    protected $casts = [
       'permisos'               => 'array',
       'usuarioNotificacion'    => 'array',
       
    ];

    public function usuarios()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function hasAccess(array $permisos) : bool
    {
        foreach ($permisos as $permiso) {
            if ($this->hasPermission($permiso))
                return true;
        }
        return false;
    }

    private function hasPermission(string $permiso) : bool
    {
        return $this->permisos[$permiso] ?? false;
    }

    public function hasUsuarios(array $usuariosNotificacion) : bool
    {
        foreach ($usuariosNotificacion as $usuarioNotificacion) {
            if ($this->allowNotification($usuarioNotificacion))
                return true;
        }
        return false;
    }

    private function allowNotification(string $usuarioNotificacion) : bool
    {
        return $this->usuarioNotificacion[$usuarioNotificacion] ?? false;
    }
}
