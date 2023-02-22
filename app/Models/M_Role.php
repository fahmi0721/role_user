<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Role extends Model
{
    use HasFactory;
    protected $table 	= 'm_role';
    protected $fillable = [
        'nama_role',
        'deskripsi',
        'status',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];
}
