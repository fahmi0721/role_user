<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Usulan extends Model
{
    use HasFactory;
    protected $table 	= 't_usulan_unit';
    protected $fillable = [
        'id_unit',
        'id_jenis_kerjasama',
        'id_mitra',
        'id_bentuk_kerjasama',
        'tanggal_usul',
        'deskripsi',
        'user_id',
    ];

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
