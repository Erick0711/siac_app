<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    use HasFactory;
    protected $table = "deuda";
    
    protected $fillable = [
        'id_pago',
        'estado',
    ];

    protected $timestamp = false;
}
