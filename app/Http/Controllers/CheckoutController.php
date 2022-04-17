<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Session\Session;
session_start();
use App\Models\customer;
use App\Models\feeship;
use App\Models\order;
use App\Models\shipping;
use App\Models\payment;
use App\Models\thanhpho;
use App\Models\quanhuyen;
use App\Models\xathitran;
use App\Models\order_details;
use Darryldecode\Cart\Cart;
use Nette\Utils\Random;
use phpDocumentor\Reflection\Types\Null_;
use Ramsey\Uuid\Rfc4122\NilUuid;

class CheckoutController extends Controller
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
    public function login_checkout(){

        $cat_pd = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        return view('pages.checkout.login_check')->with('category', $cat_pd)->with('brand', $brand_pd);
    }

    public function add_customer(Request $request){
        $data = $request->all();
        // print_r($data);
        $customer = new customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->customer_phone= 0;

        $customer->save();
        session()->put('customer_id', $customer->customer_id);
        session()->put('customer_name', $customer->customer_name);
        return redirect()->back();
    }

    public function login_customer(Request $request){
        
        $customer_email = $request->customer_email;
        $customer_password = md5($request->customer_password);

        $result = DB::table('tbl_customer')->where('customer_email', $customer_email)->where('customer_password', $customer_password)->first();
        if($result){
            session()->put('customer_name', $result->customer_name);
            session()->put('customer_id', $result->customer_id);
            echo 'success';
        }else{
            echo 'error';
        }
        
    }

    public function logout_customer(){
        
        // session()->flush();
        session()->put('customer_name', null);
        session()->put('customer_id', null);
        session()->put('message', null);
        session()->put('check_shipping', null);
        session()->put('check_ordered', null);
        return Redirect::to('/trang-chu');
        
    }

    public function show_checkout(){
        $cat_pd = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        return view('pages.checkout.show_checkout')->with('category', $cat_pd)->with('brand', $brand_pd);
    }

    public function save_checkout_customer(Request $request, $customer_id){
        $data = array();
        
        if( $request->shipping_message == Null){
            
            $data['customer_id'] = $customer_id;
            $data['shipping_name'] = $request->shipping_name;
            $data['shipping_email'] = $request->shipping_email;
            $data['shipping_phone'] = $request->shipping_phone;
            $data['shipping_address'] = $request->shipping_address;
            $data['shipping_message'] = '';
        }else{
            $data['customer_id'] = $customer_id;
            $data['shipping_name'] = $request->shipping_name;
            $data['shipping_email'] = $request->shipping_email;
            $data['shipping_phone'] = $request->shipping_phone;
            $data['shipping_address'] = $request->shipping_address;
            $data['shipping_message'] = $request->shipping_message;
        }
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        session()->put('shipping_id', $shipping_id);

        return Redirect('/payment');
    }

    public function payment()
    {
        $cat_pd = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        $thanhpho = thanhpho::orderby('matp', 'ASC')->get();
        // $quanhuyen = quanhuyen::orderby('maqh', 'ASC')->get();
        return view('pages.checkout.payment')->with('category', $cat_pd)->with('brand', $brand_pd)->with('thanhpho', $thanhpho);
    }

    public function order_place(Request $request)
    {
        $data = $request->all();
        $payment = new payment();

        $payment->payment_method = $data['payment_method'];
        $payment->payment_status = 'Đang chờ xử lí';
        $payment->save();

        $order = new order();
        $order->customer_id = session()->get('customer_id');
        $order->shipping_id =  session()->get('shipping_id');
        $order->payment_id = $payment->payment_id;
        $order->order_total = session()->get('total');
        $order->order_status = 0;
        $order->order_code = substr(md5(microtime()),rand(0,26),5);
        if(session()->get('coupon')){
            foreach (session()->get('coupon') as $key => $coupon) {
                if(($coupon['coupon_condition'] == 1)){
                    $order->order_coupon = $coupon['coupon_number'].'%';
                }else{
                    $order->order_coupon = $coupon['coupon_number'].'VNĐ';
                }
            }
        }else{
            $order->order_coupon = '0';
        }
        
        if(session()->get('fee')){
            $order->order_feeship = session()->get('fee');
        }else{
            $order->order_feeship = 0;
        }
        $order->order_status = 0;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->save();

        foreach (session()->get('cart') as $key => $value) {
            
            $order_details = new order_details();
            $order_details->order_id = $order->order_id;
            $order_details->product_id = $value['product_id'];
            $order_details->product_name = $value['product_name'];
            $order_details->product_image = $value['product_image'];
            $order_details->product_desc = $value['product_desc'];
            $order_details->product_price = $value['product_price'];
            $order_details->product_order_quantity = $value['product_qty'];
            $order_details->save();
        }

        $cat_pd = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();

        if( $data['payment_method'] == 1){
            echo "Thẻ";
        }elseif( $data['payment_method']==2){
            session()->forget('cart');
            session()->forget('coupon');
            session()->forget('total');
            session()->forget('fee');
            return Redirect::to('/ordered/'.session()->get('customer_id'));
        }
        else{
            echo "paypal";
        }
        // return Redirect::to('/payment');
    }

    
    public function select_delivery_home(Request $request)
    {
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == 'city'){
                $output.= '<option>----Chọn quận huyện----</option>';
                $select_province = quanhuyen::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                foreach ($select_province as $key => $qh) {
                    $output .= '<option value="'.$qh->maqh.'">'.$qh->name_qh.'</option>';
                }
            }else{
                $output.= '<option>----Chọn xã phường----</option>';
                $select_wards = xathitran::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                foreach ($select_wards as $key => $xa) {
                    $output .= '<option value="'.$xa->xaid.'">'.$xa->name_xa.'</option>';
                }
            }
        }
        echo $output;
    }

    public function calculate_fee(Request $request)
    {
        $data = $request->all();
        if($data['matp']){
            $feeship = feeship::where('fee_matp', $data['matp'])->where('fee_maqh', $data['maqh'])->where('fee_xaid', $data['xaid'])->get();
            if($feeship){
                $count = $feeship->count();
                if($count>0){
                    foreach ($feeship as $key => $fee) {
                        session()->put('fee', $fee->fee_feeship);
                        session()->save();
                    }
                }else{
                    session()->put('fee', 50000);
                    session()->save();
                }
    
            }
        }

    }
}
