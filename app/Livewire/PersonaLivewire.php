<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persona;
use Livewire\WithPagination;

class PersonaLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $searchPersona;
    public $obtenerIdPersona = "";

    public function render()
    {
        $personas = Persona::where('nombre_pers', 'like', '%' . $this->search . '%')
                                    ->orWhere('apellido_pers', 'like', '%' . $this->search . '%')
                                    ->orWhere('ci_pers', 'like', '%' . $this->search . '%')
                                    ->orWhere('correo_pers', 'like', '%' . $this->search . '%')
                                    ->orderBy('id','desc')
                                    ->paginate(5);

        return view('livewire.persona.persona-livewire', compact('personas'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

}
