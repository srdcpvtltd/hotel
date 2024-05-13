<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel_staff extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'hotel_id',
        'contact_no',
        'designation_id',
        'salary',
        'shift',
        'status'
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
