<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function top()
    {
        return view('admin/top');
    }
    
    public function login(Request $request)
    {
    	if(\Session::get('login_admin')){
    		return view('admin/logout');
    	}
    	return view('admin/login');
    }
    
    public function login_store(Request $request)
    {
    	if($request->password == config('const.admin_password')){
    		\Session::put('login_admin', true);
    		return redirect()->route('top');
    	}
    	
    	return view('admin/login');
    }
    
    public function logout(Request $request)
    {
    	$request->session()->forget('login_admin');
    	return redirect()->route('top');
    }
}
