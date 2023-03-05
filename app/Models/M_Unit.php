<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Unit extends Model
{
    use HasFactory;
    protected $table 	= 't_unit';
    protected $fillable = [
        'nama_unit',
        'email',
        'no_telp',
        'pd_unit',
        'web',
        'user_id',
    ];
}
