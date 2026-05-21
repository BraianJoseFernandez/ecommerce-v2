<?php

namespace App\Livewire;

use App\Models\Adress;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Forms\CreateAddressForm;

class ShippingAdresses extends Component
{

    public $adresses;
    public $new_adress = true;

    public CreateAddressForm $CreateAdress;

    public function mount()
    {
        $this->adresses = Adress::where('user_id', auth()->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.shipping-adresses');
    }
}
