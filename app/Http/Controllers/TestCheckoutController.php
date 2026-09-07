<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Product, Cart, Order, OrderProduct, UserAddress};
use Illuminate\Support\Facades\Validator;
use App\Services\{TestPaymentService, YetiWhatsappMesasgeService};
use Session;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class TestCheckoutController extends Controller
{
    protected $paymentService;
    protected $yetiWhatsappMesasgeService;
    protected $adminEmail;

    public function __construct(TestPaymentService $paymentService, YetiWhatsappMesasgeService $yetiWhatsappMesasgeService)
    {
        $this->adminEmail = config('global_values.admin_email');
        $this->paymentService = $paymentService;
        $this->yetiWhatsappMesasgeService = $yetiWhatsappMesasgeService;
    }

    /**
     * Display the test checkout page
     */
    public function getCheckout(Request $request)
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();
            $userAddresses = UserAddress::where('user_id', Auth::id())->where('is_confirm', 1)->get();
        } else {
            $cartItems = Cart::where('session_id', Session::getId())->get();
            $userAddresses = collect();
        }

        $subTotal = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('front.orders.checkout-test', compact('cartItems', 'subTotal', 'userAddresses'));
    }

    /**
     * Create Stripe Payment Intent for test checkout
     */
    public function checkoutProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $userEmail = Auth::check() ? Auth::user()->email : null;

        try {
            $intent = $this->paymentService->createPaymentIntent($request->amount, $userEmail);
            return response()->json([
                'status' => true,
                'client_secret' => $intent->client_secret
            ]);
        } catch (\Throwable $e) {
            Log::error("[TEST CHECKOUT] Stripe Create Payment Intent Failed: " . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store new address during test checkout
     */
    public function storeAddress(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'contact_no' => 'required',
            'emirate' => 'required',
            'address_line1' => 'required',
            'address_line2' => 'required',
            'landmark' => 'nullable',
        ]);

        if (Auth::check()) {
            UserAddress::where('user_id', Auth::id())
                ->update(['is_primary' => 0]);
        }

        $orderAddress = UserAddress::create([
            'user_id' => Auth::id() ?? null,
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'whatsapp_no' => $request->whatsapp_no ?? null,
            'emirate' => $request->emirate,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'landmark' => $request->landmark ?? '',
            'is_primary' => 1
        ]);

        return response()->json([
            'success' => true,
            'address_id' => $orderAddress->id
        ]);
    }

    /**
     * Handle payment success callback for test checkout
     */
    public function paymentSuccess(Request $request)
    {
        Log::info("[TEST CHECKOUT] PAYMENT RESPONSE - " . json_encode($request->all()));

        $rawAddressId = $request->address_id ?? null;
        $addressId = (is_numeric($rawAddressId)) ? (int) $rawAddressId : null;
        $orderId = null;

        if (isset($request['redirect_status']) && strtolower($request['redirect_status']) == 'succeeded') {
            $userId = Auth::id();
            if ($userId) {
                $cartItems = Cart::where('user_id', $userId)->get();
            } else {
                $cartItems = Cart::where('session_id', Session::getId())->get();
            }

            $subTotal = $cartItems->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $orderTotal = $subTotal;

            if ($cartItems->count() > 0) {
                $order = new Order();
                $order->user_id = $userId;
                $order->order_address_id = $addressId;
                $order->gift_wrapper = $request->boolean('gift_wrapper');
                $order->status = 'confirmed';
                $order->subtotal = $subTotal;
                $order->discount_percent = 0;
                $order->discount = 0;
                $order->order_total = $orderTotal;
                $order->stripe_payment_intent = $request['payment_intent'] ?? null;
                $order->stripe_payment_intent_client_secret = $request['payment_intent_client_secret'] ?? null;
                $order->payment_status = 'paid';
                $order->save();

                $randomNum = rand(1000, 9999);
                $order->order_number = 'TEST-ORD-' . $order->id . '-' . ($userId ?? 'GUEST') . '-' . $randomNum;
                $order->save();

                foreach ($cartItems as $cart) {
                    $orderProduct = new OrderProduct();
                    $orderProduct->order_id = $order->id;
                    $orderProduct->product_id = $cart->product_id;
                    $orderProduct->price = $cart->price;
                    $orderProduct->quantity = $cart->quantity;
                    $orderProduct->subtotal = ($cart->price * $cart->quantity);
                    $orderProduct->save();
                    $cart->delete();
                }

                $orderId = $order->id;
            }

            if ($addressId) {
                $orderAddress = UserAddress::find($addressId);
                if ($orderAddress) {
                    $orderAddress->is_confirm = 1;
                    $orderAddress->save();
                }
            }

            return redirect()->route('front.get.success', $orderId ?: 1);
        } else {
            return redirect()->route('front.get.failed', $orderId ?: 0);
        }
    }
}
