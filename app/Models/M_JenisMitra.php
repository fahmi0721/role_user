<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_JenisMitra extends Model
{
    use HasFactory;
    protected $table 	= 'm_jenis_mitra';
    protected $fillable = [
        'nama_jenis_mitra',
        'deskripsi',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];
}
