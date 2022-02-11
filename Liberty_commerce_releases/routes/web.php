<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        $products = Product::all();
        // récupére les données de la table produits
        return view('products.index', [
            'products' => $products
        ]);
        // permet de les afficher
   });
});

Route::resource('products', ProductController::class);

Route::resource('user', UserController::class);
Route::resource('order', OrderController::class);

Route::get('/admin', function () {
    if (! Gate::allows('access-admin')) {
        return 'ACCESS DENIED';
    }
    return view('products.create');
});


Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('cart-buynow', [CartController::class, 'addAndBuyNow'])->name('cart.buynow');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::post('cart-checkout', [CartController::class, 'checkout'])->name('cart.checkout');

require __DIR__.'/auth.php';
 