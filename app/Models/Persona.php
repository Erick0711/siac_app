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
        'nombre',
        'apellido',
        'ci',
        'complemento',
        'correo',
        'telefono',
        'telefono2',
        'estado'
    ];
    protected $timestamp = false;
}
