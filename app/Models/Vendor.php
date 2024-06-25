<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $guarded = ['id']; 
    protected $fillable = [
        'hotel_id',
        'category_id',
        'name',
        'email',
        'mobile_no',
        'address',
        'country_id',
        'state_id',
        'district_id',
        'city',
        'gst_no',
        'contact_person_name',
        'contact_person_mobile',
        'contact_person_email',
    ];

    public function category(){
        return $this->belongsTo(VendorCategory::class,'category_id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }
}
