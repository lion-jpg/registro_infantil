<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',       // Agrega 'nombre' a la lista de campos fillable
        'apellido',     // Si también necesitas 'apellido'
        'CI',           // Si también necesitas 'CI'
        'fotografia',   // Si también necesitas 'fotografia'
        'celular',      // Si también necesitas 'celular'
    ];
}
