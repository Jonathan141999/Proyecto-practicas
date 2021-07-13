<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = ['name','location','phone','email','hour','publication_date','type','details','image','category_id'];

    //Relacion de muchos a muchos
    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
    //Un categoria tine varias publicaiones
    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }
}
