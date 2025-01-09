<?php

namespace App\Http\Controllers;

use App\DataTables\RoomTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTypeRequest;
use App\Models\HotelProfile;
use App\Models\RoomType;
use App\Services\RoomTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoomTypeController extends Controller
{
    protected $RoomTypeService;

    public function __construct(RoomTypeService $RoomTypeService)
    {
        $this->RoomTypeService = $RoomTypeService;
    }

    public function index(RoomTypeDataTable $table){
        return $table->render('system_management.room_type.index');
    }

    public function create()
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        return view('system_management.room_type.create');
    }

    public function store(RoomTypeRequest $request)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        
        $hotel_id = [
            'hotel_id' => $hotel->id,
        ];

        $message='';
        try {
            $RoomTypeService = $this->RoomTypeService->store($request, RoomType::class, $hotel_id);
            $message='Room Type saved successfully';
        } catch (\Exception $exception) {
            $message='Error has exit';
        }
        return redirect()->route('room_type.index')
            ->with('message', __($message));
    }

    public function update(RoomTypeRequest $request, RoomType $room_type)
    {
        try {
            $this->RoomTypeService->update($request, $room_type);

            $message='Room Type Updated successfully';
        } catch (\Exception $exception) {
            $message='Error has Update';
        }
        return redirect()->route('room_type.index')
            ->with('message', __($message));
    }

    public function destroy(RoomTypeRequest $request,RoomType $room_type)
    {
        try {
            $this->RoomTypeService->destroy($request, $room_type);

            $message='Room Type Deleted successfully';
        } catch (\Exception $exception) {
            $message='Error has Deleted';
        }
        return redirect()->route('room_type.index')
            ->with('message', __($message));
    }

    public function edit(RoomType $room_type)
    {

        return view('system_management.room_type.edit')->with(compact('room_type'));
    }

    //room type APIs starts here

    public function create_room_type(Request $request)
    {
        $rules = [
            'hotel_id' => 'required',
            'room_type' => 'required|string|max:50',
            'description' => 'required|string|max:300',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()
            ], 200);
        } else {

            // $hotel = Auth::user();

            // // Check if the user is authenticated
            // if ($hotel) {
            //     $hotel_id = $hotel->id;
            //     $result = RoomType::create([
            //         'hotel_id' =>  $hotel_id ? $hotel_id : 920, //only for testing and will be fix after solving the middleware issue
            //         'room_type' => $request->room_type,
            //         'description' => $request->description
            //     ]);

            //     if ($result) {
            //         return response()->json([
            //             'message' => "Room Type added"
            //         ], 200);
            //     } else {
            //         return response()->json([
            //             'message' => "Something went wrong"
            //         ], 200);
            //     }
            // } else {
            //     // 
            //     return response()->json([
            //         'message' => "User is not authenticated"
            //     ], 200);
            // }

            $result = RoomType::create([
                        'hotel_id' =>  $request->hotel_id, //only for testing and will be fix after solving the middleware issue
                        'room_type' => $request->room_type,
                        'description' => $request->description
                    ]);
    
                    if ($result) {
                        return response()->json([
                            'message' => "The room type has been successfully added"
                        ], 200);
                    } else {
                        return response()->json([
                            'message' => "Failed to add the room type. Please try again"
                        ], 200);
                    }
        }
    }

    //retrive roomtype
    public function retrive_room_type(Request $request){
        $limit = $request->limit > 0 ? $request->limit : 10;
        $index = $request->index > 0 ? $request->index : 0;
        $serch_text = $request->search_text;

        if($serch_text){
            $room_type = RoomType::where('room_type','like',"%$serch_text%")
            ->where('hotel_id',$request->hotel_id) 
            ->limit($limit)
            ->offset($index)
            ->orderBy('id', 'desc')
            ->get();
    
            if($room_type){
                return response()->json([
                    'data' => $room_type
                ], 200);
            }else{
                return response()->json([
                    'message' => "No Room type available"
                ], 200);
            }
        }else{
            $room_type = RoomType::where('hotel_id',$request->hotel_id)->get();
            if($room_type){
                return response()->json([
                    'data' => $room_type
                ], 200);
            }else{
                return response()->json([
                    'message' => "No room type found"
                ], 200);
            }
        }
       
    }

    //paginate room type
    public function paginate(Request $request){
        $record = RoomType::paginate($request->paginate);
        if($record){
            return response()->json([
                'data' => $record
            ], 200);
        }else{
            return response()->json([
                'message' => "No room type found"
            ], 200);
        }
    }
    //update roomtype
    public function update_room_type(Request $request)
    {
        $payload = $request->all();
        $data = RoomType::find($request->id);
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

    public function delete_room_type(Request $request)
    {
        $room_type = RoomType::find($request->id);
        if (!$room_type) {
            return response()->json([
                'message' => 'Not found'
            ], 200);
        }

        // Delete the employee record
        $result = $room_type->delete();

        if ($result) {
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

    //room type APIs ends here
}
