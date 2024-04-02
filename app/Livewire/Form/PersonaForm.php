<?php

namespace App\Livewire\Form;

use Livewire\Form;

class PersonaForm extends Form
{
    public $id_pais;
    public $nombre;
    public $apellido;
    public $ci;
    public $complemento_ci;
    public $correo;
    public $fecha_nac;
    public $telefono;
    public $telefono2;


    public function rules()
    {
        return [
            'id_pais' => 'required|exists:pais,id', 
            'nombre' => 'required|alpha',
            'apellido' => 'required|alpha',
            'ci' => 'required|numeric',
            'complemento_ci' => 'nullable|string',
            'correo' => 'required|email',
            'fecha_nac' => 'required|date',
            'telefono' => 'required|numeric',
            'telefono2' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'id_pais.required' => 'El campo ID de país es requerido.',
            'id_pais.exists' => 'El ID de país no existe en la tabla de países.',
            'nombre.required' => 'El campo nombre es requerido.',
            'nombre.alpha' => 'El campo nombre debe ser una cadena de texto.',
            'apellido.required' => 'El campo apellido es requerido.',
            'apellido.alpha' => 'El campo apellido debe ser una cadena de texto.',
            'ci.required' => 'El campo CI es requerido.',
            'ci.numeric' => 'El campo CI debe ser un valor numérico.',
            'correo.required' => 'El campo correo electrónico es requerido.',
            'correo.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
            'fecha_nac.required' => 'El campo fecha de nacimiento es requerido.',
            'fecha_nac.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
            'telefono.required' => 'El campo teléfono es requerido.',
            'telefono.numeric' => 'El campo teléfono debe ser un valor numérico.',
            'telefono2.numeric' => 'El campo teléfono2 debe ser un valor numérico.',
        ];
    }

    public function validationAttributes()
    {
        return [
            'id_pais' => 'País',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'ci' => 'CI',
            'complemento_ci' => 'Complemento de CI',
            'correo' => 'Correo electrónico',
            'fecha_nac' => 'Fecha de nacimiento',
            'telefono' => 'Teléfono',
            'telefono2' => 'Teléfono 2',
        ];
    }
}
