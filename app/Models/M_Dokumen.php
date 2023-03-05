<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Dokumen extends Model
{
    use HasFactory;
    protected $table 	= 't_dok_ks';
    protected $fillable = [
        'id_usulan',
        'id_unit',
        'id_jenis_kerjasama',
        'id_mitra',
        'id_bentuk_kerjasama',
        'nama_dokumen',
        'tgl_awal',
        'tgl_akhir',
        'deskripsi',
        'file_publih',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];

    public function usulan()
    {
        return $this->belongsTo('App\Models\M_Usulan','id_usulan','id')->select(['id','deskripsi']);
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\M_Unit','id_unit','id')->select(['id','nama_unit']);
    }

    public function mitra()
    {
        return $this->belongsTo('App\Models\M_Mitra','id_mitra','id')->select(['id','nama_mitra']);
    }

    public function jenis_kerjasama()
    {
        return $this->belongsTo('App\Models\M_JenisKerjasama','id_jenis_kerjasama','id')->select(['id','nama_jenis_kerjasama']);
    }

    public function bentuk_kerjasama()
    {
        return $this->belongsTo('App\Models\M_Bksd','id_bentuk_kerjasama','id')->select(['id','nama_bentuk_kerjasam_detail']);
    }
}
