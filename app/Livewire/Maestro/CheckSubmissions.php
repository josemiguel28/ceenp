<?php

namespace App\Livewire\Maestro;

use Livewire\Component;

class CheckSubmissions extends Component
{

    public $entregas;

    public function calificar(){
        // Asignar la calificación
        $this->entrega->calificacion = $request->calificacion;
        $this->entrega->comentario_maestro = $request->observacion;
        $this->entrega->save();
    }

    public function render()
    {
        return view('livewire..maestro.check-submissions');
    }
}
