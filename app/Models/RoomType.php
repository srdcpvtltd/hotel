<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    public $timestamps = false;

    public function price_rule()
    {
        return $this->hasOne(PriceRule::class);
    }

    public function room()
    {
        return $this->hasOne(Room::class);
    }
}
