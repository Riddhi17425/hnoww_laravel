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
    public function getRegister(Request $request){
        return view('front.register');
    }

    public function submitRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name'=>'string|required|min:2',
            'phone'=>'required|numeric|digits_between:8,15',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }   
        $data=$request->all();
        $check = User::create([
            'name'=>$data['full_name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);

        Session::put('user',$data['email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('front.login');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return back();
        }
    }

    public function getLogin(Request $request){
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
            request()->session()->flash('error','Invalid email and password pleas try again!');
            return redirect()->route('front.login');
        }
    }

    public function logout(Request $request){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        
        return back();
    }


}
