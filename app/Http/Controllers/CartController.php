<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        
        $user = Auth::user()->id;
        $carts = Cart::where('user_id', $user)
            ->orderBy('created_at', 'DESC')
            ->with('product')
            ->get();

        return response()->json([
            'carts' => $carts
        ], 200);
        
    }
    public function addToCart(Request $request)
    {
        // return $request;
        $user = Auth::user()->id;
        // return $user;
        $product = $request->product['id'];
        $amount = $request->product['price'];
        $item = Cart::where('product_id', $product);
        // return $item;

        if($item->count())
        {
            $item->increment('quantity');
            $item = $item->first();
        }

        else
        {
            $item = Cart::forceCreate([
                'user_id' => $user,
                'product_id' => $product,
                'quantity' => 1,
                'amount' => $amount
            ]);
        }

        return response()->json([
            'user' => $item->user,
            'quantity' => $item->quantity,
            'product' => $item->product,
            'amount' => $item->amount
        ], 200);
    }

    public function updateCart(Request $request)
    {
        return $request;
    }

    public function destroy($id)
    {
        // return $id;
        $item = Cart::where('product_id', $id)->delete();
        return response(null, 200);
    }

    public function destroyAll()
    {
        Cart::truncate();
    }

}
