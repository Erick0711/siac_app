<?php

namespace App\Livewire\Form;

use Livewire\Form;

class PeriodoForm extends Form
{

    public $id_gestion;
    public $nombre;


    public function rules()
    {
        return [
            'id_gestion' => 'required|integer|exists:gestion,id',
            'nombre' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'id_gestion.required' => 'El campo ID de Gestión es obligatorio.',
            'id_gestion.integer' => 'El campo ID de Gestión debe ser un número entero.',
            'id_gestion.exists' => 'El valor proporcionado para ID de Gestión no existe en la base de datos.',
    
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'nombre.string' => 'El campo Nombre debe ser una cadena de caracteres.',
            'nombre.max' => 'El campo Nombre no puede exceder los :max caracteres.',
        ];
    }
    public function validationAttributes()
    {
        return [
            'id_gestion' => 'ID de Gestión',
            'nombre' => 'Nombre',
        ];
    }
}
