<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = ['affair', 'details','hour','direction','phone','publication_date'];
}
