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
            'products' => $products,
            'status_code' => 200
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        dd($request->all());
        // $file = '';
        // $upload_path = public_path('uploads/products');

        // if ($request->hasFile('imageOne')) {
        //     $file = $request->file('imageOne');
        //     $nameOne = time()."_".$file->getClientOriginalName();
        //     $file->move($upload_path, $nameOne);
        //     // $product->imageOne = $name;
        //     // dd($name);
        // }
        // if ($request->hasFile('imageTwo')) {
        //     $file = $request->file('imageTwo');
        //     $nameTwo = time()."_".$file->getClientOriginalName();
        //     $file->move($upload_path, $nameTwo);
        // }
        // if ($request->hasFile('imageThree')) {
        //     $file = $request->file('imageThree');
        //     $nameThree = time()."_".$file->getClientOriginalName();
        //     $file->move($upload_path, $nameThree);
        // }
        // $product = new Product();
        // $product->categories()->attach($request->category_id);
        // $product->create(array_merge($request->all(), [
        //     'imageOne' => $nameOne,
        //     'imageTwo' => $nameTwo,
        //     'imageThree' => $nameThree,
        // ]));

        // return response()->json([
        //     'message' => 'Product Created Successfully',
        //     'status_code' => 200
        // ], 200);
        // $product = Product::create([
        //     'title' => $request->title,
        //     'codreturn response()->json([
        //     'message' => 'Product Created Successfully',
        //     'status_code' => 200
        // ], 200);e' => $request->code,
        //     'price' => $request->price,
        //     'discount' => $request->discount,
        //     'smallDescription' => $request->smallDescription,
        //     'description' => $request->description,
        //     'imageOne' => $request->imageOne,
        //     'imageTwo' => $request->imageTwo,
        //     'imageThree' => $request->imageThree,
        // ]);
        // $product->categories()->attach($request->category_id);

        // 

    }



    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        return response()->json([
            'product' => $product,
            'status_code' => 200
        ], 200);
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
