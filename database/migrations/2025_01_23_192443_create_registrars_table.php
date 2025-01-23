<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrars', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');              // Campo para los nombres
            $table->string('apellidos');            // Campo para los apellidos
            $table->string('centro_infantil');      // Campo para el centro infantil
            $table->string('personas_autorizadas');   // Campo para las personas autorizadas (usamos 'text' para mayor flexibilidad)
            $table->string('parentesco');           // Campo para el parentesco
            $table->string('celular');
            $table->string('fotografia'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrars');
    }
};
