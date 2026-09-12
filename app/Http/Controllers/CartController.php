<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, Cart, Order, OrderProduct, UserAddress};
use Illuminate\Support\Facades\Validator;
use App\Services\{PaymentService, QuickupShippingService, YetiWhatsappMesasgeService};
use Stripe;
use Session;
use Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    protected $paymentService;
    protected $yetiWhatsappMesasgeService;
    protected $quickupShippingService;
    public function __construct(PaymentService $paymentService, YetiWhatsappMesasgeService $yetiWhatsappMesasgeService, QuickupShippingService $quickupShippingService)
    {
        $this->adminEmail = config('global_values.admin_email');
        $this->paymentService = $paymentService;
        $this->yetiWhatsappMesasgeService = $yetiWhatsappMesasgeService;
        $this->quickupShippingService = $quickupShippingService;
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
        \Log::info("PAYMENT RESPONSE - " . json_encode($request->all()));

        $paymentIntent = $request->payment_intent ?? null;
        $addressId = $request->address_id ?? null;

        if (!empty($paymentIntent)) {
            $existingOrder = Order::where('stripe_payment_intent', $paymentIntent)->first();
            if ($existingOrder) {
                \Log::info('Stripe redirect skipped because order already exists for payment intent: ' . $paymentIntent);
                return redirect()->route('front.get.success', $existingOrder->id);
            }
        }

        if (isset($request['redirect_status']) && strtolower($request['redirect_status']) == 'succeeded') {
            $order = $this->createOrderFromSuccessfulPayment($request, $addressId);

            if (!$order) {
                return redirect()->route('front.get.failed', 0);
            }

            try {
                $this->quickupShippingService->createOrder($order);
            } catch (\Throwable $e) {
                \Log::error('Quickup order creation failed: ' . $e->getMessage());
            }

            $this->sendOrderSuccessNotifications($order, $addressId);
            return redirect()->route('front.get.success', $order->id);
        }

        return redirect()->route('front.get.failed', 0);
    }

    protected function createOrderFromSuccessfulPayment(Request $request, $addressId)
    {
        $user = auth()->user();
        if (!$user) {
            return null;
        }

        $cartItems = Cart::where('user_id', $user->id)->get();
        if ($cartItems->isEmpty()) {
            return null;
        }

        $subTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $giftNote = trim((string) $request->input('gift_note', ''));
        if ($request->boolean('gift_wrapper') && $giftNote !== '') {
            $giftNoteWords = preg_split('/\s+/', $giftNote);
            $giftNote = implode(' ', array_slice($giftNoteWords ?: [], 0, 30));
        } else {
            $giftNote = null;
        }

        $order = Order::create([
            'user_id' => $user->id,
            'order_address_id' => $addressId,
            'gift_wrapper' => $request->boolean('gift_wrapper'),
            'gift_note' => $giftNote,
            'status' => 'confirmed',
            'subtotal' => $subTotal,
            'discount_percent' => 0,
            'discount' => 0,
            'order_total' => $subTotal,
            'stripe_payment_intent' => $request->payment_intent ?? null,
            'stripe_payment_intent_client_secret' => $request->payment_intent_client_secret ?? null,
            'payment_status' => 'paid',
        ]);

        $order->order_number = 'ORD-' . $order->id . '-' . $user->id . '-' . rand(1000, 9999);
        $order->save();

        foreach ($cartItems as $cart) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'price' => $cart->price,
                'quantity' => $cart->quantity,
                'subtotal' => ($cart->price * $cart->quantity),
            ]);

            $cart->delete();
        }

        UserAddress::where(['user_id' => $user->id, 'is_confirm' => 0])
            ->where('is_primary', '!=', 1)
            ->delete();

        $orderAddress = UserAddress::find($addressId);
        if ($orderAddress) {
            $orderAddress->is_confirm = 1;
            $orderAddress->save();
        }

        return $order;
    }

    protected function sendOrderSuccessNotifications(Order $order, $addressId): void
    {
        $adminEmail = $this->adminEmail;
        $adminSubject = 'New Order Placed - ' . $order->order_number;
        $userDetails = auth()->user();
        $userEmail = $userDetails->email;
        $data = [
            'name' => $userDetails->name ?? null,
            'email' => $userDetails->email ?? null,
            'order_id' => $order->order_number ?? null,
            'status' => $order->status ?? null,
            'order_total' => $order->order_total ?? null,
            'order_products' => $order->orderProducts ?? null,
            'gift_wrapper' => $order->gift_wrapper ?? null,
            'gift_note' => $order->gift_note ?? null,
        ];

        try {
            Mail::send('email.admin.order_success', $data, function ($message) use ($adminEmail, $adminSubject) {
                $message->to($this->adminEmail)->subject($adminSubject);
            });

            Mail::send('email.front.order_success', $data, function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('Order Placed Successfully');
            });
        } catch (\Throwable $e) {
            \Log::error('Inquiry Mail sending failed: ' . $e->getMessage());
        }

        try {
            $orderAddress = UserAddress::find($addressId);
            $whatsappNumber = preg_replace('/\D+/', '', $orderAddress->whatsapp_no ?? '');
            if ($whatsappNumber != '') {
                $order->whatsapp_no = strlen($whatsappNumber) <= 10 ? '971' . $whatsappNumber : $whatsappNumber;
                $messageResponse = $this->yetiWhatsappMesasgeService->sendWhatsappNotification($order);
                if ($messageResponse) {
                    \Log::info('WhatsApp message sent successfully: ' . json_encode($messageResponse));
                }
            }
        } catch (\Throwable $e) {
            \Log::error('WhatsApp message sending failed: ' . $e->getMessage());
        }
    }

    public function storeAddress(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'contact_no' => 'required',
            //'whatsapp_no' => 'required',
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
            'whatsapp_no' => $request->whatsapp_no ?? null,
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

        return view('front.orders.order', compact('orderData'));
    }
    public function orderDetail($orderId)
    {
        $orderDetails = Order::where('id', $orderId)->with(['user', 'orderProducts', 'orderAddress'])->first();
        
        return view('front.orders.order_detail', compact('orderDetails'));
    }

}
