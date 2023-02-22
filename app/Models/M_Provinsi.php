<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Provinsi extends Model
{
    use HasFactory;
    protected $table 	= 'm_provinsi';
    protected $fillable = [
        'nama_provinsi',
        'deskripsi',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];
}
