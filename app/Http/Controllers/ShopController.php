<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size') ? $request->query('size') : 12;
        $order = $request->query('order') ? $request->query('order') : 'default';
        $f_brands = $request->query('brands');
        $f_categories = $request->query('categories');
        if ($order == 'date') {
            $products = Product::where(function ($query) use ($f_brands) {
                $query->whereIn('brand_id', explode(',', $f_brands))->orWhereRaw("'" . $f_brands . "' = ''");
            })
                ->where(function ($query) use ($f_categories) {
                    $query->whereIn('category_id', explode(',', $f_categories))->orWhereRaw("'" . $f_categories . "' = ''");
                })
                ->orderBy('created_at', 'DESC')->paginate($size);
        } else if ($order == "price") {
            $products = Product::where(function ($query) use ($f_brands) {
                $query->whereIn('brand_id', explode(',', $f_brands))->orWhereRaw("'" . $f_brands . "' = ''");
            })
                ->where(function ($query) use ($f_categories) {
                    $query->whereIn('category_id', explode(',', $f_categories))->orWhereRaw("'" . $f_categories . "' = ''");
                })
                ->orderBy('regular_price', 'ASC')->paginate($size);
        } else if ($order == "price-desc") {
            $products = Product::where(function ($query) use ($f_brands) {
                $query->whereIn('brand_id', explode(',', $f_brands))->orWhereRaw("'" . $f_brands . "' = ''");
            })
                ->where(function ($query) use ($f_categories) {
                    $query->whereIn('category_id', explode(',', $f_categories))->orWhereRaw("'" . $f_categories . "' = ''");
                })
                ->orderBy('regular_price', 'DESC')->paginate($size);
        } else {
            $products = Product::where(function ($query) use ($f_brands) {
                $query->whereIn('brand_id', explode(',', $f_brands))->orWhereRaw("'" . $f_brands . "' = ''");
            })
                ->where(function ($query) use ($f_categories) {
                    $query->whereIn('category_id', explode(',', $f_categories))->orWhereRaw("'" . $f_categories . "' = ''");
                })
                ->paginate($size);
        }
        $categories = Category::orderBy("name", "ASC")->get();
        $brands = Brand::orderBy("name", "ASC")->get();
        return view('shop', compact("products", "size", "order", "categories", "brands", "f_brands", "f_categories"));
    }

    public function product_details($product_slug)
    {
        $product = Product::where("slug", $product_slug)->first();
        $rproducts = Product::where("slug", "<>", $product_slug)->get()->take(8);
        return view('details', compact("product", "rproducts"));
    }
}