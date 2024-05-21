<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AdvanceBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class AdvanceBookingsController extends Controller
{
    public function create_advance_bookings(Request $request)
    {
        $payload = $request->all();
        $rules = [
            'name' => 'required',
            'phone_number' => 'required',
            'room_type_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required'
        ];
        $validator =  Validator::make($payload, $rules);
        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->getMessageBag()
            ]);
        } else {
            $payload['from_date'] = date('d-m-Y', strtotime($request->from_date));
            $request['to_date'] = date('d-m-Y', strtotime($request->to_date));

            $result = AdvanceBooking::create($payload);

            if ($result) {
                return response()->json([
                    'message' => 'Booking Done!'
                ]);
            } else {
                return response()->json([
                    'message' => 'Booking Failed, please try again'
                ]);
            }
        }
    }

    //retrive
    public function retrive_advance_bookings(Request $request)
    {
        $limit = $request->limit > 0 ? $request->limit : 10;
        $index = $request->index > 0 ? $request->index : 0;
        $serch_text = $request->search_text;
        // $payload = $request->all();
        if ($request->id) {
            $booking_data = AdvanceBooking::with('room_type')->where('id', $request->id)->first();
            $booking_data->room_type_name = $booking_data->room_type->room_type;
            $booking_data->unsetRelation('room_type');

            if ($booking_data) {
                return response()->json([
                    'data' => $booking_data
                ]);
            } else {
                return response()->json([
                    'message' => "Invalid Id"
                ]);
            }
        }elseif($serch_text){
            $bookings = AdvanceBooking::where('name','like',"%$serch_text%")
            ->orWhere('phone_number','like',"%$serch_text%") 
            ->limit($limit)
            ->offset($index)
            ->orderBy('id', 'desc')
            ->get();
            if($bookings){
                return response()->json([
                    'data' => $bookings
                ], 200);
            }else{
                return response()->json([
                    'message' => "No Room type available"
                ], 200);
            }
        }
         else {
            $bookings_data = AdvanceBooking::with('room_type')->orderBy('id', 'desc')->get();
            foreach ($bookings_data as $booking_data) {
                $booking_data->room_type_name = $booking_data->room_type->room_type;
                $booking_data->unsetRelation('room_type');
            }

            if ($bookings_data) {
                return response()->json([
                    'data' => $bookings_data
                ]);
            } else {
                return response()->json([
                    'message' => "No Data found"
                ]);
            }
        }
    }

    //update
    public function update_advance_bookings(Request $request)
    {
        $payload = $request->all();
        $booking_data = AdvanceBooking::find($request->id);
        Arr::forget($payload, 'id');

        if ($booking_data) {
            $result = $booking_data->update($payload);
            if ($result) {
                return response()->json([
                    'message' => "Updated Successfully"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Failed"
                ], 200);
            }
        } else {
            return response()->json([
                'message' => "Invalid Id"
            ], 200);
        }
    }

    //delete
    public function delete_advance_bookings(Request $request)
    {
        $adv_bkngs = AdvanceBooking::find($request->id);
        if (!$adv_bkngs) {
            return response()->json([
                'message' => 'Invalid Id'
            ], 200);
        }
        // Delete the employee record
        $deleted = $adv_bkngs->delete();

        if ($deleted) {
            // Deletion successful
            return response()->json([
                'message' => 'Deleted successfully'
            ], 200);
        } else {
            // Deletion failed
            return response()->json([
                'message' => 'Failed to delete data'
            ], 200);
        }
    }
}
