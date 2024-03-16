<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use App\Livewire\Form\UsersForm;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;

class UserLivewire extends Component
{
    use WithPagination;

    // public function __construct()
    // {
    //     // $this->middleware('can:login')->only('render');
    //     $this->middleware('can:login')->only('edit');
    // }

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $searchPersona;
    public $obtenerIdPersona = "";
    public $openModalEdit = false;
    public $openModalNew = false;
    public $idUsuario;
    public $selectedRoles = [];
    public $selectedPersona = false;
    
    public UsersForm $usuarios;

    public $password = "";
    public $confirmPassword = "";


    public function seleccionarPersona($id)
    {
        $this->obtenerIdPersona = $id;
        $this->selectedPersona = !$this->selectedPersona;

        if(!$this->selectedPersona)
        {
            $this->reset(['obtenerIdPersona']);
        }
    }

    public function closeModal()
    {
        $this->reset(['openModalNew', 'openModalEdit', 'idUsuario', 'usuarios']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name','LIKE', '%'.$this->search.'%')
                    ->orWhere('email','LIKE', '%'.$this->search.'%')
                    ->paginate(5);
        $roles = Role::all();
        $personas = collect();

        if(!empty($this->searchPersona))
        {
            $personas = Persona::where('nombre_pers', 'like', '%' . $this->searchPersona . '%')
                                ->orWhere('apellido_pers', 'like', '%' . $this->searchPersona . '%')
                                ->orWhere('ci_pers', 'like', '%' . $this->searchPersona . '%')
                                ->orWhere('correo_pers', 'like', '%' . $this->searchPersona . '%')
                                ->orderBy('id','desc')
                                ->limit(5)
                                ->get();
        }

        return view('livewire.user.user-livewire', compact('users', 'roles', 'personas'));
    }

    public function edit($id)
    {
        $this->idUsuario = $id;
        $user = User::find($id);
        $this->usuarios->email = $user->email;
        $this->openModalEdit = true;
    }
    
    public function update()
    {
        $id = $this->idUsuario;
        
        $request = User::find($id);
        $selectedRoles = array_keys(array_filter($this->selectedRoles));
        $request->roles()->sync($selectedRoles);
        $this->dispatch('notificar', message: true);
    }

    public function create()
    {
        $this->usuarios->persona_id = $this->obtenerIdPersona;

        // dd($this->usuarios->persona_id);
        // Buscamos el dato nombre y apellido en la persona
        $persona = Persona::find($this->obtenerIdPersona);

        $nombre_persona = $persona->nombre_pers ." ". $persona->apellido_pers;


        $usuario =  User::create([
            'persona_id' => $this->usuarios->persona_id, 
            'name' => $nombre_persona,
            'email' => $this->usuarios->email,
            'password' => Hash::make($this->usuarios->password),
        ]);

       $response = $usuario ? true : false;
       $this->dispatch('notificar', message: $response);
    //    $this->reset(['openModalNew', 'obtenerIdPersona', 'usuarios', 'search', 'selectedPersona', 'searchPersona']);
    }
}
