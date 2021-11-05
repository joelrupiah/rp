<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function products()
    // {
    //     return Product::with('category')->get();
    // }
    public function index()
    {
        $products = Product::with('categories')->get();

        return response()->json([
            'products' => $products
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'title' => $request->title,
            'code' => $request->code,
            'price' => $request->price,
            'discount' => $request->discount,
            'smallDescription' => $request->smallDescription,
            'description' => $request->description,
            'imageOne' => $request->imageOne,
            'imageTwo' => $request->imageTwo,
            'imageThree' => $request->imageThree,
        ]);
        $product->categories()->attach($request->category_id);

    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product);

        $product->categories()->detach($category_id);
    }
}
