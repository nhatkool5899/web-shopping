<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
session_start();

class HomeController extends Controller
{
    public function index()
    {
        // Seo
        $meta_desc = "Shop bán hàng laravel";
        // Seo
        $cat_pd = DB::table('tbl_category_product')->where('category_status', 0)->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->where('brand_status', 0)->orderBy('brand_id', 'desc')->get();

        $new_product = DB::table('tbl_product')->where('product_status', 0)->orderBy('product_id', 'desc')->limit(8)->get();
        $home_product = DB::table('tbl_product')->where('product_status', 0)->limit(6)->get();
        $all_product = DB::table('tbl_product')->where('product_status', 0)->get();

        return view('pages.home')->with('category', $cat_pd)->with('brand', $brand_pd)->with('new_product', $new_product)->with('home_product', $home_product)->with('all_product', $all_product);
    }

    public function search(Request $request){

        $keyword = $request->keyword_search;
        if($keyword){
            session()->put('keyword', $keyword);
        }
        $cat_pd = DB::table('tbl_category_product')->where('category_status', 0)->orderBy('category_id', 'desc')->get();
        $brand_pd = DB::table('tbl_brand_product')->where('brand_status', 0)->orderBy('brand_id', 'desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%'.$keyword.'%')->get();

        return view('pages.product.search')->with('category', $cat_pd)->with('brand', $brand_pd)->with('search_product', $search_product);
    }
}
