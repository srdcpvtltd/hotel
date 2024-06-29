<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $table = 'foods';
    protected $guarded = ['id']; 
    protected $fillable = [
        'hotel_id',
        'category_id',
        'name',
        'price', 
    ];

    public function category(){
        return $this->belongsTo(FoodCategory::class,'category_id');
    }
}
