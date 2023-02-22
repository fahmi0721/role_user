<?php

namespace App\Http\Controllers\Menu;


use App\Http\Controllers\Controller;
use App\Models\M_Menu;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use DataTables; 
use Validator;
use Custom;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            return Datatables::of(M_Menu::with('parent')->get())->make(true);
        }
        return view("pages.menu.detail");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['parent'] = M_Menu::where('parent', 'root')->get(['id','nama_menu']);
        return view("pages.menu.form_tambah",compact("data",$data));
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
            $validates 	= [
                "nama_menu"  => "required|unique:m_menu",
                "parent"  => "required",
                "icon"  => "required",
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
                    "nama_menu" => $request->nama_menu, 
                    "url" => $request->url, 
                    "parent" => $request->parent, 
                    "icon" => $request->icon, 
                    "status" => $request->status, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Menu::create($data);
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
     * @param  \App\Models\M_Menu  $m_Menu
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
    
                $result = M_Menu::find($id)->update($data);
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
     * @param  \App\Models\M_Menu  $m_Menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = M_Menu::find($id);
        $parent = M_Menu::where([['parent', '=', 'root'],['id', '!=', $id]])->get(['id','nama_menu']);
        return view("pages.menu.form_ubah",compact("data","parent",'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\M_Menu  $m_Menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try {
            $validates 	= [
                "nama_menu"  => "required|unique:m_menu,id,".$id,
                "parent"  => "required",
                "icon"  => "required",
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
                    "nama_menu" => $request->nama_menu, 
                    "url" => $request->url, 
                    "parent" => $request->parent, 
                    "icon" => $request->icon, 
                    "status" => $request->status, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Menu::find($id)->update($data);
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
     * @param  \App\Models\M_Menu  $m_Menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = M_Menu::find($id)->delete();
            
            return response()->json(['status'=>'success', 'messages'=>'proses success'], 201);
        } catch(QueryException $e) {
            return response()->json(['status'=>'error', 'messages'=>$e->errorInfo ], 500);
        }
    }
}
