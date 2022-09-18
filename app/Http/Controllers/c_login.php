<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class c_login extends Controller {
    
    public function login() {
        return view("login");
    }
    
        public function logout(Request $req) {
        Auth::logout();
        //$this->guard()->logout();
        $req->session()->invalidate();
        return redirect('/');
    }
    
    public function login_post(Request $req) {
        $cek = DB::table('tb_admin')
                ->where("username", $req->username)
                ->where("password", md5($req->password))
                ->count();

        $dt = DB::table('tb_admin')
                ->where("username", $req->username)
                ->where("password", md5($req->password))
                ->first();

        if ($cek > 0) {
            session(['id_admin' => $dt->id]);
            Auth::guard("admin")->LoginUsingId($dt->id);
            return '1';
        } else {
            return '2';
        }
    }
    
}
