<?php

namespace App\Livewire\Admin\Products;

use App\Models\Feature;
use App\Models\Option;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductVariants extends Component
{
    public $variant = [
        'option_id' => '',
        'features' => [
            [
                'id' => '',
                'value' => '',
                'description' => ''
            ]
        ],
    ];

    public $product;
    public $openModal = false;
    public $options;


    public function mount()
    {
        $this->options = Option::all();
    }

    public function updatedVariantOptionId()
    {
        $this->variant['features'] = [
            [
                'id' => '',
                'value' => '',
                'description' => ''
            ]
        ];
    }

    #[Computed()]
    public function features()
    {
        return Feature::where('option_id', $this->variant['option_id'])->get();
    }

    public function addFeature()
    {
        $this->variant['features'][] = [
            'id' => '',
            'value' => '',
            'description' => ''
        ];
    }

    public function removeFeature($index)
    {
        unset($this->variant['features'][$index]);
        $this->variant['features'] = array_values($this->variant['features']);
    }

    public function save()
    {
        $this->validate([
            'variant.option_id' => 'required',
            'variant.features.*.id' => 'required',
            'variant.features.*.value' => 'required',
            'variant.features.*.description' => 'required',
        ], [
            'variant.option_id.required' => 'La opción es requerida',
            'variant.features.*.id.required' => 'El ID #:position es requerido',
            'variant.features.*.value.required' => 'El valor #:position es requerido',
            'variant.features.*.description.required' => 'La descripción #:position es requerida',
        ]);

        $this->product->options()->attach($this->variant['option_id'], [
            'features' => $this->variant['features']
        ]);

        $this->product = $this->product->fresh();

        $this->reset(['variant', 'openModal']);

        $this->openModal = false;
    }

    public function feature_change($index)
    {
        $feature = Feature::find($this->variant['features'][$index]['id']);

        if ($feature) {
            $this->variant['features'][$index]['value'] = $feature->value;
            $this->variant['features'][$index]['description'] = $feature->description;
        }
    }

    public function deleteFeature($optionId, $featureId){
        $this->product->options()->UpdateExistingPivot($optionId, ['features' => array_filter($this->product->options()->find($optionId)->pivot->features, function($feature) use ($featureId){
            return $feature['id'] != $featureId;
        })]);

        $this->product = $this->product->fresh();
    }

    public function confirmDeleteOption($OptionId){
        $this->product->options()->detach($OptionId);
        $this->product = $this->product->fresh();
    }

    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }
}
