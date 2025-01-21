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
        Schema::create('rutinas_ejercicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rutina_id')->constrained(
                table: 'rutinas'
            );
            $table->foreignId('ejercicio_id')->constrained(
                table: 'ejercicios'
            );
            $table->string("paciente_feedback", 120)->nullable();
            $table->string("profesional_feedback", 120)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutinas_ejercicios');
    }
};
