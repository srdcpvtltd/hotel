<?php

namespace App\Http\Controllers;

use App\DataTables\RoomDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Models\HotelProfile;
use App\Models\Room;
use App\Models\RoomType;
use App\Services\RoomService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{

    protected $RoomService;

    public function __construct(RoomService $RoomService)
    {
        $this->RoomService = $RoomService;
    }

    public function index(RoomDataTable $table)
    {
        return $table->render('system_management.room.index');
    }

    public function create()
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $room_type = RoomType::where('hotel_id', $hotel->id)->get();

        return view('system_management.room.create', compact('room_type'));
    }

    public function store(RoomRequest $request)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        
        $hotel_id = [
            'hotel_id' => $hotel->id,
        ];

        $message = '';
        try {
            $RoomService = $this->RoomService->store($request, Room::class, $hotel_id);
            $message = 'Room saved successfully';
        } catch (\Exception $exception) {
            $message = 'Error has exit';
        }
        return redirect()->route('rooms.index')
            ->with('message', __($message));
    }

    public function edit(Room $room)
    {
        $hotel = HotelProfile::where('user_id', Auth::id())->first();
        if (!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }

        $room_type = RoomType::where('hotel_id', $hotel->id)->get();

        return view('system_management.room.edit')->with(compact('room', 'room_type'));
    }

    public function update(RoomRequest $request, Room $room)
    {
        try {
            $this->RoomService->update($request, $room);

            $message = 'Room Updated successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Update';
        }
        return redirect()->route('rooms.index')
            ->with('message', __($message));
    }

    public function destroy(RoomRequest $request, Room $room)
    {
        try {
            $this->RoomService->destroy($request, $room);

            $message = 'Room Deleted successfully';
        } catch (\Exception $exception) {
            $message = 'Error has Deleted';
        }
        return redirect()->route('rooms.index')
            ->with('message', __($message));
    }

    public function getPrice(Request $request)
    {
        $price = DB::table('price_rules')
            ->where('room_type_id', $request->room_type_id)
            ->first();

        if ($price != null) {
            return response()->json($price->price);
        } else {
            return response()->json('No Price Rules Created');
        }
    }

    // Room APIs starts here

    public function create_room(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'room_type_id' => 'required',
            'price' => 'required',
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

            $result = Room::create([
                'hotel_id' =>  920, //only for testing and will be fix after solving the middleware issue
                'name' => $request->name,
                'room_type_id' => $request->room_type_id,
                'price' => $request->price,
            ]);

            if ($result) {
                return response()->json([
                    'message' => "The room has been successfully added"
                ], 200);
            } else {
                return response()->json([
                    'message' => "Failed to add the room. Please try again"
                ], 200);
            }
        }
    }


    //retrive rooms
    public function retrive_rooms(Request $request)
    {
        $limit = $request->limit > 0 ? $request->limit : 10;
        $index = $request->index > 0 ? $request->index : 0;
        $serch_text = $request->search_text;
        if ($serch_text) {
            $room = Room::where('name', 'like', "%$serch_text%")
                ->orWhere('price', 'like', "%$serch_text%")
                ->orWhere('status', 'like', "%$serch_text%")
                ->with('room_type')
                ->limit($limit)
                ->offset($index)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            $room_type = RoomType::where('room_type', 'like', "%$serch_text%")
                ->with('price_rule')
                ->limit($limit)
                ->offset($index)
                ->orderBy('id', 'desc')
                ->get()
                ->toArray();

            if (!empty($room)) {
                return response()->json([
                    'data' => $room
                ], 200);
            } else if (!empty($room_type)) {
                return response()->json([
                    'data' => $room_type
                ], 200);
            } else {
                return response()->json([
                    'message' => "No Rooms found"
                ], 200);
            }
        } else {
            $room = Room::with('room_type')
            ->where('hotel_id',$request->hotel_id)
            ->get();
            if ($room) {
                return response()->json([
                    'data' => $room
                ], 200); 
            } else {
                return response()->json([
                    'message' => "No Rooms available"
                ], 200);
            }
        }
    }

    //paginate
    public function paginate(Request $request)
    {
        $record = Room::with('room_type')->paginate($request->paginate);
        if ($record) {
            return response()->json([
                'data' => $record
            ], 200);
        } else {
            return response()->json([
                'message' => "No Rooms found"
            ], 200);
        }
    }
    //update room

    public function update_rooms(Request $request)
    {
        $payload = $request->all();
        $data = Room::find($request->id);
        Arr::forget($payload, 'id');

        if ($data) {
            $result = $data->update($payload);
            if ($result) {
                return response()->json([
                    'message' => "The data has been successfully updated"
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

    //delete rooms
    public function delete_rooms(Request $request)
    {
        $room = Room::find($request->id);
        if (!$room) {
            return response()->json([
                'message' => 'Invalid Id'
            ], 200);
        }

        // Delete the employee record
        $result = $room->delete();

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
