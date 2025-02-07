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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // Título de la tarea
            $table->text('descripcion')->nullable(); // Descripción de la tarea
            $table->dateTime('fecha_entrega'); // Fecha de entrega
            $table->string('archivo')->nullable(); // Ruta del archivo (opcional)
            $table->foreignId('materia_id')->constrained()->onDelete('cascade'); // Relación con la materia
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el maestro que creó la tarea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
