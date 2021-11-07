<?php

use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',HomeComponent::class)->name('home');
Route::get('/shop',ShopComponent::class)->name('shop');
Route::get('/cart',CartComponent::class)->name('cart');
Route::get('/checkout',CheckoutComponent::class)->name('checkout');
Route::get('/product/{slug}',DetailsComponent::class)->name('product-details');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

//routes for user or customer
Route::middleware(['auth:sanctum', 'verified'])->group(function (){
    Route::get('/user/dashboard',UserDashboardComponent::class)->name('user-dashboard');
});

//routes for admin
Route::middleware(['auth:sanctum', 'verified','authAdmin'])->group(function (){
    Route::get('/admin/dashboard',AdminDashboardComponent::class)->name('admin-dashboard');
});
