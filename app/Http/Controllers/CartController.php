<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'cart_id' => 'sometimes|integer',
            'product_id' => 'required|integer',
            'qty' => 'required|integer|min:1',
        ]);

        if (isset($validated['cart_id'])) {
            $cart = Cart::findOrFail($validated['cart_id']);
        } else {
            $cart = Cart::create([
                'user_id' => $request->user()->id
            ]);
        }

        $product = Product::findOrFail($validated['product_id']);

        if ($cart->products()->wherePivot('product_id', $product->id)->exists()) {
            
            $cart->products()->updateExistingPivot($product, [
                'qty' => $validated['qty'],
                'price' => $product->price,
                'total_price' => $validated['qty'] * $product->price
            ]);

        } else {

            $cart->products()->attach($product, [
                'qty' => $validated['qty'],
                'price' => $product->price,
                'total_price' => $validated['qty'] * $product->price
            ]);
        }

        $cart = $this->updateCartNetAmount($cart->id);
        return response()->json($cart);
    }

    


    public function removeFromCart(Request $request)
    {
        $validated = $request->validate([
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
        ]);

        $cart = Cart::findOrFail($validated['cart_id']);
        $product = Product::findOrFail($validated['product_id']);
        $cart->products()->detach($product);
        $cart = $this->updateCartNetAmount($cart->id);
        return response()->json($cart);
    }

    public function updateCartNetAmount($cart_id)
    {
        $cart = Cart::with('products')->find($cart_id);
        $cart->net_amount = $cart->products->sum(function ($product) {
            return $product->pivot->total_price;
        });
        $cart->save();
        return $cart;
    }
}
