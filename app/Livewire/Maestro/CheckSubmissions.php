<?php
namespace App\Livewire\Maestro;

use App\Models\Entrega;
use Livewire\Component;

class CheckSubmissions extends Component
{
    public $entrega;
    public $calificacion;
    public $observacion;

    public function mount(Entrega $entrega)
    {
        $this->entrega = $entrega;
        $this->calificacion = $entrega->calificacion;
        $this->observacion = $entrega->comentario_maestro;
    }

    public function saveSubmission()
    {
        // Validar los datos antes de guardar
        $this->validate([
            'calificacion' => 'required|numeric|min:0|max:10',
        ]);

        // Guardar la información en la base de datos
        $this->entrega->calificacion = $this->calificacion;
        $this->entrega->comentario_maestro = $this->observacion;
        $this->entrega->save();

        session()->flash('success', 'Calificación guardada correctamente.');
    }

    public function render()
    {
        return view('livewire.maestro.check-submissions');
    }
}

