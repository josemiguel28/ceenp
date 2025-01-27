<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['nombre', 'codigo', 'descripcion'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'materia_student');
    }

}
