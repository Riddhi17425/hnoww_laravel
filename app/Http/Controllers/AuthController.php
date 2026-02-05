<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User};
use Auth;
use Session;
use Hash;
use Illuminate\Support\Facades\Validator;

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
        $check = User::create([
            'name'=>$data['full_name'],
            'email'=>$data['r_email'],
            'phone'=>$data['phone'],
            //'address'=>$data['address'],
            'password'=>Hash::make($data['r_password']),
            'status'=>'active'
            ]);

        Session::put('user',$data['r_email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('front.auth', 'register');
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
        $data = $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
            Session::put('user', $data['email']);
            request()->session()->flash('success','Successfully login');
            return redirect()->route('front.home');
        }
        else{ 
            request()->session()->flash('error','Invalid email and password please try again!');
            return redirect()->route('front.auth', 'register'); //here login
        }
    }

    public function logout(Request $request){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        
        return back();
    }


}
