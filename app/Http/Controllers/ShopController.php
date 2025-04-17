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
        $min_price = $request->query('min') ? $request->query('min') : 1;
        $max_price = $request->query('max') ? $request->query('max') : 10000;
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
            $products = Product::whereBetween('regular_price', [$min_price, $max_price])
                ->where(function ($query) use ($f_brands) {
                    $query->whereIn('brand_id', explode(',', $f_brands))->orWhereRaw("'" . $f_brands . "' = ''");
                })
                ->where(function ($query) use ($f_categories) {
                    $query->whereIn('category_id', explode(',', $f_categories))->orWhereRaw("'" . $f_categories . "' = ''");
                })
                ->paginate($size);
        }
        $categories = Category::orderBy("name", "ASC")->get();
        $brands = Brand::orderBy("name", "ASC")->get();
        return view('shop', compact("products", "size", "order", "min_price", "max_price", "categories", "brands", "f_brands", "f_categories"));
    }


    //     public function index(Request $request)
    // {
    //     // Default values
    //     $size = $request->query('size', 12);
    //     $order = $request->query('order', 'default');
    //     $f_brands = $request->query('brands', '');
    //     $f_categories = $request->query('categories', '');
    //     $min_price = $request->query('min', 1);
    //     $max_price = $request->query('max', 10000);

    //     // Convert comma-separated filters to arrays
    //     $brandIds = $f_brands ? explode(',', $f_brands) : [];
    //     $categoryIds = $f_categories ? explode(',', $f_categories) : [];

    //     // Build the base query
    //     $query = Product::query();

    //     // Filter by price
    //     $query->whereBetween('regular_price', [$min_price, $max_price]);

    //     // Filter by brands if any selected
    //     if (!empty($brandIds)) {
    //         $query->whereIn('brand_id', $brandIds);
    //     }

    //     // Filter by categories if any selected
    //     if (!empty($categoryIds)) {
    //         $query->whereIn('category_id', $categoryIds);
    //     }

    //     // Apply sorting
    //     switch ($order) {
    //         case 'date':
    //             $query->orderBy('created_at', 'DESC');
    //             break;
    //         case 'price':
    //             $query->orderBy('regular_price', 'ASC');
    //             break;
    //         case 'price-desc':
    //             $query->orderBy('regular_price', 'DESC');
    //             break;
    //         default:
    //             // No special order
    //             break;
    //     }

    //     // Get paginated products
    //     $products = $query->paginate($size);

    //     // Fetch all categories and brands
    //     $categories = Category::orderBy('name')->get();
    //     $brands = Brand::orderBy('name')->get();

    //     // Return to the view
    //     return view('shop', compact(
    //         'products',
    //         'size',
    //         'order',
    //         'min_price',
    //         'max_price',
    //         'categories',
    //         'brands',
    //         'f_brands',
    //         'f_categories'
    //     ));
    // }

    public function product_details($product_slug)
    {
        $product = Product::where("slug", $product_slug)->first();
        $rproducts = Product::where("slug", "<>", $product_slug)->get()->take(8);
        return view('details', compact("product", "rproducts"));
    }
}