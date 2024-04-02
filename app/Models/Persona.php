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
        'id_pais',
        'nombre',
        'apellido',
        'ci',
        'complemento_ci',
        'correo',
        'fecha_nac',
        'telefono',
        'telefono2',
        'estado'
    ];
    protected $timestamp = false;
}
