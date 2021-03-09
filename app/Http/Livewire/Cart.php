<?php

namespace App\Http\Livewire;

use App\Helpers\Cart as CartFacade;
use App\Models\Product;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;

class Cart extends Component
{
    public $productId;
    public $cart;
    public $totalPrice;
    //Register event listeners
    //https://laravel-livewire.com/docs/2.x/events
    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function mount(): void
    {
        $this->cart = (new \App\Helpers\Cart)->get();
    }

    public function render()
    {
        $totalPrice = 1;
        return view('livewire.cart',compact('totalPrice'));
    }

    public function removeFromCart($productId): void
    {
        $this->productId = $productId;
        //dd($productId);
        //$this->product = $product;
        // flash()->overlay('You remove it', 'You remove item')->livewire($this);
        //(new \App\Helpers\Cart)->remove($productId);
        $this->cart = (new \App\Helpers\Cart)->get();
        $this->confirm(Lang::get('swal.doYouWantRemoveThisFromCart'), [
            'toast' => false,
            'position' =>  'center',
            'timer' =>  6000,
            'showConfirmButton' => true,
            'cancelButtonText' => 'No',
           // 'onConfirmed' => 'confirmed',
            'onConfirmed' => 'confirmed', $productId, //  Should works but is nit working https://github.com/mattlibera/livewire-flash
            'onCancelled' => 'cancelled'
        ]);
    }

    public function checkout(): void
    {
        (new \App\Helpers\Cart)->clear();
        $this->cart = (new \App\Helpers\Cart)->get();
        $this->emit('clearCart');
    }

    public function confirmed(): void
    {
        $this->cart = (new \App\Helpers\Cart)->get();
        $this->alert(
            'success',
            Lang::get('swal.youRemoveFromCart', ['attribute' => Product::where('id', $this->productId)->first()->name]),[
                ]);
        (new \App\Helpers\Cart)->remove($this->productId);
        $this->emit('clearCart');
        $this->cart = (new \App\Helpers\Cart)->get();
    }
    public function cancelled()
    {
        $this->cart = (new \App\Helpers\Cart)->get();
        $this->alert('success',
                     Lang::get('swal.understudyYouWantToKeep',['attribute' => Product::where('id', $this->productId)->first()->name]),[

            ]);
    }

}
