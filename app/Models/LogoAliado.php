<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class LogoAliado extends Model
{
    use HasFactory;

    protected $table = 'logos_aliados';

    protected $fillable = [
        'logo', // string required
    ];
}
