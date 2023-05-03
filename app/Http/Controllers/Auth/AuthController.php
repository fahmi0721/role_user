<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


use Validator;
use Custom;

class AuthController extends Controller
{
    public function index(){
        return view("form_login");
    }

    public function login(Request $request) {
       
        $validates 	= [
            "username"  => "required",
            "password"  => "required",
        ];
        $validation = Validator::make($request->all(), $validates, Custom::messages(), []);
        if($validation->fails()) {
            return response()->json([
                "status"    => "warning",
                "messages"   => $validation->errors()->first()
            ], 422);
        }
        
        try {
            $credentials = [
                'username' => $request->username,
                'password' => $request->password,
                'status' => function ($query) {
                    $query->where('status','1');
                }
            ];
            if (!$login = auth()->attempt($credentials)) {
                return response()->json(['status' => 'warning','messages' => 'Unauthorized'], 401);
            }
            /** REGISTER SESSION */
            Session::put('menu_user',$this->get_menu());
            Session::put('role',$this->get_role_user());
            Session::put('menu_akses',$this->get_menu_akses());


            return response()->json(['status'=>'success', 'messages'=>'proses success'], 201);
        } catch(QueryException $e) { 
            return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
        }  
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        return redirect('login');
    }

    private function get_menu_akses(){
        $id_role = Session::get("role")->id_role;
        $menu_akses = DB::table('t_role_menu')
                      ->select('id_role','id_menu','status_tambah','status_edit','status_hapus','status_tampil')
                      ->where('id_role',$id_role)->get();

        return json_encode($menu_akses);
    }


    private function get_role_user(){
        $user_id = auth()->user()->id;
        return $role_user = DB::table("m_role")
                    ->join("t_role_user","m_role.id", "=", "t_role_user.id_role")
                    ->join("m_user","t_role_user.id_user", "=", "m_user.id")
                    ->where("m_user.id",$user_id)
                    ->where("m_role.status","1")
                    ->Where("t_role_user.status","1")
                    ->select("m_user.nama_user","t_role_user.id_role","m_role.nama_role")->get()->first();
    }

    private function get_menu_root($id_role){
        $menu_root  = DB::table('m_menu')
                      ->join("t_role_menu","m_menu.id", "=", "t_role_menu.id_menu")
                      ->join("m_role","t_role_menu.id_role", "=","m_role.id")
                      ->where("t_role_menu.id_role",$id_role)
                      ->where("m_menu.parent","root")
                      ->where("m_menu.status","1")
                      ->select("m_menu.id","m_menu.nama_menu","m_menu.url","t_role_menu.id_role","m_menu.icon")
                      ->get();
        return $menu_root;
    }

    private function get_menu_item($id_role,$id_menu){
        $menu_item  = DB::table('m_menu')
                      ->join("t_role_menu","m_menu.id", "=", "t_role_menu.id_menu")
                      ->join("m_role","t_role_menu.id_role", "=","m_role.id")
                      ->where("t_role_menu.id_role",$id_role)
                      ->where("m_menu.parent",$id_menu)
                      ->where("m_menu.status",'1')
                      ->select("m_menu.id","m_menu.nama_menu","m_menu.url","t_role_menu.id_role","m_menu.icon")
                      ->get();
        return $menu_item;
    }

    public function get_menu(){
        $data = array();
        $role_user = $this->get_role_user();
        if($role_user){
            $menu_root = $this->get_menu_root($role_user->id_role);
            foreach($menu_root as $key => $dt_menu_root){
                $item_url = array();
                $menu_item = $this->get_menu_item($role_user->id_role,$dt_menu_root->id);
                $dt_menu_root->jml_item = count($menu_item);
                foreach($menu_item as $kes_m => $dt_menu_item){
                    $item_url[] = $dt_menu_item->url;
                }
                $dt_menu_root->item_url = $item_url;
                $dt_menu_root->menu_item = $menu_item;
            }
            $data['status'] = "sukses";
            $data['messages'] = "Proses Sukses";
            $data['data'] = compact('menu_root');
        }else{
            $data['status'] = "warning";
            $data['messages'] = "Role User sedang tidak diaktifkan";
            $data['data'] = array();

        }
        
        return json_encode($data);

    }
}
