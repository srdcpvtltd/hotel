<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel_staff;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class HotelStaffController extends Controller
{
    public function create_staff(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:50',
            'contact_no' => 'required|string|max:50',
            'designation_id' => 'required',
            'salary' => 'required',
            'shift' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 200);
        } else {
            $attributes = [
                'name' => $request->name,
                'contact_no' => $request->contact_no,
                'designation_id' => $request->designation_id,
                'salary' => $request->salary,
                'shift' => $request->shift,
                'hotel_id' => 1045
            ];
            $result = Hotel_staff::firstOrCreate($attributes, $attributes);

            if ($result->wasRecentlyCreated) {
                return response()->json([
                    'message' => "The staff has been successfully added"
                ], 200);
            } else {
                return response()->json([
                    'message' => "$request->name already exist"
                ], 200);
            }
        }
    }

    public function retrive_staff(Request $request)
    {

        $limit = $request->limit > 0 ? $request->limit : 10;
        $index = $request->index > 0 ? $request->index : 0;
        $search_text = $request->search_text;

        if ($search_text) {
            $staff = Hotel_staff::with('designation')
                ->where('hotel_id', 1045)
                ->where('name', 'like', "%$search_text%")
                ->orWhere('contact_no', 'like', "%$search_text%")
                ->orWhere('shift', 'like', "%$search_text%")
                ->orWhereHas('designation', function ($query) use ($search_text) {
                    $query->where('designation', 'like', "%$search_text%");
                })
                ->limit($limit)
                ->offset($index)
                ->orderBy('id', 'desc')
                ->get();

            if ($staff->toArray()) {
                return response()->json([
                    'data' => $staff
                ], 200);
            } else {
                return response()->json([
                    'message' => "No Staff data found"
                ], 200);
            }
        } else {
            $staff = Hotel_staff::where('hotel_id', 1045)->orderBy('id', 'desc')->get();
            if ($staff) {
                return response()->json([
                    'data' => $staff
                ], 200);
            } else {
                return response()->json([
                    'message' => "No Designation added"
                ], 200);
            }
        }
    }

    public function update_staff(Request $request)
    {
        $payload = $request->all();
        $data = Hotel_staff::find($request->id);
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
        }else{
            return response()->json([
                'message' => "Invalid Id"
            ], 200);
        }
    }

    public function delete_staff(Request $request)
    {
        $staff_data = Hotel_staff::find($request->id);
        if (!$staff_data) {
            return response()->json([
                'message' => 'Not found'
            ], 200);
        }

        // Delete the employee record
        $result = $staff_data->delete();

        if ($result) {
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
