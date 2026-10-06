<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use App\Models\{User, Order, OrderProduct};
use DataTables;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;

class UserController extends Controller
{
    public function getUsers(Request $request){
        return view('admin.user.index');
    }

    public function fetchUsers(Request $request){
        $query = User::orderBy('id', 'DESC');
   
        return Datatables::of($query)->make(true);
    }

    public function getOrders(Request $request){
        $users = User::get();
        return view('admin.user.order', compact('users'));
    }

    public function fetchOrders(Request $request){
        $query = Order::with('user');

        if (isset($request->user_id) && $request->user_id != '') {
            $query = $query->where('user_id', (int)$request->user_id);
        }       
        return Datatables::of($query)      
            ->addColumn('user_details', function ($result) {
                if(isset($result->user_id)){
                    $userDetails = '';
                    if($result->user){
                        if($result->user->name)
                            $userDetails .= '<b>User Name</b> - ' . $result->user->name.'<br/>';
                        if($result->user->email)
                            $userDetails .= '<b>User Email Id</b> - ' . $result->user->email.'<br/>';
                        if($result->user->phone)
                            $userDetails .= '<b>User Phone Number</b> - ' . $result->user->phone.'<br/>';
                        if($result->user->address)
                            $userDetails .= '<b>User Address</b> - ' . $result->user->address;
                    }
                    return $userDetails;
                }else{
                   return '-';
                }  
            })  
            ->editColumn('status', function ($result) {
                if(isset($result->status)){
                    return strtoupper($result->status);
                }else{
                   return '-';
                }  
            })      
            ->addColumn('action', function ($row) {
                $viewUrl = route('admin.users.orders.details', $row->id);
                return '
                    <a href="' . $viewUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-eye"></i>
                    </a>
                ';
            })    
            //->escapeColumns([])  
            ->rawColumns(['user_id', 'action', 'user_details'])
            ->make(true);
    }

    public function viewOrderDetails(Request $request, $id){
        $order = Order::where('id', $id)->with(['user', 'orderProducts', 'orderAddress'])->first();
        $awbPath = 'quiqup-labels/' . ($order->order_number ?? 'ORD-' . $order->id) . '.pdf';
        $hasAwb = Storage::disk('public')->exists($awbPath);

        return view('admin.user.order_detail', compact('order', 'awbPath', 'hasAwb'));
    }

    public function awb(Request $request, $id){
        $order = Order::findOrFail($id);
        $fileName = ($order->order_number ?? 'ORD-' . $order->id) . '.pdf';
        $awbPath = 'quiqup-labels/' . $fileName;
        $disk = Storage::disk('public');

        abort_unless($disk->exists($awbPath), 404);

        if ($request->boolean('download')) {
            return $disk->download($awbPath, $fileName, ['Content-Type' => 'application/pdf']);
        }

        return response()->file($disk->path($awbPath), ['Content-Type' => 'application/pdf']);
    }

    public function getPaymentLink(Request $request){
        return view('admin.user.payment_link', [
            'paymentLinkUrl' => session('paymentLinkUrl'),
            'generatedAmount' => session('generatedAmount'),
        ]);
    }

    public function generatePaymentLink(Request $request){
        $validator = Validator::make($request->all(), [
            'link_amount' => ['required', 'numeric', 'min:2', 'regex:/^\d+(\.\d{1,2})?$/'],
        ], [
            'link_amount.required' => 'Amount is required.',
            'link_amount.numeric' => 'Amount must be a valid number.',
            'link_amount.min' => 'Amount must be at least AED 2.00.',
            'link_amount.regex' => 'Amount can have up to two decimal places.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $amount = (float) $validator->validated()['link_amount'];

        $paymentLinkUrl = URL::signedRoute('payment.checkout', [
            'amount' => number_format($amount, 2, '.', ''),
        ]);

        return redirect()->route('admin.users.get.payment.link')->with([
            'paymentLinkUrl' => $paymentLinkUrl,
            'generatedAmount' => number_format($amount, 2),
        ]);
    }

    public function getLinkThankYou(Request $request){
        return view('front.thank_you');
    }

    public function checkoutPaymentLink(string $amount){
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $checkoutSession = CheckoutSession::create([
            'mode' => 'payment',
            'success_url' => route('front.link.thankyou'),
            'cancel_url' => route('front.home'),
            'adaptive_pricing' => [
                'enabled' => false,
            ],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'aed',
                        'product_data' => [
                            'name' => 'Payment',
                        ],
                        'unit_amount' => (int) round($amount * 100), // Convert AED to fils
                    ],
                    'quantity' => 1,
                ],
            ],
        ]);

        return redirect()->away($checkoutSession->url);
    }
}
