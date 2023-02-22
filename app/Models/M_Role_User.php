<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Role_User extends Model
{
    use HasFactory;
    protected $table 	= 't_role_user';
    protected $fillable = [
        'id_role',
        'id_user',
        'status',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User','id_user','id')->select(['id','nama_user']);;
    }

    public function role()
    {
        return $this->belongsTo('App\Models\M_Role','id_role','id')->select(['id','nama_role']);
    }
}
