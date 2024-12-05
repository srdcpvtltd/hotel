<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    public function create_designation(Request $request)
    {
        $rules = [
            'designation' => 'required|string|max:50'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 200);
        } else {
            $attributes=[
                'designation' => $request->designation
            ];
            $values = [
                // 'hotel_id' => Auth::user()->id,
                'hotel_id' => 1045,
                'designation' => $request->designation
            ];
            $result = Designation::firstOrCreate($attributes, $values);

            if ($result->wasRecentlyCreated) {
                return response()->json([
                    'message' => "The designation type has been successfully added"
                ], 200);
            } else {
                return response()->json([
                    'message' => "$request->designation already exist"
                ], 200);
            }
        }
    }

    public function retrive_designation(Request $request){
        
        $limit = $request->limit > 0 ? $request->limit : 10;
        $index = $request->index > 0 ? $request->index : 0;
        $serch_text = $request->search_text;
        $data = Designation::where('hotel_id',1045)->get();

        if($serch_text){
            $designation = Designation::where('hotel_id',1045)
            ->where('designation','like',"%$serch_text%") 
            ->limit($limit)
            ->offset($index)
            ->orderBy('id', 'desc')
            ->get();
    
            if($designation){
                return response()->json([
                    'data' => $designation
                ], 200);
            }else{
                return response()->json([
                    'message' => "No Designation found"
                ], 200);
            }
        }else{
            $designation = Designation::where('hotel_id',1045) ->orderBy('id', 'desc')->get();
            if($designation){
                return response()->json([
                    'data' => $designation
                ], 200);
            }else{
                return response()->json([
                    'message' => "No Designation added"
                ], 200);
            }
        }
    }

    public function update_designation(Request $request)
    {
        $payload = $request->all();
        $data = Designation::find($request->id);
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

    public function delete_designation(Request $request)
    {
        $designation = Designation::find($request->id);
        if (!$designation) {
            return response()->json([
                'message' => 'Not found'
            ], 200);
        }

        // Delete the employee record
        $result = $designation->delete();

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
