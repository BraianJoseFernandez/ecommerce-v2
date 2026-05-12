<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Option;
use Livewire\WithPagination;
use App\Models\Product;
use Livewire\Attributes\On;




class Filter extends Component
{
    use WithPagination;

    public $family_id;
    public $options;
    public $category_id;
    public $subcategory_id;
    public $selected_features = [];
    public $search;
    public $orderBy = 1;

    public function mount()
    {

        $this->options = Option::verifyFamily($this->family_id)
        ->verifyCategory($this->category_id)
        ->verifySubcategory($this->subcategory_id)
        ->get()->toArray();
       
    }

    #[On('search')]
    public function search($search)
    {
        $this->search = $search;
    }
    
    public function render()
    {

        $products = Product::verifyFamily($this->family_id)
        ->verifyCategory($this->category_id)
        ->verifySubcategory($this->subcategory_id)
        ->customOrder($this->orderBy)
        ->selectFeature($this->selected_features)
        ->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->paginate(12);
        
        return view('livewire.filter', compact('products'));
    }
}
