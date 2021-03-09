<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Helpers\Cart;
use Illuminate\Support\Facades\Lang;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * @method alert(string $string, mixed $get)
 */
class Products extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(): void
    {
        $this->search = request()->query('search', $this->search);
    }


    public function render()
    {
        $products =  $this->search === null ?
            Product::paginate(12) :
            Product::where('name', 'like', '%' . $this->search . '%')->paginate(12);

        return view('livewire.products', ['products' => $products]);

    }

    public function addToCart(int $productId): void
    {
        (new \App\Helpers\Cart)->add(Product::where('id', $productId)->first());

        $this->alert('success', Lang::get('swal.addToCart'));
        $this->emit('productAdded');
    }
}
