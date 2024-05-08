<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Apartamento;

class VehiculoLivewire extends Component
{
    public function render()
    {
        return view('livewire.vehiculo.vehiculo-livewire');
    }
}
