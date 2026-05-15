<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, WhatsappInquiry, Cart};
use Auth;
use Session;
use Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function getAuth(Request $request, $page = null){
        $pageVal = $page ?? 'login';
        return view('front.register', compact('pageVal'));
    }

    public function submitRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name'=>'string|required|min:2',
            'phone'=>'required|numeric|digits_between:8,15',
            'dob' => 'nullable',
            'r_email'=>'string|required|unique:users,email',
            'r_password'=>'required|min:6|confirmed',
            //'address'=>'nullable|max:200',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }   
        $data=$request->all();
        $user = User::create([
            'name'=>$data['full_name'],
            'email'=>$data['r_email'],
            'phone'=>$data['phone'],
            'dob'=>$data['dob'],
            //'address'=>$data['address'],
            'password'=>Hash::make($data['r_password']),
            'status'=>'active'
            ]);

        Session::put('user',$data['r_email']);

        if($user){
            // $sessionId = Session::getId();  
            // $cartData = Cart::where('session_id', '=', $sessionId)->get();         

            // $oldSessionId = Session::getId();
            // $cartData = Cart::where('session_id', $oldSessionId)->get(); 
            // foreach($cartData as $value)
            // {
            //     $cart = Cart::where('id', $value->id)->first();
            //     $checkCart = Cart::where('user_id', $user->id)->where('product_id', $cart->product_id)->first();
            //     if (isset($checkCart) && ($checkCart->quantity + $cart->quantity) > $cart->product->product_stock) {
            //         $checkCart->quantity = $checkCart->quantity + $cart->quantity;
            //         $checkCart->save();
            //         Cart::where('id', $value->id)->delete();
            //     }
            //     else{
            //         $cart->session_id = null;
            //         $cart->user_id = $user->id;
            //         $cart->save();    
            //     }
            // }

            request()->session()->flash('success','Successfully registered');
            return redirect()->route('front.auth', 'login');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return redirect()->route('front.auth','register');
        }
    }

    public function getLogin(Request $request){ // Un-used
        return view('front.login');
    }

    public function submitLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=>'string|required',
            'password'=>'required|min:6',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } 
        // SAVE OLD SESSION ID BEFORE LOGIN
        $oldSessionId = Session::getId();
        $data = $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            Session::put('user', $data['email']);

            // $sessionId = Session::getId(); 
            // $cartData = Cart::where('session_id', '=', $sessionId)->get(); 
            $cartData = Cart::where('session_id', $oldSessionId)->get();           
            foreach($cartData as $value)
            {
                $cart = Cart::where('id', $value->id)->first();
                $checkCart = Cart::where('user_id', auth()->id())->where('product_id', $cart->product_id)->first();
                if($checkCart)
                {
                    if (($checkCart->quantity + $cart->quantity) > $cart->product->product_stock) {
                        $checkCart->quantity = $checkCart->quantity;
                    }
                    else{
                        $checkCart->quantity = $checkCart->quantity + $cart->quantity;
                    }
                    $checkCart->save();
                    Cart::where('id', $value->id)->delete();
                }
                else
                {
                    $cart->session_id = null;
                    $cart->user_id = auth()->id();
                    $cart->save();    
                }
                
            }

            request()->session()->flash('success','Successfully login');
            return redirect()->route('front.home');
        }
        else{ 
            request()->session()->flash('error','Invalid email and password please try again!');
            return redirect()->route('front.auth', 'login');
        }
    }
    
    public function forgotPassword(Request $request){
        return view('front.forgot_password');
    }
    
    public function sendResetLink(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } 

        $token = Str::random(64);
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        $resetLink = route('front.get.reset.password', $token) . '?email=' . urlencode($request->email);

        Mail::send('email.front.reset_password_link', ['link' => $resetLink], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Your Password');
        });

        return back()->with('success', 'Password reset link sent to your email.');
    }
    
    public function resetPassword(Request $request, $token){
        return view('front.reset_password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function postResetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:6|confirmed',
            'token' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $reset = DB::table('password_resets')->where('email', $request->email)->first();
        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['token' => 'Invalid or expired reset token']);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->new_password),
        ]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('front.auth', 'login')->with('success', 'Password updated successfully.');
    }

    public function logout(Request $request){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        
        return back();
    }

    public function cookieConsent(Request $request){
        $consent = $request->input('consent');
        if (!in_array($consent, ['accepted', 'rejected'])) {
            return response()->json(['error' => 'Invalid choice'], 400);
        }
        return response()->json(['success' => true])->cookie(
            'cookie_consent',
            $consent,
            //60 * 24 * 180 // 6 Months
            60 * 24 * 30, // 30 days
            '/',
            null,
            true,   // Secure (HTTPS only)
            false,  // HttpOnly (false so JS can read if needed)
            false,
            'Lax'
        );
    }

    public function whatsaapInquiry(Request $request){
        $validator = Validator::make($request->all(), [
            'number' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        WhatsappInquiry::create([
            'number'  => $request->number,
            'message'  => $request->message,
        ]);
    
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        // Google Sheet expects:
        $sheetsData = [
            'form_type' => 'whatsapp inquiry',
            'contact'   => $request->number,
            'message'  => $request->message,
            'date'      => $timestamp,
        ];
    
        // Send to Google Sheets
        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post('https://script.google.com/macros/s/AKfycbwC1jNkkBNUH9lJsOtG5gk5DZePCISChsgcTNzE-_v8e2FJdSjs_eI3JLmLB-ZZ5GCZ/exec', 
                    $sheetsData
                );
            if ($response->failed()) {
                \Log::error('Google Sheet request failed: '.$response->body());
            }
        } catch (\Exception $e) {
            \Log::error('Google Sheets Exception (WhatsApp Inquiry):', [
                'message'   => $e->getMessage(),
                'trace'     => $e->getTraceAsString(),
                'data_sent' => $sheetsData
            ]);
        }

        // Redirect to WhatsApp
        $number = $request->number;
        $adminNumber = config('global_values.admin_whatsapp_no'); // Fallback number
        $message = 'Inquiry from the website with Phone No. - '. $number.' and Message - '. $request->message;

        $url = 'https://wa.me/' . $adminNumber . '?text=' . urlencode($message);
        return back()->with('whatsapp_url', $url);

        // $whatsappUrl = "https://api.whatsapp.com/send/?phone={$adminNumber}&text=" . urlencode($message);
   
        return redirect()->away($whatsappUrl);
    }

}
