<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table = "pago";
    
    protected $fillable = [
        'id_copropietario',
        'id_articulo',
        'id_tipopago',
        'descripcion',
        'debe',
        'haber',
        'estado'
    ];

    protected $timestamp = false;
}
