<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
session_start();

class CategoryProduct extends Controller
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

    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }

    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        session()->put('message', 'Thêm danh mục thành công');
        return Redirect::to('add-category-product');
    }

    public function unactive_category_product($category_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_id)->update(['category_status' => 1]);
        session()->put('message', '<span class="text-warning"><i class="fa fa-check"></i>Ẩn hiện thị danh mục thành công</span>');
        return Redirect::to('all-category-product');
        
    }
    public function active_category_product($category_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_id)->update(['category_status' => 0]);
        session()->put('message', '<span class="text-success"><i class="fa fa-check"></i>Hiển thị danh mục thành công</span>');
        return Redirect::to('all-category-product');
        
    }

    public function edit_category_product($category_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request, $category_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category_product')->where('category_id', $category_id)->update($data);
        session()->put('message', '<span class="text-success"><i class="fa fa-check"></i>Cập nhật danh mục thành công</span>');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id', $category_id)->delete();
        session()->put('message', '<span class="text-success"><i class="fa fa-check"></i>Xóa danh mục thành công</span>');
        return Redirect::to('all-category-product');
    }
    //End function admin page

    public function show_category($category_id){

        $cat_pd = DB::table('tbl_category_product')->where('category_status', 0)->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->where('brand_status', 0)->orderBy('brand_id', 'desc')->get();

        $cat_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id', '=', 
        'tbl_category_product.category_id')->where('tbl_product.category_id', $category_id)->get();

        $cat_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id', $category_id)->limit(1)->get();
        return view('pages.category.show_category')->with('category', $cat_pd)->with('brand', $brand_pd)->with('category_by_id', $cat_by_id)->with('category_name', $cat_name);
    }

}
