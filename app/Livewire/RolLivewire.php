<?php

namespace App\Livewire;

use App\Livewire\Form\RolForm;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolLivewire extends Component
{

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $openModalEdit = false;
    public $openModalNew = false;
    public $selectedPermission = [];
    public $idRol;

    public RolForm $rol;

    
    public function closeModal()
    {
        $this->reset(['openModalNew', 'openModalEdit', 'search', 'rol', 'selectedPermission']);
    }


    public function render()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('livewire.rol.rol-livewire', compact('roles','permissions'));
    }

    public function created()
    {
        $role = Role::create([
            'name' => $this->rol->name
        ]);
        $selectedPermission = array_keys(array_filter($this->selectedPermission));
        $role->permissions()->sync($selectedPermission);
    }

    public function edit($id)
    {
        $this->openModalEdit = true;
        $this->idRol = $id;
        $rol = Role::find($id);
        $this->rol->name = $rol->name;
        // Obtener los permisos asociados al rol
        $selectedPermissions = $rol->permissions->pluck('id')->toArray();

        // Inicializar el array selectedPermission con los permisos asociados al rol
        foreach ($selectedPermissions as $permissionId) {
            $this->selectedPermission[$permissionId] = true;
        }
    }

    public function update()
    {
        $this->openModalEdit = false;

        $id = $this->idRol;
        $rol = Role::find($id);
        $rol->update(['name' => $this->rol->name]);
        
        $selectedPermission = array_keys(array_filter($this->selectedPermission));
        $rol->permissions()->sync($selectedPermission);
    }
}
