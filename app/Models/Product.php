<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    public $timestamps = false;

    protected $fillable = [
        'hotel_id',
        'product_category_id',
        'name'
    ];

    public function category()
    {
        return $this->belongsTo(Product_category::class, 'product_category_id');
    }
}
