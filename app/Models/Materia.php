<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'semestre', 'codigo', 'descripcion'];

    // Relación con estudiantes (tabla pivote: materia_student)
    public function estudiantes()
    {
        return $this->belongsToMany(User::class, 'materia_student');
    }

    // Relación con maestros (tabla pivote: materia_teacher)
    public function maestros()
    {
        return $this->belongsToMany(User::class, 'materia_teacher');
    }

}
