<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_JenisKerjasama extends Model
{
    use HasFactory;
    protected $table 	= 'm_jenis_ks';
    protected $fillable = [
        'nama_jenis_kerjasama',
        'deskripsi',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];
}
