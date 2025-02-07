<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'fecha_entrega', 'materia_id'];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Entregas de los estudiantes
    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}
