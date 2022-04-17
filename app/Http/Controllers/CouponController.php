<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Models\Coupon;
use Symfony\Component\HttpFoundation\Session\Session;
session_start();

class CouponController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = session()->get('admin_id');
        if($admin_id){
            Return Redirect::to('dashboard');
        }else{
            Return Redirect::to('admin')->send();
        }
    }
    public function add_coupon(){
        $this->AuthLogin();
        return view('admin.add_coupon');
    }  

    public function all_coupon(){
        $this->AuthLogin();
        $all_coupon = DB::table('tbl_coupon')->get();
        $manager_coupon = view('admin.all_coupon')->with('all_coupon', $all_coupon);
        return view('admin_layout')->with('admin.all_coupon', $manager_coupon);
    }

    public function save_coupon(Request $request){
        $data = $request->all();
        $coupon = new Coupon;

        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_amount = $data['coupon_amount'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->save();

        session()->put('message', 'Thêm mã giảm giá thành công');
        return Redirect::to('/add-coupon');
    }

    public function delete_coupon($coupon_id){
        $this->AuthLogin();
        DB::table('tbl_coupon')->where('coupon_id', $coupon_id)->delete();
        session()->put('message', '<span class="text-success"><i class="fa fa-check"></i>Xóa mã thành công</span>');
        return Redirect::to('/all-coupon');
    }
}
