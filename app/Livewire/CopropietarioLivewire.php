<?php

namespace App\Livewire;

use App\Models\Apartamento;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Persona;
use App\Models\Copropietario;
use App\Livewire\Form\CopropietarioForm;

class CopropietarioLivewire extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $searchPersona;
    public $selectedPersona = false;
    public $obtenerIdPersona = "";
    public $idCopropietario = "";

    public $openModalNew = false;
    public $openModalEdit = false;

    public CopropietarioForm $copropietario;

    public function resetAttribute()
    {
        $this->reset(['openModalNew', 'openModalEdit', 'search', 'selectedPersona', 'obtenerIdPersona', 'idCopropietario', 'searchPersona', 'copropietario']);
    }
    

    public function closeModal()
    {
        $this->resetAttribute();
        // $this->resetErrorBag();
        $this->resetValidation();
    }


    public function render()
    {
        $copropietarios = DB::table('v_copropietario')
                            ->where('nombre', 'like', '%' . $this->search . '%')
                            ->orWhere('apellido', 'like', '%' . $this->search . '%')
                            ->orWhere('ci', 'like', '%' . $this->search . '%')
                            ->orWhere('pais', 'like', '%' . $this->search . '%')
                            ->orderBy('id','desc')
                            ->paginate(10);

        $personas = collect();

        if(!empty($this->searchPersona))
        {
            $personas = Persona::where('nombre', 'like', '%' . $this->searchPersona . '%')
                                ->orWhere('apellido', 'like', '%' . $this->searchPersona . '%')
                                ->orWhere('ci', 'like', '%' . $this->searchPersona . '%')
                                ->orWhere('correo', 'like', '%' . $this->searchPersona . '%')
                                ->orderBy('id','desc')
                                ->limit(5)
                                ->get();
        }

        $apartamentos = Apartamento::where('estado', 1)->get();

        return view('livewire.copropietario.copropietario-livewire', compact('copropietarios', 'personas', 'apartamentos'));
    }

    public function seleccionarPersona($id)
    {
        $this->obtenerIdPersona = $id;
        $this->selectedPersona = !$this->selectedPersona;

        if(!$this->selectedPersona)
        {
            $this->reset(['obtenerIdPersona']);
        }
    }

    public function created()
    {
        $this->copropietario->id_persona = $this->obtenerIdPersona;
        // $this->funcionario->validate();

        $copropietario = Copropietario::create([
            'id_persona' => $this->copropietario->id_persona, 
            'id_apartamento' => $this->copropietario->id_apartamento, 
            'cant_residentes' => $this->copropietario->cant_residentes, 
            'cant_mascotas' => $this->copropietario->cant_mascotas, 
        ]);
       $response = $copropietario ? true : false;
       $this->dispatch('notificar', message: $response);
       $this->resetAttribute();
    }


}
