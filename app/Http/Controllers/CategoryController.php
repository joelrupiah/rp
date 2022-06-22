<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return response()->json([
            'categories' => $categories,
        ], 200);
    }

    public function allUserCategories()
    {
        $categories = Category::withCount(['products'])
            ->get();

        return response()->json([
            'categories' => $categories,
        ], 200);
    }

    public function productsCategories(Request $request)
    {
        return $request;
    }

    public function getAllCategory()
    {
        $categories = Category::all();
        return response()->json([
            'categories' => $categories,
            'status_code' => 200
        ], 200);
    }

    public function allActiveCategories()
    {
        $categories = Category::all();

        return response()->json([
            'categories' => $categories
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $category = Category::create([
            'title' => $request->title,
        ]);

        return response()->json([
            'message' => 'Category Created successfully',
            'status_code' => 200
        ], 200);
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $category = Category::findOrFail($id);

        $category->title = $request->title;

        $category->save();

        return response()->json('success', 200);
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }

    public function activeCategories()
    {
        $categories = Category::get();

        return response()->json([
            'categories' => $categories,
            'status_code' => 200
        ], 200);
    }
}
