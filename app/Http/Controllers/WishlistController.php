<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Surfsidemedia\Shoppingcart\Facades\Cart;

class WishlistController extends Controller
{
    //
    public function add_to_wishlist(Request $request)
    {


        Cart::instance('wishlist')->add($request->id, $request->name, $request->quantity, $request->price)->associate('App\Models\Product');
        return redirect()->back();
    }
    public function index()
    {
        $cartItems = Cart::instance('wishlist')->content();
        return view('wishlist', compact('cartItems'));
    }

    public function remove_item_from_wishlist($rowId)
    {
        Cart::instance('wishlist')->remove($rowId);
        return redirect()->back();
    }

    public function empty_wishlist()
    {
        Cart::instance('wishlist')->destroy();
        return redirect()->back();
    }
}
