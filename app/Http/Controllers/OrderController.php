<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Models\order;
use App\Models\order_details;
use App\Models\product;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Session\Session;
session_start();

class OrderController extends Controller
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
    
    public function manage_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->select('tbl_order.*', 'tbl_customer.customer_name')->orderBy('order_id', 'desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);

        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }

    public function view_order($order_id)
    {
        $this->AuthLogin();

        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
        ->join('tbl_payment', 'tbl_order.payment_id', '=', 'tbl_payment.payment_id')
        ->select('tbl_order.*', 'tbl_customer.*','tbl_shipping.*','tbl_payment.payment_method')->where('tbl_order.order_id', $order_id)->first();

        // $or_qty_storage = order_details::with('product')->where('order_id', $order_id)->get();

        $order_details_by_id = DB::table('tbl_order')
        ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_order_details.*')->where('tbl_order.order_id', $order_id)->get();

        $product_in_order = DB::table('tbl_order_details')
        ->join('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.product_id')
        ->where('tbl_order_details.order_id', $order_id) ->select('tbl_product.*')->get();
        $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id)
        ->with('order_details_by_id', $order_details_by_id)->with('product_in_order', $product_in_order);

        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
    }
    
    public function delete_order($order_id)
    {
        $this->AuthLogin();
        DB::table('tbl_order')->where('order_id', $order_id)->delete();
        session()->put('message', '<span class="text-success"><i class="fa fa-check"></i>Xóa đơn hàng thành công</span>');
        return Redirect::to('manage-order');
    }

    public function update_order_product_qty(Request $request)
    {
        $data = $request->all();
        $order = order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        if($order->order_status == 3){
            foreach ($data['order_product_id']as $key => $product_id) {
                $product = product::find($product_id);
                $product_qty = $product->product_quantity;
                $product_sold = $product->product_sold;
                foreach ($data['quantity'] as $key2 => $qty) {
                    if($key2 == $key){  
                        $product_remain = $product_qty - $qty;
                        $product->product_quantity = $product_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                    }
                }
            }
        }
    }

    public function update_pd_qty_order(Request $request)
    {
        $data = $request->all();
        $order_details = order_details::where('product_id', $data['order_product_id'])->where('order_id', $data['order_id'])->first();

        $order_details->product_order_quantity = $data['order_qty'];
        $order_details->save();
    }

    public function ordered($customer_id){
        $cat_pd = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();

        $show_ordered = DB::table('tbl_order')->where('customer_id', $customer_id)->get();
        $count = $show_ordered->count();
        if($count> 0){
            $show_ordered_details = DB::table('tbl_order')
            ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
            ->select('tbl_order.order_id','tbl_order_details.*')->where('tbl_order.customer_id', $customer_id)->get();
    
            return view('pages.checkout.ordered')->with('category', $cat_pd)->with('brand', $brand_pd)
            ->with('show_ordered', $show_ordered)->with('show_ordered_details', $show_ordered_details);
        }else{
            session()->put('check_ordered', 'yes');
            return view('pages.checkout.ordered')->with('category', $cat_pd)->with('brand', $brand_pd)
            ->with('show_ordered', $show_ordered);
        }
    }
}
