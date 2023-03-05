<?php

namespace App\Http\Controllers\Usulan;

use App\Http\Controllers\Controller;
use App\Models\M_Usulan;
use App\Models\M_Mitra;
use App\Models\M_Bksd;
use App\Models\M_JenisKerjasama;
use App\Models\M_Unit;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use DataTables; 
use Validator;
use Custom;


class UsulanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $query = M_Usulan::with("unit","mitra","jenis_kerjasama","bentuk_kerjasama")->get();
        // echo json_encode($query);
        $cek_menu_akses = Custom::cek_akses_menu('usulan',json_decode(Custom::get_menu_akses(),true));
        if($cek_menu_akses['status'] == 1){    
            if($cek_menu_akses['status_tampil'] == "all"){
                 $query = M_Usulan::with("unit","mitra","jenis_kerjasama","bentuk_kerjasama")->get();
            }else{
                $query = M_Usulan::with("unit","mitra","jenis_kerjasama","bentuk_kerjasama")->where("user_id",auth()->user()->id);
            }
        
            if($request->ajax()) {
                return  Datatables::of($query)->make(true);
            }
            return view("pages.usulan.detail");
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
        $cek_menu_akses = Custom::cek_akses_menu('usulan',json_decode(Custom::get_menu_akses(),true));
        $jenis_kerjasama = M_JenisKerjasama::select("id","nama_jenis_kerjasama")->get();
        $mitra = M_Mitra::select("id","nama_mitra")->get();
        $unit = M_Unit::select("id","nama_unit")->get();
        $bentuk_kerjasama = M_Bksd::select("id","nama_bentuk_kerjasam_detail")->get();
        if($cek_menu_akses['status_tambah'] == "1"){
            return view("pages.usulan.form_tambah",compact("mitra","jenis_kerjasama","bentuk_kerjasama","unit"));
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
                "id_unit"  => "required",
                "id_jenis_kerjasama"  => "required",
                "id_mitra"  => "required",
                "id_bentuk_kerjasama"  => "required",
                "tanggal_usul"  => "required",
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
                    "id_unit" => $request->id_unit, 
                    "id_jenis_kerjasama" => $request->id_jenis_kerjasama, 
                    "id_mitra" => $request->id_mitra, 
                    "id_bentuk_kerjasama" => $request->id_bentuk_kerjasama, 
                    "tanggal_usul" => $request->tanggal_usul, 
                    "deskripsi" => $request->deskripsi, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Usulan::create($data);
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
     * @param  \App\Models\M_Usulan  $m_Usulan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cek_menu_akses = Custom::cek_akses_menu('usulan',json_decode(Custom::get_menu_akses(),true));
        $data = M_Usulan::find($id);
        $cek_menu_akses = Custom::cek_akses_menu('usulan',json_decode(Custom::get_menu_akses(),true));
        $jenis_kerjasama = M_JenisKerjasama::select("id","nama_jenis_kerjasama")->get();
        $mitra = M_Mitra::select("id","nama_mitra")->get();
        $unit = M_Unit::select("id","nama_unit")->get();
        $bentuk_kerjasama = M_Bksd::select("id","nama_bentuk_kerjasam_detail")->get();
        if($cek_menu_akses['status_edit'] == "1"){
            return view("pages.usulan.form_ubah",compact("jenis_kerjasama","mitra","unit","bentuk_kerjasama","data","id"));
        }else{
            return redirect('no-akses');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\M_Usulan  $m_Usulan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validates 	= [
                "id_unit"  => "required",
                "id_jenis_kerjasama"  => "required",
                "id_mitra"  => "required",
                "id_bentuk_kerjasama"  => "required",
                "tanggal_usul"  => "required",
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
                    "id_unit" => $request->id_unit, 
                    "id_jenis_kerjasama" => $request->id_jenis_kerjasama, 
                    "id_mitra" => $request->id_mitra, 
                    "id_bentuk_kerjasama" => $request->id_bentuk_kerjasama, 
                    "tanggal_usul" => $request->tanggal_usul, 
                    "deskripsi" => $request->deskripsi, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Usulan::find($id)->update($data);
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
     * @param  \App\Models\M_Usulan  $m_Usulan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cek_menu_akses = Custom::cek_akses_menu('usulan',json_decode(Custom::get_menu_akses(),true));
            if($cek_menu_akses['status_hapus'] == "1"){
                $result = M_Usulan::find($id)->delete();
                return response()->json(['status'=>'success', 'messages'=>'proses success'], 201);
            }else{
                return response()->json(['status'=>'warning', 'messages'=>'Mohon maaf hak akses untuk menghapus data ini telah dinonaktifkan'], 404);
            }
            
        } catch(QueryException $e) {
            return response()->json(['status'=>'error', 'messages'=>$e->errorInfo ], 500);
        }
    }
}
