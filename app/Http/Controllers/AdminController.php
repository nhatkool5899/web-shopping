<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Symfony\Component\HttpFoundation\Session\Session;
session_start();

class AdminController extends Controller
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

    public function index()
    {
        return view('admin_login');
    }

    public function show_dashboard()
    {
        $this->AuthLogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request)
    {
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        if($result){
            session()->put('admin_name', $result->admin_name);
            session()->put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        }else{
            session()->put('message', 'Sai tài khoản hoặc mật khẩu, vui lòng kiểm tra lại');
            return Redirect::to('/admin');
        }
    }

    public function log_out()
    {
        $this->AuthLogin();
        session()->put('admin_name', null);
        session()->put('admin_id', null);
        return Redirect::to('/admin');
    }
}
