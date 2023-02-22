<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Role_Menu extends Model
{
    use HasFactory;
    protected $table 	= 't_role_menu';
    protected $fillable = [
        'id_role',
        'id_menu',
        'status',
        'status_tambah',
        'status_edit',
        'status_hapus',
        'status_tampil',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];

    public function menu()
    {
        return $this->belongsTo('App\Models\M_Menu','id_menu','id')->select(['id','nama_menu','parent']);
    }

    public function role()
    {
        return $this->belongsTo('App\Models\M_Role','id_role','id')->select(['id','nama_role']);
    }

    
}
