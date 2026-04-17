<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, Cart, Order, OrderProduct, UserAddress};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\PaymentService;
use Stripe;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    protected $adminEmail;
    protected $paymentService;
    public function __construct(PaymentService $paymentService)
    {
        $this->adminEmail = config('global_values.admin_email');
        $this->paymentService = $paymentService;
    }

    public function getCart(Request $request){
        $cartData = Cart::query();
        if(Auth::user()) 
        { 
            $cartData->where('user_id', Auth::user()->id);                       
        }
        else
        {
            $cartData->where('session_id', Session::getId());
        }
        $cartData = $cartData->get();   
       // echo "<pre>"; print_r(Session::getId()); die;
        
        return view('front.orders.cart', compact('cartData'));
    }

    public function addToCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'nullable|integer|min:1',
            'cart_id'    => 'nullable|exists:carts,id', // Optional if updating
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $product = Product::findOrFail($request->product_id);
        $user_id = $session_id = '';
        $cartCount = 0;
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $session_id = '';
        } else {
            $user_id = '';
            $session_id = Session::getId();
        } 

        $cart = Cart::where('product_id', $product->id);
        if ($user_id != '') 
        {
            $cart = $cart->where('user_id', $user_id)->first();
        }else{
            $cart = $cart->where('session_id', $session_id)->first();
        }

        $requestedQty = $request->quantity ?? 1;
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
                    'user_id'    => $user_id != '' ? $user_id : null,
                    'session_id' => $session_id != '' ? $session_id : null,
                    'product_id' => $product->id,
                    'price'      => $product->product_price,
                    'quantity'   => $request->quantity,
                ]);
            }
        }

        if (Auth::user()) {
            $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');
        }else{
            $cartCount = Cart::where('session_id', $session_id)->sum('quantity');
        }

        return response()->json([
            'status' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => $cartCount,
        ]);
    }

    public function deleteCart(Request $request)
    {
        $user_id = $session_id = '';
        if (Auth::user()) {
            $user_id = Auth::user()->id;
            $session_id = '';
        } else {
            $user_id = '';
            $session_id = Session::getId();
        }

        $cart = Cart::where('id', $request->cart_id);
        if ($user_id == '') {
            if($session_id != ''){
                $cart = $cart->where(['session_id' => $session_id])->first();
            }
        } else {
            if($user_id != ''){
                $cart = $cart->where(['user_id' => $user_id])->first();
            }
        }
        
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
        $userAddresses = UserAddress::where('user_id', auth()->id())->where('is_confirm', 1)->get();

        return view('front.orders.checkout', compact('cartItems', 'subTotal', 'userAddresses'));
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
        Log::info("PAYMENT RESPONSE - " . json_encode($request->all()));

        if (!auth()->check()) {
            return redirect()->route('front.login');
        }

        $addressId = $request->address_id ?? null;
        $paymentIntentId = $request->payment_intent ?? null;
        $orderId = null;

        if (!$paymentIntentId) {
            Log::warning('Payment success callback missing payment_intent', [
                'user_id' => auth()->id(),
                'request' => $request->all(),
            ]);

            return redirect()->route('front.get.failed', ['orderid' => $orderId]);
        }

        try {
            $paymentIntent = $this->paymentService->retrievePaymentIntent($paymentIntentId);
        } catch (Exception $e) {
            Log::error('Unable to retrieve Stripe payment intent: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'payment_intent' => $paymentIntentId,
            ]);

            return redirect()->route('front.get.failed', ['orderid' => $orderId]);
        }

        if (($paymentIntent->status ?? null) !== 'succeeded') {
            Log::warning('Stripe payment intent not succeeded', [
                'user_id' => auth()->id(),
                'payment_intent' => $paymentIntentId,
                'status' => $paymentIntent->status ?? null,
            ]);

            return redirect()->route('front.get.failed', ['orderid' => $orderId]);
        }

        $existingOrder = Order::where('user_id', auth()->id())
            ->where('stripe_payment_intent', $paymentIntentId)
            ->first();

        if ($existingOrder) {
            return redirect()->route('front.get.success', ['orderid' => $existingOrder->id]);
        }

        $cartItems = Cart::where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            Log::warning('Payment succeeded but cart was empty', [
                'user_id' => auth()->id(),
                'payment_intent' => $paymentIntentId,
            ]);

            return redirect()->route('front.get.failed', ['orderid' => $orderId]);
        }

        $subTotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        DB::beginTransaction();

        try {
            $order = new Order();
            $order->user_id = auth()->id();
            $order->order_address_id = $addressId;
            $order->status = 'confirmed';
            $order->subtotal = $subTotal;
            $order->order_total = $subTotal;
            $order->stripe_payment_intent = $paymentIntentId;
            $order->stripe_payment_intent_client_secret = $request['payment_intent_client_secret'] ?? null;
            $order->payment_status = 'paid';
            $order->save();

            $randomNum = rand(1000, 9999);
            $order->order_number = 'ORD-' . $order->id . '-' . auth()->id() . '-' . $randomNum;
            $order->save();

            foreach($cartItems as $cart) {
                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $cart->product_id;
                $orderProduct->price = $cart->price;
                $orderProduct->quantity = $cart->quantity;
                $orderProduct->subtotal = ($cart->price * $cart->quantity);
                $orderProduct->save();
                $cart->delete();
            }

            UserAddress::where([
                'user_id' => auth()->id(),
                'is_confirm' => 0,
            ])->where('is_primary', '!=', 1)->delete();

            $orderAddress = UserAddress::where('user_id', auth()->id())
                ->where('id', $addressId)
                ->first();

            if ($orderAddress) {
                $orderAddress->is_confirm = 1;
                $orderAddress->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Order creation failed after successful payment: ' . $e->getMessage(), [
                'user_id' => auth()->id(),
                'payment_intent' => $paymentIntentId,
            ]);

            return redirect()->route('front.get.failed', ['orderid' => $orderId]);
        }

        $orderId = $order->id;
        $order->load('orderProducts.product');

        $adminEmail = $this->adminEmail;
        $adminSubject = 'New Order Placed - ' . ($order->order_number ?? ('Order #' . $order->id));
        $userDetails = auth()->user();
        $userEmail = $userDetails->email;
        $data = [
            'name' => $userDetails->name,
            'email' => $userEmail,
            'order_id' => $order->id,
            'status' => $order->status,
            'order_total' => $order->order_total,
            'order_products' => $order->orderProducts,
        ];

        try {
            Mail::send('email.admin.order_success', $data, function ($message) use ($adminEmail, $adminSubject) {
                $message->to($adminEmail)->subject($adminSubject);
            });

            Mail::send('email.front.order_success', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Order Placed Successfully');
            });
        } catch (Exception $e) {
            Log::error('Order success mail sending failed: ' . $e->getMessage(), [
                'order_id' => $order->id,
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->route('front.get.success', ['orderid' => $orderId]);
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'contact_no' => 'required',
            'emirate' => 'required',
            'address_line1' => 'required',
            'address_line2' => 'required',
            'landmark' => 'required',
        ]);

        if (auth()->check()) {
            UserAddress::where('user_id', auth()->id())
                ->update(['is_primary' => 0]);
        }
        $orderAddress = UserAddress::create([
            'user_id' => auth()->id() ?? null,
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'emirate' => $request->emirate,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'landmark' => $request->landmark,
            'is_primary' => 1
        ]);
        
        return response()->json([
            'success' => true,
            'address_id' => $orderAddress->id
        ]);
    }

    public function getSuccess(Request $request, $orderid){
        return view('front.orders.success');
    }

    public function getFailed(Request $request, $orderid){
        return view('front.orders.failed');
    }
    public function order()
    {
        $orderData = Order::where('user_id', auth()->id())->orderBy('id', 'desc')->get();

        // Use dot notation to reach front/orders/order.php
        return view('front.orders.order', compact('orderData'));
    }
    public function orderDetail($orderId)
    {
        $orderDetails = Order::where('id', $orderId)->with(['user', 'orderProducts', 'orderAddress'])->first();
        // Use dot notation to reach front/orders/order.php
        return view('front.orders.order_detail', compact('orderDetails'));
    }

}
