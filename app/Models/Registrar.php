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
        'persona_autorizada1',           // Si también necesitas 'CI'
        'persona_autorizada2',           // Si también necesitas 'CI'
        'persona_autorizada3',           // Si también necesitas 'CI'
        'parentesco',           // Si también necesitas 'CI'
        'celular',
        'fotografia',   // Si también necesitas 'fotografia'
              // Si también necesitas 'celular'
    ];
}
