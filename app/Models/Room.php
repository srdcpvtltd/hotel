<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    public $timestamps = false;

    protected $attributes=[
        'status' => 1
    ];

    public function room_type()
    {
        return $this->belongsTo(RoomType::class);
    }
}