<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateAddressForm extends Form
{
    public $type              = '';
    public $description       = '';
    public $city              = '';
    public $reference         = '';
    public $receiver          = 1;
    public $receiver_info     = [];
    public $postal_code       = '';
    public $default           = false;

    public function setRules(): array
    {
        return [
            'type'              => 'required|string',
            'description'       => 'required|string',
            'city'              => 'required|string',
            'reference'         => 'required|string',
            'receiver'          => 'required|int',
            'receiver_info'     => 'required|array',
            'postal_code'       => 'required|string',
            'default'           => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required'             => 'El tipo es requerido',
            'description.required'      => 'La descripcion es requerida',
            'city.required'             => 'La ciudad es requerida',
            'reference.required'        => 'La referencia es requerida',
            'receiver.required'         => 'El receptor es requerido',
            'receiver_info.required'    => 'La informacion del receptor es requerida',
            'postal_code.required'      => 'El codigo postal es requerido',
            'default.required'          => 'El default es requerido',
        ];
    }
}
