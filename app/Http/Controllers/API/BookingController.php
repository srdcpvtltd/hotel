<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AdvanceBooking;
use App\Models\Booking;
use App\Models\HotelProfile;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function create_booking(Request $request)
    {

        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return response()->json([
                'message' => "Please add a hotel first"
            ]);
        }
        $booking = new Booking();

        if ($request->guest_image) {

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $image_path = url('images/' . $imageName);
            $booking->guest_image = $image_path;
        }

        $booking->gues_name = $request->gues_name;
        $booking->mobile_number = $request->mobile_number;
        $booking->alter_mobile_number = $request->alter_mobile_number;
        $booking->age = $request->age;
        $booking->user_id = Auth::user()->id;
        $booking->gender = $request->gender;
        $booking->email_id = $request->email_id;
        $booking->arrived_from = $request->arrived_from;
        $booking->nationality = $request->nationality;
        $booking->transport = $request->transport;
        $booking->house_number = $request->house_number;
        $booking->lane = $request->lane;
        $booking->land_mark = $request->land_mark;
        $booking->country_id = $request->country;
        $booking->hotel_id = $hotel->id;
        $booking->state_id = $request->state;
        $booking->district_id = $request->district;
        $booking->city_id = $request->city;
        $booking->present_town = $request->present_town;
        $booking->present_pin = $request->present_pin;
        $booking->p_house_number = $request->p_house_number;
        $booking->p_lane = $request->p_lane;
        $booking->p_land_mark = $request->p_land_mark;
        $booking->p_country_id = $request->p_country;
        $booking->p_state_id = $request->p_state;
        $booking->p_district_id = $request->p_district;
        $booking->p_city_id = $request->p_city;
        $booking->p_town = $request->p_town;
        $booking->p_pin = $request->p_pin;
        $booking->local_contact_name = $request->local_contact_name;
        $booking->local_contact_number = $request->local_contact_number;
        $booking->accompany_adult = $request->accompany_adult;
        $booking->accompany_children = $request->accompany_children;
        $booking->arrival_date = $request->arrival_date;
        $booking->arrival_time = $request->arrival_time;
        $booking->id_type = $request->id_type;
        $booking->id_number = $request->id_number;
        $booking->remarks = $request->remarks;
        $booking->accompany_person = $request->accompany_person;
        $booking->room_booked = count($request->bookingdata);
        $booking->whom_to_visit = $request->whom_to_visit;
        $booking->whom_to_visit_name = $request->whom_to_visit_name;
        $booking->whom_to_visit_mobile = $request->whom_to_visit_mobile;
        $booking->is_visited_before = $request->is_visited_before;
        $booking->other_country = $request->other_country;
        $booking->p_other_country = $request->p_other_country;
        $booking->other_state = $request->other_state;
        $booking->p_other_state = $request->p_other_state;
        $booking->other_city = $request->other_city;
        $booking->p_other_city = $request->p_other_city;

        $result = $booking->save();

        if ($booking && $result) {
            // save booking rooms
            if ($request->bookingdata) {
                $booking->rooms()->createMany($request->bookingdata);
            }
            if ($request->accompany) {
                $booking->accompanies()->createMany($request->accompany);
            }
            if ($request->advance_booking_id) {
                $room = AdvanceBooking::where('id', $request->advance_booking_id)->first();
                $room->status = 1;
                $room->updated_at = date('Y-m-d H:i:s');
                $room->save();
            }

            // room status
            $count = count($request->bookingdata);
            for ($i = 0; $i < $count; $i++) {
                $rooms[] = $request->bookingdata['booking' . $i]['room_number'];
            }

            foreach ($rooms as $room) {
                $room = Room::where('name', $room)->first();
                $room->status = 1;
                $room->updated_at = date('Y-m-d H:i:s');
                $room->save();
            }
            return response()->json([
                'message' => "Checkin Successfull"
            ]);
        } else {
            return response()->json([
                'message' => "Checkin failed"
            ]);
        }
    }
}
