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
        Schema::create('materiales', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); // Título del recurso
            $table->text('descripcion')->nullable(); // Descripción opcional
            $table->string('archivo'); // Ruta del archivo (PDF, video, etc.)
            $table->foreignId('materia_id')->constrained()->onDelete('cascade'); // Relación con la materia
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el maestro
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales');
    }
};
