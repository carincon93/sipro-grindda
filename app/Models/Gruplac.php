<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Gruplac extends Model
{
    use HasFactory;

    protected $table = 'gruplac';

    protected $fillable = [
        'codigo', // varchar 191 required
    ];
}
