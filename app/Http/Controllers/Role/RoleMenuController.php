<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\M_Role_Menu;
use App\Models\M_Role;
use App\Models\M_Menu;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

use DataTables; 
use Validator;
use Custom;

class RoleMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coba(){
        echo auth()->user()->id;
    }
    public function index(Request $request)
    {
        if($request->ajax()) {
            $role_user = M_Role_Menu::with('menu','role')->get();
            return Datatables::of($role_user)
                ->make(true);
        }
        return view("pages.role_menu.detail");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = M_Role::where("status",'1')->get();
        $menu = M_Menu::where("status",'1')->get();
        return view("pages.role_menu.form_tambah",compact("role","menu"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $id_menu = $request->id_menu;
            $id_role = $request->id_role;
            $validates 	= [
                    "id_role" => "required",
                    "id_menu"  => ["required",
                        Rule::unique('t_role_menu')->where(function ($query) use($id_menu,$id_role) {
                        return $query->where('id_menu', $id_menu)
                        ->where('id_role', $id_role);
                    }),
                ]
            ];
            $validation = Validator::make($request->all(), $validates, Custom::messages(), []);
            if($validation->fails()) {
                return response()->json([
                    "status"    => "warning",
                    "messages"   => $validation->errors()->first()
                ], 422);
            }

            try {
                $data = [ 
                    "id_role" => $request->id_role, 
                    "id_menu" => $id_menu, 
                    "status" => $request->status,
                    "status_tambah" => $request->status_tambah,
                    "status_edit" => $request->status_edit,
                    "status_hapus" => $request->status_hapus,
                    "status_tampil" => $request->status_tampil,
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Role_Menu::create($data);
                return response()->json(['status'=>'success','messages'=>'proses success'], 201);
            } catch(QueryException $e) { 
                return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
            }
        } catch (\Exception  $th) {
            echo json_encode($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\M_Role_Menu  $m_Role_Menu
     * @return \Illuminate\Http\Response
     */
    public function update_status(Request $request,$id)
    {
        try {
            
            $validates 	= [
                "status"  => "required",
            ];
         
            $validation = Validator::make($request->all(), $validates, Custom::messages(), []);
            if($validation->fails()) {
                return response()->json([
                    "status"    => "warning",
                    "messages"   => $validation->errors()->first()
                ], 422);
            }

            try {
                if($request->field== "-"){
                    $data = [ 
                        "status" => $request->status, 
                    ];
                }else{
                    $data = [ 
                        "status_".$request->field => $request->status, 
                    ];
                }
    
                $result = M_Role_Menu::find($id)->update($data);
                return response()->json(['status'=>'success','messages'=>'proses success'], 201);
            } catch(QueryException $e) { 
                return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
            }
        } catch (\Exception  $th) {
            echo json_encode($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\M_Role_Menu  $m_Role_Menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = M_Role_Menu::with('menu')->find($id);
        $role = M_Role::where("status",'1')->get();
        $menu = M_Menu::where("status",'1')->get();
        return view("pages.role_menu.form_ubah",compact("role","menu","data","id"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\M_Role_Menu  $m_Role_Menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $id_menu = $request->id_menu;
            $id_role = $request->id_role;
            $validates 	= [
                    "id_role" => "required",
                    "id_menu"  => ["required",
                        Rule::unique('t_role_menu')->where(function ($query) use($id_menu,$id_role,$id) {
                        return $query->where('id_menu', $id_menu)
                        ->where('id_role', $id_role)
                        ->where('id', '!=', $id);
                    }),
                ]
            ];
            $validation = Validator::make($request->all(), $validates, Custom::messages(), []);
            if($validation->fails()) {
                return response()->json([
                    "status"    => "warning",
                    "messages"   => $validation->errors()->first()
                ], 422);
            }

            try {
                $data = [ 
                    "id_role" => $request->id_role, 
                    "id_menu" => $id_menu, 
                    "status" => $request->status,
                    "status_tambah" => $request->status_tambah,
                    "status_edit" => $request->status_edit,
                    "status_hapus" => $request->status_hapus,
                    "status_tampil" => $request->status_tampil,
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Role_Menu::find($id)->update($data);
                return response()->json(['status'=>'success','messages'=>'proses success'], 201);
            } catch(QueryException $e) { 
                return response()->json(['status'=>'error','messages'=> $e->errorInfo ], 500);
            }
        } catch (\Exception  $th) {
            echo json_encode($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\M_Role_Menu  $m_Role_Menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = M_Role_Menu::find($id)->delete();
            
            return response()->json(['status'=>'success', 'messages'=>'proses success'], 201);
        } catch(QueryException $e) {
            return response()->json(['status'=>'error', 'messages'=>$e->errorInfo ], 500);
        }
    }
}
