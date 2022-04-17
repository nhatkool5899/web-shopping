<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Models\Coupon;
use App\Models\product;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Session\Session;
session_start();


class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        $cat_pd = DB::table('tbl_category_product')->where('category_status', 0)->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->where('brand_status', 0)->orderBy('brand_id', 'desc')->get();
        // $product_info = DB::table('tbl_product')->where('product_id', $product_id)->get();   

        return view('pages.cart.show_cart')->with('category', $cat_pd)->with('brand', $brand_pd);
    }

    public function add_cart_ajax(Request $request){

        

        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0,26),5);
        $cart = session()->get('cart');
        if($cart == true){
            $is_available = 0;
            foreach ($cart as $key => $value) {
                if($value['product_id'] == $data['cart_product_id']){
                    $is_available++;
                }
            } 
            if($is_available == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_desc' => $data['cart_product_desc'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                session()->put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_desc' => $data['cart_product_desc'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
        }
        session()->put('cart', $cart);
        session()->save();
        
    }

    public function gio_hang( Request $request){
        $meta_desc = "Giỏ hàng của bạn";
        $meta_keyword = "Giỏ hàng Ajax";
        $meta_title = "Cart AJAX";
        $url_canonical = $request->url();
        $customer_id = session()->get('customer_id');

        $cat_pd = DB::table('tbl_category_product')->where('category_status', 0)->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->where('brand_status', 0)->orderBy('brand_id', 'desc')->get();

        $check_shipping =  DB::table('tbl_shipping')->where('customer_id', $customer_id)->orderBy('shipping_id', 'desc')->limit(1)->get();
        // print_r($check_shipping);
        // if($check_shipping){
        //     session()->put('check_shipping', $check_shipping->shipping_id);
        // }

        return view('pages.cart.show_cart')->with('category', $cat_pd)->with('brand', $brand_pd)
        ->with('meta_desc', $meta_desc)->with('meta_key', $meta_keyword)->with('meta_title', $meta_title)
        ->with('url_canonical', $url_canonical)->with('check_shipping', $check_shipping);
    }

    public function delete_pd_cart($session_id)
    {
        $cart = session()->get('cart');
        if($cart == true){
            foreach ($cart as $key => $value) {
                if($value['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('message', 'Xoá sản phẩm thành công');
        }else{
            return redirect()->back()->with('error', 'Xoá sản phẩm thất bại');
            
        }
    }

    public function update_cart(Request $request){
        $data = $request->all();
        $cart = session()->get('cart');
        if($cart == true){
           foreach ($data['cart_qty'] as $key => $qty) {
                foreach ($cart as $session => $value) {
                    if($value['session_id']== $key){
                        $cart[$session]['product_qty']=$qty;
                    }
                }
           }
           session()->put('cart', $cart);
            return redirect()->back()->with('message', 'Cập nhật giỏ hàng thành công');
        }else{
            return redirect()->back()->with('error', 'Cập nhật giỏ hàng thất bại');
        }
    }

    public function del_all_pd_cart(){
        $cart = session()->get('cart');
        if($cart == true){
            session()->forget('cart');
            session()->forget('coupon');
            session()->forget('fee');
            return redirect()->back()->with('message', 'Xóa thành công');
        }
    }

    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon_code'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon > 0){
                $coupon_session = session()->get('coupon');
                if($coupon_session == true){
                    $is_available = 0;
                    if($is_available == 0){
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,
                        );
                        session()->put('coupon', $cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    session()->put('coupon', $cou);
                }
            }
            session()->save();
            return redirect('/payment')->with('alert', '<span class="text-success" style="margin: 8px"><i class="fa fa-check"></i>Thêm mã thành công</span>');
        }else{
            return redirect('/payment')->with('alert', '<span class="text-danger" style="margin: 8px"><i class="fa fa-warning"></i>Mã giảm giá không hợp lệ</span>');
        }
    }
}
