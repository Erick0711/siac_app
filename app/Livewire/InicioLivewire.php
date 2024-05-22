<?php

namespace App\Livewire;

use App\Models\Copropietario;
use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class InicioLivewire extends Component
{

    public $total_egresos = 0;



    public function render()
    {

        $date = Carbon::now();
        $mes_actual = $date->format('n');
        $anio_actual = $date->format('y');
        $gestion = $date->format('Y');
        $cantidad_copropietarios = Copropietario::count();
        $pago_realizados =  DB::table('v_pago')->where('periodo', $mes_actual)->where('sigla_gestion', $anio_actual)->where('estado', 1)->sum('haber');   
        $residentes_totales = Copropietario::sum('cant_residentes');
        $total_mascotas = Copropietario::sum('cant_mascotas');
        $pago_deuda = DB::table('v_deuda')->where('periodo', $mes_actual)->where('gestion', $gestion)->where('estado', 1)->sum('debe');                                                                 

        return view('livewire.inicio-livewire', compact('cantidad_copropietarios', 'pago_realizados', 'residentes_totales', 'total_mascotas', 'pago_deuda'));
    }


}
