<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    public function showCategoryProduct($slug)
    {
        $category = Category::where('slug', $slug)->first();

        $products = Product::whereHas('categories', function ($q) {
            $q->where('category_id', $category->id);
        })->get();

        return response()->json([
            'products' => $products
        ], 200);

    }

    public function showUserProducts()
    {
        $products = Product::with('categories')->get();

        return response()->json([
            'products' => $products,
            'status_code' => 200
        ], 200);
    }

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
        // dd($request->all());
        // return $request;

        $success = true;

        $fileOne = explode(';', $request->imageOne);
        $fileOne = explode('/', $fileOne[0]);
        $file_one_ex = end($fileOne);

        $fileTwo = explode(';', $request->imageTwo);
        $fileTwo = explode('/', $fileTwo[0]);
        $file_two_ex = end($fileTwo);

        $fileThree = explode(';', $request->imageThree);
        $fileThree = explode('/', $fileThree[0]);
        $file_three_ex = end($fileThree);

        $file_one_name = \Str::random(10) . '.' . $file_one_ex;
        $file_two_name = \Str::random(10) . '.' . $file_two_ex;
        $file_three_name = \Str::random(10) . '.' . $file_three_ex;

        $code = rand(9999, 999999);

        $product = Product::create([
            'title' => $request->title,
            'slug' => slugify($request->title),
            'code' => $code,
            'price' => $request->price,
            'discount' => $request->discount,
            'smallDescription' => $request->smallDescription,
            'description' => $request->description,
            'imageOne' => $file_one_name,
            'imageTwo' => $file_two_name,
            'imageThree' => $file_three_name,
        ]);

        $product->categories()->attach($request->category_id);

        Image::make($request->imageOne)->resize(458, 458)->save(public_path('/uploads/products/').$file_one_name);
        
        Image::make($request->imageTwo)->resize(458, 458)->save(public_path('/uploads/products/').$file_two_name);
        
        Image::make($request->imageThree)->resize(458, 458)->save(public_path('/uploads/products/').$file_three_name);

        return response()->json(['success' => $success], 200);

    }

    public function showUserSingleProduct($slug)
    {
        // return $slug;
        $product = Product::where('slug', $slug)->with('categories')->first();
        return response()->json([
            'product' => $product
        ], 200);
    }

    public function show(Product $product)
    {
        // return $product;
        $product = Product::with('categories')->find($product->id);

        return response()->json([
            'product' => $product,
            'status_code' => 200
        ], 200);
    }

    public function edit(Product $product, $slug)
    {
        
    }

    public function update(Request $request, Product $product, $id)
    {
        // return $request;
        $product = Product::findOrFail($id);

        $mainImageOne = $product->imageOne;
        $mainImageTwo = $product->imageTwo;
        $mainImageThree = $product->imageThree;

        $product->title = $request->title;
        $product->slug = slugify($request->title);
        $product->code = $request->code;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->smallDescription = $request->smallDescription;
        $product->description = $request->description;

        $product->categories()->sync($request->category_id);

        $imageOnePath = public_path('/uploads/products/').$mainImageOne;
            if (file_exists($imageOnePath)) {
                unlink($imageOnePath);
            }

        if ($request->imageOne != $product->imageOne) {
            $file_one = explode(';', $request->imageOne);
            $file_one = explode('/', $file_one[0]);
            $file_one_ex = end($file_one);
            $file_one_name = \Str::random(10) . '.' . $file_one_ex;
            $product->imageOne = $file_one_name;
            Image::make($request->imageOne)->resize(458, 458)->save(public_path('/uploads/products/').$file_one_name);
        }

        $imageTwoPath = public_path('/uploads/products/').$mainImageTwo;
            if (file_exists($imageTwoPath)) {
                unlink($imageTwoPath);
            }

        if ($request->imageTwo != $product->imageTwo) {
            $file_two = explode(';', $request->imageTwo);
            $file_two = explode('/', $file_two[0]);
            $file_two_ex = end($file_two);
            $file_two_name = \Str::random(10) . '.' . $file_two_ex;
            $product->imageTwo = $file_two_name;
            Image::make($request->imageTwo)->resize(458, 458)->save(public_path('/uploads/products/').$file_two_name);
        }

        $imageThreePath = public_path('/uploads/products/').$mainImageThree;
            if (file_exists($imageThreePath)) {
                unlink($imageThreePath);
            }

        if ($request->imageThree != $product->imageThree) {
            $file_three = explode(';', $request->imageThree);
            $file_three = explode('/', $file_three[0]);
            $file_three_ex = end($file_three);
            $file_three_name = \Str::random(10) . '.' . $file_three_ex;
            $product->imageThree = $file_three_name;
            Image::make($request->imageThree)->resize(458, 458)->save(public_path('/uploads/products/').$file_three_name);
        }

        $product->save();

        return response()->json('success', 200);

    }

    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product);

        $product->categories()->detach($category_id);
    }
}
