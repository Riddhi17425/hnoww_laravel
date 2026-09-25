<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        if (isset($request->customer_type) && $request->customer_type !== '') {
            if ($request->customer_type === 'guest') {
                $query = $query->whereNull('user_id');
            } elseif ($request->customer_type === 'normal') {
                $query = $query->whereNotNull('user_id');
            }
        }

        return Datatables::of($query)
            ->addColumn('customer_type', function ($order) {
                return $order->getCustomerTypeLabel();
            })
            ->addColumn('user_details', function ($order) {
                $customer = $order->getCustomerDetails();

                if ($order->user_id && $order->user) {
                    $details = [];
                    if ($customer['name'] !== '-') $details[] = '<b>Name</b> - ' . e($customer['name']);
                    if ($customer['email'] !== '-') $details[] = '<b>Email</b> - ' . e($customer['email']);
                    if ($customer['phone'] !== '-') $details[] = '<b>Phone</b> - ' . e($customer['phone']);
                    return implode('<br>', $details) ?: '-';
                }

                return '<b>Guest Email</b> - ' . e($customer['email']);
            })
            ->editColumn('order_number', function ($order) {
                return e($order->getOrderNumberDisplay());
            })
            ->editColumn('status', function ($result) {
                return isset($result->status) ? strtoupper($result->status) : '-';
            })
            ->addColumn('action', function ($row) {
                $viewUrl = route('admin.users.orders.details', $row->id);
                return '
                    <a href="' . $viewUrl . '" class="btn btn-outline-primary btn-sm">
                        <i class="icofont-eye"></i>
                    </a>
                ';
            })
            ->rawColumns(['user_details', 'action'])
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
}
