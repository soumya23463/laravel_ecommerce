<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;


class CartController extends Controller

{
    public function index()
    {
        $cartItems = Cart::instance('cart')->content();
        return view('cart', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        Cart::instance('cart')->add($request->id, $request->name, $request->quantity, $request->price)->associate('App\Models\Product');
        return redirect()->back();
        // session()->flash('success', 'Product is Added to Cart Successfully !');
        // return response()->json(['status'=>200,'message'=>'Success ! Item Successfully added to your cart.']);
    }
}