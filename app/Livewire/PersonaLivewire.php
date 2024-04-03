<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\WithPagination;
class PersonaLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $searchPersona;
    public $obtenerIdPersona = "";
    public $openModalNew = false;

    public function render()
    {
        // $personas = Persona::view()::where('nombre', 'like', '%' . $this->search . '%')
        //                             ->orWhere('apellido', 'like', '%' . $this->search . '%')
        //                             ->orWhere('ci', 'like', '%' . $this->search . '%')
        //                             ->orWhere('correo', 'like', '%' . $this->search . '%')
        //                             ->orderBy('id','desc')
        //                             ->paginate(5);

        $personas = DB::table('v_persona')->where('nombre', 'like', '%' . $this->search . '%')
                                        ->orWhere('apellido', 'like', '%' . $this->search . '%')
                                        ->orWhere('ci', 'like', '%' . $this->search . '%')
                                        ->orWhere('pais', 'like', '%' . $this->search . '%')
                                        ->orWhere('correo', 'like', '%' . $this->search . '%')
                                        ->orderBy('id','desc')
                                        ->paginate(5);

        return view('livewire.persona.persona-livewire', compact('personas'));
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
