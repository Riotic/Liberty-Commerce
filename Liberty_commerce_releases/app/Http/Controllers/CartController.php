<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Cart;

class CartController extends Controller
{
    

    public function cartList()
    {
        $cartItems = \Cart::getContent();
        return view('carts.cart', compact('cartItems'));
    }
      public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
            'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');
        return redirect()->route('products.index');
    }
    //function buynow 
    public function addAndBuyNow(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
            'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');
        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        session()->flash('success', 'Item Cart is Updated Successfully !');
        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');
        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();
        session()->flash('success', 'All Item Cart Clear Successfully !');
        return redirect()->route('cart.list');
    }
    public function checkout(Request $request)
    {
        $order= array();        
        $order['user_id']= Auth::user()->id;
        // ->compact();->to_array();
        // $cartItems = 
        // $brutText = "";
        // foreach($cartItems as $item)
        // {   
        //     $temp=$brutText;
        //     $itemData=$item->id.",".$item->name.",".$item->quantity.",".$item->attributes->image.";";
        //     $brutText=$temp.$itemData;
        // }
        
        $order['order'] = $request->order;
        $order['qtyOfItems'] = $request->qtyOfItems;
        $order['totalPrice'] = $request->totalPrice;
        $store = Order::create($order);
        return view('carts.cart');
    }
}