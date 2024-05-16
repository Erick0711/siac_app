<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $table = "articulo";
    protected $fillable = [
        'id_periodo',
        'id_tipoarticulo',
        'descripcion',
        'monto',
        'estado'
    ];

    protected $timestamp = false;
}
