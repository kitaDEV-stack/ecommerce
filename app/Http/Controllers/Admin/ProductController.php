<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('backend.products.index',compact('categories','products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount_price',
            'quantity' => 'required',
            'image' => ['mimes:png,jpg'],
            'category' => 'required',
        ]);

        $newProduct = $request->all();

        if ($img = $request->file('image')) {
            $path = "products_img";
            $ext = date('YmdHis') . "." . $img->getClientOriginalExtension();
            $img->move($path, $ext);
            $newProduct['image'] = $ext;
        }
            Product::create($newProduct);
        return redirect()->route('admin.products.create')->with('success', 'New Product Created Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('backend.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount_price',
            'quantity' => 'required',
            'image' => ['mimes:png,jpg'],
            'category' => 'required',
        ]);

        $newProduct = $request->all();

        if ($img = $request->file('image')) {
            $path = "products_img";
            $ext = date('YmdHis') . "." . $img->getClientOriginalExtension();
            $img->move($path, $ext);
            $newProduct['image'] = $ext;
        }else{
            unset($newProduct['image']);
        }
           $product->update($newProduct);
        return redirect()->route('admin.products.index')->with('success', 'Product Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $img_name = $product->image;
        $img_path = public_path('products_img/' . $img_name);
        if (File::exists($img_path)) {
            File::delete($img_path);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product Deleted Successfully');

    }
}
