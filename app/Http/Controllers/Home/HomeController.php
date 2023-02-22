<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Custom;
class HomeController extends Controller
{
    public function index() {
        $cek_menu = json_decode(Session::get("menu_user"),true);
        if($cek_menu['status'] == "warning"){
            return redirect('no-role');
        }
        return view('pages.home.detail');
    }

    public function no_akses(){
        
        return view('pages.home.no-akses');

    }

    public function no_role(){
        return view('pages.home.no-role');

    }

   

    public function get_menu_akses(){
        $id_role = Session::get("role")->id_role;
        $menu_akses = DB::table('t_role_menu')
                      ->select('id_role','id_menu','status_tambah','status_edit','status_hapus','status_tampil','status')
                      ->where('id_role',$id_role)->get();

        return $menu_akses;
    }

    public function menu_akses(){
        echo json_encode(Custom::cek_akses_menu('provinsi',$this->get_menu_akses()));

    }
}
