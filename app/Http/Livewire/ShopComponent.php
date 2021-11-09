<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        Session::flash('success_message', 'Item added in cart');
        return redirect()->route('cart');
    }
    use WithPagination;
    public function render()
    {
        $products = Product::paginate(12);
        return view('livewire.shop-component',['products'=>$products])->layout('layouts.base');
    }
}
