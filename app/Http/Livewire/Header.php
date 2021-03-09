<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;
use App\Helpers\Cart;

class Header extends Component
{
    public $cartTotal = 0;
    public $priceTotal = 0;

    protected $listeners = [
        'productAdded' => 'updateCartTotal',
        'productRemoved' => 'updateCartTotal',
        'clearCart' => 'updateCartTotal'
    ];

    public function mount(): void
    {
        $this->cartTotal = count((new \App\Helpers\Cart)->get()['products']);
    }

    public function render(): View
    {
        return view('livewire.header');
    }

    public function updateCartTotal(): void
    {
        $this->cartTotal = count((new \App\Helpers\Cart)->get()['products']);
    }
}
