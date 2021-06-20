<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = ['affair', 'details','hour','location','phone','publication_date'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
}
