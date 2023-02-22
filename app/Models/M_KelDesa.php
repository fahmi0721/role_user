<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_KelDesa extends Model
{
    use HasFactory;
    protected $table 	= 'm_kel_desa';
    protected $fillable = [
        'id_provinsi',
        'id_kab_kota',
        'id_kecamatan',
        'nama_kel_desa',
        'kode_pos',
        'deskripsi',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];

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
}
