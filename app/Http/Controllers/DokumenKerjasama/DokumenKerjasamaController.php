<?php

namespace App\Http\Controllers\DokumenKerjasama;

use App\Http\Controllers\Controller;
use App\Models\M_Dokumen;
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

class DokumenKerjasamaController extends Controller
{
    protected $uploadDir 	= __DIR__."/public/dokumen/kerjasama/";

    public function index(Request $request)
    {
        // $query = M_Dokumen::with("unit","mitra","jenis_kerjasama","bentuk_kerjasama","usulan")->get();
        // echo json_encode($query);
        $cek_menu_akses = Custom::cek_akses_menu('dokumen-ks',json_decode(Custom::get_menu_akses(),true));
        if($cek_menu_akses['status'] == 1){    
            if($cek_menu_akses['status_tampil'] == "all"){
                 $query = M_Dokumen::with("usulan","unit","mitra","jenis_kerjasama","bentuk_kerjasama")->get();
            }else{
                $query = M_Dokumen::with("usulan","unit","mitra","jenis_kerjasama","bentuk_kerjasama")->where("user_id",auth()->user()->id);
            }
        
            if($request->ajax()) {
                return  Datatables::of($query)->make(true);
            }
            return view("pages.dokumen_kerjasama.detail");
        }else{
            return redirect("no-akses");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_usulan($id)
    {
        $usulan = M_Usulan::with("unit","mitra","jenis_kerjasama","bentuk_kerjasama")->find($id);
        return response()->json(['status'=>'success','data' => $usulan], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cek_menu_akses = Custom::cek_akses_menu('dokumen-ks',json_decode(Custom::get_menu_akses(),true));
        $usulan = M_Usulan::select("id","deskripsi")->get();
        if($cek_menu_akses['status_tambah'] == "1"){
            return view("pages.dokumen_kerjasama.form_tambah",compact("usulan"));
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
                "id_usulan"  => "required",
                "nama_dokumen"  => "required",
                "tgl_awal"  => "required",
                "tgl_akhir"  => "required",
                "deskripsi"  => "required",
                "file_publih"  => "required|max:2048|mimes:pdf,docx",

               
            ];
            $validation = Validator::make($request->all(), $validates, Custom::messages(), []);
            if($validation->fails()) {
                return response()->json([
                    "status"    => "warning",
                    "messages"   => $validation->errors()->first()
                ], 422);
            }

            try {
                $usulan = M_Usulan::select("id_unit","id_jenis_kerjasama","id_mitra","id_bentuk_kerjasama")->find($request->id_usulan);
                $nama_file = Custom::nameFile($request->file_publih);
                $data = [ 
                    "id_usulan" => $request->id_usulan, 
                    "id_unit" => $usulan->id_unit, 
                    "id_jenis_kerjasama" => $usulan->id_jenis_kerjasama, 
                    "id_mitra" => $usulan->id_mitra, 
                    "id_bentuk_kerjasama" => $usulan->id_bentuk_kerjasama, 
                    "nama_dokumen" => $request->nama_dokumen, 
                    "tgl_awal" => $request->tgl_awal, 
                    "tgl_akhir" => $request->tgl_akhir, 
                    "deskripsi" => $request->deskripsi, 
                    "file_publih" => $nama_file, 
                    "user_id"  => auth()->user()->id,
                ];
    
                $result = M_Dokumen::create($data);
                Custom::uploadFile($request->file_publih, $nama_file, $this->uploadDir);
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
     * @param  \App\Models\M_Dokumen  $m_Dokumen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cek_menu_akses = Custom::cek_akses_menu('dokumen-ks',json_decode(Custom::get_menu_akses(),true));
        $data = M_Dokumen::with("unit","mitra","jenis_kerjasama","bentuk_kerjasama")->find($id);
        $usulan = M_Usulan::select("id","deskripsi")->get();
        if($cek_menu_akses['status_tambah'] == "1"){
            return view("pages.dokumen_kerjasama.form_ubah",compact("usulan","data","id"));
        }else{
            return redirect('no-akses');
        }
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\M_Dokumen  $m_Dokumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validates 	= [
                "id_usulan"  => "required",
                "nama_dokumen"  => "required",
                "tgl_awal"  => "required",
                "tgl_akhir"  => "required",
                "deskripsi"  => "required",
            ];
            if(!empty($request->file_publih)){
                $validates += ["file_publih"  => "max:2048|mimes:pdf,docx",];
            }
            $validation = Validator::make($request->all(), $validates, Custom::messages(), []);
            if($validation->fails()) {
                return response()->json([
                    "status"    => "warning",
                    "messages"   => $validation->errors()->first()
                ], 422);
            }

            try {
                $usulan = M_Usulan::select("id_unit","id_jenis_kerjasama","id_mitra","id_bentuk_kerjasama")->find($request->id_usulan);
                if(!empty($request->file_publih)){
                    $nama_file = Custom::nameFile($request->file_publih);
                }
                
                $data = [ 
                    "id_usulan" => $request->id_usulan, 
                    "id_unit" => $usulan->id_unit, 
                    "id_jenis_kerjasama" => $usulan->id_jenis_kerjasama, 
                    "id_mitra" => $usulan->id_mitra, 
                    "id_bentuk_kerjasama" => $usulan->id_bentuk_kerjasama, 
                    "nama_dokumen" => $request->nama_dokumen, 
                    "tgl_awal" => $request->tgl_awal, 
                    "tgl_akhir" => $request->tgl_akhir, 
                    "deskripsi" => $request->deskripsi, 
                    "user_id"  => auth()->user()->id,
                ];
                if(!empty($request->file_publih)){
                    $data += ["file_publih" => $nama_file,];
                }
    
                $result = M_Dokumen::find($id);
                if(!empty($request->file_publih)){
                    Custom::deleteFile($result->file_publih, $this->uploadDir);
                    Custom::uploadFile($request->file_publih, $nama_file, $this->uploadDir);
                }
                $result->update($data);
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
     * @param  \App\Models\M_Dokumen  $m_Dokumen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $cek_menu_akses = Custom::cek_akses_menu('dokumen-ks',json_decode(Custom::get_menu_akses(),true));
            if($cek_menu_akses['status_hapus'] == "1"){
                $result = M_Dokumen::find($id);
                Custom::deleteFile($result->file_publih, $this->uploadDir);
                $result->delete();
                return response()->json(['status'=>'success', 'messages'=>'proses success'], 201);
            }else{
                return response()->json(['status'=>'warning', 'messages'=>'Mohon maaf hak akses untuk menghapus data ini telah dinonaktifkan'], 404);
            }
            
        } catch(QueryException $e) {
            return response()->json(['status'=>'error', 'messages'=>$e->errorInfo ], 500);
        }
    }
}
