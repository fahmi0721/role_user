<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Bksd extends Model
{
    use HasFactory;
    protected $table 	= 'm_bksd';
    protected $fillable = [
        'id_bentuk_kerjasama_umum',
        'nama_bentuk_kerjasam_detail',
        'rincian_bentuk_kerjasam_detail',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];

    public function bksu()
    {
        return $this->belongsTo('App\Models\M_Bksu','id_bentuk_kerjasama_umum','id')->select(['id','nama_bentuk_kerjasam_umum']);
    }
}
