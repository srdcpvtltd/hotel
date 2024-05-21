<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceBooking extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    public $timestamps = false;

    protected $attributes=[
        'status' => 0
    ];
    public function room_type()
    {
        return $this->hasOne('App\Models\RoomType','id','room_type_id');
    }
}
