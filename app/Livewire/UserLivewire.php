<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use App\Livewire\Form\UsersForm;

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
    public $openModalEdit = false;
    public $openModalNew = false;
    public $idUsuario;
    public $selectedRoles = [];
    
    public UsersForm $usuarios;

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
        return view('livewire.user.user-livewire', compact('users', 'roles'));
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
}
