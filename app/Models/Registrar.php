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
        'direccion',           // Si también necesitas 'CI'
        'nombre_padre',       // Agrega 'nombre' a la lista de campos fillable
        'celular_p',       // Agrega 'nombre' a la lista de campos fillable
        'nombre_madre',       // Agrega 'nombre' a la lista de campos fillable
        'celular_m',       // Agrega 'nombre' a la lista de campos fillable
        'persona_autorizada1',           // Si también necesitas 'CI'
        'parentesco1',
        'celular1',
        'persona_autorizada2',           // Si también necesitas 'CI'
        'parentesco2',
        'celular2',
        'persona_autorizada3',           // Si también necesitas 'CI'
        'parentesco3',
        'celular3',
        'fotografia',   // Si también necesitas 'fotografia'
              // Si también necesitas 'celular'
    ];
}
