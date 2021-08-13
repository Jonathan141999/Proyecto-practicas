<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsPostulation extends Model
{
    protected $fillable = ['publication_id'];

    public function postulations()
    {
        return $this->belongsTo('App\Models\Postulation');
    }

    public function publications()
    {
        return $this->belongsTo('App\Models\Publication');
    }
}
