<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        'hotel_id',
        'room_id',
        'food_category_id',
        'food_id',
        'price',
        'quantity',
        'total_price',
        'status',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    
    public function category()
    {
        return $this->belongsTo(FoodCategory::class, 'food_category_id');
    }

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }
}
