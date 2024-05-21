<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function create_booking(Request $request){
        $payload = $request->all();
        
        $validator =  Validator::make($payload,[
            
        ]);

        $payload['user_id'] = Auth::user()->id;

        $result = Booking::create($payload);


    }
}
