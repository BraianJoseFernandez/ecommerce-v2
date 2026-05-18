<?php

namespace App\Livewire\Products;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddToCart extends Component
{

    public $product;

    public $qty = 1;

    public function increment() {
        $this->qty++;
    }

    public function decrement() {
        if($this->qty > 1) {
            $this->qty--;
        }
    }

    public function add_to_cart() {
        Cart::instance('shopping');
        Cart::add([
            'id'       => $this->product->id,
            'name'     => $this->product->name,
            'qty'      => $this->qty,
            'price'    => $this->product->price,
            'options'  => [
                'image' => $this->product->image,
                'sku'   => $this->product->sku,
                'features'  => [],
            ]
        ]);

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdated', Cart::count());


        $this->dispatch('swal',[
            'title' => '¡Producto agregado!',
            'text' => 'El producto ha sido agregado al carrito',
            'icon' => 'success',
            'timer' => 1500,
            'showConfirmButton' => false
        ]);
    }

    public function render()
    {
        return view('livewire.products.add-to-cart');
    }
}
