<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_KabKota extends Model
{
    use HasFactory;
    protected $table 	= 'm_kab_kota';
    protected $fillable = [
        'id_provinsi',
        'nama_kab_kota',
        'deskripsi',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];

    public function provinsi()
    {
        return $this->belongsTo('App\Models\M_Provinsi','id_provinsi','id')->select(['id','nama_provinsi']);
    }
}
