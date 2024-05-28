<?php

namespace App\Livewire;

use App\Models\Gestion;
use App\Models\Periodo;
use Livewire\Component;
use Livewire\WithPagination;
class ReporteIngresoLivewire extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $idPais = "";

    public $openModalNew = false;
    public $openModalEdit = false;
    public $idGestion = "";

    public function resetAttribute()
    {
        $this->reset(['openModalNew', 'openModalEdit', 'search', 'idPais', 'pais']);
    }

    public function closeModal()
    {
        $this->resetAttribute();
        $this->resetValidation();
    }

    public function selectedGestion($id)
    {
        $this->idGestion = $id;
    }

    public function render()
    {
        $gestiones = Gestion::where('estado', 1)->orderBy('id', 'desc')->get();
        $periodos = collect();

        if(isset($this->idGestion) && !empty($this->idGestion))
        {
            $periodos = Periodo::where('id_gestion', $this->idGestion)->get();
        }

        return view('livewire.reportes.ingreso', compact('gestiones', 'periodos'));
    }

}
