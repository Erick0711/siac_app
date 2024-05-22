<?php

namespace App\Livewire;


use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\Articulo;
use App\Models\TipoPago;
use App\Models\Deuda;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;
use App\Livewire\Form\CuentaCopropietarioForm;
use App\Models\Pago;
use Carbon\Carbon;

class PagoLivewire extends Component
{

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $searchCopropietario;
    public $selectedCopropietario = false;
    public $obtenerIdCopropietario = "";

    public $openModalNew = false;
    public $openModalEdit = false;
    public $articulosPago = [];
    public $pagoDisabled = true;
    public $tipopago;
    // public $deudas = [];

    public $idCuentaCopropietarioArreglo = [];
    public $totalPago = 0;
    public $efectivo = 0;
    public $selectedDeudasArreglo = [];
    public $selectedArticulos = [];
    public $selectedArticulo = null;
    public $selectedArticulosDetalles = [];

    public function resetAttribute()
    {
    $this->reset(['openModalNew', 'openModalEdit', 'search', 'selectedCopropietario', 'obtenerIdCopropietario', 'articulosPago', 'pagoDisabled', 'idCuentaCopropietarioArreglo', 'totalPago', 'efectivo', 'selectedDeudasArreglo', 'selectedArticulos', 'selectedArticulo', 'selectedArticulosDetalles', 'searchCopropietario']);
    }


    // public function mount($deudas)
    // {
    //     $this->deudas = $deudas;
    // }

    // public function updatedSelectedDeudas($value, $index)
    // {
    //     if (!empty($this->deudasCopropietario) && array_key_exists($index, $this->deudasCopropietario)) {
    //         if ($value) {
    //             $this->totalPago += $this->deudasCopropietario[$index]['debe'];
    //         } else {
    //             $this->totalPago -= $this->deudasCopropietario[$index]['debe'];
    //         }
    //     }
    // }

    public function guardarSeleccion()
    {
        if ($this->selectedArticulo && !in_array($this->selectedArticulo, $this->selectedArticulos)) {
            $articulo = DB::table("v_articulo")->where('id', $this->selectedArticulo)->where('estado', 1)->first();
            if ($articulo) {
                $this->selectedArticulos[] = $this->selectedArticulo;
                $this->selectedArticulosDetalles[] = $articulo;
                $this->totalPago += $articulo->monto;
            }
        }
    }
    
    public function eliminarArticulo($idArticulo)
    {
        if (($key = array_search($idArticulo, $this->selectedArticulos)) !== false) {
            $articulo = $this->selectedArticulosDetalles[$key];
            unset($this->selectedArticulos[$key]);
            unset($this->selectedArticulosDetalles[$key]);
            $this->selectedArticulos = array_values($this->selectedArticulos); // Reindex the array
            $this->selectedArticulosDetalles = array_values($this->selectedArticulosDetalles); // Reindex the array
            $this->totalPago -= $articulo->monto;
        }
    }
    
    public function selectedDeudas($debe, $idCuentaCopropietario, $isChecked)
    {
        if ($isChecked) {
            $this->selectedDeudasArreglo[] = $debe;
            $this->idCuentaCopropietarioArreglo[] = $idCuentaCopropietario;
        } else {
            $key = array_search($debe, $this->selectedDeudasArreglo);
            if ($key !== false) {
                unset($this->selectedDeudasArreglo[$key]);
                unset($this->idCuentaCopropietarioArreglo[$key]);
                $this->selectedDeudasArreglo = array_values($this->selectedDeudasArreglo); // Reindex the array
                $this->idCuentaCopropietarioArreglo = array_values($this->idCuentaCopropietarioArreglo); // Reindex the array
            }
        }
        $this->totalPago = array_sum($this->selectedDeudasArreglo) + array_sum(array_column($this->selectedArticulosDetalles, 'monto'));
    }
    

    public function closeModal()
    {
        $this->resetAttribute();
        // $this->resetErrorBag();
        $this->resetValidation();
    }

    public function seleccionarCopropietario($id)
    {
        $this->obtenerIdCopropietario = $id;
        $this->selectedCopropietario = !$this->selectedCopropietario;
        $this->pagoDisabled = !$this->pagoDisabled;
        if(!$this->selectedCopropietario)
        {
            $this->reset(['obtenerIdCopropietario']);
        }
    }

    public function render()
    {
        
        $copropietarios = collect();

        if(!empty($this->searchCopropietario))
        {
            $copropietarios = DB::table('v_copropietario')
                                    ->where('estado', 1) 
                                    ->where(function($query) {
                                        $query->where('nombre', 'like', '%' . $this->searchCopropietario . '%')
                                            ->orWhere('apellido', 'like', '%' . $this->searchCopropietario . '%')
                                            ->orWhere('ci', 'like', '%' . $this->searchCopropietario . '%');
                                    })
                                    ->orderBy('id', 'desc')
                                    ->limit(5)
                                    ->get();
        }

        // OBTENER TODOS LOS ARTICULOS HABILITADOS DEL PERIODO ACTUAL
        $date = Carbon::now();
        $mes_actual = $date->format('n');
        $anio_actual = $date->format('y');

        $articulos = DB::table('v_articulo')->where('periodo', $mes_actual)->where('nombre', $anio_actual)->groupBy('id')->get();

        $tipopagos = TipoPago::all();

        // Tenemos que buscar si el copropietario tiene deuda
        $deudas = DB::table("v_deuda")->where('id_copropietario', $this->obtenerIdCopropietario)->where('estado', 1)->get();
        
        $articulosPagos = DB::table("v_articulo")->whereIn('id', $this->selectedArticulos)->where('estado', 1)->groupBy('id')->get();

        return view('livewire.pago.pago-livewire', compact('copropietarios', 'articulos', 'tipopagos', 'deudas', 'articulosPagos'));
    }


    public function created()
    {
        if(isset($this->idCuentaCopropietarioArreglo) && !empty($this->idCuentaCopropietarioArreglo))
        {
            foreach($this->idCuentaCopropietarioArreglo as $cuentaCopropietario)
            {
                $cuenta = Pago::find($cuentaCopropietario);
                
                    $cuentaCopro = Pago::create([
                        'id_copropietario' => $cuenta->id_copropietario, 
                        'id_articulo' => $cuenta->id_articulo, 
                        'id_tipopago' => $this->tipopago,
                        'descripcion' => 'PAGO', 
                        'debe' => 0, 
                        'haber' => $cuenta->debe, 
                    ]);

                    if($cuentaCopro)
                    {

                        $deudaCopropietario = Deuda::where('id_pago', $cuentaCopropietario)->where('estado', 1)->first();
                        $deudaCopropietario->estado = 0;
                        $deudaCopropietario->save(); 
                    }
            }

            //if($cuentaCopro)
            //{
               // $response = $cuentaCopro ? true : false;
                //$this->dispatch('notificar', message: $response);
                $this->resetAttribute();
           // }
        }

        if(isset($this->selectedArticulos) && !empty($this->selectedArticulos))
        {
            foreach($this->selectedArticulos as $selectedArticulo)
            {
                // Obtener el monto del articulo establecido
                $articulo = Articulo::find($selectedArticulo);

                $pago = $articulo->monto;

                // * REALIZAMOS DOS INSERCIONES AL PAGO TANTO AL DEBE Y AL HABER
                for ($i=1; $i <= 2; $i++) 
                { 
                    if($i == 1)
                    {
                        $cuentaCopro = Pago::create([
                            'id_copropietario' => $this->obtenerIdCopropietario, 
                            'id_articulo' => $selectedArticulo, 
                            'id_tipopago' => $this->tipopago,
                            'descripcion' => 'COBRO', 
                            'debe' => $pago, 
                            'haber' => 0, 
                        ]);
                    }else{
                        $cuentaCopro = Pago::create([
                            'id_copropietario' => $this->obtenerIdCopropietario, 
                            'id_articulo' => $selectedArticulo, 
                            'id_tipopago' => $this->tipopago,
                            'descripcion' => 'PAGO', 
                            'debe' => 0, 
                            'haber' => $pago, 
                        ]);
                    }
                }
            }
        }

        if($cuentaCopro)
        {
            $this->generatePDF($this->idCuentaCopropietarioArreglo, $this->selectedArticulos, $this->obtenerIdCopropietario);

            // INSERTAMOS EL LINK EN LA TABLA RECIBO
            $response = $cuentaCopro ? true : false;
            $this->dispatch('notificar', message: $response);
            $this->resetAttribute();

        }
    }

    public function generatePDF($arreglo_deudas, $arreglo_articulo, $idCopropietario)
    {
        $data = [
            'title' => 'PDF generado en Laravel',
            'deudas' => $arreglo_deudas,
            'articulos' => $arreglo_articulo
        ];

        // dd($idCopropietario);

        $pdf = PDF::loadView('admin.resiboPDF', $data);
        $pdfPath = 'resiboPDF'; // Cambiar el nombre del archivo PDF si es necesario

        // Storage::put($pdfPath, $pdf->output());

        // Emitir evento para notificar al frontend
        $this->dispatch('pdfGenerated', [
            'url' => $pdfPath,
            'title' => $data['title'],
            'deudas' => $arreglo_deudas,
            'articulos' => $arreglo_articulo, 
            'idCopropietario' => $idCopropietario
        ]);

        // Construimos el link
        $deudas = implode(',', $data['deudas']);
        $articulos = implode(',', $data['articulos']);
        $link = "{$pdfPath}?title={$data['title']}&deudas={$deudas}&articulos={$articulos}&idCopropietario={$idCopropietario}";

        // Insertamos el link en la tabla RECIBO
        DB::table('recibo')->insert([
            'id_copropietario' => $idCopropietario,
            'link' => $link
        ]);
        $this->resetAttribute();

    }
}