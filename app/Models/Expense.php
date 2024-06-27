<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    protected $fillable = [
        'hotel_id',
        'category_id',
        'purchase_type',
        'vendor_id',
        'title',
        'amount',
        'date',
        'remark',
        'payment_mode' 
    ];

    public function category(){
        return $this->belongsTo(ExpenseCategory::class,'category_id');
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
    
    public function staff(){
        return $this->belongsTo(Hotel_staff::class,'vendor_id');
    }
}
