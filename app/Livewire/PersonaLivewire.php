<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persona;

class PersonaLivewire extends Component
{
    public function render()
    {
        $personas = Persona::where('nombre_pers', 'like', '%' . $this->buscador . '%')
                                    ->orWhere('apellido_pers', 'like', '%' . $this->buscador . '%')
                                    ->orWhere('ci_pers', 'like', '%' . $this->buscador . '%')
                                    ->orWhere('correo_pers', 'like', '%' . $this->buscador . '%')
                                    ->orderBy('id_persona','desc')
                                    ->paginate(5);

        return view('livewire.persona.persona-livewire', compact('personas'));
    }
}
