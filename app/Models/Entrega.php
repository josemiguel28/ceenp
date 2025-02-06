<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
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
