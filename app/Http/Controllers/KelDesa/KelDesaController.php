<?php

namespace App\Http\Controllers\KelDesa;

use App\Http\Controllers\Controller;
use App\Models\M_KelDesa;
use App\Models\M_Kecamatan;
use App\Models\M_Provinsi;
use App\Models\M_KabKota;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use DataTables; 
use Validator;
use Custom;

class KelDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cek_menu_akses = Custom::cek_akses_menu('kel-desa',json_decode(Custom::get_menu_akses(),true));
        if($cek_menu_akses['status'] == 1){    
            if($cek_menu_akses['status_tampil'] == "all"){
                $query = M_KelDesa::with("provinsi","kab_kota","kecamatan");
            }else{
                $query = M_KelDesa::with("provinsi","kab_kota","kecamatan")->where("user_id",auth()->user()->id);
            }
        
            if($request->ajax()) {
                return  Datatables::of($query)->make(true);
            }
            return view("pages.kel_desa.detail");
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
        $cek_menu_akses = Custom::cek_akses_menu('kel-desa',json_decode(Custom::get_menu_akses(),true));
        $provinsi = M_Provinsi::select("id","nama_provinsi")->get();
        if($cek_menu_akses['status_tambah'] == "1"){
            return view("pages.kel_desa.form_tambah",compact("provinsi"));
        }else{
            return redirect('no-akses');
        }
    }

    public function kab_kota($id_provinsi)
    {
        $kab_kota =  M_KabKota::select("id", "nama_kab_kota as text")->where("id_provinsi",$id_provinsi)->get();
        echo json_encode($kab_kota);

    }

    public function kecamatan($id_provinsi,$id_kab_kota)
    {
        $kab_kota =  M_Kecamatan::select("id", "nama_kecamatan as text")
                    ->where("id_provinsi",$id_provinsi)
                    ->where("id_kab_kota",$id_kab_kota)
                    ->get();
        echo json_encode($kab_kota);

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
                "nama_kel_desa"  => "required|unique:m_kel_desa",
                "id_provinsi"  => "required",
                "id_kab_kota"  => "required",
                "id_kecamatan"  => "required",
                "kode_pos"  => "required",
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
                    "nama_kel_desa" => $request->nama_kel_desa, 
                    "id_provinsi" => $request->id_provinsi, 
                    "id_kab_kota" => $request->id_kab_kota, 
                    "id_kecamatan" => $request->id_kecamatan, 
                    "kode_pos" => $request->kode_pos, 
                    "deskripsi" => $request->deskripsi, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_KelDesa::create($data);
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
     * @param  \App\Models\M_KelDesa  $m_KelDesa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cek_menu_akses = Custom::cek_akses_menu('kel-desa',json_decode(Custom::get_menu_akses(),true));
        $data = M_KelDesa::find($id);
        $provinsi = M_Provinsi::select("id","nama_provinsi")->get();
        $kab_kota = M_KabKota::select("id","nama_kab_kota")->where("id_provinsi",$data->id_provinsi)->get();
        $kecamatan = M_Kecamatan::select("id","nama_kecamatan")
            ->where("id_provinsi",$data->id_provinsi)
            ->where("id_kab_kota",$data->id_kab_kota)
            ->get();
        if($cek_menu_akses['status_edit'] == "1"){
            return view("pages.kel_desa.form_ubah",compact("provinsi","kab_kota","kecamatan","data","id"));
        }else{
            return redirect('no-akses');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\M_KelDesa  $m_KelDesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validates 	= [
                "nama_kel_desa"  => "required|unique:m_kel_desa,id,".$id,
                "id_provinsi"  => "required",
                "id_kab_kota"  => "required",
                "id_kecamatan"  => "required",
                "kode_pos"  => "required",
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
                    "nama_kel_desa" => $request->nama_kel_desa, 
                    "id_provinsi" => $request->id_provinsi, 
                    "id_kab_kota" => $request->id_kab_kota, 
                    "id_kecamatan" => $request->id_kecamatan, 
                    "kode_pos" => $request->kode_pos, 
                    "deskripsi" => $request->deskripsi, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_KelDesa::find($id)->update  ($data);
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
     * @param  \App\Models\M_KelDesa  $m_KelDesa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cek_menu_akses = Custom::cek_akses_menu('kel-desa',json_decode(Custom::get_menu_akses(),true));
            if($cek_menu_akses['status_hapus'] == "1"){
                $result = M_KelDesa::find($id)->delete();
                return response()->json(['status'=>'success', 'messages'=>'proses success'], 201);
            }else{
                return response()->json(['status'=>'warning', 'messages'=>'Mohon maaf hak akses untuk menghapus data ini telah dinonaktifkan'], 404);
            }
            
        } catch(QueryException $e) {
            return response()->json(['status'=>'error', 'messages'=>$e->errorInfo ], 500);
        }
    }
}
