<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;


class AdminController extends Controller
{
    public function index()
    {
        return view("admin.index");
    }
    public function brands()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);
        return view('admin.brands', compact('brands'));
    }

    public function add_brands()
    {

        return view('admin.brand-add');
    }
    public function brand_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp . '.' . $file_extention;
        $this->GenerateBrandThumbailImage($image, $file_name);
        $brand->image = $file_name;
        $brand->save();
        return redirect()->route('admin.brands')->with('status', 'Record has been added successfully !');
    }



    public function edit_brand($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand-edit', compact('brand'));
    }

    public function update_brand(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,' . $request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $brand = Brand::find($request->id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        if ($request->hasFile('image')) {
            if (File::exists(public_path('uploads/brands') . '/' . $brand->image)) {
                File::delete(public_path('uploads/brands') . '/' . $brand->image);
            }
            $image = $request->file('image');
            $file_extention = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp . '.' . $file_extention;
            $this->GenerateBrandThumbailImage($image, $file_name);
            $brand->image = $file_name;
        }
        $brand->save();
        return redirect()->route('admin.brands')->with('status', 'Record has been updated successfully !');
    }

    public function delete_brand($id)
    {
        $brand = Brand::find($id);
        if (File::exists(public_path('uploads/brands') . '/' . $brand->image)) {
            File::delete(public_path('uploads/brands') . '/' . $brand->image);
        }
        $brand->delete();
        return redirect()->route('admin.brands')->with('status', 'Record has been deleted successfully !');
    }

    public function categories()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view("admin.categories", compact('categories'));
    }

    public function add_category()
    {
        return view("admin.category-add");
    }


    public function add_category_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extention = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp . '.' . $file_extention;
        $this->GenerateBrandThumbailCategories($image, $file_name);
        $category->image = $file_name;
        $category->save();
        return redirect()->route('admin.categories')->with('status', 'Record has been added successfully !');
    }

    public function GenerateBrandThumbailImage($image, $imageName)
    {
        $designationPath = public_path('uploads/brands');
        // Make sure the directory exists
        $img = Image::read($image->path());
        $img->cover(124, 124, "top");
        $img->resize(124, 124, function ($constraint) {
            $constraint->aspectRatio();
        })->save($designationPath . '/' . $imageName);
    }
    public function GenerateBrandThumbailCategories($image, $imageName)
    {
        $designationPath = public_path('uploads/categories');
        // Make sure the directory exists
        $img = Image::read($image->path());
        $img->cover(124, 124, "top");
        $img->resize(124, 124, function ($constraint) {
            $constraint->aspectRatio();
        })->save($designationPath . '/' . $imageName);
    }

    public function edit_category($id)
    {
        $category = Category::find($id);
        return view('admin.category-edit', compact('category'));
    }

    public function update_category(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $request->id,
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = $request->slug;

        if ($request->hasFile('image')) {
            if (File::exists(public_path('uploads/categories/' . $category->image))) {
                File::delete(public_path('uploads/categories/' . $category->image));
            }

            $image = $request->file('image');
            $file_extention = $image->extension(); // Corrected here
            $file_name = Carbon::now()->timestamp . '.' . $file_extention;

            $this->GenerateBrandThumbailCategories($image, $file_name);
            $category->image = $file_name;
        }

        $category->save();
        return redirect()->route('admin.categories')->with('status', 'Record has been updated successfully !');
    }
    public function delete_category($id)
    {
        $category = Category::find($id);
        if (File::exists(public_path('uploads/categories') . '/' . $category->image)) {
            File::delete(public_path('uploads/categories') . '/' . $category->image);
        }
        $category->delete();
        return redirect()->route('admin.categories')->with('status', 'Record has been deleted successfully !');
    }


    public function products()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.product', compact('products'));
    }

    public function products_add()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $brands = Brand::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-add', compact('categories', 'brands'));
    }
    public function products_store(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug',
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);

        // Create a new product instance
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        // Upload main image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();

            // Custom image handler
            $this->GenerateProductThumbnailImage($image, $imageName);

            $product->image = $imageName;
        }

        // Handle gallery images
        $gallery_arr = array();
        $counter = 1;

        if ($request->hasFile('images')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            $files = $request->file('images');
            $current_timestamp = Carbon::now()->timestamp;

            foreach ($files as $file) {
                $gextension = $file->getClientOriginalExtension();
                $gcheck = in_array($gextension, $allowedfileExtension);

                if ($gcheck) {
                    $gfileName = $current_timestamp . "-" . $counter . "." . $gextension;

                    // Custom gallery image handler
                    $this->GenerateProductImages($file, $gfileName);

                    array_push($gallery_arr, $gfileName);
                    $counter++;
                }
            }

            $product->images = implode(",", $gallery_arr);
        } else {
            $product->images = null;
        }

        // Save product to DB
        $product->save();

        return redirect()->route('admin.products')->with('status', 'Product has been added successfully!');
    }

    public function GenerateProductThumbnailImage($image, $imageName)
    {
        $designationPath = public_path('uploads/products/thumbnails');
        // Make sure the directory exists
        $img = Image::read($image->path());
        $img->cover(124, 124, "top");
        $img->resize(124, 124, function ($constraint) {
            $constraint->aspectRatio();
        })->save($designationPath . '/' . $imageName);
    }
    public function GenerateProductImages($image, $imageName)
    {
        $designationPath = public_path('uploads/products');
        // Make sure the directory exists
        $img = Image::read($image->path());
        $img->cover(124, 124, "top");
        $img->resize(124, 124, function ($constraint) {
            $constraint->aspectRatio();
        })->save($designationPath . '/' . $imageName);
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        $categories = Category::Select('id', 'name')->orderBy('name')->get();
        $brands = Brand::Select('id', 'name')->orderBy('name')->get();
        return view('admin.product-edit', compact('product', 'categories', 'brands'));
    }


    // public function update_product(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'slug' => 'required|unique:products,slug,' . $request->id,
    //         'category_id' => 'required',
    //         'brand_id' => 'required',
    //         'short_description' => 'required',
    //         'description' => 'required',
    //         'regular_price' => 'required',
    //         'sale_price' => 'required',
    //         'SKU' => 'required',
    //         'stock_status' => 'required',
    //         'featured' => 'required',
    //         'quantity' => 'required',
    //         'image' => 'required|mimes:png,jpg,jpeg|max:2048'
    //     ]);

    //     $product = Product::find($request->id);

    //     $product->name = $request->name;
    //     $product->slug = Str::slug($request->name);
    //     $product->category_id = $request->category_id;
    //     $product->brand_id = $request->brand_id;
    //     $product->short_description = $request->short_description;
    //     $product->description = $request->description;
    //     $product->regular_price = $request->regular_price;
    //     $product->sale_price = $request->sale_price;
    //     $product->SKU = $request->SKU;
    //     $product->stock_status = $request->stock_status;
    //     $product->featured = $request->featured;
    //     $product->quantity = $request->quantity;

    //     $current_timestamp = Carbon::now()->timestamp;

    //     // Handle main image
    //     if ($request->hasFile('image')) {
    //         // Delete old image if exists
    //         // if (File::exists(public_path('uploads/products/' . $product->image))) {
    //         //     File::delete(public_path('uploads/products/' . $product->image));
    //         // }
    //         // if (File::exists(public_path('uploads/products/thumbnails/' . $product->image))) {
    //         //     File::delete(public_path('uploads/products/thumbnails/' . $product->image));
    //         // }

    //         $file_ext = $request->file('image')->extension();
    //         $file_name = $current_timestamp . '.' . $file_ext;
    //         $path = $request->image->storeAs('products', $file_name, 'public');
    //         $product->image = $path;
    //     }

    //     // Handle gallery images
    //     if ($request->hasFile('images')) {
    //         // Delete old gallery images
    //         // if (!empty($product->images)) {
    //         //     foreach (explode(',', $product->images) as $ofile) {
    //         //         if (File::exists(public_path('uploads/products/' . trim($ofile)))) {
    //         //             File::delete(public_path('uploads/products/' . trim($ofile)));
    //         //         }
    //         //         if (File::exists(public_path('uploads/products/thumbnails/' . trim($ofile)))) {
    //         //             File::delete(public_path('uploads/products/thumbnails/' . trim($ofile)));
    //         //         }
    //         //     }
    //         // }

    //         // Save new gallery images
    //         $allowedfileExtension = ['jpg', 'png', 'jpeg'];
    //         $files = $request->file('images');
    //         $gallery_arr = [];
    //         $counter = 1;

    //         foreach ($files as $file) {
    //             $gext = $file->getClientOriginalExtension();
    //             if (in_array($gext, $allowedfileExtension)) {
    //                 $gfilename = $current_timestamp . '-' . $counter . '.' . $gext;
    //                 $gpath = $file->storeAs('products', $gfilename, 'public');
    //                 $gallery_arr[] = $gpath;
    //                 $counter++;
    //             }
    //         }

    //         $product->images = implode(', ', $gallery_arr);
    //     }

    //     $product->save();

    //     return redirect()->route('admin.products')->with('status', 'Record has been updated successfully!');
    // }

    public function update_product(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:products,slug,' . $request->id,
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sale_price' => 'required',
            'SKU' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Find product
        $product = Product::findOrFail($request->id);

        // Update fields
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->regular_price = $request->regular_price;
        $product->sale_price = $request->sale_price;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;

        // Upload new image if provided
        if ($request->hasFile('image')) {
            $oldImage = $product->image;

            $image = $request->file('image');
            $imageName = Carbon::now()->timestamp . '.' . $image->getClientOriginalExtension();

            // Generate new thumbnail + image
            $this->GenerateProductThumbnailImage($image, $imageName);
            $product->image = $imageName;

            // Delete old image
            if ($oldImage && File::exists(public_path('uploads/products/' . $oldImage))) {
                File::delete(public_path('uploads/products/' . $oldImage));
            }
            if ($oldImage && File::exists(public_path('uploads/products/thumbnails/' . $oldImage))) {
                File::delete(public_path('uploads/products/thumbnails/' . $oldImage));
            }
        }

        // Handle gallery images (optional)
        $gallery_arr = [];
        $counter = 1;

        if ($request->hasFile('images')) {
            // Delete old gallery images
            if ($product->images) {
                foreach (explode(',', $product->images) as $oldFile) {
                    if (File::exists(public_path('uploads/products/' . $oldFile))) {
                        File::delete(public_path('uploads/products/' . $oldFile));
                    }
                    if (File::exists(public_path('uploads/products/thumbnails/' . $oldFile))) {
                        File::delete(public_path('uploads/products/thumbnails/' . $oldFile));
                    }
                }
            }

            $files = $request->file('images');
            $timestamp = Carbon::now()->timestamp;

            foreach ($files as $file) {
                $gextension = $file->getClientOriginalExtension();
                if (in_array($gextension, ['jpg', 'png', 'jpeg'])) {
                    $gfilename = $timestamp . '-' . $counter . '.' . $gextension;

                    $this->GenerateProductImages($file, $gfilename);

                    array_push($gallery_arr, $gfilename);
                    $counter++;
                }
            }

            $product->images = implode(',', $gallery_arr);
        }

        $product->save();

        return redirect()->route('admin.products')->with('status', 'Product updated successfully!');
    }
}