<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;
    protected $fillable = ['tarea_id', 'user_id', 'archivo', 'comentario_alumno', 'comentario_maestro', 'calificacion'];

    // Relación con la tarea
    public function tarea()
    {
        return $this->belongsTo(Tarea::class);
    }

    // Relación con el estudiante que envió la tarea
    public function estudiante()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
