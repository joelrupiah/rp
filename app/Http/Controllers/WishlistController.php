<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use  Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $wishlists = Wishlist::where('user_id', $user)
            ->orderBy('created_at', 'desc')
            ->with('product')
            ->get();

        return response()->json([
            'wishlists' => $wishlists
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // return $request;

        $user = Auth()->user()->id;
        $product = $request->id;

        $item = Wishlist::where('product_id', $product);

        if ($item->count()) {
            return response()->json([
                'message' => 'Already in wishlist'
            ], 201);
        }
        else{
            $wishlist = new Wishlist;
            $wishlist = Wishlist::create([
                'user_id' => $user,
                'product_id' => $product
            ], 200);
        }
        

    }

    public function show(Wishlist $wishlist)
    {
        //
    }

    public function edit(Wishlist $wishlist)
    {
        //
    }

    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
