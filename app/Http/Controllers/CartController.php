<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, Cart, Order, OrderProduct};
use Illuminate\Support\Facades\Validator;
use App\Services\PaymentService;
use Stripe;

class CartController extends Controller
{
    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function getCart(Request $request){
        $cartData = Cart::where('user_id', auth()->id())->get();
        return view('front.orders.cart', compact('cartData'));
    }

    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'cart_id'    => 'nullable|exists:carts,id', // Optional if updating
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $product = Product::findOrFail($request->product_id);
        $cart = Cart::where('user_id', auth()->id())->where('product_id', $product->id)->first();
        $requestedQty = $request->quantity;
        if(isset($request->cart_id) && $request->cart_id != ''){
            $totalQty = $requestedQty;   
        }else{
            $existingQty = $cart ? $cart->quantity : 0;
            $totalQty = $existingQty + $requestedQty;
        }
       
        // Stock check
        if ($totalQty > $product->product_stock) {
            return response()->json([
                'status'  => false,
                'message' => 'Not enough stock available.',
                'data'    => [
                    'available_stock' => $product->product_stock,
                    'already_in_cart' => $existingQty,
                ],
            ]);
        }

        if ($cart) {
            if ($request->has('cart_id')) {
                $cart->quantity = $requestedQty; //FROM CART PAGE
            } else {
                $cart->quantity += $requestedQty; //FROM DETAIL PAGE
            }
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

    public function deleteCart(Request $request)
    {
        $cart = Cart::where('id', $request->cart_id)->where('user_id', auth()->id())->first();
        if (!$cart) {
            return response()->json([
                'status' => false,
                'message' => 'Cart item not found.'
            ]);
        }
        $cart->delete();
        return response()->json([
            'status' => true,
            'message' => 'Item removed from cart.'
        ]);
    }

    public function getCheckout(Request $request){
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $subTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('front.orders.checkout', compact('cartItems', 'subTotal'));
    }

    public function checkoutProcess(Request $request, PaymentService $paymentService){
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $intent = $paymentService->createPaymentIntent($request->amount);
        return response()->json([
            'client_secret' => $intent->client_secret
        ]);
    }

    public function paymentSuccess(Request $request){
        \Log::info("PAYMENT RESPONSE - " . json_encode($request->all()));
        if(isset($request['redirect_status']) && strtolower($request['redirect_status']) == 'succeeded'){
            $cartItems = Cart::where('user_id', auth()->id())->get();
            // Calculate subtotal
            $subTotal = $cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            });
            if(isset($cartItems) && is_countable($cartItems) && count($cartItems) > 0){
                $order = new Order();
                $order->user_id = auth()->id();
                $order->status = 'confirmed';
                $order->subtotal = $subTotal;
                $order->order_total = $subTotal;    
                $order->stripe_payment_intent = $request['payment_intent'] ?? null;
                $order->stripe_payment_intent_client_secret = $request['payment_intent_client_secret'] ?? null;
                $order->payment_status = 'paid';
                $order->save();    
                $randomNum = rand(1000, 9999);
                $order->order_number = 'ORD-'.$order->id.'-'.auth()->id().'-'.$randomNum;
                $order->save();
                foreach($cartItems as $k => $cart){
                    $orderProduct = new OrderProduct();
                    $orderProduct->order_id = $order->id;
                    $orderProduct->product_id = $cart->product_id;
                    $orderProduct->price = $cart->price;
                    $orderProduct->quantity = $cart->quantity;
                    $orderProduct->subtotal = ($cart->price * $cart->quantity);
                    $orderProduct->save();
                    $cart->delete();
                }  
            }
            return redirect()->route('front.get.success', $order->id);
        }else{
            return redirect()->route('front.get.failed', $order->id);
            
        }
    }

    public function getSuccess(Request $request, $orderid){
        return view('front.orders.success');
    }

    public function getFailed(Request $request, $orderid){
        return view('front.orders.failed');
    }

}
