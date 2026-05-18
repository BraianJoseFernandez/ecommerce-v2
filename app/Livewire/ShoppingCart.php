<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCart extends Component
{

    public $cart;

    public function mount()
    {
        Cart::instance('shopping');
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }

    public function increase($rowId)
    {
        if (auth()->check()) {
            Cart::store(auth()->id());
        }
        Cart::instance('shopping')->update($rowId, Cart::get($rowId)->qty + 1);
        $this->dispatch('cartUpdated', Cart::count());
    }

    public function decrease($rowId)
    {
        if (auth()->check()) {
            Cart::store(auth()->id());
        }
        Cart::instance('shopping');
        $item = Cart::get($rowId);
        if ($item->qty > 1) {
            Cart::update($rowId, $item->qty - 1);
        }else{
            Cart::remove($rowId);
        }
        $this->dispatch('cartUpdated', Cart::count());
    }

    public function remove($rowId)
    {
        if (auth()->check()) {
            Cart::store(auth()->id());
        }
        Cart::instance('shopping')->remove($rowId);
        $this->dispatch('cartUpdated', Cart::count());
    }

    public function clearCart()
    {
        if (auth()->check()) {
            Cart::store(auth()->id());
        }
        Cart::instance('shopping')->destroy();
        $this->dispatch('cartUpdated', Cart::count());
    }
   
}
