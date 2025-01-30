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
            $table->string('nombre_padre');              // Campo para los nombres
            $table->string('celular_p');              // Campo para los nombres
            $table->string('nombre_madre');              // Campo para los nombres
            $table->string('celular_m');              // Campo para los nombres
            $table->string('direccion');              // Campo para los nombres
            $table->string('persona_autorizada1')->nullable(); // Para la primera persona autorizada
            $table->string('parentesco1')->nullable();
            $table->string('celular1')->nullable();
            $table->string('persona_autorizada2')->nullable(); // Para la segunda persona autorizada
            $table->string('parentesco2')->nullable();
            $table->string('celular2')->nullable();
            $table->string('persona_autorizada3')->nullable();   // Campo para las personas autorizadas (usamos 'text' para mayor flexibilidad)
            $table->string('parentesco3')->nullable();
            $table->string('celular3')->nullable();
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
