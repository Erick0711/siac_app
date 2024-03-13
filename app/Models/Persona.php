<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'persona';
    protected $primaryKey  = "id";
    protected $fillable = [
        'id',
        'nombre_pers',
        'apellido_pers',
        'ci_pers',
        'complemento_ci',
        'correo_pers',
        'telefono_pers',
        'telefono2_pers',
        'estado_pers'
    ];
    protected $timestamp = false;
}
