<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housekeeping extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id',
        'room_id',
        'assign_staff_id',
        'status'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function staff()
    {
        return $this->belongsTo(Hotel_staff::class, 'assign_staff_id');
    }
}
