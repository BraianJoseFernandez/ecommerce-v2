<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;

class ProductVariants extends Component
{
    public $variant = [
        'option_id' => '',
        'features' => [],
    ];


    public function render()
    {
        return view('livewire.admin.products.product-variants');
    }
}
