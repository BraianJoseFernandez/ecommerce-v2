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

    public $selected_features = [];

    public $search;
    public $orderBy = 1;

    public function mount($family_id)
    {
       $this->options = Option::whereHas('products.subcategory.category', function ($query)  {
            $query->where('family_id', $this->family_id);
        })->with([
            'features' => function ($query) {
                $query->whereHas('variants.product.subcategory.category', function ($query)  {
                    $query->where('family_id', $this->family_id);
                });
            }
        ])->get()->toArray();
       
    }

    #[On('search')]
    public function search($search)
    {
        $this->search = $search;
    }
    
    public function render()
    {

        $products = Product::whereHas('subcategory.category', function ($query) {
            $query->where('family_id', $this->family_id);
        })
        ->when($this->orderBy == 1, function ($query) {
            $query->orderBy('created_at', 'desc');
        })
        ->when($this->orderBy == 2, function ($query) {
            $query->orderBy('price', 'desc');
        })
        ->when($this->orderBy == 3, function ($query) {
            $query->orderBy('price', 'asc');
        })
        ->when($this->selected_features, function ($query) {
            $query->whereHas('variants.features', function ($query) {
                $query->whereIn('features.id', $this->selected_features);
            });
        })
        ->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->paginate(12);
        
        return view('livewire.filter', compact('products'));
    }
}
