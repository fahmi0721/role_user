<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Mitra extends Model
{
    use HasFactory;
    protected $table 	= 't_mitra';
    protected $fillable = [
        'id_jenis_mitra',
        'id_provinsi',
        'id_kab_kota',
        'id_kecamatan',
        'id_kel_desa',
        'nama_mitra',
        'email',
        'no_tlp',
        'alamat',
        'website',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];

    public function jenis_mitra()
    {
        return $this->belongsTo('App\Models\M_JenisMitra','id_jenis_mitra','id')->select(['id','nama_jenis_mitra']);
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Models\M_Provinsi','id_provinsi','id')->select(['id','nama_provinsi']);
    }

    public function kab_kota()
    {
        return $this->belongsTo('App\Models\M_KabKota','id_kab_kota','id')->select(['id','nama_kab_kota']);
    }

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\M_Kecamatan','id_kecamatan','id')->select(['id','nama_kecamatan']);
    }

    public function kel_desa()
    {
        return $this->belongsTo('App\Models\M_KelDesa','id_kel_desa','id')->select(['id','nama_kel_desa']);
    }
}
