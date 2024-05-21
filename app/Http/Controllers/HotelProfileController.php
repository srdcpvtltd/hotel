<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelProfileRequest;
use App\Http\Requests\UpdateHotelProfileRequest;
use App\Models\City;
use App\Models\HotelProfile;
use App\Models\PoliceStation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class HotelProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function get_police_stations(Request $request)
    {
        $code = $request->city;

        $city = City::where([['code', $code]])->first();

        $ps = PoliceStation::where([['city_id', $city->id]])->orderBy('desc', "ASC")->get();

        return response()->json(['aaData' => $ps]);
    }

    public function post_add_hotel(Request $request)
    {

        $hotel = new HotelProfile();

        $hotel->hotel_name = $request->hotel_name;
        $hotel->manager_name = $request->manager_name;
        $hotel->owner_name = $request->owner_name;
        $hotel->manager_mobile = $request->manager_no;
        $hotel->owner_mobile = $request->owner_no;
        $hotel->address = $request->address;
        $hotel->registration_number = $request->regd_no;
        $hotel->city = $request->cmbcity;
        $hotel->police_station = $request->police_station;
        $hotel->floors = $request->no_of_floor;
        $hotel->rooms = $request->no_of_rooms;
        $hotel->direct_employee_count = $request->direct_employee_count;
        $hotel->outsource_employee_count = $request->outsource_employee_count;
        $hotel->website = $request->website;
        $hotel->email = $request->email;
        $hotel->geo_tagging = (bool)$request->tagging_radio_btn;
        $hotel->latitude = $request->txtlongitude;
        $hotel->longitude = $request->txtlatitude;
        $hotel->swimming_pool = (bool)$request->swimming_radio_btn;
        $hotel->aggregator = (bool)$request->aggr_radio_btn;
        $hotel->aggregator_registration = $request->agr_regno;
        $hotel->aggregator_name = $request->agr_name;
        $hotel->staff_count = $request->no_of_staf;
        $hotel->security = (bool)$request->security_radio_btn;
        $hotel->security_registration = $request->security_reg_no;
        $hotel->security_name = $request->security_name;
        $hotel->banquet_hall = (bool)$request->banquet_radio_btn;
        $hotel->banquet_hall_count = $request->no_of_banquet;
        // Restaurant
        $hotel->restaurant_count = $request->no_of_restaurant;
        $hotel->leased_room = (bool)$request->leased_radio_btn;
        $hotel->leased_room_count = $request->no_of_leased_room;
        $hotel->has_bar = (bool)$request->bar_radio_btn;
        $hotel->has_pub = (bool)$request->pub_radio_btn;

        // Security Measures
        $hotel->baggage_scanner = (bool)$request->bagage_radio_btn;
        $hotel->fire_detector = (bool)$request->fire_radio_btn;
        $hotel->fire_license = $request->fire_license_no;
        $hotel->cctv = (bool)$request->cctv_radio_btn;
        $hotel->no_of_cameras = $request->no_of_camera;
        $hotel->no_of_cameras_outside = $request->no_of_camera_outside;
        $hotel->metal_detector = (bool)$request->metal_radio_btn;

        $hotel->save();
        $rules = [
            'cmbcity' => 'required'
        ];

        return redirect('add-hotel')->with('success', "Hotel Added Successfully");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_hotel(Request $request)
    {
        $rules = [
            'hotel_name' => 'required|string|max:255',
            'manager_name' => 'required|string|max:255',
            // 'owner_name' => 'required|string|max:255',
            // 'manager_no' => 'required|string|max:20',
            // 'owner_no' => 'required|string|max:20',
            // 'address' => 'required|string|max:255',
            // 'regd_no' => 'required|string|max:255',
            // 'cmbcity' => 'required|string|max:255',
            // 'police_station' => 'required|string|max:255',
            // 'no_of_floor' => 'required|integer|min:1',
            // 'no_of_rooms' => 'required|integer|min:1',
            // 'direct_employee_count' => 'required|integer|min:0',
            // 'outsource_employee_count' => 'required|integer|min:0',
            // 'website' => 'nullable|string|max:255',
            // 'email' => 'nullable|email|max:255',
            // 'tagging_radio_btn' => 'required|boolean',
            // 'txtlongitude' => 'required|numeric',
            // 'txtlatitude' => 'required|numeric',
            // 'swimming_radio_btn' => 'required|boolean',
            // 'aggr_radio_btn' => 'required|boolean',
            // 'agr_regno' => 'nullable|string|max:255',
            // 'agr_name' => 'nullable|string|max:255',
            // 'no_of_staf' => 'required|integer|min:0',
            // 'security_radio_btn' => 'required|boolean',
            // 'security_reg_no' => 'nullable|string|max:255',
            // 'security_name' => 'nullable|string|max:255',
            // 'banquet_radio_btn' => 'required|boolean',
            // 'no_of_banquet' => 'required|integer|min:0',
            // 'no_of_restaurant' => 'required|integer|min:0',
            // 'leased_radio_btn' => 'required|boolean',
            // 'no_of_leased_room' => 'required|integer|min:0',
            // 'bar_radio_btn' => 'required|boolean',
            // 'pub_radio_btn' => 'required|boolean',
            // 'bagage_radio_btn' => 'required|boolean',
            // 'fire_radio_btn' => 'required|boolean',
            // 'fire_license_no' => 'nullable|string|max:255',
            // 'cctv_radio_btn' => 'required|boolean',
            // 'no_of_camera' => 'required|integer|min:0',
            // 'no_of_camera_outside' => 'required|integer|min:0',
            // 'metal_radio_btn' => 'required|boolean',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 200);
        } else {
            $result = HotelProfile::create($request->all());
            if ($result) {
                return response()->json([
                    'message' => "Hotel Added Successfully"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Failed"
                ], 200);
            }
        }
    }

    public function retriv_hotel(Request $request)
    {
    }
    //update
    public function update_hotel(Request $request)
    {
        $payload = $request->all();
        $data = HotelProfile::find($request->id);
        Arr::forget($payload, 'id');

        if ($data) {
            $result = $data->update($payload);
            if ($result) {
                return response()->json([
                    'message' => "Data updated Successfully"
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

    public function delete_hotel(Request $request)
    {
        $hotel_data = HotelProfile::find($request->id);
        if (!$hotel_data) {
            return response()->json([
                'message' => 'Not found'
            ], 200);
        }

        // Delete the employee record
        $deleted = $hotel_data->delete();

        if ($deleted) {
            // Deletion successful
            return response()->json([
                'message' => 'deleted successfully'
            ], 200);
        } else {
            // Deletion failed
            return response()->json([
                'message' => 'Failed to delete data'
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHotelProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreHotelProfileRequest $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HotelProfile  $hotelProfile
     * @return \Illuminate\Http\Response
     */
    public function show(HotelProfile $hotelProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HotelProfile  $hotelProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(HotelProfile $hotelProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHotelProfileRequest  $request
     * @param  \App\Models\HotelProfile  $hotelProfile
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateHotelProfileRequest $request, HotelProfile $hotelProfile)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HotelProfile  $hotelProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelProfile $hotelProfile)
    {
        //
    }
}
