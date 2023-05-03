<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\M_JenisKerjasama;

use Custom;
class HomeController extends Controller
{
    public function index() {
        $cek_menu = json_decode(Session::get("menu_user"),true);
        if($cek_menu['status'] == "warning"){
            return redirect('no-role');
        }
        $jenis_ks = M_JenisKerjasama::select("id","nama_jenis_kerjasama","deskripsi")->get();
        $std = DB::select("SELECT a.nama_jenis_kerjasama AS nama, COUNT(b.id_jenis_kerjasama) AS tot, a.id, a.deskripsi
        FROM m_jenis_ks a
        INNER JOIN t_dok_ks b ON a.id = b.id_jenis_kerjasama GROUP BY b.id_jenis_kerjasama");
        return view('pages.home.detail',compact("jenis_ks","std"));
    }

    public function no_akses(){
        
        return view('pages.home.no-akses');

    }

    public function no_role(){
        return view('pages.home.no-role');

    }

    public function pie_data(){
        $res = array();
        $aktif = DB::select("SELECT COUNT(id) AS tot  FROM t_dok_ks WHERE DATE_FORMAT(NOW(), '%Y-%m-%d') BETWEEN tgl_awal AND tgl_akhir GROUP BY DATE_FORMAT(NOW(), '%Y-%m-%d')");
        $tidak_aktif = DB::select("SELECT COUNT(id) AS tot,tgl_akhir  FROM t_dok_ks WHERE DATE_FORMAT(NOW(), '%Y-%m-%d') > tgl_akhir GROUP BY id");
        $res[0]['value'] = count($aktif) > 0 ? $aktif[0]->tot : 0;
        $res[0]['label'] = "Aktif";
        $res[0]['color'] = "#3c8dbc";
        $res[0]['highlight'] = "#3c8dbc";

        $res[1]['value'] = count($tidak_aktif) > 0 ? $tidak_aktif[0]->tot : 0;
        $res[1]['label'] = "Tidak Aktif";
        $res[1]['color'] = "#f56954";
        $res[1]['highlight'] = "#f56954";
        return response()->json(['status'=>'success','messages'=>'proses success', "data" => $res], 201);
    }

    public function bar_data(){
        $res = array();
        $unit = DB::select("SELECT nama_unit, id FROM t_unit ORDER BY id ASC");
        foreach($unit as $u){
            $res['labels'][] = $u->nama_unit;
            $res['mou'][] =0;
            $res['moa'][] =0;
            $res['ia'][] =0;
        }
        $mou = DB::select("SELECT COUNT(a.id_unit) AS tot, b.nama_unit
        FROM t_dok_ks a
        INNER JOIN t_unit b ON a.id_unit = b.id
        WHERE a.id_jenis_kerjasama = 1
        GROUP BY a.id_unit
        ORDER BY a.id_unit ASC");
        $moa = DB::select("SELECT COUNT(a.id_unit) AS tot, b.nama_unit
        FROM t_dok_ks a
        INNER JOIN t_unit b ON a.id_unit = b.id
        WHERE a.id_jenis_kerjasama = 2
        GROUP BY a.id_unit
        ORDER BY a.id_unit ASC");
        $ia = DB::select("SELECT COUNT(a.id_unit) AS tot, b.nama_unit
        FROM t_dok_ks a
        INNER JOIN t_unit b ON a.id_unit = b.id
        WHERE a.id_jenis_kerjasama = 3
        GROUP BY a.id_unit
        ORDER BY a.id_unit ASC");
        $i=0;
        foreach($mou as $mo){
            $key = array_search($mo->nama_unit, $res['labels']);
            $res['mou'][$key] = $mo->tot;
            $i++;
        }
        $i=0;
        foreach($moa as $mo){
            $key = array_search($mo->nama_unit, $res['labels']);
            $res['moa'][$key] = $mo->tot;
            $i++;
        }
        $i=0;
        foreach($ia as $mo){
            $key = array_search($mo->nama_unit, $res['labels']);
            $res['ia'][$key] = $mo->tot;
            $i++;
        }
        return response()->json(['status'=>'success','messages'=>'proses success', "data" => $res], 201);

    }

    public function line_data(){
        $res = array();
        $labels = array();
        $year_now = date("Y");
        $minus5tahun = $year_now - 4;
        for ($i=$minus5tahun; $i <= $year_now ; $i++) { 
            $labels[] =  $i;
            $res['mou'][]=0;
            $res['moa'][]=0;
            $res['ia'][]=0;
        }
        $mou = DB::select("SELECT DATE_FORMAT(tgl_awal,'%Y') as tahun, COUNT(DATE_FORMAT(tgl_awal,'%Y')) AS tot FROM t_dok_ks 
        WHERE id_jenis_kerjasama = 1 AND  (DATE_FORMAT(tgl_awal,'%Y') BETWEEN '$minus5tahun' AND '$year_now')
        GROUP BY DATE_FORMAT(tgl_awal,'%Y')
        ORDER BY DATE_FORMAT(tgl_awal,'%Y') ASC");
        $moa = DB::select("SELECT DATE_FORMAT(tgl_awal,'%Y') as tahun , COUNT(DATE_FORMAT(tgl_awal,'%Y')) AS tot FROM t_dok_ks 
        WHERE id_jenis_kerjasama = 2 AND  (DATE_FORMAT(tgl_awal,'%Y') BETWEEN '$minus5tahun' AND '$year_now')
        GROUP BY DATE_FORMAT(tgl_awal,'%Y')
        ORDER BY DATE_FORMAT(tgl_awal,'%Y') ASC");
        $ia = DB::select("SELECT DATE_FORMAT(tgl_awal,'%Y') as tahun , COUNT(DATE_FORMAT(tgl_awal,'%Y')) AS tot FROM t_dok_ks 
        WHERE id_jenis_kerjasama = 3 AND  (DATE_FORMAT(tgl_awal,'%Y') BETWEEN '$minus5tahun' AND '$year_now')
        GROUP BY DATE_FORMAT(tgl_awal,'%Y')
        ORDER BY DATE_FORMAT(tgl_awal,'%Y') ASC");
        $i=0;
        foreach($mou as $mo){
            $key = array_search($mo->tahun, $labels);
            $res['mou'][$key] = $mo->tot;
            $i++;
        }
        $i=0;
        foreach($moa as $mo){
            $key = array_search($mo->tahun, $labels);
            $res['moa'][$key] = $mo->tot;
            $i++;
        }
        $i=0;
        foreach($ia as $mo){
            $key = array_search($mo->tahun, $labels);
            $res['ia'][$key] = $mo->tot;
            $i++;
        }
        $res['labels'] = $labels;
        // $res['mou']= $mou;
        return response()->json(['status'=>'success','messages'=>'proses success', "data" => $res], 201);
    }

   
}
