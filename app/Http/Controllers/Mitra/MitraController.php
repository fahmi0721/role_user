<?php

namespace App\Http\Controllers\Mitra;

use App\Http\Controllers\Controller;
use App\Models\M_Mitra;
use App\Models\M_Kecamatan;
use App\Models\M_Provinsi;
use App\Models\M_KabKota;
use App\Models\M_JenisMitra;
use App\Models\M_KelDesa;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use DataTables; 
use Validator;
use Custom;


class MitraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cek_menu_akses = Custom::cek_akses_menu('mitra',json_decode(Custom::get_menu_akses(),true));
        if($cek_menu_akses['status'] == 1){    
            if($cek_menu_akses['status_tampil'] == "all"){
                $query = M_Mitra::with("provinsi","kab_kota","kecamatan","jenis_mitra","kel_desa");
            }else{
                $query = M_Mitra::with("provinsi","kab_kota","kecamatan","jenis_mitra","kel_desa")->where("user_id",auth()->user()->id);
            }
        
            if($request->ajax()) {
                return  Datatables::of($query)->make(true);
            }
            return view("pages.mitra.detail");
        }else{
            return redirect("no-akses");
        }
    }


    public function kab_kota($id_provinsi)
    {
        $kab_kota =  M_KabKota::select("id", "nama_kab_kota as text")->where("id_provinsi",$id_provinsi)->get();
        echo json_encode($kab_kota);

    }

    public function kecamatan($id_provinsi,$id_kab_kota)
    {
        $kecamatan =  M_Kecamatan::select("id", "nama_kecamatan as text")
                    ->where("id_provinsi",$id_provinsi)
                    ->where("id_kab_kota",$id_kab_kota)
                    ->get();
        echo json_encode($kecamatan);
    }
    public function kel_desa($id_provinsi,$id_kab_kota,$id_kecamatan)
    {
        $kel_desa =  M_KelDesa::select("id", "nama_kel_desa as text")
                    ->where("id_provinsi",$id_provinsi)
                    ->where("id_kab_kota",$id_kab_kota)
                    ->where("id_kecamatan",$id_kecamatan)
                    ->get();
        echo json_encode($kel_desa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cek_menu_akses = Custom::cek_akses_menu('mitra',json_decode(Custom::get_menu_akses(),true));
        $jenis_mitra = M_JenisMitra::select("id","nama_jenis_mitra")->get();
        $provinsi = M_Provinsi::select("id","nama_provinsi")->get();
        if($cek_menu_akses['status_tambah'] == "1"){
            return view("pages.mitra.form_tambah",compact("provinsi","jenis_mitra"));
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
                "nama_mitra"  => "required|unique:t_mitra",
                "id_jenis_mitra"  => "required",
                "email"  => "required|email|unique:t_mitra",
                "no_tlp"  => "required",
                "id_provinsi"  => "required",
                "id_kab_kota"  => "required",
                "id_kecamatan"  => "required",
                "id_kel_desa"  => "required",
                "alamat"  => "required",
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
                    "nama_mitra" => $request->nama_mitra, 
                    "id_provinsi" => $request->id_provinsi, 
                    "id_kab_kota" => $request->id_kab_kota, 
                    "id_kecamatan" => $request->id_kecamatan, 
                    "id_jenis_mitra" => $request->id_jenis_mitra, 
                    "id_kel_desa" => $request->id_kel_desa, 
                    "email" => $request->email, 
                    "no_tlp" => $request->no_tlp, 
                    "alamat" => $request->alamat, 
                    "website" => $request->website, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Mitra::create($data);
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
     * @param  \App\Models\M_Mitra  $m_Mitra
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cek_menu_akses = Custom::cek_akses_menu('mitra',json_decode(Custom::get_menu_akses(),true));
        $data = M_Mitra::find($id);
        $jenis_mitra = M_JenisMitra::select("id","nama_jenis_mitra")->get();
        $provinsi = M_Provinsi::select("id","nama_provinsi")->get();
        $kab_kota = M_KabKota::select("id","nama_kab_kota")->where("id_provinsi",$data->id_provinsi)->get();
        $kecamatan = M_Kecamatan::select("id","nama_kecamatan")
            ->where("id_provinsi",$data->id_provinsi)
            ->where("id_kab_kota",$data->id_kab_kota)
            ->get();
        $kel_desa = M_KelDesa::select("id","nama_kel_desa")
            ->where("id_provinsi",$data->id_provinsi)
            ->where("id_kab_kota",$data->id_kab_kota)
            ->where("id_kecamatan",$data->id_kecamatan)
            ->get();
        if($cek_menu_akses['status_edit'] == "1"){
            return view("pages.mitra.form_ubah",compact("jenis_mitra","provinsi","kab_kota","kecamatan","kel_desa","data","id"));
        }else{
            return redirect('no-akses');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\M_Mitra  $m_Mitra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validates 	= [
                "nama_mitra"  => "required|unique:t_mitra,id,",
                "id_jenis_mitra"  => "required",
                "id_jenis_mitra"  => "required",
                "email"  => "required|email|unique:t_mitra,id,".$request->id,
                "no_tlp"  => "required",
                "id_provinsi"  => "required",
                "id_kab_kota"  => "required",
                "id_kecamatan"  => "required",
                "id_kel_desa"  => "required",
                "alamat"  => "required",
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
                    "nama_mitra" => $request->nama_mitra, 
                    "id_provinsi" => $request->id_provinsi, 
                    "id_kab_kota" => $request->id_kab_kota, 
                    "id_kecamatan" => $request->id_kecamatan, 
                    "id_jenis_mitra" => $request->id_jenis_mitra, 
                    "id_kel_desa" => $request->id_kel_desa, 
                    "email" => $request->email, 
                    "no_tlp" => $request->no_tlp, 
                    "alamat" => $request->alamat, 
                    "website" => $request->website, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Mitra::find($id)->update($data);
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
     * @param  \App\Models\M_Mitra  $m_Mitra
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cek_menu_akses = Custom::cek_akses_menu('mitra',json_decode(Custom::get_menu_akses(),true));
            if($cek_menu_akses['status_hapus'] == "1"){
                $result = M_Mitra::find($id)->delete();
                return response()->json(['status'=>'success', 'messages'=>'proses success'], 201);
            }else{
                return response()->json(['status'=>'warning', 'messages'=>'Mohon maaf hak akses untuk menghapus data ini telah dinonaktifkan'], 404);
            }
            
        } catch(QueryException $e) {
            return response()->json(['status'=>'error', 'messages'=>$e->errorInfo ], 500);
        }
    }
}
