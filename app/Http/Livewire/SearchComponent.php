<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class SearchComponent extends Component
{
    public $sorting;
    public $pageSize;

    public $search;
    public $product_cat;
    public $product_cat_id;

    public function mount()
    {
        $this->sorting = "default";
        $this->pageSize = 12;

        $this->fill(request()->only('search','product_cat','product_cat_id'));

    }
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        Session::flash('success_message', 'Item added in cart');
        return redirect()->route('cart');
    }
    use WithPagination;
    public function render()
    {
        if ($this->sorting == 'date'){
            $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('created_at','DESC')->paginate($this->pageSize);
        }elseif ($this->sorting == 'price'){
            $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }elseif ($this->sorting == 'price-desc'){
            $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }else{
            $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->paginate($this->pageSize);
        }

        $categories = Category::all();
        return view('livewire.search-component',['products'=>$products,'categories'=>$categories])->layout('layouts.base');
    }
}
