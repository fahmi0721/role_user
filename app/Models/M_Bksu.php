<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Bksu extends Model
{
    use HasFactory;
    protected $table 	= 'm_bksu';
    protected $fillable = [
        'nama_bentuk_kerjasam_umum',
        'penjelasan_bentuk_kerjasam_umum',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];
}
