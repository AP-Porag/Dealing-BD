<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class CategoryComponent extends Component
{
    public $sorting;
    public $pageSize;
    public $category_slug;

    public function mount($category_slug)
    {
        $this->sorting = "default";
        $this->pageSize = 12;
        $this->category_slug = $category_slug;
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
        $category = Category::where('slug',$this->category_slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;
        if ($this->sorting == 'date'){
            $products = Product::where('id',$category_id)->orderBy('created_at','DESC')->paginate($this->pageSize);
        }elseif ($this->sorting == 'price'){
            $products = Product::where('id',$category_id)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }elseif ($this->sorting == 'price-desc'){
            $products = Product::where('id',$category_id)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }else{
            $products = Product::where('id',$category_id)->paginate($this->pageSize);
        }

        $categories = Category::all();
        return view('livewire.category-component',['products'=>$products,'categories'=>$categories,'category_name'=>$category_name])->layout('layouts.base');
    }
}
