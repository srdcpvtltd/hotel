<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    public $timestamps = false;

    public function district()
    {
        return $this->hasOne('App\Models\District','id','district_id');
    }
}
