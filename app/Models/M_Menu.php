<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Menu extends Model
{
    use HasFactory;

    protected $table 	= 'm_menu';
    protected $fillable = [
        'nama_menu',
        'icon',
        'status',
        'parent',
        'url',
        'user_id',
    ];
    protected $guarded	= ['created_at','updated_at'];

    public function parent()
    {
        return $this->belongsTo('App\Models\M_Menu','parent','id');
    }

    
}
