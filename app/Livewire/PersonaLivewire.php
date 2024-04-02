<?php

namespace App\Livewire;

use App\Livewire\Form\PersonaForm;
use Livewire\Component;
use App\Models\Persona;
use App\Models\Pais;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\WithPagination;


class PersonaLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $searchPersona;
    public $idPersona = "";
    public $openModalNew = false;
    public $openModalEdit = false;
    
    public PersonaForm $persona;

    public function closeModal()
    {
        $this->reset(['openModalNew', 'openModalEdit']);
    }

    public function render()
    {
        // $personas = Persona::where('nombre', 'like', '%' . $this->search . '%')
        //                     ->orWhere('apellido', 'like', '%' . $this->search . '%')
        //                     ->orWhere('ci', 'like', '%' . $this->search . '%')
        //                     ->orWhere('correo', 'like', '%' . $this->search . '%')
        //                     ->orderBy('id','desc')
        //                     ->paginate(5);

        $personas = DB::table("v_persona")
                        ->where('nombre', 'like', '%' . $this->search . '%')
                        ->orWhere('pais', 'like', '%' . $this->search . '%')
                        ->orWhere('apellido', 'like', '%' . $this->search . '%')
                        ->orWhere('ci', 'like', '%' . $this->search . '%')
                        ->orWhere('correo', 'like', '%' . $this->search . '%')
                        ->orderBy('id','desc')
                        ->paginate(5);

        $paises = Pais::all();         
        return view('livewire.persona.persona-livewire', compact('personas', 'paises'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function created()
    {
        $this->persona->validate();
        // dd($this->persona);
        $persona =  Persona::create([
            'id_pais' => $this->persona->id_pais, 
            'nombre' => $this->persona->nombre, 
            'apellido' => $this->persona->apellido, 
            'ci' => $this->persona->ci, 
            'complemento_ci' => $this->persona->complemento_ci, 
            'correo' => $this->persona->correo, 
            'fecha_nac' => $this->persona->fecha_nac, 
            'telefono' => $this->persona->telefono, 
            'telefono2' => $this->persona->telefono2, 
        ]);

       $response = $persona ? true : false;
       $this->dispatch('notificar', message: $response);
       $this->reset(['openModalNew', 'openModalEdit','persona', 'search']);
    }

    public function edit($id)
    {
        $this->idPersona = $id;
        $persona = Persona::find($id);
        
        $this->persona->fill([
            'id_pais' => $persona->id_pais,
            'nombre' => $persona->nombre,
            'apellido' => $persona->apellido,
            'ci' => $persona->ci,
            'complemento_ci' => $persona->complemento_ci,
            'correo' => $persona->correo,
            'fecha_nac' => $persona->fecha_nac,
            'telefono' => $persona->telefono,
            'telefono2' => $persona->telefono2,
        ]);

        $this->openModalEdit = true;
    }

    public function update()
    {
        $id = $this->idPersona;

        $this->persona->validate();

        $persona = Persona::find($id);
        $persona = $persona->update($this->persona->only('id_pais','nombre', 'apellido', 'ci', 'complemento_ci', 'correo', 'fecha_nac','telefono', 'telefono2'));

        $response = $persona ? true : false;
        $this->reset(['openModalNew', 'openModalEdit','persona', 'search']);
        $this->dispatch('notificar', message: $response);
    }

    #[On('delete')]
    public function destroy($id)
    {

        $persona = Persona::find($id);
        $estado = $persona->estado;

        if($estado == 1)
        {
            $persona->estado = 0;
        }else{
            $persona->estado = 1;
        }

        $persona->save();
    }
}
