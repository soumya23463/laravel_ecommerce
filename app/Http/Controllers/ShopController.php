<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {

        $size = $request->query('size') ? $request->query('size') : 2;

        $order = $request->query('order') ? $request->query('order') : -1;
        if ($order == 'date') {
            $products = Product::orderBy('created_at', 'DESC')->paginate($size);
        } else if ($order == "price") {
            $products = Product::orderBy('regular_price', 'ASC')->paginate($size);
        } else if ($order == "price-desc") {
            $products = Product::orderBy('regular_price', 'DESC')->paginate($size);
        } else {
            $products = Product::paginate($size);
        }

        return view('shop', compact("products", "size", "order"));
    }

    public function product_details($product_slug)
    {
        $product = Product::where("slug", $product_slug)->first();
        $rproducts = Product::where("slug", "<>", $product_slug)->get()->take(8);
        return view('details', compact("product", "rproducts"));
    }
}