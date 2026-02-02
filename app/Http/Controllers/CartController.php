<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;

class CartController extends Controller
{
    public function getCart(Request $request){
        $cartData = Cart::where('user_id', auth()->id())->get();
        return view('front.orders.cart', compact('cartData'));
    }

    public function addToCartAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        // Stock check
        if ($request->quantity > $product->product_stock) {
            return response()->json([
                'status' => false,
                'message' => 'Not enough stock available.',
                'data' => $product->product_stock ?? 0,
            ]);
        }

        // Check existing cart item
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            // SET quantity (not increment)
            $cart->quantity += $request->quantity;
            // Remove item if quantity becomes 0
            if ($cart->quantity <= 0) {
                $cart->delete();
            } else {
                $cart->save();
            }
        } else {
            // Only create if quantity > 0
            if ($request->quantity > 0) {
                Cart::create([
                    'user_id'    => auth()->id(),
                    'product_id' => $product->id,
                    'price'      => $product->product_price,
                    'quantity'   => $request->quantity,
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Product added to cart successfully!'
        ]);
    }


}
