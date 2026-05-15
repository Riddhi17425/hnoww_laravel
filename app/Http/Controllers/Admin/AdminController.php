<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Product, Journal, Blessing};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard(){
        $categoryCnt = Category::isActive()->notDeleted()->count();
        $productCnt = Product::isActive()->notDeleted()->count();
        $journalCnt = Journal::where('is_active', 0)->count();
        $blessingCnt = Blessing::where('is_active', 0)->whereNull('deleted_at')->count();

        return view('admin.admin', compact('categoryCnt', 'productCnt', 'journalCnt', 'blessingCnt'));
    }

	public function adminProfile() {
		return view('admin.pages.admin-profile');
	}

	public function profileUpdate(Request $request){
		$user = Auth::guard('admin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
	}

}