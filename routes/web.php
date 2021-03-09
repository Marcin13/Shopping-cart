<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
//Route::livewire('/', 'home')->name('home');
Route::get('/' , App\Http\Livewire\Home::class);
Route::any('/products', App\Http\Livewire\Products::class)->name('products');
Route::get('/cart', App\Http\Livewire\Cart::class)->name('cart');

