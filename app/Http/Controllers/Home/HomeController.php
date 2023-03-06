<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\M_JenisKerjasama;

use Custom;
class HomeController extends Controller
{
    public function index() {
        $cek_menu = json_decode(Session::get("menu_user"),true);
        if($cek_menu['status'] == "warning"){
            return redirect('no-role');
        }
        $jenis_ks = M_JenisKerjasama::select("Id","nama_jenis_kerjasama","deskripsi")->get();
        return view('pages.home.detail',compact("jenis_ks"));
    }

    public function no_akses(){
        
        return view('pages.home.no-akses');

    }

    public function no_role(){
        return view('pages.home.no-role');

    }

   
}
