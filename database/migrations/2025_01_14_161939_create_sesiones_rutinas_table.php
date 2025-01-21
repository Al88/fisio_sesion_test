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
        Schema::create('sesiones_rutinas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesion_id')->constrained(
                table: 'sesiones'
            );
            $table->foreignId('rutina_id')->constrained(
                table: 'rutinas'
            );
            $table->string("paciente_feedback", 120);
            $table->string("profesional_feedback", 120);
            $table->dateTime("fecha_hora");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesiones_rutinas');
    }
};
