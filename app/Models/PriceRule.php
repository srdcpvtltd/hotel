<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceRule extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    public $timestamps = false;


    protected $fillable = [
        'hotel_id',
        'room_type_id',
        'rent_by_hour',
        'rent_by_hour_price',
        'after_rent_by_hour_price',
        'price',
        'extra_adult_price',
        'extra_child_price',
        'check_in',
        'check_out',
        'overtime_charge',
        'rounded_minutes',
        'friday_price',
        'saturday_price',
        'sunday_price',
        'holiday_price'
    ];

    public function room_type()
    {
        return $this->belongsTo(RoomType::class);
    }
}
