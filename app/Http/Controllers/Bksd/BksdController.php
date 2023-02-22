<?php

namespace App\Http\Controllers\Bksd;

use App\Http\Controllers\Controller;
use App\Models\M_Bksd;
use App\Models\M_Bksu;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use DataTables; 
use Validator;
use Custom;

class BksdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $query = M_Bksd::with('bksu');
        // echo json_encode(Datatables::of($query)->make(true));
        $cek_menu_akses = Custom::cek_akses_menu('bksd',json_decode(Custom::get_menu_akses(),true));
        if($cek_menu_akses['status'] == 1){    
            if($cek_menu_akses['status_tampil'] == "all"){
                $query = M_Bksd::with('bksu');
            }else{
                $query = M_Bksd::with('bksu')->where("user_id",auth()->user()->id);
            }
        
            if($request->ajax()) {
                return  Datatables::of($query)->make(true);
            }
            return view("pages.bksd.detail");
        }else{
            return redirect("no-akses");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cek_menu_akses = Custom::cek_akses_menu('bksd',json_decode(Custom::get_menu_akses(),true));
        if($cek_menu_akses['status_tambah'] == "1"){
            $bksu = M_Bksu::select("id","nama_bentuk_kerjasam_umum")->get();
            return view("pages.bksd.form_tambah",compact("bksu"));
        }else{
            return redirect('no-akses');
        }
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
                "nama_bentuk_kerjasam_detail"  => "required",
                "id_bentuk_kerjasama_umum"  => "required"
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
                    "id_bentuk_kerjasama_umum" => $request->id_bentuk_kerjasama_umum, 
                    "nama_bentuk_kerjasam_detail" => $request->nama_bentuk_kerjasam_detail, 
                    "rincian_bentuk_kerjasam_detail" => $request->rincian_bentuk_kerjasam_detail, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Bksd::create($data);
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
     * @param  \App\Models\M_Bks  $m_Bks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cek_menu_akses = Custom::cek_akses_menu('bksd',json_decode(Custom::get_menu_akses(),true));
        if($cek_menu_akses['status_edit'] == "1"){
            $data = M_Bksd::find($id);
            $bksu = M_Bksu::select("id","nama_bentuk_kerjasam_umum")->get();
            return view("pages.bksd.form_ubah",compact("bksu","data",'id'));
        }else{
            return redirect('no-akses');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\M_Bks  $m_Bks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validates 	= [
                "nama_bentuk_kerjasam_detail"  => "required|unique:m_bksu,id,".$id,
                "id_bentuk_kerjasama_umum"  => "required"
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
                    "id_bentuk_kerjasama_umum" => $request->id_bentuk_kerjasama_umum, 
                    "nama_bentuk_kerjasam_detail" => $request->nama_bentuk_kerjasam_detail, 
                    "rincian_bentuk_kerjasam_detail" => $request->rincian_bentuk_kerjasam_detail, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Bksd::find($id)->update($data);
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
     * @param  \App\Models\M_Bks  $m_Bks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $cek_menu_akses = Custom::cek_akses_menu('bksd',json_decode(Custom::get_menu_akses(),true));
            if($cek_menu_akses['status_hapus'] == "1"){
                $result = M_Bksd::find($id)->delete();
                return response()->json(['status'=>'success', 'messages'=>'proses success'], 201);
            }else{
                return response()->json(['status'=>'warning', 'messages'=>'Mohon maaf hak akses untuk menghapus data ini telah dinonaktifkan'], 404);
            }
            
        } catch(QueryException $e) {
            return response()->json(['status'=>'error', 'messages'=>$e->errorInfo ], 500);
        }
    }
}
