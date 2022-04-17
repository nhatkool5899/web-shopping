<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
session_start();

class BrandProduct extends Controller
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
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }  

    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand_product')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }

    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        $get_image = $request->file('brand_image');

        if($get_image){
            $get_name_img = $get_image->getClientOriginalName();
            $name_img = current(explode('.', $get_name_img));
            $new_img =  $name_img.'-'.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/brand', $new_img);
            $data['brand_image'] = $new_img;
            DB::table('tbl_brand_product')->insert($data);
            session()->put('message', 'Thêm thương hiệu thành công');
            return Redirect::to('add-brand-product');

        }else{
            $data['brand_img'] = "";
            DB::table('tbl_brand_product')->insert($data);
            session()->put('message', 'Thêm thương hiệu thành công');
            return Redirect::to('add-brand-product');

        }
    }

    public function update_brand_product(Request $request, $brand_id){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        $get_image = $request->file('brand_image');

        if($get_image){
            $get_name_img = $get_image->getClientOriginalName();
            $name_img = current(explode('.', $get_name_img));
            $new_img =  $name_img.'-'.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/brand', $new_img);
            $data['brand_image'] = $new_img;
            DB::table('tbl_brand_product')->where('brand_id', $brand_id)->update($data);
            session()->put('message', '<span class="text-success"><i class="fa fa-check"></i>Cập nhật danh mục thành công</span>');
            return Redirect::to('all-brand-product');

        }else{
            DB::table('tbl_brand_product')->where('brand_id', $brand_id)->update($data);
            session()->put('message', '<span class="text-success"><i class="fa fa-check"></i>Cập nhật danh mục thành công</span>');
            return Redirect::to('all-brand-product');

        }
    }

    public function unactive_brand_product($brand_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_id)->update(['brand_status' => 1]);
        session()->put('message', '<span class="text-warning"><i class="fa fa-check"></i>Ẩn hiện thị danh mục thành công</span>');
        return Redirect::to('all-brand-product');
        
    }
    public function active_brand_product($brand_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_id)->update(['brand_status' => 0]);
        session()->put('message', '<span class="text-success"><i class="fa fa-check"></i>Hiển thị danh mục thành công</span>');
        return Redirect::to('all-brand-product');
        
    }

    public function edit_brand_product($brand_id){
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id', $brand_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function delete_brand_product($brand_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id', $brand_id)->delete();
        session()->put('message', '<span class="text-success"><i class="fa fa-check"></i>Xóa danh mục thành công</span>');
        return Redirect::to('all-brand-product');
    }
    //End Function Admin Page

    public function show_brand($brand_id){
        $cat_pd = DB::table('tbl_category_product')->where('category_status', 0)->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->where('brand_status', 0)->orderBy('brand_id', 'desc')->get();

        $cat_by_id = DB::table('tbl_product')->join('tbl_brand_product', 'tbl_product.brand_id', '=', 
        'tbl_brand_product.brand_id')->where('tbl_product.brand_id', $brand_id)->orderBy('product_id', 'desc')->get();

        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id', $brand_id)->limit(1)->get();
        return view('pages.product.show_brand')->with('category', $cat_pd)->with('brand', $brand_pd)->with('brand_by_id', $cat_by_id)->with('brand_name', $brand_name);
    }
}
