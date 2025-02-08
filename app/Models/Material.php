<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'materiales';

    protected $fillable = [
        'titulo',
        'descripcion',
        'archivo',
        'materia_id',
        'user_id',
    ];

    // Relación con la materia
    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    // Relación con el maestro
    public function maestro()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
