<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class c_utama extends Controller {
    
    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    public function index() {
        return view("beranda.beranda");
    }
    
}
