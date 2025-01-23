<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrar extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombres',       // Agrega 'nombre' a la lista de campos fillable
        'apellidos',     // Si también necesitas 'apellido'
        'centro_infantil',           // Si también necesitas 'CI'
        'personas_autorizadas',           // Si también necesitas 'CI'
        'parentesco',           // Si también necesitas 'CI'
        'celular',
        'fotografia',   // Si también necesitas 'fotografia'
              // Si también necesitas 'celular'
    ];
}
