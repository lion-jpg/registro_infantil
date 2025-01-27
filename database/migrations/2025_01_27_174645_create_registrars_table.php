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
            $table->string('persona_autorizada1')->nullable(); // Para la primera persona autorizada
            $table->string('persona_autorizada2')->nullable(); // Para la segunda persona autorizada
            $table->string('persona_autorizada3')->nullable();   // Campo para las personas autorizadas (usamos 'text' para mayor flexibilidad)
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
