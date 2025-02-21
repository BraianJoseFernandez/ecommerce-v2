<?php

namespace App\Livewire\Forms\Admin\Options;

use App\Models\Option;
use Livewire\Attributes\Validate;
use Livewire\Form;

class NewOptionForm extends Form
{
    public $name = '';
    public $type = 1;
    public $features = [
        [
            'description' => '',
            'value' => ''
        ]
    ];
    public $openModal = false;


    public function rules()
    {
        $rules = [
            'name' => 'required',
            'type' => 'required|in:1,2',
            'features' => 'required|array|min:1',
            'features.*.description' => 'required|max:255',
            'features.*.value' => 'required_if:type,1|regex:/^#[a-f0-9]{6}$/i'
        ];

        foreach ($this->features as $index => $feature) {
            $rules['features.' . $index . '.description'] = 'required|max:255';
            if ($this->type == 1) {
                $rules['features.' . $index . '.value'] = 'required';
            } else {
                // si es un color
                $rules['features.' . $index . '.value'] = 'required|regex:^#[a-f0-9]{6}$/i';
            }
        }

        return $rules;
    }

    public function addFeature()
    {
        $this->features[] = [
            'description' => '',
            'value' => ''
        ];
    }

    public function removeFeature($index)
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function validationAttributes()
    {
        return [
            'name' => 'nombre',
            'type' => 'tipo',
            'features' => 'Valores',
            'features.*.description' => 'descripción',
            'features.*.value' => 'valor'
        ];
    }

    public function save(){
        $this->validate();

        $option = Option::create([
            'name' => $this->name,
            'type' => $this->type
        ]);

        foreach ($this->features as $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description']
            ]);
        }

        $this->reset();

    }
}
