<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Order, OrderProduct};
use DataTables;

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
        $order = Order::where('id', $id)->with(['user', 'orderProducts'])->first();
        return view('admin.user.order_detail', compact('order'));
    }
}
