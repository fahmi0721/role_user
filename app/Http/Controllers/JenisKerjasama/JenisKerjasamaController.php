<?php

namespace App\Http\Controllers\JenisKerjasama;

use App\Http\Controllers\Controller;
use App\Models\M_JenisKerjasama;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use DataTables; 
use Validator;
use Custom;
class JenisKerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cek_menu_akses = Custom::cek_akses_menu('jenis-ks',json_decode(Custom::get_menu_akses(),true));
        if($cek_menu_akses['status'] == 1){    
            if($cek_menu_akses['status_tampil'] == "all"){
                $query = M_JenisKerjasama::select("id","nama_jenis_kerjasama","deskripsi");
            }else{
                $query = M_JenisKerjasama::select("id","nama_jenis_kerjasama","deskripsi")->where("user_id",auth()->user()->id);
            }
        
            if($request->ajax()) {
                return  Datatables::of($query)->make(true);
            }
            return view("pages.jenis_ks.detail");
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
        $cek_menu_akses = Custom::cek_akses_menu('jenis-ks',json_decode(Custom::get_menu_akses(),true));
        if($cek_menu_akses['status_tambah'] == "1"){
            return view("pages.jenis_ks.form_tambah");
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
                "nama_jenis_kerjasama"  => "required",
                "deskripsi"  => "required",
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
                    "nama_jenis_kerjasama" => $request->nama_jenis_kerjasama, 
                    "deskripsi" => $request->deskripsi, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_JenisKerjasama::create($data);
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
     * @param  \App\Models\M_JenisKerjasama  $m_JenisKerjasama
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cek_menu_akses = Custom::cek_akses_menu('jenis-ks',json_decode(Custom::get_menu_akses(),true));
        if($cek_menu_akses['status_edit'] == "1"){
            $data = M_JenisKerjasama::find($id);
            return view("pages.jenis_ks.form_ubah",compact("data",'id'));
        }else{
            return redirect('no-akses');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\M_JenisKerjasama  $m_JenisKerjasama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validates 	= [
                "nama_jenis_kerjasama"  => "required",
                "deskripsi"  => "required",
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
                    "nama_jenis_kerjasama" => $request->nama_jenis_kerjasama, 
                    "deskripsi" => $request->deskripsi, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_JenisKerjasama::find($id)->update($data);
                return response()->json(['status'=>'success','messages'=>'proses success'], 201);
            } catch(QueryException $e) { 
                return response()->json(['status'=>'error','messages'=> $e->getMessage() ], 500);
            }
        } catch (\Exception  $th) {
            echo json_encode($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\M_JenisKerjasama  $m_JenisKerjasama
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cek_menu_akses = Custom::cek_akses_menu('jenis-ks',json_decode(Custom::get_menu_akses(),true));
            if($cek_menu_akses['status_hapus'] == "1"){
                $result = M_JenisKerjasama::find($id)->delete();
                return response()->json(['status'=>'success', 'messages'=>'proses success'], 201);
            }else{
                return response()->json(['status'=>'warning', 'messages'=>'Mohon maaf hak akses untuk menghapus data ini telah dinonaktifkan'], 404);
            }
            
        } catch(QueryException $e) {
            return response()->json(['status'=>'error', 'messages'=>$e->errorInfo ], 500);
        }
    }
}
