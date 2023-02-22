<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\M_Role_User;
use App\Models\M_Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

use DataTables; 
use Validator;
use Custom;


class RoleUserController extends Controller
{
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $role_user = M_Role_User::with('user','role')->get();
            return Datatables::of($role_user)
                ->make(true);
        }
        return view("pages.role_user.detail");

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = M_Role::where("status",'1')->get();
        $user = User::where("status",'1')->get();
        return view("pages.role_user.form_tambah",compact("role","user"));
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
            $IdUser = $request->id_user;
            $validates 	= [
                    "id_role" => "required",
                    "id_user"  => ["required",
                        Rule::unique('t_role_user')->where(function ($query) use($IdUser) {
                        return $query->where('id_user', $IdUser)
                        ->where('status', '1');
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
                    "id_user" => $request->id_user, 
                    "status" => $request->status, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Role_User::create($data);
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
     * @param  \App\Models\M_Role_User  $m_Role_User
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
                $data = [ 
                    "status" => $request->status, 
                ];
    
                $result = M_Role_User::find($id)->update($data);
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
     * @param  \App\Models\M_Role_User  $m_Role_User
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = M_Role_User::find($id)->delete();
            
            return response()->json(['status'=>'success', 'messages'=>'proses success'], 201);
        } catch(QueryException $e) {
            return response()->json(['status'=>'error', 'messages'=>$e->errorInfo ], 500);
        }
    }
}
