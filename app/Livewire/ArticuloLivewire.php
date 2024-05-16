<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Periodo;
use App\Models\Articulo;
use App\Models\TipoArticulo;
use Illuminate\Support\Facades\DB;
use App\Livewire\Form\ArticuloForm;
use Carbon\Carbon;

class ArticuloLivewire extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $idArticulo = "";

    public $openModalNew = false;
    public $openModalEdit = false;

    public ArticuloForm $articulo;

    public function resetAttribute()
    {
        $this->reset(['openModalNew', 'openModalEdit', 'search', 'idArticulo', 'articulo']);
    }

    public function closeModal()
    {
        $this->resetAttribute();
        $this->resetValidation();
    }

    public function render()
    {
        $date = Carbon::now();
        $anio_actual = $date->format('Y');
        $articulos = DB::table("v_articulo")
                        ->where('descripcion', 'like', '%' . $this->search . '%')
                        ->orWhere('gestion', 'like', '%' . $this->search . '%')
                        ->orWhere('tipoarticulo', 'like', '%' . $this->search . '%')
                        ->groupBy('id')
                        ->orderBy('id', 'desc')
                        ->paginate(5);

        $periodos = DB::table('v_periodo')->where('gestion', $anio_actual)->get();
        $tipoarticulos = TipoArticulo::all();

        return view('livewire.articulo.articulo-livewire', compact('articulos', 'periodos', 'tipoarticulos'));
    }

    public function created()
    {
        $this->articulo->validate();
        $articulo = Articulo::create([
            'id_periodo' => $this->articulo->id_periodo, 
            'id_tipoarticulo' => $this->articulo->id_tipoarticulo, 
            'descripcion' => $this->articulo->descripcion, 
            'monto' => $this->articulo->monto, 
        ]);

        $response = $articulo ? true : false;
        $this->dispatch('notificar', message: $response);
        $this->resetAttribute();
    }

    public function edit($id)
    {
        $this->idArticulo = $id;
        $articulo = Articulo::find($id);
        
        $this->articulo->fill([
            'id_periodo' => $articulo->id_periodo, 
            'id_tipoarticulo' => $articulo->id_tipoarticulo, 
            'descripcion' => $articulo->descripcion, 
            'monto' => $articulo->monto, 
        ]);

        $this->openModalEdit = true;
    }

    public function update()
    {
        $id = $this->idArticulo;

        $this->articulo->validate();

        $articulo = Articulo::find($id);
        $articulo = $articulo->update($this->articulo->only('id_periodo', 'id_tipoarticulo', 'descripcion', 'monto'));

        $response = $articulo ? true : false;
        $this->resetAttribute();
        $this->dispatch('notificar', message: $response);
    }

    #[On('delete')]
    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $estado = $articulo->estado;

        if($estado == 1)
        {
            $articulo->estado = 0;
        }else{
            $articulo->estado = 1;
        }
        $articulo->save();
    }
}
