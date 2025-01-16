<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookingRoom extends Model
{
    use HasFactory;
    protected $fillable = ['room_type_id','room_number'];
    protected $appends = ['checkout_datetime'];

    public function getCheckoutDatetimeAttribute()
    {
        return Carbon::parse(($this->checkout_date.' '.$this->checkout_time))->format('d-m-Y H:i:s');
    }

    public function room_type() {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function room() {
        return $this->hasMany(Room::class,'name', 'room_number');
    }
}
